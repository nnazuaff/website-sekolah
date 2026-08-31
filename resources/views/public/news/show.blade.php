@extends('layouts.public')
@section('title', $article->title)
@section('content')
@include('layouts._public-page-header', ['title' => $article->title, 'description' => $article->published_at->translatedFormat('d F Y, H:i')])
<article class="site-section"><div class="mx-auto max-w-4xl">@if($article->thumbnail)<img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" class="mb-8 max-h-[32rem] w-full rounded object-cover">@endif @if($article->excerpt)<p class="mb-8 text-lg leading-8 text-slate-600">{{ $article->excerpt }}</p>@endif<div class="prose max-w-none text-slate-700">{!! $article->content !!}</div></div></article>
@endsection