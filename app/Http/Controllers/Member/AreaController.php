<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ServicePackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AreaController extends Controller
{
    protected function member()
    {
        return Auth::guard('member')->user();
    }

    public function dashboard(): View
    {
        $member = $this->member();
        $orders = $member->orders()->latest()->take(5)->get();

        $summary = [
            'total' => $member->orders()->count(),
            'paid' => $member->orders()->where('status', Order::STATUS_LUNAS)->count(),
            'spent' => (int) $member->orders()->where('status', Order::STATUS_LUNAS)->sum('amount'),
        ];

        return view('member.dashboard', compact('member', 'orders', 'summary'));
    }

    public function packages(): View
    {
        $packages = ServicePackage::active()->orderBy('sort_order')->orderBy('price')->get();

        return view('member.packages', compact('packages'));
    }

    public function orders(): View
    {
        $orders = $this->member()->orders()->latest()->paginate(10);

        return view('member.orders', compact('orders'));
    }

    public function orderCreate(ServicePackage $package): View
    {
        abort_unless($package->is_active, 404);

        return view('member.order-create', compact('package'));
    }

    public function orderStore(Request $request, ServicePackage $package): RedirectResponse
    {
        abort_unless($package->is_active, 404);

        $data = $request->validate([
            'payment_method' => ['nullable', 'string', 'max:100'],
            'scheduled_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = $this->member()->orders()->create([
            'invoice_no' => Order::generateInvoiceNo(),
            'service_package_id' => $package->id,
            'package_name' => $package->name,
            'amount' => $package->price,
            'payment_method' => $data['payment_method'] ?? null,
            'status' => Order::STATUS_BARU,
            'scheduled_at' => $data['scheduled_at'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        return redirect()->route('member.orders.show', $order)
            ->with('status', 'Pesanan dibuat. Silakan lakukan pembayaran & tunggu verifikasi admin.');
    }

    public function orderShow(Order $order): View
    {
        $this->authorizeOrder($order);

        return view('member.order-show', compact('order'));
    }

    public function invoice(Order $order): View
    {
        $this->authorizeOrder($order);
        $order->load('member');

        return view('dashboard.orders.invoice', compact('order'));
    }

    public function profileEdit(): View
    {
        $member = $this->member();

        return view('member.profile', compact('member'));
    }

    public function profileUpdate(Request $request): RedirectResponse
    {
        $member = $this->member();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', Rule::unique('members', 'phone')->ignore($member->id)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('members', 'email')->ignore($member->id)],
            'current_password' => ['nullable', 'required_with:password', 'current_password:member'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [], ['phone' => 'nomor HP']);

        $member->name = $data['name'];
        $member->phone = $data['phone'];
        $member->email = $data['email'] ?? null;

        if (filled($data['password'] ?? null)) {
            $member->password = $data['password'];
        }

        $member->save();

        return redirect()->route('member.profile.edit')->with('status', 'Profil berhasil diperbarui.');
    }

    protected function authorizeOrder(Order $order): void
    {
        abort_unless($order->member_id === $this->member()->id, 403);
    }
}
