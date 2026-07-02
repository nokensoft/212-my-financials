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
        <span class="text-white/20">•</span>
        <a href="{{ route('member.login') }}" class="hover:text-white transition">Area Member</a>
        <span class="text-white/20">•</span>
        <a href="{{ route('login') }}" class="hover:text-white transition">Masuk Admin</a>
    </div>

    <p>© {{ date('Y') }} <strong>MY Financials</strong>. Mitra Keuangan UMKM Papua. Sentani, Kab. Jayapura – Papua, Indonesia.</p>

    <a class="footer-credit" href="https://nokensoft.com" target="_blank" rel="noopener noreferrer">
        <img src="{{ asset('images/myf/logo-nokensoft.jpg') }}" alt="Nokensoft">
        <span>Powered by <strong>Nokensoft</strong></span>
    </a>
</footer>
