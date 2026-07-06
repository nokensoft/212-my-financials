@extends('layouts.dashboard')

@section('page_title', $package->exists ? 'Ubah Paket' : 'Tambah Paket')

@php($input = 'w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-rust focus:border-rust outline-none')

@section('content')
    <a href="{{ route('dashboard.packages.index') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar paket</a>

    <form method="POST" action="{{ $package->exists ? route('dashboard.packages.update', $package) : route('dashboard.packages.store') }}" class="max-w-2xl bg-white rounded-2xl border border-line p-6 space-y-5">
        @csrf
        @if ($package->exists) @method('PUT') @endif
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Kode Paket</label>
                <input type="text" name="code" value="{{ old('code', $package->code) }}" class="{{ $input }}" placeholder="mis. PKT-07" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Tingkat / Tier</label>
                <input type="text" name="tier" value="{{ old('tier', $package->tier) }}" class="{{ $input }}" placeholder="mis. Paket Bisnis">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Nama Paket</label>
            <input type="text" name="name" value="{{ old('name', $package->name) }}" class="{{ $input }}" required>
        </div>
        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $package->price ?? 0) }}" class="{{ $input }}" min="0" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Durasi</label>
                <input type="text" name="duration" value="{{ old('duration', $package->duration) }}" class="{{ $input }}" placeholder="mis. 120 menit">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Urutan</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $package->sort_order ?? 0) }}" class="{{ $input }}" min="0">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" class="{{ $input }}">{{ old('description', $package->description) }}</textarea>
        </div>
        <label class="flex items-center gap-2 text-sm">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $package->is_active ?? true)) class="rounded border-line text-rust focus:ring-rust">
            Paket aktif (tampil di area member)
        </label>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            <a href="{{ route('dashboard.packages.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-stone text-muted text-sm font-semibold hover:bg-line transition">Batal</a>
        </div>
    </form>
@endsection
