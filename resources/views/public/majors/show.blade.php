@extends('layouts.public')

@section('title', $major->name)

@section('content')
    <section class="bg-zinc-950 text-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <a href="{{ route('majors.index') }}" class="text-sm text-amber-400">&larr; Kembali ke jurusan</a>
            <p class="mt-8 text-sm font-semibold uppercase tracking-[0.24em] text-amber-400">{{ $major->short_name }}</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">{{ $major->name }}</h1>
        </div>
    </section>
    <section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        @if ($major->image)
            <img src="{{ asset('storage/' . $major->image) }}" alt="{{ $major->name }}" class="mb-8 max-h-[28rem] w-full rounded-2xl object-cover">
        @endif
        <div class="prose max-w-none text-zinc-700">
            {!! nl2br(e($major->description ?? 'Informasi jurusan belum tersedia.')) !!}
        </div>
    </section>
@endsection
