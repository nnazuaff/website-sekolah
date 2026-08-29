<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $latestNews = News::where('status', 'published')
        ->latest('published_at')
        ->take(5)
        ->get();

    return view('news.index', compact('latestNews'));
    }

    public function show(string $slug)
{
    $article = News::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

    $latestNews = News::where('status', 'published')
        ->where('id', '!=', $article->id)
        ->latest('published_at')
        ->take(5)
        ->get();

    $previous = News::where('status', 'published')
        ->where('published_at', '<', $article->published_at)
        ->orderByDesc('published_at')
        ->first();

    $next = News::where('status', 'published')
        ->where('published_at', '>', $article->published_at)
        ->orderBy('published_at')
        ->first();

    return view('news.show', compact('article', 'latestNews', 'previous', 'next'));
}
}