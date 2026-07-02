<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Support\SampleData;
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

        $recentPosts = Post::with('categories')->latest()->take(5)->get();
        $recentAlbums = Album::withCount('photos')->latest()->take(5)->get();

        // Rekap SIMULASI (member, pemesanan, pendapatan) — data in-memory.
        $recap = SampleData::recap();
        $monthly = SampleData::monthlyRevenue();
        $recentOrders = collect(SampleData::orders())->sortByDesc('ordered_at')->take(5)->values()->all();
        $orderStatuses = SampleData::orderStatuses();

        return view('dashboard.index', compact(
            'stats', 'recentPosts', 'recentAlbums',
            'recap', 'monthly', 'recentOrders', 'orderStatuses',
        ));
    }
}
