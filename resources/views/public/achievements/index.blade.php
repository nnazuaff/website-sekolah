@extends('layouts.public')

@section('title', 'Prestasi Sekolah')

@section('content')
    <section class="site-hero">
        <div class="site-hero-inner">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-sky-300">Pencapaian siswa</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight sm:text-5xl">Prestasi Sekolah</h1>
            <p class="mt-4 max-w-2xl text-slate-300">Kumpulan pencapaian dan karya terbaik warga sekolah.</p>
        </div>
    </section>

    <section class="site-section">
        @if ($achievements->isEmpty())
            <p class="rounded-2xl border border-dashed border-slate-300 p-8 text-center text-slate-500">Belum ada prestasi yang ditampilkan.</p>
        @else
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($achievements as $achievement)
                    <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                        @if ($achievement->photo)
                            <img src="{{ asset('storage/' . $achievement->photo) }}" alt="{{ $achievement->title }}" class="h-52 w-full object-cover">
                        @else
                            <div class="flex h-52 items-center justify-center bg-brand-50 text-brand-700">Prestasi Sekolah</div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center justify-between gap-3 text-sm text-slate-500">
                                <span class="font-semibold text-brand-700">{{ $achievement->level }}</span>
                                <span>{{ $achievement->year }}</span>
                            </div>
                            <h2 class="mt-3 text-xl font-bold text-slate-900">{{ $achievement->title }}</h2>
                            @if ($achievement->description)
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ $achievement->description }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
