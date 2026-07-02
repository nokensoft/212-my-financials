@extends('layouts.dashboard')

@section('page_title', $album->exists ? 'Edit Album' : 'Buat Album')

@php
    $input = 'w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none';
    $selectedCats = collect(old('categories', $album->categories->pluck('id')->all()));
@endphp

@section('content')
    <form method="POST" action="{{ $album->exists ? route('dashboard.albums.update', $album) : route('dashboard.albums.store') }}"
        enctype="multipart/form-data" class="grid lg:grid-cols-3 gap-6">
        @csrf
        @if ($album->exists) @method('PUT') @endif

        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5 space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $album->title) }}" required class="{{ $input }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $album->slug) }}" placeholder="Otomatis dari judul bila dikosongkan" class="{{ $input }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Deskripsi</label>
                    <textarea name="description" rows="4" class="{{ $input }}">{{ old('description', $album->description) }}</textarea>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5 space-y-4">
                <h3 class="font-bold text-sm flex items-center gap-2"><i class="fa-solid fa-magnifying-glass-chart text-primary"></i> SEO (Opsional)</h3>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $album->meta_title) }}" class="{{ $input }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Meta Description</label>
                    <textarea name="meta_description" rows="2" maxlength="500" class="{{ $input }}">{{ old('meta_description', $album->meta_description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-5">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5 space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Status</label>
                    <select name="status" class="{{ $input }}">
                        <option value="draft" @selected(old('status', $album->status) === 'draft')>Draf</option>
                        <option value="published" @selected(old('status', $album->status) === 'published')>Terbit</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at"
                        value="{{ old('published_at', optional($album->published_at)->format('Y-m-d\TH:i')) }}" class="{{ $input }}">
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5">
                <label class="block text-sm font-semibold mb-2">Gambar Sampul</label>
                @unless ($album->cover_image)
                    <p class="text-xs text-slate-400 mb-2">Bila kosong, foto pertama akan dijadikan sampul otomatis.</p>
                @endunless
                @include('dashboard.partials.cover-field', ['current' => $album->cover_image])
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5">
                <label class="block text-sm font-semibold mb-2">Kategori</label>
                <div class="max-h-52 overflow-y-auto space-y-1.5 pr-1">
                    @forelse ($categories as $cat)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="categories[]" value="{{ $cat->id }}" @checked($selectedCats->contains($cat->id))
                                class="rounded text-primary focus:ring-primary">
                            {{ $cat->name }}
                        </label>
                    @empty
                        <p class="text-xs text-slate-400">Belum ada kategori.</p>
                    @endforelse
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-primary text-white font-bold py-2.5 rounded-xl hover:bg-primary-700 transition">Simpan</button>
                <a href="{{ route('dashboard.albums.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 font-semibold">Batal</a>
            </div>
        </div>
    </form>

    @if ($album->exists)
        <div class="mt-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5">
            <h3 class="font-bold mb-4 flex items-center gap-2"><i class="fa-solid fa-images text-primary"></i> Foto Album ({{ $album->photos->count() }})</h3>

            <form method="POST" action="{{ route('dashboard.albums.photos.store', $album) }}" enctype="multipart/form-data"
                class="flex flex-col sm:flex-row gap-2 mb-6">
                @csrf
                <input type="file" name="images[]" multiple accept="image/*" required
                    class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-800 file:text-white file:text-sm file:font-semibold">
                <button type="submit" class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-upload"></i> Unggah Foto</button>
            </form>

            @if ($album->photos->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach ($album->photos as $photo)
                        <div class="relative group aspect-square rounded-xl overflow-hidden border border-slate-200 dark:border-white/10">
                            <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->caption }}" class="w-full h-full object-cover">
                            <form method="POST" action="{{ route('dashboard.albums.photos.destroy', [$album, $photo]) }}"
                                class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                @csrf @method('DELETE')
                                <button type="button"
                                    @click="$store.confirm.ask($el.closest('form'), { title: 'Hapus Foto', message: 'Foto ini akan dihapus permanen dari album.', confirmText: 'Hapus' })"
                                    class="w-8 h-8 grid place-items-center rounded-lg bg-red-600 text-white hover:bg-red-700"><i class="fa-solid fa-trash text-xs"></i></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-400 text-center py-6">Belum ada foto. Unggah foto pertama Anda.</p>
            @endif
        </div>
    @endif
@endsection
