@extends('layouts.public')

@section('title', 'Berita')

@section('content')
    <section class="site-hero">
        <div class="site-hero-inner">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-sky-300">Kabar sekolah</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">Berita</h1>
            <p class="mt-4 max-w-2xl text-slate-300">Informasi dan kegiatan terbaru dari sekolah.</p>
        </div>
    </section>
    <section class="site-section">
        @if ($news->isEmpty())
            <p class="rounded-2xl border border-dashed border-slate-300 p-8 text-center text-slate-500">Belum ada berita yang diterbitkan.</p>
        @else
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($news as $article)
                    <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                        @if ($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="h-48 w-full object-cover">
                        @else
                            <div class="flex h-48 items-center justify-center bg-brand-50 font-semibold text-brand-700">Berita Sekolah</div>
                        @endif
                        <div class="p-6">
                            <p class="text-sm text-slate-500">{{ $article->published_at->translatedFormat('d F Y') }}</p>
                            <h2 class="mt-2 text-xl font-bold">{{ $article->title }}</h2>
                            @if ($article->excerpt)<p class="mt-3 text-sm leading-6 text-slate-600">{{ $article->excerpt }}</p>@endif
                            <a href="{{ route('news.show', $article->slug) }}" class="mt-5 inline-block font-semibold text-slate-900 underline">Baca selengkapnya</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
