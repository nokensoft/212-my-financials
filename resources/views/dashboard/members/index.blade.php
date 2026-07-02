@extends('layouts.dashboard')

@section('page_title', 'Member')

@php
    $statusMap = [
        'verified' => ['label' => 'Terverifikasi', 'class' => 'bg-primary-100 text-primary-700'],
        'pending' => ['label' => 'Menunggu Verifikasi', 'class' => 'bg-amber-100 text-amber-700'],
        'rejected' => ['label' => 'Ditolak', 'class' => 'bg-red-100 text-red-700'],
    ];
@endphp

@section('content')
    @include('partials.sim-badge', ['note' => 'Simulasi sistem member: pendaftaran via nomor HP / akun Google lalu diverifikasi admin. Tombol aksi hanya tampilan.'])

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <p class="text-sm text-muted">Kelola & verifikasi akun member yang mendaftar.</p>
        <div class="flex flex-wrap gap-2">
            <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-line text-sm font-semibold"><i class="fa-solid fa-user-group text-rust"></i> {{ count($members) }} member</span>
            <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-sm font-semibold"><i class="fa-solid fa-clock"></i> {{ collect($members)->where('status', 'pending')->count() }} menunggu</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-line overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-stone text-muted text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Member</th>
                        <th class="px-5 py-3 font-semibold hidden md:table-cell">Metode Daftar</th>
                        <th class="px-5 py-3 font-semibold hidden sm:table-cell">Bergabung</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @foreach ($members as $m)
                        <tr class="hover:bg-stone/60">
                            <td class="px-5 py-3">
                                <p class="font-semibold">{{ $m['name'] }}</p>
                                <p class="text-xs text-muted">{{ $m['phone'] }}@if ($m['email']) · {{ $m['email'] }}@endif</p>
                            </td>
                            <td class="px-5 py-3 hidden md:table-cell">
                                @if ($m['provider'] === 'google')
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-muted"><i class="fa-brands fa-google text-rust"></i> Akun Google</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-muted"><i class="fa-solid fa-phone text-rust"></i> Nomor HP</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 hidden sm:table-cell text-muted">{{ \Illuminate\Support\Carbon::parse($m['joined_at'])->locale('id')->translatedFormat('d M Y') }}</td>
                            <td class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $statusMap[$m['status']]['class'] }}">{{ $statusMap[$m['status']]['label'] }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('dashboard.members.show', $m['id']) }}" class="w-8 h-8 grid place-items-center rounded-lg text-muted hover:bg-stone" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                    @if ($m['status'] !== 'verified')
                                        <button type="button" title="Verifikasi (simulasi)" class="w-8 h-8 grid place-items-center rounded-lg text-primary hover:bg-primary-50"><i class="fa-solid fa-circle-check"></i></button>
                                    @endif
                                    @if ($m['status'] !== 'rejected')
                                        <button type="button" title="Tolak (simulasi)" class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50"><i class="fa-solid fa-circle-xmark"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
