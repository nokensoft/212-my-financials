@extends('layouts.dashboard')

@section('page_title', $user->exists ? 'Edit Pengguna' : 'Tambah Pengguna')

@php($input = 'w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none')

@section('content')
    <form method="POST" action="{{ $user->exists ? route('dashboard.users.update', $user) : route('dashboard.users.store') }}"
        class="max-w-xl bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6 space-y-4">
        @csrf
        @if ($user->exists) @method('PUT') @endif

        <div>
            <label class="block text-sm font-semibold mb-1.5">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="{{ $input }}">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="{{ $input }}">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Peran <span class="text-red-500">*</span></label>
            <select name="role" class="{{ $input }}">
                <option value="operator" @selected(old('role', $user->role) === 'operator')>Operator — kelola blog & galeri</option>
                <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin — akses penuh</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Kata Sandi @unless ($user->exists) <span class="text-red-500">*</span> @endunless</label>
            <input type="password" name="password" @unless ($user->exists) required @endunless class="{{ $input }}"
                placeholder="{{ $user->exists ? 'Kosongkan bila tidak diubah' : '' }}">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" class="{{ $input }}">
        </div>

        <div class="flex gap-2 pt-2">
            <button type="submit" class="bg-primary text-white font-bold px-6 py-2.5 rounded-xl hover:bg-primary-700 transition">Simpan</button>
            <a href="{{ route('dashboard.users.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 font-semibold">Batal</a>
        </div>
    </form>
@endsection
