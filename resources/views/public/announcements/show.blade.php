@extends('layouts.public')
@section('title', $announcement->title)
@section('content')
<section class="site-section max-w-3xl"><a href="{{ route('pengumuman.index') }}" class="text-sm text-slate-500 hover:text-slate-900">← Kembali ke pengumuman</a><p class="mt-8 text-sm text-slate-500">{{ $announcement->published_at?->translatedFormat('d F Y, H:i') }}</p><h1 class="mt-2 text-4xl font-bold tracking-tight">{{ $announcement->title }}</h1><div class="prose prose-slate mt-8 max-w-none">{!! nl2br(e($announcement->content)) !!}</div></section>
@endsection
