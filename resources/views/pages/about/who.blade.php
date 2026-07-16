@extends('layouts.app')

@section('page_title', 'Siapa Kami')
@section('meta_description', 'Mengenal MY Financials (PT Mey Hangrang Jaya) — jasa profesional konsultasi keuangan, pembukuan, pelatihan, dan pendampingan bagi pelaku usaha, yayasan, organisasi, hingga individu di Papua.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Siapa Kami',
        'subtitle' => 'Layanan keuangan profesional yang memberdayakan UMKM di Papua.',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Tentang Kami'],
            ['label' => 'Siapa Kami'],
        ],
    ])

    {{-- ── SIAPA KAMI ── --}}
    <section id="siapa" class="section bg-stone">
        <div class="section-inner grid grid-cols-1 navmenu:grid-cols-2 gap-10 navmenu:gap-16 items-center">
            <div>
                <span class="section-label !text-left">Kami adalah</span>
                <h2 class="section-title !text-left">MY Financials</h2>
                <div class="section-divider !mx-0"></div>
                <p class="mb-5 text-xl font-bold">
                    PT Mey Hangrang Jaya
                </p>
                <p class="lead mb-5">
                    MY Financials adalah jasa profesional di bidang konsultasi keuangan, pembukuan (bookkeeping), penyusunan dan pengembangan sistem keuangan, pelatihan, edukasi, serta pendampingan bagi pelaku usaha, yayasan, organisasi, hingga individu.
                </p>
                <p class="text-muted text-[.9rem] leading-[1.75]">
                    Kami berkomitmen untuk membantu klien membangun pengelolaan keuangan yang tertata, akurat, praktis, dan berkelanjutan melalui layanan konsultasi, penyusunan laporan keuangan, implementasi sistem pembukuan, pelatihan, workshop, serta solusi keuangan yang disesuaikan dengan kebutuhan masing-masing klien.
                </p>
                <p class="text-muted text-[.9rem] leading-[1.75] mt-3.5">
                    Layanan kami berfokus pada pemberdayaan pelaku usaha dan masyarakat agar mampu mengambil keputusan keuangan yang lebih baik, meningkatkan kesehatan finansial, serta mendukung pertumbuhan usaha secara berkelanjutan.
                </p>
            </div>
            <div class="grid grid-cols-1 navmenu:grid-cols-2 gap-3">
                <div class="siapa-card mitra-card navmenu:col-span-2">
                    <div class="siapa-card-icon"><i class="fa-solid fa-handshake"></i></div>
                    <h3>Mitra yang Dapat Diandalkan</h3>
                    <p>Pendampingan berkelanjutan dengan solusi yang kontekstual dan mudah diterapkan.</p>
                </div>
                <div class="siapa-card">
                    <div class="siapa-card-icon"><i class="fa-solid fa-book-open"></i></div>
                    <h3>Pembukuan Praktis</h3>
                    <p>Manual maupun digital, disesuaikan dengan kebutuhan dan kemampuan pelaku usaha maupun individu.</p>
                </div>
                <div class="siapa-card">
                    <div class="siapa-card-icon"><i class="fa-solid fa-users"></i></div>
                    <h3>Kolaborasi Lebih Luas</h3>
                    <p>Bermitra dengan pelaku usaha, yayasan atau organisasi, perbankan, dan platform keuangan, termasuk instansi terkait di pemerintah daerah.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── TIM ── --}}
    <section id="tim" class="section bg-ink">
        <div class="section-inner">
            <h2 class="section-title">Tim Kami</h2>
            <div class="section-divider"></div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8">
                <article class="team-card">
                    <div class="team-photo-wrap">
                        <img class="team-photo" src="{{ asset('images/myf/tim-meitilda.png') }}" alt="Meitilda Yaung, B.Acc., CFP®">
                    </div>
                    <h3 class="team-name">Meitilda Yaung, B.Acc., CFP®</h3>
                    <span class="team-role">Founder &amp; Consultant</span>
                </article>
                <article class="team-card">
                    <div class="team-photo-wrap">
                        <img class="team-photo" src="{{ asset('images/myf/tim-hana.png') }}" alt="Hana Sesa, S.M">
                    </div>
                    <h3 class="team-name">Hana Sesa, S.M</h3>
                    <span class="team-role">Bookkeeper &amp; Facilitator</span>
                </article>
                <article class="team-card">
                    <div class="team-photo-wrap">
                        <img class="team-photo" src="{{ asset('images/myf/tim-elis.png') }}" alt="Elis Muabuay">
                    </div>
                    <h3 class="team-name">Elis Muabuay</h3>
                    <span class="team-role">Operation Assistant</span>
                </article>
            </div>
        </div>
    </section>
@endsection
