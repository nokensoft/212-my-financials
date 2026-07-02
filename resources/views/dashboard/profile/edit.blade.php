@extends('layouts.dashboard')

@section('page_title', 'Profil')

@php($input = 'w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none')

@section('content')
    <div class="grid lg:grid-cols-2 gap-6 max-w-4xl">
        <form method="POST" action="{{ route('dashboard.profile.update') }}"
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6 space-y-4">
            @csrf @method('PUT')
            <h2 class="font-bold flex items-center gap-2"><i class="fa-solid fa-user text-primary"></i> Informasi Akun</h2>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="{{ $input }}">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="{{ $input }}">
            </div>
            <div class="text-xs text-slate-400">Peran: <span class="font-bold uppercase">{{ $user->role }}</span></div>
            <button type="submit" class="bg-primary text-white font-bold px-6 py-2.5 rounded-xl hover:bg-primary-700 transition">Simpan Profil</button>
        </form>

        <form method="POST" action="{{ route('dashboard.profile.password') }}"
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6 space-y-4">
            @csrf @method('PUT')
            <h2 class="font-bold flex items-center gap-2"><i class="fa-solid fa-lock text-primary"></i> Ubah Kata Sandi</h2>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Kata Sandi Saat Ini</label>
                <input type="password" name="current_password" required class="{{ $input }}">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Kata Sandi Baru</label>
                <input type="password" name="password" required class="{{ $input }}">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" required class="{{ $input }}">
            </div>
            <button type="submit" class="bg-primary text-white font-bold px-6 py-2.5 rounded-xl hover:bg-primary-700 transition">Ubah Kata Sandi</button>
        </form>
    </div>
@endsection
