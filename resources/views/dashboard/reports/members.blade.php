@extends('layouts.dashboard')

@section('page_title', 'Laporan Member')

@php
    $all = collect($members);
    $verified = $all->where('status', 'verified')->count();
    $pending = $all->where('status', 'pending')->count();
    $rejected = $all->where('status', 'rejected')->count();
    $viaGoogle = $all->where('provider', 'google')->count();
    $viaPhone = $all->where('provider', 'phone')->count();
    $total = max($all->count(), 1);
    $statusMap = [
        'verified' => ['label' => 'Terverifikasi', 'class' => 'bg-primary-100 text-primary-700'],
        'pending' => ['label' => 'Menunggu', 'class' => 'bg-amber-100 text-amber-700'],
        'rejected' => ['label' => 'Ditolak', 'class' => 'bg-red-100 text-red-700'],
    ];
@endphp

@section('content')
    @include('partials.sim-badge', ['note' => 'Laporan member disimulasikan dari data contoh.'])

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach ([
            ['label' => 'Total Member', 'value' => $all->count(), 'icon' => 'fa-user-group'],
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
                        @foreach ($members as $m)
                            <tr>
                                <td class="px-5 py-3">
                                    <p class="font-semibold">{{ $m['name'] }}</p>
                                    <p class="text-xs text-muted">{{ $m['phone'] }}</p>
                                </td>
                                <td class="px-5 py-3 hidden sm:table-cell text-muted">{{ \Illuminate\Support\Carbon::parse($m['joined_at'])->locale('id')->translatedFormat('d M Y') }}</td>
                                <td class="px-5 py-3 font-semibold">{{ $m['orders'] }}</td>
                                <td class="px-5 py-3"><span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $statusMap[$m['status']]['class'] }}">{{ $statusMap[$m['status']]['label'] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
