@extends('layouts.dashboard')

@section('page_title', 'Kategori')

@section('content')
    <div class="flex items-center justify-between gap-3 mb-6">
        <p class="text-sm text-slate-500">Kategori digunakan untuk mengelompokkan & memfilter blog dan album.</p>
        <a href="{{ route('dashboard.categories.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-plus"></i> Tambah</a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 dark:bg-white/5 text-slate-500 text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Nama</th>
                        <th class="px-5 py-3 font-semibold hidden sm:table-cell">Slug</th>
                        <th class="px-5 py-3 font-semibold text-center">Artikel</th>
                        <th class="px-5 py-3 font-semibold text-center">Album</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/10">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3 font-semibold">{{ $category->name }}</td>
                            <td class="px-5 py-3 hidden sm:table-cell text-slate-400">{{ $category->slug }}</td>
                            <td class="px-5 py-3 text-center">{{ $category->posts_count }}</td>
                            <td class="px-5 py-3 text-center">{{ $category->albums_count }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('dashboard.categories.edit', $category) }}" class="w-8 h-8 grid place-items-center rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-white/5"><i class="fa-solid fa-pen"></i></a>
                                    <form method="POST" action="{{ route('dashboard.categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-slate-400">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $categories->links() }}</div>
@endsection
