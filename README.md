# MY Financials — Landing Page

Landing page profil & layanan **MY Financials**, mitra keuangan terpercaya untuk UMKM di Papua: pelatihan literasi keuangan, konsultasi & pendampingan, serta set-up pembukuan usaha.

Website satu halaman (single page) yang responsif (mobile-first), dibangun dengan **HTML + Tailwind CSS + JavaScript murni** tanpa proses build (memakai Tailwind Play CDN).

## ✨ Fitur Utama

### Navigasi
- Navbar sticky dengan efek bayangan saat halaman digulir.
- Logo besar yang sebagian menggantung di bawah garis navbar + judul teks "MY Financials".
- **Scroll-spy**: menu otomatis menyorot section yang sedang dilihat.
- Menu **mobile (hamburger)** dengan animasi ikon (jadi tanda X), item rata tengah, dan **separator titik (•)** antar menu.
- Tombol CTA **Hubungi Kami** (ikon WhatsApp, uppercase) di desktop maupun mobile.

### Section Halaman
- **Hero** — background slider 5 gambar dengan efek zoom (Ken Burns) + overlay gradient, judul, dan 4 kartu keunggulan.
- **Siapa Kami** — ringkasan layanan + kartu, termasuk kartu *"Mitra yang Dapat Diandalkan"* dengan background foto + overlay warna tema.
- **Tentang Kami** — timeline perjalanan + daftar nilai perusahaan.
- **Visi & Misi** — kartu visi (dengan foto kegiatan) dan misi.
- **Layanan** — 3 kartu layanan (1 kartu unggulan bertema gelap).
- **Portofolio** — 6 proyek/kegiatan terkini.
- **Tim** — section latar gelap, 2 anggota tim; foto tampil **grayscale** dan berubah **berwarna saat hover**.
- **Kontak** — info kontak + form pesan.

### Interaksi
- **Form "Kirim Pesan" → WhatsApp**: isian form (nama, email, kebutuhan, pesan) otomatis menjadi teks dan dibuka ke chat WhatsApp `+62 821 9090 2163`.
- **Tombol mengambang (kanan bawah)**:
  - *Hubungi & Konsultasi Awal di WhatsApp* — pill dengan foto Meitilda Yaung + badge WhatsApp.
  - *Back to top* — muncul setelah menggulir > 400px, klik untuk kembali ke atas dengan animasi halus.
- Judul & sub-judul setiap section dibuat rata tengah.

### Lainnya
- **SEO dioptimalkan**: meta description, keywords, Open Graph, Twitter Card, dan structured data JSON-LD (Schema.org `FinancialService`). Gambar share (og:image) memakai `img/1.jpg`.
- **Favicon** + apple-touch-icon dari logo.
- **Aksesibilitas**: `aria-label`, teks `alt`, dukungan `prefers-reduced-motion` (menonaktifkan animasi bila pengguna memintanya).
- Footer dengan logo putih + kredit **Powered by Nokensoft**.

## 🛠️ Teknologi
- **HTML5**
- **Tailwind CSS** (Play CDN) — konfigurasi tema inline + komponen via `@layer components` (`@apply`).
- **JavaScript** (vanilla, tanpa framework) — `js/script.js`.
- **Font Awesome 6.5** (ikon).
- **Google Fonts** — *Lora* (judul) & *Plus Jakarta Sans* (teks).

## 📁 Struktur Proyek
```
212-my-financials/
├── index.html            # Seluruh markup + konfigurasi & komponen Tailwind
├── js/
│   └── script.js         # Navbar, menu mobile, slider hero, scroll-spy, form→WA, back-to-top
├── img/                  # Gambar & logo
│   ├── 1.jpg ... 5.jpg               # Slide hero / aset
│   ├── logo-my-financials.png        # Logo (latar terang)
│   ├── logo-my-financials-white.png  # Logo (latar gelap / footer)
│   ├── logo-nokensoft.jpg            # Logo Nokensoft
│   ├── Meitilda Yaung, B.Acc., CFP.png
│   └── Hana Sesa, S.M.png
└── README.md
```

## 🚀 Cara Menjalankan
Cara tercepat — buka langsung `index.html` di browser.

Disarankan menjalankan lewat server lokal (agar semua aset & font termuat optimal):
```bash
# Python 3
python -m http.server 8000
# lalu buka http://localhost:8000
```
Tailwind dimuat via CDN, jadi **butuh koneksi internet** saat membuka halaman.

## 🎨 Kustomisasi
- **Warna tema** — ubah di `tailwind.config` (dalam `index.html`): `rust`, `ink`, `stone`, `cream`, `muted`, `line`.
- **Font** — ubah `fontFamily` di `tailwind.config` dan tautan Google Fonts.
- **Nomor WhatsApp** — ubah `WA_NUMBER` di `js/script.js` serta tautan `wa.me/...` pada tombol mengambang (saat ini `6282190902163`).
- **Konten** — edit langsung di `index.html`.
- **Breakpoint menu** — menu mobile aktif di bawah `900px` (custom screen `navmenu` di `tailwind.config`).

## 🔍 Catatan SEO & Deploy
- Ganti placeholder `https://www.example.com` dengan **domain produksi** Anda pada: `<link rel="canonical">`, `og:url`, dan `url` di JSON-LD.
- Untuk pratinjau share (WhatsApp/Facebook/Twitter), gunakan **URL absolut** pada `og:image` / `twitter:image` (mis. `https://domain-anda/img/1.jpg`).
- Opsional saat deploy: tambahkan `sitemap.xml` dan `robots.txt`.
- Untuk produksi, pertimbangkan membangun Tailwind via CLI (CSS lebih kecil & menghilangkan peringatan "cdn.tailwindcss.com should not be used in production").

## 📞 Kontak
- **Telepon / WhatsApp**: +62 821 9090 2163
- **Email**: msy.financials@outlook.com
- **Instagram**: [@my.financials](https://instagram.com/my.financials)
- **Alamat**: Sentani, Kab. Jayapura — Papua, Indonesia

---
© 2025 MY Financials — Mitra Keuangan UMKM Papua. Powered by **Nokensoft**.
