<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;

class NewsController extends Controller
{
    private function publishedQuery(): Builder
    {
        return News::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function index()
    {
        $news = $this->publishedQuery()->latest('published_at')->get();

        return view('public.news.index', compact('news'));
    }

    public function show(string $slug)
    {
        $article = $this->publishedQuery()->where('slug', $slug)->firstOrFail();

        return view('public.news.show', compact('article'));
    }
}
