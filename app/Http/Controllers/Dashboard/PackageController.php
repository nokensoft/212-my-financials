<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ServicePackage;
use App\Support\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(): View
    {
        $packages = ServicePackage::withCount('orders')->orderBy('sort_order')->orderBy('price')->get();

        return view('dashboard.packages.index', compact('packages'));
    }

    public function create(): View
    {
        $package = new ServicePackage(['is_active' => true]);

        return view('dashboard.packages.form', compact('package'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $this->persist(new ServicePackage, $data);

        return redirect()->route('dashboard.packages.index')->with('status', 'Paket berhasil dibuat.');
    }

    public function edit(ServicePackage $package): View
    {
        return view('dashboard.packages.form', compact('package'));
    }

    public function update(Request $request, ServicePackage $package): RedirectResponse
    {
        $data = $this->validated($request, $package);
        $this->persist($package, $data);

        return redirect()->route('dashboard.packages.index')->with('status', 'Paket berhasil diperbarui.');
    }

    public function destroy(ServicePackage $package): RedirectResponse
    {
        $package->delete();

        return redirect()->route('dashboard.packages.index')->with('status', 'Paket berhasil dihapus.');
    }

    public function toggle(ServicePackage $package): RedirectResponse
    {
        $package->update(['is_active' => ! $package->is_active]);

        return back()->with('status', 'Status paket "'.$package->name.'" diperbarui.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validated(Request $request, ?ServicePackage $package = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('service_packages', 'code')->ignore($package?->id)],
            'tier' => ['nullable', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'duration' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function persist(ServicePackage $package, array $data): void
    {
        $package->code = $data['code'];
        $package->tier = $data['tier'] ?? null;
        $package->name = $data['name'];
        $package->price = $data['price'];
        $package->duration = $data['duration'] ?? null;
        $package->description = $data['description'] ?? null;
        $package->is_active = (bool) ($data['is_active'] ?? false);
        $package->sort_order = $data['sort_order'] ?? 0;

        if (! $package->exists || filled($data['slug'] ?? null) || ! $package->slug) {
            $source = filled($data['slug'] ?? null) ? $data['slug'] : ($package->slug ?: $data['name']);
            $package->slug = Slug::unique(ServicePackage::class, $source, $package->id);
        }

        $package->save();
    }
}
