@php
    $enc = rawurlencode($url);
    $encTitle = rawurlencode($title);
    $links = [
        ['label' => 'WhatsApp', 'icon' => 'fa-whatsapp', 'href' => "https://wa.me/?text={$encTitle}%20{$enc}"],
        ['label' => 'Facebook', 'icon' => 'fa-facebook-f', 'href' => "https://www.facebook.com/sharer/sharer.php?u={$enc}"],
        ['label' => 'X', 'icon' => 'fa-x-twitter', 'href' => "https://twitter.com/intent/tweet?url={$enc}&text={$encTitle}"],
        ['label' => 'Telegram', 'icon' => 'fa-telegram', 'href' => "https://t.me/share/url?url={$enc}&text={$encTitle}"],
    ];
@endphp
<div class="flex flex-wrap items-center gap-2" x-data="{ copied: false }">
    <span class="text-sm font-semibold text-slate-500 dark:text-slate-400 mr-1">
        <i class="fa-solid fa-share-nodes"></i> Bagikan:
    </span>
    @foreach ($links as $link)
        <a href="{{ $link['href'] }}" target="_blank" rel="noopener" aria-label="Bagikan ke {{ $link['label'] }}"
            class="w-9 h-9 grid place-items-center rounded-full bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition">
            <i class="fa-brands {{ $link['icon'] }}"></i>
        </a>
    @endforeach
    <button type="button"
        @click="navigator.clipboard.writeText(@js($url)).then(() => { copied = true; setTimeout(() => copied = false, 2000); })"
        class="inline-flex items-center gap-1.5 h-9 px-3 rounded-full bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10 transition text-sm font-semibold">
        <i class="fa-solid" :class="copied ? 'fa-check text-primary' : 'fa-link'"></i>
        <span x-text="copied ? 'Tersalin' : 'Salin'"></span>
    </button>
</div>
