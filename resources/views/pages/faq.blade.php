@extends('layouts.app')

@php
    $faqs = config('faq.items');

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
    @include('partials.page-header', [
        'title' => 'FAQ — Tanya Jawab',
        'subtitle' => 'Pertanyaan yang sering diajukan seputar layanan MY Financials.',
        'width' => 'max-w-3xl',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'FAQ'],
        ],
    ])

    <section class="py-12 px-6 bg-cream">
        <div class="max-w-3xl mx-auto">
            @include('partials.faq', ['faqs' => $faqs])
        </div>
    </section>
@endsection
