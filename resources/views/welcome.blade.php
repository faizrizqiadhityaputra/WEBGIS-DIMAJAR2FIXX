<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>WebGIS - Dusun Dimajar 2</title>

    <!-- Google Fonts: Instrument Sans -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { overflow-x: hidden; }
        /* Custom scrollbar untuk kenyamanan eksplorasi */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #059669; }
    </style>
</head>
<body class="bg-slate-900 text-slate-800 font-sans antialiased min-h-screen flex flex-col justify-between relative selection:bg-emerald-500 selection:text-white">

    <!-- 1. BACKGROUND HERO & OVERLAY -->
    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1932&auto=format&fit=crop"
         alt="Foto Udara Dimajar 2"
         class="fixed inset-0 w-full h-full object-cover object-center z-0 pointer-events-none" />
    <div class="fixed inset-0 bg-gradient-to-b from-white/95 via-white/85 to-slate-900/95 z-10 pointer-events-none"></div>

    <!-- 2. NAVBAR RESPONSIF (Anti-Hilang di Mobile) -->
    <header class="fixed top-4 left-0 right-0 z-[9999] px-4 sm:px-6 flex justify-center pointer-events-auto">
        <nav class="w-full max-w-md md:max-w-4xl bg-white/90 backdrop-blur-md rounded-full px-4 py-2.5 md:px-6 md:py-3 shadow-xl border border-slate-200/80 flex items-center justify-between gap-4 transition duration-300">
            <!-- Brand -->
            <a href="/" class="text-sm sm:text-base md:text-lg font-extrabold text-slate-800 whitespace-nowrap shrink-0 flex items-center gap-2 hover:text-emerald-600 transition">
                <span class="text-lg md:text-xl">🍃</span>
                <span>Dimajar 2</span>
            </a>

            <!-- Menu Link Desktop -->
            <div class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                <a href="#statistik" class="hover:text-emerald-600 transition">Statistik</a>
                <a href="#sejarah" class="hover:text-emerald-600 transition">Tentang & Sejarah</a>
                <a href="#tematik" class="hover:text-emerald-600 transition">Peta Tematik</a>
            </div>

            <!-- CTA Button -->
            <a href="/peta" class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-xs md:text-sm font-bold px-4 py-2 md:px-6 md:py-2.5 rounded-full transition duration-300 whitespace-nowrap shrink-0 shadow-md hover:shadow-emerald-500/25">
                Peta Interaktif
            </a>
        </nav>
    </header>

    <!-- 3. KONTEN UTAMA -->
    <main class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 pt-28 sm:pt-36 pb-16 flex flex-col items-center w-full">

        <!-- HERO SECTION -->
        <div class="text-center max-w-3xl mb-12 sm:mb-16">
            <div class="inline-flex items-center gap-1.5 bg-white/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs md:text-sm font-bold text-emerald-800 shadow-sm mb-6 border border-emerald-200">
                <span>📍</span>
                <span>SUMBERARUM, TEMPURAN, MAGELANG</span>
            </div>
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight mb-6">
                Selamat Datang di <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700">Dusun Dimajar 2</span>
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-slate-600 leading-relaxed font-medium max-w-2xl mx-auto mb-8 px-2">
                Eksplorasi potensi lokal, keragaman demografi, serta infrastruktur wilayah melalui sistem informasi geografis dan pemetaan spasial interaktif modern.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5">
                <a href="/peta" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm md:text-base px-8 py-4 rounded-full shadow-lg hover:shadow-emerald-500/30 transition duration-300 transform hover:-translate-y-0.5">
                    <span>Jelajahi Peta Tematik</span>
                    <span>🚀</span>
                </a>
                <a href="#sejarah" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white/90 hover:bg-white text-slate-700 font-bold text-sm md:text-base px-7 py-4 rounded-full shadow-sm hover:shadow-md border border-slate-200 transition duration-300">
                    <span>Pelajari Sejarah</span>
                    <span>📖</span>
                </a>
            </div>
        </div>

        <!-- SECTION STATISTIK / INFO CARDS -->
        <section id="statistik" class="w-full mb-16 sm:mb-20 scroll-mt-28">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6">

                <!-- Card 1: Bangunan -->
                <div class="group bg-white/90 backdrop-blur-md p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-md hover:shadow-xl hover:border-emerald-500/40 transition duration-300 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <span class="text-xs sm:text-sm font-bold text-slate-500 uppercase tracking-wider">Infrastruktur</span>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg sm:text-2xl font-black group-hover:scale-110 transition duration-300 shadow-inner">
                            🏡
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-800 tracking-tight mb-1">106</div>
                        <div class="text-xs sm:text-sm font-bold text-slate-600">Jumlah Bangunan</div>
                    </div>
                </div>

                <!-- Card 2: Wilayah / RT -->
                <div class="group bg-white/90 backdrop-blur-md p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-md hover:shadow-xl hover:border-teal-500/40 transition duration-300 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <span class="text-xs sm:text-sm font-bold text-slate-500 uppercase tracking-wider">Administrasi</span>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-teal-100 text-teal-600 flex items-center justify-center text-lg sm:text-2xl font-black group-hover:scale-110 transition duration-300 shadow-inner">
                            👥
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-800 tracking-tight mb-1">2</div>
                        <div class="text-xs sm:text-sm font-bold text-slate-600">Rukun Tetangga (RT)</div>
                    </div>
                </div>

                <!-- Card 3: Peta Tematik -->
                <div class="group bg-white/90 backdrop-blur-md p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-md hover:shadow-xl hover:border-blue-500/40 transition duration-300 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <span class="text-xs sm:text-sm font-bold text-slate-500 uppercase tracking-wider">Visualisasi</span>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg sm:text-2xl font-black group-hover:scale-110 transition duration-300 shadow-inner">
                            🗺️
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-800 tracking-tight mb-1">5</div>
                        <div class="text-xs sm:text-sm font-bold text-slate-600">Peta Tematik & Infografis</div>
                    </div>
                </div>

                <!-- Card 4: Cagar Budaya -->
                <div class="group bg-white/90 backdrop-blur-md p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-md hover:shadow-xl hover:border-amber-500/40 transition duration-300 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <span class="text-xs sm:text-sm font-bold text-slate-500 uppercase tracking-wider">Warisan</span>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg sm:text-2xl font-black group-hover:scale-110 transition duration-300 shadow-inner">
                            🏛️
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-800 tracking-tight mb-1">1</div>
                        <div class="text-xs sm:text-sm font-bold text-slate-600">Situs Bersejarah (Batu Yoni)</div>
                    </div>
                </div>

            </div>
        </section>

        <!-- SECTION TENTANG & SEJARAH (Layout 2 Kolom) -->
        <section id="sejarah" class="w-full mb-16 sm:mb-20 scroll-mt-28">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs md:text-sm font-extrabold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">
                    Sosiokultural & Kronologi
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                    Menelusuri Akar Dusun Dimajar 2
                </h2>
            </div>

            <!-- Kontainer 2 Kolom untuk Narasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

                <!-- Kolom 1: Asal-Usul Nama -->
                <div class="bg-white/90 backdrop-blur-md p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-lg flex flex-col justify-between hover:border-slate-300 transition duration-300">
                    <div>
                        <div class="flex items-center gap-3.5 border-b border-slate-100 pb-5 mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shrink-0 font-bold border border-emerald-100 shadow-sm">
                                📖
                            </div>
                            <div>
                                <h3 class="text-base sm:text-lg font-black text-slate-800 leading-snug">
                                    Tentang Dusun Dimajar 2 & Asal-Usul Nama
                                </h3>
                                <span class="text-xs font-bold text-emerald-600">Dari "Demakjar" Menjadi Dimajar</span>
                            </div>
                        </div>
                        <div class="prose prose-slate text-xs sm:text-sm leading-relaxed text-slate-600 space-y-3 font-medium">
                            <p>
                                Menurut cerita tutur masyarakat dan sesepuh desa, nama Dimajar berakar dari kata <strong class="text-slate-800">"Demakjar"</strong>. Alkisah, pada masa lampau seorang Sunan dari Demak pernah singgah di wilayah ini untuk menyebarkan syiar Islam dan mendirikan sebuah masjid. Karena kebiasaan pelafalan masyarakat Jawa yang menyederhanakan sebutan agar lebih mudah diucapkan, kata <em>"Demakjar"</em> lambat laun bertransformasi menjadi <strong class="text-slate-800">Dimajar</strong>.
                            </p>
                            <p>
                                Seiring berjalannya waktu dan wilayahnya yang semakin luas, kawasan ini dimekarkan menjadi tiga wilayah administrasi: Dimajar I, Dimajar II, dan Dimajar III. Dusun Dimajar II sendiri tumbuh menjadi pedusunan yang asri di Kelurahan Sumberarum, Kecamatan Tempuran, Kabupaten Magelang, dengan mayoritas warganya menggantungkan hidup dari sektor pertanian yang subur.
                            </p>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-slate-400">
                        <span>Kearifan Lokal</span>
                        <span>Sektor Pertanian</span>
                    </div>
                </div>

                <!-- Kolom 2: Cagar Budaya -->
                <div class="bg-white/90 backdrop-blur-md p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-lg flex flex-col justify-between hover:border-slate-300 transition duration-300">
                    <div>
                        <div class="flex items-center gap-3.5 border-b border-slate-100 pb-5 mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl shrink-0 font-bold border border-amber-100 shadow-sm">
                                🏛️
                            </div>
                            <div>
                                <h3 class="text-base sm:text-lg font-black text-slate-800 leading-snug">
                                    Jejak Langkah & Cagar Budaya
                                </h3>
                                <span class="text-xs font-bold text-amber-600">Saksi Bisu Peradaban & Arsitektur Tunggal</span>
                            </div>
                        </div>
                        <div class="prose prose-slate text-xs sm:text-sm leading-relaxed text-slate-600 space-y-3 font-medium">
                            <p>
                                Di jantung Dusun Dimajar II, berdiri <strong class="text-slate-800">Masjid Al-Barokah</strong> yang menjadi situs bersejarah sekaligus pusat kemaslahatan warga. Pada awal masa berdirinya, masjid ini memiliki keunikan arsitektur yang luar biasa, yaitu ditopang oleh hanya <strong class="text-slate-800">1 (satu) tiang penyangga utama (saka guru)</strong> yang berada tepat di tengah-tengah bangunan.
                            </p>
                            <p>
                                Sebagai bukti kuat adanya persinggungan peradaban masa lampau, hingga saat ini masih tersimpan situs peninggalan berupa <strong class="text-slate-800">Batu Yoni</strong> (umpak batu besar) yang terawat di pojok halaman masjid. Meskipun catatan tertulis mengenai latar belakang kronologis Yoni ini masih minim informasi, keberadaannya menjadi penanda kekayaan warisan arkeologis desa. Hingga kini, Masjid Al-Barokah telah mengalami berbagai tahap renovasi tanpa meninggalkan nilai historisnya, dan terus aktif digunakan sebagai tempat peribadatan, menimba ilmu, hingga musyawarah warga.
                            </p>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-slate-400">
                        <span>Masjid Al-Barokah</span>
                        <span>Situs Batu Yoni</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- SECTION INFOGRAFIS & 5 PETA TEMATIK -->
        <section id="tematik" class="w-full scroll-mt-28">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs md:text-sm font-extrabold text-teal-400 uppercase tracking-widest bg-slate-800/80 px-3.5 py-1 rounded-full border border-slate-700 shadow-sm">
                    Visualisasi Spasial
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-white mt-3 tracking-tight drop-shadow-md">
                    Infografis & Peta Tematik
                </h2>
                <p class="text-slate-300 text-xs sm:text-sm mt-2 font-medium">
                    Lima fokus utama pemetaan spasial dan analisis data terpadu Dusun Dimajar 2.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">

                <!-- Layer 1: Daya Listrik -->
                <div class="group bg-slate-800/90 hover:bg-slate-800 backdrop-blur-md p-6 rounded-3xl border border-slate-700/80 shadow-xl hover:border-amber-500/50 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 border border-amber-500/20 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition duration-300">
                                ⚡
                            </div>
                            <span class="text-[11px] font-bold text-amber-400 bg-amber-500/10 border border-amber-500/20 px-2.5 py-1 rounded-full">
                                Layer Spasial
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-amber-400 transition">Daya Listrik</h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal mb-6">
                            Pemetaan jaringan dan distribusi kapasitas daya listrik hunian warga Dimajar 2.
                        </p>
                    </div>
                    <a href="/peta?layer=listrik" class="inline-flex items-center gap-2 text-xs font-bold text-amber-400 hover:text-amber-300 transition w-fit group/btn">
                        <span>Buka Layer Peta</span>
                        <span class="transform group-hover/btn:translate-x-1 transition">&rarr;</span>
                    </a>
                </div>

                <!-- Layer 2: Jumlah Bekerja -->
                <div class="group bg-slate-800/90 hover:bg-slate-800 backdrop-blur-md p-6 rounded-3xl border border-slate-700/80 shadow-xl hover:border-blue-500/50 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-400 border border-blue-500/20 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition duration-300">
                                💼
                            </div>
                            <span class="text-[11px] font-bold text-blue-400 bg-blue-500/10 border border-blue-500/20 px-2.5 py-1 rounded-full">
                                Layer Demografi
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-blue-400 transition">Jumlah Bekerja</h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal mb-6">
                            Sebaran demografi penduduk usia produktif dan statistik mata pencaharian utama.
                        </p>
                    </div>
                    <a href="/peta?layer=pekerjaan" class="inline-flex items-center gap-2 text-xs font-bold text-blue-400 hover:text-blue-300 transition w-fit group/btn">
                        <span>Buka Layer Peta</span>
                        <span class="transform group-hover/btn:translate-x-1 transition">&rarr;</span>
                    </a>
                </div>

                <!-- Layer 3: Kepadatan Hunian -->
                <div class="group bg-slate-800/90 hover:bg-slate-800 backdrop-blur-md p-6 rounded-3xl border border-slate-700/80 shadow-xl hover:border-rose-500/50 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-400 border border-rose-500/20 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition duration-300">
                                🏡
                            </div>
                            <span class="text-[11px] font-bold text-rose-400 bg-rose-500/10 border border-rose-500/20 px-2.5 py-1 rounded-full">
                                Layer Permukiman
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-rose-400 transition">Kepadatan Hunian</h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal mb-6">
                            Analisis kerapatan bangunan dan pola permukiman warga di seluruh wilayah dusun.
                        </p>
                    </div>
                    <a href="/peta?layer=hunian" class="inline-flex items-center gap-2 text-xs font-bold text-rose-400 hover:text-rose-300 transition w-fit group/btn">
                        <span>Buka Layer Peta</span>
                        <span class="transform group-hover/btn:translate-x-1 transition">&rarr;</span>
                    </a>
                </div>

                <!-- Layer 4: Sumber Air -->
                <div class="group bg-slate-800/90 hover:bg-slate-800 backdrop-blur-md p-6 rounded-3xl border border-slate-700/80 shadow-xl hover:border-cyan-500/50 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition duration-300">
                                💧
                            </div>
                            <span class="text-[11px] font-bold text-cyan-400 bg-cyan-500/10 border border-cyan-500/20 px-2.5 py-1 rounded-full">
                                Layer Hidrologi
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-cyan-400 transition">Sumber Air Bersih</h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal mb-6">
                            Identifikasi titik sumur, mata air, dan saluran distribusi kebutuhan air warga.
                        </p>
                    </div>
                    <a href="/peta?layer=air" class="inline-flex items-center gap-2 text-xs font-bold text-cyan-400 hover:text-cyan-300 transition w-fit group/btn">
                        <span>Buka Layer Peta</span>
                        <span class="transform group-hover/btn:translate-x-1 transition">&rarr;</span>
                    </a>
                </div>

                <!-- Layer 5: Topografi & Lereng -->
                <div class="group bg-slate-800/90 hover:bg-slate-800 backdrop-blur-md p-6 rounded-3xl border border-slate-700/80 shadow-xl hover:border-emerald-500/50 transition duration-300 flex flex-col justify-between sm:col-span-2 lg:col-span-1">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition duration-300">
                                ⛰️
                            </div>
                            <span class="text-[11px] font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-1 rounded-full">
                                Layer Topografi
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-emerald-400 transition">Topografi & Lereng</h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal mb-6">
                            Visualisasi elevasi, kontur tanah, dan tingkat kemiringan lereng untuk mitigasi/lahan.
                        </p>
                    </div>
                    <a href="/peta?layer=topografi" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-400 hover:text-emerald-300 transition w-fit group/btn">
                        <span>Buka Layer Peta</span>
                        <span class="transform group-hover/btn:translate-x-1 transition">&rarr;</span>
                    </a>
                </div>

            </div>
        </section>

    </main>

    <!-- 4. FOOTER -->
    <footer class="relative z-20 bg-slate-950/90 backdrop-blur-md text-center py-8 px-4 border-t border-slate-800/80 mt-12">
        <p class="text-xs sm:text-sm text-slate-300 font-medium max-w-xl mx-auto leading-relaxed">
            Developed by <br class="sm:hidden">
            <strong class="text-emerald-400 font-bold">Kelompok PKL 2 C2 Dimajar 2</strong> <br>
            <span class="text-slate-400">Sistem Informasi Geografis &bull; Universitas Gadjah Mada</span>
        </p>
        <p class="text-[11px] text-slate-500 mt-3 font-semibold">
            &copy; {{ date('Y') }} WebGIS Dimajar 2. All Rights Reserved.
        </p>
    </footer>

</body>
</html>
