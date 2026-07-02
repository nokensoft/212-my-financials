@php($inputClass = 'w-full rounded-xl border border-line bg-white px-3 py-2 text-sm text-ink focus:ring-2 focus:ring-rust focus:border-rust outline-none')
<form method="GET" action="{{ $action }}"
    class="bg-cream border border-line rounded-2xl p-4 md:p-5 grid gap-3 md:grid-cols-12 md:items-end">
    <div class="md:col-span-4">
        <label class="block text-xs font-semibold text-muted mb-1">Pencarian</label>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul / isi..." class="{{ $inputClass }}">
    </div>
    <div class="md:col-span-3">
        <label class="block text-xs font-semibold text-muted mb-1">Kategori</label>
        <select name="category" class="{{ $inputClass }}">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $c)
                <option value="{{ $c->slug }}" @selected(request('category') === $c->slug)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="block text-xs font-semibold text-muted mb-1">Urutkan</label>
        <select name="sort" class="{{ $inputClass }}">
            <option value="latest" @selected(request('sort', 'latest') === 'latest')>Terbaru</option>
            <option value="oldest" @selected(request('sort') === 'oldest')>Terlama</option>
            <option value="az" @selected(request('sort') === 'az')>Judul A → Z</option>
            <option value="za" @selected(request('sort') === 'za')>Judul Z → A</option>
        </select>
    </div>
    <div class="md:col-span-3 grid grid-cols-2 gap-2">
        <div>
            <label class="block text-xs font-semibold text-muted mb-1">Dari</label>
            <input type="date" name="from" value="{{ request('from') }}" class="{{ $inputClass }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-muted mb-1">Sampai</label>
            <input type="date" name="to" value="{{ request('to') }}" class="{{ $inputClass }}">
        </div>
    </div>
    <div class="md:col-span-12 flex flex-wrap gap-2 pt-1">
        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-rust text-white text-sm font-semibold hover:bg-rust-dark transition">
            <i class="fa-solid fa-magnifying-glass text-xs"></i> Terapkan Filter
        </button>
        <a href="{{ $action }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-stone text-muted text-sm font-semibold hover:bg-line transition">
            <i class="fa-solid fa-rotate-left text-xs"></i> Reset
        </a>
    </div>
</form>
