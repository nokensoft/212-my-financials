@extends('layouts.app')

@section('page_title', 'Beranda')
@section('meta_description', 'MY Financials — Jasa Perencanaan Keuangan: Konsultasi, Pelatihan & Pendampingan bagi pelaku usaha, organisasi, dan individu di Papua. Literasi keuangan & set-up pembukuan yang praktis dan mudah dipahami.')

@php
    $serviceLd = [
        '@context' => 'https://schema.org',
        '@type' => 'FinancialService',
        'name' => 'MY Financials',
        'description' => 'Mitra keuangan terpercaya bagi pelaku usaha, organisasi, dan individu di Papua — pelatihan literasi keuangan, konsultasi & pendampingan, serta set-up pembukuan.',
        'image' => asset('images/myf/1.jpg'),
        'logo' => asset('images/myf/logo-my-financials.png'),
        'email' => 'msy.financials@outlook.com',
        'telephone' => '+62-821-9090-2163',
        'url' => route('home'),
        'areaServed' => 'Papua, Indonesia',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Sentani',
            'addressRegion' => 'Kabupaten Jayapura, Papua',
            'addressCountry' => 'ID',
        ],
        'sameAs' => ['https://instagram.com/my.financials'],
    ];
@endphp

@push('head')
<script type="application/ld+json">@json($serviceLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')

{{-- ── HERO ── --}}
<section id="beranda" class="relative min-h-screen flex items-center justify-center text-center overflow-hidden bg-ink">
    <div class="hero-slider" aria-hidden="true">
        <div class="hero-slide active" style="background-image:url('{{ asset('images/myf/1.jpg') }}')"></div>
        <div class="hero-slide" style="background-image:url('{{ asset('images/myf/2.jpg') }}')"></div>
        <div class="hero-slide" style="background-image:url('{{ asset('images/myf/3.jpg') }}')"></div>
        <div class="hero-slide" style="background-image:url('{{ asset('images/myf/4.jpg') }}')"></div>
        <div class="hero-slide" style="background-image:url('{{ asset('images/myf/5.jpg') }}')"></div>
    </div>
    <div class="hero-overlay" aria-hidden="true"></div>
    <div class="relative z-[2] max-w-[880px] mx-auto flex flex-col items-center px-6 pt-28 pb-20 max-[900px]:pt-[100px] max-[900px]:pb-16">
        <h1 class="hero-title text-7xl pt-6">
            MY Financials <br>
            <em class="text-3xl">Kelola Keuangan, Kelola Hidup.</em>
        </h1>
        <p class="text-white pb-6">Kami membantu Anda membangun sistem keuangan yang sehat agar dapat mengambil keputusan dengan percaya diri dan bertumbuh secara berkelanjutan.</p>
        <div class="flex gap-3 flex-wrap justify-center max-[480px]:flex-col max-[480px]:w-full">
            <a href="{{ route('pages.about.who') }}" class="btn-ghost justify-center max-[480px]:w-full"><i class="fa-solid fa-arrow-right"></i> Tentang Kami</a>
            <a href="#paket" class="btn-primary justify-center max-[480px]:w-full"><i class="fa-solid fa-circle-down"></i> Paket Layanan</a>
        </div>
        <div class="grid grid-cols-2 navmenu:grid-cols-4 gap-3.5 max-[480px]:gap-2.5 w-full mt-[52px]">
            <div class="highlight-box"><div class="highlight-icon"><i class="fa-solid fa-lightbulb"></i></div><span>Pemberdayaa & Edukasi</span></div>
            <div class="highlight-box"><div class="highlight-icon"><i class="fa-solid fa-map-location-dot"></i></div><span>Pendekatan Kontekstual Lokal</span></div>
            <div class="highlight-box"><div class="highlight-icon"><i class="fa-solid fa-venus"></i></div><span>Pemberdayaan Perempuan</span></div>
            <div class="highlight-box"><div class="highlight-icon"><i class="fa-solid fa-shield-halved"></i></div><span>Fokus Pada Keberlanjutan</span></div>
        </div>
    </div>
</section>

{{-- ── PAKET LAYANAN ── --}}
<section id="paket" class="section bg-rust relative overflow-hidden text-white">
    <div class="section-inner relative z-[1]">

        <h2 class="section-title text-white">Paket Layanan MY Financials</h2>
        <div class="section-divider bg-white/50"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse ($packages as $i => $paket)
                @php($free = $paket->price <= 0)
                <div class="{{ $free ? 'bg-white/20 backdrop-blur-md border-white/40 shadow-xl' : 'bg-white/10 backdrop-blur-sm border-white/10 hover:border-white/30' }} p-6 rounded-xl border transition duration-300 flex flex-col">
                    <div class="flex items-start gap-4">
                        <div class="{{ $free ? 'bg-white text-rust' : 'bg-white/20 text-white' }} font-bold w-10 h-10 rounded-lg flex items-center justify-center shrink-0">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div>
                            <h4 class="text-white font-semibold text-sm uppercase tracking-wider opacity-80">{{ $paket->tier }}</h4>
                            <p class="text-white text-lg font-medium mt-1">{{ $paket->name }}</p>
                            @if ($paket->description)
                                <p class="text-white/80 text-sm leading-relaxed mt-1.5">{{ $paket->description }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/15 flex items-center justify-between">
                        <span class="text-white font-bold">{{ $paket->price_label }}</span>
                        <a href="{{ auth('member')->check() ? route('member.orders.create', $paket) : route('member.login') }}" class="text-white/90 text-sm font-semibold hover:text-white">Pesan <i class="fa-solid fa-arrow-right text-xs"></i></a>
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-3 text-center text-white/80 py-8">Paket layanan segera hadir.</div>
            @endforelse
        </div>

        <div class="text-center flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/6282190902163?text=Halo%20MY%20Financials%2C%20saya%20ingin%20memesan%20paket%20Layanan."
               target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-3 bg-white text-rust font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all duration-200 group">
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Pilih Paket &amp; Amankan Jadwal</span>
                <i class="fa-solid fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
            </a>
            <a href="{{ auth('member')->check() ? route('member.packages') : route('member.login') }}"
               class="inline-flex items-center gap-3 border-[1.5px] border-white/50 text-white font-bold px-8 py-4 rounded-full hover:bg-white/10 transition">
                <i class="fa-solid fa-user"></i>
                <span>{{ auth('member')->check() ? 'Pesan dari Area Member' : 'Masuk Member untuk Memesan' }}</span>
            </a>
        </div>
    </div>
</section>


