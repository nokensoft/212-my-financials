@extends('layouts.member')

@section('page_title', 'Paket Layanan')

@section('content')
    <div class="mb-6">
        <h1 class="font-serif text-2xl font-semibold">Paket Layanan Eksklusif</h1>
        <p class="text-muted text-sm mt-1">Pilih paket konsultasi keuangan yang sesuai dengan kebutuhan Anda.</p>
    </div>

    @if ($packages->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($packages as $p)
                <div class="bg-white rounded-2xl border border-line p-6 flex flex-col">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-rust">{{ $p->tier }}</span>
                    <h3 class="font-bold text-lg leading-tight mt-1">{{ $p->name }}</h3>
                    <p class="text-sm text-muted mt-2 flex-1">{{ $p->description }}</p>
                    <div class="mt-4">
                        <p class="text-2xl font-extrabold">{{ $p->price_label }}</p>
                        <p class="text-xs text-muted"><i class="fa-regular fa-clock"></i> {{ $p->duration }}</p>
                    </div>
                    <a href="{{ route('member.orders.create', $p) }}" class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition">
                        <i class="fa-solid fa-cart-shopping"></i> Pesan Paket
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl border border-line px-5 py-12 text-center text-muted">
            <i class="fa-regular fa-folder-open text-4xl mb-3"></i>
            <p class="text-sm">Belum ada paket aktif.</p>
        </div>
    @endif
@endsection
