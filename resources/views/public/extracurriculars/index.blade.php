@extends('layouts.public')

@section('title', 'Ekstrakurikuler')

@section('content')
    <section class="bg-amber-50">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-amber-700">Tumbuh bersama</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight text-zinc-950 sm:text-5xl">Ekstrakurikuler</h1>
            <p class="mt-4 max-w-2xl text-zinc-600">Ruang bagi siswa untuk mengembangkan minat, bakat, dan karakter.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        @if ($extracurriculars->isEmpty())
            <p class="rounded-xl border border-dashed border-zinc-300 p-8 text-center text-zinc-500">Belum ada ekstrakurikuler yang aktif.</p>
        @else
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($extracurriculars as $extracurricular)
                    <article class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
                        @if ($extracurricular->photo)
                            <img src="{{ asset('storage/' . $extracurricular->photo) }}" alt="{{ $extracurricular->name }}" class="h-52 w-full object-cover">
                        @else
                            <div class="flex h-52 items-center justify-center bg-zinc-100 text-zinc-500">Kegiatan Sekolah</div>
                        @endif
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-zinc-900">{{ $extracurricular->name }}</h2>
                            @if ($extracurricular->description)
                                <p class="mt-3 text-sm leading-6 text-zinc-600">{{ $extracurricular->description }}</p>
                            @endif
                            <dl class="mt-5 space-y-2 border-t border-zinc-100 pt-4 text-sm">
                                @if ($extracurricular->coach)
                                    <div class="flex gap-2"><dt class="font-semibold text-zinc-900">Pembina:</dt><dd class="text-zinc-600">{{ $extracurricular->coach }}</dd></div>
                                @endif
                                @if ($extracurricular->schedule)
                                    <div class="flex gap-2"><dt class="font-semibold text-zinc-900">Jadwal:</dt><dd class="text-zinc-600">{{ $extracurricular->schedule }}</dd></div>
                                @endif
                            </dl>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
