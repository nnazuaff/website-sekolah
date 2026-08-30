<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $major->name }} - {{ config('SMKN 1 Katapang', 'SMKN 1 Katapang') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue-900: #14265A; --blue-800: #1B3A8A; --blue-600: #2563EB;
            --blue-100: #DBEAFE; --gold: #F5A623; --paper: #F6F8FB;
            --card: #FFFFFF; --line: #E4E8EF; --ink: #12203D; --muted: #64748B;
        }

        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Inter', sans-serif; background: var(--paper); color: var(--ink); overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }

        /* ================= NAVBAR ================= */
        .navbar {
            display: flex; align-items: center; padding: 14px 40px;
            background: #fff; border-bottom: 1px solid var(--line);
            position: sticky; top: 0; z-index: 20;
        }
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand-icon { width: 44px; height: 44px; object-fit: contain; }
        .brand-text h1 { font-size: 15px; margin: 0; font-weight: 800; }
        .brand-text p { margin: 0; font-size: 11.5px; color: var(--muted); }

        /* ================= HERO ================= */
        .hero {
            background: linear-gradient(120deg, var(--blue-900), var(--blue-800));
            color: #fff;
            padding: 32px 40px 40px;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 32px;
            align-items: center;
        }

        .breadcrumb { font-size: 13px; color: #C7D2E8; margin-bottom: 18px; }
        .breadcrumb a { color: #fff; }

        .major-badge {
            display: inline-block;
            font-size: 12px; font-weight: 700;
            padding: 5px 14px; border-radius: 999px;
            background: var(--gold); color: var(--blue-900);
            margin-bottom: 14px;
        }

        .hero h1 { font-size: 32px; font-weight: 800; margin: 0 0 12px; line-height: 1.25; }
        .hero-desc { font-size: 14px; color: #C7D2E8; line-height: 1.7; max-width: 520px; margin: 0; }

        .hero-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 14px;
        }

        .hero-image-empty {
            width: 100%; height: 220px;
            border-radius: 14px;
            background: rgba(255,255,255,0.1);
        }

        /* ================= LAYOUT ================= */
        .wrap { max-width: 1200px; margin: 0 auto; padding: 40px 40px 80px; }

        .main-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 28px;
            align-items: start;
        }

        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13.5px; font-weight: 600; color: var(--blue-600);
            margin-bottom: 20px;
        }

        .content-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 28px;
        }

        .content-card h2 {
            font-size: 18px;
            font-weight: 800;
            margin: 0 0 18px;
        }

        .major-desc {
            font-size: 15px;
            line-height: 1.85;
            color: #33415A;
        }

        /* ================= SIDEBAR ================= */
        .sidebar-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 22px;
        }

        .sidebar-card h4 {
            font-size: 14.5px;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .sidebar-underline {
            width: 24px; height: 3px;
            background: var(--blue-600);
            border-radius: 2px;
            margin-bottom: 18px;
        }

        .info-row {
            display: flex;
            gap: 10px;
            padding: 12px 0;
            border-top: 1px solid var(--line);
        }

        .info-row:first-of-type { border-top: none; padding-top: 0; }

        .info-row .info-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--blue-100);
            color: var(--blue-800);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .info-row .info-label { font-size: 11px; color: var(--muted); margin-bottom: 2px; }
        .info-row .info-value { font-size: 13.5px; font-weight: 600; }

        @media (max-width: 900px) {
            .hero-inner { grid-template-columns: 1fr; }
            .main-layout { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .navbar { padding: 14px 20px; }
            .hero { padding: 24px 20px 32px; }
            .hero h1 { font-size: 24px; }
            .wrap { padding: 28px 16px 56px; }
            .content-card { padding: 18px; }
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
        <div class="hero-inner">
            <div>
                <div class="breadcrumb">
                    <a href="/">Beranda</a> / <a href="{{ route('public.majors.index') }}">Jurusan</a> / {{ $major->name }}
                </div>

                <span class="major-badge">{{ $major->short_name }}</span>

                <h1>{{ $major->name }}</h1>
                <p class="hero-desc">{{ Str::limit($major->description, 160) }}</p>
            </div>

            @if ($major->image)
                <img src="{{ asset('storage/' . $major->image) }}" alt="{{ $major->name }}" class="hero-image">
            @else
                <div class="hero-image-empty"></div>
            @endif
        </div>
    </section>

    <div class="wrap">
        <div class="main-layout">

            <div>
                <a href="{{ route('public.majors.index') }}" class="back-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Kembali ke Jurusan
                </a>

                <div class="content-card">
                    <h2>Tentang Jurusan</h2>
                    <div class="major-desc">{{ $major->description }}</div>
                </div>
            </div>

            <aside class="sidebar-card">
                <h4>Informasi Jurusan</h4>
                <div class="sidebar-underline"></div>

                <div class="info-row">
                    <div class="info-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.1 2.7 2 6 2s6-.9 6-2v-5"/></svg>
                    </div>
                    <div>
                        <div class="info-label">Nama Jurusan</div>
                        <div class="info-value">{{ $major->name }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <div>
                        <div class="info-label">Kode Jurusan</div>
                        <div class="info-value">{{ $major->short_name }}</div>
                    </div>
                </div>
            </aside>

        </div>
    </div>

</body>
</html>