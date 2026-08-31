@extends('layouts.public')
@section('title', $schoolProfile?->name ?: 'SMKN 1 Katapang')
@section('content')
    <section class="home-hero">
        <img src="{{ asset('images/school-hero.jpg') }}" alt="Kegiatan sekolah SMKN 1 Katapang" width="1600"
            height="1067" fetchpriority="high" class="home-hero-image">
        <div class="home-hero-overlay" aria-hidden="true"></div>
        <div class="site-shell home-hero-content">
            <p class="home-hero-kicker">Portal informasi sekolah</p>
            <h1 class="home-hero-title">{{ $schoolProfile?->name ?: 'SMKN 1 Katapang' }}</h1>
            <p class="home-hero-copy">
                {{ $schoolProfile?->description ? strip_tags($schoolProfile->description) : 'Informasi sekolah sedang disiapkan.' }}
            </p>
            <div class="home-hero-actions">
                <a href="{{ route('school-profile.index') }}" class="home-hero-primary">Profil sekolah</a>
                <a href="{{ route('pengumuman.index') }}" class="home-hero-secondary">Pengumuman</a>
            </div>
        </div>
    </section>
    <section class="site-section">
        <div class="grid gap-8 lg:grid-cols-[.75fr_1.25fr]">
            <div>
                <h2 class="text-2xl font-bold text-brand-950">Informasi pendidikan dan layanan sekolah</h2>
                <p class="mt-4 leading-7 text-slate-600">Temukan program keahlian, pendidik, kegiatan siswa, berita, dan
                    pengumuman melalui portal sekolah.</p><a href="{{ route('school-profile.index') }}"
                    class="site-link mt-4 inline-block">Selengkapnya tentang sekolah</a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ([['majors.index', 'Program keahlian', 'Pilihan kompetensi untuk siswa.'], ['teachers.index', 'Guru dan tendik', 'Pendidik dan tenaga kependidikan.'], ['fasilitas.index', 'Fasilitas', 'Sarana pendukung pembelajaran.'], ['extracurriculars.index', 'Ekstrakurikuler', 'Kegiatan minat dan bakat siswa.']] as $link)
                    <a href="{{ route($link[0]) }}" class="site-card p-5 hover:border-blue-300 hover:bg-brand-50">
                        <h3 class="font-bold text-brand-950">{{ $link[1] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $link[2] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @if ($latestNews->isNotEmpty())
        <section class="border-y border-slate-200 bg-white">
            <div class="site-section">
                <div class="flex items-end justify-between border-b border-slate-200 pb-4">
                    <h2 class="text-2xl font-bold text-brand-950">Berita terbaru</h2><a class="site-link"
                        href="{{ route('news.index') }}">Lihat semua</a>
                </div>
                <div class="mt-6 grid gap-6 md:grid-cols-3">
                    @foreach ($latestNews as $article)
                        <article class="site-card p-5">
                            <p class="site-meta">{{ $article->published_at->translatedFormat('d F Y') }}</p>
                            <h3 class="mt-2 font-bold text-brand-950">{{ $article->title }}</h3><a
                                class="site-link mt-4 inline-block text-sm"
                                href="{{ route('news.show', $article->slug) }}">Baca berita</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <section class="site-section grid gap-8 lg:grid-cols-2">
        <div class="site-card p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-brand-950">Pengumuman</h2><a class="site-link text-sm"
                    href="{{ route('pengumuman.index') }}">Semua</a>
            </div>
            <div class="mt-4 divide-y divide-slate-200">
                @forelse($latestAnnouncements as $announcement)
                    <a class="block py-3 font-bold text-brand-950 hover:text-brand-700"
                        href="{{ route('pengumuman.show', $announcement->slug) }}">{{ $announcement->title }}<span
                        class="mt-1 block text-xs font-normal text-slate-500">{{ $announcement->published_at?->translatedFormat('d F Y') }}</span></a>@empty
                    <p class="py-3 text-sm text-slate-600">Belum ada pengumuman yang diterbitkan.</p>
                @endforelse
            </div>
        </div>
        <div class="site-card p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-brand-950">Prestasi terbaru</h2><a class="site-link text-sm"
                    href="{{ route('achievements.index') }}">Semua</a>
            </div>
            <div class="mt-4 divide-y divide-slate-200">
                @forelse($latestAchievements as $achievement)
                    <div class="py-3">
                        <p class="site-meta text-brand-700">{{ $achievement->level }} · {{ $achievement->year }}</p>
                        <h3 class="mt-1 font-bold text-brand-950">{{ $achievement->title }}</h3>
                </div>@empty<p class="py-3 text-sm text-slate-600">Belum ada prestasi yang ditampilkan.</p>
                @endforelse
            </div>
        </div>
    </section>
    @if ($activeTeachers->isNotEmpty())
        <section class="bg-brand-50">
            <div class="site-section">
                <div class="flex items-end justify-between border-b border-blue-100 pb-4">
                    <h2 class="text-2xl font-bold text-brand-950">Guru dan tenaga kependidikan</h2><a class="site-link"
                        href="{{ route('teachers.index') }}">Lihat semua</a>
                </div>
                <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($activeTeachers as $teacher)
                        <div class="site-card p-5">
                            <p class="font-bold text-brand-950">{{ $teacher->name }}</p>
                            <p class="mt-1 text-sm font-semibold text-brand-700">{{ $teacher->position }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $teacher->subject }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    {{-- <section class="bg-brand-800">
        <div class="site-shell flex flex-col gap-4 py-10 text-white sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Butuh informasi sekolah?</h2>
                <p class="mt-2 text-sm text-blue-100">Hubungi sekolah melalui halaman kontak.</p>
            </div><a href="{{ route('contact.index') }}"
                class="site-button bg-white text-brand-800 hover:bg-blue-50">Hubungi sekolah</a>
        </div>
    </section> --}}
@endsection
