@php($home = request()->routeIs('home') ? '' : route('home'))
@php($memberUrl = auth('member')->check() ? route('member.dashboard') : route('member.login'))

{{-- ── NAV ── --}}
<nav id="navbar" class="site-nav fixed inset-x-0 z-[100] bg-cream/90 backdrop-blur-md border-b border-line transition-shadow">
    <div class="max-w-[1200px] mx-auto flex items-center justify-between h-16 px-6 max-[480px]:px-4">
        <a href="{{ $home ?: '#beranda' }}" class="flex items-center gap-2.5 no-underline shrink-0" aria-label="MY Financials — Beranda">
            <img src="{{ asset('images/myf/logo-my-financials.png') }}" alt="MY Financials" class="h-20 w-auto py-2 translate-y-2.5 relative z-[2] max-[480px]:h-[62px] max-[480px]:py-1 max-[480px]:translate-y-2">
            <span class="flex flex-col leading-none">
                <span class="nav-title">MY Financials</span>
                <span class="navmenu:block mt-1 max-w-[260px] text-[.62rem] font-semibold uppercase tracking-[.04em] text-muted leading-tight">Kelola Keuangan, Kelola Hidup.</span>
            </span>
        </a>
        <ul class="nav-links hidden navmenu:flex items-center gap-1 list-none">
            <li><a href="{{ $home ?: '#beranda' }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>

            <li class="nav-dropdown" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button type="button" @click="open = !open" class="nav-link {{ request()->routeIs('pages.about.*') ? 'active' : '' }}" :aria-expanded="open">
                    Tentang Kami <i class="fa-solid fa-chevron-down text-[.6rem] ml-1 transition-transform" :class="open && 'rotate-180'"></i>
                </button>
                <div x-show="open" x-cloak x-transition class="nav-dropdown-panel">
                    <a href="{{ route('pages.about.who') }}" class="nav-dropdown-link {{ request()->routeIs('pages.about.who') ? 'active' : '' }}">Siapa Kami</a>
                    <a href="{{ route('pages.about.journey') }}" class="nav-dropdown-link {{ request()->routeIs('pages.about.journey') ? 'active' : '' }}">Perjalanan</a>
                    <a href="{{ route('pages.about.values') }}" class="nav-dropdown-link {{ request()->routeIs('pages.about.values') ? 'active' : '' }}">Nilai</a>
                    <a href="{{ route('pages.about.vision') }}" class="nav-dropdown-link {{ request()->routeIs('pages.about.vision') ? 'active' : '' }}">Visi &amp; Misi</a>
                    <a href="{{ route('pages.about.services') }}" class="nav-dropdown-link {{ request()->routeIs('pages.about.services') ? 'active' : '' }}">Program &amp; Layanan</a>
                </div>
            </li>

            <li class="nav-dropdown" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button type="button" @click="open = !open" class="nav-link {{ request()->routeIs('member.*') ? 'active' : '' }}" :aria-expanded="open">
                    Paket Layanan <i class="fa-solid fa-chevron-down text-[.6rem] ml-1 transition-transform" :class="open && 'rotate-180'"></i>
                </button>
                <div x-show="open" x-cloak x-transition class="nav-dropdown-panel">
                    <a href="{{ route('home') }}#paket" class="nav-dropdown-link">Pilihan Paket</a>
                    <a href="{{ $memberUrl }}" class="nav-dropdown-link {{ request()->routeIs('member.*') ? 'active' : '' }}">Area Member</a>
                </div>
            </li>

            <li><a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
            <li><a href="{{ route('gallery.index') }}" class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}">Album Kegiatan</a></li>
        </ul>
        <a href="{{ route('pages.contact') }}" class="nav-cta hidden navmenu:inline-flex"><i class="fa-brands fa-whatsapp"></i> Hubungi Kami</a>
        <button class="hamburger flex navmenu:hidden" id="hamburger" type="button" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobileMenu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>
<div class="mobile-menu site-mobile-menu" id="mobileMenu">
    <a href="{{ $home ?: '#beranda' }}" class="mobile-link">Beranda</a>

    <div x-data="{ open: {{ request()->routeIs('pages.about.*') ? 'true' : 'false' }} }" class="mobile-sub">
        <button type="button" @click="open = !open" class="mobile-sub-toggle" :aria-expanded="open">
            Tentang Kami <i class="fa-solid fa-chevron-down text-[.7rem] transition-transform" :class="open && 'rotate-180'"></i>
        </button>
        <div x-show="open" x-cloak x-transition class="mobile-sub-panel">
            <a href="{{ route('pages.about.who') }}" class="mobile-sublink">Siapa Kami</a>
            <a href="{{ route('pages.about.journey') }}" class="mobile-sublink">Perjalanan</a>
            <a href="{{ route('pages.about.values') }}" class="mobile-sublink">Nilai</a>
            <a href="{{ route('pages.about.vision') }}" class="mobile-sublink">Visi &amp; Misi</a>
            <a href="{{ route('pages.about.services') }}" class="mobile-sublink">Program &amp; Layanan</a>
        </div>
    </div>

    <div x-data="{ open: {{ request()->routeIs('member.*') ? 'true' : 'false' }} }" class="mobile-sub">
        <button type="button" @click="open = !open" class="mobile-sub-toggle" :aria-expanded="open">
            Paket Layanan <i class="fa-solid fa-chevron-down text-[.7rem] transition-transform" :class="open && 'rotate-180'"></i>
        </button>
        <div x-show="open" x-cloak x-transition class="mobile-sub-panel">
            <a href="{{ route('home') }}#paket" class="mobile-sublink">Pilihan Paket</a>
            <a href="{{ $memberUrl }}" class="mobile-sublink">Area Member</a>
        </div>
    </div>

    <a href="{{ route('blog.index') }}" class="mobile-link">Blog</a>
    <a href="{{ route('gallery.index') }}" class="mobile-link">Album Kegiatan</a>
    <a href="{{ route('pages.contact') }}" class="mobile-cta"><i class="fa-brands fa-whatsapp"></i> Hubungi Kami</a>
</div>
