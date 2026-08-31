@extends('layouts.public')

@section('title', $schoolProfile?->name ?? 'Beranda')

@section('content')
    <section class="overflow-hidden bg-slate-950 text-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-20 sm:px-6 lg:grid-cols-[1.2fr_.8fr] lg:items-end lg:px-8 lg:py-28">
            <div>
                <p class="mb-5 text-sm font-bold uppercase tracking-[0.25em] text-amber-300">Selamat datang</p>
                <h1 class="max-w-3xl text-4xl font-black tracking-tight sm:text-6xl">
                    {{ $schoolProfile?->name ?? 'Website Sekolah' }}
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                    {{ $schoolProfile?->description ?? 'Informasi sekolah sedang disiapkan.' }}
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('school-profile.index') }}" class="rounded-full bg-amber-400 px-6 py-3 font-bold text-slate-950 transition hover:bg-amber-300">Kenali sekolah kami</a>
                    <a href="{{ route('contact.index') }}" class="rounded-full border border-slate-600 px-6 py-3 font-bold text-white transition hover:border-amber-300 hover:text-amber-300">Hubungi kami</a>
                </div>
            </div>
            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-7">
                <p class="text-sm font-semibold text-amber-300">Komitmen kami</p>
                <p class="mt-4 text-2xl font-bold leading-tight">Membuka ruang bagi siswa untuk tumbuh, berkarya, dan berprestasi.</p>
                <div class="mt-8 h-1 w-16 rounded-full bg-amber-400"></div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-amber-700">Tentang sekolah</p>
            <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950">Tempat belajar yang mempersiapkan masa depan.</h2>
            <p class="mt-5 leading-7 text-slate-600">{{ $schoolProfile?->description ?? 'Informasi sekolah sedang disiapkan.' }}</p>
        </div>

        <div class="mt-12 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-amber-700">Pendidik kami</p>
                <h2 class="mt-2 text-3xl font-black tracking-tight">Guru dan tenaga kependidikan</h2>
            </div>
            <a href="{{ route('teachers.index') }}" class="hidden font-bold text-amber-700 hover:text-amber-800 sm:block">Lihat semua →</a>
        </div>
        @if ($activeTeachers->isNotEmpty())
            <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($activeTeachers as $teacher)
                    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <p class="text-xl font-bold text-slate-950">{{ $teacher->name }}</p>
                        <p class="mt-2 text-sm font-semibold text-amber-700">{{ $teacher->position }}</p>
                        <p class="mt-3 text-sm text-slate-500">{{ $teacher->subject }}</p>
                    </article>
                @endforeach
            </div>
        @else
            <div class="mt-6 rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-slate-500">Data guru sedang disiapkan.</div>
        @endif

        <div class="mt-16 grid gap-5 md:grid-cols-3">
            @foreach (['Program keahlian' => 'Temukan ruang belajar yang sesuai dengan minat dan potensimu.', 'Berita terbaru' => 'Ikuti kabar dan kegiatan terbaru dari sekolah.', 'Prestasi' => 'Rayakan karya dan pencapaian warga sekolah.'] as $heading => $description)
                <div class="rounded-2xl bg-amber-100 p-6">
                    <h3 class="text-xl font-black">{{ $heading }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-700">{{ $description }}</p>
                    <p class="mt-6 text-sm font-semibold text-slate-500">Konten akan segera hadir.</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
