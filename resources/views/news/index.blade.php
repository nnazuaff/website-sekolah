<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - {{ config('app.SMKN 1 Katapang', 'SMKN 1 Katapang') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @livewireStyles

    <style>
        :root {
            --blue-900: #14265A;
            --blue-800: #1B3A8A;
            --blue-600: #2563EB;
            --blue-100: #DBEAFE;
            --gold: #F5A623;
            --paper: #F6F8FB;
            --card: #FFFFFF;
            --line: #E4E8EF;
            --ink: #12203D;
            --muted: #64748B;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--paper);
            color: var(--ink);
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }

        /* ================= NAVBAR ================= */
        .navbar {
            display: flex;
            align-items: center;
            padding: 14px 40px;
            background: #fff;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .brand { display: flex; align-items: center; gap: 12px; }

        .brand-icon { width: 44px; height: 44px; object-fit: contain; }

        .brand-text h1 { font-size: 15px; margin: 0; font-weight: 800; letter-spacing: 0.01em; }
        .brand-text p { margin: 0; font-size: 11.5px; color: var(--muted); }

        /* ================= HERO ================= */
        .hero {
            background: linear-gradient(120deg, var(--blue-900), var(--blue-800));
            color: #fff;
            padding: 56px 40px 48px;
        }

        .hero-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero h2 { font-size: 34px; font-weight: 800; margin: 0 0 10px; }
        .hero-underline { width: 56px; height: 4px; background: var(--gold); border-radius: 2px; margin-bottom: 16px; }
        .hero p { max-width: 460px; color: #C7D2E8; font-size: 14.5px; line-height: 1.6; margin: 0; }
        .breadcrumb { font-size: 13.5px; color: #C7D2E8; }
        .breadcrumb a { color: #fff; }

        /* ================= WRAP & MAIN LAYOUT ================= */
        .wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 40px 80px;
        }

        .main-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 28px;
            align-items: start;
        }

        /* ================= TOOLBAR (dipakai di komponen Livewire) ================= */
        .toolbar { margin-bottom: 24px; }

        .search-input {
            width: 100%;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            font-family: inherit;
            color: var(--ink);
        }

        /* ================= NEWS GRID & CARD ================= */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 22px;
        }

        .news-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            overflow: hidden;
        }

        .news-thumb {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: block;
        }

        .news-thumb-empty { background: var(--blue-100); }

        .news-body { padding: 18px; }

        .news-date {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--muted);
            margin: 0 0 10px;
        }

        .news-body h3 {
            font-size: 15.5px;
            font-weight: 700;
            margin: 0 0 8px;
            line-height: 1.4;
        }

        .news-excerpt {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            margin: 0 0 14px;
        }

        .news-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--blue-600);
        }

        /* ================= EMPTY STATE ================= */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background: var(--card);
            border: 1px dashed var(--line);
            border-radius: 14px;
            color: var(--muted);
        }

        .pagination-wrap { margin-top: 32px; }

        /* ================= SIDEBAR ================= */
        .sidebar-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 20px;
        }

        .sidebar-card h4 {
            font-size: 14.5px;
            font-weight: 700;
            margin: 0 0 16px;
        }

        .latest-item {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-top: 1px solid var(--line);
        }

        .latest-item:first-of-type { border-top: none; padding-top: 0; }

        .latest-thumb {
            width: 56px;
            height: 56px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .latest-thumb-empty { background: var(--blue-100); }

        .latest-info h5 {
            font-size: 12.5px;
            font-weight: 600;
            margin: 0 0 4px;
            line-height: 1.4;
        }

        .latest-info p {
            font-size: 11px;
            color: var(--muted);
            margin: 0;
        }

        /* ================= FOOTER ================= */
        .site-footer { background: #F1F4F9; border-top: 1px solid var(--line); padding-top: 48px; }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr 1fr;
            gap: 32px;
            padding: 0 40px 32px;
        }

        .footer-grid h4 { font-size: 13.5px; margin: 0 0 14px; }
        .footer-grid p, .footer-grid a { font-size: 13px; color: var(--muted); display: block; margin-bottom: 10px; }

        .social-icons { display: flex; gap: 10px; margin-top: 14px; }
        .social-icons a {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--blue-600); color: #fff;
            display: flex; align-items: center; justify-content: center;
        }

        .footer-bottom { background: var(--blue-800); color: #C7D2E8; text-align: center; font-size: 12.5px; padding: 14px; }

        @media (max-width: 900px) {
            .main-layout { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .navbar, .hero, .wrap, .footer-grid, .footer-bottom { padding-left: 20px; padding-right: 20px; }
            .hero h2 { font-size: 28px; }
            .hero-top { flex-direction: column; align-items: flex-start; gap: 16px; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 28px 20px; }
        }

        @media (max-width: 480px) {
            .brand-text p { display: none; }
            .hero { padding: 32px 16px 28px; }
            .hero h2 { font-size: 24px; }
            .wrap { padding: 24px 16px 56px; }
            .news-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; padding-left: 16px; padding-right: 16px; gap: 28px; }
            .footer-bottom { padding-left: 16px; padding-right: 16px; }
        }
    </style>
</head>

<body>

    <header class="navbar">
    <a href="/" class="brand">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo Sekolah" class="brand-icon">
        <div class="brand-text">
            <h1>{{ config('app.SMKN 1 Katapang', 'SMKN 1 Katapang') }}</h1>
            <p>Membangun Generasi Unggul</p>
        </div>
    </a>
    </header>

    <section class="hero">
        <div class="hero-top">
            <div>
                <h2>Berita</h2>
                <div class="hero-underline"></div>
                <p>Informasi terbaru dan kegiatan menarik di {{ config('app.SMKN 1 Katapang', 'SMKN 1 Katapang') }}.</p>
            </div>
            <div class="breadcrumb"><a href="/">Beranda</a> / Berita</div>
        </div>
    </section>

    <div class="wrap">
        <div class="main-layout">

            <div>
                <livewire:news-list />
            </div>

            <aside class="sidebar-card">
                <h4>Berita Terbaru</h4>

                @forelse ($latestNews as $item)
                    <a href="{{ route('news.show', $item->slug) }}" class="latest-item">
                        @if ($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="latest-thumb">
                        @else
                            <div class="latest-thumb latest-thumb-empty"></div>
                        @endif

                        <div class="latest-info">
                            <h5>{{ $item->title }}</h5>
                            <p>{{ optional($item->published_at)->translatedFormat('d F Y') }}</p>
                        </div>
                    </a>
                @empty
                    <p style="font-size: 13px; color: var(--muted);">Belum ada berita.</p>
                @endforelse
            </aside>

        </div>
    </div>

    <footer class="site-footer">
        <div class="footer-grid">
            <div>
                <h4>{{ config('app.SMKN 1 Katapang', 'SMKN 1 Katapang') }}</h4>
                <p>Membangun generasi unggul, berkarakter, dan siap menghadapi masa depan.</p>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-7.5h2.5l.4-3H13.5V8.5c0-.9.2-1.5 1.6-1.5H16.5V4.3c-.3 0-1.2-.1-2.3-.1-2.3 0-3.9 1.4-3.9 4v2.3H8v3h2.3V21h3.2z"/></svg></a>
                    <a href="#" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg></a>
                    <a href="#" aria-label="YouTube"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23 12s0-3.6-.5-5.3c-.3-1-1.1-1.8-2.1-2C18.5 4.2 12 4.2 12 4.2s-6.5 0-8.4.5c-1 .2-1.8 1-2.1 2C1 8.4 1 12 1 12s0 3.6.5 5.3c.3 1 1.1 1.8 2.1 2 1.9.5 8.4.5 8.4.5s6.5 0 8.4-.5c1-.2 1.8-1 2.1-2 .5-1.7.5-5.3.5-5.3zM9.8 15.5V8.5l6.4 3.5-6.4 3.5z"/></svg></a>
                </div>
            </div>

            <div>
                <h4>Link Cepat</h4>
                <a href="/">Beranda</a>
                <a href="#">Profil Sekolah</a>
                <a href="#">Jurusan</a>
                <a href="/guru">Guru</a>
                <a href="{{ route('news.index') }}">Berita</a>
                <a href="#">Kontak</a>
            </div>

            <div>
                <h4>Informasi</h4>
                <p>JL. Ceuri Ters Kopo Km. 13.5, Katapang, Kec. Katapang, Kab. Bandung, Jawa Barat.</p>
                <p>(022) 5893737</p>
                <p>info@sekolah.sch.id</p>
            </div>

            <div>
                <h4>Jam Operasional</h4>
                <p><strong>Senin - Jumat</strong><br>06.30 - 15.30 WIB</p>
                <p><strong>Sabtu</strong><br>07.00 - 12.00 WIB</p>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} {{ config('app.SMKN 1 Katapang', 'SMKN 1 Katapang') }}. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>
</html>