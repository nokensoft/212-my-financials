{{-- Modal konfirmasi global (Alpine + Tailwind). Dikendalikan via $store.confirm --}}
<div x-show="$store.confirm.open" x-cloak
    @keydown.escape.window="$store.confirm.cancel()"
    class="fixed inset-0 z-[70] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"
        x-show="$store.confirm.open" x-transition.opacity
        @click="$store.confirm.cancel()"></div>

    <div class="relative z-10 w-full max-w-md bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-white/10 p-6"
        x-show="$store.confirm.open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100">
        <div class="flex items-start gap-4">
            <div class="w-11 h-11 rounded-xl bg-red-50 dark:bg-red-500/10 text-red-600 grid place-items-center shrink-0">
                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
            </div>
            <div class="min-w-0">
                <h3 class="font-bold text-lg" x-text="$store.confirm.title"></h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1" x-text="$store.confirm.message"></p>
            </div>
        </div>
        <div class="flex justify-end gap-2 mt-6">
            <button type="button" @click="$store.confirm.cancel()"
                class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-white/10 transition">Batal</button>
            <button type="button" @click="$store.confirm.proceed()"
                class="px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition" x-text="$store.confirm.confirmText"></button>
        </div>
    </div>
</div>
