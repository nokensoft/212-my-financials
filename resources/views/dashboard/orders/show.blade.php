@extends('layouts.dashboard')

@section('page_title', 'Detail Pemesanan')

@php
    $O = \App\Models\Order::class;
    $steps = [$O::STATUS_BARU => 'Baru', $O::STATUS_MENUNGGU => 'Menunggu Verifikasi', $O::STATUS_TERVERIFIKASI => 'Terverifikasi', $O::STATUS_LUNAS => 'Lunas'];
    $stepIndex = array_search($order->status, array_keys($steps), true);
@endphp

@section('content')
    <a href="{{ route('dashboard.orders.index') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar pemesanan</a>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-line p-6">
                @if ($order->status === $O::STATUS_BATAL)
                    <div class="rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm font-semibold"><i class="fa-solid fa-ban"></i> Pemesanan dibatalkan.</div>
                @else
                    <div class="flex items-center justify-between gap-2">
                        @foreach ($steps as $key => $label)
                            @php($done = $stepIndex !== false && $loop->index <= $stepIndex)
                            <div class="flex-1 flex flex-col items-center text-center">
                                <div class="w-9 h-9 rounded-full grid place-items-center text-sm font-bold {{ $done ? 'bg-primary text-white' : 'bg-stone text-muted' }}">
                                    @if ($done)<i class="fa-solid fa-check"></i>@else{{ $loop->iteration }}@endif
                                </div>
                                <span class="text-[11px] font-semibold mt-2 {{ $done ? 'text-ink' : 'text-muted' }}">{{ $label }}</span>
                            </div>
                            @if (! $loop->last)
                                <div class="h-0.5 flex-1 {{ ($stepIndex !== false && $loop->index < $stepIndex) ? 'bg-primary' : 'bg-line' }} -mt-6"></div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-2xl border border-line p-6">
                <div class="flex items-start justify-between gap-3 mb-5">
                    <div>
                        <h2 class="font-bold text-lg">{{ $order->invoice_no }}</h2>
                        <p class="text-sm text-muted">Dipesan {{ $order->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $order->statusClass() }}">{{ $order->statusLabel() }}</span>
                </div>
                <dl class="grid sm:grid-cols-2 gap-4 text-sm">
                    <div><dt class="text-muted mb-0.5">Paket Layanan</dt><dd class="font-semibold">{{ $order->package_name }}</dd></div>
                    <div><dt class="text-muted mb-0.5">Jadwal</dt><dd class="font-semibold">{{ $order->scheduled_at ? $order->scheduled_at->locale('id')->translatedFormat('d F Y, H:i').' WIT' : '—' }}</dd></div>
                    <div><dt class="text-muted mb-0.5">Metode Pembayaran</dt><dd class="font-semibold">{{ $order->payment_method ?? '—' }}</dd></div>
                    <div><dt class="text-muted mb-0.5">Total</dt><dd class="font-bold text-lg text-rust">{{ $order->isFree() ? 'Gratis' : 'Rp '.number_format($order->amount, 0, ',', '.') }}</dd></div>
                </dl>
                @if ($order->notes)
                    <div class="mt-4 pt-4 border-t border-line"><p class="text-muted text-xs uppercase font-bold mb-1">Catatan</p><p class="text-sm">{{ $order->notes }}</p></div>
                @endif
                @if ($order->verified_at)
                    <p class="mt-4 pt-4 border-t border-line text-xs text-muted"><i class="fa-solid fa-user-check"></i> Diverifikasi oleh {{ $order->verifier?->name ?? 'admin' }} · {{ $order->verified_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                @endif
            </div>

            <div class="bg-white rounded-2xl border border-line p-6">
                <h3 class="font-bold mb-3 flex items-center gap-2"><i class="fa-solid fa-receipt text-primary"></i> Bukti Transfer</h3>
                @if ($order->isFree())
                    <div class="flex items-start gap-3 rounded-xl bg-primary-50 border border-primary-100 text-primary-700 px-4 py-3">
                        <i class="fa-solid fa-gift mt-0.5"></i>
                        <p class="text-sm font-medium">Paket gratis &mdash; tidak memerlukan pembayaran atau bukti transfer.</p>
                    </div>
                @else
                    @if ($order->hasPaymentProof())
                        <div class="mb-4">
                            @if ($order->paymentProofIsPdf())
                                <a href="{{ asset($order->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-rust font-semibold hover:underline"><i class="fa-solid fa-file-pdf"></i> Lihat berkas bukti (PDF)</a>
                            @else
                                <a href="{{ asset($order->payment_proof) }}" target="_blank" class="block w-fit">
                                    <img src="{{ asset($order->payment_proof) }}" alt="Bukti transfer" class="max-h-72 rounded-xl border border-line object-contain">
                                </a>
                            @endif
                        </div>
                    @else
                        <p class="text-sm text-muted mb-4">Member belum mengunggah bukti transfer.</p>
                    @endif

                    @if ($order->status !== $O::STATUS_BATAL)
                        <form method="POST" action="{{ route('dashboard.orders.proof', $order) }}" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-2">
                            @csrf
                            <input type="file" name="payment_proof" accept="image/*,application/pdf" required
                                class="w-full text-sm text-muted file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-800 file:text-white file:text-sm file:font-semibold">
                            <button type="submit" class="shrink-0 inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-upload"></i> {{ $order->hasPaymentProof() ? 'Ganti' : 'Unggah' }}</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-line p-6">
                <h3 class="font-bold mb-1">Member</h3>
                <p class="font-semibold">{{ $order->member?->name ?? '—' }}</p>
                <p class="text-sm text-muted">{{ $order->member?->phone }}</p>
                @if ($order->member)
                    <a href="{{ route('dashboard.members.show', $order->member) }}" class="text-xs text-rust font-semibold hover:underline">Lihat member</a>
                @endif
            </div>

            <div class="bg-white rounded-2xl border border-line p-6 space-y-2">
                <h3 class="font-bold mb-2">Tindakan</h3>
                <a href="{{ route('dashboard.orders.invoice', $order) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-print"></i> Cetak Invoice</a>

                @if (! in_array($order->status, [$O::STATUS_TERVERIFIKASI, $O::STATUS_LUNAS, $O::STATUS_BATAL], true))
                    <form method="POST" action="{{ route('dashboard.orders.status', $order) }}">@csrf @method('PATCH')
                        <input type="hidden" name="status" value="{{ $O::STATUS_TERVERIFIKASI }}">
                        <button class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-50 text-blue-700 text-sm font-semibold hover:bg-blue-100 transition"><i class="fa-solid fa-circle-check"></i> Verifikasi Pembayaran</button>
                    </form>
                @endif
                @if ($order->status !== $O::STATUS_LUNAS && $order->status !== $O::STATUS_BATAL)
                    <form method="POST" action="{{ route('dashboard.orders.status', $order) }}">@csrf @method('PATCH')
                        <input type="hidden" name="status" value="{{ $O::STATUS_LUNAS }}">
                        <button class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-stone text-ink text-sm font-semibold hover:bg-line transition"><i class="fa-solid fa-money-bill-wave"></i> Tandai Lunas</button>
                    </form>
                @endif
                @if ($order->status !== $O::STATUS_BATAL)
                    <form method="POST" action="{{ route('dashboard.orders.status', $order) }}">@csrf @method('PATCH')
                        <input type="hidden" name="status" value="{{ $O::STATUS_BATAL }}">
                        <button type="button" @click="$store.confirm.ask($el.closest('form'), { title: 'Batalkan Pesanan', message: 'Yakin membatalkan pemesanan ini?', confirmText: 'Batalkan' })"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 transition"><i class="fa-solid fa-ban"></i> Batalkan Pesanan</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
