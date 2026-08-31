@extends('layouts.public')
@section('title', $announcement->title)
@section('content')
@include('layouts._public-page-header', ['title' => $announcement->title, 'description' => $announcement->published_at?->translatedFormat('d F Y, H:i')])
<article class="site-section"><div class="mx-auto max-w-3xl"><div class="prose prose-slate max-w-none text-slate-700">{!! nl2br(e($announcement->content)) !!}</div></div></article>
@endsection