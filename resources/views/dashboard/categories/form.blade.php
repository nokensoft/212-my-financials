@extends('layouts.dashboard')

@section('page_title', $category->exists ? 'Edit Kategori' : 'Tambah Kategori')

@php($input = 'w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none')

@section('content')
    <form method="POST" action="{{ $category->exists ? route('dashboard.categories.update', $category) : route('dashboard.categories.store') }}"
        class="max-w-xl bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6 space-y-4">
        @csrf
        @if ($category->exists) @method('PUT') @endif

        <div>
            <label class="block text-sm font-semibold mb-1.5">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="{{ $input }}">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" placeholder="Otomatis dari nama bila dikosongkan" class="{{ $input }}">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" class="{{ $input }}">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="flex gap-2 pt-2">
            <button type="submit" class="bg-primary text-white font-bold px-6 py-2.5 rounded-xl hover:bg-primary-700 transition">Simpan</button>
            <a href="{{ route('dashboard.categories.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 font-semibold">Batal</a>
        </div>
    </form>
@endsection
