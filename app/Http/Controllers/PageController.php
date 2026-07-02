<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Post;
use Illuminate\View\View;

class PageController extends Controller
{
    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function faq(): View
    {
        return view('pages.faq');
    }

    public function sitemap(): View
    {
        $posts = Post::published()->latest('published_at')->get(['title', 'slug', 'published_at']);
        $albums = Album::published()->latest('published_at')->get(['title', 'slug', 'published_at']);

        return view('pages.sitemap', compact('posts', 'albums'));
    }
}
