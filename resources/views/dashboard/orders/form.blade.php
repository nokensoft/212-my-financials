@extends('layouts.dashboard')

@section('page_title', 'Buat Pemesanan')

@php($input = 'w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-rust focus:border-rust outline-none')
@php($statuses = \App\Models\Order::statuses())
@php($priceMap = $packages->mapWithKeys(fn ($p) => [$p->id => $p->price]))

@section('content')
    <a href="{{ route('dashboard.orders.index') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar pemesanan</a>

    @if ($members->isEmpty() || $packages->isEmpty())
        <div class="mb-6 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 text-sm">
            <i class="fa-solid fa-circle-info"></i> Butuh minimal 1 member dan 1 paket aktif untuk membuat pemesanan.
        </div>
    @endif

    <form method="POST" action="{{ route('dashboard.orders.store') }}" enctype="multipart/form-data" class="max-w-2xl bg-white rounded-2xl border border-line p-6 space-y-5"
        x-data="{ prices: {{ Illuminate\Support\Js::from($priceMap) }}, amount: '{{ old('amount') }}', setPrice(id) { if (this.prices[id] !== undefined) this.amount = this.prices[id]; } }">
        @csrf
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Member</label>
                <select name="member_id" class="{{ $input }}" required>
                    <option value="">Pilih member</option>
                    @foreach ($members as $m)
                        <option value="{{ $m->id }}" @selected(old('member_id') == $m->id)>{{ $m->name }} — {{ $m->phone }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Paket</label>
                <select name="service_package_id" class="{{ $input }}" required @change="setPrice($event.target.value)">
                    <option value="">Pilih paket</option>
                    @foreach ($packages as $p)
                        <option value="{{ $p->id }}" @selected(old('service_package_id') == $p->id)>{{ $p->name }} ({{ $p->price_label }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Jumlah (Rp)</label>
                <input type="number" name="amount" x-model="amount" class="{{ $input }}" min="0" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Metode Pembayaran</label>
                <input type="text" name="payment_method" value="{{ old('payment_method') }}" class="{{ $input }}" placeholder="mis. Transfer BCA">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1.5">Status</label>
                <select name="status" class="{{ $input }}" required>
                    @foreach ($statuses as $key => $s)
                        <option value="{{ $key }}" @selected(old('status', 'baru') === $key)>{{ $s['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1.5">Jadwal <span class="text-muted font-normal">(opsional)</span></label>
                <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" class="{{ $input }}">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Catatan <span class="text-muted font-normal">(opsional)</span></label>
            <textarea name="notes" rows="2" class="{{ $input }}">{{ old('notes') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1.5">Bukti Transfer <span class="text-muted font-normal">(opsional)</span></label>
            <input type="file" name="payment_proof" accept="image/*,application/pdf"
                class="w-full text-sm text-muted file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-800 file:text-white file:text-sm file:font-semibold">
            <p class="text-xs text-muted mt-1">Format JPG, PNG, atau PDF. Maksimal 4 MB.</p>
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            <a href="{{ route('dashboard.orders.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-stone text-muted text-sm font-semibold hover:bg-line transition">Batal</a>
        </div>
    </form>
@endsection
