@extends('layouts.app')

@section('page_title', 'Kebijakan Privasi')
@section('meta_description', 'Kebijakan privasi MY Financials mengenai pengumpulan dan penggunaan data pengunjung situs.')

@section('content')
    <header class="pt-32 pb-8 px-6 bg-stone border-b border-line">
        <div class="max-w-3xl mx-auto">
            <h1 class="font-serif text-3xl md:text-4xl font-semibold text-ink">Kebijakan Privasi</h1>
            <p class="text-muted mt-2 text-sm">Terakhir diperbarui: {{ now()->locale('id')->translatedFormat('d F Y') }}</p>
        </div>
    </header>

    <section class="py-12 px-6 bg-cream">
        <div class="max-w-3xl mx-auto article-content">
            <p>MY Financials ("kami") menghormati privasi setiap pengunjung situs ini. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.</p>

            <h2>Informasi yang Kami Kumpulkan</h2>
            <p>Kami dapat mengumpulkan informasi yang Anda berikan secara sukarela (misalnya saat menghubungi kami melalui email atau WhatsApp) serta data teknis non-pribadi seperti jenis perangkat dan halaman yang dikunjungi untuk keperluan analitik.</p>

            <h2>Penggunaan Informasi</h2>
            <ul>
                <li>Menanggapi pertanyaan, permintaan konsultasi, dan pemesanan layanan.</li>
                <li>Meningkatkan kualitas konten dan layanan situs.</li>
                <li>Menjaga keamanan serta mencegah penyalahgunaan.</li>
            </ul>

            <h2>Perlindungan Data</h2>
            <p>Kami menerapkan langkah-langkah teknis dan organisasi yang wajar untuk melindungi data Anda dari akses tidak sah, kehilangan, atau penyalahgunaan.</p>

            <h2>Cookie</h2>
            <p>Situs ini dapat menggunakan cookie atau penyimpanan lokal (localStorage) untuk menyimpan preferensi tampilan. Anda dapat menonaktifkannya melalui pengaturan peramban.</p>

            <h2>Hubungi Kami</h2>
            <p>Untuk pertanyaan mengenai kebijakan privasi ini, silakan hubungi kami di <a href="mailto:msy.financials@outlook.com">msy.financials@outlook.com</a>.</p>
        </div>
    </section>
@endsection
