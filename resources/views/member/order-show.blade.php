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
            <div><dt class="text-muted mb-0.5">Total</dt><dd class="font-bold text-lg text-rust">{{ $order->isFree() ? 'Gratis' : 'Rp '.number_format($order->amount, 0, ',', '.') }}</dd></div>
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
            <p class="text-muted text-xs uppercase font-bold mb-2">Bukti Transfer</p>
            @if ($order->isFree())
                <div class="flex items-start gap-3 rounded-xl bg-primary-50 border border-primary-100 text-primary-700 px-4 py-3">
                    <i class="fa-solid fa-gift mt-0.5"></i>
                    <p class="text-sm font-medium">Paket gratis &mdash; tidak memerlukan pembayaran atau bukti transfer.</p>
                </div>
            @else
                @if ($order->hasPaymentProof())
                    <div class="mb-3">
                        @if ($order->paymentProofIsPdf())
                            <a href="{{ asset($order->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-rust font-semibold hover:underline"><i class="fa-solid fa-file-pdf"></i> Lihat berkas bukti (PDF)</a>
                        @else
                            <a href="{{ asset($order->payment_proof) }}" target="_blank" class="block w-fit">
                                <img src="{{ asset($order->payment_proof) }}" alt="Bukti transfer" class="max-h-56 rounded-xl border border-line object-contain">
                            </a>
                        @endif
                    </div>
                @else
                    <p class="text-sm text-muted mb-3">Belum ada bukti transfer diunggah.</p>
                @endif

                @if (in_array($order->status, [\App\Models\Order::STATUS_BARU, \App\Models\Order::STATUS_MENUNGGU], true))
                    <form method="POST" action="{{ route('member.orders.proof', $order) }}" enctype="multipart/form-data" class="space-y-3">
                        @csrf
                        @include('partials.proof-field')
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition"><i class="fa-solid fa-upload"></i> {{ $order->hasPaymentProof() ? 'Ganti Bukti' : 'Unggah Bukti' }}</button>
                    </form>
                    <p class="text-xs text-muted mt-2"><i class="fa-solid fa-circle-info"></i> Setelah membayar, unggah bukti transfer agar admin dapat memverifikasi pesanan Anda.</p>
                @endif
            @endif
        </div>

        <div class="mt-6 pt-4 border-t border-line">
            <a href="{{ route('member.orders.invoice', $order) }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition">
                <i class="fa-solid fa-file-invoice"></i> Lihat / Cetak Invoice
            </a>
        </div>
    </div>
@endsection
