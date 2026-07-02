@extends('layouts.app')

@php
    $desc = $post->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->body), 160);
    $cover = $post->cover_image ? asset($post->cover_image) : asset('images/myf/logo-my-financials.png');
    $ld = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Article',
                'headline' => $post->title,
                'description' => $desc,
                'image' => $cover,
                'datePublished' => optional($post->published_at)->toIso8601String(),
                'dateModified' => optional($post->updated_at)->toIso8601String(),
                'author' => ['@type' => 'Organization', 'name' => config('app.name')],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => config('app.name'),
                    'logo' => ['@type' => 'ImageObject', 'url' => asset('images/myf/logo-my-financials.png')],
                ],
                'mainEntityOfPage' => route('blog.show', $post->slug),
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog.index')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => route('blog.show', $post->slug)],
                ],
            ],
        ],
    ];
@endphp

@section('page_title', $post->meta_title ?: $post->title)
@section('meta_description', $desc)
@section('canonical', route('blog.show', $post->slug))
@section('og_type', 'article')
@section('og_image', $cover)

@push('head')
<script type="application/ld+json">@json($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <article class="pt-32 pb-16 px-6 bg-cream">
        <div class="max-w-3xl mx-auto">
            <nav class="text-xs text-muted mb-4">
                <a href="{{ route('home') }}" class="hover:text-rust">Beranda</a> <span class="mx-1">/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-rust">Blog</a> <span class="mx-1">/</span>
                <span class="text-ink">{{ \Illuminate\Support\Str::limit($post->title, 40) }}</span>
            </nav>

            <div class="flex flex-wrap gap-1.5 mb-4">
                @foreach ($post->categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                        class="bg-rust/[0.08] text-rust text-xs font-bold px-2.5 py-1 rounded-full hover:bg-rust/15 transition">{{ $cat->name }}</a>
                @endforeach
            </div>

            <h1 class="font-serif text-3xl md:text-4xl font-semibold leading-tight mb-4 text-ink">{{ $post->title }}</h1>

            <div class="flex items-center gap-4 text-sm text-muted mb-8">
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar"></i> {{ $post->published_human }}</span>
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> {{ $post->views }} kali dilihat</span>
            </div>

            @if ($post->cover_image)
                <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}"
                    class="w-full rounded-2xl shadow-lg mb-8 object-cover">
            @endif

            <div class="article-content">
                {!! $post->body !!}
            </div>

            <div class="mt-8 pt-6 border-t border-line">
                @include('partials.share', ['url' => route('blog.show', $post->slug), 'title' => $post->title])
            </div>

            <div class="mt-6">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-rust font-semibold hover:gap-3 transition-all">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Blog
                </a>
            </div>
        </div>

        @if ($related->count())
            <div class="max-w-7xl mx-auto mt-16">
                <h2 class="font-serif text-2xl font-semibold mb-6 text-ink">Artikel Terkait</h2>
                <div class="grid sm:grid-cols-3 gap-6">
                    @foreach ($related as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}"
                            class="group bg-cream rounded-2xl overflow-hidden border border-line hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(184,74,26,0.12)] transition">
                            <div class="h-40 overflow-hidden bg-stone">
                                @if ($rel->cover_image)
                                    <img src="{{ asset($rel->cover_image) }}" alt="{{ $rel->title }}" loading="lazy"
                                        class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold line-clamp-2 group-hover:text-rust transition-colors">{{ $rel->title }}</h3>
                                <p class="text-xs text-muted mt-2">{{ $rel->published_human }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </article>
@endsection
