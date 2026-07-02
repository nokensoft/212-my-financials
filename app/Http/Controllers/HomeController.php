<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // One-page statis. Section Blog, Kategori, dan preview Galeri
        // dimuat via API + Alpine.js di sisi klien (lihat resources/views/home.blade.php).
        return view('home');
    }
}
