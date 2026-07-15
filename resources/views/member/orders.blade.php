@extends('layouts.member')

@section('page_title', 'Pesanan Saya')

@section('content')
    <div class="flex items-center justify-between gap-3 mb-6">
        <h1 class="font-serif text-2xl font-semibold">Pesanan Saya</h1>
        <a href="{{ route('member.packages') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition"><i class="fa-solid fa-plus"></i> Pesan Paket</a>
    </div>

    <div class="bg-white rounded-2xl border border-line overflow-hidden">
        @if ($orders->count())
            {{-- Header kolom — tampil di sm ke atas --}}
            <div class="hidden sm:grid sm:grid-cols-[1fr_1fr_auto_auto_auto] gap-x-4 px-5 py-2.5 bg-stone text-muted text-xs font-semibold uppercase tracking-wide border-b border-line">
                <span>Invoice / Tanggal</span>
                <span>Paket</span>
                <span>Jumlah</span>
                <span>Status</span>
                <span class="text-right">Aksi</span>
            </div>

            <ul class="divide-y divide-line">
                @foreach ($orders as $o)
                    <li class="px-5 py-4 hover:bg-stone/40 transition">
                        {{-- Layout mobile: stack vertikal --}}
                        <div class="flex items-start justify-between gap-3">
                            {{-- Kiri: invoice + tanggal + nama paket --}}
                            <div class="min-w-0 flex-1">
                                <p class="font-mono font-semibold text-xs text-ink">{{ $o->invoice_no }}</p>
                                <p class="text-xs text-muted mt-0.5">{{ $o->created_at->locale('id')->translatedFormat('d M Y') }}</p>
                                <p class="text-sm font-medium text-ink mt-1 truncate">{{ $o->package_name }}</p>
                                @if ($o->hasPaymentProof())
                                    <span class="inline-flex items-center gap-1 mt-1 text-[10px] font-semibold text-rust">
                                        <i class="fa-solid fa-paperclip"></i> Bukti transfer
                                    </span>
                                @endif
                            </div>

                            {{-- Kanan: jumlah + status + aksi --}}
                            <div class="flex flex-col items-end gap-2 shrink-0">
                                <span class="font-bold text-sm">{{ $o->isFree() ? 'Gratis' : 'Rp '.number_format($o->amount, 0, ',', '.') }}</span>
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $o->statusClass() }}">{{ $o->statusLabel() }}</span>
                                <div class="flex items-center gap-1">
                                    <a href="{{ route('member.orders.show', $o) }}"
                                       class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-muted bg-stone hover:bg-line transition"
                                       title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                        <span class="hidden xs:inline">Detail</span>
                                    </a>
                                    <a href="{{ route('member.orders.invoice', $o) }}" target="_blank"
                                       class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-rust bg-primary-50 hover:bg-primary-100 transition"
                                       title="Invoice">
                                        <i class="fa-solid fa-file-invoice"></i>
                                        <span class="hidden xs:inline">Invoice</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="px-5 py-12 text-center text-muted">
                <i class="fa-regular fa-file-lines text-4xl mb-3 block"></i>
                <p class="text-sm">Belum ada pesanan. <a href="{{ route('member.packages') }}" class="text-rust font-semibold">Pilih paket sekarang</a>.</p>
            </div>
        @endif
    </div>

    @if ($orders->hasPages())
        <div class="mt-6">{{ $orders->links() }}</div>
    @endif
@endsection
