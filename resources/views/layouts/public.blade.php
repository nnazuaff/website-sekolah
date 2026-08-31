<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? 'Portal informasi sekolah.' }}">
    @php($siteProfile = $schoolProfile ?? null)
    @php($schoolName = $siteProfile?->name ?: 'SMKN 1 Katapang')
    <title>@yield('title', $schoolName) | {{ $schoolName }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="public-page">
    @php($schoolLogo = $siteProfile?->logo ? asset('storage/' . $siteProfile->logo) : null)
    <header class="site-nav" data-site-header>
        <div class="topbar"><div class="site-shell flex flex-wrap items-center justify-between gap-2"><span>Portal resmi sekolah</span><span>SMK Negeri 1 Katapang</span></div></div>
        <nav class="site-shell site-nav-main" aria-label="Navigasi utama">
            <a href="{{ route('home') }}" class="school-brand" aria-label="Beranda {{ $schoolName }}">
                @if($schoolLogo)<img src="{{ $schoolLogo }}" alt="Logo {{ $schoolName }}" class="school-brand-logo">@else<span class="school-brand-mark" aria-hidden="true">SMK</span>@endif
                <span><strong>{{ $schoolName }}</strong><small>Portal sekolah</small></span>
            </a>
            <div class="desktop-nav">@include('layouts._public-nav')</div>
            <details class="mobile-menu"><summary class="mobile-menu-trigger"><span aria-hidden="true"><i></i><i></i><i></i></span><span>Menu</span></summary><div class="mobile-menu-panel">@include('layouts._public-nav', ['mobile' => true])</div></details>
        </nav>
    </header>
    <main>@yield('content')</main>
    <footer class="site-footer"><div class="site-shell footer-grid">
        <div><div class="footer-brand">{{ $schoolName }}</div><p class="footer-copy">Portal informasi resmi untuk layanan, berita, dan kegiatan sekolah.</p></div>
        <div><h2 class="footer-heading">Navigasi</h2><div class="footer-links"><a href="{{ route('school-profile.index') }}">Profil sekolah</a><a href="{{ route('majors.index') }}">Program keahlian</a><a href="{{ route('news.index') }}">Berita sekolah</a><a href="{{ route('pengumuman.index') }}">Pengumuman</a></div></div>
        <div><h2 class="footer-heading">Kontak sekolah</h2>@if($siteProfile?->address)<p class="footer-copy">{{ $siteProfile->address }}</p>@endif @if($siteProfile?->phone)<a class="footer-link" href="tel:{{ $siteProfile->phone }}">{{ $siteProfile->phone }}</a>@endif @if($siteProfile?->email)<a class="footer-link" href="mailto:{{ $siteProfile->email }}">{{ $siteProfile->email }}</a>@endif</div>
    </div><div class="footer-bottom"><div class="site-shell">© {{ date('Y') }} {{ $schoolName }}</div></div></footer>
</body>
</html>