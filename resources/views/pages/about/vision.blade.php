@extends('layouts.app')

@section('page_title', 'Visi & Misi')
@section('meta_description', 'Visi & Misi MY Financials — arah dan tujuan kami dalam mewujudkan ekosistem usaha yang mandiri, sehat secara finansial, dan tumbuh berkelanjutan.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Visi & Misi',
        'subtitle' => 'Arah & tujuan MY Financials.',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Tentang Kami'],
            ['label' => 'Visi & Misi'],
        ],
    ])

    {{-- ── VISI & MISI ── --}}
    <section id="visimisi" class="section bg-rust relative overflow-hidden">
        <div class="section-inner relative z-[1]">
            <span class="section-label">Arah &amp; Tujuan</span>
            <h2 class="section-title">Visi &amp; Misi</h2>
            <div class="section-divider"></div>
            <div class="grid grid-cols-1 navmenu:grid-cols-2 gap-10">
                <div class="vm-card">
                    <h3><i class="fa-solid fa-eye"></i> Visi</h3>
                    <p>Menjadi mitra profesional terpercaya dalam mewujudkan ekosistem usaha yang mandiri, sehat secara finansial, dan tumbuh berkelanjutan melalui pendekatan edukasi serta kearifan lokal.</p>
                    <img src="{{ asset('images/myf/1.jpg') }}" alt="Kegiatan pemberdayaan UMKM di Papua" class="visi-img shadow-lg mt-5">
                </div>
                <div class="vm-card">
                    <h3><i class="fa-solid fa-bullseye"></i> Misi</h3>
                    <ul class="misi-list">
                        <li>
                            <div class="misi-num">1</div>
                            <div>
                                <strong>Penyelenggaraan Kelas &amp; Workshop Literasi Keuangan</strong>
                                <p>Menyusun modul edukasi praktis dan menyelenggarakan pelatihan pembukuan dasar, perhitungan HPP, serta strategi harga jual bagi pelaku usaha dan UMKM.</p>
                            </div>
                        </li>
                        <li>
                            <div class="misi-num">2</div>
                            <div>
                                <strong>Standardisasi Sistem Pembukuan Berbasis Konteks Lokal</strong>
                                <p>Merancang dan mengimplementasikan sistem pencatatan keuangan yang adaptif, sederhana, serta menggunakan pendekatan budaya ekonomi masyarakat setempat agar mudah diterapkan.</p>
                            </div>
                        </li>
                        <li>
                            <div class="misi-num">3</div>
                            <div>
                                <strong>Pendampingan Manajemen Finansial Kelompok Perempuan</strong>
                                <p>Membuat program inkubasi dan pendampingan khusus bagi perempuan penggerak usaha untuk mengoptimalkan pengelolaan keuangan rumah tangga dan operasional bisnis.</p>
                            </div>
                        </li>
                        <li>
                            <div class="misi-num">4</div>
                            <div>
                                <strong>Audit Internal &amp; Pengembangan Dashboard Keuangan Berkelanjutan</strong>
                                <p>Membantu yayasan, organisasi, dan mitra usaha menyusun laporan keuangan akurat, menata sistem manajemen kas, serta menyediakan evaluasi finansial berkala demi keberlangsungan jangka panjang.</p>
                            </div>
                        </li>
                        <li>
                            <div class="misi-num">5</div>
                            <div>
                                <strong>Digitalisasi &amp; Integrasi Aplikasi Keuangan Modern</strong>
                                <p>Memigrasikan pembukuan manual ke ekosistem digital melalui implementasi aplikasi kasir (POS), <b>cloud accounting</b>, dan integrasi <b>payment gateway</b> guna mempercepat efisiensi operasional.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
