@extends('layouts.app')

@section('page_title', 'Hubungi Kami')
@section('meta_description', 'Hubungi MY Financials — mitra keuangan UMKM di Papua. WhatsApp, email, dan formulir untuk konsultasi, pelatihan, dan kemitraan.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Hubungi Kami',
        'subtitle' => 'Mari berkolaborasi mendampingi perjalanan UMKM Anda.',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Hubungi Kami'],
        ],
    ])

    {{-- ── KONTAK ── --}}
    <section id="kontak" class="section bg-stone">
        <div class="section-inner grid grid-cols-1 navmenu:grid-cols-2 gap-10 navmenu:gap-16 items-start">
            <div>
                <span class="section-label !text-left">Hubungi Kami</span>
                <h2 class="section-title !text-left">Mari Berkolaborasi</h2>
                <div class="section-divider !mx-0"></div>
                <p class="text-muted text-[.95rem] leading-[1.75] mb-8">
                    Ingin meningkatkan literasi keuangan bisnis Anda atau mengundang MY Financials sebagai mitra pelatihan?
                    Kami siap hadir untuk mendampingi perjalanan UMKM Anda.
                </p>
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
                    src="https://maps.google.com/maps?q=Sentani+Jayapura+Papua+Indonesia&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    width="100%"
                    height="420"
                    style="border:0; display:block;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi MY Financials — Sentani, Kab. Jayapura, Papua"
                ></iframe>
                <div class="bg-cream px-5 py-3 flex items-center gap-2">
                    <i class="fa-solid fa-map-pin text-rust text-xs"></i>
                    <span class="text-[.8rem] text-muted">Sentani, Kab. Jayapura — Papua, Indonesia</span>
                </div>
            </div>
        </div>
    </section>
@endsection
