@extends('layouts.member')

@section('page_title', 'Profil')

@php($input = 'w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-rust focus:border-rust outline-none')

@section('content')
    <h1 class="font-serif text-2xl font-semibold mb-6">Profil Saya</h1>

    <form method="POST" action="{{ route('member.profile.update') }}" class="max-w-2xl bg-white rounded-2xl border border-line p-6 space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-semibold mb-1.5">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $member->name) }}" class="{{ $input }}" required>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Nomor HP</label>
                <input type="tel" name="phone" value="{{ old('phone', $member->phone) }}" class="{{ $input }}" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Email <span class="text-muted font-normal">(opsional)</span></label>
                <input type="email" name="email" value="{{ old('email', $member->email) }}" class="{{ $input }}">
            </div>
        </div>

        <div class="pt-4 border-t border-line">
            <p class="text-sm font-bold mb-3">Ubah Kata Sandi <span class="text-muted font-normal">(kosongkan bila tidak diubah)</span></p>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" class="{{ $input }}" autocomplete="current-password">
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1.5">Kata Sandi Baru</label>
                        <input type="password" name="password" class="{{ $input }}" autocomplete="new-password">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1.5">Ulangi Kata Sandi</label>
                        <input type="password" name="password_confirmation" class="{{ $input }}" autocomplete="new-password">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
        </div>
    </form>
@endsection
