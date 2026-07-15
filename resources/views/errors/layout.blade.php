<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#B84A1A">
    <meta name="robots" content="noindex, nofollow">

    <title>@yield('code') · @yield('title') — {{ config('app.name') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/myf/logo-my-financials.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/myf/logo-my-financials.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,600;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Gaya inline mandiri agar halaman error tetap tampil walau pipeline aset gagal (mis. saat error 500). --}}
    <style>
        :root {
            --rust: #b84a1a;
            --rust-dark: #8c3210;
            --rust-light: #e8651f;
            --ink: #1a1210;
            --cream: #fdfcfa;
            --stone: #f5f2ee;
            --muted: #7a6a62;
            --line: #e2d9d2;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html { -webkit-text-size-adjust: 100%; }

        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: var(--cream);
            color: var(--ink);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        a { text-decoration: none; }

        .err-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.25rem;
            position: relative;
            overflow: hidden;
        }

        /* Ornamen halus bertema rust */
        .err-wrap::before,
        .err-wrap::after {
            content: '';
            position: absolute;
            border-radius: 9999px;
            z-index: 0;
        }

        .err-wrap::before {
            width: 420px; height: 420px;
            top: -160px; right: -140px;
            background: radial-gradient(circle at center, rgba(232, 101, 31, .12) 0%, transparent 70%);
        }

        .err-wrap::after {
            width: 360px; height: 360px;
            bottom: -160px; left: -120px;
            background: radial-gradient(circle at center, rgba(184, 74, 26, .10) 0%, transparent 70%);
        }

        .err-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 560px;
            text-align: center;
        }

        .err-logo {
            height: 44px;
            width: auto;
            margin: 0 auto 2.25rem;
            display: block;
        }

        .err-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 68px; height: 68px;
            border-radius: 18px;
            background: rgba(184, 74, 26, .1);
            color: var(--rust);
            font-size: 1.55rem;
            margin-bottom: 1.5rem;
        }

        .err-code {
            font-family: 'Lora', ui-serif, Georgia, serif;
            font-weight: 600;
            font-size: clamp(4.5rem, 16vw, 7.5rem);
            line-height: 1;
            color: var(--rust);
            letter-spacing: -.02em;
        }

        .err-title {
            font-family: 'Lora', ui-serif, Georgia, serif;
            font-weight: 600;
            font-size: clamp(1.4rem, 4vw, 1.9rem);
            color: var(--ink);
            margin: .75rem 0 .85rem;
        }

        .err-message {
            color: var(--muted);
            font-size: 1rem;
            max-width: 30rem;
            margin: 0 auto 2rem;
        }

        .err-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            justify-content: center;
        }

        .err-btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .8rem 1.6rem;
            border-radius: .625rem;
            font-weight: 700;
            font-size: .92rem;
            transition: all .2s ease;
            border: 1.5px solid transparent;
            cursor: pointer;
        }

        .err-btn-primary {
            background: var(--rust);
            color: #fff;
        }

        .err-btn-primary:hover {
            background: var(--rust-light);
            transform: translateY(-1px);
        }

        .err-btn-ghost {
            background: transparent;
            color: var(--ink);
            border-color: var(--line);
        }

        .err-btn-ghost:hover {
            border-color: var(--rust);
            color: var(--rust);
        }

        .err-foot {
            padding: 1.5rem 1.25rem;
            text-align: center;
            color: var(--muted);
            font-size: .8rem;
            border-top: 1px solid var(--line);
        }

        .err-foot a { color: var(--rust); font-weight: 600; }
    </style>
    @stack('head')
</head>

<body>
    <div class="err-wrap">
        <div class="err-card">
            <img class="err-logo" src="{{ asset('images/myf/logo-my-financials.png') }}" alt="{{ config('app.name') }}">

            <div class="err-icon">
                <i class="@yield('icon', 'fa-solid fa-triangle-exclamation')"></i>
            </div>

            <div class="err-code">@yield('code')</div>
            <h1 class="err-title">@yield('title')</h1>
            <p class="err-message">@yield('message')</p>

            <div class="err-actions">
                <a href="{{ url('/') }}" class="err-btn err-btn-primary">
                    <i class="fa-solid fa-house"></i>
                    Kembali ke Beranda
                </a>
                <a href="javascript:history.back()" class="err-btn err-btn-ghost">
                    <i class="fa-solid fa-arrow-left"></i>
                    Halaman Sebelumnya
                </a>
            </div>
        </div>
    </div>

    <footer class="err-foot">
        &copy; {{ date('Y') }} {{ config('app.name') }}. Butuh bantuan? <a href="{{ route('pages.contact') }}">Hubungi kami</a>.
    </footer>
</body>

</html>
