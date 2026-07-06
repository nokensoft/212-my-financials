<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use App\Models\Member;
use App\Models\Order;
use App\Models\Post;
use App\Models\ServicePackage;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'posts' => Post::count(),
            'published_posts' => Post::published()->count(),
            'albums' => Album::count(),
            'categories' => Category::count(),
            'users' => User::count(),
        ];

        $recap = [
            'members' => Member::count(),
            'members_pending' => Member::where('status', Member::STATUS_PENDING)->count(),
            'orders' => Order::count(),
            'orders_unverified' => Order::whereIn('status', [Order::STATUS_BARU, Order::STATUS_MENUNGGU])->count(),
            'packages' => ServicePackage::count(),
            'revenue' => (int) Order::where('status', Order::STATUS_LUNAS)->sum('amount'),
            'revenue_pipeline' => (int) Order::whereIn('status', [Order::STATUS_BARU, Order::STATUS_MENUNGGU, Order::STATUS_TERVERIFIKASI])->sum('amount'),
        ];

        // Pemasukan 6 bulan terakhir (dari transaksi).
        $incomes = Transaction::where('type', Transaction::TYPE_INCOME)->get(['amount', 'date']);
        $monthly = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $amount = (int) $incomes->filter(fn ($t) => $t->date->isSameMonth($month))->sum('amount');
            $monthly[] = ['month' => $month->locale('id')->translatedFormat('M'), 'amount' => $amount];
        }

        $recentPosts = Post::with('categories')->latest()->take(5)->get();
        $recentAlbums = Album::withCount('photos')->latest()->take(5)->get();
        $recentOrders = Order::with('member')->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'stats', 'recap', 'monthly', 'recentPosts', 'recentAlbums', 'recentOrders',
        ));
    }
}
