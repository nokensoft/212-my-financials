<?php

namespace App\Http\Controllers;

use App\Models\ServicePackage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // One-page statis. Section Blog, Kategori, dan preview Galeri dimuat via
        // API + Alpine.js. Paket Layanan Eksklusif diambil dari database.
        $packages = ServicePackage::active()->orderBy('sort_order')->orderBy('price')->get();

        return view('home', compact('packages'));
    }
}
