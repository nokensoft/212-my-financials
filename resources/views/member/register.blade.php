<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member · {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('images/myf/logo-my-financials.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,600;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-stone text-ink min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-3">
                <img src="{{ asset('images/myf/logo-my-financials.png') }}" alt="Logo MY Financials" class="h-16 w-auto object-contain">
                <span class="font-serif font-semibold text-2xl text-rust">MY Financials</span>
            </a>
            <p class="text-muted mt-3 text-sm">Daftar sebagai Member MY Financials</p>
        </div>

        <div class="mb-4 flex items-start gap-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3">
            <i class="fa-solid fa-circle-info mt-0.5"></i>
            <p class="text-xs font-medium">Setelah mendaftar, akun Anda akan berstatus <b>menunggu verifikasi</b> oleh admin.</p>
        </div>

        <div class="bg-cream rounded-3xl shadow-xl border border-line p-8">
            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                    <ul class="list-disc list-inside space-y-0.5">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form method="POST" action="{{ route('member.register') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-semibold mb-1.5">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Anda"
                        class="w-full rounded-xl border border-line bg-white px-4 py-2.5 focus:ring-2 focus:ring-rust focus:border-rust outline-none">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-semibold mb-1.5">Nomor HP (WA)</label>
                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required placeholder="08xx xxxx xxxx"
                        class="w-full rounded-xl border border-line bg-white px-4 py-2.5 focus:ring-2 focus:ring-rust focus:border-rust outline-none">
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold mb-1.5">Kata Sandi</label>
                    <div class="relative" x-data="{ show: false }">
                        <input id="password" type="password" :type="show ? 'text' : 'password'" name="password" required placeholder="Minimal 6 karakter"
                            class="w-full rounded-xl border border-line bg-white pl-4 pr-11 py-2.5 focus:ring-2 focus:ring-rust focus:border-rust outline-none">
                        <button type="button" @click="show = !show" :aria-label="show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-muted hover:text-rust outline-none">
                            <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold mb-1.5">Ulangi Kata Sandi</label>
                    <div class="relative" x-data="{ show: false }">
                        <input id="password_confirmation" type="password" :type="show ? 'text' : 'password'" name="password_confirmation" required placeholder="••••••••"
                            class="w-full rounded-xl border border-line bg-white pl-4 pr-11 py-2.5 focus:ring-2 focus:ring-rust focus:border-rust outline-none">
                        <button type="button" @click="show = !show" :aria-label="show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-muted hover:text-rust outline-none">
                            <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>
                <label class="flex items-start gap-2 text-sm text-muted">
                    <input type="checkbox" required class="mt-1 rounded border-line text-rust focus:ring-rust">
                    <span>Saya menyetujui <a href="{{ route('pages.privacy') }}" class="text-rust font-semibold">Kebijakan Privasi</a> MY Financials.</span>
                </label>
                <button type="submit" class="w-full bg-rust text-white font-bold py-3 rounded-xl hover:bg-rust-dark transition shadow-lg shadow-rust/20">Daftar</button>
            </form>

            {{-- <div class="flex items-center gap-3 my-5">
                <span class="h-px flex-1 bg-line"></span>
                <span class="text-xs text-muted font-semibold uppercase tracking-wide">atau</span>
                <span class="h-px flex-1 bg-line"></span>
            </div>

            <a href="{{ route('member.google') }}"
                class="w-full flex items-center justify-center gap-3 border border-line bg-white text-ink font-semibold py-3 rounded-xl hover:bg-stone transition">
                <img src="https://www.google.com/favicon.ico" alt="Google" class="w-5 h-5"> Daftar dengan Google
            </a> --}}
        </div>

        <div class="text-center mt-6 text-sm text-muted space-y-2">
            <p>Sudah punya akun? <a href="{{ route('member.login') }}" class="font-semibold text-rust hover:text-rust-dark">Masuk di sini</a></p>
            <p><a href="{{ route('home') }}" class="hover:text-rust"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke situs</a></p>
        </div>
    </div>
</body>

</html>
