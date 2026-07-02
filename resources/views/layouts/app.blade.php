<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#B84A1A">

    {{-- Ingat status pemberitahuan tahap pengembangan --}}
    <script>
        (function () {
            try {
                if (localStorage.getItem('devNoticeDismissed') === '1') {
                    document.documentElement.classList.add('notice-dismissed');
                }
            } catch (e) {}
        })();
    </script>

    <title>@yield('page_title', 'Beranda') · {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', 'MY Financials — mitra keuangan terpercaya untuk UMKM di Papua: pelatihan literasi keuangan, konsultasi & pendampingan, serta set-up pembukuan usaha yang praktis dan mudah dipahami.')">
    <meta name="keywords" content="@yield('meta_keywords', 'MY Financials, keuangan UMKM, pembukuan UMKM, konsultasi keuangan, pelatihan keuangan, literasi keuangan, perencanaan keuangan, akuntansi UMKM, Papua, Jayapura, Sentani')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <link rel="icon" type="image/png" href="{{ asset('images/myf/logo-my-financials.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/myf/logo-my-financials.png') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="@yield('page_title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', 'Mitra keuangan terpercaya untuk UMKM di Papua — pelatihan, konsultasi, dan set-up pembukuan usaha.')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/myf/1.jpg'))">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('page_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('meta_description', 'Mitra keuangan terpercaya untuk UMKM di Papua — pelatihan, konsultasi, dan set-up pembukuan usaha.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/myf/1.jpg'))">

    {{-- Fonts & icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,600;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body class="font-sans bg-cream text-ink antialiased overflow-x-hidden">

    @include('partials.dev-notice')
    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>

</html>
