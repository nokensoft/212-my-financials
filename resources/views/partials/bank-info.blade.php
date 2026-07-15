{{-- Informasi rekening bank tujuan transfer + panduan umum. Butuh Alpine.js. --}}
@php($bankAccount = '1540019669930')
<div class="rounded-xl border border-line bg-stone/60 p-4"
    x-data="{ copied: false, copy() { navigator.clipboard.writeText('{{ $bankAccount }}').then(() => { this.copied = true; setTimeout(() => this.copied = false, 2000); }); } }">
    <p class="text-xs font-bold uppercase tracking-wide text-muted mb-2">Rekening Tujuan Transfer</p>
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-lg bg-white border border-line grid place-items-center shrink-0">
            <i class="fa-solid fa-building-columns text-rust text-lg"></i>
        </div>
        <div class="min-w-0">
            <p class="font-bold leading-tight">Bank Mandiri</p>
            <p class="text-sm text-muted">a.n. PT Mey Hangrang Jaya</p>
        </div>
    </div>
    <div class="mt-3 flex items-center justify-between gap-3 rounded-lg bg-white border border-line px-3 py-2">
        <span class="font-mono font-bold tracking-wider text-ink">{{ $bankAccount }}</span>
        <button type="button" @click="copy()" title="Salin nomor rekening"
            class="shrink-0 inline-flex items-center gap-1.5 text-xs font-semibold text-rust hover:text-rust-dark outline-none">
            <i class="fa-solid" :class="copied ? 'fa-check' : 'fa-copy'"></i>
            <span x-text="copied ? 'Tersalin' : 'Salin'"></span>
        </button>
    </div>

    <p class="text-xs font-bold uppercase tracking-wide text-muted mt-4 mb-2">Panduan Transfer</p>
    <ol class="list-decimal list-inside space-y-1 text-sm text-muted">
        <li>Buka aplikasi m-banking, internet banking, atau ATM Anda.</li>
        <li>Pilih menu <b>Transfer</b> &mdash; tujuan bank <b>Mandiri</b>.</li>
        <li>Masukkan nomor rekening <b>{{ $bankAccount }}</b> a.n. PT Mey Hangrang Jaya.</li>
        <li>Isi nominal <b>sesuai total tagihan</b> pesanan Anda.</li>
        <li>Pastikan nama penerima benar, lalu selesaikan transaksi.</li>
        <li>Simpan struk/bukti transfer, kemudian <b>unggah</b> pada kolom Bukti Transfer di formulir.</li>
    </ol>
</div>
