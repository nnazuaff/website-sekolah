<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('status', 'published')
            ->latest('published_at')
            ->get();

        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $article = News::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('news.show', compact('article'));
    }
}