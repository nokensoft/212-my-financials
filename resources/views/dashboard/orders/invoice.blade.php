<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $order->invoice_no }} · Invoice · {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('images/myf/logo-my-financials.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,600;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@php
    $subtotal = $order->amount;
    $tax = 0;
    $total = $subtotal + $tax;
    $isFree = $order->isFree();
    $paid = $order->isPaid();
@endphp

<body class="font-sans bg-stone text-ink p-4 sm:p-8">

    <div class="no-print max-w-3xl mx-auto mb-4 flex items-center justify-between gap-3">
        <button type="button" onclick="history.back()" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali</button>
        <div class="flex items-center gap-2">
            <span class="text-xs text-muted hidden sm:inline">Gunakan "Simpan sebagai PDF" pada dialog cetak.</span>
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition"><i class="fa-solid fa-print"></i> Cetak / Simpan PDF</button>
        </div>
    </div>

    <div class="max-w-3xl mx-auto bg-white border border-line rounded-2xl shadow-sm overflow-hidden">
        <div class="p-8 sm:p-10">
            <div class="flex items-start justify-between gap-6 pb-6 border-b border-line">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/myf/logo-my-financials.png') }}" alt="MY Financials" class="h-14 w-auto">
                    <div>
                        <p class="font-serif font-semibold text-xl text-rust leading-none">MY Financials</p>
                        <p class="text-xs text-muted mt-1">Mitra Keuangan UMKM Papua</p>
                    </div>
                </div>
                <div class="text-right">
                    <h1 class="font-serif text-2xl font-semibold">INVOICE</h1>
                    <p class="text-sm font-mono text-muted mt-1">{{ $order->invoice_no }}</p>
                    <span class="inline-block mt-2 text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ ($isFree || $paid) ? 'bg-primary-100 text-primary-700' : 'bg-amber-100 text-amber-700' }}">{{ $isFree ? 'GRATIS' : ($paid ? 'LUNAS' : 'BELUM LUNAS') }}</span>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-6 py-6 text-sm">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wide text-muted mb-1">Ditagihkan kepada</p>
                    <p class="font-bold">{{ $order->member?->name ?? '—' }}</p>
                    <p class="text-muted">{{ $order->member?->phone }}</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-[11px] font-bold uppercase tracking-wide text-muted mb-1">Detail</p>
                    <p><span class="text-muted">Tanggal:</span> <span class="font-semibold">{{ $order->created_at->locale('id')->translatedFormat('d F Y') }}</span></p>
                    @if ($order->scheduled_at)
                        <p><span class="text-muted">Jadwal:</span> <span class="font-semibold">{{ $order->scheduled_at->locale('id')->translatedFormat('d F Y, H:i') }} WIT</span></p>
                    @endif
                    <p><span class="text-muted">Pembayaran:</span> <span class="font-semibold">{{ $order->payment_method ?? '—' }}</span></p>
                </div>
            </div>

            <table class="w-full text-sm border-t border-line">
                <thead>
                    <tr class="text-left text-muted">
                        <th class="py-3 font-semibold">Deskripsi</th>
                        <th class="py-3 font-semibold text-center w-16">Qty</th>
                        <th class="py-3 font-semibold text-right w-40">Harga</th>
                    </tr>
                </thead>
                <tbody class="border-t border-line">
                    <tr>
                        <td class="py-4">
                            <p class="font-semibold">Paket Layanan Eksklusif</p>
                            <p class="text-muted text-xs">{{ $order->package_name }}</p>
                        </td>
                        <td class="py-4 text-center">1</td>
                        <td class="py-4 text-right font-semibold">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-end pt-4 border-t border-line">
                <div class="w-full sm:w-72 space-y-2 text-sm">
                    <div class="flex justify-between"><span class="text-muted">Subtotal</span><span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                    <div class="flex justify-between"><span class="text-muted">PPN (0%)</span><span class="font-semibold">Rp {{ number_format($tax, 0, ',', '.') }}</span></div>
                    <div class="flex justify-between pt-2 border-t border-line text-base"><span class="font-bold">Total</span><span class="font-extrabold text-rust">Rp {{ number_format($total, 0, ',', '.') }}</span></div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-line grid sm:grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wide text-muted mb-1">Pembayaran</p>
                    @if ($isFree)
                        <p class="text-muted leading-relaxed">Paket ini <span class="font-semibold text-ink">gratis</span> &mdash; tidak ada pembayaran yang perlu dilakukan.</p>
                    @else
                        <p class="text-muted leading-relaxed">Transfer ke <span class="font-semibold text-ink">BCA 1234567890</span> a.n. MY Financials. Konfirmasi via WhatsApp +62 821 9090 2163.</p>
                    @endif
                </div>
                <div class="sm:text-right">
                    <p class="text-[11px] font-bold uppercase tracking-wide text-muted mb-1">Hormat kami</p>
                    <p class="font-serif text-lg text-rust">MY Financials</p>
                    <p class="text-muted text-xs">Sentani, Kab. Jayapura — Papua</p>
                </div>
            </div>

            <p class="mt-8 text-center text-xs text-muted">Terima kasih atas kepercayaan Anda kepada MY Financials.</p>
        </div>
    </div>

    <p class="no-print max-w-3xl mx-auto mt-4 text-center text-xs text-muted">Powered by Nokensoft.com</p>

</body>

</html>
