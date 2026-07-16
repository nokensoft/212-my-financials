@extends('layouts.app')

@section('page_title', 'Blog & Artikel')
@section('meta_description', 'Kumpulan artikel, tips, dan kabar terbaru MY Financials seputar literasi keuangan, pembukuan, dan pemberdayaan pelaku usaha di Papua.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Blog & Artikel',
        'subtitle' => 'Tips praktis literasi keuangan, pembukuan usaha, dan kabar terbaru program pemberdayaan UMKM MY Financials.',
        'width' => 'max-w-7xl',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Blog'],
        ],
    ])

    <section class="py-10 px-6 bg-cream">
        <div class="max-w-7xl mx-auto">
            @include('partials.content-filters', ['action' => route('blog.index'), 'categories' => $categories])

            <p class="text-sm text-muted mt-6 mb-4">Menampilkan {{ $posts->total() }} artikel.</p>

            @if ($posts->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($posts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}"
                            class="group bg-cream rounded-2xl overflow-hidden border border-line hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(184,74,26,0.12)] transition-all duration-300 flex flex-col">
                            <div class="w-full aspect-[4/3] overflow-hidden bg-stone">
                                @if ($post->cover_image)
                                    <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" loading="lazy" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <div class="flex flex-wrap gap-1 mb-3">
                                    @foreach ($post->categories as $cat)
                                        <span class="bg-rust/[0.08] text-rust text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $cat->name }}</span>
                                    @endforeach
                                </div>
                                <h2 class="text-lg font-bold mb-2 line-clamp-2 group-hover:text-rust transition-colors">{{ $post->title }}</h2>
                                <p class="text-sm text-muted leading-relaxed line-clamp-3 flex-1">{{ $post->excerpt }}</p>
                                <div class="flex justify-between items-center pt-3 mt-3 border-t border-line text-xs text-muted font-medium">
                                    <span>{{ $post->published_human }}</span>
                                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> {{ $post->views }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10">{{ $posts->links() }}</div>
            @else
                <div class="text-center py-20 text-muted">
                    <i class="fa-regular fa-folder-open text-5xl mb-4"></i>
                    <p class="font-semibold">Tidak ada artikel yang cocok.</p>
                    <p class="text-sm">Coba ubah kata kunci atau filter Anda.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
