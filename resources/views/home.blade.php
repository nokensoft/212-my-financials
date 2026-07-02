@extends('layouts.app')

@section('page_title', 'Beranda')
@section('meta_description', 'MY Financials — mitra keuangan terpercaya untuk UMKM di Papua. Pelatihan literasi keuangan, konsultasi & pendampingan, serta set-up pembukuan usaha yang praktis dan mudah dipahami.')

@php
    $serviceLd = [
        '@context' => 'https://schema.org',
        '@type' => 'FinancialService',
        'name' => 'MY Financials',
        'description' => 'Mitra keuangan terpercaya untuk UMKM di Papua — pelatihan literasi keuangan, konsultasi & pendampingan, serta set-up pembukuan usaha.',
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

    $paketLayanan = [
        ['no' => '01', 'tier' => 'Paket Dasar', 'name' => 'Cek Kesehatan Keuangan'],
        ['no' => '02', 'tier' => 'Paket Menengah', 'name' => 'Rencana Finansial Pribadi'],
        ['no' => '03', 'tier' => 'Paket Bisnis', 'name' => 'Keuangan UMKM'],
        ['no' => '04', 'tier' => 'Paket Bisnis', 'name' => 'Review Keuangan Bisnis'],
        ['no' => '05', 'tier' => 'Paket Bisnis', 'name' => 'Set-up Pembukuan Keuangan (Project-based)'],
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
        <div class="hero-badge"><i class="fa-solid fa-map-pin"></i> Papua, Indonesia</div>
        <h1 class="hero-title">
            Mitra Keuangan<br>
            <em>Terpercaya</em><br>
            untuk UMKM Papua
        </h1>
        <p class="hero-desc">
            MY Financials berkomitmen memberdayakan pelaku usaha kecil dan menengah di Papua untuk membangun
            bisnis yang sehat, mandiri, dan berkelanjutan melalui solusi keuangan yang praktis dan mudah dipahami.
        </p>
        <div class="flex gap-3 flex-wrap justify-center max-[480px]:flex-col max-[480px]:w-full">
            <a href="#layanan" class="btn-primary justify-center max-[480px]:w-full"><i class="fa-solid fa-circle-right"></i> Lihat Layanan</a>
            <a href="#kontak" class="btn-ghost justify-center max-[480px]:w-full"><i class="fa-regular fa-envelope"></i> Hubungi Kami</a>
        </div>
        <div class="grid grid-cols-2 navmenu:grid-cols-4 gap-3.5 max-[480px]:gap-2.5 w-full mt-[52px]">
            <div class="highlight-box"><div class="highlight-icon"><i class="fa-solid fa-lightbulb"></i></div><span>Pendekatan Praktis &amp; Aplikatif</span></div>
            <div class="highlight-box"><div class="highlight-icon"><i class="fa-solid fa-map-location-dot"></i></div><span>Kontekstual Lokal Papua</span></div>
            <div class="highlight-box"><div class="highlight-icon"><i class="fa-solid fa-venus"></i></div><span>Pemberdayaan Perempuan</span></div>
            <div class="highlight-box"><div class="highlight-icon"><i class="fa-solid fa-shield-halved"></i></div><span>Transparan &amp; Terpercaya</span></div>
        </div>
    </div>
</section>

{{-- ── SIAPA KAMI ── --}}
<section id="siapa" class="section bg-stone">
    <div class="section-inner grid grid-cols-1 navmenu:grid-cols-2 gap-10 navmenu:gap-16 items-center">
        <div>
            <span class="section-label !text-left">Siapa Kami</span>
            <h2 class="section-title !text-left">Layanan Keuangan Profesional yang Memberdayakan</h2>
            <div class="section-divider !mx-0"></div>
            <p class="lead mb-5">
                MY Financials adalah layanan profesional yang menyediakan solusi pembukuan, konsultasi keuangan,
                dan perencanaan bisnis bagi pelaku usaha UMKM.
            </p>
            <p class="text-muted text-[.9rem] leading-[1.75]">
                Dengan pendekatan yang ramah dan mudah dipahami, kami membantu pemilik usaha mengelola keuangan
                secara lebih teratur, transparan, dan strategis — sehingga keputusan bisnis dapat diambil dengan
                lebih percaya diri.
            </p>
            <p class="text-muted text-[.9rem] leading-[1.75] mt-3.5">
                MY Financials aktif terlibat dalam pendidikan keuangan, terutama untuk pemberdayaan ekonomi perempuan
                di Papua, dan berkolaborasi dengan Pemerintah Daerah, yayasan, serta platform UMKM lainnya di Indonesia.
            </p>
        </div>
        <div class="grid grid-cols-1 navmenu:grid-cols-2 gap-3">
            <div class="siapa-card mitra-card navmenu:col-span-2">
                <div class="siapa-card-icon"><i class="fa-solid fa-handshake"></i></div>
                <h3>Mitra yang Dapat Diandalkan</h3>
                <p>Pendampingan berkelanjutan dengan solusi yang transparan dan mudah diterapkan.</p>
            </div>
            <div class="siapa-card">
                <div class="siapa-card-icon"><i class="fa-solid fa-book-open"></i></div>
                <h3>Pembukuan Praktis</h3>
                <p>Manual maupun digital, disesuaikan dengan kebutuhan dan kemampuan UMKM.</p>
            </div>
            <div class="siapa-card">
                <div class="siapa-card-icon"><i class="fa-solid fa-users"></i></div>
                <h3>Kolaborasi Luas</h3>
                <p>Bermitra dengan Pemda, yayasan, bank, dan platform keuangan UMKM nasional.</p>
            </div>
        </div>
    </div>
</section>

{{-- ── TENTANG KAMI ── --}}
<section id="tentang" class="section bg-cream">
    <div class="section-inner grid grid-cols-1 navmenu:grid-cols-2 gap-10 navmenu:gap-16 items-start">
        <div>
            <span class="section-label !text-left">Tentang Kami</span>
            <h2 class="section-title !text-left">Perjalanan MY Financials</h2>
            <div class="section-divider !mx-0"></div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-year">2023</div>
                    <h3>Berdiri &amp; Fokus Personal Finance</h3>
                    <p>MY Financials didirikan dengan fokus awal pada layanan perencanaan keuangan pribadi untuk individu dan keluarga di Papua.</p>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-year">2024</div>
                    <h3>Pivot ke Pemberdayaan UMKM</h3>
                    <p>Sejak 2024, MY Financials berfokus membantu UMKM tumbuh melalui pengelolaan keuangan yang rapi, strategi bisnis yang tepat, dan literasi keuangan yang kuat.</p>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-year">2024 – Sekarang</div>
                    <h3>Ekspansi &amp; Kolaborasi</h3>
                    <p>Melayani klien di Jayapura dan Bali, bermitra dengan Yayasan KOPERNIK, Bank ANP, Telkom AI, dan Dinas Koperasi Kabupaten Jayapura.</p>
                </div>
            </div>
        </div>
        <div>
            <span class="section-label !text-left">Nilai Kami</span>
            <h2 class="section-title !text-left">Apa yang Membuat Kami Berbeda</h2>
            <div class="section-divider !mx-0"></div>
            <ul class="value-list">
                <li>
                    <div class="value-icon"><i class="fa-solid fa-lightbulb"></i></div>
                    <div><strong>Pendekatan Praktis &amp; Aplikatif</strong><p>Materi dan solusi dirancang agar langsung dapat diterapkan oleh pelaku usaha, bukan sekadar teori.</p></div>
                </li>
                <li>
                    <div class="value-icon"><i class="fa-solid fa-map"></i></div>
                    <div><strong>Kontekstual Lokal Papua</strong><p>Melibatkan pendekatan budaya dan sosial lokal agar edukasi lebih diterima dan berdampak jangka panjang.</p></div>
                </li>
                <li>
                    <div class="value-icon"><i class="fa-solid fa-venus"></i></div>
                    <div><strong>Pemberdayaan Perempuan</strong><p>Mendorong perempuan sebagai agen perubahan ekonomi lokal dengan keterampilan pengelolaan keuangan.</p></div>
                </li>
                <li>
                    <div class="value-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <div><strong>Transparan &amp; Terpercaya</strong><p>Solusi yang jujur, terukur, dan berorientasi pada keberlangsungan bisnis klien jangka panjang.</p></div>
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- ── VISI & MISI ── --}}
<section id="visimisi" class="section bg-rust relative overflow-hidden">
    <div class="section-inner relative z-[1]">
        <span class="section-label">Arah &amp; Tujuan</span>
        <h2 class="section-title">Visi &amp; Misi</h2>
        <div class="section-divider"></div>
        <div class="grid grid-cols-1 navmenu:grid-cols-2 gap-10">
            <div class="vm-card">
                <h3><i class="fa-solid fa-eye"></i> Visi</h3>
                <p>Menjadi mitra terpercaya yang dapat diandalkan, memberdayakan UMKM — terutama pelaku usaha di Papua — dalam membangun bisnis yang sehat, mandiri, dan berkelanjutan.</p>
                <img src="{{ asset('images/myf/2.jpg') }}" alt="Kegiatan pemberdayaan UMKM di Papua" class="visi-img shadow-lg mt-5">
            </div>
            <div class="vm-card">
                <h3><i class="fa-solid fa-bullseye"></i> Misi</h3>
                <ul class="misi-list">
                    <li><div class="misi-num">1</div><div><strong>Edukasi Keuangan Praktis</strong><p>Membekali UMKM dengan literasi keuangan: pengelolaan kas, pembukuan, HPP, hingga harga jual.</p></div></li>
                    <li><div class="misi-num">2</div><div><strong>Pendampingan Pembukuan UMKM</strong><p>Membantu mencatat transaksi, membuat laporan keuangan, dan menganalisis profitabilitas usaha.</p></div></li>
                    <li><div class="misi-num">3</div><div><strong>Pemberdayaan Ekonomi Perempuan</strong><p>Mendorong perempuan sebagai agen perubahan ekonomi lokal dengan keterampilan keuangan yang kuat.</p></div></li>
                    <li><div class="misi-num">4</div><div><strong>Materi Kontekstual Lokal</strong><p>Melibatkan pendekatan budaya dan sosial agar edukasi lebih diterima dan berdampak jangka panjang.</p></div></li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ── LAYANAN ── --}}
