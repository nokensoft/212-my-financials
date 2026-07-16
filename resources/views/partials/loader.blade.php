{{-- ── LOADING SCREEN ──
     Menampilkan logo utama + tagline di atas overlay gradient (sama seperti hero). --}}
<div id="siteLoader" class="site-loader" role="status" aria-live="polite" aria-label="Memuat halaman">
    <div class="site-loader-overlay" aria-hidden="true"></div>
    <div class="site-loader-content">
        <img src="{{ asset('images/myf/logo-my-financials-white.png') }}"
             alt="MY Financials"
             class="site-loader-logo"
             width="160" height="160">
        <p class="site-loader-tagline">Kelola Keuangan, Kelola Hidup.</p>
        <div class="site-loader-spinner" aria-hidden="true"></div>
    </div>
</div>
