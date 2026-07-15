<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebGIS & Profil Dusun Dimajar 2</title>

    <link rel="preload" as="image" href="{{ asset('images/bg-landingpage.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root {
            --primary: #059669;        /* Emerald 600 */
            --primary-dark: #047857;   /* Emerald 700 */
            --primary-light: #D1FAE5;  /* Emerald 100 */
            --primary-glow: rgba(5, 150, 105, 0.35);
            --primary-gradient: linear-gradient(135deg, #059669 0%, #10B981 100%);
            --secondary: #1E293B;      /* Slate 800 */
            --bg-page: #FFFFFF;
            --bg-alt: #F8FAFC;         /* Slate 50 */
            --text-main: #334155;      /* Slate 700 */
            --text-mute: #64748B;      /* Slate 500 */
            --border-color: #E2E8F0;
            --glass-bg: rgba(255, 255, 255, 0.65);
            --glass-border: rgba(255, 255, 255, 0.85);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            background-color: var(--bg-page);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--secondary);
            font-weight: 700;
        }

        /* Anchor jumps land below the fixed floating navbar instead of underneath it */
        [id] { scroll-margin-top: 110px; }

        /* --- ANIMASI KEYFRAMES --- */
        @keyframes floatAnim { 0% { transform: translateY(0px); } 50% { transform: translateY(-12px); } 100% { transform: translateY(0px); } }
        .floating-element { animation: floatAnim 6s ease-in-out infinite; }
        @keyframes pulseGlow { 0% { box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.4); } 70% { box-shadow: 0 0 0 15px rgba(5, 150, 105, 0); } 100% { box-shadow: 0 0 0 0 rgba(5, 150, 105, 0); } }

        /* --- 1. FLOATING PILL NAVBAR --- */
        .navbar-wrapper { position: absolute; top: 24px; left: 0; width: 100%; z-index: 1050; display: flex; justify-content: center; padding: 0 20px; }
        .navbar-pill {
            background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(255,255,255,0.75));
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            padding: 10px 24px; border-radius: 50px;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.1), inset 0 0 0 1px rgba(255,255,255,0.5);
            display: flex; align-items: center; gap: 30px; transition: all 0.4s ease;
        }
        .navbar-pill.scrolled { position: fixed; top: 15px; background: rgba(255, 255, 255, 0.98); box-shadow: 0 20px 40px -10px rgba(0,0,0,0.15); }
        .nav-brand { font-weight: 800; font-size: 1.25rem; color: var(--secondary); text-decoration: none; }
        .nav-links { display: flex; gap: 20px; align-items: center; margin: 0; padding: 0; list-style: none; }
        .nav-links a { color: var(--text-main); text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: color 0.3s; }
        .nav-links a:hover { color: var(--primary); }
        .btn-nav { background: var(--primary-gradient); color: white !important; padding: 8px 22px; border-radius: 50px; transition: all 0.3s; font-weight: 600; box-shadow: 0 4px 15px var(--primary-glow); border: none; }
        .btn-nav:hover { transform: translateY(-2px); box-shadow: 0 8px 25px var(--primary-glow); }

        /* --- 2. HERO SECTION --- */
        .hero-section {
            position: relative; min-height: 100vh; display: flex; align-items: center; justify-content: center;
            text-align: center; padding: 120px 20px 60px 20px;
            background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(255,255,255,0.4) 60%, var(--bg-page) 100%),
                        url('{{ asset("images/bg-landingpage.png") }}') center/cover no-repeat fixed;
        }
        .hero-content { max-width: 850px; z-index: 2; margin-top: 40px; }
        .hero-pill { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(255,255,255,0.7)); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(10px); padding: 8px 20px; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .hero-title { font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 800; letter-spacing: -0.02em; margin-bottom: 20px; text-shadow: 0 4px 20px rgba(255,255,255,0.9); }
        .hero-title span { background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-lead { font-size: 1.15rem; font-weight: 500; color: #1E293B; line-height: 1.7; margin-bottom: 30px; text-shadow: 0 2px 10px rgba(255,255,255,1); }
        .btn-hero { background: var(--primary-gradient); color: white; padding: 14px 36px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 10px 25px var(--primary-glow); border: 2px solid transparent; }
        .btn-hero:hover { transform: translateY(-4px); box-shadow: 0 15px 35px var(--primary-glow); color: white; border-color: rgba(255,255,255,0.5); }

        /* --- 3. SEKILAS --- */
        .section-padding { padding: 100px 0; }
        .section-badge { display: inline-block; background: var(--primary-light); color: var(--primary-dark); padding: 6px 16px; border-radius: 50px; font-size: 0.85rem; font-weight: 700; margin-bottom: 16px; }
        .section-title { font-weight: 800; font-size: 2.2rem; margin-bottom: 20px; }
        .section-title span { color: var(--primary); }
        .about-image-wrapper { background: linear-gradient(135deg, rgba(255,255,255,1) 0%, rgba(241, 245, 249, 0.8) 100%); border-radius: 30px; padding: 10px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1); min-height: 380px; display: flex; align-items: center; justify-content: center; border: 2px solid white; position: relative; }
        .about-image-wrapper::before { content: ''; position: absolute; inset: -2px; border-radius: 32px; background: linear-gradient(135deg, var(--primary), transparent); z-index: -1; opacity: 0.3; }

        /* --- 4. INFOGRAFIS --- */
        .info-card { background: linear-gradient(145deg, #ffffff 0%, #F0FDF4 100%); border: 1px solid rgba(255,255,255,1); border-radius: 24px; padding: 30px 20px; text-align: center; height: 100%; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05); position: relative; }
        .info-card::after { content: ''; position: absolute; inset: 0; border-radius: 24px; box-shadow: 0 20px 40px rgba(5, 150, 105, 0.2); opacity: 0; transition: opacity 0.4s; z-index: -1; }
        .info-card:hover { transform: translateY(-10px) scale(1.02); border-color: var(--primary-light); }
        .info-card:hover::after { opacity: 1; }
        .info-icon { width: 70px; height: 70px; margin: 0 auto 20px auto; border-radius: 20px; background: linear-gradient(135deg, var(--primary-light) 0%, #ffffff 100%); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; box-shadow: 0 10px 20px -5px rgba(5, 150, 105, 0.2); }
        .info-val { font-size: 2.2rem; font-weight: 800; color: var(--secondary); margin-bottom: 5px; }
        .info-label { font-weight: 600; color: var(--primary-dark); margin-bottom: 8px; font-size: 1.05rem; }
        .info-desc { font-size: 0.85rem; color: var(--text-mute); margin: 0; line-height: 1.6; }

        /* --- 5. TIMELINE --- */
        .timeline-container { position: relative; max-width: 800px; margin: 0 auto; padding-left: 30px; border-left: 3px solid var(--primary-light); }
        .timeline-item { position: relative; margin-bottom: 40px; }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-dot { position: absolute; left: -40px; top: 0; width: 18px; height: 18px; background: var(--primary); border: 4px solid white; border-radius: 50%; animation: pulseGlow 2s infinite; }
        .timeline-content { background: linear-gradient(145deg, #ffffff 0%, #F8FAFC 100%); border: 1px solid var(--border-color); border-radius: 20px; padding: 24px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.02); }
        .timeline-content:hover { transform: translateX(10px) translateY(-5px); box-shadow: 0 20px 40px -10px rgba(5, 150, 105, 0.15); border-color: var(--primary-light); }
        .timeline-date { color: var(--primary-dark); font-weight: 700; font-size: 0.9rem; margin-bottom: 8px; }
        .timeline-title { font-weight: 700; font-size: 1.2rem; margin-bottom: 12px; }

        /* =====================================================================
           6. KONSOL PETA — dibangun ulang
           ===================================================================== */
        .map-console-wrapper {
            background: linear-gradient(180deg, #ffffff 0%, var(--bg-alt) 100%);
            border-radius: 32px; padding: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 30px 60px -15px rgba(0,0,0,0.1), 0 0 0 8px rgba(255,255,255,0.5);
        }

        .map-console-toolbar { display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; padding: 4px 8px 16px 8px; }

        .btn-panel-toggle {
            background: var(--primary-gradient); color: #fff; border: none; padding: 10px 20px;
            border-radius: 50px; font-weight: 600; font-size: 0.85rem;
            display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 8px 20px var(--primary-glow);
        }
        .active-layer-count { background: rgba(255,255,255,0.25); padding: 1px 8px; border-radius: 50px; font-size: 0.75rem; }

        .map-console-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
        @media (min-width: 992px) { .map-console-grid { grid-template-columns: 1fr 360px; align-items: start; } }

        /* --- Peta --- */
        .map-shell { position: relative; border-radius: 24px; overflow: hidden; border: 1px solid var(--border-color); }
        #map { width: 100%; height: min(65vh, 560px); min-height: 420px; background: #E2E8F0; z-index: 1; }
        @media (max-width: 767px) { #map { height: 52vh; min-height: 360px; } }

        .map-readout {
            position: absolute; left: 14px; bottom: 14px; z-index: 700;
            background: var(--glass-bg); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border); padding: 6px 14px; border-radius: 50px;
            font-size: 0.72rem; font-weight: 600; color: var(--secondary); font-family: monospace;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        .map-epsg-badge {
            position: absolute; right: 14px; bottom: 14px; z-index: 700;
            background: rgba(255,255,255,0.85); backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border); padding: 6px 12px; border-radius: 50px;
            font-size: 0.7rem; font-weight: 700; color: var(--text-mute); box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        /*
         * FIX KONFLIK BOOTSTRAP <-> LEAFLET
         * Bootstrap mereset elemen <img> global menjadi max-width:100%; height:auto;
         * Ubin (tile) peta Leaflet adalah elemen <img>, jadi ikut "diperkecil" dan tampak pecah/geser.
         * Bootstrap juga mereset elemen <a> (warna biru + underline) yang ikut memengaruhi tombol zoom Leaflet.
         * Kedua override di bawah ini WAJIB ada, dan harus discope ke .leaflet-container agar
         * tidak balik mengubah gaya <img>/<a> di bagian lain halaman.
         */
        .leaflet-container img { max-width: none !important; }
        .leaflet-container a { text-decoration: none !important; }
        .leaflet-container { font-family: 'Inter', sans-serif; }

        /* Restyle kontrol bawaan Leaflet tanpa menyentuh class posisi (leaflet-top/bottom/left/right) */
        .leaflet-bar { border: none !important; border-radius: 14px !important; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; }
        .leaflet-bar a { background: rgba(255,255,255,0.92) !important; color: var(--secondary) !important; width: 34px !important; height: 34px !important; line-height: 34px !important; }
        .leaflet-bar a:hover { background: var(--primary-light) !important; color: var(--primary-dark) !important; }
        .leaflet-control-attribution { background: rgba(255,255,255,0.8) !important; backdrop-filter: blur(6px); border-radius: 8px 0 0 0 !important; font-size: 0.68rem !important; }

        /* --- Panel Kontrol (glassmorphism) --- */
        .control-panel {
            background: var(--glass-bg); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border); border-radius: 24px; padding: 18px;
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.08);
            display: flex; flex-direction: column; gap: 14px;
        }

        .panel-tabs { display: flex; gap: 4px; background: var(--bg-alt); padding: 4px; border-radius: 50px; }
        .panel-tab-btn { flex: 1; border: none; background: transparent; padding: 8px 10px; border-radius: 50px; font-size: 0.78rem; font-weight: 700; color: var(--text-mute); cursor: pointer; transition: all .25s; }
        .panel-tab-btn.active { background: #fff; color: var(--primary-dark); box-shadow: 0 6px 14px rgba(0,0,0,0.08); }

        .panel-pane { max-height: 480px; overflow-y: auto; }
        .panel-pane.d-none { display: none !important; }

        .layer-item { display: flex; align-items: center; justify-content: space-between; gap: 10px; background: #fff; border: 1px solid var(--border-color); border-radius: 16px; padding: 10px 14px; margin-bottom: 8px; }
        .layer-item:last-child { margin-bottom: 0; }
        .layer-label { display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 0.86rem; color: var(--secondary); }
        .layer-dot { width: 12px; height: 12px; border-radius: 50%; flex-shrink: 0; box-shadow: 0 0 0 3px rgba(0,0,0,0.04); }

        .form-switch .form-check-input { width: 38px; height: 20px; cursor: pointer; }
        .form-switch .form-check-input:checked { background-color: var(--primary); border-color: var(--primary); }
        .form-switch .form-check-input:focus { box-shadow: 0 0 0 0.2rem var(--primary-glow); border-color: var(--primary); }

        .quick-actions { display: flex; gap: 8px; }
        .btn-quick { flex: 1; background: var(--bg-alt); border: 1px solid var(--border-color); color: var(--text-main); font-size: 0.72rem; font-weight: 700; padding: 7px 10px; border-radius: 50px; }
        .btn-quick:hover { background: var(--primary-light); color: var(--primary-dark); border-color: var(--primary-light); }

        .legend-divider { border-top: 1px dashed #CBD5E1; margin: 4px 0 10px 0; }
        .legend-block { margin-bottom: 14px; }
        .legend-block:last-child { margin-bottom: 0; }
        .legend-heading { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.04em; color: var(--text-mute); margin-bottom: 8px; }
        .legend-row { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: var(--text-main); margin-bottom: 6px; }
        .legend-row:last-child { margin-bottom: 0; }
        .legend-swatch { width: 14px; height: 14px; border-radius: 4px; flex-shrink: 0; }
        .legend-swatch.round { border-radius: 50%; }
        .legend-swatch.line { width: 20px; height: 3px; border-radius: 2px; margin-top: 1px; }

        .panel-empty { font-size: 0.82rem; color: var(--text-mute); text-align: center; padding: 24px 10px; }

        .attr-box { background: #fff; padding: 12px; border-radius: 12px; margin-bottom: 10px; border: 1px solid var(--border-color); box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .attr-box:last-child { margin-bottom: 0; }
        .attr-label { font-size: 0.72rem; color: var(--text-mute); font-weight: 600; display: block; margin-bottom: 4px; }
        .attr-val { font-size: 1rem; font-weight: 700; color: var(--secondary); }

        /* --- FOOTER --- */
        footer { background: var(--secondary); color: white; padding: 60px 0 20px 0; }
        .footer-brand { font-size: 1.4rem; font-weight: 800; color: white; text-decoration: none; display: inline-block; margin-bottom: 16px; }
        .footer-text { color: #94A3B8; font-size: 0.95rem; line-height: 1.6; }

        @media (max-width: 991px) {
            .navbar-pill { width: 90%; justify-content: space-between; padding: 10px 20px; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

    <div class="navbar-wrapper">
        <nav class="navbar-pill" id="mainNav">
            <a href="#beranda" class="nav-brand"><i class="fa-solid fa-leaf text-success me-2"></i>Dimajar 2</a>
            <ul class="nav-links d-none d-lg-flex">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#sekilas">Sekilas</a></li>
                <li><a href="#infografis">Infografis</a></li>
                <li><a href="#sejarah">Sejarah</a></li>
            </ul>
            <a href="#peta" class="btn-nav text-decoration-none">Peta Interaktif</a>
        </nav>
    </div>

    <header id="beranda" class="hero-section">
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <div class="hero-pill floating-element"><i class="fa-solid fa-location-dot"></i> SUMBERARUM, TEMPURAN</div>
            <h1 class="hero-title">Selamat Datang di<br><span>Dusun Dimajar 2</span></h1>
            <p class="hero-lead">Sebuah dusun asri di Kelurahan Sumberarum. Temukan potensi lokal, keragaman demografi, dan infrastruktur wilayah melalui eksplorasi pemetaan spasial interaktif kami yang modern.</p>
            <a href="#peta" class="btn-hero">Jelajahi Melalui Peta Interaktif <i class="fa-solid fa-paper-plane ms-1"></i></a>
        </div>
    </header>

    <section id="sekilas" class="section-padding bg-alt">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="section-badge"><i class="fa-solid fa-circle-info me-1"></i> Sekilas</span>
                    <h2 class="section-title">Tentang Dusun <span>Dimajar 2</span></h2>
                    <p class="mb-4" style="line-height: 1.7; font-size: 1.05rem;">Dusun Dimajar 2 merupakan wilayah pedesaan yang secara administratif terletak di Desa Sumberarum, Kecamatan Tempuran, Kabupaten Magelang. Wilayah ini terus berkembang dengan tetap mempertahankan nilai-nilai kearifan lokal dan kelestarian alamnya.</p>
                    <p style="line-height: 1.7; font-size: 1.05rem;">Melalui inisiatif digitalisasi ini, kami mendata secara spasial kondisi infrastruktur seperti daya listrik, jenis lantai bangunan, hingga kepadatan penduduk untuk mendukung pembangunan dusun yang terukur dan tepat sasaran.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-image-wrapper text-muted floating-element">
                        <div class="text-center">
                            <i class="fa-solid fa-map-location-dot fs-1 mb-3 text-success"></i>
                            <p class="mb-0 fw-semibold">Area untuk Gambar/Peta Citra Udara<br><small class="text-muted">(Data menyusul)</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="infografis" class="section-padding">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-badge"><i class="fa-solid fa-chart-pie me-1"></i> Infografis</span>
                <h2 class="section-title">Dimajar 2 <span>Dalam Angka</span></h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Potret karakteristik fisik dan sosial kemasyarakatan Dusun Dimajar 2 yang tercatat dalam pendataan spasial terbaru.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="info-card"><div class="info-icon"><i class="fa-solid fa-house-chimney"></i></div><div class="info-val" id="statBangunan">0</div><div class="info-label">Jumlah Bangunan</div><p class="info-desc">Meliputi rumah warga dan fasilitas fisik lainnya.</p></div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card"><div class="info-icon"><i class="fa-solid fa-users"></i></div><div class="info-val">4</div><div class="info-label">Rukun Tetangga (RT)</div><p class="info-desc">Terbagi dalam 4 wilayah satuan administratif terkecil.</p></div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card"><div class="info-icon"><i class="fa-solid fa-briefcase"></i></div><div class="info-val">Data</div><div class="info-label">Mata Pencaharian</div><p class="info-desc">Didominasi oleh sektor agraris dan swasta lokal.</p></div>
                </div>
                <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="info-card"><div class="info-icon"><i class="fa-solid fa-layer-group"></i></div><div class="info-val">5</div><div class="info-label">Tema Peta Spasial</div><p class="info-desc">Pekerjaan, Listrik, Topografi, Kepadatan RT, dan Lantai.</p></div>
                </div>
            </div>
        </div>
    </section>

    <section id="sejarah" class="section-padding bg-alt">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-badge"><i class="fa-solid fa-clock-rotate-left me-1"></i> Sejarah & Potensi</span>
                <h2 class="section-title">Jejak Langkah <span>Dimajar 2</span></h2>
            </div>
            <div class="timeline-container">
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content"><div class="timeline-date">Masa Perkembangan</div><h4 class="timeline-title">Fokus Infrastruktur & Tata Ruang</h4><p class="text-muted mb-0">Dusun Dimajar 2 terus berbenah dalam memetakan infrastruktur kelistrikan dan standar bangunan warganya sebagai bagian dari upaya peningkatan kesejahteraan hidup dan rumah layak huni.</p></div>
                </div>
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content"><div class="timeline-date">Kondisi Alam & Sosial</div><h4 class="timeline-title">Geografi dan Kependudukan</h4><p class="text-muted mb-0">Dengan topografi yang khas, wilayah ini mengatur kepadatan penduduknya melalui pembagian wilayah RT yang rapi, menjaga keseimbangan antara aktivitas ekonomi dan kelestarian lingkungan.</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================================
         KONSOL PETA TEMATIK INTERAKTIF
         ===================================================================== -->
    <section id="peta" class="section-padding">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-badge"><i class="fa-solid fa-earth-asia me-1"></i> Pemetaan Digital</span>
                <h2 class="section-title">Peta Tematik <span>Interaktif</span></h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Aktifkan satu atau beberapa layer sekaligus, lalu klik objek di peta untuk melihat detail atributnya.</p>
            </div>

            <div class="map-console-wrapper" data-aos="zoom-in" data-aos-duration="800">
                <div class="map-console-toolbar">
                    <h5 class="font-heading mb-0"><i class="fa-solid fa-map-location-dot text-success me-2"></i>Peta Tematik Dusun</h5>
                    <button class="btn-panel-toggle d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#controlPanelCollapse">
                        <i class="fa-solid fa-sliders"></i> Kontrol Layer
                        <span class="active-layer-count" id="activeCountBadge">2</span>
                    </button>
                </div>

                <div class="map-console-grid">
                    <!-- PETA -->
                    <div class="map-shell">
                        <div id="map"></div>
                        <div class="map-readout" id="readCoord">LAT: -7.79560 | LON: 110.36950</div>
                        <div class="map-epsg-badge">EPSG:4326</div>
                    </div>

                    <!-- PANEL KONTROL (collapse otomatis di layar < lg, selalu terbuka di layar >= lg) -->
                    <div class="collapse d-lg-block" id="controlPanelCollapse">
                        <div class="control-panel">
                            <div class="panel-tabs">
                                <button class="panel-tab-btn active" data-tab="layer" onclick="showPanelTab('layer')">Layer & Legenda</button>
                                <button class="panel-tab-btn" data-tab="objek" onclick="showPanelTab('objek')">Detail Objek</button>
                            </div>

                            <!-- TAB 1: LAYER TOGGLE + LEGEND -->
                            <div class="panel-pane" data-pane="layer" id="paneLayer">
                                <div class="quick-actions mb-3">
                                    <button type="button" class="btn-quick" onclick="setAllLayers(true)">Aktifkan Semua</button>
                                    <button type="button" class="btn-quick" onclick="setAllLayers(false)">Matikan Semua</button>
                                </div>

                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot" style="background:#059669"></span>Mata Pencaharian</span>
                                    <div class="form-check form-switch mb-0"><input class="form-check-input layer-toggle" type="checkbox" data-layer="pencaharian" id="chkPencaharian" checked></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot" style="background:#F59E0B"></span>Daya Listrik</span>
                                    <div class="form-check form-switch mb-0"><input class="form-check-input layer-toggle" type="checkbox" data-layer="listrik" id="chkListrik"></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot" style="background:#B45309"></span>Topografi Kontur</span>
                                    <div class="form-check form-switch mb-0"><input class="form-check-input layer-toggle" type="checkbox" data-layer="topografi" id="chkTopografi" checked></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot" style="background:#DC2626"></span>Kepadatan RT</span>
                                    <div class="form-check form-switch mb-0"><input class="form-check-input layer-toggle" type="checkbox" data-layer="kepadatan_rt" id="chkKepadatan"></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot" style="background:#0891B2"></span>Jenis Lantai (RTLH)</span>
                                    <div class="form-check form-switch mb-0"><input class="form-check-input layer-toggle" type="checkbox" data-layer="lantai" id="chkLantai"></div>
                                </div>

                                <div class="legend-divider"></div>
                                <div id="legendContainer"><p class="panel-empty">Legenda akan muncul di sini.</p></div>
                            </div>

                            <!-- TAB 2: DETAIL OBJEK (klik di peta) -->
                            <div class="panel-pane d-none" data-pane="objek" id="paneObjek">
                                <div id="objekContent">
                                    <p class="text-muted small mb-0">Silakan klik pada titik bangunan, garis kontur, atau wilayah RT di peta untuk melihat detail atribut lengkap.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <a href="#" class="footer-brand"><i class="fa-solid fa-leaf text-success me-2"></i>Dimajar 2</a>
                    <p class="footer-text">Sistem Pemetaan Geospasial Interaktif Dusun Dimajar 2, Desa Sumberarum, Kecamatan Tempuran, Kabupaten Magelang.</p>
                </div>
                <div class="col-lg-3">
                    <h5 class="text-white mb-3" style="font-size: 1.1rem; font-weight: 700;">Menu Cepat</h5>
                    <ul class="list-unstyled footer-text">
                        <li class="mb-2"><a href="#beranda" class="text-decoration-none text-reset">Beranda Depan</a></li>
                        <li class="mb-2"><a href="#sekilas" class="text-decoration-none text-reset">Sekilas Dusun</a></li>
                        <li class="mb-2"><a href="#infografis" class="text-decoration-none text-reset">Data Infografis</a></li>
                        <li class="mb-2"><a href="#peta" class="text-decoration-none text-reset">Konsol Peta Interaktif</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-3" style="font-size: 1.1rem; font-weight: 700;">Teknologi Spesifikasi</h5>
                    <p class="footer-text mb-1"><i class="fa-solid fa-database text-success me-2"></i> PostGIS / PostgreSQL Spatial</p>
                    <p class="footer-text mb-1"><i class="fa-brands fa-laravel text-danger me-2"></i> Laravel Framework PHP</p>
                    <p class="footer-text mb-0"><i class="fa-solid fa-map text-primary me-2"></i> Leaflet JS Mapping Engine</p>
                </div>
            </div>
            <div class="text-center mt-5 pt-4 border-top" style="border-color: rgba(255,255,255,0.1) !important; color: #64748B; font-size: 0.85rem;">
                &copy; 2026 Developed by <b class="text-white">Faiz Rizqi Adhitya Putra</b> | Universitas Gadjah Mada (UGM). Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        AOS.init({ once: true, offset: 50 });

        // Navbar melayang
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('mainNav');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        // ---------------------------------------------------------------
        // INISIALISASI PETA
        // ---------------------------------------------------------------
        var map = L.map('map', { center: [-7.7956, 110.3695], zoom: 16, zoomControl: false });
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        /*
         * FIX: tile Google sebelumnya memakai "http://" — di halaman Laravel yang
         * disajikan lewat HTTPS, permintaan http:// diblokir browser sebagai
         * "mixed content" sehingga peta tampak kosong/abu-abu. Diganti ke https://.
         * (Catatan: endpoint tile Google ini tidak resmi untuk produksi publik;
         * untuk deployment jangka panjang pertimbangkan Esri World Imagery atau
         * penyedia citra satelit berlisensi.)
         */
        var googleSat = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google'
        });
        googleSat.addTo(map);

        var readCoord = document.getElementById('readCoord');
        map.on('mousemove', function (e) {
            readCoord.textContent = `LAT: ${e.latlng.lat.toFixed(5)} | LON: ${e.latlng.lng.toFixed(5)}`;
        });

        var layerPencaharian = L.layerGroup().addTo(map);
        var layerListrik = L.layerGroup();
        var layerTopografi = L.layerGroup().addTo(map);
        var layerKepadatanRT = L.layerGroup();
        var layerLantai = L.layerGroup();

        var layerGroups = {
            pencaharian: layerPencaharian,
            listrik: layerListrik,
            topografi: layerTopografi,
            kepadatan_rt: layerKepadatanRT,
            lantai: layerLantai
        };

        // Konfigurasi legenda per layer — dipakai oleh renderLegend()
        var layerConfig = {
            pencaharian: {
                label: 'Mata Pencaharian', swatchType: 'round',
                legend: [
                    { c: '#16A34A', l: 'Petani' },
                    { c: '#F59E0B', l: 'Buruh' },
                    { c: '#3B82F6', l: 'PNS / ASN' },
                    { c: '#8B5CF6', l: 'Lainnya' }
                ]
            },
            listrik: {
                label: 'Daya Listrik', swatchType: 'round',
                legend: [
                    { c: '#EF4444', l: '≤ 450 VA' },
                    { c: '#F97316', l: '451–900 VA' },
                    { c: '#EAB308', l: '901–1300 VA' },
                    { c: '#22C55E', l: '> 1300 VA' }
                ]
            },
            topografi: {
                label: 'Topografi Kontur', swatchType: 'line',
                legend: [{ c: '#B45309', l: 'Garis kontur elevasi' }]
            },
            kepadatan_rt: {
                label: 'Kepadatan Penduduk per RT', swatchType: 'square',
                legend: [
                    { c: '#990000', l: '> 150 jiwa/Ha' },
                    { c: '#DC2626', l: '101–150 jiwa/Ha' },
                    { c: '#F97316', l: '51–100 jiwa/Ha' },
                    { c: '#FBBF24', l: '≤ 50 jiwa/Ha' }
                ]
            },
            lantai: {
                label: 'Jenis Lantai — Indikator RTLH', swatchType: 'round',
                legend: [
                    { c: '#059669', l: 'Layak Huni' },
                    { c: '#DC2626', l: 'RTLH (Rumah Tidak Layak Huni)' }
                ]
            }
        };

        function updateObjekPanel(title, subtitle, htmlContent) {
            document.getElementById('objekContent').innerHTML =
                `<div class="mb-2"><span class="legend-heading" style="margin:0;">${subtitle}</span></div>
                 <h6 class="fw-bold mb-2">${title}</h6>${htmlContent}`;
            showPanelTab('objek');
        }

        // Menentukan status RTLH sederhana dari kombinasi jenis lantai & kondisi bangunan
        function isRTLH(p) {
            var lantai = (p.jenis_lantai || '').toLowerCase();
            var kondisi = (p.kondisi_bangunan || '').toLowerCase();
            return lantai.includes('tanah') || kondisi.includes('rusak') || kondisi.includes('tidak layak');
        }

        // ---------------------------------------------------------------
        // FETCH DATA SPASIAL (API Laravel)
        // ---------------------------------------------------------------
        fetch('/api/bangunan').then(res => res.json()).then(data => {
            if (data.features) document.getElementById('statBangunan').textContent = data.features.length;

            L.geoJSON(data, {
                pointToLayer: function (f, latlng) {
                    let job = (f.properties.pekerjaan || '').toLowerCase();
                    let color = job.includes('petani') ? "#16A34A" : job.includes('buruh') ? "#F59E0B" : job.includes('pns') ? "#3B82F6" : "#8B5CF6";
                    return L.circleMarker(latlng, { radius: 7, fillColor: color, color: "#fff", weight: 2, fillOpacity: 0.9 });
                },
                onEachFeature: function (f, l) {
                    l.on('click', function (e) {
                        L.DomEvent.stopPropagation(e); let p = f.properties;
                        let html = `<div class="attr-box"><span class="attr-label">Nomor Bangunan</span><span class="attr-val">#${p.id_bangunan || '-'}</span></div><div class="attr-box"><span class="attr-label">Kepala Keluarga</span><span class="attr-val">${p.nama_kk || 'Warga'}</span></div><div class="attr-box"><span class="attr-label">Mata Pencaharian</span><span class="attr-val" style="color:#16A34A;">${p.pekerjaan || '-'}</span></div>`;
                        updateObjekPanel(`Bangunan #${p.id_bangunan}`, "TEMA MATA PENCAHARIAN", html);
                        map.flyTo(e.latlng, 18);
                    });
                }
            }).addTo(layerPencaharian);

            L.geoJSON(data, {
                pointToLayer: function (f, latlng) {
                    let va = parseInt(f.properties.daya_listrik) || 0;
                    let color = va <= 450 ? "#EF4444" : va <= 900 ? "#F97316" : va <= 1300 ? "#EAB308" : "#22C55E";
                    return L.circleMarker(latlng, { radius: 7, fillColor: color, color: "#fff", weight: 2, fillOpacity: 0.9 });
                },
                onEachFeature: function (f, l) {
                    l.on('click', function (e) {
                        L.DomEvent.stopPropagation(e); let p = f.properties;
                        let html = `<div class="attr-box"><span class="attr-label">Nomor Bangunan</span><span class="attr-val">#${p.id_bangunan || '-'}</span></div><div class="attr-box"><span class="attr-label">Daya Listrik</span><span class="attr-val" style="color:#D97706;">${p.daya_listrik || 0} VA</span></div><div class="attr-box"><span class="attr-label">Jumlah Penghuni</span><span class="attr-val">${p.jml_anggota || 0} Jiwa</span></div>`;
                        updateObjekPanel(`Bangunan #${p.id_bangunan}`, "TEMA DAYA LISTRIK", html);
                        map.flyTo(e.latlng, 18);
                    });
                }
            }).addTo(layerListrik);

            L.geoJSON(data, {
                pointToLayer: function (f, latlng) {
                    let color = isRTLH(f.properties) ? "#DC2626" : "#059669";
                    return L.circleMarker(latlng, { radius: 7, fillColor: color, color: "#fff", weight: 2, fillOpacity: 0.9 });
                },
                onEachFeature: function (f, l) {
                    l.on('click', function (e) {
                        L.DomEvent.stopPropagation(e); let p = f.properties;
                        let status = isRTLH(p) ? 'RTLH (Tidak Layak Huni)' : 'Layak Huni';
                        let statusColor = isRTLH(p) ? '#DC2626' : '#059669';
                        let html = `<div class="attr-box"><span class="attr-label">Nomor Bangunan</span><span class="attr-val">#${p.id_bangunan || '-'}</span></div><div class="attr-box"><span class="attr-label">Jenis Lantai</span><span class="attr-val">${p.jenis_lantai || 'Semen'}</span></div><div class="attr-box"><span class="attr-label">Status Kelayakan</span><span class="attr-val" style="color:${statusColor};">${status}</span></div>`;
                        updateObjekPanel(`Bangunan #${p.id_bangunan}`, "TEMA JENIS LANTAI / RTLH", html);
                        map.flyTo(e.latlng, 18);
                    });
                }
            }).addTo(layerLantai);
        }).catch(e => console.log("API Bangunan offline", e));

        fetch('/api/topografi').then(res => res.json()).then(data => {
            L.geoJSON(data, {
                style: { color: "#B45309", weight: 2, opacity: 0.85, dashArray: '4, 4' },
                onEachFeature: function (f, l) {
                    l.on('click', function (e) {
                        L.DomEvent.stopPropagation(e); let p = f.properties;
                        updateObjekPanel("Garis Kontur", "TEMA TOPOGRAFI", `<div class="attr-box"><span class="attr-label">Elevasi Ketinggian</span><span class="attr-val" style="color:#B45309;">${p.elevasi || 0} mdpl</span></div>`);
                    });
                }
            }).addTo(layerTopografi);
        }).catch(e => console.log("API Topografi offline", e));

        fetch('/api/kepadatan-rt').then(res => res.json()).then(data => {
            L.geoJSON(data, {
                style: function (f) {
                    let padat = parseInt(f.properties.kepadatan) || 0;
                    let color = padat > 150 ? "#990000" : padat > 100 ? "#DC2626" : padat > 50 ? "#F97316" : "#FBBF24";
                    return { fillColor: color, weight: 2, opacity: 1, color: 'white', dashArray: '3', fillOpacity: 0.65 };
                },
                onEachFeature: function (f, l) {
                    l.on('click', function (e) {
                        L.DomEvent.stopPropagation(e); let p = f.properties;
                        let html = `<div class="attr-box"><span class="attr-label">Wilayah RT / RW</span><span class="attr-val" style="color:#DC2626;">RT ${p.nomor_rt || '-'} / RW ${p.nomor_rw || '-'}</span></div><div class="attr-box"><span class="attr-label">Total Penduduk</span><span class="attr-val">${p.jml_penduduk || 0} Jiwa</span></div><div class="attr-box"><span class="attr-label">Kepadatan</span><span class="attr-val">${p.kepadatan || 0} Jiwa/Ha</span></div>`;
                        updateObjekPanel(`Wilayah RT ${p.nomor_rt || '-'}`, "TEMA KEPADATAN", html);
                        map.fitBounds(l.getBounds());
                    });
                }
            }).addTo(layerKepadatanRT);
        }).catch(e => console.log("API RT offline", e));

        // ---------------------------------------------------------------
        // TOGGLE LAYER (checkbox independen — bisa aktif bersamaan)
        // ---------------------------------------------------------------
        function updateActiveCountBadge() {
            const count = document.querySelectorAll('.layer-toggle:checked').length;
            document.getElementById('activeCountBadge').textContent = count;
        }

        function renderLegend() {
            const container = document.getElementById('legendContainer');
            const checkedKeys = [...document.querySelectorAll('.layer-toggle:checked')].map(c => c.dataset.layer);
            if (checkedKeys.length === 0) {
                container.innerHTML = '<p class="panel-empty">Aktifkan minimal satu layer untuk menampilkan legenda.</p>';
                return;
            }
            container.innerHTML = checkedKeys.map(key => {
                const cfg = layerConfig[key];
                const rows = cfg.legend.map(item =>
                    `<div class="legend-row"><span class="legend-swatch ${cfg.swatchType}" style="background:${item.c}"></span>${item.l}</div>`
                ).join('');
                return `<div class="legend-block"><div class="legend-heading">${cfg.label}</div>${rows}</div>`;
            }).join('');
        }

        document.querySelectorAll('.layer-toggle').forEach(function (chk) {
            chk.addEventListener('change', function () {
                const key = this.dataset.layer;
                if (this.checked) map.addLayer(layerGroups[key]);
                else map.removeLayer(layerGroups[key]);
                renderLegend();
                updateActiveCountBadge();
            });
        });

        function setAllLayers(state) {
            document.querySelectorAll('.layer-toggle').forEach(function (chk) {
                chk.checked = state;
                const key = chk.dataset.layer;
                if (state) map.addLayer(layerGroups[key]); else map.removeLayer(layerGroups[key]);
            });
            renderLegend();
            updateActiveCountBadge();
        }

        function showPanelTab(tab) {
            document.querySelectorAll('.panel-tab-btn').forEach(b => b.classList.toggle('active', b.dataset.tab === tab));
            document.querySelectorAll('.panel-pane').forEach(p => p.classList.toggle('d-none', p.dataset.pane !== tab));
        }

        // Render legend awal sesuai layer default yang aktif
        renderLegend();
        updateActiveCountBadge();

        // ---------------------------------------------------------------
        // FIX: Leaflet menghitung ukuran container saat inisialisasi. Jika ukuran
        // berubah setelahnya (panel di-collapse/expand di mobile, atau resize
        // jendela), peta bisa tampak terpotong / tile kosong sebagian sampai
        // di-invalidate ulang.
        // ---------------------------------------------------------------
        var controlPanelCollapse = document.getElementById('controlPanelCollapse');
        controlPanelCollapse.addEventListener('shown.bs.collapse', () => map.invalidateSize());
        controlPanelCollapse.addEventListener('hidden.bs.collapse', () => map.invalidateSize());
        window.addEventListener('resize', () => map.invalidateSize());
        setTimeout(() => map.invalidateSize(), 300);
    </script>
</body>
</html>
