@extends('layouts.dashboard')

@section('page_title', 'Laporan Keuangan')

@php($maxMonthly = max(collect($monthly)->max('amount'), 1))

@section('content')
    @include('partials.sim-badge', ['note' => 'Laporan keuangan disimulasikan & terintegrasi dengan invoice pemesanan. Angka hanya contoh.'])

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-line p-5">
            <div class="flex items-center justify-between">
                <span class="text-muted text-sm font-medium">Pemasukan</span>
                <span class="w-9 h-9 rounded-xl bg-primary-50 text-primary grid place-items-center"><i class="fa-solid fa-arrow-down"></i></span>
            </div>
            <p class="text-2xl font-extrabold mt-3 text-primary">Rp {{ number_format($income, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-line p-5">
            <div class="flex items-center justify-between">
                <span class="text-muted text-sm font-medium">Pengeluaran</span>
                <span class="w-9 h-9 rounded-xl bg-red-50 text-red-600 grid place-items-center"><i class="fa-solid fa-arrow-up"></i></span>
            </div>
            <p class="text-2xl font-extrabold mt-3 text-red-600">Rp {{ number_format($expense, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-line p-5">
            <div class="flex items-center justify-between">
                <span class="text-muted text-sm font-medium">Laba Bersih</span>
                <span class="w-9 h-9 rounded-xl bg-primary-50 text-rust grid place-items-center"><i class="fa-solid fa-scale-balanced"></i></span>
            </div>
            <p class="text-2xl font-extrabold mt-3 text-ink">Rp {{ number_format($net, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        {{-- Grafik pendapatan bulanan --}}
        <div class="bg-white rounded-2xl border border-line p-6">
            <h3 class="font-bold mb-4">Pendapatan Bulanan</h3>
            <div class="flex items-end justify-between gap-2 h-44">
                @foreach ($monthly as $m)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full bg-rust/15 rounded-t-lg flex items-end" style="height: 140px">
                            <div class="w-full bg-rust rounded-t-lg" style="height: {{ round($m['amount'] / $maxMonthly * 100) }}%" title="Rp {{ number_format($m['amount'], 0, ',', '.') }}"></div>
                        </div>
                        <span class="text-[11px] font-semibold text-muted">{{ $m['month'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Buku transaksi --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-line overflow-hidden">
            <div class="p-5 border-b border-line flex items-center justify-between">
                <h3 class="font-bold">Transaksi (Terintegrasi Invoice)</h3>
                <button type="button" onclick="window.print()" class="no-print inline-flex items-center gap-2 text-sm text-rust font-semibold hover:text-rust-dark"><i class="fa-solid fa-print"></i> Cetak</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-stone text-muted text-left">
                        <tr>
                            <th class="px-5 py-3 font-semibold">Tanggal</th>
                            <th class="px-5 py-3 font-semibold">Ref</th>
                            <th class="px-5 py-3 font-semibold">Keterangan</th>
                            <th class="px-5 py-3 font-semibold text-right">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($entries as $e)
                            <tr>
                                <td class="px-5 py-3 text-muted whitespace-nowrap">{{ \Illuminate\Support\Carbon::parse($e['date'])->locale('id')->translatedFormat('d M Y') }}</td>
                                <td class="px-5 py-3 font-mono text-xs">{{ $e['ref'] }}</td>
                                <td class="px-5 py-3">{{ $e['description'] }}</td>
                                <td class="px-5 py-3 text-right font-bold {{ $e['type'] === 'pemasukan' ? 'text-primary' : 'text-red-600' }}">
                                    {{ $e['type'] === 'pemasukan' ? '+' : '−' }} Rp {{ number_format($e['amount'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-stone/60 font-bold">
                            <td class="px-5 py-3" colspan="3">Laba Bersih</td>
                            <td class="px-5 py-3 text-right text-ink">Rp {{ number_format($net, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
