@extends('layouts.public')

@section('title', 'Jurusan')

@section('content')
    <section class="bg-zinc-950 text-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-amber-400">Program keahlian</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">Jurusan</h1>
            <p class="mt-4 max-w-2xl text-zinc-300">Kenali program keahlian yang tersedia di sekolah kami.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        @if ($majors->isEmpty())
            <p class="rounded-xl border border-dashed border-zinc-300 p-8 text-center text-zinc-500">Belum ada jurusan aktif.</p>
        @else
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($majors as $major)
                    <article class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
                        @if ($major->image)
                            <img src="{{ asset('storage/' . $major->image) }}" alt="{{ $major->name }}" class="h-48 w-full object-cover">
                        @else
                            <div class="flex h-48 items-center justify-center bg-amber-50 font-semibold text-amber-700">{{ $major->short_name }}</div>
                        @endif
                        <div class="p-6">
                            <p class="text-sm font-semibold text-amber-700">{{ $major->short_name }}</p>
                            <h2 class="mt-2 text-xl font-bold">{{ $major->name }}</h2>
                            @if ($major->description)
                                <p class="mt-3 text-sm leading-6 text-zinc-600">{{ Str::limit($major->description, 140) }}</p>
                            @endif
                            <a href="{{ route('majors.show', $major->slug) }}" class="mt-5 inline-block font-semibold text-zinc-900 underline">Lihat detail</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
