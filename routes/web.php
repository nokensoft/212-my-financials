<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Dashboard\AlbumController as DashboardAlbumController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\MemberController as DashboardMemberController;
use App\Http\Controllers\Dashboard\OrderController as DashboardOrderController;
use App\Http\Controllers\Dashboard\PackageController as DashboardPackageController;
use App\Http\Controllers\Dashboard\PhotoController;
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ReportController as DashboardReportController;
use App\Http\Controllers\Dashboard\TransactionController as DashboardTransactionController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Member\AreaController as MemberAreaController;
use App\Http\Controllers\Member\AuthController as MemberAuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
| Halaman publik
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galeri/{album:slug}', [GalleryController::class, 'show'])->name('gallery.show');
Route::get('/kebijakan-privasi', [PageController::class, 'privacy'])->name('pages.privacy');
Route::get('/faq', [PageController::class, 'faq'])->name('pages.faq');
Route::get('/peta-situs', [PageController::class, 'sitemap'])->name('pages.sitemap');

/*
| Area Member (visitor) — autentikasi member (guard "member") + pemesanan paket
*/
Route::prefix('member')->name('member.')->group(function () {
    Route::middleware('guest:member')->group(function () {
        Route::get('masuk', [MemberAuthController::class, 'showLogin'])->name('login');
        Route::post('masuk', [MemberAuthController::class, 'login']);
        Route::get('daftar', [MemberAuthController::class, 'showRegister'])->name('register');
        Route::post('daftar', [MemberAuthController::class, 'register']);
    });
    Route::get('google', [MemberAuthController::class, 'google'])->name('google');

    Route::middleware('auth:member')->group(function () {
        Route::post('logout', [MemberAuthController::class, 'logout'])->name('logout');
        Route::get('/', [MemberAreaController::class, 'dashboard'])->name('dashboard');
        Route::get('paket', [MemberAreaController::class, 'packages'])->name('packages');
        Route::get('pesan/{package:slug}', [MemberAreaController::class, 'orderCreate'])->name('orders.create');
        Route::post('pesan/{package:slug}', [MemberAreaController::class, 'orderStore'])->name('orders.store');
        Route::get('pesanan', [MemberAreaController::class, 'orders'])->name('orders');
        Route::get('pesanan/{order}', [MemberAreaController::class, 'orderShow'])->whereNumber('order')->name('orders.show');
        Route::post('pesanan/{order}/bukti', [MemberAreaController::class, 'uploadProof'])->whereNumber('order')->name('orders.proof');
        Route::get('pesanan/{order}/invoice', [MemberAreaController::class, 'invoice'])->whereNumber('order')->name('orders.invoice');
        Route::get('profil', [MemberAreaController::class, 'profileEdit'])->name('profile.edit');
        Route::put('profil', [MemberAreaController::class, 'profileUpdate'])->name('profile.update');
    });
});

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');
Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Allow: /',
        'Disallow: /dashboard',
        'Disallow: /login',
        '',
        'Sitemap: '.url('/sitemap.xml'),
    ];

    return response(implode("\n", $lines))->header('Content-Type', 'text/plain');
})->name('robots');

/*
| Autentikasi
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
| Dashboard (admin & operator)
*/
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('dashboard.')->group(function () {
        Route::get('posts/trash', [DashboardPostController::class, 'trash'])->name('posts.trash');
        Route::patch('posts/{id}/restore', [DashboardPostController::class, 'restore'])->name('posts.restore');
        Route::delete('posts/{id}/force', [DashboardPostController::class, 'forceDelete'])->name('posts.force-delete');
        Route::resource('posts', DashboardPostController::class)->except('show');

        Route::get('albums/trash', [DashboardAlbumController::class, 'trash'])->name('albums.trash');
        Route::patch('albums/{id}/restore', [DashboardAlbumController::class, 'restore'])->name('albums.restore');
        Route::delete('albums/{id}/force', [DashboardAlbumController::class, 'forceDelete'])->name('albums.force-delete');
        Route::resource('albums', DashboardAlbumController::class)->except('show');

        Route::resource('categories', DashboardCategoryController::class)->except('show');

        Route::post('albums/{album}/photos', [PhotoController::class, 'store'])->name('albums.photos.store');
        Route::delete('albums/{album}/photos/{photo}', [PhotoController::class, 'destroy'])->name('albums.photos.destroy');

        Route::post('media', [MediaController::class, 'upload'])->name('media.upload');

        /*
        | Layanan: Member, Paket, Pemesanan, Kas & Laporan — admin & operator
        */
        Route::get('members', [DashboardMemberController::class, 'index'])->name('members.index');
        Route::get('members/create', [DashboardMemberController::class, 'create'])->name('members.create');
        Route::post('members', [DashboardMemberController::class, 'store'])->name('members.store');
        Route::get('members/{member}', [DashboardMemberController::class, 'show'])->whereNumber('member')->name('members.show');
        Route::get('members/{member}/edit', [DashboardMemberController::class, 'edit'])->whereNumber('member')->name('members.edit');
        Route::put('members/{member}', [DashboardMemberController::class, 'update'])->whereNumber('member')->name('members.update');
        Route::delete('members/{member}', [DashboardMemberController::class, 'destroy'])->whereNumber('member')->name('members.destroy');
        Route::post('members/{member}/verify', [DashboardMemberController::class, 'verify'])->whereNumber('member')->name('members.verify');
        Route::post('members/{member}/reject', [DashboardMemberController::class, 'reject'])->whereNumber('member')->name('members.reject');

        Route::post('packages/{package}/toggle', [DashboardPackageController::class, 'toggle'])->name('packages.toggle');
        Route::resource('packages', DashboardPackageController::class)->except('show');

        Route::get('orders', [DashboardOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/create', [DashboardOrderController::class, 'create'])->name('orders.create');
        Route::post('orders', [DashboardOrderController::class, 'store'])->name('orders.store');
        Route::get('orders/{order}', [DashboardOrderController::class, 'show'])->whereNumber('order')->name('orders.show');
        Route::get('orders/{order}/invoice', [DashboardOrderController::class, 'invoice'])->whereNumber('order')->name('orders.invoice');
        Route::post('orders/{order}/bukti', [DashboardOrderController::class, 'uploadProof'])->whereNumber('order')->name('orders.proof');
        Route::patch('orders/{order}/status', [DashboardOrderController::class, 'updateStatus'])->whereNumber('order')->name('orders.status');
        Route::delete('orders/{order}', [DashboardOrderController::class, 'destroy'])->whereNumber('order')->name('orders.destroy');

        Route::resource('transactions', DashboardTransactionController::class)->except('show');

        Route::get('reports/members', [DashboardReportController::class, 'members'])->name('reports.members');
        Route::get('reports/finance', [DashboardReportController::class, 'finance'])->name('reports.finance');

        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        Route::resource('users', DashboardUserController::class)->except('show')->middleware('role:admin');
    });
});
