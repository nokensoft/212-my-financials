@extends('layouts.app')

@section('page_title', 'Hubungi Kami')
@section('meta_description', 'Hubungi MY Financials — mitra keuangan bagi pelaku usaha, organisasi, dan individu di Papua. WhatsApp, email, dan formulir untuk konsultasi, pelatihan, dan kemitraan.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Hubungi Kami',
        'subtitle' => 'Mari berkolaborasi mendampingi perjalanan keuangan pribadi atau usaha Anda.',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Hubungi Kami'],
        ],
    ])

    {{-- ── KONTAK ── --}}
    <section id="kontak" class="section bg-stone">
        <div class="section-inner grid grid-cols-1 navmenu:grid-cols-2 gap-10 navmenu:gap-16 items-start">
            <div>
                <p class="text-muted text-[.95rem] leading-[1.75] mb-8">
                    Ingin meningkatkan literasi keuangan bisnis Anda atau mengundang MY Financials sebagai mitra pelatihan?
                    Kami siap hadir untuk mendampingi perjalanan UMKM Anda.
                </p>
                <div class="section-divider !mx-0"></div>
                <div class="flex flex-col gap-5">
                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div><strong>Alamat</strong><span>Sentani, Kab. Jayapura — Papua, Indonesia</span></div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="fa-solid fa-phone"></i></div>
                        <div><strong>Telepon / WhatsApp</strong><a href="tel:+6282190902163">+62 821 9090 2163</a></div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div><strong>Email</strong><a href="mailto:msy.financials@outlook.com">msy.financials@outlook.com</a></div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="fa-brands fa-instagram"></i></div>
                        <div><strong>Instagram</strong><a href="https://instagram.com/my.financials" target="_blank" rel="noopener noreferrer">@my.financials</a></div>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-2xl border border-line shadow-sm">
                <div class="flex items-center gap-2 bg-cream px-5 py-3.5 border-b border-line">
                    <i class="fa-solid fa-location-dot text-rust text-sm"></i>
                    <span class="text-[.82rem] font-bold uppercase tracking-[.06em] text-muted">Lokasi Kami — Sentani, Papua</span>
                </div>

                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6331497.008581948!2d134.57542910136377!3d-2.6970823135789623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1784123331254!5m2!1sid!2sid" 
                    width="100%" 
                    height="430" 
                    style="border:0; display:block;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="strict-origin-when-cross-origin"
                    title="Lokasi MY Financials — Sentani, Kab. Jayapura, Papua"
                    ></iframe>

                <div class="bg-cream px-5 py-3 flex items-center gap-2">
                    <i class="fa-solid fa-map-pin text-rust text-xs"></i>
                    {{-- <span class="text-[.8rem] text-muted">Sentani, Kab. Jayapura — Papua, Indonesia</span> --}}
                    <span class="text-[.8rem] text-muted">Titik koordinat akan dibaharui</span>
                </div>
            </div>
        </div>
    </section>
@endsection
