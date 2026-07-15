@extends('layouts.app')

@section('page_title', 'Kebijakan Privasi')
@section('meta_description', 'Kebijakan privasi MY Financials mengenai pengumpulan dan penggunaan data pengunjung situs.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Kebijakan Privasi',
        'subtitle' => 'Terakhir diperbarui: ' . now()->locale('id')->translatedFormat('d F Y'),
        'width' => 'max-w-3xl',
        'crumbs' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Kebijakan Privasi'],
        ],
    ])

    <section class="py-12 px-6 bg-cream">
        <div class="max-w-3xl mx-auto article-content">
            <p>MY Financials ("kami") menghormati privasi setiap pengunjung dan member situs ini. Kebijakan ini menjelaskan data apa saja yang kami kumpulkan, bagaimana kami memperolehnya, cara penggunaannya, serta bagaimana kami melindunginya — termasuk data yang diambil saat Anda mendaftar, masuk (login), dan memesan layanan.</p>

            <h2>Informasi yang Kami Kumpulkan</h2>
            <p>Sebagian besar layanan situs dapat diakses tanpa memberikan data pribadi. Namun, untuk membuat akun member, masuk, dan memesan layanan, kami mengumpulkan data berikut:</p>

            <h3>1. Data Akun (pendaftaran & login manual)</h3>
            <ul>
                <li><strong>Nama lengkap</strong> — sebagai identitas member.</li>
                <li><strong>Nomor HP</strong> — digunakan sebagai kredensial masuk (login) dan kontak; harus unik.</li>
                <li><strong>Kata sandi</strong> — disimpan dalam bentuk terenkripsi (hash) dan tidak pernah kami simpan sebagai teks biasa.</li>
            </ul>

            <h3>2. Data Akun via Google (login dengan Google)</h3>
            <p>Jika Anda memilih masuk atau mendaftar menggunakan akun Google, kami menerima data berikut dari Google sesuai izin yang Anda setujui:</p>
            <ul>
                <li><strong>Nama</strong> dan <strong>alamat email</strong> akun Google Anda.</li>
                <li><strong>ID Google</strong> — pengenal unik untuk menautkan akun Anda.</li>
                <li><strong>Foto profil (avatar)</strong> — bila tersedia.</li>
            </ul>
            <p>Kami tidak menerima kata sandi akun Google Anda. Dengan menggunakan login Google, Anda tunduk pula pada <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Kebijakan Privasi Google</a>.</p>

            <h3>3. Data Pemesanan Layanan</h3>
            <p>Saat Anda memesan paket layanan, kami menyimpan:</p>
            <ul>
                <li>Paket yang dipilih, nomor invoice, dan nilai pembayaran.</li>
                <li>Metode pembayaran serta <strong>bukti transfer</strong> yang Anda unggah (berkas gambar atau PDF).</li>
                <li>Jadwal yang Anda tentukan dan catatan tambahan yang Anda tulis.</li>
            </ul>

            <h3>4. Data Teknis</h3>
            <p>Kami dapat mengumpulkan data teknis non-pribadi secara otomatis, seperti jenis perangkat, peramban, dan halaman yang dikunjungi, serta menyimpan sesi login melalui cookie dan token "ingat saya".</p>

            <h2>Cara Kami Memperoleh Data</h2>
            <ul>
                <li><strong>Langsung dari Anda</strong> — saat mendaftar, memperbarui profil, memesan layanan, atau menghubungi kami melalui email/WhatsApp.</li>
                <li><strong>Secara otomatis</strong> — melalui cookie, sesi, dan penyimpanan lokal (localStorage) saat Anda menggunakan situs.</li>
                <li><strong>Dari pihak ketiga</strong> — dari Google saat Anda memilih login dengan Google.</li>
            </ul>

            <h2>Dasar Persetujuan</h2>
            <p>Dengan mendaftar, masuk (termasuk melalui Google), memperbarui profil, atau memesan layanan, Anda menyetujui pengumpulan dan penggunaan data sebagaimana dijelaskan dalam kebijakan ini. Pemberian data tersebut bersifat sukarela, namun sebagian data (mis. nomor HP dan kata sandi) wajib diberikan agar akun dan pemesanan dapat berfungsi.</p>

            <h2>Penggunaan Informasi</h2>
            <ul>
                <li>Membuat dan mengelola akun member serta memproses login Anda.</li>
                <li>Memproses pemesanan, memverifikasi pembayaran, dan menerbitkan invoice.</li>
                <li>Menanggapi pertanyaan, permintaan konsultasi, dan kebutuhan layanan.</li>
                <li>Menghubungi Anda terkait status akun dan pesanan.</li>
                <li>Meningkatkan kualitas konten dan layanan situs.</li>
                <li>Menjaga keamanan serta mencegah penyalahgunaan.</li>
            </ul>

            <h2>Verifikasi Akun</h2>
            <p>Akun member baru berstatus "menunggu verifikasi" hingga ditinjau oleh admin kami. Proses ini digunakan untuk memastikan keabsahan data dan mencegah penyalahgunaan layanan.</p>

            <h2>Berbagi Data dengan Pihak Ketiga</h2>
            <p>Kami tidak menjual atau menyewakan data pribadi Anda. Data hanya dibagikan kepada penyedia layanan yang membantu operasional kami, seperti layanan autentikasi Google dan penyedia layanan email, atau bila diwajibkan oleh hukum yang berlaku.</p>

            <h2>Penyimpanan & Perlindungan Data</h2>
            <p>Kata sandi disimpan dalam bentuk hash, dan berkas bukti transfer disimpan pada penyimpanan situs. Kami menerapkan langkah-langkah teknis dan organisasi yang wajar untuk melindungi data Anda dari akses tidak sah, kehilangan, atau penyalahgunaan. Data disimpan selama akun Anda aktif atau selama diperlukan untuk keperluan layanan dan kepatuhan hukum.</p>

            <h2>Hak Anda</h2>
            <ul>
                <li>Melihat dan memperbarui data profil (nama, nomor HP, email, kata sandi) melalui halaman profil member.</li>
                <li>Meminta penghapusan akun dan data pribadi Anda dengan menghubungi kami.</li>
                <li>Menarik persetujuan penggunaan data, dengan konsekuensi sebagian layanan mungkin tidak dapat digunakan.</li>
            </ul>

            <h2>Cookie & Penyimpanan Lokal</h2>
            <p>Situs ini menggunakan cookie untuk menjaga sesi login Anda serta penyimpanan lokal (localStorage) untuk menyimpan preferensi tampilan. Anda dapat menonaktifkan cookie melalui pengaturan peramban, namun hal ini dapat memengaruhi fungsi login.</p>

            <h2>Perubahan Kebijakan</h2>
            <p>Kami dapat memperbarui kebijakan ini dari waktu ke waktu. Perubahan akan ditampilkan pada halaman ini beserta tanggal pembaruan terakhir.</p>

            <h2>Hubungi Kami</h2>
            <p>Untuk pertanyaan mengenai kebijakan privasi ini atau permintaan terkait data Anda, silakan kunjungi <a href="{{ route('pages.contact') }}">halaman Hubungi Kami</a> atau kirim email ke <a href="mailto:msy.financials@outlook.com">msy.financials@outlook.com</a>.</p>
        </div>
    </section>
@endsection
