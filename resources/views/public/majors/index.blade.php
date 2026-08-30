<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusan - {{ config('app.SMKN 1 Katapang', 'SMkN 1 Katapang') }}</title>

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

        /* ================= WRAP ================= */
        .wrap { max-width: 1200px; margin: 0 auto; padding: 32px 40px 80px; }

        /* ================= SECTION HEADER ================= */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .section-header h3 {
            font-size: 22px;
            font-weight: 800;
            margin: 0 0 6px;
        }

        .section-underline {
            width: 32px;
            height: 4px;
            background: var(--blue-600);
            border-radius: 2px;
            margin-bottom: 10px;
        }

        .section-header p {
            font-size: 13.5px;
            color: var(--muted);
            margin: 0;
            max-width: 420px;
        }

        /* ================= STATS ================= */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-box {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-box .icon-circle {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .stat-box .stat-value { font-size: 19px; font-weight: 800; line-height: 1.2; }
        .stat-box .stat-label { font-size: 12px; color: var(--muted); }

        /* ================= MAJOR GRID & CARD ================= */
        .majors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 22px;
            margin-bottom: 40px;
        }

        .major-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            overflow: hidden;
        }

        .major-thumb { width: 100%; height: 160px; object-fit: cover; display: block; }
        .major-thumb-empty { background: var(--blue-100); }

        .major-body { padding: 18px; }

        .major-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .icon-circle svg { flex-shrink: 0; }

        .major-body h3 { font-size: 16px; font-weight: 700; margin: 0; line-height: 1.35; }

        .major-desc {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            margin: 0 0 16px;
        }

        .major-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .major-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 999px;
            color: #fff;
        }

        .major-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--blue-600);
        }

        /* ================= CTA BANNER ================= */
        .cta-banner {
            background: var(--blue-100);
            border-radius: 16px;
            padding: 28px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
        }

        .cta-text h4 { font-size: 17px; font-weight: 800; margin: 0 0 8px; }
        .cta-text p { font-size: 13.5px; color: var(--muted); margin: 0; max-width: 480px; }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--blue-600);
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 22px;
            border-radius: 10px;
            white-space: nowrap;
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

        /* ================= FOOTER ================= */
        .site-footer { background: #F1F4F9; border-top: 1px solid var(--line); padding-top: 48px; }

        .footer-grid {
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 1.4fr 1fr 1fr 1fr;
            gap: 32px; padding: 0 40px 32px;
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
            .stats-row { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .navbar, .hero, .wrap, .footer-grid, .footer-bottom { padding-left: 20px; padding-right: 20px; }
            .hero h2 { font-size: 28px; }
            .hero-top { flex-direction: column; align-items: flex-start; gap: 16px; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 28px 20px; }
            .cta-banner { flex-direction: column; align-items: flex-start; }
        }

        @media (max-width: 480px) {
            .brand-text p { display: none; }
            .hero { padding: 32px 16px 28px; }
            .hero h2 { font-size: 24px; }
            .wrap { padding: 24px 16px 56px; }
            .stats-row { grid-template-columns: 1fr 1fr; }
            .majors-grid { grid-template-columns: 1fr; }
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
                <h2>Jurusan Kami</h2>
                <div class="hero-underline"></div>
                <p>Berbagai pilihan jurusan unggulan yang dirancang untuk menyiapkan siswa menjadi profesional muda.</p>
            </div>
            <div class="breadcrumb"><a href="/">Beranda</a> / Jurusan</div>
        </div>
    </section>

    <div class="wrap">

        <div class="section-header">
            <div>
                <h3>Jurusan Unggulan</h3>
                <div class="section-underline"></div>
                <p>{{ config('app.SMKN 1 Katapang', 'SMKN 1 Katapang') }} memiliki berbagai jurusan yang siap mengantarkan siswa meraih masa depan cerah.</p>
            </div>
        </div>

        {{-- ================= STATS (sebagian hardcode) ================= --}}
        <div class="stats-row">
            <div class="stat-box">
                <div class="icon-circle" style="background: #DBEAFE;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1B3A8A" stroke-width="2"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.1 2.7 2 6 2s6-.9 6-2v-5"/></svg>
                </div>
                <div>
                    <div class="stat-value">{{ $majors->count() }}</div>
                    <div class="stat-label">Jurusan</div>
                </div>
            </div>

            <div class="stat-box">
                <div class="icon-circle" style="background: #DCFCE7;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#15803D" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <div class="stat-value">412</div>
                    <div class="stat-label">Siswa Aktif</div>
                </div>
            </div>

            <div class="stat-box">
                <div class="icon-circle" style="background: #FEF3C7;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#B45309" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div>
                    <div class="stat-value">48</div>
                    <div class="stat-label">Guru Kompeten</div>
                </div>
            </div>

            <div class="stat-box">
                <div class="icon-circle" style="background: #EDE9FE;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6D28D9" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 21v-6h6v6"/></svg>
                </div>
                <div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Ruang Praktik</div>
                </div>
            </div>
        </div>

        {{-- ================= GRID JURUSAN ================= --}}
        <div class="majors-grid">

            @php
                $palette = ['#2563EB', '#16A34A', '#EA580C', '#DB2777', '#0891B2', '#7C3AED'];
            @endphp

            @forelse ($majors as $major)
                @php
                    $color = $palette[ord(strtoupper($major->name)[0]) % count($palette)];
                @endphp

                <div class="major-card">
                    @if ($major->image)
                        <img src="{{ asset('storage/' . $major->image) }}" alt="{{ $major->name }}" class="major-thumb">
                    @else
                        <div class="major-thumb major-thumb-empty"></div>
                    @endif

                    <div class="major-body">
                        <div class="major-head">
                            <div class="icon-circle" style="background: {{ $color }};">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.1 2.7 2 6 2s6-.9 6-2v-5"/></svg>
                            </div>
                            <h3>{{ $major->name }}</h3>
                        </div>

                        <p class="major-desc">{{ Str::limit($major->description, 100) }}</p>

                        <div class="major-footer">
                            <span class="major-badge" style="background: {{ $color }};">{{ $major->short_name }}</span>

                            <a href="{{ route('public.majors.show', $major->slug) }}" class="major-link">
                                Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            @empty

                <div class="empty-state">Belum ada data jurusan aktif.</div>

            @endforelse

        </div>

        {{-- ================= CTA BANNER ================= --}}
        <div class="cta-banner">
            <div class="cta-text">
                <h4>Belum tahu jurusan yang tepat untukmu?</h4>
                <p>Konsultasikan minat dan bakatmu bersama guru BK kami untuk mendapatkan rekomendasi jurusan yang sesuai dengan potensi dirimu.</p>
            </div>

            <a href="#" class="cta-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Konsultasi Sekarang
            </a>
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
                <a href="{{ route('public.majors.index') }}">Jurusan</a>
                <a href="/guru">Guru</a>
                <a href="#">Berita</a>
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

</body>
</html>