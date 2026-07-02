@extends('layouts.dashboard')

@section('page_title', 'Detail Pemesanan')

@php
    $steps = ['baru' => 'Baru', 'menunggu_verifikasi' => 'Menunggu Verifikasi', 'terverifikasi' => 'Terverifikasi', 'lunas' => 'Lunas'];
    $order_index = array_search($order['status'], array_keys($steps), true);
@endphp

@section('content')
    <a href="{{ route('dashboard.orders.index') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar pemesanan</a>

    @include('partials.sim-badge', ['note' => 'Detail pemesanan simulasi. Tombol verifikasi/lunas/batal hanya tampilan.'])

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            {{-- Status stepper --}}
            <div class="bg-white rounded-2xl border border-line p-6">
                <div class="flex items-center justify-between gap-2">
                    @foreach ($steps as $key => $label)
                        @php($done = $order_index !== false && $loop->index <= $order_index)
                        <div class="flex-1 flex flex-col items-center text-center">
                            <div class="w-9 h-9 rounded-full grid place-items-center text-sm font-bold {{ $done ? 'bg-primary text-white' : 'bg-stone text-muted' }}">
                                @if ($done) <i class="fa-solid fa-check"></i> @else {{ $loop->iteration }} @endif
                            </div>
                            <span class="text-[11px] font-semibold mt-2 {{ $done ? 'text-ink' : 'text-muted' }}">{{ $label }}</span>
                        </div>
                        @if (! $loop->last)
                            <div class="h-0.5 flex-1 {{ ($order_index !== false && $loop->index < $order_index) ? 'bg-primary' : 'bg-line' }} -mt-6"></div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Rincian --}}
            <div class="bg-white rounded-2xl border border-line p-6">
                <div class="flex items-start justify-between gap-3 mb-5">
                    <div>
                        <h2 class="font-bold text-lg">{{ $order['invoice'] }}</h2>
                        <p class="text-sm text-muted">Dipesan {{ \Illuminate\Support\Carbon::parse($order['ordered_at'])->locale('id')->translatedFormat('d F Y') }}</p>
                    </div>
                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $statuses[$order['status']]['class'] }}">{{ $statuses[$order['status']]['label'] }}</span>
                </div>
                <dl class="grid sm:grid-cols-2 gap-4 text-sm">
                    <div><dt class="text-muted mb-0.5">Paket Layanan</dt><dd class="font-semibold">{{ $order['package'] }}</dd></div>
                    <div><dt class="text-muted mb-0.5">Jadwal</dt><dd class="font-semibold">{{ \Illuminate\Support\Carbon::parse($order['scheduled_at'])->locale('id')->translatedFormat('d F Y, H:i') }} WIT</dd></div>
                    <div><dt class="text-muted mb-0.5">Metode Pembayaran</dt><dd class="font-semibold">{{ $order['method'] }}</dd></div>
                    <div><dt class="text-muted mb-0.5">Total</dt><dd class="font-bold text-lg text-rust">Rp {{ number_format($order['amount'], 0, ',', '.') }}</dd></div>
                </dl>
            </div>
        </div>

        {{-- Aksi & member --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-line p-6">
                <h3 class="font-bold mb-1">Member</h3>
                <p class="font-semibold">{{ $order['member'] }}</p>
                <p class="text-sm text-muted">{{ $order['phone'] }}</p>
            </div>

            <div class="bg-white rounded-2xl border border-line p-6 space-y-2">
                <h3 class="font-bold mb-2">Tindakan</h3>
                <a href="{{ route('dashboard.orders.invoice', $order['id']) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-print"></i> Cetak Invoice</a>
                @if ($order['status'] !== 'terverifikasi' && $order['status'] !== 'lunas')
                    <button type="button" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-50 text-blue-700 text-sm font-semibold hover:bg-blue-100 transition"><i class="fa-solid fa-circle-check"></i> Verifikasi Pembayaran</button>
                @endif
                @if ($order['status'] !== 'lunas')
                    <button type="button" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-stone text-ink text-sm font-semibold hover:bg-line transition"><i class="fa-solid fa-money-bill-wave"></i> Tandai Lunas</button>
                @endif
                <button type="button" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 transition"><i class="fa-solid fa-ban"></i> Batalkan Pesanan</button>
            </div>
        </div>
    </div>
@endsection
