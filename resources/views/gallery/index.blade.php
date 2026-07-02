@extends('layouts.app')

@section('page_title', 'Galeri & Album')
@section('meta_description', 'Dokumentasi kegiatan pelatihan, konsultasi, dan pendampingan keuangan UMKM oleh MY Financials di Tanah Papua.')

@section('content')
    <header class="pt-32 pb-10 px-6 bg-stone border-b border-line">
        <div class="max-w-7xl mx-auto">
            <nav class="text-xs text-muted mb-3">
                <a href="{{ route('home') }}" class="hover:text-rust">Beranda</a> <span class="mx-1">/</span> <span class="text-ink">Galeri</span>
            </nav>
            <h1 class="font-serif text-3xl md:text-4xl font-semibold text-ink">Galeri &amp; Album</h1>
            <p class="text-muted mt-2 max-w-2xl">Dokumentasi kegiatan pelatihan, pendampingan, dan kolaborasi MY Financials bersama UMKM di Tanah Papua.</p>
        </div>
    </header>

    <section class="py-10 px-6 bg-cream">
        <div class="max-w-7xl mx-auto">
            @include('partials.content-filters', ['action' => route('gallery.index'), 'categories' => $categories])

            <p class="text-sm text-muted mt-6 mb-4">Menampilkan {{ $albums->total() }} album.</p>

            @if ($albums->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($albums as $album)
                        <a href="{{ route('gallery.show', $album->slug) }}"
                            class="group bg-cream p-4 rounded-2xl border border-line hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(184,74,26,0.12)] transition-all duration-300">
                            <div class="aspect-[1.91/1] overflow-hidden rounded-xl border border-line bg-stone">
                                @if ($album->cover_image)
                                    <img src="{{ asset($album->cover_image) }}" alt="{{ $album->title }}" loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="flex flex-wrap gap-1 mt-4">
                                @foreach ($album->categories as $cat)
                                    <span class="bg-rust/[0.08] text-rust text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $cat->name }}</span>
                                @endforeach
                            </div>
                            <p class="mt-2 text-base font-bold leading-snug group-hover:text-rust transition-colors">{{ $album->title }}</p>
                            <div class="mt-3 pt-3 border-t border-line flex items-center justify-between text-xs text-muted font-medium">
                                <span class="flex items-center gap-1.5 bg-rust/[0.08] text-rust px-2.5 py-1 rounded-md text-[11px] font-bold">
                                    <i class="fa-regular fa-images"></i> {{ $album->photos_count }} Foto
                                </span>
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> {{ $album->views }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10">{{ $albums->links() }}</div>
            @else
                <div class="text-center py-20 text-muted">
                    <i class="fa-regular fa-images text-5xl mb-4"></i>
                    <p class="font-semibold">Tidak ada album yang cocok.</p>
                    <p class="text-sm">Coba ubah kata kunci atau filter Anda.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