<section id="layanan" class="section bg-stone">
    <div class="section-inner">
        <span class="section-label">Layanan &amp; Kapabilitas</span>
        <h2 class="section-title">Apa yang Kami Tawarkan</h2>
        <div class="section-divider"></div>
        <div class="grid grid-cols-1 navmenu:grid-cols-3 gap-5">
            <div class="layanan-card featured">
                <div class="layanan-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                <h3>Program Pelatihan</h3>
                <p>Sesi pelatihan interaktif dan terstruktur yang dapat dihadiri secara kelompok maupun komunitas UMKM.</p>
                <ul class="layanan-items">
                    <li><i class="fa-solid fa-check-circle"></i> Literasi keuangan dasar</li>
                    <li><i class="fa-solid fa-check-circle"></i> Pembukuan sederhana (manual &amp; digital)</li>
                    <li><i class="fa-solid fa-check-circle"></i> Laporan keuangan usaha</li>
                    <li><i class="fa-solid fa-check-circle"></i> Manajemen kas &amp; pengendalian biaya</li>
                    <li><i class="fa-solid fa-check-circle"></i> Perhitungan HPP &amp; penetapan harga</li>
                    <li><i class="fa-solid fa-check-circle"></i> Perencanaan keuangan usaha</li>
                </ul>
            </div>
            <div class="layanan-card">
                <div class="layanan-icon"><i class="fa-solid fa-comments-dollar"></i></div>
                <h3>Konsultasi &amp; Pendampingan</h3>
                <p>Sesi one-on-one bersama konsultan berpengalaman untuk kebutuhan keuangan bisnis Anda yang spesifik.</p>
                <ul class="layanan-items">
                    <li><i class="fa-solid fa-check-circle"></i> Penyusunan laporan keuangan</li>
                    <li><i class="fa-solid fa-check-circle"></i> Analisis profit usaha</li>
                    <li><i class="fa-solid fa-check-circle"></i> Penyusunan anggaran</li>
                    <li><i class="fa-solid fa-check-circle"></i> SOP keuangan sederhana</li>
                </ul>
            </div>
            <div class="layanan-card">
                <div class="layanan-icon"><i class="fa-solid fa-chart-line"></i></div>
                <h3>Set-up Pembukuan</h3>
                <p>Kami bantu Anda memulai sistem pencatatan keuangan yang rapi dan berkelanjutan dari nol.</p>
                <ul class="layanan-items">
                    <li><i class="fa-solid fa-check-circle"></i> Setup akun &amp; kategori transaksi</li>
                    <li><i class="fa-solid fa-check-circle"></i> Template pembukuan manual</li>
                    <li><i class="fa-solid fa-check-circle"></i> Penggunaan tools digital</li>
                    <li><i class="fa-solid fa-check-circle"></i> Monitor arus kas &amp; modal</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ── LAYANAN EKSKLUSIF ── --}}
