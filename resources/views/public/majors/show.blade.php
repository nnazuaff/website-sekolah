@extends('layouts.public')

@section('title', $major->name)

@section('content')
    <section class="site-hero">
        <div class="site-hero-inner">
            <a href="{{ route('majors.index') }}" class="text-sm text-sky-300">&larr; Kembali ke jurusan</a>
            <p class="mt-8 text-sm font-semibold uppercase tracking-[0.24em] text-sky-300">{{ $major->short_name }}</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">{{ $major->name }}</h1>
        </div>
    </section>
    <section class="site-section max-w-4xl">
        @if ($major->image)
            <img src="{{ asset('storage/' . $major->image) }}" alt="{{ $major->name }}" class="mb-8 max-h-[28rem] w-full rounded-2xl object-cover">
        @endif
        <div class="prose max-w-none text-slate-700">
            {!! nl2br(e($major->description ?? 'Informasi jurusan belum tersedia.')) !!}
        </div>
    </section>
@endsection
