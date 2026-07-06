<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Support\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount(['posts', 'albums'])->orderBy('name')->paginate(15);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $category = new Category;

        return view('dashboard.categories.form', compact('category'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $category = new Category;
        $this->persist($category, $data);

        return redirect()->route('dashboard.categories.index')->with('status', 'Kategori berhasil dibuat.');
    }

    public function edit(Category $category): View
    {
        return view('dashboard.categories.form', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $this->validated($request);
        $this->persist($category, $data);

        return redirect()->route('dashboard.categories.index')->with('status', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('status', 'Kategori berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function persist(Category $category, array $data): void
    {
        $category->name = $data['name'];
        $category->description = $data['description'] ?? null;

        if (! $category->exists || filled($data['slug'] ?? null) || ! $category->slug) {
            $source = filled($data['slug'] ?? null) ? $data['slug'] : ($category->slug ?: $data['name']);
            $category->slug = Slug::unique(Category::class, $source, $category->id);
        }

        $category->save();
    }
}
