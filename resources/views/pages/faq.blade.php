@extends('layouts.app')

@php
    $faqs = [
        ['Apa itu MY Financials?', 'MY Financials adalah mitra keuangan terpercaya untuk UMKM di Papua yang menyediakan pelatihan literasi keuangan, konsultasi & pendampingan, serta set-up pembukuan usaha yang praktis dan mudah dipahami.'],
        ['Layanan apa saja yang tersedia?', 'Kami menyediakan Program Pelatihan, Konsultasi & Pendampingan keuangan, serta Set-up Pembukuan. Tersedia juga paket Layanan Eksklusif konsultasi 1-on-1 bersama Perencana Keuangan Bersertifikat (CFP).'],
        ['Bagaimana cara memesan paket Layanan Eksklusif?', 'Anda dapat menghubungi kami melalui WhatsApp di +62 821 9090 2163, atau masuk ke area member untuk memilih paket dan mengamankan jadwal konsultasi.'],
        ['Di mana lokasi MY Financials?', 'Kami berkedudukan di Sentani, Kabupaten Jayapura, Papua, dan melayani klien UMKM di Jayapura, Bali, serta berbagai wilayah lain.'],
        ['Apakah tersedia sesi konsultasi gratis?', 'Ya. Kami menyediakan sesi Konsultasi Gratis 30 Menit untuk membantu Anda menentukan paket yang paling sesuai dengan kebutuhan.'],
    ];

    $faqLd = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => collect($faqs)->map(fn ($f) => [
            '@type' => 'Question',
            'name' => $f[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
        ])->all(),
    ];
@endphp

@section('page_title', 'FAQ')
@section('meta_description', 'Pertanyaan yang sering diajukan seputar layanan keuangan MY Financials untuk UMKM di Papua.')

@push('head')
<script type="application/ld+json">@json($faqLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <header class="pt-32 pb-8 px-6 bg-stone border-b border-line">
        <div class="max-w-3xl mx-auto">
            <h1 class="font-serif text-3xl md:text-4xl font-semibold text-ink">FAQ — Tanya Jawab</h1>
            <p class="text-muted mt-2">Pertanyaan yang sering diajukan seputar layanan MY Financials.</p>
        </div>
    </header>

    <section class="py-12 px-6 bg-cream">
        <div class="max-w-3xl mx-auto space-y-3">
            @foreach ($faqs as $i => $faq)
                <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }"
                    class="bg-cream border border-line rounded-2xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between gap-4 p-5 text-left font-bold">
                        <span>{{ $faq[0] }}</span>
                        <i class="fa-solid fa-chevron-down text-rust transition-transform" :class="open && 'rotate-180'"></i>
                    </button>
                    <div x-show="open" x-cloak x-transition class="px-5 pb-5 text-muted leading-relaxed">
                        {{ $faq[1] }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
