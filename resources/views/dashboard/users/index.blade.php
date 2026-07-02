@extends('layouts.dashboard')

@section('page_title', 'Pengguna')

@section('content')
    <div class="flex items-center justify-between gap-3 mb-6">
        <p class="text-sm text-slate-500">Kelola akun admin & operator.</p>
        <a href="{{ route('dashboard.users.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-user-plus"></i> Tambah Pengguna</a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 dark:bg-white/5 text-slate-500 text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Nama</th>
                        <th class="px-5 py-3 font-semibold hidden sm:table-cell">Email</th>
                        <th class="px-5 py-3 font-semibold">Peran</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/10">
                    @foreach ($users as $user)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3 font-semibold">
                                {{ $user->name }}
                                @if ($user->id === auth()->id())
                                    <span class="ml-1 text-[10px] text-slate-400">(Anda)</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 hidden sm:table-cell text-slate-500">{{ $user->email }}</td>
                            <td class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $user->isAdmin() ? 'bg-primary-50 text-primary-700 dark:bg-primary-500/10 dark:text-primary-300' : 'bg-slate-100 text-slate-500 dark:bg-white/5' }}">{{ $user->role }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('dashboard.users.edit', $user) }}" class="w-8 h-8 grid place-items-center rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-white/5"><i class="fa-solid fa-pen"></i></a>
                                    @if ($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('dashboard.users.destroy', $user) }}" onsubmit="return confirm('Hapus pengguna ini?')">
                                            @csrf @method('DELETE')
                                            <button class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $users->links() }}</div>
@endsection
