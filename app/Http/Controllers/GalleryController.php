<?php

namespace App\Http\Controllers;

use App\Http\Concerns\AppliesContentFilters;
use App\Models\Album;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    use AppliesContentFilters;

    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();

        $query = Album::query()->published()->withCount('photos')->with('categories');
        $this->applyContentFilters($query, $request, ['title', 'description']);

        /** @var LengthAwarePaginator $albums */
        $albums = $query->paginate(6)->withQueryString();

        return view('gallery.index', compact('albums', 'categories'));
    }

    public function show(Album $album): View
    {
        abort_unless($album->isPublished(), 404);

        $album->increment('views');
        $album->load('photos', 'categories');

        return view('gallery.show', compact('album'));
    }
}
