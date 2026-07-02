<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Support\SampleData;
use Illuminate\View\View;

/**
 * SIMULASI pemesanan paket + verifikasi + cetak invoice. Data in-memory,
 * tombol verifikasi/aksi hanya visual (tanpa proses nyata).
 */
class OrderController extends Controller
{
    public function index(): View
    {
        $orders = SampleData::orders();
        $statuses = SampleData::orderStatuses();

        return view('dashboard.orders.index', compact('orders', 'statuses'));
    }

    public function show(int $order): View
    {
        $data = SampleData::order($order);
        abort_if($data === null, 404);

        $statuses = SampleData::orderStatuses();

        return view('dashboard.orders.show', ['order' => $data, 'statuses' => $statuses]);
    }

    public function invoice(int $order): View
    {
        $data = SampleData::order($order);
        abort_if($data === null, 404);

        return view('dashboard.orders.invoice', ['order' => $data]);
    }
}
