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

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function aboutWho(): View
    {
        return view('pages.about.who');
    }

    public function aboutJourney(): View
    {
        return view('pages.about.journey');
    }

    public function aboutValues(): View
    {
        return view('pages.about.values');
    }

    public function aboutVision(): View
    {
        return view('pages.about.vision');
    }

    public function aboutServices(): View
    {
        return view('pages.about.services');
    }

    public function sitemap(): View
    {
        $posts = Post::published()->latest('published_at')->get(['title', 'slug', 'published_at']);
        $albums = Album::published()->latest('published_at')->get(['title', 'slug', 'published_at']);

        return view('pages.sitemap', compact('posts', 'albums'));
    }
}