<section id="eksklusif" class="section bg-rust relative overflow-hidden text-white">
    <div class="section-inner relative z-[1]">
        <span class="section-label text-white/80">Layanan Eksklusif</span>
        <h2 class="section-title text-white">Booking Konsultasi Keuangan MY Financials</h2>
        <div class="section-divider bg-white/50"></div>

        <div class="max-w-3xl mx-auto text-center mb-10">
            <p class="text-lg opacity-95 leading-relaxed">
                Konsultasi Keuangan 1-on-1 dengan <strong class="text-white">Perencana Keuangan Bersertifikat (CFP)</strong>
                untuk tata kelola keuangan pribadi yang prima dan akselerasi bisnis UMKM Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach ($paketLayanan as $paket)
                <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/10 hover:border-white/30 transition duration-300">
                    <div class="flex items-start gap-4">
                        <div class="bg-white/20 text-white font-bold w-10 h-10 rounded-lg flex items-center justify-center shrink-0">{{ $paket['no'] }}</div>
                        <div>
                            <h4 class="text-white font-semibold text-sm uppercase tracking-wider opacity-75">{{ $paket['tier'] }}</h4>
                            <p class="text-white text-lg font-medium mt-1">“{{ $paket['name'] }}”</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="bg-white/20 backdrop-blur-md p-6 rounded-xl border border-white/40 shadow-xl transform lg:scale-105 transition duration-300 flex flex-col justify-between">
                <div class="flex items-start gap-4">
                    <div class="bg-white text-rust font-bold w-10 h-10 rounded-lg flex items-center justify-center shrink-0">06</div>
                    <div>
                        <h4 class="text-white font-bold text-sm uppercase tracking-wider opacity-90">Sesi Khusus</h4>
                        <p class="text-white text-lg font-extrabold mt-1">Konsultasi Gratis 30 Menit</p>
                        <p class="text-white text-sm opacity-90 mt-1">Untuk menentukan paket yang paling sesuai dengan kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/6282190902163?text=Halo%20MY%20Financials%2C%20saya%20ingin%20memesan%20paket%20Layanan%20Eksklusif."
               target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-3 bg-white text-rust font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all duration-200 group">
                <i class="fa-brands fa-whatsapp text-xl"></i>
                <span>Pilih Paket &amp; Amankan Jadwal</span>
                <i class="fa-solid fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
            </a>
            <a href="{{ route('member.login') }}"
               class="inline-flex items-center gap-3 border-[1.5px] border-white/50 text-white font-bold px-8 py-4 rounded-full hover:bg-white/10 transition">
                <i class="fa-solid fa-user"></i>
                <span>Masuk Member untuk Memesan</span>
            </a>
        </div>
    </div>
