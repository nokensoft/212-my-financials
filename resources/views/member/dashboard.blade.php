@extends('layouts.member')

@section('page_title', 'Beranda Member')

@section('content')
    <div class="mb-6">
        <h1 class="font-serif text-2xl font-semibold">Halo, {{ $member->name }} 👋</h1>
        <p class="text-muted text-sm mt-1">Selamat datang di Area Member MY Financials.</p>
    </div>

    @if ($member->isPending())
        <div class="mb-6 flex items-start gap-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3">
            <i class="fa-solid fa-clock mt-0.5"></i>
            <p class="text-sm font-medium">Akun Anda sedang <b>menunggu verifikasi</b> admin. Anda tetap dapat memesan paket; tim kami akan menghubungi Anda.</p>
        </div>
    @elseif ($member->isRejected())
        <div class="mb-6 flex items-start gap-3 rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3">
            <i class="fa-solid fa-circle-xmark mt-0.5"></i>
            <p class="text-sm font-medium">Akun Anda ditolak. Silakan hubungi admin melalui WhatsApp untuk informasi lebih lanjut.</p>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-2xl border border-line p-5">
            <p class="text-muted text-sm">Total Pesanan</p>
            <p class="text-3xl font-extrabold mt-2">{{ $summary['total'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-line p-5">
            <p class="text-muted text-sm">Pesanan Lunas</p>
            <p class="text-3xl font-extrabold mt-2">{{ $summary['paid'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-line p-5">
            <p class="text-muted text-sm">Total Dibayar</p>
            <p class="text-2xl font-extrabold mt-2 text-rust">Rp {{ number_format($summary['spent'], 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-line overflow-hidden">
        <div class="p-5 border-b border-line flex items-center justify-between">
            <h2 class="font-bold">Pesanan Terbaru</h2>
            <a href="{{ route('member.packages') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition"><i class="fa-solid fa-plus"></i> Pesan Paket</a>
        </div>
        @if ($orders->count())
            <ul class="divide-y divide-line">
                @foreach ($orders as $o)
                    <li class="px-5 py-3 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <p class="font-semibold truncate">{{ $o->package_name }}</p>
                            <p class="text-xs text-muted">{{ $o->invoice_no }} · {{ $o->created_at->locale('id')->translatedFormat('d M Y') }}</p>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $o->statusClass() }}">{{ $o->statusLabel() }}</span>
                            <a href="{{ route('member.orders.show', $o) }}" class="text-rust text-xs font-semibold hover:underline">Detail</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="px-5 py-12 text-center text-muted">
                <i class="fa-regular fa-file-lines text-4xl mb-3"></i>
                <p class="text-sm">Belum ada pesanan. <a href="{{ route('member.packages') }}" class="text-rust font-semibold">Pilih paket sekarang</a>.</p>
            </div>
        @endif
    </div>
@endsection
