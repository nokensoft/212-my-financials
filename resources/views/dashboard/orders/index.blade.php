@extends('layouts.dashboard')

@section('page_title', 'Pemesanan')

@section('content')
    @include('partials.sim-badge', ['note' => 'Simulasi alur pemesanan paket oleh member → verifikasi → cetak invoice. Data contoh, aksi hanya tampilan.'])

    <div class="flex flex-wrap items-center gap-2 mb-6">
        <span class="px-4 py-2 rounded-full bg-rust text-white text-sm font-semibold">Semua ({{ count($orders) }})</span>
        @foreach ($statuses as $key => $s)
            <span class="px-4 py-2 rounded-full bg-white border border-line text-sm font-semibold text-muted">{{ $s['label'] }} ({{ collect($orders)->where('status', $key)->count() }})</span>
        @endforeach
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
                    @foreach ($orders as $o)
                        <tr class="hover:bg-stone/60">
                            <td class="px-5 py-3">
                                <p class="font-mono font-semibold text-xs">{{ $o['invoice'] }}</p>
                                <p class="text-xs text-muted">{{ \Illuminate\Support\Carbon::parse($o['ordered_at'])->locale('id')->translatedFormat('d M Y') }}</p>
                            </td>
                            <td class="px-5 py-3">
                                <p class="font-semibold">{{ $o['member'] }}</p>
                                <p class="text-xs text-muted">{{ $o['phone'] }}</p>
                            </td>
                            <td class="px-5 py-3 hidden md:table-cell text-muted">{{ $o['package'] }}</td>
                            <td class="px-5 py-3 font-bold">Rp {{ number_format($o['amount'], 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $statuses[$o['status']]['class'] }}">{{ $statuses[$o['status']]['label'] }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('dashboard.orders.show', $o['id']) }}" class="w-8 h-8 grid place-items-center rounded-lg text-muted hover:bg-stone" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('dashboard.orders.invoice', $o['id']) }}" target="_blank" class="w-8 h-8 grid place-items-center rounded-lg text-rust hover:bg-primary-50" title="Invoice"><i class="fa-solid fa-file-invoice"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
