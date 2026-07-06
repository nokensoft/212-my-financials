@extends('layouts.dashboard')

@section('page_title', 'Laporan Member')

@php
    $statuses = \App\Models\Member::statuses();
    $verified = $members->where('status', 'verified')->count();
    $pending = $members->where('status', 'pending')->count();
    $rejected = $members->where('status', 'rejected')->count();
    $viaGoogle = $members->whereNotNull('google_id')->count();
    $viaPhone = $members->count() - $viaGoogle;
    $total = max($members->count(), 1);
@endphp

@section('content')
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach ([
            ['label' => 'Total Member', 'value' => $members->count(), 'icon' => 'fa-user-group'],
            ['label' => 'Terverifikasi', 'value' => $verified, 'icon' => 'fa-user-check'],
            ['label' => 'Menunggu', 'value' => $pending, 'icon' => 'fa-user-clock'],
            ['label' => 'Ditolak', 'value' => $rejected, 'icon' => 'fa-user-xmark'],
        ] as $c)
            <div class="bg-white rounded-2xl border border-line p-5">
                <div class="flex items-center justify-between">
                    <span class="text-muted text-sm font-medium">{{ $c['label'] }}</span>
                    <span class="w-9 h-9 rounded-xl bg-primary-50 text-rust grid place-items-center"><i class="fa-solid {{ $c['icon'] }}"></i></span>
                </div>
                <p class="text-3xl font-extrabold mt-3">{{ $c['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl border border-line p-6">
            <h3 class="font-bold mb-4">Metode Pendaftaran</h3>
            <div class="space-y-4 text-sm">
                <div>
                    <div class="flex justify-between mb-1"><span class="font-semibold"><i class="fa-brands fa-google text-rust"></i> Akun Google</span><span class="text-muted">{{ $viaGoogle }}</span></div>
                    <div class="h-2.5 rounded-full bg-stone overflow-hidden"><div class="h-full bg-rust" style="width: {{ round($viaGoogle / $total * 100) }}%"></div></div>
                </div>
                <div>
                    <div class="flex justify-between mb-1"><span class="font-semibold"><i class="fa-solid fa-phone text-rust"></i> Nomor HP</span><span class="text-muted">{{ $viaPhone }}</span></div>
                    <div class="h-2.5 rounded-full bg-stone overflow-hidden"><div class="h-full bg-rust-light" style="width: {{ round($viaPhone / $total * 100) }}%"></div></div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-2xl border border-line overflow-hidden">
            <div class="p-5 border-b border-line flex items-center justify-between">
                <h3 class="font-bold">Daftar Member</h3>
                <button type="button" onclick="window.print()" class="no-print inline-flex items-center gap-2 text-sm text-rust font-semibold hover:text-rust-dark"><i class="fa-solid fa-print"></i> Cetak</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-stone text-muted text-left">
                        <tr>
                            <th class="px-5 py-3 font-semibold">Nama</th>
                            <th class="px-5 py-3 font-semibold hidden sm:table-cell">Bergabung</th>
                            <th class="px-5 py-3 font-semibold">Pesanan</th>
                            <th class="px-5 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @forelse ($members as $m)
                            <tr>
                                <td class="px-5 py-3">
                                    <p class="font-semibold">{{ $m->name }}</p>
                                    <p class="text-xs text-muted">{{ $m->phone }}</p>
                                </td>
                                <td class="px-5 py-3 hidden sm:table-cell text-muted">{{ $m->created_at->locale('id')->translatedFormat('d M Y') }}</td>
                                <td class="px-5 py-3 font-semibold">{{ $m->orders_count }}</td>
                                <td class="px-5 py-3"><span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $statuses[$m->status]['class'] ?? '' }}">{{ $statuses[$m->status]['label'] ?? $m->status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-5 py-10 text-center text-muted">Belum ada member.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
