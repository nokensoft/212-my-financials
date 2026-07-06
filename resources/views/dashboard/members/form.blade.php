@extends('layouts.dashboard')

@section('page_title', $member->exists ? 'Ubah Member' : 'Tambah Member')

@php($input = 'w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-rust focus:border-rust outline-none')
@php($statuses = \App\Models\Member::statuses())

@section('content')
    <a href="{{ route('dashboard.members.index') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar member</a>

    <form method="POST" action="{{ $member->exists ? route('dashboard.members.update', $member) : route('dashboard.members.store') }}" class="max-w-2xl bg-white rounded-2xl border border-line p-6 space-y-5">
        @csrf
        @if ($member->exists) @method('PUT') @endif
        <div>
            <label class="block text-sm font-semibold mb-1.5">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $member->name) }}" class="{{ $input }}" required>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Nomor HP</label>
                <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" class="{{ $input }}" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Email <span class="text-muted font-normal">(opsional)</span></label>
                <input type="email" name="email" value="{{ old('email', $member->email) }}" class="{{ $input }}">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Status</label>
                <select name="status" class="{{ $input }}">
                    @foreach ($statuses as $key => $s)
                        <option value="{{ $key }}" @selected(old('status', $member->status) === $key)>{{ $s['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Kata Sandi @if ($member->exists)<span class="text-muted font-normal">(kosongkan bila tidak diubah)</span>@endif</label>
                <input type="password" name="password" class="{{ $input }}" autocomplete="new-password">
            </div>
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            <a href="{{ route('dashboard.members.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-stone text-muted text-sm font-semibold hover:bg-line transition">Batal</a>
        </div>
    </form>
@endsection
