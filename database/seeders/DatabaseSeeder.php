<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Category;
use App\Models\Member;
use App\Models\Order;
use App\Models\Post;
use App\Models\ServicePackage;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun default (ganti kata sandi setelah login pertama).
        $admin = User::updateOrCreate(
            ['email' => 'admin@myfinancials.id'],
            ['name' => 'Administrator MYF', 'password' => 'password', 'role' => User::ROLE_ADMIN],
        );

        $operator = User::updateOrCreate(
            ['email' => 'operator@myfinancials.id'],
            ['name' => 'Operator Konten', 'password' => 'password', 'role' => User::ROLE_OPERATOR],
        );

        // Kategori
        $categoryNames = [
            'Literasi Keuangan', 'Pembukuan', 'Konsultasi', 'UMKM',
            'Perencanaan Keuangan', 'Tips Bisnis', 'Perpajakan',
        ];
        $categories = collect($categoryNames)->mapWithKeys(fn ($name) => [
            $name => Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => 'Artikel seputar '.$name.' bersama MY Financials.'],
            ),
        ]);

        $body = function (string $lead): string {
            return "<p>{$lead}</p>"
                .'<h2>Mengapa Ini Penting</h2>'
                .'<p>MY Financials percaya bahwa pengelolaan keuangan yang rapi adalah fondasi usaha yang sehat dan berkelanjutan. Dengan pencatatan yang teratur, pelaku UMKM dapat mengambil keputusan bisnis dengan lebih percaya diri.</p>'
                .'<h2>Langkah Praktis</h2>'
                .'<p>Melalui pendekatan yang ramah dan mudah dipahami, kami membantu pemilik usaha menerapkan kebiasaan keuangan yang baik secara bertahap.</p>'
                .'<ul><li>Pisahkan keuangan pribadi dan usaha</li><li>Catat setiap transaksi harian</li><li>Susun laporan sederhana secara rutin</li></ul>'
                .'<p>Kami berkomitmen mendampingi UMKM Papua agar tumbuh mandiri dan berdaya saing.</p>';
        };

        // Artikel blog
        $posts = [
            [
                'title' => 'Memisahkan Keuangan Pribadi dan Usaha: Langkah Awal UMKM Naik Kelas',
                'excerpt' => 'Kesalahan paling umum pelaku UMKM adalah mencampur uang pribadi dan usaha. Simak cara memisahkannya dengan sederhana.',
                'cover' => 'images/myf/1.jpg',
                'date' => '2026-07-01 09:00',
                'views' => 142,
                'cats' => ['Literasi Keuangan', 'UMKM'],
            ],
            [
                'title' => 'Pembukuan Sederhana untuk Usaha Mikro: Manual atau Digital?',
                'excerpt' => 'Panduan memilih metode pembukuan yang paling sesuai dengan skala dan kebutuhan usaha Anda.',
                'cover' => 'images/myf/2.jpg',
                'date' => '2026-06-25 10:30',
                'views' => 98,
                'cats' => ['Pembukuan', 'Tips Bisnis'],
            ],
            [
                'title' => 'Menghitung HPP & Menetapkan Harga Jual yang Menguntungkan',
                'excerpt' => 'Banyak UMKM menjual rugi tanpa sadar. Pelajari cara menghitung HPP dan menetapkan harga yang sehat.',
                'cover' => 'images/myf/3.jpg',
                'date' => '2026-06-18 08:15',
                'views' => 215,
                'cats' => ['Perencanaan Keuangan', 'UMKM'],
            ],
            [
                'title' => 'Konsultasi Keuangan 1-on-1: Kapan UMKM Membutuhkannya?',
                'excerpt' => 'Kenali tanda-tanda usaha Anda membutuhkan pendampingan keuangan profesional bersama CFP.',
                'cover' => 'images/myf/4.jpg',
                'date' => '2026-06-10 13:45',
                'views' => 310,
                'cats' => ['Konsultasi', 'Perencanaan Keuangan'],
            ],
        ];

        foreach ($posts as $data) {
            $post = Post::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'user_id' => $operator->id,
                    'title' => $data['title'],
                    'excerpt' => $data['excerpt'],
                    'body' => $body($data['excerpt']),
                    'cover_image' => $data['cover'],
                    'status' => 'published',
                    'published_at' => Carbon::parse($data['date']),
                    'views' => $data['views'],
                    'meta_description' => $data['excerpt'],
                ],
            );
            $post->categories()->sync(collect($data['cats'])->map(fn ($c) => $categories[$c]->id)->all());
        }

        // Kolam foto contoh
        $photoPool = [
            'images/myf/1.jpg', 'images/myf/2.jpg', 'images/myf/3.jpg',
            'images/myf/4.jpg', 'images/myf/5.jpg', 'images/myf/6.jpg',
        ];

        // Album galeri
        $albums = [
            ['title' => 'UMKM Summit 2025 bersama Bank ANP Merauke', 'cover' => 'images/myf/1.jpg', 'date' => '2025-11-29 09:00', 'views' => 142, 'cats' => ['UMKM', 'Konsultasi']],
            ['title' => 'Workshop AI untuk UMKM bersama Telkom AI Connect', 'cover' => 'images/myf/2.jpg', 'date' => '2026-02-21 09:00', 'views' => 98, 'cats' => ['Tips Bisnis', 'UMKM']],
            ['title' => 'Pelatihan Pengelolaan Keuangan — Dinas Koperasi Kab. Jayapura', 'cover' => 'images/myf/6.jpg', 'date' => '2025-09-10 09:00', 'views' => 215, 'cats' => ['Literasi Keuangan', 'Pembukuan']],
            ['title' => 'Pendampingan Mama-Mama Kakao Kampung Sabeyap — KOPERNIK', 'cover' => 'images/myf/4.jpg', 'date' => '2024-08-15 09:00', 'views' => 310, 'cats' => ['UMKM', 'Literasi Keuangan']],
            ['title' => 'Set-up Pembukuan UMKM — Jayapura & Bali', 'cover' => 'images/myf/5.jpg', 'date' => '2025-05-05 09:00', 'views' => 187, 'cats' => ['Pembukuan', 'Konsultasi']],
        ];

        foreach ($albums as $data) {
            $album = Album::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'user_id' => $operator->id,
                    'title' => $data['title'],
                    'description' => 'Dokumentasi kegiatan '.$data['title'].' oleh MY Financials.',
                    'cover_image' => $data['cover'],
                    'status' => 'published',
                    'published_at' => Carbon::parse($data['date']),
                    'views' => $data['views'],
                    'meta_description' => 'Album foto: '.$data['title'].'.',
                ],
            );
            $album->categories()->sync(collect($data['cats'])->map(fn ($c) => $categories[$c]->id)->all());

            if ($album->photos()->count() === 0) {
                $selection = collect($photoPool)->shuffle()->take(5)->values();
                foreach ($selection as $order => $path) {
                    $album->photos()->create(['image_path' => $path, 'sort_order' => $order + 1]);
                }
            }
        }

        // ── Layanan Eksklusif: Paket, Member, Pemesanan, Transaksi ──
        $packageData = [
            ['code' => 'PKT-00', 'tier' => 'Sesi Khusus', 'name' => 'Konsultasi Gratis 30 Menit', 'price' => 0, 'duration' => '30 menit', 'sort' => 0, 'desc' => 'Sesi perkenalan untuk menentukan paket yang paling sesuai dengan kebutuhan Anda.'],
            ['code' => 'PKT-01', 'tier' => 'Paket Dasar', 'name' => 'Cek Kesehatan Keuangan', 'price' => 250000, 'duration' => '60 menit', 'sort' => 1, 'desc' => 'Evaluasi menyeluruh kondisi keuangan pribadi Anda saat ini.'],
            ['code' => 'PKT-02', 'tier' => 'Paket Menengah', 'name' => 'Rencana Finansial Pribadi', 'price' => 500000, 'duration' => '90 menit', 'sort' => 2, 'desc' => 'Penyusunan rencana keuangan pribadi yang terarah dan realistis.'],
            ['code' => 'PKT-03', 'tier' => 'Paket Bisnis', 'name' => 'Keuangan UMKM', 'price' => 750000, 'duration' => '120 menit', 'sort' => 3, 'desc' => 'Pendampingan tata kelola keuangan untuk pelaku UMKM.'],
            ['code' => 'PKT-04', 'tier' => 'Paket Bisnis', 'name' => 'Review Keuangan Bisnis', 'price' => 1000000, 'duration' => '2 sesi', 'sort' => 4, 'desc' => 'Peninjauan laporan dan performa keuangan bisnis Anda.'],
            ['code' => 'PKT-05', 'tier' => 'Paket Bisnis', 'name' => 'Set-up Pembukuan Keuangan', 'price' => 3500000, 'duration' => 'Project-based', 'sort' => 5, 'desc' => 'Membangun sistem pembukuan usaha dari nol hingga siap pakai.'],
        ];
        $packages = [];
        foreach ($packageData as $p) {
            $packages[$p['code']] = ServicePackage::updateOrCreate(
                ['code' => $p['code']],
                ['tier' => $p['tier'], 'name' => $p['name'], 'slug' => Str::slug($p['name']), 'price' => $p['price'], 'duration' => $p['duration'], 'description' => $p['desc'], 'is_active' => true, 'sort_order' => $p['sort']],
            );
        }

        $memberData = [
            ['name' => 'Siti Rahmawati', 'phone' => '082111223344', 'email' => 'siti.umkm@gmail.com', 'google_id' => 'g-1001', 'status' => Member::STATUS_VERIFIED],
            ['name' => 'Maria Kombo', 'phone' => '085233449900', 'email' => 'maria.kombo@gmail.com', 'google_id' => 'g-1002', 'status' => Member::STATUS_VERIFIED],
            ['name' => 'Agustina Rumbewas', 'phone' => '081122334455', 'email' => 'agustina.r@gmail.com', 'google_id' => 'g-1003', 'status' => Member::STATUS_VERIFIED],
            ['name' => 'Yohanis Wenda', 'phone' => '081355667788', 'email' => null, 'google_id' => null, 'status' => Member::STATUS_PENDING],
            ['name' => 'Deni Prasetyo', 'phone' => '081277881122', 'email' => null, 'google_id' => null, 'status' => Member::STATUS_PENDING],
        ];
        $members = [];
        foreach ($memberData as $m) {
            $members[$m['phone']] = Member::updateOrCreate(
                ['phone' => $m['phone']],
                ['name' => $m['name'], 'email' => $m['email'], 'google_id' => $m['google_id'], 'status' => $m['status'], 'password' => 'password'],
            );
        }

        $orderData = [
            ['inv' => 'INV-2026-0001', 'phone' => '082111223344', 'pkg' => 'PKT-03', 'method' => 'Transfer BCA', 'status' => Order::STATUS_LUNAS, 'ordered' => '2026-06-21', 'sched' => '2026-06-28 10:00'],
            ['inv' => 'INV-2026-0002', 'phone' => '085233449900', 'pkg' => 'PKT-05', 'method' => 'Transfer Mandiri', 'status' => Order::STATUS_TERVERIFIKASI, 'ordered' => '2026-06-24', 'sched' => '2026-07-05 13:00'],
            ['inv' => 'INV-2026-0003', 'phone' => '081355667788', 'pkg' => 'PKT-02', 'method' => 'QRIS', 'status' => Order::STATUS_MENUNGGU, 'ordered' => '2026-06-29', 'sched' => '2026-07-08 09:00'],
            ['inv' => 'INV-2026-0004', 'phone' => '081122334455', 'pkg' => 'PKT-01', 'method' => 'Transfer BCA', 'status' => Order::STATUS_LUNAS, 'ordered' => '2026-06-18', 'sched' => '2026-06-25 15:00'],
            ['inv' => 'INV-2026-0005', 'phone' => '085233449900', 'pkg' => 'PKT-04', 'method' => 'Transfer Mandiri', 'status' => Order::STATUS_BARU, 'ordered' => '2026-07-01', 'sched' => '2026-07-12 10:00'],
        ];
        foreach ($orderData as $d) {
            $member = $members[$d['phone']];
            $pkg = $packages[$d['pkg']];
            $verified = in_array($d['status'], [Order::STATUS_TERVERIFIKASI, Order::STATUS_LUNAS], true);
            $order = Order::updateOrCreate(
                ['invoice_no' => $d['inv']],
                [
                    'member_id' => $member->id,
                    'service_package_id' => $pkg->id,
                    'package_name' => $pkg->name,
                    'amount' => $pkg->price,
                    'payment_method' => $d['method'],
                    'status' => $d['status'],
                    'scheduled_at' => Carbon::parse($d['sched']),
                    'verified_by' => $verified ? $admin->id : null,
                    'verified_at' => $verified ? Carbon::parse($d['ordered'])->addDay() : null,
                ],
            );

            if ($order->status === Order::STATUS_LUNAS && $order->amount > 0) {
                Transaction::updateOrCreate(
                    ['order_id' => $order->id, 'type' => Transaction::TYPE_INCOME],
                    ['date' => Carbon::parse($d['ordered'])->addDay()->toDateString(), 'category' => 'Penjualan Paket', 'description' => 'Pembayaran '.$order->invoice_no.' — '.$order->package_name, 'amount' => $order->amount],
                );
            }
        }

        $expenses = [
            ['date' => '2026-06-03', 'desc' => 'Biaya transportasi pendampingan UMKM', 'amount' => 350000, 'cat' => 'Operasional'],
            ['date' => '2026-06-14', 'desc' => 'Cetak modul pelatihan literasi keuangan', 'amount' => 420000, 'cat' => 'Materi'],
        ];
        foreach ($expenses as $e) {
            Transaction::updateOrCreate(
                ['type' => Transaction::TYPE_EXPENSE, 'description' => $e['desc']],
                ['date' => $e['date'], 'category' => $e['cat'], 'amount' => $e['amount']],
            );
        }
    }
}
