@extends('layouts.app')

@section('page_title', 'Nilai Kami')
@section('meta_description', 'Nilai-nilai MY Financials: pemberdayaan & edukasi, pendekatan kontekstual lokal, pemberdayaan perempuan, dan fokus pada keberlanjutan.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Nilai Kami',
        'subtitle' => 'Apa yang membuat kami berbeda.',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Tentang Kami'],
            ['label' => 'Nilai'],
        ],
    ])

    {{-- ── NILAI ── --}}
    <section id="nilai" class="section bg-cream">
        <div class="section-inner max-w-3xl">
            <span class="section-label !text-left">Nilai Kami</span>
            <h2 class="section-title !text-left">Apa yang Membuat Kami Berbeda</h2>
            <div class="section-divider !mx-0"></div>
            <ul class="value-list">
                <li>
                    <div class="value-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                    <div>
                        <strong>Pemberdayaan &amp; Edukasi</strong>
                        <p>Meningkatkan literasi keuangan melalui pelatihan dan pendampingan agar masyarakat serta pelaku usaha mampu mengambil keputusan finansial yang lebih baik.</p>
                    </div>
                </li>
                <li>
                    <div class="value-icon"><i class="fa-solid fa-map-location-dot"></i></div>
                    <div>
                        <strong>Pendekatan Kontekstual Lokal</strong>
                        <p>Menyediakan solusi keuangan dan sistem pembukuan yang relevan, praktis, serta mudah diimplementasikan sesuai dengan karakteristik lingkungan usaha lokal.</p>
                    </div>
                </li>
                <li>
                    <div class="value-icon"><i class="fa-solid fa-venus"></i></div>
                    <div>
                        <strong>Pemberdayaan Perempuan</strong>
                        <p>Mendorong peran aktif perempuan dalam penguatan ekonomi melalui pembekalan keterampilan manajemen keuangan usaha dan keluarga yang mandiri.</p>
                    </div>
                </li>
                <li>
                    <div class="value-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <div>
                        <strong>Fokus Pada Keberlanjutan</strong>
                        <p>Membangun sistem tata kelola keuangan yang tertata, akurat, dan transparan demi mendukung pertumbuhan usaha yang sehat dalam jangka panjang.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>
@endsection
