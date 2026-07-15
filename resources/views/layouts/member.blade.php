<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Area Member') · {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('images/myf/logo-my-financials.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,600;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-stone text-ink antialiased min-h-screen flex flex-col">
    @php($member = auth('member')->user())
    @php($statuses = \App\Models\Member::statuses())

    <header class="bg-cream border-b border-line">
        <div class="max-w-5xl mx-auto flex items-center justify-between h-16 px-4 sm:px-5">
            <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2 shrink-0">
                <img src="{{ asset('images/myf/logo-my-financials.png') }}" alt="MY Financials" class="h-9 w-auto">
                <span class="font-serif font-semibold text-base xs:text-lg text-rust leading-none">Area Member</span>
            </a>
            <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                @if ($member)
                    <div class="flex flex-col items-end leading-tight min-w-0">
                        <span class="text-xs xs:text-sm font-semibold truncate max-w-[100px] xs:max-w-[160px] sm:max-w-none">{{ $member->name }}</span>
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $statuses[$member->status]['class'] ?? '' }}">{{ $statuses[$member->status]['label'] ?? $member->status }}</span>
                    </div>
                    <form method="POST" action="{{ route('member.logout') }}">
                        @csrf
                        <button type="submit" class="w-9 h-9 rounded-full grid place-items-center text-muted hover:bg-red-50 hover:text-red-600 transition shrink-0" title="Keluar">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @if ($member)
            <nav class="max-w-5xl mx-auto px-4 sm:px-5 flex gap-0.5 xs:gap-1 -mb-px overflow-x-auto scrollbar-none">
                @php($tabs = [
                    ['route' => 'member.dashboard', 'active' => 'member.dashboard', 'label' => 'Beranda', 'icon' => 'fa-gauge-high'],
                    ['route' => 'member.packages', 'active' => 'member.packages', 'label' => 'Paket', 'icon' => 'fa-box-open'],
                    ['route' => 'member.orders', 'active' => 'member.orders*', 'label' => 'Pesanan', 'icon' => 'fa-file-invoice-dollar'],
                    ['route' => 'member.profile.edit', 'active' => 'member.profile.*', 'label' => 'Profil', 'icon' => 'fa-user-gear'],
                ])
                @foreach ($tabs as $t)
                    <a href="{{ route($t['route']) }}"
                        class="flex items-center gap-1.5 px-3 xs:px-4 py-3 text-sm font-semibold border-b-2 whitespace-nowrap transition {{ request()->routeIs($t['active']) ? 'border-rust text-rust' : 'border-transparent text-muted hover:text-rust' }}">
                        <i class="fa-solid {{ $t['icon'] }}"></i>
                        <span class="hidden xs:inline">{{ $t['label'] }}</span>
                    </a>
                @endforeach
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-1.5 px-3 xs:px-4 py-3 text-sm font-semibold border-b-2 border-transparent text-muted hover:text-rust whitespace-nowrap transition ml-auto">
                    <i class="fa-solid fa-globe"></i>
                    <span class="hidden xs:inline">Situs</span>
                </a>
            </nav>
        @endif
    </header>

    <main class="flex-1 max-w-5xl w-full mx-auto px-5 py-8">
        @if (session('status'))
            <div class="mb-6 flex items-start gap-3 rounded-xl bg-primary-50 border border-primary-200 text-primary-800 px-4 py-3">
                <i class="fa-solid fa-circle-check mt-0.5"></i><span class="text-sm font-medium">{{ session('status') }}</span>
            </div>
        @endif
        @if (session('info'))
            <div class="mb-6 flex items-start gap-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3">
                <i class="fa-solid fa-circle-info mt-0.5"></i><span class="text-sm font-medium">{{ session('info') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3">
                <p class="font-semibold text-sm flex items-center gap-2"><i class="fa-solid fa-triangle-exclamation"></i> Periksa kembali isian berikut:</p>
                <ul class="list-disc list-inside text-sm mt-1.5 space-y-0.5">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.fab')

    <footer class="px-5 py-6 border-t border-line">
        <div class="flex flex-col items-center gap-3 text-center text-xs text-muted">
            <p>&copy; {{ date('Y') }} <strong class="text-ink font-semibold">MY Financials</strong> &mdash; Al right reserved</p>
            <a href="https://nokensoft.com" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-line text-muted text-xs font-semibold hover:text-rust hover:border-rust transition no-underline">
                <img src="{{ asset('images/myf/logo-nokensoft.jpg') }}" alt="Nokensoft" class="w-4 h-4 rounded">
                Powered by <strong>Nokensoft</strong>
            </a>
        </div>
    </footer>
</body>

</html>
