{{-- Topbar disclaimer khusus tampilan visitor: website masih dalam tahap pengembangan --}}
<div class="dev-notice-bar fixed top-0 inset-x-0 z-[60] h-9 bg-amber-500 text-white flex items-center justify-center px-10 text-xs sm:text-sm font-semibold"
    role="status">
    <i class="fa-solid fa-triangle-exclamation mr-2 shrink-0"></i>
    <span class="truncate">Website ini masih dalam tahap pengembangan.</span>
    <button type="button" aria-label="Tutup pemberitahuan"
        onclick="document.documentElement.classList.add('notice-dismissed'); try { localStorage.setItem('devNoticeDismissed', '1'); } catch (e) {}"
        class="absolute right-2 top-1/2 -translate-y-1/2 w-6 h-6 grid place-items-center rounded hover:bg-white/20 transition">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>
