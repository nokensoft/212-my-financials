<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Order;
use App\Models\ServicePackage;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::with('member')
            ->when($request->get('status'), fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $counts = Order::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('dashboard.orders.index', compact('orders', 'counts'));
    }

    public function create(): View
    {
        $members = Member::orderBy('name')->get();
        $packages = ServicePackage::active()->orderBy('sort_order')->get();

        return view('dashboard.orders.form', compact('members', 'packages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
            'service_package_id' => ['required', 'exists:service_packages,id'],
            'amount' => ['required', 'integer', 'min:0'],
            'payment_method' => ['nullable', 'string', 'max:100'],
            'status' => ['required', Rule::in(array_keys(Order::statuses()))],
            'scheduled_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $package = ServicePackage::find($data['service_package_id']);

        $order = new Order;
        $order->invoice_no = Order::generateInvoiceNo();
        $order->member_id = $data['member_id'];
        $order->service_package_id = $package->id;
        $order->package_name = $package->name;
        $order->amount = $data['amount'];
        $order->payment_method = $data['payment_method'] ?? null;
        $order->status = $data['status'];
        $order->scheduled_at = $data['scheduled_at'] ?? null;
        $order->notes = $data['notes'] ?? null;
        $this->applyVerification($order);
        $order->save();
        $this->syncIncome($order);

        return redirect()->route('dashboard.orders.show', $order)->with('status', 'Pemesanan berhasil dibuat.');
    }

    public function show(Order $order): View
    {
        $order->load('member', 'package', 'verifier');

        return view('dashboard.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(Order::statuses()))],
        ]);

        $order->status = $data['status'];
        $this->applyVerification($order);
        $order->save();
        $this->syncIncome($order);

        return back()->with('status', 'Status pemesanan diperbarui menjadi "'.$order->statusLabel().'".');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('dashboard.orders.index')->with('status', 'Pemesanan berhasil dihapus.');
    }

    public function invoice(Order $order): View
    {
        $order->load('member');

        return view('dashboard.orders.invoice', compact('order'));
    }

    /**
     * Set verifier metadata when an order reaches a verified/paid state.
     */
    protected function applyVerification(Order $order): void
    {
        if (in_array($order->status, [Order::STATUS_TERVERIFIKASI, Order::STATUS_LUNAS], true)) {
            $order->verified_by = $order->verified_by ?: auth()->id();
            $order->verified_at = $order->verified_at ?: now();
        }
    }

    /**
     * Create (idempotently) a matching income transaction once an order is paid.
     */
    protected function syncIncome(Order $order): void
    {
        if ($order->status === Order::STATUS_LUNAS && $order->amount > 0) {
            Transaction::firstOrCreate(
                ['order_id' => $order->id, 'type' => Transaction::TYPE_INCOME],
                [
                    'date' => now()->toDateString(),
                    'category' => 'Penjualan Paket',
                    'description' => 'Pembayaran '.$order->invoice_no.' — '.$order->package_name,
                    'amount' => $order->amount,
                ],
            );
        }
    }
}
