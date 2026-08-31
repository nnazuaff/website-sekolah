<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Informasi resmi SMKN 1 Katapang untuk keluarga dan masyarakat.">
    <title>@yield('title', 'SMKN 1 Katapang')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    @php($siteProfile = $schoolProfile ?? null)
    <header class="sticky top-0 z-20 border-b border-blue-100/80 bg-white/95 backdrop-blur">
        <nav class="site-shell flex flex-wrap items-center justify-between gap-4 py-4" aria-label="Navigasi utama">
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3 font-black tracking-tight text-brand-950">
                @if ($siteProfile?->logo)
                    <img src="{{ asset('storage/' . $siteProfile->logo) }}" alt="Logo {{ $siteProfile->name }}" class="h-10 w-10 rounded-xl object-cover">
                @else
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-900 text-lg text-white" aria-hidden="true">SK</span>
                @endif
                <span class="truncate">{{ $siteProfile?->name ?? 'SMKN 1 Katapang' }}</span>
            </a>
            <div class="flex w-full flex-wrap items-center gap-x-4 gap-y-2 text-sm font-semibold text-slate-600 sm:w-auto sm:justify-end">
                <a href="{{ route('home') }}" class="transition hover:text-brand-700">Beranda</a>
                <a href="{{ route('school-profile.index') }}" class="transition hover:text-brand-700">Profil</a>
                <a href="{{ route('majors.index') }}" class="transition hover:text-brand-700">Jurusan</a>
                <a href="{{ route('teachers.index') }}" class="transition hover:text-brand-700">Guru</a>
                <a href="{{ route('news.index') }}" class="transition hover:text-brand-700">Berita</a>
                <a href="{{ route('pengumuman.index') }}" class="transition hover:text-brand-700">Pengumuman</a>
                <a href="{{ route('galeri.index') }}" class="transition hover:text-brand-700">Galeri</a>
                <a href="{{ route('fasilitas.index') }}" class="transition hover:text-brand-700">Fasilitas</a>
                <a href="{{ route('contact.index') }}" class="transition hover:text-brand-700">Kontak</a>
            </div>
        </nav>
    </header>
    <main>@yield('content')</main>
    <footer class="mt-16 bg-brand-950 text-blue-100">
        <div class="site-shell flex flex-col gap-5 py-9 text-sm sm:flex-row sm:items-center sm:justify-between">
            <div><p class="font-bold text-white">{{ $siteProfile?->name ?? 'SMKN 1 Katapang' }}</p><p class="mt-1">© {{ date('Y') }} · Informasi resmi sekolah</p></div>
            <a href="{{ route('contact.index') }}" class="font-bold text-sky-300 transition hover:text-white">Hubungi kami <span aria-hidden="true">→</span></a>
        </div>
    </footer>
</body>
</html>
