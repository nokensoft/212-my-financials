@extends('layouts.dashboard')

@section('page_title', $package ? 'Ubah Paket' : 'Tambah Paket')

@php($input = 'w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-rust focus:border-rust outline-none')

@section('content')
    <a href="{{ route('dashboard.packages.index') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar paket</a>

    @include('partials.sim-badge', ['note' => 'Form ini simulasi — data tidak akan disimpan.'])

    <form onsubmit="return false" class="max-w-2xl bg-white rounded-2xl border border-line p-6 space-y-5">
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Kode Paket</label>
                <input type="text" class="{{ $input }}" value="{{ $package['code'] ?? '' }}" placeholder="mis. PKT-07">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Tingkat / Tier</label>
                <input type="text" class="{{ $input }}" value="{{ $package['tier'] ?? '' }}" placeholder="mis. Paket Bisnis">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Nama Paket</label>
            <input type="text" class="{{ $input }}" value="{{ $package['name'] ?? '' }}" placeholder="mis. Keuangan UMKM">
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Harga (Rp)</label>
                <input type="number" class="{{ $input }}" value="{{ $package['price'] ?? '' }}" placeholder="750000">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Durasi</label>
                <input type="text" class="{{ $input }}" value="{{ $package['duration'] ?? '' }}" placeholder="mis. 120 menit">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Deskripsi</label>
            <textarea rows="3" class="{{ $input }}" placeholder="Deskripsi singkat paket...">{{ $package['description'] ?? '' }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Status</label>
            <select class="{{ $input }}">
                <option value="aktif" @selected(($package['status'] ?? 'aktif') === 'aktif')>Aktif</option>
                <option value="nonaktif" @selected(($package['status'] ?? '') === 'nonaktif')>Nonaktif</option>
            </select>
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-floppy-disk"></i> Simpan (simulasi)</button>
            <a href="{{ route('dashboard.packages.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-stone text-muted text-sm font-semibold hover:bg-line transition">Batal</a>
        </div>
    </form>
@endsection
