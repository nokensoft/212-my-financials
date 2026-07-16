<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use App\Support\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AlbumController extends Controller
{
    use HandlesUploads;

    public function index(Request $request): View
    {
        $albums = Album::withCount('photos')
            ->when($request->get('q'), fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('dashboard.albums.index', compact('albums'));
    }

    public function create(): View
    {
        $album = new Album(['status' => 'draft']);
        $categories = Category::orderBy('name')->get();

        return view('dashboard.albums.form', compact('album', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        $album = new Album;
        $album->user_id = $request->user()->id;
        $this->persist($album, $data, $request);

        return redirect()->route('dashboard.albums.edit', $album)->with('status', 'Album dibuat. Sekarang tambahkan foto.');
    }

    public function edit(Album $album): View
    {
        $album->load('categories', 'photos');
        $categories = Category::orderBy('name')->get();

        return view('dashboard.albums.form', compact('album', 'categories'));
    }

    public function update(Request $request, Album $album): RedirectResponse
    {
        $data = $this->validated($request);
        $this->persist($album, $data, $request);

        return redirect()->route('dashboard.albums.edit', $album)->with('status', 'Album berhasil diperbarui.');
    }

    public function destroy(Album $album): RedirectResponse
    {
        $album->delete();

        return redirect()->route('dashboard.albums.index')->with('status', 'Album dipindahkan ke tempat sampah.');
    }

    public function trash(): View
    {
        $albums = Album::onlyTrashed()->withCount('photos')->latest('deleted_at')->paginate(12);

        return view('dashboard.albums.trash', compact('albums'));
    }

    public function restore(int $id): RedirectResponse
    {
        Album::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('dashboard.albums.trash')->with('status', 'Album berhasil dipulihkan.');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $album = Album::onlyTrashed()->with('photos')->findOrFail($id);
        foreach ($album->photos as $photo) {
            $this->deletePublicImage($photo->image_path);
        }
        $this->deletePublicImage($album->cover_image);
        $album->forceDelete();

        return redirect()->route('dashboard.albums.trash')->with('status', 'Album dihapus permanen.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'remove_cover' => ['nullable', 'boolean'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function persist(Album $album, array $data, Request $request): void
    {
        $album->title = $data['title'];
        $album->slug = Slug::unique(Album::class, $data['title'], $album->id);

        $album->description = $data['description'] ?? null;
        $album->status = $data['status'];
        $album->meta_title = Str::limit($data['title'], 60, '');
        $album->meta_description = $this->autoMetaDescription($data['description'] ?? null);

        $published = filled($data['published_at'] ?? null) ? Carbon::parse($data['published_at']) : null;
        if ($data['status'] === 'published') {
            $album->published_at = $published ?? $album->published_at ?? now();
        } else {
            $album->published_at = $published;
        }

        if ($request->boolean('remove_cover')) {
            $this->deletePublicImage($album->cover_image);
            $album->cover_image = null;
        }

        if ($request->hasFile('cover_image')) {
            $this->deletePublicImage($album->cover_image);
            $album->cover_image = $this->storePublicImage($request->file('cover_image'), 'uploads/albums');
        }

        $album->save();
        $album->categories()->sync($data['categories'] ?? []);
    }

    /**
     * Build a meta description from the album description.
     */
    protected function autoMetaDescription(?string $description): ?string
    {
        $source = trim(preg_replace('/\s+/', ' ', strip_tags((string) $description)));

        return $source !== '' ? Str::limit($source, 157) : null;
    }
}
