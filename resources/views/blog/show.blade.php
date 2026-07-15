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

@push('head')
<style>
@media print {
    /* Sembunyikan semua elemen website */
    .dev-notice-bar, .topbar, #navbar, #mobileMenu,
    .fab-stack, footer, main > header, .no-print { display: none !important; }

    /* Bersihkan layout */
    *, *::before, *::after { box-shadow: none !important; }
    body { background: #fff !important; color: #1a1210 !important; font-size: 11pt; }
    main, article { padding: 0 !important; background: transparent !important; }
    .max-w-3xl { max-width: 100% !important; }
    .bg-cream, .bg-stone { background: transparent !important; }

    /* Elemen khusus cetak */
    .print-only { display: block !important; }

    /* Header brand cetak */
    .print-brand {
        display: flex !important;
        align-items: center;
        gap: 10pt;
        padding-bottom: 10pt;
        margin-bottom: 16pt;
        border-bottom: 2pt solid #b84a1a;
    }
    .print-brand img { height: 32pt; width: auto; }
    .print-brand-name { font-size: 14pt; font-weight: 700; color: #b84a1a; line-height: 1.2; }
    .print-brand-url  { font-size: 8pt; color: #7a6a62; }

    /* Judul & meta */
    h1 { font-size: 22pt !important; line-height: 1.25 !important; margin: 0 0 8pt !important; page-break-after: avoid; }
    .print-meta { font-size: 9pt; color: #7a6a62; margin-bottom: 14pt; }

    /* Foto cover */
    .print-cover { max-width: 100%; border-radius: 0 !important; margin-bottom: 16pt; page-break-inside: avoid; }

    /* Isi artikel */
    .article-content { font-size: 11pt; line-height: 1.75; }
    .article-content img { max-width: 100%; page-break-inside: avoid; }
    .article-content a { color: #b84a1a; text-decoration: underline; }

    /* Catatan sumber di bawah */
    .print-source {
        display: block !important;
        margin-top: 20pt;
        padding-top: 8pt;
        border-top: 1pt solid #e2d9d2;
        font-size: 8pt;
        color: #7a6a62;
    }
}
</style>
@endpush

@section('content')
    @include('partials.page-header', [
        'title' => 'Detail Blog',
        'width' => 'max-w-3xl',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Blog', 'url' => route('blog.index')],
            ['label' => 'Detail Blog'],
        ],
    ])

    <article class="py-12 px-6 bg-cream">
        <div class="max-w-3xl mx-auto">

            {{-- Brand header: hanya tampil saat cetak --}}
            <div class="print-only hidden print-brand">
                <img src="{{ asset('images/myf/logo-my-financials.png') }}" alt="MY Financials">
                <div>
                    <p class="print-brand-name">MY Financials</p>
                    <p class="print-brand-url">www.myfinancials.id &mdash; {{ url()->current() }}</p>
                </div>
            </div>

            <h1 class="font-serif text-3xl md:text-4xl font-semibold text-ink w-full mb-4">{{ $post->title }}</h1>
            <div class="flex flex-wrap items-center justify-between gap-3 mb-8 print-meta">
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($post->categories as $cat)
                        <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                            class="bg-rust/[0.08] text-rust text-xs font-bold px-2.5 py-1 rounded-full hover:bg-rust/15 transition no-print">{{ $cat->name }}</a>
                        <span class="print-only hidden text-xs font-semibold">{{ $cat->name }}</span>
                    @endforeach
                </div>
                <div class="flex items-center gap-4 text-sm text-muted">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar"></i> {{ $post->published_human }}</span>
                    <span class="flex items-center gap-1.5 no-print"><i class="fa-regular fa-eye"></i> {{ $post->views }} kali dilihat</span>
                </div>
            </div>

            @if ($post->cover_image)
                <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}"
                    class="print-cover w-full aspect-[4/3] rounded-2xl shadow-lg mb-8 object-cover">
            @endif

            <div class="article-content">
                {!! $post->body !!}
            </div>

            {{-- Catatan sumber: hanya saat cetak --}}
            <span class="print-source hidden">
                Sumber: {{ url()->current() }} &mdash; Dicetak {{ now()->locale('id')->translatedFormat('d F Y') }}
            </span>

            <div class="no-print mt-10 pt-6 border-t border-line">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[.05em] text-muted mb-3">Bagikan artikel ini</p>
                        @include('partials.share', ['url' => route('blog.show', $post->slug), 'title' => $post->title])
                    </div>
                    <button onclick="window.print()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-line bg-white text-sm font-semibold text-muted hover:text-rust hover:border-rust transition self-end shrink-0">
                        <i class="fa-solid fa-print"></i> Cetak
                    </button>
                </div>
            </div>

            <div class="no-print mt-6">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-rust font-semibold hover:gap-3 transition-all">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Blog
                </a>
            </div>
        </div>

        @if ($related->count())
            <div class="no-print max-w-7xl mx-auto mt-16">
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
