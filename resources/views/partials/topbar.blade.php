{{-- ── TOPBAR (visitor) — kontak kiri, area member kanan ── --}}
<div class="topbar fixed inset-x-0 z-[55] bg-ink text-white/60 flex items-center">
    <div class="max-w-[1200px] mx-auto w-full flex items-center justify-between px-6 max-[480px]:px-4 h-full">

        {{-- Kiri: Telepon + Instagram --}}
        <div class="flex items-center gap-4 text-[.7rem] font-semibold">
            <a href="tel:+6282190902163"
               class="flex items-center gap-1.5 hover:text-white transition no-underline">
                <i class="fa-solid fa-phone text-[.6rem]"></i>
                <span class="hidden xs:inline">+62 821 9090 2163</span>
            </a>
            <a href="https://instagram.com/my.financials" target="_blank" rel="noopener noreferrer"
               class="flex items-center gap-1.5 hover:text-white transition no-underline">
                <i class="fa-brands fa-instagram"></i>
                <span class="hidden sm:inline">@my.financials</span>
            </a>
        </div>

        {{-- Kanan: area member --}}
        <div class="flex items-center gap-3 text-[.7rem] font-semibold">
            @auth('member')
                @php($m = auth('member')->user())
                @php($mStatus = \App\Models\Member::statuses()[$m->status] ?? null)
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-circle-user text-white/40"></i>
                    <span class="hidden xs:inline max-w-[100px] truncate text-white/80">{{ $m->name }}</span>
                    @if ($mStatus)
                        <span class="hidden sm:inline rounded-full px-1.5 py-0.5 text-[.6rem] font-bold uppercase {{ $mStatus['class'] }}">{{ $mStatus['label'] }}</span>
                    @endif
                </span>
                <span class="text-white/20">|</span>
                <a href="{{ route('member.dashboard') }}"
                   class="flex items-center gap-1 hover:text-white transition no-underline">
                    <i class="fa-solid fa-gauge-high text-[.6rem]"></i>
                    <span>Area Member</span>
                </a>
            @else
                <a href="{{ route('member.register') }}"
                   class="flex items-center gap-1 hover:text-white transition no-underline">
                    <i class="fa-solid fa-user-plus text-[.6rem]"></i>
                    <span>Daftar</span>
                </a>
                <span class="text-white/20">|</span>
                <a href="{{ route('member.login') }}"
                   class="flex items-center gap-1 hover:text-white transition no-underline">
                    <i class="fa-solid fa-right-to-bracket text-[.6rem]"></i>
                    <span>Masuk</span>
                </a>
            @endauth
        </div>
    </div>
</div>
