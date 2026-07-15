@extends('layouts.member')

@section('page_title', 'Pesan Paket')

@php($input = 'w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-rust focus:border-rust outline-none')

@section('content')
    <a href="{{ route('member.packages') }}" class="inline-flex items-center gap-2 text-sm text-muted hover:text-rust mb-5"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar paket</a>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl border border-line p-6">
            <h1 class="font-bold text-lg mb-4">Konfirmasi Pemesanan</h1>
            @if ($package->isFree())
                <div class="mb-5 flex items-start gap-3 rounded-xl bg-primary-50 border border-primary-100 text-primary-700 px-4 py-3">
                    <i class="fa-solid fa-gift mt-0.5"></i>
                    <p class="text-sm font-medium">Paket ini <b>gratis</b>. Anda tidak perlu melakukan pembayaran maupun mengunggah bukti transfer &mdash; pesanan langsung dikonfirmasi.</p>
                </div>
            @endif
            <form method="POST" action="{{ route('member.orders.store', $package) }}" @unless ($package->isFree()) enctype="multipart/form-data" @endunless class="space-y-5">
                @csrf
                @unless ($package->isFree())
                    <input type="hidden" name="payment_method" value="Transfer Mandiri">
                @endunless
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Jadwal Diinginkan <span class="text-muted font-normal">(opsional)</span></label>
                    <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" class="{{ $input }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">Catatan <span class="text-muted font-normal">(opsional)</span></label>
                    <textarea name="notes" rows="3" class="{{ $input }}" placeholder="Ceritakan kebutuhan Anda...">{{ old('notes') }}</textarea>
                </div>
                @unless ($package->isFree())
                    <div>
                        <label class="block text-sm font-semibold mb-1.5">Bukti Transfer <span class="text-muted font-normal">(opsional, bisa diunggah nanti)</span></label>
                        @include('partials.proof-field')
                    </div>
                @endunless
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-rust text-white text-sm font-bold hover:bg-rust-dark transition">
                    <i class="fa-solid {{ $package->isFree() ? 'fa-gift' : 'fa-check' }}"></i> {{ $package->isFree() ? 'Ambil Paket Gratis' : 'Buat Pesanan' }}
                </button>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-line p-6 h-fit space-y-4">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-rust">{{ $package->tier }}</p>
                <h2 class="font-bold text-lg mt-1">{{ $package->name }}</h2>
                <p class="text-sm text-muted mt-2">{{ $package->description }}</p>
                <div class="mt-4 pt-4 border-t border-line flex items-center justify-between">
                    <span class="text-muted text-sm">Total</span>
                    <span class="text-2xl font-extrabold text-rust">{{ $package->price_label }}</span>
                </div>
                <p class="text-xs text-muted mt-2"><i class="fa-regular fa-clock"></i> {{ $package->duration }}</p>
            </div>
            @unless ($package->isFree())
                <div class="pt-2 border-t border-line">
                    @include('partials.bank-info')
                </div>
            @endunless
        </div>
    </div>
@endsection
