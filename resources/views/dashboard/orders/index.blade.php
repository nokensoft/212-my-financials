@extends('layouts.dashboard')

@section('page_title', 'Pemesanan')

@php($statuses = \App\Models\Order::statuses())

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('dashboard.orders.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold {{ request('status') ? 'bg-white border border-line text-muted' : 'bg-rust text-white' }}">Semua ({{ $orders->total() }})</a>
            @foreach ($statuses as $key => $s)
                <a href="{{ route('dashboard.orders.index', ['status' => $key]) }}" class="px-4 py-2 rounded-full text-sm font-semibold {{ request('status') === $key ? 'bg-rust text-white' : 'bg-white border border-line text-muted' }}">{{ $s['label'] }} ({{ $counts[$key] ?? 0 }})</a>
            @endforeach
        </div>
        <a href="{{ route('dashboard.orders.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition shrink-0"><i class="fa-solid fa-plus"></i> Buat Pemesanan</a>
    </div>

    <div class="bg-white rounded-2xl border border-line overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-stone text-muted text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Invoice</th>
                        <th class="px-5 py-3 font-semibold">Member</th>
                        <th class="px-5 py-3 font-semibold hidden md:table-cell">Paket</th>
                        <th class="px-5 py-3 font-semibold">Jumlah</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($orders as $o)
                        <tr class="hover:bg-stone/60">
                            <td class="px-5 py-3">
                                <p class="font-mono font-semibold text-xs">{{ $o->invoice_no }}</p>
                                <p class="text-xs text-muted">{{ $o->created_at->locale('id')->translatedFormat('d M Y') }}</p>
                                @if ($o->hasPaymentProof())
                                    <span class="inline-flex items-center gap-1 mt-0.5 text-[10px] font-semibold text-primary-700"><i class="fa-solid fa-paperclip"></i> Bukti transfer</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <p class="font-semibold">{{ $o->member?->name ?? '—' }}</p>
                                <p class="text-xs text-muted">{{ $o->member?->phone }}</p>
                            </td>
                            <td class="px-5 py-3 hidden md:table-cell text-muted">{{ $o->package_name }}</td>
                            <td class="px-5 py-3 font-bold">Rp {{ number_format($o->amount, 0, ',', '.') }}</td>
                            <td class="px-5 py-3"><span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $o->statusClass() }}">{{ $o->statusLabel() }}</span></td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('dashboard.orders.show', $o) }}" class="w-8 h-8 grid place-items-center rounded-lg text-muted hover:bg-stone" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('dashboard.orders.invoice', $o) }}" target="_blank" class="w-8 h-8 grid place-items-center rounded-lg text-rust hover:bg-primary-50" title="Invoice"><i class="fa-solid fa-file-invoice"></i></a>
                                    <form method="POST" action="{{ route('dashboard.orders.destroy', $o) }}">
                                        @csrf @method('DELETE')
                                        <button type="button" title="Hapus"
                                            @click="$store.confirm.ask($el.closest('form'), { title: 'Hapus Pemesanan', message: 'Pemesanan ini akan dihapus permanen.', confirmText: 'Hapus' })"
                                            class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-12 text-center text-muted">Belum ada pemesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
@endsection
