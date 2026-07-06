@extends('layouts.member')

@section('page_title', 'Detail Pesanan')

@section('content')
    <a href="{{ route('member.orders') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke pesanan</a>

    <div class="bg-white rounded-2xl border border-line p-6 max-w-2xl">
        <div class="flex items-start justify-between gap-3 mb-5">
            <div>
                <h1 class="font-bold text-lg">{{ $order->invoice_no }}</h1>
                <p class="text-sm text-muted">Dipesan {{ $order->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</p>
            </div>
            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $order->statusClass() }}">{{ $order->statusLabel() }}</span>
        </div>

        <dl class="grid sm:grid-cols-2 gap-4 text-sm">
            <div><dt class="text-muted mb-0.5">Paket</dt><dd class="font-semibold">{{ $order->package_name }}</dd></div>
            <div><dt class="text-muted mb-0.5">Total</dt><dd class="font-bold text-lg text-rust">Rp {{ number_format($order->amount, 0, ',', '.') }}</dd></div>
            <div><dt class="text-muted mb-0.5">Metode Pembayaran</dt><dd class="font-semibold">{{ $order->payment_method ?? '—' }}</dd></div>
            <div><dt class="text-muted mb-0.5">Jadwal</dt><dd class="font-semibold">{{ $order->scheduled_at ? $order->scheduled_at->locale('id')->translatedFormat('d F Y, H:i').' WIT' : '—' }}</dd></div>
        </dl>

        @if ($order->notes)
            <div class="mt-4 pt-4 border-t border-line">
                <p class="text-muted text-xs uppercase font-bold mb-1">Catatan</p>
                <p class="text-sm">{{ $order->notes }}</p>
            </div>
        @endif

        <div class="mt-6 pt-4 border-t border-line">
            @if ($order->status === \App\Models\Order::STATUS_BARU)
                <div class="rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 text-sm">
                    <i class="fa-solid fa-circle-info"></i> Silakan lakukan pembayaran, lalu admin akan memverifikasi pesanan Anda.
                </div>
            @endif
            <a href="{{ route('member.orders.invoice', $order) }}" target="_blank" class="mt-3 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition">
                <i class="fa-solid fa-file-invoice"></i> Lihat / Cetak Invoice
            </a>
        </div>
    </div>
@endsection
