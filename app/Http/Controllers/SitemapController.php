<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::published()->latest('published_at')->get();
        $albums = Album::published()->latest('published_at')->get();

        return response()
            ->view('sitemap', compact('posts', 'albums'))
            ->header('Content-Type', 'application/xml');
    }
}
