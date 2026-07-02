@extends('layouts.dashboard')

@section('page_title', 'Paket Layanan')

@section('content')
    @include('partials.sim-badge', ['note' => 'Simulasi pengelolaan paket Layanan Eksklusif. Menamb/mengubah paket belum tersimpan ke database.'])

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <p class="text-sm text-muted">Kelola daftar paket konsultasi &amp; layanan MY Financials.</p>
        <a href="{{ route('dashboard.packages.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-plus"></i> Tambah Paket</a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($packages as $p)
            <div class="bg-white rounded-2xl border border-line p-6 flex flex-col">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-rust">{{ $p['tier'] }}</span>
                        <h3 class="font-bold text-lg leading-tight mt-1">{{ $p['name'] }}</h3>
                    </div>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-stone text-muted shrink-0">{{ $p['code'] }}</span>
                </div>
                <p class="text-sm text-muted mt-3 flex-1">{{ $p['description'] }}</p>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <p class="text-2xl font-extrabold text-ink">
                            @if ($p['price'] > 0) Rp {{ number_format($p['price'], 0, ',', '.') }} @else <span class="text-primary">Gratis</span> @endif
                        </p>
                        <p class="text-xs text-muted"><i class="fa-regular fa-clock"></i> {{ $p['duration'] }}</p>
                    </div>
                    <a href="{{ route('dashboard.packages.edit', $p['code']) }}" class="inline-flex items-center gap-1.5 text-sm text-rust font-semibold hover:text-rust-dark"><i class="fa-solid fa-pen text-xs"></i> Ubah</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
