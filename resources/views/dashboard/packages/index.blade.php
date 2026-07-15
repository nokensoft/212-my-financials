@extends('layouts.dashboard')

@section('page_title', 'Paket Layanan')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <p class="text-sm text-muted">Kelola daftar paket Layanan Eksklusif MY Financials.</p>
        <a href="{{ route('dashboard.packages.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-plus"></i> Tambah Paket</a>
    </div>

    @if ($packages->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($packages as $p)
                <div class="bg-white rounded-2xl border border-line p-6 flex flex-col">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-rust">{{ $p->tier }}</span>
                            <h3 class="font-bold text-lg leading-tight mt-1">{{ $p->name }}</h3>
                        </div>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-stone text-muted shrink-0">{{ $p->code }}</span>
                    </div>
                    <p class="text-sm text-muted mt-3 flex-1">{{ $p->description }}</p>
                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <p class="text-2xl font-extrabold {{ $p->isFree() ? 'text-primary-700' : 'text-ink' }}">{{ $p->price_label }}</p>
                            @if ($p->isFree())
                                <span class="inline-flex items-center gap-1 mt-1 text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-primary-100 text-primary-700"><i class="fa-solid fa-gift"></i> Tanpa bukti transfer</span>
                            @endif
                            <p class="text-xs text-muted mt-1"><i class="fa-regular fa-clock"></i> {{ $p->duration }} · {{ $p->orders_count }} pesanan</p>
                        </div>
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $p->is_active ? 'bg-primary-100 text-primary-700' : 'bg-stone text-muted' }}">{{ $p->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                    </div>
                    <div class="mt-4 pt-4 border-t border-line flex items-center gap-1">
                        <form method="POST" action="{{ route('dashboard.packages.toggle', $p) }}">@csrf
                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-stone text-muted text-xs font-semibold hover:bg-line transition" title="Aktif/Nonaktif">
                                <i class="fa-solid {{ $p->is_active ? 'fa-toggle-on text-primary' : 'fa-toggle-off' }}"></i> {{ $p->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        <a href="{{ route('dashboard.packages.edit', $p) }}" class="ml-auto w-8 h-8 grid place-items-center rounded-lg text-muted hover:bg-stone" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form method="POST" action="{{ route('dashboard.packages.destroy', $p) }}">
                            @csrf @method('DELETE')
                            <button type="button" title="Hapus"
                                @click="$store.confirm.ask($el.closest('form'), { title: 'Hapus Paket', message: 'Paket akan dihapus. Pesanan lama tetap menyimpan nama paket.', confirmText: 'Hapus' })"
                                class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl border border-line px-5 py-12 text-center text-muted">
            <i class="fa-regular fa-folder-open text-4xl mb-3"></i>
            <p class="text-sm">Belum ada paket. <a href="{{ route('dashboard.packages.create') }}" class="text-rust font-semibold">Tambah paket</a>.</p>
        </div>
    @endif
@endsection
