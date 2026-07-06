# MY Financials — Website & Dashboard

Aplikasi web profil & layanan **MY Financials** — mitra keuangan terpercaya untuk UMKM di Papua: pelatihan literasi keuangan, konsultasi & pendampingan, serta set-up pembukuan usaha.

Dibangun dengan **Laravel 12** dan mengadopsi konsep desain dari template statis (`_template/index.html`): palet hangat **rust/ink/stone/cream**, tipografi **Lora + Plus Jakarta Sans**, dan seluruh section landing page (Hero, Siapa Kami, Tentang, Visi & Misi, Layanan, Layanan Eksklusif, Portofolio, Galeri, Blog, Tim, Kontak).

## Fitur

### Publik (statis + dinamis)
- **Beranda one-page** bergaya template MY Financials; section **Blog & Galeri dimuat dinamis via API + Alpine.js**.
- **Form kontak → WhatsApp** dan tombol mengambang WhatsApp (seperti template).
- **Blog & Artikel**: daftar, detail, multi-kategori, pencarian & filter, SEO (JSON-LD Article/BreadcrumbList).
- **Galeri/Album**: daftar, detail dengan lightbox, filter, JSON-LD ImageGallery.
- **Halaman statis**: FAQ, Kebijakan Privasi, Peta Situs, `sitemap.xml`, `robots.txt`.

### Dinamis — dikelola penuh di dashboard (dengan database)
- **Blog & Kategori**: CRUD dengan editor TinyMCE, multi-kategori, sampul, status, jadwal terbit, kolom SEO.
- **Album & Galeri**: CRUD album + unggah/hapus banyak foto.
- **Member**: CRUD + **verifikasi/tolak** akun member (pending → terverifikasi/ditolak).
- **Paket Layanan** (Layanan Eksklusif): CRUD paket + aktif/nonaktif; paket aktif tampil di beranda & area member.
- **Pemesanan**: buat/daftar/detail pesanan, alur status **baru → menunggu verifikasi → terverifikasi → lunas** (atau batal), dan **cetak Invoice** (siap cetak via `window.print()` → Simpan sebagai PDF). Saat lunas, pemasukan otomatis tercatat ke Kas.
- **Kas & Transaksi**: CRUD pemasukan/pengeluaran (pemasukan invoice lunas tercatat otomatis).
- **Laporan**: rekap dashboard, **Laporan Member**, dan **Laporan Keuangan** (terintegrasi invoice).
- **Pengguna** (khusus admin) & **Profil**.

### Area Member (visitor) — autentikasi & pemesanan
Guard **`member`** terpisah dari admin/operator.
- **Daftar / Masuk** memakai **nomor HP + kata sandi** (tombol **Google** tersedia sebagai stub — belum dikonfigurasi). Akun baru berstatus *menunggu verifikasi*.
- Member dapat **memesan paket**, melihat **riwayat pesanan**, **mencetak invoice** miliknya, dan **mengubah profil**.

## Teknologi
- **Backend**: PHP 8.2, Laravel 12
- **Database**: SQLite (mudah dipindah ke MySQL/PostgreSQL)
- **Frontend**: Blade, Tailwind CSS 4 (`@tailwindcss/vite`), Alpine.js 3
- **Build**: Vite 7 · **Editor**: TinyMCE 8 (self-hosted) · **Ikon/Font**: Font Awesome 6, Google Fonts (Lora, Plus Jakarta Sans)
- **Auth**: session bawaan Laravel + middleware peran (`role:admin`)

## Instalasi
```bash
composer install
npm install                      # postinstall menyalin TinyMCE ke public/tinymce
cp .env.example .env             # APP_NAME sudah "MY Financials"
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
npm run build
```

## Menjalankan (Development)
```bash
npm run dev          # Terminal 1 — Vite
php artisan serve    # Terminal 2 — server aplikasi
```
Buka `http://127.0.0.1:8000`. Dashboard: `/dashboard` · Login admin: `/login` · Area member: `/member/masuk`.

## Akun Default
Dibuat oleh seeder — **segera ganti kata sandi setelah login pertama**.
- **Admin** — email: `admin@myfinancials.id` · kata sandi: `password`
- **Operator** — email: `operator@myfinancials.id` · kata sandi: `password`
- **Member** (contoh, terverifikasi) — nomor HP: `082111223344` · kata sandi: `password`

## Peta Rute Utama
- Publik: `/`, `/blog`, `/blog/{slug}`, `/galeri`, `/galeri/{slug}`, `/faq`, `/kebijakan-privasi`, `/peta-situs`, `/sitemap.xml`, `/robots.txt`
- Area Member: `/member/masuk`, `/member/daftar`, `/member` (beranda), `/member/paket`, `/member/pesan/{paket}`, `/member/pesanan`, `/member/pesanan/{id}/invoice`, `/member/profil`
- API (JSON): `/api/posts`, `/api/categories`, `/api/albums`
- Dashboard (perlu login): `/dashboard`, `/dashboard/posts`, `/dashboard/categories`, `/dashboard/albums`, `/dashboard/users` (admin)
- Dashboard layanan: `/dashboard/members`, `/dashboard/packages`, `/dashboard/orders`, `/dashboard/orders/{id}/invoice`, `/dashboard/transactions`, `/dashboard/reports/members`, `/dashboard/reports/finance`

## Model Data (Layanan)
- `members` (guard `member`; status pending/verified/rejected)
- `service_packages` (paket Layanan Eksklusif)
- `orders` (member → paket; status + invoice + verifikasi)
- `transactions` (kas; pemasukan invoice lunas tercatat otomatis)

## Kustomisasi Tema
- **Warna & font**: `resources/css/app.css` (`@theme`) — skala `primary` (rust), warna `rust`/`ink`/`stone`/`cream`/`muted`/`line`, serta `--font-serif` (Lora).
- **Interaksi publik** (slider hero, scroll-spy, menu mobile, form→WA, back-to-top): `resources/js/app.js`.
- **Nomor WhatsApp**: ubah `WA_NUMBER` di `resources/js/app.js` dan tautan `wa.me/...` di `resources/views/home.blade.php`.

## Catatan
- `_template/` disimpan sebagai **referensi desain** (landing page statis asli).
- **Login Google** masih berupa stub (butuh kredensial OAuth / Laravel Socialite untuk diaktifkan).

## Author
- **Nokensoft.com** — PIC: 082199558191 (Janzen)

Powered by [Nokensoft.com](https://nokensoft.com)
