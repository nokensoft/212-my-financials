<!-- ── FOOTER ── -->
<footer class="bg-ink text-white/50 text-center text-[.82rem] px-6 py-9 flex flex-col items-center gap-3.5">
    <img class="h-40 w-auto opacity-95" src="{{ asset('images/myf/logo-my-financials-white.png') }}" alt="MY Financials">

    <div class="flex flex-wrap justify-center gap-x-5 gap-y-2 text-[.8rem] font-semibold text-white/60">
        <a href="{{ route('blog.index') }}" class="hover:text-white transition">Blog</a>
        <span class="text-white/20">•</span>
        <a href="{{ route('gallery.index') }}" class="hover:text-white transition">Galeri</a>
        <span class="text-white/20">•</span>
        <a href="{{ route('pages.faq') }}" class="hover:text-white transition">FAQ</a>
        <span class="text-white/20">•</span>
        <a href="{{ route('pages.privacy') }}" class="hover:text-white transition">Kebijakan Privasi</a>
        <span class="text-white/20">•</span>
        <a href="{{ route('pages.sitemap') }}" class="hover:text-white transition">Peta Situs</a>
        @guest('member')
            <span class="text-white/20">•</span>
            <a href="{{ route('member.login') }}" class="hover:text-white transition">Area Member</a>
        @endguest
        @guest
            <span class="text-white/20">•</span>
            <a href="{{ route('login') }}" class="hover:text-white transition">Masuk Admin</a>
        @endguest
    </div>

    @auth('member')
        @php($m = auth('member')->user())
        @php($mStatus = \App\Models\Member::statuses()[$m->status] ?? null)
        <div class="flex flex-wrap items-center justify-center gap-2">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-[.8rem] font-semibold text-white/85">
                <i class="fa-solid fa-circle-user text-white/60"></i> {{ $m->name }}
                @if ($mStatus)
                    <span class="rounded-full px-2 py-0.5 text-[.62rem] font-bold uppercase {{ $mStatus['class'] }}">{{ $mStatus['label'] }}</span>
                @endif
            </span>
            <a href="{{ route('member.dashboard') }}" class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1.5 text-[.8rem] font-semibold text-white/70 hover:bg-white/15 hover:text-white transition"><i class="fa-solid fa-gauge-high"></i> Area Member</a>
            <form method="POST" action="{{ route('member.logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1.5 text-[.8rem] font-semibold text-white/70 hover:bg-red-500/25 hover:text-white transition"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
            </form>
        </div>
    @endauth

    @auth
        @php($u = auth()->user())
        <div class="flex flex-wrap items-center justify-center gap-2">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-[.8rem] font-semibold text-white/85">
                <i class="fa-solid fa-user-shield text-white/60"></i> {{ $u->name }}
                <span class="rounded-full bg-white/15 px-2 py-0.5 text-[.62rem] font-bold uppercase text-white/80">{{ $u->isAdmin() ? 'Admin' : 'Operator' }}</span>
            </span>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1.5 text-[.8rem] font-semibold text-white/70 hover:bg-white/15 hover:text-white transition"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1.5 text-[.8rem] font-semibold text-white/70 hover:bg-red-500/25 hover:text-white transition"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
            </form>
        </div>
    @endauth

    <p>© {{ date('Y') }} <strong>MY Financials</strong>. Mitra Keuangan UMKM Papua. Sentani, Kab. Jayapura – Papua, Indonesia.</p>

    <a class="footer-credit" href="https://nokensoft.com" target="_blank" rel="noopener noreferrer">
        <img src="{{ asset('images/myf/logo-nokensoft.jpg') }}" alt="Nokensoft">
        <span>Powered by <strong>Nokensoft</strong></span>
    </a>
</footer>
