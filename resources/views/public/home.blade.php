@extends('layouts.public')

@section('title', $schoolProfile?->name ?? 'SMKN 1 Katapang')

@section('content')
    <section class="site-hero overflow-hidden">
        <div class="site-hero-inner grid gap-10 lg:grid-cols-[1.15fr_.85fr] lg:items-end">
            <div>
                <p class="site-eyebrow">Sekolah menengah kejuruan · Kabupaten Bandung</p>
                <h1 class="mt-5 max-w-4xl text-4xl font-black tracking-tight sm:text-6xl">{{ $schoolProfile?->name ?? 'SMKN 1 Katapang' }}</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-blue-100">{{ $schoolProfile?->description ?? 'Informasi sekolah sedang disiapkan. SMKN 1 Katapang hadir untuk membentuk lulusan yang unggul, berkarakter kebangsaan, kompetitif, dan adaptif.' }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('school-profile.index') }}" class="site-button">Kenali sekolah</a>
                    <a href="{{ route('contact.index') }}" class="site-button-secondary">Hubungi kami</a>
                </div>
            </div>
            <aside class="rounded-2xl border border-white/15 bg-brand-900/70 p-7 shadow-xl" aria-label="Identitas sekolah">
                <p class="site-eyebrow">Arah pendidikan</p>
                <p class="mt-4 text-2xl font-black leading-tight">Unggul dalam karya, kuat dalam karakter, siap menghadapi perubahan.</p>
                <p class="mt-5 text-sm leading-6 text-blue-100">Jalan Ceuri Terusan Kopo KM 13,5 · Kabupaten Bandung</p>
            </aside>
        </div>
    </section>

    <section class="site-section">
        <div class="max-w-3xl"><p class="site-eyebrow">Tentang sekolah</p><h2 class="mt-3 text-3xl font-black tracking-tight text-brand-950 sm:text-4xl">Pendidikan vokasi yang dekat dengan kebutuhan masa depan.</h2><p class="mt-5 leading-8 text-slate-600">{{ $schoolProfile?->description ?? 'SMKN 1 Katapang mengembangkan potensi siswa melalui pembelajaran vokasi, pembentukan karakter kebangsaan, dan kesiapan beradaptasi di dunia kerja maupun pendidikan lanjutan.' }}</p></div>
        <div class="mt-14 flex items-end justify-between gap-4"><div><p class="site-eyebrow">Pendidik kami</p><h2 class="mt-2 text-3xl font-black tracking-tight text-brand-950">Guru dan tenaga kependidikan</h2></div><a href="{{ route('teachers.index') }}" class="site-link hidden sm:block">Lihat semua <span aria-hidden="true">→</span></a></div>
        @if ($activeTeachers->isNotEmpty())
            <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">@foreach ($activeTeachers as $teacher)<article class="site-card p-6"><p class="text-xl font-bold text-brand-950">{{ $teacher->name }}</p><p class="mt-2 text-sm font-bold text-brand-700">{{ $teacher->position }}</p><p class="mt-3 text-sm text-slate-500">{{ $teacher->subject }}</p></article>@endforeach</div>
        @else
            <div class="mt-6 rounded-2xl border border-dashed border-blue-200 bg-brand-50 p-8 text-slate-600">Data guru sedang disiapkan.</div>
        @endif

        <div class="mt-16 grid gap-5 md:grid-cols-3">
            <a href="{{ route('majors.index') }}" class="site-card group bg-brand-50 p-6"><p class="site-eyebrow">01</p><h3 class="mt-3 text-xl font-black text-brand-950">Program keahlian</h3><p class="mt-3 text-sm leading-6 text-slate-600">Jelajahi program keahlian dan bekal kompetensi untuk masa depan.</p><span class="mt-6 inline-block site-link">Lihat jurusan <span aria-hidden="true">→</span></span></a>
            <a href="{{ route('news.index') }}" class="site-card group bg-brand-50 p-6"><p class="site-eyebrow">02</p><h3 class="mt-3 text-xl font-black text-brand-950">Berita terbaru</h3><p class="mt-3 text-sm leading-6 text-slate-600">Ikuti kabar dan kegiatan terbaru dari warga sekolah.</p><span class="mt-6 inline-block site-link">Baca berita <span aria-hidden="true">→</span></span></a>
            <a href="{{ route('achievements.index') }}" class="site-card group bg-brand-50 p-6"><p class="site-eyebrow">03</p><h3 class="mt-3 text-xl font-black text-brand-950">Prestasi</h3><p class="mt-3 text-sm leading-6 text-slate-600">Rayakan karya dan pencapaian siswa SMKN 1 Katapang.</p><span class="mt-6 inline-block site-link">Lihat prestasi <span aria-hidden="true">→</span></span></a>
        </div>

        @if ($latestNews->isNotEmpty())
            <div class="mt-16"><div class="flex items-end justify-between gap-4"><div><p class="site-eyebrow">Kabar terkini</p><h2 class="mt-2 text-3xl font-black tracking-tight text-brand-950">Berita terbaru</h2></div><a href="{{ route('news.index') }}" class="site-link">Semua berita <span aria-hidden="true">→</span></a></div><div class="mt-6 grid gap-5 md:grid-cols-3">@foreach ($latestNews as $article)<article class="site-card p-6"><p class="text-sm text-slate-500">{{ $article->published_at->translatedFormat('d F Y') }}</p><h3 class="mt-3 text-xl font-bold text-brand-950">{{ $article->title }}</h3><a href="{{ route('news.show', $article->slug) }}" class="mt-5 inline-block site-link">Baca selengkapnya</a></article>@endforeach</div></div>
        @endif

        @if ($latestAchievements->isNotEmpty())
            <div class="mt-16"><div class="flex items-end justify-between gap-4"><div><p class="site-eyebrow">Capaian warga sekolah</p><h2 class="mt-2 text-3xl font-black tracking-tight text-brand-950">Prestasi terbaru</h2></div><a href="{{ route('achievements.index') }}" class="site-link">Semua prestasi <span aria-hidden="true">→</span></a></div><div class="mt-6 grid gap-5 md:grid-cols-3">@foreach ($latestAchievements as $achievement)<article class="site-card p-6"><p class="text-sm font-bold text-brand-700">{{ $achievement->level }} · {{ $achievement->year }}</p><h3 class="mt-3 text-xl font-bold text-brand-950">{{ $achievement->title }}</h3></article>@endforeach</div></div>
        @endif
    </section>
@endsection
