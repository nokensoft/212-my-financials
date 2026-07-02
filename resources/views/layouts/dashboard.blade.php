<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title', 'Dashboard') · {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('images/myf/logo-my-financials.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,600;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-stone text-ink antialiased" x-data="{ sidebar: false }">

    @php
        $contentNav = [
            ['route' => 'dashboard', 'active' => 'dashboard', 'icon' => 'fa-gauge-high', 'label' => 'Dashboard'],
            ['route' => 'dashboard.posts.index', 'active' => 'dashboard.posts.*', 'icon' => 'fa-newspaper', 'label' => 'Blog'],
            ['route' => 'dashboard.categories.index', 'active' => 'dashboard.categories.*', 'icon' => 'fa-tags', 'label' => 'Kategori'],
            ['route' => 'dashboard.albums.index', 'active' => 'dashboard.albums.*', 'icon' => 'fa-images', 'label' => 'Album & Galeri'],
        ];
        $simNav = [
            ['route' => 'dashboard.members.index', 'active' => 'dashboard.members.*', 'icon' => 'fa-user-check', 'label' => 'Member'],
            ['route' => 'dashboard.packages.index', 'active' => 'dashboard.packages.*', 'icon' => 'fa-box-open', 'label' => 'Paket Layanan'],
            ['route' => 'dashboard.orders.index', 'active' => 'dashboard.orders.*', 'icon' => 'fa-file-invoice-dollar', 'label' => 'Pemesanan'],
            ['route' => 'dashboard.reports.members', 'active' => 'dashboard.reports.members', 'icon' => 'fa-user-group', 'label' => 'Laporan Member'],
            ['route' => 'dashboard.reports.finance', 'active' => 'dashboard.reports.finance', 'icon' => 'fa-chart-pie', 'label' => 'Laporan Keuangan'],
        ];
    @endphp

    @php
        $navClass = fn ($active) => request()->routeIs($active)
            ? 'bg-primary text-white'
            : 'text-muted hover:bg-stone hover:text-rust';
    @endphp

    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-line transform transition-transform md:translate-x-0 overflow-y-auto"
        :class="sidebar ? 'translate-x-0' : '-translate-x-full'">
        <div class="h-16 flex items-center gap-3 px-6 border-b border-line">
            <img src="{{ asset('images/myf/logo-my-financials.png') }}" alt="MY Financials" class="w-9 h-9 object-contain">
            <span class="font-serif font-semibold text-lg text-rust leading-none">MY Financials</span>
        </div>
        <nav class="p-4 space-y-1">
            <p class="px-4 pt-1 pb-2 text-[10px] font-bold uppercase tracking-widest text-muted/70">Konten</p>
            @foreach ($contentNav as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium transition {{ $navClass($item['active']) }}">
                    <i class="fa-solid {{ $item['icon'] }} w-5 text-center"></i> {{ $item['label'] }}
                </a>
            @endforeach

            <p class="px-4 pt-4 pb-2 text-[10px] font-bold uppercase tracking-widest text-muted/70">Simulasi</p>
            @foreach ($simNav as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium transition {{ $navClass($item['active']) }}">
                    <i class="fa-solid {{ $item['icon'] }} w-5 text-center"></i> {{ $item['label'] }}
                </a>
            @endforeach

            <div class="pt-4 mt-4 border-t border-line space-y-1">
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('dashboard.users.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium transition {{ $navClass('dashboard.users.*') }}">
                        <i class="fa-solid fa-users-gear w-5 text-center"></i> Pengguna
                    </a>
                @endif
                <a href="{{ route('dashboard.profile.edit') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium transition {{ $navClass('dashboard.profile.*') }}">
                    <i class="fa-solid fa-user-gear w-5 text-center"></i> Profil
                </a>
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-muted hover:bg-stone hover:text-rust transition">
                    <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center"></i> Lihat Situs
                </a>
            </div>
        </nav>
    </aside>

    <div x-show="sidebar" x-cloak @click="sidebar = false" class="fixed inset-0 z-30 bg-ink/50 md:hidden"></div>

    {{-- Main --}}
    <div class="md:ml-64 flex flex-col min-h-screen">
        <header class="h-16 sticky top-0 z-20 bg-white/85 backdrop-blur border-b border-line flex items-center justify-between px-4 md:px-8">
            <div class="flex items-center gap-3">
                <button @click="sidebar = !sidebar" class="md:hidden w-9 h-9 grid place-items-center rounded-lg hover:bg-stone">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1 class="font-bold text-lg">@yield('page_title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex flex-col items-end leading-tight mr-1">
                    <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] uppercase tracking-wide font-bold {{ auth()->user()->isAdmin() ? 'text-rust' : 'text-muted' }}">{{ auth()->user()->role }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-9 h-9 rounded-full grid place-items-center text-muted hover:bg-red-50 hover:text-red-600 transition" title="Keluar">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-4 md:p-8">
            @include('partials.flash')
            @yield('content')
        </main>

        <footer class="px-4 md:px-8 py-6 border-t border-line text-center text-xs text-muted">
            &copy; {{ date('Y') }} {{ config('app.name') }} · Panel Admin
            <span class="mx-1">·</span>
            Powered by <a href="https://nokensoft.com" target="_blank" rel="noopener" class="font-semibold text-muted hover:text-rust transition">Nokensoft.com</a>
        </footer>
    </div>

    @include('partials.confirm-modal')

    @stack('scripts')
</body>

</html>
