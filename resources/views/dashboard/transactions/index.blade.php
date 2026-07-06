@extends('layouts.dashboard')

@section('page_title', 'Kas & Transaksi')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-line p-5">
            <p class="text-muted text-sm">Total Pemasukan</p>
            <p class="text-2xl font-extrabold mt-2 text-primary">Rp {{ number_format($income, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-line p-5">
            <p class="text-muted text-sm">Total Pengeluaran</p>
            <p class="text-2xl font-extrabold mt-2 text-red-600">Rp {{ number_format($expense, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-line p-5">
            <p class="text-muted text-sm">Saldo</p>
            <p class="text-2xl font-extrabold mt-2 text-ink">Rp {{ number_format($income - $expense, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="flex items-center justify-between gap-3 mb-6">
        <p class="text-sm text-muted">Pemasukan dari invoice lunas tercatat otomatis. Tambahkan pengeluaran / pemasukan lain di sini.</p>
        <a href="{{ route('dashboard.transactions.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition shrink-0"><i class="fa-solid fa-plus"></i> Tambah Transaksi</a>
    </div>

    <div class="bg-white rounded-2xl border border-line overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-stone text-muted text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Tanggal</th>
                        <th class="px-5 py-3 font-semibold">Keterangan</th>
                        <th class="px-5 py-3 font-semibold hidden sm:table-cell">Kategori</th>
                        <th class="px-5 py-3 font-semibold text-right">Jumlah</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($transactions as $t)
                        <tr class="hover:bg-stone/60">
                            <td class="px-5 py-3 text-muted whitespace-nowrap">{{ $t->date->locale('id')->translatedFormat('d M Y') }}</td>
                            <td class="px-5 py-3">
                                <p class="font-semibold">{{ $t->description }}</p>
                                @if ($t->order)<p class="text-xs text-muted font-mono">{{ $t->order->invoice_no }}</p>@endif
                            </td>
                            <td class="px-5 py-3 hidden sm:table-cell text-muted">{{ $t->category ?? '—' }}</td>
                            <td class="px-5 py-3 text-right font-bold {{ $t->isIncome() ? 'text-primary' : 'text-red-600' }}">{{ $t->isIncome() ? '+' : '−' }} Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('dashboard.transactions.edit', $t) }}" class="w-8 h-8 grid place-items-center rounded-lg text-muted hover:bg-stone" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                    <form method="POST" action="{{ route('dashboard.transactions.destroy', $t) }}">
                                        @csrf @method('DELETE')
                                        <button type="button" title="Hapus"
                                            @click="$store.confirm.ask($el.closest('form'), { title: 'Hapus Transaksi', message: 'Transaksi ini akan dihapus permanen.', confirmText: 'Hapus' })"
                                            class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-muted">Belum ada transaksi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $transactions->links() }}</div>
@endsection
