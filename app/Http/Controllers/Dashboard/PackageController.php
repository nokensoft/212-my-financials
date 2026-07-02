<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Support\SampleData;
use Illuminate\View\View;

/**
 * SIMULASI pengelolaan paket Layanan Eksklusif. Konsep desain tampilan
 * saja — belum ada penyimpanan ke database.
 */
class PackageController extends Controller
{
    public function index(): View
    {
        $packages = SampleData::packages();

        return view('dashboard.packages.index', compact('packages'));
    }

    public function create(): View
    {
        return view('dashboard.packages.form', ['package' => null]);
    }

    public function edit(string $code): View
    {
        $package = collect(SampleData::packages())->firstWhere('code', $code);
        abort_if($package === null, 404);

        return view('dashboard.packages.form', ['package' => $package]);
    }
}
