<?php

namespace App\Support;

/**
 * Data contoh (dummy) untuk fitur SIMULASI dashboard MY Financials.
 *
 * CATATAN: Ini murni konsep desain — tidak tersimpan di database dan tidak ada
 * proses CRUD sungguhan. Semua nilai dikembalikan sebagai array in-memory agar
 * tampilan Blade dapat dirender tanpa migrasi/model tambahan.
 */
class SampleData
{
    /**
     * Paket Layanan Eksklusif (lihat section "Layanan Eksklusif" di beranda).
     *
     * @return array<int, array<string, mixed>>
     */
    public static function packages(): array
    {
        return [
            ['code' => 'PKT-01', 'tier' => 'Paket Dasar', 'name' => 'Cek Kesehatan Keuangan', 'price' => 250000, 'duration' => '60 menit', 'status' => 'aktif', 'description' => 'Evaluasi menyeluruh kondisi keuangan pribadi Anda saat ini.'],
            ['code' => 'PKT-02', 'tier' => 'Paket Menengah', 'name' => 'Rencana Finansial Pribadi', 'price' => 500000, 'duration' => '90 menit', 'status' => 'aktif', 'description' => 'Penyusunan rencana keuangan pribadi yang terarah dan realistis.'],
            ['code' => 'PKT-03', 'tier' => 'Paket Bisnis', 'name' => 'Keuangan UMKM', 'price' => 750000, 'duration' => '120 menit', 'status' => 'aktif', 'description' => 'Pendampingan tata kelola keuangan untuk pelaku UMKM.'],
            ['code' => 'PKT-04', 'tier' => 'Paket Bisnis', 'name' => 'Review Keuangan Bisnis', 'price' => 1000000, 'duration' => '2 sesi', 'status' => 'aktif', 'description' => 'Peninjauan laporan dan performa keuangan bisnis Anda.'],
            ['code' => 'PKT-05', 'tier' => 'Paket Bisnis', 'name' => 'Set-up Pembukuan Keuangan', 'price' => 3500000, 'duration' => 'Project-based', 'status' => 'aktif', 'description' => 'Membangun sistem pembukuan usaha dari nol hingga siap pakai.'],
            ['code' => 'PKT-00', 'tier' => 'Sesi Khusus', 'name' => 'Konsultasi Gratis 30 Menit', 'price' => 0, 'duration' => '30 menit', 'status' => 'aktif', 'description' => 'Sesi perkenalan untuk menentukan paket yang paling sesuai.'],
        ];
    }

    /**
     * Member (calon/klien) yang mendaftar via nomor HP atau akun Google.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function members(): array
    {
        return [
            ['id' => 1, 'name' => 'Siti Rahmawati', 'phone' => '0821-1122-3344', 'email' => 'siti.umkm@gmail.com', 'provider' => 'google', 'status' => 'verified', 'joined_at' => '2026-06-02', 'orders' => 2],
            ['id' => 2, 'name' => 'Yohanis Wenda', 'phone' => '0813-5566-7788', 'email' => null, 'provider' => 'phone', 'status' => 'pending', 'joined_at' => '2026-06-20', 'orders' => 1],
            ['id' => 3, 'name' => 'Maria Kombo', 'phone' => '0852-3344-9900', 'email' => 'maria.kombo@gmail.com', 'provider' => 'google', 'status' => 'verified', 'joined_at' => '2026-05-11', 'orders' => 3],
            ['id' => 4, 'name' => 'Deni Prasetyo', 'phone' => '0812-7788-1122', 'email' => null, 'provider' => 'phone', 'status' => 'pending', 'joined_at' => '2026-06-28', 'orders' => 0],
            ['id' => 5, 'name' => 'Agustina Rumbewas', 'phone' => '0811-2233-4455', 'email' => 'agustina.r@gmail.com', 'provider' => 'google', 'status' => 'verified', 'joined_at' => '2026-04-30', 'orders' => 1],
            ['id' => 6, 'name' => 'Bripda Toko Sagu', 'phone' => '0857-9988-1010', 'email' => null, 'provider' => 'phone', 'status' => 'rejected', 'joined_at' => '2026-06-15', 'orders' => 0],
        ];
    }

    public static function member(int $id): ?array
    {
        return collect(self::members())->firstWhere('id', $id);
    }

    /**
     * Pemesanan paket Layanan Eksklusif oleh member.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function orders(): array
    {
        return [
            ['id' => 1, 'invoice' => 'INV-2026-0001', 'member' => 'Siti Rahmawati', 'phone' => '0821-1122-3344', 'package' => 'Keuangan UMKM', 'amount' => 750000, 'method' => 'Transfer BCA', 'status' => 'lunas', 'ordered_at' => '2026-06-21', 'scheduled_at' => '2026-06-28 10:00'],
            ['id' => 2, 'invoice' => 'INV-2026-0002', 'member' => 'Maria Kombo', 'phone' => '0852-3344-9900', 'package' => 'Set-up Pembukuan Keuangan', 'amount' => 3500000, 'method' => 'Transfer Mandiri', 'status' => 'terverifikasi', 'ordered_at' => '2026-06-24', 'scheduled_at' => '2026-07-05 13:00'],
            ['id' => 3, 'invoice' => 'INV-2026-0003', 'member' => 'Yohanis Wenda', 'phone' => '0813-5566-7788', 'package' => 'Rencana Finansial Pribadi', 'amount' => 500000, 'method' => 'QRIS', 'status' => 'menunggu_verifikasi', 'ordered_at' => '2026-06-29', 'scheduled_at' => '2026-07-08 09:00'],
            ['id' => 4, 'invoice' => 'INV-2026-0004', 'member' => 'Agustina Rumbewas', 'phone' => '0811-2233-4455', 'package' => 'Cek Kesehatan Keuangan', 'amount' => 250000, 'method' => 'Transfer BCA', 'status' => 'lunas', 'ordered_at' => '2026-06-18', 'scheduled_at' => '2026-06-25 15:00'],
            ['id' => 5, 'invoice' => 'INV-2026-0005', 'member' => 'Maria Kombo', 'phone' => '0852-3344-9900', 'package' => 'Review Keuangan Bisnis', 'amount' => 1000000, 'method' => 'Transfer Mandiri', 'status' => 'baru', 'ordered_at' => '2026-07-01', 'scheduled_at' => '2026-07-12 10:00'],
            ['id' => 6, 'invoice' => 'INV-2026-0006', 'member' => 'Siti Rahmawati', 'phone' => '0821-1122-3344', 'package' => 'Konsultasi Gratis 30 Menit', 'amount' => 0, 'method' => '—', 'status' => 'terverifikasi', 'ordered_at' => '2026-06-05', 'scheduled_at' => '2026-06-10 11:00'],
        ];
    }

    public static function order(int $id): ?array
    {
        return collect(self::orders())->firstWhere('id', $id);
    }

    /**
     * Status pemesanan + label & warna badge (untuk konsistensi tampilan).
     *
     * @return array<string, array<string, string>>
     */
    public static function orderStatuses(): array
    {
        return [
            'baru' => ['label' => 'Baru', 'class' => 'bg-slate-100 text-slate-600'],
            'menunggu_verifikasi' => ['label' => 'Menunggu Verifikasi', 'class' => 'bg-amber-100 text-amber-700'],
            'terverifikasi' => ['label' => 'Terverifikasi', 'class' => 'bg-blue-100 text-blue-700'],
            'lunas' => ['label' => 'Lunas', 'class' => 'bg-primary-100 text-primary-700'],
            'batal' => ['label' => 'Batal', 'class' => 'bg-red-100 text-red-700'],
        ];
    }

