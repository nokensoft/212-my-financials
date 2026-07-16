@extends('layouts.dashboard')

@section('page_title', 'Member')

@php($statuses = \App\Models\Member::statuses())

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <form method="GET" class="flex flex-wrap gap-2 w-full sm:max-w-lg">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / nomor HP..."
                class="flex-1 min-w-40 rounded-xl border border-line bg-white px-4 py-2 text-sm focus:ring-2 focus:ring-rust outline-none">
            <select name="status" class="rounded-xl border border-line bg-white px-3 py-2 text-sm focus:ring-2 focus:ring-rust outline-none">
                <option value="">Semua status</option>
                @foreach ($statuses as $key => $s)
                    <option value="{{ $key }}" @selected(request('status') === $key)>{{ $s['label'] }}</option>
                @endforeach
            </select>
            <button class="px-4 py-2 rounded-xl bg-ink text-white text-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <a href="{{ route('dashboard.members.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-user-plus"></i> Tambah Member</a>
    </div>

    <div class="bg-white rounded-2xl border border-line overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-stone text-muted text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold w-12">No</th>
                        <th class="px-5 py-3 font-semibold">Member</th>
                        <th class="px-5 py-3 font-semibold hidden md:table-cell">Metode</th>
                        <th class="px-5 py-3 font-semibold hidden sm:table-cell">Pesanan</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($members as $m)
                        <tr class="hover:bg-stone/60">
                            <td class="px-5 py-3 text-muted">{{ $members->firstItem() + $loop->index }}</td>
                            <td class="px-5 py-3">
                                <p class="font-semibold">{{ $m->name }}</p>
                                <p class="text-xs text-muted">{{ $m->phone }}@if ($m->email) · {{ $m->email }}@endif</p>
                            </td>
                            <td class="px-5 py-3 hidden md:table-cell">
                                @if ($m->google_id)
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-muted"><i class="fa-brands fa-google text-rust"></i> Google</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-muted"><i class="fa-solid fa-phone text-rust"></i> Nomor HP</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 hidden sm:table-cell text-muted">{{ $m->orders_count }}</td>
                            <td class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $statuses[$m->status]['class'] ?? '' }}">{{ $statuses[$m->status]['label'] ?? $m->status }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('dashboard.members.show', $m) }}" class="w-8 h-8 grid place-items-center rounded-lg text-muted hover:bg-stone" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                    @unless ($m->isVerified())
                                        <form method="POST" action="{{ route('dashboard.members.verify', $m) }}">@csrf
                                            <button class="w-8 h-8 grid place-items-center rounded-lg text-primary hover:bg-primary-50" title="Verifikasi"><i class="fa-solid fa-circle-check"></i></button>
                                        </form>
                                    @endunless
                                    @unless ($m->isRejected())
                                        <form method="POST" action="{{ route('dashboard.members.reject', $m) }}">@csrf
                                            <button class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50" title="Tolak"><i class="fa-solid fa-circle-xmark"></i></button>
                                        </form>
                                    @endunless
                                    <a href="{{ route('dashboard.members.edit', $m) }}" class="w-8 h-8 grid place-items-center rounded-lg text-muted hover:bg-stone" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                    <form method="POST" action="{{ route('dashboard.members.destroy', $m) }}">
                                        @csrf @method('DELETE')
                                        <button type="button" title="Hapus"
                                            @click="$store.confirm.ask($el.closest('form'), { title: 'Hapus Member', message: 'Member & pesanannya akan dihapus permanen.', confirmText: 'Hapus' })"
                                            class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-12 text-center text-muted">Belum ada member.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $members->links() }}</div>
@endsection
