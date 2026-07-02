@extends('layouts.app')

@php
    $photos = $album->photos->map(fn ($p) => ['src' => asset($p->image_path), 'caption' => $p->caption])->values();
    $cover = $album->cover_image ? asset($album->cover_image) : ($photos[0]['src'] ?? asset('images/myf/logo-my-financials.png'));
    $desc = $album->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($album->description), 160);
    $ld = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'ImageGallery',
                'name' => $album->title,
                'description' => $desc,
                'datePublished' => optional($album->published_at)->toIso8601String(),
                'url' => route('gallery.show', $album->slug),
                'image' => $photos->pluck('src')->all(),
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Galeri', 'item' => route('gallery.index')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $album->title, 'item' => route('gallery.show', $album->slug)],
                ],
            ],
        ],
    ];
@endphp

@section('page_title', $album->meta_title ?: $album->title)
@section('meta_description', $desc)
@section('canonical', route('gallery.show', $album->slug))
@section('og_type', 'article')
@section('og_image', $cover)

@push('head')
<script type="application/ld+json">@json($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <section class="pt-32 pb-16 px-6 bg-cream" x-data="albumGallery({{ \Illuminate\Support\Js::from($photos) }})">
        <div class="max-w-5xl mx-auto">
            <nav class="text-xs text-muted mb-4">
                <a href="{{ route('home') }}" class="hover:text-rust">Beranda</a> <span class="mx-1">/</span>
                <a href="{{ route('gallery.index') }}" class="hover:text-rust">Galeri</a> <span class="mx-1">/</span>
                <span class="text-ink">{{ \Illuminate\Support\Str::limit($album->title, 40) }}</span>
            </nav>

            <div class="flex flex-wrap gap-1.5 mb-4">
                @foreach ($album->categories as $cat)
                    <a href="{{ route('gallery.index', ['category' => $cat->slug]) }}"
                        class="bg-rust/[0.08] text-rust text-xs font-bold px-2.5 py-1 rounded-full hover:bg-rust/15 transition">{{ $cat->name }}</a>
                @endforeach
            </div>

            <h1 class="font-serif text-3xl md:text-4xl font-semibold leading-tight mb-3 text-ink">{{ $album->title }}</h1>
            <div class="flex items-center gap-4 text-sm text-muted mb-6">
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar"></i> {{ $album->published_human }}</span>
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-images"></i> {{ $photos->count() }} Foto</span>
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> {{ $album->views }}</span>
            </div>

            <div class="mb-8">
                @include('partials.share', ['url' => route('gallery.show', $album->slug), 'title' => $album->title])
            </div>

            @if ($album->description)
                <div class="article-content mb-8 max-w-3xl">{!! nl2br(e($album->description)) !!}</div>
            @endif

            @if ($photos->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach ($album->photos as $photo)
                        <button type="button" @click="openAt({{ $loop->index }})"
                            class="group aspect-square overflow-hidden rounded-xl border border-line bg-stone">
                            <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->caption ?: $album->title }}" loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </button>
                    @endforeach
                </div>
            @else
                <p class="text-muted py-10 text-center">Belum ada foto pada album ini.</p>
            @endif

            <div class="mt-10 pt-6 border-t border-line">
                <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 text-rust font-semibold hover:gap-3 transition-all">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Galeri
                </a>
            </div>
        </div>

        {{-- Lightbox --}}
        <div x-show="open" x-cloak @keydown.escape.window="close()" @keydown.arrow-right.window="next()" @keydown.arrow-left.window="prev()"
            class="fixed inset-0 z-[9999] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-ink/90" @click="close()"></div>
            <button @click="close()" class="absolute top-5 right-5 z-10 w-11 h-11 rounded-full bg-white/10 text-white grid place-items-center hover:bg-white/20"><i class="fa-solid fa-xmark text-xl"></i></button>
            <button @click="prev()" class="absolute left-4 z-10 w-11 h-11 rounded-full bg-white/10 text-white grid place-items-center hover:bg-white/20"><i class="fa-solid fa-chevron-left"></i></button>
            <button @click="next()" class="absolute right-4 z-10 w-11 h-11 rounded-full bg-white/10 text-white grid place-items-center hover:bg-white/20"><i class="fa-solid fa-chevron-right"></i></button>
            <div class="relative z-0 max-w-4xl w-full text-center">
                <img :src="current.src" :alt="current.caption" class="max-h-[80vh] w-auto mx-auto rounded-xl">
                <p x-show="current.caption" x-text="current.caption" class="text-white/80 text-sm mt-3"></p>
            </div>
        </div>
    </section>
@endsection

@push('head')
<script>
    function albumGallery(photos) {
        return {
            photos: photos,
            open: false,
            index: 0,
            openAt(i) { this.index = i; this.open = true; document.body.style.overflow = 'hidden'; },
            close() { this.open = false; document.body.style.overflow = ''; },
            next() { if (this.photos.length) this.index = (this.index + 1) % this.photos.length; },
            prev() { if (this.photos.length) this.index = (this.index - 1 + this.photos.length) % this.photos.length; },
            get current() { return this.photos[this.index] || { src: '', caption: '' }; },
        };
    }
</script>
@endpush
