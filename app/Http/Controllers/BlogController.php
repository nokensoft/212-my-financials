<?php

namespace App\Http\Controllers;

use App\Http\Concerns\AppliesContentFilters;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    use AppliesContentFilters;

    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();

        $query = Post::query()->published()->with('categories');
        $this->applyContentFilters($query, $request, ['title', 'excerpt', 'body']);

        /** @var LengthAwarePaginator $posts */
        $posts = $query->paginate(9)->withQueryString();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post): View
    {
        abort_unless($post->isPublished(), 404);

        $post->increment('views');
        $post->load('categories', 'user');

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->whereHas('categories', fn ($c) => $c->whereIn('categories.id', $post->categories->pluck('id')))
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
