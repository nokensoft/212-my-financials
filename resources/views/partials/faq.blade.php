{{-- Daftar accordion FAQ. Membutuhkan variabel $faqs (array [pertanyaan, jawaban]). --}}
<div class="space-y-3">
    @foreach ($faqs as $i => $faq)
        <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }"
            class="bg-cream border border-line rounded-2xl overflow-hidden">
            <button @click="open = !open" class="w-full flex items-center justify-between gap-4 p-5 text-left font-bold">
                <span>{{ $faq[0] }}</span>
                <i class="fa-solid fa-chevron-down text-rust transition-transform" :class="open && 'rotate-180'"></i>
            </button>
            <div x-show="open" x-cloak x-transition class="px-5 pb-5 text-muted leading-relaxed">
                {{ $faq[1] }}
            </div>
        </div>
    @endforeach
</div>
