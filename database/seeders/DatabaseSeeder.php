<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Category;
use App\Models\Post;
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
    }
}
