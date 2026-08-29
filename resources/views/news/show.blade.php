<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - {{ config('app.SMKN 1 Katapang', 'SMKN 1 Katapang') }}</title>

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

        /* ================= HERO / BREADCRUMB ================= */
        .hero {
            background: linear-gradient(120deg, var(--blue-900), var(--blue-800));
            color: #fff;
            padding: 24px 40px;
        }

        .breadcrumb {
            max-width: 1200px;
            margin: 0 auto;
            font-size: 13px;
            color: #C7D2E8;
        }

        .breadcrumb a { color: #fff; }

        /* ================= LAYOUT ================= */
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

        /* ================= ARTICLE ================= */
        .article-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 28px;
        }

        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13.5px; font-weight: 600; color: var(--blue-600);
            margin-bottom: 20px;
        }

        .article-title {
            font-size: 28px; font-weight: 800; line-height: 1.3; margin: 0 0 14px;
        }

        .article-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 22px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--line);
        }

        .article-date {
            display: flex; align-items: center; gap: 6px;
            font-size: 13px; color: var(--muted);
        }

        .share-buttons { display: flex; align-items: center; gap: 8px; }

        .share-label { font-size: 12.5px; color: var(--muted); margin-right: 4px; }

        .share-buttons a {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            background: var(--blue-100); color: var(--blue-800);
        }

        .article-thumb {
            width: 100%; height: 340px; object-fit: cover;
            border-radius: 12px; margin-bottom: 24px;
        }

        .article-body {
            font-size: 15.5px; line-height: 1.85; color: #33415A;
        }

        .article-body img { max-width: 100%; border-radius: 12px; }
        .article-body p { margin: 0 0 18px; }

        /* ================= PREV/NEXT NAV ================= */
        .article-nav {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 28px;
        }

        .nav-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 16px 18px;
        }

        .nav-card.next { text-align: right; }

        .nav-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .nav-card.next .nav-label { justify-content: flex-end; }

        .nav-title {
            font-size: 13.5px;
            font-weight: 700;
            line-height: 1.4;
        }

        /* ================= SIDEBAR ================= */
        .sidebar-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 20px;
        }

        .sidebar-card h4 { font-size: 14.5px; font-weight: 700; margin: 0 0 16px; }

        .latest-item { display: flex; gap: 12px; padding: 12px 0; border-top: 1px solid var(--line); }
        .latest-item:first-of-type { border-top: none; padding-top: 0; }

        .latest-thumb { width: 56px; height: 56px; border-radius: 8px; object-fit: cover; flex-shrink: 0; }
        .latest-thumb-empty { background: var(--blue-100); }

        .latest-info h5 { font-size: 12.5px; font-weight: 600; margin: 0 0 4px; line-height: 1.4; }
        .latest-info p { font-size: 11px; color: var(--muted); margin: 0; }

        @media (max-width: 900px) {
            .main-layout { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .navbar, .hero, .wrap { padding-left: 20px; padding-right: 20px; }
            .article-nav { grid-template-columns: 1fr; }
            .nav-card.next { text-align: left; }
            .nav-card.next .nav-label { justify-content: flex-start; }
        }

        @media (max-width: 480px) {
            .brand-text p { display: none; }
            .wrap { padding: 24px 16px 56px; }
            .article-card { padding: 18px; }
            .article-title { font-size: 22px; }
            .article-thumb { height: 200px; }
            .article-meta { flex-direction: column; align-items: flex-start; }
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
        <div class="breadcrumb">
            <a href="/">Beranda</a> / <a href="{{ route('news.index') }}">Berita</a> / {{ Str::limit($article->title, 500) }}
        </div>
    </section>

    <div class="wrap">
        <div class="main-layout">

            <div>
                <div class="article-card">
                    <a href="{{ route('news.index') }}" class="back-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali ke Berita
                    </a>

                    <h1 class="article-title">{{ $article->title }}</h1>

                    <div class="article-meta">
                        <div class="article-date">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ optional($article->published_at)->translatedFormat('d F Y') }}
                        </div>

                        <div class="share-buttons">
                            <span class="share-label">Bagikan:</span>

                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Bagikan ke Facebook">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-7.5h2.5l.4-3H13.5V8.5c0-.9.2-1.5 1.6-1.5H16.5V4.3c-.3 0-1.2-.1-2.3-.1-2.3 0-3.9 1.4-3.9 4v2.3H8v3h2.3V21h3.2z"/></svg>
                            </a>

                            <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15L2 22l5.2-1.4A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1 1 12 20zm4.4-6c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.5.1-.2.2-.6.8-.8 1-.1.2-.3.2-.5.1-.2-.1-1-.4-1.9-1.2-.7-.6-1.2-1.4-1.3-1.6-.1-.2 0-.3.1-.4l.4-.5c.1-.1.1-.3.2-.4 0-.1 0-.3 0-.4l-.7-1.6c-.2-.4-.4-.4-.5-.4h-.5c-.2 0-.4.1-.6.3-.2.2-.8.8-.8 1.9s.8 2.2 1 2.4c.1.1 1.7 2.6 4.1 3.6.6.2 1 .4 1.4.5.6.2 1.1.2 1.5.1.5-.1 1.4-.6 1.6-1.1.2-.5.2-1 .1-1.1-.1-.1-.2-.1-.4-.2z"/></svg>
                            </a>

                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener" aria-label="Bagikan ke Twitter">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.9c-.7.3-1.5.6-2.3.7.8-.5 1.4-1.3 1.7-2.3-.8.5-1.7.8-2.6 1a4.1 4.1 0 0 0-7 3.7 11.6 11.6 0 0 1-8.4-4.3 4.1 4.1 0 0 0 1.3 5.5c-.7 0-1.3-.2-1.9-.5v.1c0 2 1.4 3.6 3.3 4a4.1 4.1 0 0 1-1.9.1 4.1 4.1 0 0 0 3.8 2.9A8.3 8.3 0 0 1 2 19.6a11.6 11.6 0 0 0 6.3 1.8c7.5 0 11.7-6.3 11.7-11.7v-.5c.8-.6 1.5-1.3 2-2.1z"/></svg>
                            </a>
                        </div>
                    </div>

                    @if ($article->thumbnail)
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="article-thumb">
                    @endif

                    <article class="article-body">
                        {!! $article->content !!}
                    </article>
                </div>

                <div class="article-nav">
                    @if ($previous)
                        <a href="{{ route('news.show', $previous->slug) }}" class="nav-card">
                            <div class="nav-label">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                                Artikel Sebelumnya
                            </div>
                            <div class="nav-title">{{ Str::limit($previous->title, 60) }}</div>
                        </a>
                    @else
                        <div></div>
                    @endif

                    @if ($next)
                        <a href="{{ route('news.show', $next->slug) }}" class="nav-card next">
                            <div class="nav-label">
                                Artikel Selanjutnya
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </div>
                            <div class="nav-title">{{ Str::limit($next->title, 60) }}</div>
                        </a>
                    @endif
                </div>
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
                    <p style="font-size: 13px; color: var(--muted);">Belum ada berita lain.</p>
                @endforelse
            </aside>

        </div>
    </div>

</body>
</html>