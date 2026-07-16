@extends('layouts.dashboard')

@section('page_title', $post->exists ? 'Edit Artikel' : 'Tulis Artikel')

@php
    $input = 'w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none';
    $selectedCats = collect(old('categories', $post->categories->pluck('id')->all()));
@endphp

@section('content')
    <form method="POST" action="{{ $post->exists ? route('dashboard.posts.update', $post) : route('dashboard.posts.store') }}"
        enctype="multipart/form-data" class="grid lg:grid-cols-3 gap-6">
        @csrf
        @if ($post->exists) @method('PUT') @endif

        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5 space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="{{ $input }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Ringkasan</label>
                    <textarea name="excerpt" rows="2" class="{{ $input }}" placeholder="Ringkasan singkat untuk kartu & SEO">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Konten</label>
                    <textarea name="body" class="tinymce">{{ old('body', $post->body) }}</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-5">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5 space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Status</label>
                    <select name="status" class="{{ $input }}">
                        <option value="draft" @selected(old('status', $post->status) === 'draft')>Draf</option>
                        <option value="published" @selected(old('status', $post->status) === 'published')>Terbit</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at"
                        value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}" class="{{ $input }}">
                    <p class="text-xs text-slate-400 mt-1">Kosongkan untuk memakai waktu saat ini ketika diterbitkan.</p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5">
                <label class="block text-sm font-semibold mb-2">Gambar Sampul</label>
                @include('dashboard.partials.cover-field', ['current' => $post->cover_image])
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
                        <p class="text-xs text-slate-400">Belum ada kategori. <a href="{{ route('dashboard.categories.create') }}" class="text-primary">Buat kategori</a>.</p>
                    @endforelse
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-primary text-white font-bold py-2.5 rounded-xl hover:bg-primary-700 transition">Simpan</button>
                <a href="{{ route('dashboard.posts.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 font-semibold">Batal</a>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script src="{{ asset('tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    (function () {
        const dark = document.documentElement.classList.contains('dark');
        tinymce.init({
            selector: 'textarea.tinymce',
            license_key: 'gpl',
            height: 460,
            menubar: false,
            branding: false,
            promotion: false,
            convert_urls: false,
            plugins: 'lists link image table code autolink wordcount media',
            toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image media table | alignleft aligncenter alignright | code',
            skin: dark ? 'oxide-dark' : 'oxide',
            content_css: dark ? 'dark' : 'default',
            images_upload_handler: (blobInfo) => new Promise((resolve, reject) => {
                const fd = new FormData();
                fd.append('file', blobInfo.blob(), blobInfo.filename());
                fetch('{{ route('dashboard.media.upload') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json',
                    },
                    body: fd,
                })
                    .then((r) => r.json())
                    .then((j) => j.location ? resolve(j.location) : reject('Upload gagal'))
                    .catch(() => reject('Upload gagal'));
            }),
        });
    })();
</script>
@endpush
