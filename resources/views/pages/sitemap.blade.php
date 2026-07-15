@extends('layouts.app')

@section('page_title', 'Peta Situs')
@section('meta_description', 'Peta situs MY Financials — daftar seluruh halaman, artikel, dan album.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Peta Situs',
        'subtitle' => 'Daftar seluruh halaman utama, artikel, dan album di situs ini.',
        'width' => 'max-w-5xl',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Peta Situs'],
        ],
    ])

    <section class="py-12 px-6 bg-cream">
        <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-10">
            <div>
                <h2 class="font-bold text-lg mb-4 flex items-center gap-2"><i class="fa-solid fa-compass text-rust"></i> Halaman</h2>
                <ul class="space-y-2 text-muted">
                    <li><a href="{{ route('home') }}" class="hover:text-rust">Beranda</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-rust">Layanan</a></li>
                    <li><a href="{{ route('home') }}#eksklusif" class="hover:text-rust">Layanan Eksklusif</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-rust">Blog</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-rust">Galeri</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="hover:text-rust">FAQ</a></li>
                    <li><a href="{{ route('pages.privacy') }}" class="hover:text-rust">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div>
                <h2 class="font-bold text-lg mb-4 flex items-center gap-2"><i class="fa-solid fa-newspaper text-rust"></i> Artikel</h2>
                <ul class="space-y-2 text-muted">
                    @forelse ($posts as $post)
                        <li><a href="{{ route('blog.show', $post->slug) }}" class="hover:text-rust line-clamp-1">{{ $post->title }}</a></li>
                    @empty
                        <li class="text-muted/70 text-sm">Belum ada artikel.</li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h2 class="font-bold text-lg mb-4 flex items-center gap-2"><i class="fa-solid fa-images text-rust"></i> Album</h2>
                <ul class="space-y-2 text-muted">
                    @forelse ($albums as $album)
                        <li><a href="{{ route('gallery.show', $album->slug) }}" class="hover:text-rust line-clamp-1">{{ $album->title }}</a></li>
                    @empty
                        <li class="text-muted/70 text-sm">Belum ada album.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>
@endsection
