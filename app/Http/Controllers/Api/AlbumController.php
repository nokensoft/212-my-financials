<?php

namespace App\Http\Controllers\Api;

use App\Http\Concerns\AppliesContentFilters;
use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    use AppliesContentFilters;

    public function index(Request $request): JsonResponse
    {
        $query = Album::query()->published()->withCount('photos')->with('categories:id,name,slug');
        $this->applyContentFilters($query, $request, ['title', 'description']);

        $perPage = min(max((int) $request->integer('per_page', 6), 1), 24);
        $albums = $query->paginate($perPage)->withQueryString();

        return response()->json([
            'data' => collect($albums->items())->map(fn (Album $a) => [
                'title' => $a->title,
                'slug' => $a->slug,
                'cover_image' => $a->cover_image ? asset($a->cover_image) : null,
                'photos_count' => $a->photos_count,
                'published_human' => $a->published_human,
                'views' => $a->views,
                'url' => route('gallery.show', $a->slug),
                'categories' => $a->categories->map(fn ($c) => ['name' => $c->name, 'slug' => $c->slug])->values(),
            ])->values(),
            'meta' => [
                'current_page' => $albums->currentPage(),
                'last_page' => $albums->lastPage(),
                'per_page' => $albums->perPage(),
                'total' => $albums->total(),
            ],
        ]);
    }
}
