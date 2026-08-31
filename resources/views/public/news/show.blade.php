@extends('layouts.public')

@section('title', $article->title)

@section('content')
    <section class="site-hero">
        <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8">
            <a href="{{ route('news.index') }}" class="text-sm text-sky-300">&larr; Kembali ke berita</a>
            <p class="mt-8 text-sm text-slate-400">{{ $article->published_at->translatedFormat('d F Y, H:i') }}</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">{{ $article->title }}</h1>
        </div>
    </section>
    <article class="site-section max-w-4xl">
        @if ($article->thumbnail)
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="mb-8 max-h-[32rem] w-full rounded-2xl object-cover">
        @endif
        @if ($article->excerpt)<p class="mb-8 text-lg leading-8 text-slate-600">{{ $article->excerpt }}</p>@endif
        <div class="prose max-w-none text-slate-700">{!! $article->content !!}</div>
    </article>
@endsection
