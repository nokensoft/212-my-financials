@extends('layouts.app')

@section('page_title', 'Perjalanan Kami')
@section('meta_description', 'Perjalanan MY Financials sejak 2023 hingga sekarang — dari perencanaan keuangan pribadi hingga pemberdayaan pelaku usaha & integrasi sistem digital di Papua.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Perjalanan MY Financials',
        'subtitle' => 'Jejak pertumbuhan kami dari tahun ke tahun.',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Tentang Kami'],
            ['label' => 'Perjalanan'],
        ],
    ])

    {{-- ── PERJALANAN (TIMELINE) ── --}}
    <section id="tentang" class="section bg-cream">
        <div class="section-inner max-w-3xl">
            <span class="section-label !text-left">Tentang Kami</span>
            <h2 class="section-title !text-left">Perjalanan MY Financials</h2>
            <div class="section-divider !mx-0"></div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-year">2023</div>
                    <h3>Berdiri &amp; Fokus Personal Finance</h3>
                    <p>MY Financials didirikan dengan fokus awal pada layanan perencanaan keuangan pribadi untuk individu dan keluarga.</p>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-year">2024</div>
                    <h3>Berkembang ke Pemberdayaan Usaha</h3>
                    <p>Sejak 2024, MY Financials berfokus membantu usaha kerakyatan tumbuh melalui pengelolaan keuangan yang rapi, strategi bisnis yang tepat, dan literasi keuangan yang kuat.</p>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-year">2025</div>
                    <h3>Ekspansi &amp; Kolaborasi</h3>
                    <p>Melayani klien lebih luas di lintas daerah atau organisasi seperti di Jayapura dan Bali, bermitra dengan Yayasan KOPERNIK, Bank ANP, dan Dinas Koperasi Kabupaten Jayapura</p>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-year">2026/Sekarang</div>
                    <h3>Integrasi Sitem Digital</h3>
                    <p>Peningkatan kapasitas staf, pembuatan website untuk mengelola program atau layanan, perluasan jaringan kerja, dan masih banyak lagi..</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── PORTOFOLIO ── --}}
    <section id="portofolio" class="section bg-stone">
        <div class="section-inner">
            <span class="section-label">Portofolio</span>
            <h2 class="section-title">Proyek Terkini</h2>
            <div class="section-divider"></div>
            <div class="grid grid-cols-1 navmenu:grid-cols-2 gap-5">
                <div class="porto-item">
                    <span class="porto-year"><i class="fa-regular fa-calendar"></i> Jul – Okt 2024</span>
                    <h3>9x Pelatihan Pengelolaan Keuangan — Kelompok Kakao &amp; Ikan Papua</h3>
                    <p>Serangkaian 9 sesi pelatihan pengelolaan keuangan untuk kelompok produksi produk turunan kakao dan ikan di Papua, bermitra dengan Yayasan KOPERNIK.</p>
                    <span class="porto-badge"><i class="fa-solid fa-leaf"></i> Yayasan KOPERNIK</span>
                </div>
                <div class="porto-item">
                    <span class="porto-year"><i class="fa-regular fa-calendar"></i> Nov 2024 – Sekarang</span>
                    <h3>Mini Projects Set-up Pembukuan UMKM — Jayapura &amp; Bali</h3>
                    <p>Pendampingan langsung set-up sistem pembukuan bagi beberapa klien UMKM di Jayapura dan Bali, serta konsultasi one-on-one bagi pelaku usaha yang mendaftar.</p>
                    <span class="porto-badge"><i class="fa-solid fa-circle-dot text-rust-light"></i> Sedang Berjalan</span>
                </div>
                <div class="porto-item">
                    <span class="porto-year"><i class="fa-regular fa-calendar"></i> Mei 2025</span>
                    <h3>Pelatihan Keuangan Pribadi &amp; UMKM — PAM Klasis Port Numbay Papua</h3>
                    <p>Pelatihan keuangan untuk kelas pra-kerja PAM Klasis Port Numbay Papua, mencakup materi keuangan pribadi sekaligus pengelolaan keuangan usaha kecil.</p>
                    <span class="porto-badge"><i class="fa-solid fa-church"></i> PAM Klasis Port Numbay</span>
                </div>
                <div class="porto-item">
                    <span class="porto-year"><i class="fa-regular fa-calendar"></i> Agt – Okt 2025</span>
                    <h3>Pelatihan Keuangan Usaha Mikro — 4 Wilayah Kabupaten Jayapura</h3>
                    <p>Pelatihan pengelolaan keuangan usaha mikro di Wilayah 1, 2, 3, &amp; 4, serta bimbingan teknis di Kampung Pobaim, bekerja sama dengan Dinas Koperasi dan UMKM Kabupaten Jayapura.</p>
                    <span class="porto-badge"><i class="fa-solid fa-building-columns"></i> Dinas Koperasi Kab. Jayapura</span>
                </div>
                <div class="porto-item">
                    <span class="porto-year"><i class="fa-regular fa-calendar"></i> Nov 2025</span>
                    <h3>UMKM Summit — Bank ANP Merauke</h3>
                    <p>Partisipasi sebagai narasumber dan fasilitator pada UMKM Summit yang diselenggarakan oleh Bank ANP di Merauke.</p>
                    <span class="porto-badge"><i class="fa-solid fa-landmark"></i> Bank ANP Merauke</span>
                </div>
                <div class="porto-item">
                    <span class="porto-year"><i class="fa-regular fa-calendar"></i> Jan – Jun 2026</span>
                    <h3>Telkom AI &amp; Capacity Building Pemuda Gereja</h3>
                    <p>Kolaborasi dengan Telkom AI untuk capacity building, serta pelatihan literasi keuangan bagi pemuda gereja dan seminar dalam rangka peluncuran yayasan.</p>
                    <span class="porto-badge"><i class="fa-solid fa-wifi"></i> Telkom AI</span>
                </div>
            </div>
        </div>
    </section>
@endsection
