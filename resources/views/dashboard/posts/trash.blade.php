@extends('layouts.dashboard')

@section('page_title', 'Sampah Artikel')

@section('content')
    <div class="flex items-center justify-between gap-3 mb-6">
        <a href="{{ route('dashboard.posts.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition">
            <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Blog
        </a>
        <span class="text-sm text-slate-500">{{ $posts->total() }} item di tempat sampah</span>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 dark:bg-white/5 text-slate-500 text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Judul</th>
                        <th class="px-5 py-3 font-semibold hidden sm:table-cell">Dihapus</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/10">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3">
                                <p class="font-semibold">{{ $post->title }}</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach ($post->categories as $cat)
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 dark:bg-white/5 text-slate-500">{{ $cat->name }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-5 py-3 hidden sm:table-cell text-slate-500">{{ optional($post->deleted_at)->diffForHumans() }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <form method="POST" action="{{ route('dashboard.posts.restore', $post->id) }}">
                                        @csrf @method('PATCH')
                                        <button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 text-xs font-semibold hover:bg-primary-100 transition"><i class="fa-solid fa-rotate-left"></i> Pulihkan</button>
                                    </form>
                                    <form method="POST" action="{{ route('dashboard.posts.force-delete', $post->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="button"
                                            @click="$store.confirm.ask($el.closest('form'), { title: 'Hapus Permanen', message: 'Artikel akan dihapus permanen dan tidak dapat dikembalikan.', confirmText: 'Hapus permanen' })"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-semibold hover:bg-red-100 transition"><i class="fa-solid fa-trash"></i> Hapus permanen</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-5 py-12 text-center text-slate-400"><i class="fa-solid fa-trash-can text-3xl mb-2 block"></i> Tempat sampah kosong.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $posts->links() }}</div>
@endsection
