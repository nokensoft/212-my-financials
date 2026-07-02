@extends('layouts.dashboard')

@section('page_title', 'Dashboard')

@section('content')
    {{-- Rekap SIMULASI --}}
    <div class="flex items-center gap-2 mb-3">
        <h2 class="font-bold text-lg">Ringkasan</h2>
        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-amber-100 text-amber-700">Simulasi</span>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @php
            $maxMonthly = max(collect($monthly)->max('amount'), 1);
            $recapCards = [
                ['label' => 'Pendapatan (Lunas)', 'value' => 'Rp '.number_format($recap['revenue'], 0, ',', '.'), 'icon' => 'fa-sack-dollar', 'sub' => 'dari invoice lunas'],
                ['label' => 'Pipeline', 'value' => 'Rp '.number_format($recap['revenue_pipeline'], 0, ',', '.'), 'icon' => 'fa-hourglass-half', 'sub' => 'belum lunas'],
                ['label' => 'Member', 'value' => $recap['members'], 'icon' => 'fa-user-group', 'sub' => $recap['members_pending'].' menunggu verifikasi'],
                ['label' => 'Pemesanan', 'value' => $recap['orders'], 'icon' => 'fa-file-invoice-dollar', 'sub' => $recap['orders_unverified'].' perlu tindakan'],
            ];
        @endphp
        @foreach ($recapCards as $c)
            <div class="bg-white rounded-2xl border border-line p-5">
                <div class="flex items-center justify-between">
                    <span class="text-muted text-sm font-medium">{{ $c['label'] }}</span>
                    <span class="w-9 h-9 rounded-xl bg-primary-50 text-rust grid place-items-center"><i class="fa-solid {{ $c['icon'] }}"></i></span>
                </div>
                <p class="text-2xl font-extrabold mt-3">{{ $c['value'] }}</p>
                <p class="text-xs text-muted mt-1">{{ $c['sub'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Pemesanan terbaru + grafik --}}
    <div class="grid lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 bg-white rounded-2xl border border-line overflow-hidden">
            <div class="p-5 border-b border-line flex items-center justify-between">
                <h2 class="font-bold">Pemesanan Terbaru</h2>
                <a href="{{ route('dashboard.orders.index') }}" class="text-sm text-rust hover:underline">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-line">
                        @foreach ($recentOrders as $o)
                            <tr class="hover:bg-stone/60">
                                <td class="px-5 py-3">
                                    <p class="font-semibold">{{ $o['member'] }}</p>
                                    <p class="text-xs text-muted">{{ $o['package'] }}</p>
                                </td>
                                <td class="px-5 py-3 font-bold whitespace-nowrap">Rp {{ number_format($o['amount'], 0, ',', '.') }}</td>
                                <td class="px-5 py-3"><span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $orderStatuses[$o['status']]['class'] }}">{{ $orderStatuses[$o['status']]['label'] }}</span></td>
                                <td class="px-5 py-3 text-right"><a href="{{ route('dashboard.orders.show', $o['id']) }}" class="text-rust text-xs font-semibold hover:underline">Detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-line p-6">
            <h2 class="font-bold mb-4">Pendapatan Bulanan</h2>
            <div class="flex items-end justify-between gap-2 h-40">
                @foreach ($monthly as $m)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full bg-rust/15 rounded-t-lg flex items-end" style="height: 128px">
                            <div class="w-full bg-rust rounded-t-lg" style="height: {{ round($m['amount'] / $maxMonthly * 100) }}%"></div>
                        </div>
                        <span class="text-[11px] font-semibold text-muted">{{ $m['month'] }}</span>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('dashboard.reports.finance') }}" class="mt-4 inline-flex items-center gap-2 text-sm text-rust font-semibold hover:text-rust-dark">Laporan keuangan <i class="fa-solid fa-arrow-right text-xs"></i></a>
        </div>
    </div>

    {{-- Statistik konten (data nyata) --}}
    <h2 class="font-bold text-lg mb-3">Konten</h2>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @php
            $cards = [
                ['label' => 'Total Artikel', 'value' => $stats['posts'], 'icon' => 'fa-newspaper', 'sub' => $stats['published_posts'].' terbit'],
                ['label' => 'Album', 'value' => $stats['albums'], 'icon' => 'fa-images', 'sub' => 'galeri'],
                ['label' => 'Kategori', 'value' => $stats['categories'], 'icon' => 'fa-tags', 'sub' => 'label konten'],
                ['label' => 'Pengguna', 'value' => $stats['users'], 'icon' => 'fa-users', 'sub' => 'admin & operator'],
            ];
        @endphp
        @foreach ($cards as $c)
            <div class="bg-white rounded-2xl border border-line p-5">
                <div class="flex items-center justify-between">
                    <span class="text-muted text-sm font-medium">{{ $c['label'] }}</span>
                    <span class="w-9 h-9 rounded-xl bg-primary-50 text-rust grid place-items-center"><i class="fa-solid {{ $c['icon'] }}"></i></span>
                </div>
                <p class="text-3xl font-extrabold mt-3">{{ $c['value'] }}</p>
                <p class="text-xs text-muted mt-1">{{ $c['sub'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="flex flex-wrap gap-3 mb-8">
        <a href="{{ route('dashboard.posts.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-plus"></i> Tulis Artikel</a>
        <a href="{{ route('dashboard.albums.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-ink text-white text-sm font-semibold hover:opacity-90 transition"><i class="fa-solid fa-plus"></i> Buat Album</a>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl border border-line p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold">Artikel Terbaru</h2>
                <a href="{{ route('dashboard.posts.index') }}" class="text-sm text-rust hover:underline">Lihat semua</a>
            </div>
            <ul class="divide-y divide-line">
                @forelse ($recentPosts as $post)
                    <li class="py-3 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <p class="font-medium truncate">{{ $post->title }}</p>
                            <p class="text-xs text-muted">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="shrink-0 text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $post->status === 'published' ? 'bg-primary-100 text-primary-700' : 'bg-stone text-muted' }}">{{ $post->status }}</span>
                    </li>
                @empty
                    <li class="py-6 text-center text-muted text-sm">Belum ada artikel.</li>
                @endforelse
            </ul>
        </div>

        <div class="bg-white rounded-2xl border border-line p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold">Album Terbaru</h2>
                <a href="{{ route('dashboard.albums.index') }}" class="text-sm text-rust hover:underline">Lihat semua</a>
            </div>
            <ul class="divide-y divide-line">
                @forelse ($recentAlbums as $album)
                    <li class="py-3 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <p class="font-medium truncate">{{ $album->title }}</p>
                            <p class="text-xs text-muted">{{ $album->photos_count }} foto</p>
                        </div>
                        <span class="shrink-0 text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $album->status === 'published' ? 'bg-primary-100 text-primary-700' : 'bg-stone text-muted' }}">{{ $album->status }}</span>
                    </li>
                @empty
                    <li class="py-6 text-center text-muted text-sm">Belum ada album.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
