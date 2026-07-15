{{-- ── FLOATING ACTIONS (WhatsApp chat + back to top) ── --}}
@php($waNumber = '6282190902163')
<div class="fab-stack" x-data="waChat('{{ $waNumber }}')" @keydown.escape.window="open = false">

    {{-- Panel form chat (hidden by default) --}}
    <div x-show="open" x-cloak x-transition.origin.bottom.right.duration.200ms
        class="wa-panel w-[320px] max-w-[calc(100vw-3rem)] bg-white rounded-2xl overflow-hidden shadow-[0_16px_50px_rgba(26,18,16,0.28)]">
        <div class="flex items-center gap-3 bg-[#075E54] px-4 py-3">
            <span class="wa-avatar-wrap">
                <img class="wa-avatar !w-10 !h-10" src="{{ asset('images/myf/tim-meitilda.png') }}" alt="Admin MY Financials">
                <span class="wa-badge"><i class="fa-brands fa-whatsapp"></i></span>
            </span>
            <div class="min-w-0 flex-1 text-white">
                <p class="font-bold text-sm leading-tight">MY Financials</p>
                <p class="text-[.7rem] text-white/70 leading-tight">Biasanya membalas dalam beberapa menit</p>
            </div>
            <button type="button" @click="open = false" aria-label="Tutup"
                class="shrink-0 w-8 h-8 rounded-full text-white/80 hover:bg-white/10 grid place-items-center">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form @submit.prevent="send()" class="p-4 flex flex-col gap-3 bg-[#ece5dd]">
            <div>
                <label class="block mb-1 text-[.72rem] font-bold uppercase tracking-[.05em] text-muted">Nama Lengkap</label>
                <input type="text" x-model="name" required placeholder="Nama Anda"
                    class="w-full px-3 py-2 rounded-lg border-[1.5px] border-line bg-white text-sm text-ink outline-none focus:border-rust transition-colors">
            </div>
            <div>
                <label class="block mb-1 text-[.72rem] font-bold uppercase tracking-[.05em] text-muted">No. Telp / WhatsApp</label>
                <input type="tel" x-model="phone" required placeholder="08xxxxxxxxxx" inputmode="tel"
                    class="w-full px-3 py-2 rounded-lg border-[1.5px] border-line bg-white text-sm text-ink outline-none focus:border-rust transition-colors">
            </div>
            <div>
                <label class="block mb-1 text-[.72rem] font-bold uppercase tracking-[.05em] text-muted">Isi Pesan</label>
                <textarea x-model="message" required rows="3" placeholder="Tulis pesan Anda..."
                    class="w-full px-3 py-2 rounded-lg border-[1.5px] border-line bg-white text-sm text-ink outline-none focus:border-rust transition-colors resize-y min-h-[72px]"></textarea>
            </div>
            <button type="submit"
                class="flex w-full items-center justify-center gap-2 py-2.5 rounded-lg bg-[#25D366] text-white font-bold text-sm hover:bg-[#1da851] transition-colors">
                <i class="fa-brands fa-whatsapp text-base"></i> Kirim via WhatsApp
            </button>
        </form>
    </div>

    {{-- Tombol mengambang WhatsApp (toggle) --}}
    <button type="button" class="wa-float" @click="open = !open" :aria-expanded="open" aria-label="Chat WhatsApp dengan MY Financials">
        <span class="wa-avatar-wrap">
            <img class="wa-avatar" src="{{ asset('images/myf/tim-meitilda.png') }}" alt="Meitilda Yaung">
            <span class="wa-badge"><i class="fa-brands fa-whatsapp"></i></span>
        </span>
        <span class="wa-text">Hubungi &amp; <br> Konsultasi</span>
    </button>

    <button id="backToTop" class="back-to-top" type="button" aria-label="Kembali ke atas">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
</div>
