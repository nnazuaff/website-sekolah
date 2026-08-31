<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? 'Website resmi SMKN 1 Katapang. Informasi profil, program keahlian, berita, pengumuman, dan kegiatan sekolah.' }}">
    <title>@yield('title', 'SMKN 1 Katapang') | SMKN 1 Katapang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    @php($siteProfile = $schoolProfile ?? null)
    <div class="topbar"><div class="site-shell flex items-center justify-between gap-4"><span>Website resmi {{ $siteProfile?->name ?? 'SMKN 1 Katapang' }}</span><span class="hidden sm:inline">Jalan Ceuri Terusan Kopo KM 13,5, Kabupaten Bandung</span></div></div>
    <header class="site-nav sticky top-0 z-20 border-b border-slate-200 bg-white">
        <nav class="site-shell flex min-h-18 items-center justify-between gap-6" aria-label="Navigasi utama">
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3 text-brand-950" aria-label="Beranda {{ $siteProfile?->name ?? 'SMKN 1 Katapang' }}">
                @if ($siteProfile?->logo)<img src="{{ asset('storage/' . $siteProfile->logo) }}" alt="Logo {{ $siteProfile->name }}" class="h-11 w-11 rounded-lg object-cover">@else<span class="grid h-11 w-11 shrink-0 place-items-center rounded-lg bg-brand-800 text-sm font-black text-white" aria-hidden="true">SK</span>@endif
                <span class="truncate text-sm font-extrabold sm:text-base">{{ $siteProfile?->name ?? 'SMKN 1 Katapang' }}</span>
            </a>
            <details class="mobile-menu relative lg:hidden"><summary class="cursor-pointer list-none rounded-lg border border-slate-300 px-3 py-2 text-sm font-bold text-brand-800">Menu</summary><div class="absolute right-0 top-12 z-30 w-64 rounded-lg border border-slate-200 bg-white p-2 shadow-lg">@include('layouts._public-nav', ['mobile' => true])</div></details>
            <div class="hidden items-center gap-1 text-sm font-semibold lg:flex">@include('layouts._public-nav', ['mobile' => false])</div>
        </nav>
    </header>
    <main>@yield('content')</main>
    <footer class="mt-16 bg-brand-950 text-blue-100">
        <div class="site-shell grid gap-10 py-12 md:grid-cols-3">
            <div><p class="text-lg font-extrabold text-white">{{ $siteProfile?->name ?? 'SMKN 1 Katapang' }}</p><p class="mt-3 max-w-sm text-sm leading-6">Menyiapkan lulusan yang unggul, berkarakter kebangsaan, kompetitif, dan adaptif.</p></div>
            <div><h2 class="font-bold text-white">Tautan cepat</h2><div class="mt-3 grid gap-2 text-sm"><a href="{{ route('school-profile.index') }}" class="footer-link">Profil sekolah</a><a href="{{ route('majors.index') }}" class="footer-link">Program keahlian</a><a href="{{ route('news.index') }}" class="footer-link">Berita sekolah</a><a href="{{ route('contact.index') }}" class="footer-link">Kontak</a></div></div>
            <div><h2 class="font-bold text-white">Kontak dan alamat</h2><p class="mt-3 text-sm leading-6">{{ $siteProfile?->address ?? 'Jalan Ceuri Terusan Kopo KM 13,5, Kabupaten Bandung' }}</p>@if($siteProfile?->phone)<a class="footer-link mt-2 block text-sm" href="tel:{{ $siteProfile->phone }}">{{ $siteProfile->phone }}</a>@endif</div>
        </div><div class="border-t border-white/10"><div class="site-shell py-4 text-xs text-blue-200">© {{ date('Y') }} {{ $siteProfile?->name ?? 'SMKN 1 Katapang' }}. Informasi resmi sekolah.</div></div>
    </footer>
</body>
</html>
