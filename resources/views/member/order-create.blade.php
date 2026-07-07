@extends('layouts.member')

@section('page_title', 'Pesan Paket')

@php($input = 'w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-rust focus:border-rust outline-none')

@section('content')
    <a href="{{ route('member.packages') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar paket</a>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl border border-line p-6">
            <h1 class="font-bold text-lg mb-4">Konfirmasi Pemesanan</h1>
            <form method="POST" action="{{ route('member.orders.store', $package) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Metode Pembayaran</label>
                    <select name="payment_method" class="{{ $input }}">
                        <option value="Transfer BCA">Transfer BCA</option>
                        <option value="Transfer Mandiri">Transfer Mandiri</option>
                        <option value="QRIS">QRIS</option>
                        <option value="Tunai">Tunai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Jadwal Diinginkan <span class="text-muted font-normal">(opsional)</span></label>
                    <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" class="{{ $input }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Catatan <span class="text-muted font-normal">(opsional)</span></label>
                    <textarea name="notes" rows="3" class="{{ $input }}" placeholder="Ceritakan kebutuhan Anda...">{{ old('notes') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Bukti Transfer <span class="text-muted font-normal">(opsional, bisa diunggah nanti)</span></label>
                    @include('partials.proof-field')
                </div>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-rust text-white text-sm font-bold hover:bg-rust-dark transition">
                    <i class="fa-solid fa-check"></i> Buat Pesanan
                </button>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-line p-6 h-fit">
            <p class="text-[10px] font-bold uppercase tracking-wider text-rust">{{ $package->tier }}</p>
            <h2 class="font-bold text-lg mt-1">{{ $package->name }}</h2>
            <p class="text-sm text-muted mt-2">{{ $package->description }}</p>
            <div class="mt-4 pt-4 border-t border-line flex items-center justify-between">
                <span class="text-muted text-sm">Total</span>
                <span class="text-2xl font-extrabold text-rust">{{ $package->price_label }}</span>
            </div>
            <p class="text-xs text-muted mt-2"><i class="fa-regular fa-clock"></i> {{ $package->duration }}</p>
        </div>
    </div>
@endsection
