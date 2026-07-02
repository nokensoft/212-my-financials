@extends('layouts.dashboard')

@section('page_title', 'Blog')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <form method="GET" class="flex gap-2 w-full sm:max-w-sm">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari artikel..."
                class="w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-900 px-4 py-2 text-sm focus:ring-2 focus:ring-primary outline-none">
            <button class="px-4 py-2 rounded-xl bg-slate-800 dark:bg-white/10 text-white text-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard.posts.trash') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-white/10 transition"><i class="fa-solid fa-trash-can"></i> Sampah</a>
            <a href="{{ route('dashboard.posts.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-plus"></i> Tulis Artikel</a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 dark:bg-white/5 text-slate-500 text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Judul</th>
                        <th class="px-5 py-3 font-semibold hidden md:table-cell">Kategori</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold hidden sm:table-cell">Tanggal</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/10">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3">
                                <p class="font-semibold">{{ $post->title }}</p>
                                <p class="text-xs text-slate-400">{{ $post->views }} dilihat</p>
                            </td>
                            <td class="px-5 py-3 hidden md:table-cell">
                                <div class="flex flex-wrap gap-1">
                                    @forelse ($post->categories as $cat)
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 dark:bg-white/5 text-slate-500">{{ $cat->name }}</span>
                                    @empty
                                        <span class="text-xs text-slate-300">—</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $post->status === 'published' ? 'bg-primary-50 text-primary-700 dark:bg-primary-500/10 dark:text-primary-300' : 'bg-slate-100 text-slate-500 dark:bg-white/5' }}">{{ $post->status }}</span>
                            </td>
                            <td class="px-5 py-3 hidden sm:table-cell text-slate-500">{{ $post->published_human ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('dashboard.posts.edit', $post) }}" class="w-8 h-8 grid place-items-center rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-white/5" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                    <form method="POST" action="{{ route('dashboard.posts.destroy', $post) }}">
                                        @csrf @method('DELETE')
                                        <button type="button" title="Hapus"
                                            @click="$store.confirm.ask($el.closest('form'), { title: 'Pindahkan ke Sampah', message: 'Artikel ini akan dipindahkan ke tempat sampah. Anda bisa memulihkannya nanti.', confirmText: 'Pindahkan' })"
                                            class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-slate-400">Belum ada artikel. <a href="{{ route('dashboard.posts.create') }}" class="text-primary font-semibold">Tulis sekarang</a>.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $posts->links() }}</div>
@endsection
