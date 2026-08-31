<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Informasi resmi sekolah untuk keluarga dan masyarakat.">

    <title>@yield('title', 'Website Sekolah')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-stone-50 text-slate-900 antialiased">
    @php($siteProfile = $schoolProfile ?? null)

    <header class="border-b border-slate-200 bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8" aria-label="Navigasi utama">
            <a href="{{ route('home') }}" class="flex items-center gap-3 font-bold tracking-tight text-slate-950">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-amber-400 text-lg text-slate-950">✦</span>
                <span>{{ $siteProfile?->name ?? 'Website Sekolah' }}</span>
            </a>
            <div class="flex items-center gap-5 text-sm font-semibold text-slate-600">
                <a href="{{ route('home') }}" class="transition hover:text-amber-700">Beranda</a>
                <a href="{{ route('school-profile.index') }}" class="transition hover:text-amber-700">Profil</a>
                <a href="{{ route('teachers.index') }}" class="transition hover:text-amber-700">Guru</a>
                <a href="{{ route('contact.index') }}" class="transition hover:text-amber-700">Kontak</a>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-16 bg-slate-950 text-slate-300">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-8 text-sm sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p>© {{ date('Y') }} {{ $siteProfile?->name ?? 'Website Sekolah' }}.</p>
            <a href="{{ route('contact.index') }}" class="font-semibold text-amber-300 hover:text-amber-200">Hubungi kami →</a>
        </div>
    </footer>
</body>

</html>
