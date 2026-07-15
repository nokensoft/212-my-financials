@extends('layouts.app')

@section('page_title', 'Program & Layanan')
@section('meta_description', 'Program & layanan MY Financials: edukasi & workshop pemberdayaan, konsultasi & sistem kontekstual, serta digitalisasi & set-up keuangan untuk UMKM Papua.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Program & Layanan',
        'subtitle' => 'Apa yang kami tawarkan.',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Tentang Kami'],
            ['label' => 'Program & Layanan'],
        ],
    ])

    {{-- ── LAYANAN ── --}}
    <section id="layanan" class="section bg-stone">
        <div class="section-inner">
            <span class="section-label">Layanan &amp; Kapabilitas</span>
            <h2 class="section-title">Apa yang Kami Tawarkan</h2>
            <div class="section-divider"></div>
            <div class="grid grid-cols-1 navmenu:grid-cols-3 gap-5">

                {{-- Kartu 1: Edukasi & Pemberdayaan Perempuan --}}
                <div class="layanan-card featured">
                    <div class="layanan-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                    <h3>Edukasi &amp; Workshop Pemberdayaan</h3>
                    <p>Program kelas interaktif yang dirancang khusus untuk meningkatkan kapasitas literasi keuangan pelaku usaha, komunitas, serta pendampingan finansial bagi kelompok perempuan.</p>
                    <ul class="layanan-items">
                        <li><i class="fa-solid fa-check-circle"></i> Literasi keuangan dasar &amp; rumah tangga</li>
                        <li><i class="fa-solid fa-check-circle"></i> Perhitungan HPP &amp; strategi penetapan harga</li>
                        <li><i class="fa-solid fa-check-circle"></i> Manajemen kas usaha &amp; pengendalian biaya</li>
                        <li><i class="fa-solid fa-check-circle"></i> Pelatihan akuntansi dasar untuk yayasan &amp; organisasi</li>
                        <li><i class="fa-solid fa-check-circle"></i> Program pendampingan keuangan mandiri bagi perempuan</li>
                    </ul>
                </div>

                {{-- Kartu 2: Konsultasi & Keberlanjutan Kontekstual --}}
                <div class="layanan-card">
                    <div class="layanan-icon"><i class="fa-solid fa-comments-dollar"></i></div>
                    <h3>Konsultasi &amp; Sistem Kontekstual</h3>
                    <p>Pendampingan intensif untuk menata tata kelola keuangan organisasi dan usaha lewat metode yang adaptif terhadap karakteristik budaya ekonomi lokal.</p>
                    <ul class="layanan-items">
                        <li><i class="fa-solid fa-check-circle"></i> Penyusunan &amp; penataan laporan keuangan</li>
                        <li><i class="fa-solid fa-check-circle"></i> Desain SOP keuangan berbasis kearifan lokal</li>
                        <li><i class="fa-solid fa-check-circle"></i> Analisis profitabilitas &amp; perencanaan anggaran</li>
                        <li><i class="fa-solid fa-check-circle"></i> Analisa internal &amp; evaluasi finansial berkala</li>
                        <li><i class="fa-solid fa-check-circle"></i> Pendampingan bisnis berkelanjutan (sustainability)</li>
                    </ul>
                </div>

                {{-- Kartu 3: Integrasi Digital --}}
                <div class="layanan-card">
                    <div class="layanan-icon"><i class="fa-solid fa-laptop-medical"></i></div>
                    <h3>Digitalisasi &amp; Set-up Keuangan</h3>
                    <p>Migrasi dan implementasi ekosistem pembukuan modern dari sistem manual ke platform digital terintegrasi untuk mempercepat efisiensi operasional.</p>
                    <ul class="layanan-items">
                        <li><i class="fa-solid fa-check-circle"></i> Set-up akun &amp; standardisasi kategori transaksi</li>
                        <li><i class="fa-solid fa-check-circle"></i> Implementasi aplikasi kasir modern (Point of Sales)</li>
                        <li><i class="fa-solid fa-check-circle"></i> Migrasi ke sistem cloud accounting</li>
                        <li><i class="fa-solid fa-check-circle"></i> Integrasi payment gateway &amp; dompet digital</li>
                        <li><i class="fa-solid fa-check-circle"></i> Pembuatan dashboard monitoring arus kas realtime</li>
                    </ul>
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="{{ route('home') }}#paket" class="btn-primary"><i class="fa-solid fa-circle-right"></i> Lihat Paket Layanan</a>
            </div>
        </div>
    </section>
@endsection