</section>

{{-- ── PORTOFOLIO ── --}}
<section id="portofolio" class="section bg-cream">
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
                <span class="porto-year"><i class="fa-regular fa-calendar"></i> Agt – Okt 2025</span>
                <h3>Telkom AI &amp; Capacity Building Pemuda Gereja</h3>
                <p>Kolaborasi dengan Telkom AI untuk capacity building, serta pelatihan literasi keuangan bagi pemuda gereja dan seminar dalam rangka peluncuran yayasan.</p>
                <span class="porto-badge"><i class="fa-solid fa-wifi"></i> Telkom AI</span>
            </div>
        </div>
    </div>
</section>

{{-- ── GALERI (dinamis via API + Alpine) ── --}}
<section id="galeri" class="section bg-white" x-data="gallerySection()" x-init="init()">
    <div class="section-inner">
        <span class="section-label">Galeri</span>
        <h2 class="section-title">Dokumentasi Kegiatan</h2>
        <div class="section-divider"></div>

        <div class="flex justify-end mb-6">
            <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 text-rust font-bold text-sm hover:text-rust-dark transition">
                Semua Album <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div x-show="loading" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
            <template x-for="i in 4" :key="i"><div class="animate-pulse bg-stone rounded-xl h-64"></div></template>
        </div>

        <div x-show="!loading && albums.length === 0" class="text-center py-14 text-muted">
            <i class="fa-regular fa-images text-4xl mb-3"></i>
            <p>Belum ada album yang dipublikasikan.</p>
        </div>

        <div x-show="!loading && albums.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
            <template x-for="album in albums" :key="album.slug">
                <a :href="album.url" class="group rounded-xl overflow-hidden border border-line bg-cream flex flex-col hover:-translate-y-0.5 hover:shadow-[0_8px_32px_rgba(184,74,26,0.12)] transition">
                    <div class="overflow-hidden h-48 bg-stone">
                        <img :src="album.cover_image" :alt="album.title" x-show="album.cover_image" loading="lazy"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-sm font-bold leading-snug group-hover:text-rust transition" x-text="album.title"></p>
                        <div class="mt-auto pt-3 flex items-center justify-between text-[11px] text-muted font-semibold">
                            <span class="inline-flex items-center gap-1.5 bg-rust/[0.08] text-rust px-2.5 py-1 rounded-md"><i class="fa-regular fa-images"></i> <span x-text="album.photos_count + ' Foto'"></span></span>
                            <span class="inline-flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> <span x-text="album.views"></span></span>
                        </div>
                    </div>
                </a>
            </template>
        </div>
    </div>
