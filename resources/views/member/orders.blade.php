@extends('layouts.member')

@section('page_title', 'Pesanan Saya')

@section('content')
    <div class="flex items-center justify-between gap-3 mb-6">
        <h1 class="font-serif text-2xl font-semibold">Pesanan Saya</h1>
        <a href="{{ route('member.packages') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition"><i class="fa-solid fa-plus"></i> Pesan Paket</a>
    </div>

    <div class="bg-white rounded-2xl border border-line overflow-hidden">
        @if ($orders->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-stone text-muted text-left">
                        <tr>
                            <th class="px-5 py-3 font-semibold">Invoice</th>
                            <th class="px-5 py-3 font-semibold hidden sm:table-cell">Paket</th>
                            <th class="px-5 py-3 font-semibold">Jumlah</th>
                            <th class="px-5 py-3 font-semibold">Status</th>
                            <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($orders as $o)
                            <tr class="hover:bg-stone/60">
                                <td class="px-5 py-3">
                                    <p class="font-mono font-semibold text-xs">{{ $o->invoice_no }}</p>
                                    <p class="text-xs text-muted">{{ $o->created_at->locale('id')->translatedFormat('d M Y') }}</p>
                                    @if ($o->hasPaymentProof())
                                        <span class="inline-flex items-center gap-1 mt-0.5 text-[10px] font-semibold text-rust"><i class="fa-solid fa-paperclip"></i> Bukti transfer</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3 hidden sm:table-cell text-muted">{{ $o->package_name }}</td>
                                <td class="px-5 py-3 font-bold">Rp {{ number_format($o->amount, 0, ',', '.') }}</td>
                                <td class="px-5 py-3"><span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $o->statusClass() }}">{{ $o->statusLabel() }}</span></td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('member.orders.show', $o) }}" class="w-8 h-8 grid place-items-center rounded-lg text-muted hover:bg-stone" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('member.orders.invoice', $o) }}" target="_blank" class="w-8 h-8 grid place-items-center rounded-lg text-rust hover:bg-primary-50" title="Invoice"><i class="fa-solid fa-file-invoice"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-5 py-12 text-center text-muted">
                <i class="fa-regular fa-file-lines text-4xl mb-3"></i>
                <p class="text-sm">Belum ada pesanan.</p>
            </div>
        @endif
    </div>

    @if ($orders->hasPages())
        <div class="mt-6">{{ $orders->links() }}</div>
    @endif
@endsection
