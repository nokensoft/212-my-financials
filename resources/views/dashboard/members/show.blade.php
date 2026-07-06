@extends('layouts.dashboard')

@section('page_title', 'Detail Member')

@php($statuses = \App\Models\Member::statuses())

@section('content')
    <a href="{{ route('dashboard.members.index') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar member</a>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl border border-line p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-primary-50 text-rust grid place-items-center text-xl font-bold">{{ \Illuminate\Support\Str::of($member->name)->explode(' ')->take(2)->map(fn ($w) => \Illuminate\Support\Str::substr($w, 0, 1))->implode('') }}</div>
                <div>
                    <h2 class="font-bold text-lg leading-tight">{{ $member->name }}</h2>
                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $statuses[$member->status]['class'] ?? '' }}">{{ $statuses[$member->status]['label'] ?? $member->status }}</span>
                </div>
            </div>
            <dl class="mt-6 space-y-3 text-sm">
                <div class="flex items-center gap-3"><dt class="w-28 text-muted">Nomor HP</dt><dd class="font-semibold">{{ $member->phone }}</dd></div>
                <div class="flex items-center gap-3"><dt class="w-28 text-muted">Email</dt><dd class="font-semibold">{{ $member->email ?? '—' }}</dd></div>
                <div class="flex items-center gap-3"><dt class="w-28 text-muted">Metode Daftar</dt><dd class="font-semibold">{{ $member->google_id ? 'Akun Google' : 'Nomor HP' }}</dd></div>
                <div class="flex items-center gap-3"><dt class="w-28 text-muted">Bergabung</dt><dd class="font-semibold">{{ $member->created_at->locale('id')->translatedFormat('d F Y') }}</dd></div>
            </dl>

            <div class="mt-6 flex flex-wrap gap-2">
                @unless ($member->isVerified())
                    <form method="POST" action="{{ route('dashboard.members.verify', $member) }}">@csrf
                        <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-circle-check"></i> Verifikasi</button>
                    </form>
                @endunless
                @unless ($member->isRejected())
                    <form method="POST" action="{{ route('dashboard.members.reject', $member) }}">@csrf
                        <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 transition"><i class="fa-solid fa-circle-xmark"></i> Tolak</button>
                    </form>
                @endunless
                <a href="{{ route('dashboard.members.edit', $member) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-stone text-ink text-sm font-semibold hover:bg-line transition"><i class="fa-solid fa-pen"></i> Edit</a>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-2xl border border-line p-6">
            <h3 class="font-bold mb-4">Riwayat Pemesanan</h3>
            @if ($orders->count())
                <ul class="divide-y divide-line">
                    @foreach ($orders as $o)
                        <li class="py-3 flex items-center justify-between gap-3">
                            <div class="min-w-0">
                                <p class="font-semibold truncate">{{ $o->package_name }}</p>
                                <p class="text-xs text-muted">{{ $o->invoice_no }} · {{ $o->created_at->locale('id')->translatedFormat('d M Y') }}</p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="font-bold">Rp {{ number_format($o->amount, 0, ',', '.') }}</p>
                                <a href="{{ route('dashboard.orders.show', $o) }}" class="text-xs text-rust font-semibold hover:underline">Lihat pesanan</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="py-8 text-center text-muted text-sm">Belum ada pemesanan dari member ini.</p>
            @endif
        </div>
    </div>
@endsection