</section>

{{-- ── BLOG (dinamis via API + Alpine) ── --}}
<section id="blog" class="section bg-stone" x-data="blogSection()" x-init="init()">
    <div class="section-inner">
        <span class="section-label">Kabar Terbaru</span>
        <h2 class="section-title">Blog &amp; Artikel</h2>
        <div class="section-divider"></div>

        <div class="flex flex-wrap items-center justify-center gap-2 mb-8">
            <button @click="filter('')" :class="activeCategory === '' ? 'bg-rust text-white' : 'bg-cream text-muted border border-line hover:text-rust'"
                class="px-4 py-1.5 rounded-full text-sm font-semibold transition">Semua</button>
            <template x-for="cat in categories" :key="cat.slug">
                <button @click="filter(cat.slug)" :class="activeCategory === cat.slug ? 'bg-rust text-white' : 'bg-cream text-muted border border-line hover:text-rust'"
                    class="px-4 py-1.5 rounded-full text-sm font-semibold transition">
                    <span x-text="cat.name"></span>
                </button>
            </template>
        </div>

        <div x-show="loading" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <template x-for="i in 4" :key="i"><div class="animate-pulse bg-cream rounded-xl h-72"></div></template>
        </div>

        <div x-show="!loading && posts.length === 0" class="text-center py-14 text-muted">
            <i class="fa-regular fa-folder-open text-4xl mb-3"></i>
            <p>Belum ada artikel yang dipublikasikan.</p>
        </div>

        <div x-show="!loading && posts.length > 0" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <template x-for="post in posts" :key="post.slug">
                <a :href="post.url" class="group bg-cream rounded-xl overflow-hidden border border-line hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="relative overflow-hidden h-44 bg-stone">
                        <img :src="post.cover_image" :alt="post.title" x-show="post.cover_image" loading="lazy"
                            class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex flex-wrap gap-1 mb-3">
                            <template x-for="c in post.categories" :key="c.slug">
                                <span class="bg-rust/[0.08] text-rust text-[10px] font-bold px-2 py-0.5 rounded-full" x-text="c.name"></span>
                            </template>
                        </div>
                        <h3 class="text-base font-bold mb-2 line-clamp-2 group-hover:text-rust transition" x-text="post.title"></h3>
                        <p class="text-sm text-muted leading-relaxed line-clamp-3 flex-1" x-text="post.excerpt"></p>
                        <div class="flex justify-between items-center pt-3 mt-3 border-t border-line text-xs text-muted font-medium">
                            <span x-text="post.published_human"></span>
                            <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> <span x-text="post.views"></span></span>
                        </div>
                    </div>
                </a>
            </template>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('blog.index') }}" class="btn-primary"><i class="fa-solid fa-newspaper"></i> Baca Semua Artikel</a>
        </div>
    </div>
</section>

