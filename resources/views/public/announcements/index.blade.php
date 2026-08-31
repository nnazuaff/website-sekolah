@extends('layouts.public')
@section('title', 'Pengumuman')
@section('content')
<section class="site-hero"><div class="site-hero-inner"><a href="{{ route('home') }}" class="text-sm text-slate-300 hover:text-white">← Kembali ke beranda</a><h1 class="mt-8 text-4xl font-bold">Pengumuman</h1><p class="mt-4 text-slate-300">Informasi terbaru dari sekolah.</p></div></section>
<section class="site-section max-w-4xl"><div class="space-y-5">@forelse($announcements as $announcement)<article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"><p class="text-sm text-slate-500">{{ $announcement->published_at?->translatedFormat('d F Y') }}</p><h2 class="mt-2 text-2xl font-semibold"><a class="hover:text-slate-600" href="{{ route('pengumuman.show', $announcement->slug) }}">{{ $announcement->title }}</a></h2><p class="mt-3 text-slate-600">{{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 180) }}</p><a class="mt-4 inline-block font-medium text-slate-900 underline" href="{{ route('pengumuman.show', $announcement->slug) }}">Baca selengkapnya</a></article>@empty<p class="text-slate-500">Belum ada pengumuman.</p>@endforelse</div></section>
@endsection
