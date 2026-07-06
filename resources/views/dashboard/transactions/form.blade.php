@extends('layouts.dashboard')

@section('page_title', $transaction->exists ? 'Ubah Transaksi' : 'Tambah Transaksi')

@php($input = 'w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-rust focus:border-rust outline-none')

@section('content')
    <a href="{{ route('dashboard.transactions.index') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Kas & Transaksi</a>

    <form method="POST" action="{{ $transaction->exists ? route('dashboard.transactions.update', $transaction) : route('dashboard.transactions.store') }}" class="max-w-2xl bg-white rounded-2xl border border-line p-6 space-y-5">
        @csrf
        @if ($transaction->exists) @method('PUT') @endif
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Tanggal</label>
                <input type="date" name="date" value="{{ old('date', optional($transaction->date)->format('Y-m-d')) }}" class="{{ $input }}" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Jenis</label>
                <select name="type" class="{{ $input }}">
                    <option value="pengeluaran" @selected(old('type', $transaction->type) === 'pengeluaran')>Pengeluaran</option>
                    <option value="pemasukan" @selected(old('type', $transaction->type) === 'pemasukan')>Pemasukan</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Keterangan</label>
            <input type="text" name="description" value="{{ old('description', $transaction->description) }}" class="{{ $input }}" required>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Kategori <span class="text-muted font-normal">(opsional)</span></label>
                <input type="text" name="category" value="{{ old('category', $transaction->category) }}" class="{{ $input }}" placeholder="mis. Operasional">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Jumlah (Rp)</label>
                <input type="number" name="amount" value="{{ old('amount', $transaction->amount) }}" class="{{ $input }}" min="0" required>
            </div>
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            <a href="{{ route('dashboard.transactions.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-stone text-muted text-sm font-semibold hover:bg-line transition">Batal</a>
        </div>
    </form>
@endsection
