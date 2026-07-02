@php($home = request()->routeIs('home') ? '' : route('home'))

{{-- ── NAV ── --}}
<nav id="navbar" class="site-nav fixed inset-x-0 z-[100] bg-cream/90 backdrop-blur-md border-b border-line transition-shadow">
    <div class="max-w-[1200px] mx-auto flex items-center justify-between h-16 px-6 max-[480px]:px-4">
        <a href="{{ $home ?: '#beranda' }}" class="flex items-center gap-2.5 no-underline shrink-0" aria-label="MY Financials — Beranda">
            <img src="{{ asset('images/myf/logo-my-financials.png') }}" alt="MY Financials" class="h-20 w-auto py-2 translate-y-2.5 relative z-[2] max-[480px]:h-[62px] max-[480px]:py-1 max-[480px]:translate-y-2">
            <span class="nav-title">MY Financials</span>
        </a>
        <ul class="nav-links hidden navmenu:flex gap-1 list-none">
            <li><a href="{{ $home }}#tentang" class="nav-link">Tentang</a></li>
            <li><a href="{{ $home }}#layanan" class="nav-link">Layanan</a></li>
            <li><a href="{{ $home }}#eksklusif" class="nav-link">Layanan Eksklusif</a></li>
            <li><a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
            <li><a href="{{ route('gallery.index') }}" class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}">Galeri</a></li>
        </ul>
        <a href="{{ $home }}#kontak" class="nav-cta hidden navmenu:inline-flex"><i class="fa-brands fa-whatsapp"></i> Hubungi Kami</a>
        <button class="hamburger flex navmenu:hidden" id="hamburger" type="button" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobileMenu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>
<div class="mobile-menu site-mobile-menu" id="mobileMenu">
    <a href="{{ $home ?: '#beranda' }}" class="mobile-link">Beranda</a>
    <a href="{{ $home }}#tentang" class="mobile-link">Tentang</a>
    <a href="{{ $home }}#layanan" class="mobile-link">Layanan</a>
    <a href="{{ $home }}#eksklusif" class="mobile-link">Layanan Eksklusif</a>
    <a href="{{ route('blog.index') }}" class="mobile-link">Blog</a>
    <a href="{{ route('gallery.index') }}" class="mobile-link">Galeri</a>
    <a href="{{ $home }}#kontak" class="mobile-cta"><i class="fa-brands fa-whatsapp"></i> Hubungi Kami</a>
</div>