{{-- ── TIM ── --}}
<section id="tim" class="section bg-ink">
    <div class="section-inner">
        <span class="section-label">Tim Kami</span>
        <h2 class="section-title">Tim Profesional Kami</h2>
        <div class="section-divider"></div>
        <div class="grid grid-cols-1 navmenu:grid-cols-2 gap-8 max-w-[920px] mx-auto">
            <article class="team-card">
                <div class="team-photo-wrap">
                    <img class="team-photo" src="{{ asset('images/myf/tim-meitilda.png') }}" alt="Meitilda Yaung, B.Acc., CFP®">
                </div>
                <h3 class="team-name">Meitilda Yaung, B.Acc., CFP®</h3>
                <span class="team-role">Founder — Accountant, Financial Planner</span>
                <p class="team-desc">Meitilda adalah seorang Akuntan &amp; Perencana Keuangan dengan pengalaman kerja lebih dari 10 tahun di bidang keuangan, khususnya akuntansi dan manajemen akuntansi pemerintahan di Australia Utara hingga perencanaan keuangan pribadi &amp; UKM. Meitilda juga aktif mengedukasi masyarakat akan pentingnya literasi keuangan.</p>
            </article>
            <article class="team-card">
                <div class="team-photo-wrap">
                    <img class="team-photo" src="{{ asset('images/myf/tim-hana.png') }}" alt="Hana Sesa, S.M">
                </div>
                <h3 class="team-name">Hana Sesa, S.M</h3>
                <span class="team-role">Bookkeeper MY Financials</span>
                <p class="team-desc">Hana adalah seorang Bookkeeper profesional dengan latar belakang S1 Manajemen. Hana memiliki pengalaman mencatat &amp; mengelola transaksi keuangan UKM dan aktif berperan memfasilitasi berbagai pelatihan keuangan yang dilakukan MY Financials.</p>
            </article>
        </div>
    </div>
</section>

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
        <div class="kontak-form">
            <h3><i class="fa-brands fa-whatsapp me-2"></i> Kirim Pesan</h3>
            <form id="contactForm">
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Lengkap</label>
                    <input class="form-input" id="nama" name="nama" type="text" placeholder="Nama Anda" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-input" id="email" name="email" type="email" placeholder="email@anda.com">
                </div>
                <div class="form-group">
                    <label class="form-label" for="kebutuhan">Kebutuhan</label>
                    <select class="form-input" id="kebutuhan" name="kebutuhan">
                        <option value="">Pilih layanan yang Anda butuhkan</option>
                        <option>Program Pelatihan</option>
                        <option>Konsultasi Keuangan</option>
                        <option>Set-up Pembukuan</option>
                        <option>Kolaborasi / Kemitraan</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="pesan">Pesan</label>
                    <textarea class="form-input" id="pesan" name="pesan" placeholder="Ceritakan kebutuhan usaha Anda..." required></textarea>
                </div>
                <button class="form-submit" type="submit"><i class="fa-solid fa-paper-plane"></i> Kirim Pesan</button>
            </form>
        </div>
    </div>
</section>

{{-- ── FLOATING ACTIONS ── --}}
<div class="fab-stack">
    <a class="wa-float" href="https://wa.me/6282190902163?text=Halo%20MY%20Financials%2C%20saya%20ingin%20konsultasi%20awal." target="_blank" rel="noopener noreferrer" aria-label="Hubungi & Konsultasi Awal di WhatsApp">
        <span class="wa-avatar-wrap">
            <img class="wa-avatar" src="{{ asset('images/myf/tim-meitilda.png') }}" alt="Meitilda Yaung">
            <span class="wa-badge"><i class="fa-brands fa-whatsapp"></i></span>
        </span>
        <span class="wa-text">Hubungi &amp; <br> Konsultasi</span>
    </a>
    <button id="backToTop" class="back-to-top" type="button" aria-label="Kembali ke atas">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
</div>

@endsection

@push('head')
<script>
    function blogSection() {
        return {
            posts: [], categories: [], activeCategory: '', loading: true,
            async init() {
                await this.loadCategories();
                await this.loadPosts();
            },
            async loadCategories() {
                try {
                    const res = await fetch('{{ route('api.categories') }}');
                    const json = await res.json();
                    this.categories = (json.data || []).filter(c => c.posts_count > 0);
                } catch (e) { this.categories = []; }
            },
            async loadPosts() {
                this.loading = true;
                try {
                    const url = new URL('{{ route('api.posts') }}');
                    url.searchParams.set('per_page', '8');
                    if (this.activeCategory) url.searchParams.set('category', this.activeCategory);
                    const res = await fetch(url);
                    const json = await res.json();
                    this.posts = json.data || [];
                } catch (e) { this.posts = []; }
                this.loading = false;
            },
            filter(slug) { this.activeCategory = slug; this.loadPosts(); },
        };
    }

    function gallerySection() {
        return {
            albums: [], loading: true,
            async init() {
                try {
                    const res = await fetch('{{ route('api.albums') }}?per_page=8');
                    const json = await res.json();
                    this.albums = json.data || [];
                } catch (e) { this.albums = []; }
                this.loading = false;
            },
        };
    }
</script>
@endpush
