@extends('layouts.public')

@section('title', 'Profil Sekolah')

@section('content')
    <section class="site-hero">
        <div class="site-hero-inner">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-sky-300">Profil sekolah</p>
            <h1 class="mt-4 max-w-3xl text-4xl font-black tracking-tight sm:text-5xl">Mengenal lebih dekat {{ $schoolProfile?->name ?? 'sekolah kami' }}.</h1>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        @if ($schoolProfile)
            <div class="grid gap-12 lg:grid-cols-[1.1fr_.9fr]">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-700">Tentang kami</p>
                    <h2 class="mt-3 text-3xl font-black">{{ $schoolProfile->name }}</h2>
                    <p class="mt-5 whitespace-pre-line leading-8 text-slate-600">{{ $schoolProfile->description ?: 'SMKN 1 Katapang menyiapkan lulusan yang unggul, berkarakter kebangsaan, kompetitif, dan adaptif melalui pendidikan vokasi yang relevan.' }}</p>
                    <div class="mt-10">
                        <h3 class="text-xl font-black">Sejarah</h3>
                        <p class="mt-3 whitespace-pre-line leading-8 text-slate-600">{{ $schoolProfile->history ?: 'SMKN 1 Katapang berawal dari SMKN 4 Soreang, kemudian mengalami perubahan nama untuk melayani kebutuhan pendidikan vokasi di wilayah Katapang dan sekitarnya.' }}</p>
                    </div>
                </div>
                <div class="space-y-5">
                    <div class="rounded-2xl bg-brand-100 p-7">
                        <p class="text-sm font-bold uppercase tracking-widest text-brand-800">Visi</p>
                        <p class="mt-4 whitespace-pre-line text-lg font-semibold leading-8 text-slate-800">{{ $schoolProfile->vision ?: 'Menjadi SMK yang unggul, berkarakter kebangsaan, kompetitif, dan adaptif.' }}</p>
                    </div>
                    <div class="rounded-2xl bg-blue-50 p-7">
                        <p class="text-sm font-bold uppercase tracking-widest text-slate-600">Misi</p>
                        <p class="mt-4 whitespace-pre-line leading-8 text-slate-700">{{ $schoolProfile->mission ?: 'Misi sekolah sedang disiapkan.' }}</p>
                    </div>
                </div>
            </div>

            @if ($schoolProfile->principal_name || $schoolProfile->principal_greeting)
                <div class="mt-14 border-t border-slate-200 pt-10">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-700">Sambutan</p>
                    <h2 class="mt-3 text-2xl font-black">{{ $schoolProfile->principal_name ?: 'Kepala sekolah' }}</h2>
                    <p class="mt-4 max-w-3xl whitespace-pre-line leading-8 text-slate-600">{{ $schoolProfile->principal_greeting ?: 'Sambutan kepala sekolah sedang disiapkan.' }}</p>
                </div>
            @endif
        @else
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-500">Profil sekolah sedang disiapkan.</div>
        @endif
    </section>
@endsection
