<?php

namespace App\Http\Controllers\Api;

use App\Http\Concerns\AppliesContentFilters;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use AppliesContentFilters;

    public function index(Request $request): JsonResponse
    {
        $query = Post::query()->published()->with('categories:id,name,slug');
        $this->applyContentFilters($query, $request, ['title', 'excerpt', 'body']);

        $perPage = min(max((int) $request->integer('per_page', 8), 1), 24);
        $posts = $query->paginate($perPage)->withQueryString();

        return response()->json([
            'data' => collect($posts->items())->map(fn (Post $p) => [
                'title' => $p->title,
                'slug' => $p->slug,
                'excerpt' => $p->excerpt,
                'cover_image' => $p->cover_image ? asset($p->cover_image) : null,
                'published_at' => optional($p->published_at)->toIso8601String(),
                'published_human' => $p->published_human,
                'views' => $p->views,
                'url' => route('blog.show', $p->slug),
                'categories' => $p->categories->map(fn ($c) => ['name' => $c->name, 'slug' => $c->slug])->values(),
            ])->values(),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ],
        ]);
    }
}