    /**
     * Ringkasan angka untuk dashboard & laporan (disimulasikan).
     *
     * @return array<string, int>
     */
    public static function recap(): array
    {
        $orders = collect(self::orders());
        $paid = $orders->whereIn('status', ['lunas']);

        return [
            'members' => count(self::members()),
            'members_pending' => collect(self::members())->where('status', 'pending')->count(),
            'orders' => $orders->count(),
            'orders_unverified' => $orders->whereIn('status', ['baru', 'menunggu_verifikasi'])->count(),
            'packages' => count(self::packages()),
            'revenue' => (int) $paid->sum('amount'),
            'revenue_pipeline' => (int) $orders->whereIn('status', ['terverifikasi', 'menunggu_verifikasi', 'baru'])->sum('amount'),
        ];
    }

    /**
     * Tren pendapatan bulanan (disimulasikan) untuk grafik ringkas.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function monthlyRevenue(): array
    {
        return [
            ['month' => 'Feb', 'amount' => 1250000],
            ['month' => 'Mar', 'amount' => 1750000],
            ['month' => 'Apr', 'amount' => 2250000],
            ['month' => 'Mei', 'amount' => 1500000],
            ['month' => 'Jun', 'amount' => 4750000],
            ['month' => 'Jul', 'amount' => 1000000],
        ];
    }

    /**
     * Baris laporan keuangan (terintegrasi dengan invoice pemesanan).
     *
     * @return array<int, array<string, mixed>>
     */
    public static function financeEntries(): array
    {
        $rows = [];
        foreach (self::orders() as $order) {
            if (in_array($order['status'], ['lunas', 'terverifikasi'], true) && $order['amount'] > 0) {
                $rows[] = [
                    'date' => $order['ordered_at'],
                    'ref' => $order['invoice'],
                    'description' => 'Pembayaran paket "'.$order['package'].'" — '.$order['member'],
                    'type' => 'pemasukan',
                    'amount' => $order['amount'],
                    'settled' => $order['status'] === 'lunas',
                ];
            }
        }

        // Beberapa pengeluaran operasional contoh
        $rows[] = ['date' => '2026-06-03', 'ref' => 'EXP-0012', 'description' => 'Biaya transportasi pendampingan UMKM', 'type' => 'pengeluaran', 'amount' => 350000, 'settled' => true];
        $rows[] = ['date' => '2026-06-14', 'ref' => 'EXP-0013', 'description' => 'Cetak modul pelatihan literasi keuangan', 'type' => 'pengeluaran', 'amount' => 420000, 'settled' => true];

        usort($rows, fn ($a, $b) => strcmp($a['date'], $b['date']));

        return $rows;
    }
}
