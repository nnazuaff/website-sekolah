@extends('layouts.public')

@section('title', 'Guru')

@section('content')
    <section class="site-hero">
        <div class="site-hero-inner">
            <a href="{{ route('home') }}" class="text-sm text-slate-300 transition hover:text-white">
                ← Kembali ke beranda
            </a>

            <h1 class="mt-8 text-4xl font-bold tracking-tight sm:text-5xl">
                Guru dan Tenaga Kependidikan
            </h1>
            <p class="mt-4 max-w-2xl text-slate-300">
                Kenali para pendidik yang berdedikasi mendampingi siswa untuk berkembang dan berprestasi.
            </p>
        </div>
    </section>

    <section class="site-section">
        <livewire:teacher-list />
    </section>
@endsection
