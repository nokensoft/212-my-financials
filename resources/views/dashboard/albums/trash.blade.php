@extends('layouts.dashboard')

@section('page_title', 'Sampah Album')

@section('content')
    <div class="flex items-center justify-between gap-3 mb-6">
        <a href="{{ route('dashboard.albums.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition">
            <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Album
        </a>
        <span class="text-sm text-slate-500">{{ $albums->total() }} item di tempat sampah</span>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 dark:bg-white/5 text-slate-500 text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Album</th>
                        <th class="px-5 py-3 font-semibold text-center">Foto</th>
                        <th class="px-5 py-3 font-semibold hidden sm:table-cell">Dihapus</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/10">
                    @forelse ($albums as $album)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-slate-100 dark:bg-white/5 shrink-0">
                                        @if ($album->cover_image)
                                            <img src="{{ asset($album->cover_image) }}" alt="" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <span class="font-semibold">{{ $album->title }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-center">{{ $album->photos_count }}</td>
                            <td class="px-5 py-3 hidden sm:table-cell text-slate-500">{{ optional($album->deleted_at)->diffForHumans() }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <form method="POST" action="{{ route('dashboard.albums.restore', $album->id) }}">
                                        @csrf @method('PATCH')
                                        <button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 text-xs font-semibold hover:bg-primary-100 transition"><i class="fa-solid fa-rotate-left"></i> Pulihkan</button>
                                    </form>
                                    <form method="POST" action="{{ route('dashboard.albums.force-delete', $album->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="button"
                                            @click="$store.confirm.ask($el.closest('form'), { title: 'Hapus Permanen', message: 'Album beserta seluruh fotonya akan dihapus permanen dan tidak dapat dikembalikan.', confirmText: 'Hapus permanen' })"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-semibold hover:bg-red-100 transition"><i class="fa-solid fa-trash"></i> Hapus permanen</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-12 text-center text-slate-400"><i class="fa-solid fa-trash-can text-3xl mb-2 block"></i> Tempat sampah kosong.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $albums->links() }}</div>
@endsection
