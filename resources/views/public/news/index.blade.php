@extends('layouts.public')

@section('title', 'Berita')

@section('content')
    <section class="bg-zinc-950 text-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-amber-400">Kabar sekolah</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">Berita</h1>
            <p class="mt-4 max-w-2xl text-zinc-300">Informasi dan kegiatan terbaru dari sekolah.</p>
        </div>
    </section>
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        @if ($news->isEmpty())
            <p class="rounded-xl border border-dashed border-zinc-300 p-8 text-center text-zinc-500">Belum ada berita yang diterbitkan.</p>
        @else
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($news as $article)
                    <article class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
                        @if ($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="h-48 w-full object-cover">
                        @else
                            <div class="flex h-48 items-center justify-center bg-amber-50 font-semibold text-amber-700">Berita Sekolah</div>
                        @endif
                        <div class="p-6">
                            <p class="text-sm text-zinc-500">{{ $article->published_at->translatedFormat('d F Y') }}</p>
                            <h2 class="mt-2 text-xl font-bold">{{ $article->title }}</h2>
                            @if ($article->excerpt)<p class="mt-3 text-sm leading-6 text-zinc-600">{{ $article->excerpt }}</p>@endif
                            <a href="{{ route('news.show', $article->slug) }}" class="mt-5 inline-block font-semibold text-zinc-900 underline">Baca selengkapnya</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
