<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Support\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    use HandlesUploads;

    public function index(Request $request): View
    {
        $posts = Post::with('categories')
            ->when($request->get('q'), fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('dashboard.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $post = new Post(['status' => 'draft']);
        $categories = Category::orderBy('name')->get();

        return view('dashboard.posts.form', compact('post', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        $post = new Post;
        $post->user_id = $request->user()->id;
        $this->persist($post, $data, $request);

        return redirect()->route('dashboard.posts.index')->with('status', 'Artikel berhasil dibuat.');
    }

    public function edit(Post $post): View
    {
        $post->load('categories');
        $categories = Category::orderBy('name')->get();

        return view('dashboard.posts.form', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validated($request);
        $this->persist($post, $data, $request);

        return redirect()->route('dashboard.posts.index')->with('status', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('dashboard.posts.index')->with('status', 'Artikel dipindahkan ke tempat sampah.');
    }

    public function trash(): View
    {
        $posts = Post::onlyTrashed()->with('categories')->latest('deleted_at')->paginate(12);

        return view('dashboard.posts.trash', compact('posts'));
    }

    public function restore(int $id): RedirectResponse
    {
        Post::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('dashboard.posts.trash')->with('status', 'Artikel berhasil dipulihkan.');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $this->deletePublicImage($post->cover_image);
        $post->forceDelete();

        return redirect()->route('dashboard.posts.trash')->with('status', 'Artikel dihapus permanen.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
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
    protected function persist(Post $post, array $data, Request $request): void
    {
        $post->title = $data['title'];
        $post->slug = Slug::unique(Post::class, $data['title'], $post->id);

        $post->excerpt = $data['excerpt'] ?? null;
        $post->body = $data['body'] ?? null;
        $post->status = $data['status'];
        $post->meta_title = Str::limit($data['title'], 60, '');
        $post->meta_description = $this->autoMetaDescription($data['excerpt'] ?? null, $data['body'] ?? null);

        $published = filled($data['published_at'] ?? null) ? Carbon::parse($data['published_at']) : null;
        if ($data['status'] === 'published') {
            $post->published_at = $published ?? $post->published_at ?? now();
        } else {
            $post->published_at = $published;
        }

        if ($request->boolean('remove_cover')) {
            $this->deletePublicImage($post->cover_image);
            $post->cover_image = null;
        }

        if ($request->hasFile('cover_image')) {
            $this->deletePublicImage($post->cover_image);
            $post->cover_image = $this->storePublicImage($request->file('cover_image'), 'uploads/covers');
        }

        $post->save();
        $post->categories()->sync($data['categories'] ?? []);
    }

    /**
     * Build a meta description from the excerpt, falling back to the body.
     */
    protected function autoMetaDescription(?string $excerpt, ?string $body): ?string
    {
        $source = filled($excerpt) ? $excerpt : strip_tags((string) $body);
        $source = trim(preg_replace('/\s+/', ' ', $source));

        return $source !== '' ? Str::limit($source, 157) : null;
    }
}
