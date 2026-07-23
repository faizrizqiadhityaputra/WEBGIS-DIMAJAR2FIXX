<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebGIS & Profil Dusun Dimajar 2</title>

    <link rel="preload" as="image" href="{{ asset('images/bg-landingpage.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        :root {
            --primary: #059669;
            /* Emerald 600 */
            --primary-dark: #047857;
            /* Emerald 700 */
            --primary-light: #D1FAE5;
            /* Emerald 100 */
            --primary-glow: rgba(5, 150, 105, 0.4);
            --primary-gradient: linear-gradient(135deg, #059669 0%, #10B981 100%);
            --secondary: #1E293B;
            /* Slate 800 */
            --bg-page: #FFFFFF;
            --bg-alt: rgba(248, 250, 252, 0.6);
            /* Transparan Slate 50 */
            --text-main: #334155;
            /* Slate 700 */
            --text-mute: #64748B;
            /* Slate 500 */
            --border-color: #E2E8F0;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            background: radial-gradient(circle at 50% 0%, #ffffff 0%, #f0fdf4 50%, #e2e8f0 100%);
            background-attachment: fixed;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--secondary);
            font-weight: 700;
        }

        [id] {
            scroll-margin-top: 110px;
        }

        /* ===============================================================
           1. ANIMASI SPASIAL, GRID, & PARTIKEL DAUN MELAYANG
        =============================================================== */
        .spatial-grid-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-image:
                linear-gradient(to right, rgba(16, 185, 129, 0.08) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(16, 185, 129, 0.08) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: -4;
            pointer-events: none;
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 40px 40px;
            }
        }

        .spatial-radar {
            position: fixed;
            top: 35%;
            left: 50%;
            width: 80vw;
            height: 80vw;
            max-width: 900px;
            max-height: 900px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, rgba(5, 150, 105, 0.04) 40%, transparent 70%);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: -3;
            pointer-events: none;
            animation: radarPulse 6s ease-in-out infinite alternate;
        }

        @keyframes radarPulse {
            0% {
                transform: translate(-50%, -50%) scale(0.85);
                opacity: 0.6;
            }

            100% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 1;
            }
        }

        .particle-container {
            position: fixed;
            inset: 0;
            z-index: -2;
            pointer-events: none;
            overflow: hidden;
            transition: transform 0.2s ease-out;
        }

        .particle {
            position: absolute;
            opacity: 0;
        }

        .orb-1 {
            left: 5%;
            bottom: -10%;
            font-size: 15rem;
            filter: blur(40px);
            animation: floatUp linear 25s infinite;
            animation-delay: 0s;
            color: rgba(16, 185, 129, 0.3);
        }

        .orb-2 {
            left: 80%;
            bottom: -20%;
            font-size: 20rem;
            filter: blur(50px);
            animation: floatUp linear 30s infinite;
            animation-delay: 5s;
            color: rgba(5, 150, 105, 0.2);
        }

        .orb-3 {
            left: 40%;
            bottom: -15%;
            font-size: 12rem;
            filter: blur(45px);
            animation: floatUp linear 28s infinite;
            animation-delay: 2s;
            color: rgba(52, 211, 153, 0.25);
        }

        .leaf-1 {
            left: 10%;
            font-size: 1.5rem;
            animation: flutterUp1 22s ease-in-out infinite;
            animation-delay: 0s;
            color: rgba(16, 185, 129, 0.7);
        }

        .leaf-2 {
            left: 85%;
            font-size: 2rem;
            animation: flutterUp2 28s ease-in-out infinite;
            animation-delay: 3s;
            color: rgba(5, 150, 105, 0.5);
            filter: blur(1.5px);
        }

        .leaf-3 {
            left: 45%;
            font-size: 1.2rem;
            animation: flutterUp1 19s ease-in-out infinite;
            animation-delay: 7s;
            color: rgba(52, 211, 153, 0.8);
        }

        .leaf-4 {
            left: 70%;
            font-size: 1.8rem;
            animation: flutterUp2 25s ease-in-out infinite;
            animation-delay: 10s;
            color: rgba(4, 120, 87, 0.6);
        }

        .leaf-5 {
            left: 25%;
            font-size: 1.4rem;
            animation: flutterUp1 30s ease-in-out infinite;
            animation-delay: 5s;
            color: rgba(16, 185, 129, 0.4);
            filter: blur(2.5px);
        }

        .leaf-6 {
            left: 55%;
            font-size: 1.6rem;
            animation: flutterUp2 24s ease-in-out infinite;
            animation-delay: 14s;
            color: rgba(5, 150, 105, 0.7);
        }

        .leaf-7 {
            left: 5%;
            font-size: 2.2rem;
            animation: flutterUp1 27s ease-in-out infinite;
            animation-delay: 8s;
            color: rgba(52, 211, 153, 0.4);
            filter: blur(1px);
        }

        .leaf-8 {
            left: 90%;
            font-size: 1.3rem;
            animation: flutterUp2 20s ease-in-out infinite;
            animation-delay: 1s;
            color: rgba(16, 185, 129, 0.6);
        }

        @keyframes floatUp {
            0% {
                transform: translateY(110vh) rotate(0deg) translateX(0);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            80% {
                opacity: 1;
            }

            100% {
                transform: translateY(-20vh) rotate(360deg) translateX(120px);
                opacity: 0;
            }
        }

        @keyframes flutterUp1 {
            0% {
                transform: translate3d(0, 110vh, 0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            30% {
                transform: translate3d(40px, 70vh, 0) rotate(45deg);
            }

            50% {
                transform: translate3d(-30px, 40vh, 0) rotate(90deg);
                opacity: 0.8;
            }

            70% {
                transform: translate3d(50px, 10vh, 0) rotate(135deg);
            }

            90% {
                opacity: 0.8;
            }

            100% {
                transform: translate3d(-20px, -20vh, 0) rotate(180deg);
                opacity: 0;
            }
        }

        @keyframes flutterUp2 {
            0% {
                transform: translate3d(0, 110vh, 0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.7;
            }

            30% {
                transform: translate3d(-50px, 70vh, 0) rotate(-45deg);
            }

            50% {
                transform: translate3d(30px, 40vh, 0) rotate(-90deg);
                opacity: 0.7;
            }

            70% {
                transform: translate3d(-40px, 10vh, 0) rotate(-135deg);
            }

            90% {
                opacity: 0.7;
            }

            100% {
                transform: translate3d(20px, -20vh, 0) rotate(-180deg);
                opacity: 0;
            }
        }

        @keyframes floatAnim {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes pulseGlow {
            0% {
                box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.5);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(5, 150, 105, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(5, 150, 105, 0);
            }
        }

        @keyframes slowPan {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .floating-element {
            animation: floatAnim 6s ease-in-out infinite;
        }

        /* ===============================================================
           2. FITUR BARU: SPOTLIGHT GLOW & 3D TILT EFFECT
        =============================================================== */
        .spotlight-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.15s ease-out, box-shadow 0.3s ease, border-color 0.3s ease;
            will-change: transform;
        }

        .spotlight-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(600px circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(16, 185, 129, 0.18), transparent 40%);
            z-index: 0;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .spotlight-card:hover::before {
            opacity: 1;
        }

        .spotlight-card>* {
            position: relative;
            z-index: 1;
        }

        /* ===============================================================
           3. KOMPONEN UI & SECTION
        =============================================================== */
        .navbar-wrapper {
            position: fixed;
            top: 20px;
            left: 0;
            width: 100%;
            z-index: 99999;
            display: flex;
            justify-content: center;
            padding: 0 15px;
            pointer-events: none;
        }

        .navbar-pill {
            pointer-events: auto;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 1);
            padding: 12px 24px;
            border-radius: 50px;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.1), inset 0 0 0 1px rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 900px;
            transition: all 0.4s ease;
        }

        .navbar-pill:hover {
            box-shadow: 0 20px 40px -5px rgba(5, 150, 105, 0.15);
            border-color: var(--primary-light);
        }

        .nav-brand {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--secondary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links {
            display: flex;
            gap: 24px;
            align-items: center;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-main);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .btn-nav {
            background: var(--primary-gradient);
            color: white !important;
            padding: 10px 24px;
            border-radius: 50px;
            transition: all 0.3s;
            font-weight: 600;
            box-shadow: 0 6px 15px var(--primary-glow);
            border: none;
        }

        .btn-nav:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px var(--primary-glow);
        }

        /* HERO SECTION */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 20px 40px 20px;
            overflow: hidden;
            background-color: transparent;
        }

        .hero-bg-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            animation: slowPan 30s ease-in-out infinite;
            -webkit-mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 50%, rgba(0, 0, 0, 0) 100%);
            mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 50%, rgba(0, 0, 0, 0) 100%);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.5) 0%, rgba(255, 255, 255, 0.85) 50%, transparent 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            max-width: 850px;
            z-index: 2;
            margin-top: 40px;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 20px;
            text-shadow: 0 4px 20px rgba(255, 255, 255, 0.9);
            line-height: 1.2;
        }

        .hero-title span {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-lead {
            font-size: 1.15rem;
            font-weight: 500;
            color: #1E293B;
            line-height: 1.7;
            margin-bottom: 35px;
            text-shadow: 0 2px 10px rgba(255, 255, 255, 1);
        }

        .btn-hero {
            background: var(--primary-gradient);
            color: white;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px var(--primary-glow);
            border: 2px solid transparent;
        }

        .btn-hero:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px var(--primary-glow);
            color: white;
            border-color: rgba(255, 255, 255, 0.5);
        }

        .section-padding {
            padding: 50px 0;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .section-padding {
                padding: 40px 0;
            }
        }

        .section-badge {
            display: inline-block;
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 16px;
            border: 1px solid rgba(5, 150, 105, 0.2);
        }

        .section-title {
            font-weight: 800;
            font-size: clamp(2rem, 4vw, 2.5rem);
            margin-bottom: 20px;
            letter-spacing: -0.02em;
            line-height: 1.25;
            text-wrap: balance;
        }

        .section-title span {
            color: var(--primary);
        }

        .about-image-wrapper {
            background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(241, 245, 249, 0.8) 100%);
            border-radius: 30px;
            padding: 0;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            min-height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid white;
            position: relative;
            overflow: hidden;
        }

        .about-image-wrapper img {
            width: 100%;
            height: 100%;
            min-height: 380px;
            object-fit: cover;
            border-radius: 26px;
            margin: 0;
            display: block;
            transition: transform 0.5s;
        }

        .about-image-wrapper:hover img {
            transform: scale(1.05);
        }

        .history-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            height: 100%;
        }

        .history-card:hover {
            box-shadow: 0 25px 50px -12px rgba(5, 150, 105, 0.2);
            border-color: var(--primary-light);
            background: #ffffff;
        }

        .history-img-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            height: 240px;
            background: #E2E8F0;
            border: 2px solid white;
        }

        .history-img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .history-img-card:hover img {
            transform: scale(1.1);
        }

        .history-img-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85), transparent);
            color: #fff;
            padding: 25px 15px 10px 15px;
            font-size: 0.9rem;
            font-weight: 700;
            text-align: center;
        }

        /* INFOGRAFIS CARDS */
        .stat-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 1);
            border-radius: 28px;
            padding: 35px 20px;
            text-align: center;
            height: 100%;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.06);
            position: relative;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 28px;
            box-shadow: inset 0 0 0 2px var(--primary-light);
            opacity: 0;
            transition: opacity 0.4s;
            z-index: 0;
            pointer-events: none;
        }

        .stat-card:hover {
            box-shadow: 0 25px 50px -15px rgba(5, 150, 105, 0.3);
            background: #ffffff;
        }

        .stat-card:hover::after {
            opacity: 1;
        }

        .stat-icon {
            position: relative;
            z-index: 1;
            width: 75px;
            height: 75px;
            margin: 0 auto 20px auto;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--primary-light) 0%, #ffffff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px -5px rgba(5, 150, 105, 0.2);
            transition: transform 0.4s;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.15) rotate(-5deg);
        }

        .stat-number {
            position: relative;
            z-index: 1;
            font-size: clamp(2rem, 3vw, 2.5rem);
            font-weight: 800;
            color: var(--secondary);
            margin-bottom: 5px;
        }

        .stat-label {
            position: relative;
            z-index: 1;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .stat-desc {
            position: relative;
            z-index: 1;
            font-size: 0.85rem;
            color: var(--text-mute);
            margin: 0;
            line-height: 1.6;
        }

        /* TIMELINE */
        .timeline-container {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            padding-left: 35px;
            border-left: 3px dashed var(--primary-light);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 40px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: -46px;
            top: 0;
            width: 20px;
            height: 20px;
            background: var(--primary);
            border: 4px solid white;
            border-radius: 50%;
            animation: pulseGlow 2s infinite;
            box-shadow: 0 0 10px rgba(5, 150, 105, 0.4);
        }

        .timeline-content {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 28px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.03);
        }

        .timeline-content:hover {
            transform: translateX(10px);
            box-shadow: 0 20px 40px -10px rgba(5, 150, 105, 0.15);
            border-color: var(--primary-light);
            background: #ffffff;
        }

        .timeline-date {
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .timeline-title {
            font-weight: 800;
            font-size: 1.25rem;
            margin-bottom: 12px;
            color: var(--secondary);
        }

        /* KONSOL PETA MODERN */
        .map-console-wrapper {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 36px;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.1), 0 0 0 10px rgba(255, 255, 255, 0.4);
        }

        .map-console-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            padding: 4px 12px 20px 12px;
        }

        .btn-panel-toggle {
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 20px var(--primary-glow);
        }

        .active-layer-count {
            background: rgba(255, 255, 255, 0.3);
            padding: 1px 8px;
            border-radius: 50px;
            font-size: 0.75rem;
        }

        .map-console-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        @media (min-width: 992px) {
            .map-console-grid {
                grid-template-columns: 1fr 360px;
                align-items: start;
            }
        }

        .map-shell {
            position: relative;
            border-radius: 28px;
            overflow: hidden;
            border: 2px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        #map {
            width: 100%;
            height: min(65vh, 600px);
            min-height: 420px;
            background: #E2E8F0;
            z-index: 1;
        }

        @media (max-width: 767px) {
            #map {
                height: 55vh;
                min-height: 380px;
            }
        }

        .map-readout {
            position: absolute;
            left: 16px;
            bottom: 16px;
            z-index: 700;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--secondary);
            font-family: monospace;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .map-epsg-badge {
            position: absolute;
            right: 16px;
            bottom: 16px;
            z-index: 700;
            background: var(--primary);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(5, 150, 105, 0.3);
        }

        .leaflet-container img {
            max-width: none !important;
        }

        .leaflet-container a {
            text-decoration: none !important;
        }

        .leaflet-container {
            font-family: 'Inter', sans-serif;
        }

        .leaflet-bar {
            border: none !important;
            border-radius: 16px !important;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .leaflet-bar a {
            background: rgba(255, 255, 255, 0.95) !important;
            color: var(--secondary) !important;
            width: 36px !important;
            height: 36px !important;
            line-height: 36px !important;
            transition: 0.2s;
        }

        .leaflet-bar a:hover {
            background: var(--primary) !important;
            color: white !important;
        }

        .leaflet-control-attribution {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(6px);
            border-radius: 10px 0 0 0 !important;
            font-size: 0.68rem !important;
        }

        .control-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 28px;
            padding: 20px;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .panel-tabs {
            display: flex;
            gap: 4px;
            background: rgba(248, 250, 252, 0.5);
            padding: 6px;
            border-radius: 50px;
            border: 1px solid var(--border-color);
        }

        .panel-tab-btn {
            flex: 1;
            border: none;
            background: transparent;
            padding: 10px 10px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-mute);
            cursor: pointer;
            transition: all .3s;
        }

        .panel-tab-btn.active {
            background: var(--primary-gradient);
            color: #fff;
            box-shadow: 0 6px 14px rgba(5, 150, 105, 0.3);
        }

        .panel-pane {
            max-height: 480px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .panel-pane::-webkit-scrollbar {
            width: 6px;
        }

        .panel-pane::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }

        .panel-pane.d-none {
            display: none !important;
        }

        .layer-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 12px 16px;
            margin-bottom: 10px;
            transition: 0.2s;
        }

        .layer-item:hover {
            background: #fff;
            border-color: var(--primary-light);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .layer-label {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--secondary);
        }

        .layer-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            flex-shrink: 0;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.04);
        }

        .form-switch .form-check-input {
            width: 40px;
            height: 20px;
            cursor: pointer;
        }

        .form-switch .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .quick-actions {
            display: flex;
            gap: 10px;
        }

        .btn-quick {
            flex: 1;
            background: #fff;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 8px 12px;
            border-radius: 50px;
            transition: 0.2s;
        }

        .btn-quick:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
            border-color: var(--primary);
        }

        .legend-divider {
            border-top: 2px dashed var(--border-color);
            margin: 8px 0 16px 0;
        }

        .legend-block {
            margin-bottom: 14px;
            background: #fff;
            padding: 12px 16px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        .legend-heading {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }

        .legend-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 8px;
        }

        .legend-row:last-child {
            margin-bottom: 0;
        }

        .legend-swatch {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .legend-swatch.round {
            border-radius: 50%;
        }

        .legend-swatch.line {
            width: 22px;
            height: 4px;
            border-radius: 2px;
        }

        .panel-empty {
            font-size: 0.85rem;
            color: var(--text-mute);
            text-align: center;
            padding: 24px 10px;
        }

        .attr-box {
            background: #fff;
            padding: 14px;
            border-radius: 14px;
            margin-bottom: 10px;
            border: 1px solid var(--border-color);
        }

        .attr-label {
            font-size: 0.75rem;
            color: var(--text-mute);
            font-weight: 700;
            display: block;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .attr-val {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--secondary);
        }

        /* ===============================================================
           4. GAYA KARTU UNDUH PDF (LIST)
        =============================================================== */
        .pdf-download-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 36px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.08), 0 0 0 8px rgba(255, 255, 255, 0.4);
            margin-top: 40px;
        }

        .btn-download-item {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            padding: 14px 18px;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
        }

        .btn-download-item:hover {
            background: var(--primary-light);
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(5, 150, 105, 0.15);
        }

        .btn-download-item .file-title {
            font-weight: 700;
            color: var(--secondary);
            font-size: 0.95rem;
            margin-bottom: 2px;
            transition: color 0.3s ease;
        }

        .btn-download-item:hover .file-title {
            color: var(--primary-dark);
        }

        .btn-download-item .file-name {
            font-size: 0.75rem;
            color: var(--text-mute);
            font-family: monospace;
        }

        .btn-download-item .dl-icon {
            color: var(--primary);
            transition: transform 0.3s ease;
        }

        .btn-download-item:hover .dl-icon {
            transform: scale(1.2) translateY(2px);
        }

        /* ===============================================================
           5. VIDEO PROFIL
        =============================================================== */
        .video-profile-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 36px;
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.1), 0 0 0 10px rgba(255, 255, 255, 0.4);
            overflow: hidden;
        }

        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            border-radius: 16px;
            overflow: hidden;
            background-color: #000;
            border: 2px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* FOOTER */
        footer {
            background: var(--secondary);
            color: white;
            padding: 60px 0 25px 0;
            position: relative;
            z-index: 2;
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .footer-text {
            color: #94A3B8;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        @media (max-width: 991px) {
            .navbar-pill {
                padding: 10px 18px;
                width: 92%;
            }

            .nav-links {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- ANIMASI BACKGROUND SPASIAL & PARTIKEL DAUN MELAYANG ORGANIK -->
    <div class="spatial-grid-bg"></div>
    <div class="spatial-radar" id="radarBg"></div>

    <div class="particle-container" id="parallaxParticles">
        <!-- Glowing Orbs Background -->
        <i class="fa-solid fa-circle particle orb-1"></i>
        <i class="fa-solid fa-circle particle orb-2"></i>
        <i class="fa-solid fa-circle particle orb-3"></i>

        <!-- Floating Leaves Bergoyang -->
        <i class="fa-solid fa-leaf particle leaf-1"></i>
        <i class="fa-solid fa-leaf particle leaf-2"></i>
        <i class="fa-solid fa-leaf particle leaf-3"></i>
        <i class="fa-solid fa-leaf particle leaf-4"></i>
        <i class="fa-solid fa-leaf particle leaf-5"></i>
        <i class="fa-solid fa-seedling particle leaf-6"></i>
        <i class="fa-brands fa-envira particle leaf-7"></i>
        <i class="fa-solid fa-leaf particle leaf-8"></i>
    </div>

    <!-- NAVBAR -->
    <div class="navbar-wrapper">
        <nav class="navbar-pill" id="mainNav">
            <a href="#beranda" class="nav-brand"><i class="fa-solid fa-leaf text-success"></i> Dimajar 2</a>
            <ul class="nav-links d-none d-lg-flex">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#sekilas">Sekilas & Sejarah</a></li>
                <li><a href="#infografis">Infografis</a></li>
                <li><a href="#peta">Peta Interaktif</a></li>
            </ul>
            <a href="#peta" class="btn-nav text-decoration-none"><i class="fa-solid fa-map-location-dot me-1"></i>
                Peta Interaktif</a>
        </nav>
    </div>

    <!-- HERO SECTION -->
    <header id="beranda" class="hero-section">
        <img src="{{ asset('images/bg-landingpage.png') }}" class="hero-bg-img" alt="Latar Belakang Dimajar 2"
            onerror="this.style.display='none';">
        <div class="hero-overlay"></div>
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <div class="hero-pill floating-element"><i class="fa-solid fa-location-dot text-success"></i> SUMBERARUM,
                TEMPURAN</div>
            <h1 class="hero-title">Selamat Datang di<br><span
                    style="-webkit-text-stroke: 1px #1e293b; filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.4));">Dusun
                    Dimajar 2</span></h1>
            <p class="hero-lead">Eksplorasi potensi wilayah, keragaman demografi, dan infrastruktur dusun melalui sistem
                informasi geografis serta pemetaan spasial interaktif modern.</p>
            <a href="#peta" class="btn-hero">Jelajahi Melalui Peta Interaktif <i
                    class="fa-solid fa-paper-plane ms-1"></i></a>
        </div>
    </header>

    <!-- SECTION SEKILAS -->
    <section id="sekilas" class="section-padding" style="background-color: transparent;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="section-badge"><i class="fa-solid fa-circle-info me-1"></i> Sekilas & Profil</span>
                    <h2 class="section-title mb-4">Dari "Demakjar" Menjadi<br><span>Dimajar 2</span></h2>
                    <p class="mb-4" style="line-height: 1.8; font-size: 1.05rem;">Menurut cerita tutur masyarakat dan
                        sesepuh desa, nama Dimajar berakar dari kata <b>"Demakjar"</b>. Alkisah, pada masa lampau
                        seorang Sunan dari Demak pernah singgah di wilayah ini untuk menyebarkan syiar Islam dan
                        mendirikan sebuah masjid. Karena kebiasaan pelafalan masyarakat Jawa yang menyederhanakan
                        sebutan agar lebih mudah diucapkan, kata <i>"Demakjar"</i> lambat laun bertransformasi menjadi
                        <b>Dimajar</b>.</p>
                    <p style="line-height: 1.8; font-size: 1.05rem;">Seiring berjalannya waktu dan wilayahnya yang
                        semakin luas, kawasan ini dimekarkan menjadi tiga wilayah administrasi: Dimajar I, Dimajar II,
                        dan Dimajar III. Dusun Dimajar II sendiri tumbuh menjadi pedusunan yang asri di Kelurahan
                        Sumberarum, Kecamatan Tempuran, Kabupaten Magelang, dengan mayoritas warganya menggantungkan
                        hidup dari sektor pertanian yang subur dan harmonis.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
    <div class="about-image-wrapper floating-element">
        <video
            autoplay
            loop
            muted
            playsinline
            style="width: 100%; height: 100%; min-height: 380px; object-fit: cover; border-radius: 26px; display: block; pointer-events: none;"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <source src="{{ asset('videos/videowebgis.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung tag video ini.
        </video>
        <div class="text-center p-5 w-100 h-100 flex-column align-items-center justify-content-center" style="display: none;">
            <i class="fa-solid fa-video fs-1 mb-3 text-success"></i>
            <p class="mb-0 fw-semibold">Video Udara Dusun Dimajar 2<br><small class="text-muted">(Tambahkan file: public/videos/videowebgis.mp4)</small></p>
        </div>
    </div>
</div>
            </div>
        </div>
    </section>

    <!-- SECTION SEJARAH -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <span class="section-badge"><i class="fa-solid fa-monument me-1"></i> Jejak Langkah & Cagar
                    Budaya</span>
                <h2 class="section-title">Saksi Bisu Peradaban & <span>Arsitektur Tunggal</span></h2>
                <p class="text-muted mx-auto" style="max-width: 700px; font-size: 1.05rem;">Menelusuri peninggalan
                    situs bersejarah dan arsitektur kuno yang menjadi pusat kemaslahatan warga Dusun Dimajar 2.</p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="history-card spotlight-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="stat-icon m-0" style="width: 55px; height: 55px; font-size: 1.4rem;"><i
                                    class="fa-solid fa-mosque"></i></div>
                            <h4 class="mb-0 fw-bold">Masjid Al-Barokah</h4>
                        </div>
                        <p style="line-height: 1.7; font-size: 0.98rem; color: var(--text-main);">Di jantung Dusun
                            Dimajar II, berdiri <b>Masjid Al-Barokah</b> yang menjadi situs bersejarah sekaligus pusat
                            kemaslahatan warga. Pada awal masa berdirinya, masjid ini memiliki keunikan arsitektur yang
                            luar biasa, yaitu ditopang oleh hanya <b>1 (satu) tiang penyangga utama (<i>saka
                                    guru</i>)</b> yang berada tepat di tengah-tengah bangunan.</p>
                        <p class="mb-0" style="line-height: 1.7; font-size: 0.98rem; color: var(--text-main);">
                            Hingga kini, Masjid Al-Barokah telah mengalami berbagai tahap renovasi tanpa meninggalkan
                            nilai historisnya, dan terus aktif digunakan sebagai tempat peribadatan, menimba ilmu,
                            hingga musyawarah warga.</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
                    <div class="history-card spotlight-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="stat-icon m-0" style="width: 55px; height: 55px; font-size: 1.4rem;"><i
                                    class="fa-solid fa-gem"></i></div>
                            <h4 class="mb-0 fw-bold">Situs Batu Yoni (Umpak)</h4>
                        </div>
                        <p style="line-height: 1.7; font-size: 0.98rem; color: var(--text-main);">Sebagai bukti kuat
                            adanya persinggungan peradaban masa lampau, hingga saat ini masih tersimpan situs
                            peninggalan berupa <b>Batu Yoni</b> (umpak batu besar) yang terawat di pojok halaman masjid.
                        </p>
                        <p class="mb-0" style="line-height: 1.7; font-size: 0.98rem; color: var(--text-main);">
                            Meskipun catatan tertulis mengenai latar belakang kronologis Yoni ini masih minim informasi,
                            keberadaannya menjadi penanda kekayaan warisan arkeologis desa yang patut dijaga dan
                            dilestarikan oleh generasi penerus.</p>
                    </div>
                </div>
            </div>

            <!-- GALERI FOTO -->
            <div class="row g-4" data-aos="fade-up" data-aos-delay="200">
                <div class="col-md-4">
                    <div class="history-img-card">
                        <img src="{{ asset('images/masjid-albarokah.png') }}" alt="Masjid Al-Barokah"
                            onerror="this.style.display='none';">
                        <div class="history-img-label">Masjid Al-Barokah</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="history-img-card">
                        <img src="{{ asset('images/yoni-samping.jpeg') }}" alt="Batu Yoni Tampak Samping"
                            onerror="this.style.display='none';">
                        <div class="history-img-label">Situs Batu Yoni</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="history-img-card">
                        <img src="{{ asset('images/yoni-kecil.png') }}" alt="Batu Yoni Tampak Atas"
                            onerror="this.style.display='none';">
                        <div class="history-img-label">Situs Batu Yoni Kecil</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION INFOGRAFIS -->
    <section id="infografis" class="section-padding" style="background-color: transparent;">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <span class="section-badge"><i class="fa-solid fa-chart-pie me-1"></i> Infografis Spasial</span>
                <h2 class="section-title">Dimajar 2 <span>Dalam Angka</span></h2>
                <p class="text-muted mx-auto" style="max-width: 600px; font-size: 1.05rem;">Potret karakteristik fisik
                    dan sosial kemasyarakatan Dusun Dimajar 2 yang tercatat dalam pendataan spasial terbaru.</p>
            </div>

            <div class="row g-4 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="col-6 col-lg-3">
                    <div class="stat-card spotlight-card">
                        <div class="stat-icon mb-3"><i class="fa-solid fa-house-chimney fa-2x"
                                style="color: #059669;"></i></div>
                        <h3 class="stat-number">106</h3>
                        <h5 class="stat-label">Jumlah Bangunan</h5>
                        <p class="stat-desc">Total unit bangunan rumah tinggal, fasilitas umum, dan struktur fisik di
                            wilayah dusun.</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card spotlight-card">
                        <div class="stat-icon mb-3"><i class="fa-solid fa-people-roof fa-2x"
                                style="color: #059669;"></i></div>
                        <h3 class="stat-number">87</h3>
                        <h5 class="stat-label">Kepala Keluarga (KK)</h5>
                        <p class="stat-desc">Jumlah keluarga yang tercatat menetap dan berdomisili di Dusun Dimajar 2.
                        </p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card spotlight-card">
                        <div class="stat-icon mb-3"><i class="fa-solid fa-users fa-2x" style="color: #059669;"></i>
                        </div>
                        <h3 class="stat-number">283</h3>
                        <h5 class="stat-label">Total Warga</h5>
                        <p class="stat-desc">Keseluruhan jumlah jiwa penduduk dari berbagai macam kelompok usia dan
                            profesi.</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card spotlight-card">
                        <div class="stat-icon mb-3"><i class="fa-solid fa-sitemap fa-2x" style="color: #059669;"></i>
                        </div>
                        <h3 class="stat-number">2</h3>
                        <h5 class="stat-label">Rukun Tetangga (RT)</h5>
                        <p class="stat-desc">Pembagian wilayah administratif yang mengatur kerukunan dan kemasyarakatan
                            warga.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION FOKUS PEMETAAN -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <span class="section-badge"><i class="fa-solid fa-map-pin me-1"></i> Karakteristik Spasial</span>
                <h2 class="section-title">Fokus Pemetaan & Potensi <span>Dimajar 2</span></h2>
                <p class="text-muted mx-auto" style="max-width: 650px; font-size: 1.05rem;">Mengintegrasikan data
                    keruangan untuk mendukung pembangunan dusun yang terukur, partisipatif, dan berkelanjutan.</p>
            </div>

            <div class="timeline-container">
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content spotlight-card">
                        <div class="timeline-date" style="color: var(--primary);">Aspek Infrastruktur & Tata Ruang
                        </div>
                        <h4 class="timeline-title">Pemetaan Fasilitas & Permukiman</h4>
                        <p class="text-muted mb-0">Dusun Dimajar 2 terus berbenah dalam memetakan jaringan
                            infrastruktur, kelistrikan, sumber air bersih, serta sebaran hunian warga sebagai bagian
                            dari upaya peningkatan kesejahteraan hidup dan penataan lingkungan yang asri.</p>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content spotlight-card">
                        <div class="timeline-date" style="color: var(--primary);">Aspek Geografi & Topografi</div>
                        <h4 class="timeline-title">Karakteristik Elevasi & Lahan Pertanian</h4>
                        <p class="text-muted mb-0">Dengan topografi elevasi dan kemiringan lereng yang khas, wilayah
                            ini mengatur struktur permukiman dan lahan pertaniannya secara rapi, menjaga keseimbangan
                            antara aktivitas ekonomi warga dan kelestarian alam.</p>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content spotlight-card">
                        <div class="timeline-date" style="color: var(--primary);">Aspek Sosial & Cagar Budaya</div>
                        <h4 class="timeline-title">Pelestarian Warisan Sejarah</h4>
                        <p class="text-muted mb-0">Selain potensi alam, Dimajar 2 juga menjaga erat nilai historis dan
                            kerukunan warga melalui keberadaan Situs Arkeologi Batu Yoni serta Masjid Al-Barokah dengan
                            keunikan arsitektur tiang penyangga tunggalnya (saka guru).</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION KONSOL PETA INTERAKTIF & UNDUH PDF -->
    <section id="peta" class="section-padding" style="background-color: transparent;">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <span class="section-badge"><i class="fa-solid fa-earth-asia me-1"></i> Pemetaan Digital</span>
                <h2 class="section-title">Peta Tematik <span>Interaktif</span></h2>
                <p class="text-muted mx-auto" style="max-width: 600px; font-size: 1.05rem;">Aktifkan layer peta dasar
                    atau tematik terbaru di bawah ini, lalu klik objek di peta untuk melihat detail atributnya.</p>
            </div>

            <!-- Wrapper Peta Interaktif -->
            <div class="map-console-wrapper spotlight-card mb-5" data-aos="zoom-in" data-aos-duration="800">
                <div class="map-console-toolbar">
                    <h5 class="font-heading mb-0"><i class="fa-solid fa-map-location-dot text-success me-2"></i>Peta
                        Tematik Dusun</h5>

                    <button class="btn-panel-toggle d-lg-none ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#controlPanelCollapse">
                        <i class="fa-solid fa-sliders me-1"></i> Kontrol Layer
                        <span class="active-layer-count ms-1" id="activeCountBadge">2</span>
                    </button>
                </div>

                <div class="map-console-grid">
                    <div class="map-shell">
                        <div id="map"></div>
                        <div class="map-readout" id="readCoord">LAT: -7.55350 | LON: 110.16800</div>
                        <div class="map-epsg-badge">EPSG:4326</div>
                    </div>

                    <div class="collapse d-lg-block" id="controlPanelCollapse">
                        <div class="control-panel">

                            <!-- TAB NAVIGASI: Peta Dasar & Peta Tematik -->
                            <div class="panel-tabs">
                                <button class="panel-tab-btn active" data-tab="layer"
                                    onclick="showPanelTab('layer')">🗺️ Peta Dasar</button>
                                <button class="panel-tab-btn" data-tab="objek" onclick="showPanelTab('objek')">📊
                                    Peta Tematik</button>
                            </div>

                            <!-- KONTEN TAB 1: PETA DASAR -->
                            <div class="panel-pane" data-pane="layer" id="paneLayer">
                                <div class="quick-actions mb-3">
                                    <button type="button" class="btn-quick"
                                        onclick="setAllLayers(true, 'dasar')">Aktifkan Semua</button>
                                    <button type="button" class="btn-quick"
                                        onclick="setAllLayers(false, 'dasar')">Matikan Semua</button>
                                </div>

                                <!-- Daftar Layer Peta Dasar -->
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot"
                                            style="background:#FDE047"></span>Admin & RTRW</span>
                                    <div class="form-check form-switch mb-0"><input
                                            class="form-check-input layer-toggle layer-dasar" type="checkbox"
                                            data-layer="admin" id="chkAdmin"></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot"
                                            style="background:#16A34A"></span>Penutup Lahan (PL)</span>
                                    <div class="form-check form-switch mb-0"><input
                                            class="form-check-input layer-toggle layer-dasar" type="checkbox"
                                            data-layer="pl" id="chkPL"></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot"
                                            style="background:#EF4444"></span>Sarana & Prasarana</span>
                                    <div class="form-check form-switch mb-0"><input
                                            class="form-check-input layer-toggle layer-dasar" type="checkbox"
                                            data-layer="sarpras" id="chkSarpras"></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot"
                                            style="background:#475569"></span>Jaringan Jalan</span>
                                    <div class="form-check form-switch mb-0"><input
                                            class="form-check-input layer-toggle layer-dasar" type="checkbox"
                                            data-layer="jalan" id="chkJalan"></div>
                                </div>

                                <div class="legend-divider"></div>
                                <div id="legendContainerDasar">
                                    <p class="panel-empty">Legenda peta dasar akan muncul di sini.</p>
                                </div>
                            </div>

                            <!-- KONTEN TAB 2: PETA TEMATIK + DETAIL OBJEK -->
                            <div class="panel-pane d-none" data-pane="objek" id="paneObjek">
                                <div class="quick-actions mb-3">
                                    <button type="button" class="btn-quick"
                                        onclick="setAllLayers(true, 'tematik')">Aktifkan Semua</button>
                                    <button type="button" class="btn-quick"
                                        onclick="setAllLayers(false, 'tematik')">Matikan Semua</button>
                                </div>

                                <!-- Daftar Layer Tematik Persil Bangunan -->
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot"
                                            style="background:#F59E0B"></span>Daya Listrik</span>
                                    <div class="form-check form-switch mb-0"><input
                                            class="form-check-input layer-toggle layer-tematik" type="checkbox"
                                            data-layer="listrik" id="chkListrik" checked></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot"
                                            style="background:#3B82F6"></span>Jumlah Bekerja</span>
                                    <div class="form-check form-switch mb-0"><input
                                            class="form-check-input layer-toggle layer-tematik" type="checkbox"
                                            data-layer="pekerjaan" id="chkPekerjaan" checked></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot"
                                            style="background:#E11D48"></span>Kepadatan Hunian</span>
                                    <div class="form-check form-switch mb-0"><input
                                            class="form-check-input layer-toggle layer-tematik" type="checkbox"
                                            data-layer="hunian" id="chkHunian"></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot"
                                            style="background:#0891B2"></span>Sumber Air Bersih</span>
                                    <div class="form-check form-switch mb-0"><input
                                            class="form-check-input layer-toggle layer-tematik" type="checkbox"
                                            data-layer="air" id="chkAir"></div>
                                </div>
                                <div class="layer-item">
                                    <span class="layer-label"><span class="layer-dot"
                                            style="background:#16A34A"></span>Topografi & Lereng</span>
                                    <div class="form-check form-switch mb-0"><input
                                            class="form-check-input layer-toggle layer-tematik" type="checkbox"
                                            data-layer="topografi" id="chkTopografi"></div>
                                </div>

                                <div class="legend-divider"></div>
                                <div id="legendContainer">
                                    <p class="panel-empty">Legenda peta tematik akan muncul di sini.</p>
                                </div>

                                <div class="legend-divider" style="margin-top: 15px;"></div>

                                <!-- Panel Detail Objek digabungkan di bagian bawah tab ini -->
                                <h6 class="font-heading mb-2" style="font-size: 0.9rem; color: #1E293B;"><i
                                        class="fa-solid fa-circle-info me-1 text-primary"></i> Detail Atribut Persil
                                </h6>
                                <div id="objekContent">
                                    <p class="text-muted small mb-0 p-2 text-center"
                                        style="background: #F8FAFC; border-radius: 6px; border: 1px dashed #CBD5E1;">
                                        Silakan klik pada bidang poligon bangunan di peta untuk melihat detail
                                        atributnya.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- FITUR BARU: CARD UNDUH PETA CETAK (PDF) -->
            <div class="pdf-download-card spotlight-card" data-aos="fade-up">
                <div class="text-center mb-4">
                    <span class="section-badge"><i class="fa-solid fa-file-pdf me-1"></i> Pusat Unduhan</span>
                    <h3 class="font-heading" style="font-size: 1.6rem; font-weight: 800; color: var(--secondary);">
                        Unduh Peta Cetak (PDF)</h3>
                    <p class="text-muted mx-auto" style="max-width: 600px; font-size: 0.95rem;">Dapatkan dokumen peta
                        dasar dan peta tematik Dusun Dimajar 2 dalam format PDF resolusi tinggi (Ukuran A3 & A1).</p>
                </div>

                <div class="row g-4">
                    <!-- KOLOM 1: PETA DASAR & ADMINISTRASI -->
                    <div class="col-lg-6">
                        <h5 class="fw-bold mb-3 d-flex align-items-center gap-2"
                            style="color: var(--secondary); font-size: 1.1rem;">
                            <i class="fa-solid fa-layer-group text-primary"></i> Peta Dasar & Wilayah
                        </h5>
                        <div class="d-flex flex-column gap-3">
                            <a href="{{ asset('pdf/Peta A1 Dimajar 2.pdf') }}" class="btn-download-item" download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Administrasi Wilayah (A1)</div>
                                    <div class="file-name">Peta A1 Dimajar 2.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                            <a href="{{ asset('pdf/Peta Batas Adminitrasi RTRW.pdf') }}" class="btn-download-item"
                                download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Administrasi RT/RW</div>
                                    <div class="file-name">Peta Batas Adminitrasi RTRW.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                            <a href="{{ asset('pdf/Peta Foto Udara.pdf') }}" class="btn-download-item" download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Foto Udara (Citra)</div>
                                    <div class="file-name">Peta Foto Udara.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                            <a href="{{ asset('pdf/Peta Bangunan.pdf') }}" class="btn-download-item" download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Sebaran Bangunan</div>
                                    <div class="file-name">Peta Bangunan.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                            <a href="{{ asset('pdf/Peta Sarana Prasarana.pdf') }}" class="btn-download-item"
                                download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Sarana & Prasarana</div>
                                    <div class="file-name">Peta Sarana Prasarana.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                            <a href="{{ asset('pdf/Peta Penggunaan Lahan.pdf') }}" class="btn-download-item"
                                download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Penggunaan Lahan</div>
                                    <div class="file-name">Peta Penggunaan Lahan.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                        </div>
                    </div>

                    <!-- KOLOM 2: PETA TEMATIK / ANALISIS -->
                    <div class="col-lg-6">
                        <h5 class="fw-bold mb-3 d-flex align-items-center gap-2"
                            style="color: var(--secondary); font-size: 1.1rem;">
                            <i class="fa-solid fa-map text-success"></i> Peta Tematik & Analisis
                        </h5>
                        <div class="d-flex flex-column gap-3">
                            <a href="{{ asset('pdf/Peta Daya Listrik Bangunan.pdf') }}" class="btn-download-item"
                                download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Daya Listrik</div>
                                    <div class="file-name">Peta Daya Listrik Bangunan.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                            <a href="{{ asset('pdf/Peta Jumlah Anggota Keluarga Bekerja.pdf') }}"
                                class="btn-download-item" download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Jumlah Bekerja Warga</div>
                                    <div class="file-name">Peta Jumlah Anggota Keluarga Bekerja.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                            <a href="{{ asset('pdf/Peta Kepadatan Hunian.pdf') }}" class="btn-download-item"
                                download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Kepadatan Hunian</div>
                                    <div class="file-name">Peta Kepadatan Hunian.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                            <a href="{{ asset('pdf/Peta Sumber Air Rumah Tangga.pdf') }}" class="btn-download-item"
                                download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Sumber Air Bersih</div>
                                    <div class="file-name">Peta Sumber Air Rumah Tangga.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                            <a href="{{ asset('pdf/Peta Topografi.pdf') }}" class="btn-download-item" download>
                                <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                <div class="flex-grow-1">
                                    <div class="file-title">Peta Topografi & Lereng</div>
                                    <div class="file-name">Peta Topografi.pdf</div>
                                </div>
                                <i class="fa-solid fa-download dl-icon fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION VIDEO PROFIL -->
    <section id="video-profil" class="section-padding" style="background-color: transparent;">
        <div class="container">
            <div class="video-profile-wrapper" data-aos="fade-up">
                <div class="card profile-card spotlight-card">
                    <div class="card-body text-center p-4 p-md-5">
                        <span class="section-badge mb-3"><i class="fa-brands fa-youtube me-1"></i> Video Profil
                            Dusun</span>
                        <h3 class="card-title font-heading mb-3"
                            style="font-size: 1.8rem; font-weight: 800; color: var(--secondary);">Mengenal Lebih Dekat
                            Dimajar 2</h3>
                        <p class="card-text mb-4 text-muted mx-auto" style="max-width: 600px; font-size: 1.05rem;">
                            Saksikan tayangan profil singkat berikut untuk melihat keindahan alam, aktivitas warga, dan
                            potensi luar biasa yang dimiliki oleh Dusun Dimajar 2.</p>

                        <!-- Container Video Responsif -->
                        <div class="video-container">
                            <iframe src="https://www.youtube.com/embed/n-8HkMcfnKE" title="Video Profil Dimajar 2"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <a href="#" class="footer-brand"><i class="fa-solid fa-leaf text-success me-2"></i>Dimajar
                        2</a>
                    <p class="footer-text">Sistem Pemetaan Geospasial Interaktif Dusun Dimajar 2, Desa Sumberarum,
                        Kecamatan Tempuran, Kabupaten Magelang.</p>
                </div>
                <div class="col-lg-3">
                    <h5 class="text-white mb-3" style="font-size: 1.1rem; font-weight: 700;">Menu Cepat</h5>
                    <ul class="list-unstyled footer-text">
                        <li class="mb-2"><a href="#beranda" class="text-decoration-none text-reset">Beranda
                                Depan</a></li>
                        <li class="mb-2"><a href="#sekilas" class="text-decoration-none text-reset">Sekilas &
                                Sejarah</a></li>
                        <li class="mb-2"><a href="#infografis" class="text-decoration-none text-reset">Data
                                Infografis</a></li>
                        <li class="mb-2"><a href="#peta" class="text-decoration-none text-reset">Konsol Peta
                                Interaktif</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-3" style="font-size: 1.1rem; font-weight: 700;">Teknologi Spesifikasi
                    </h5>
                    <p class="footer-text mb-1"><i class="fa-solid fa-database text-success me-2"></i> PostGIS /
                        PostgreSQL Spatial</p>
                    <p class="footer-text mb-1"><i class="fa-brands fa-laravel text-danger me-2"></i> Laravel
                        Framework PHP</p>
                    <p class="footer-text mb-0"><i class="fa-solid fa-map text-primary me-2"></i> Leaflet JS Mapping
                        Engine</p>
                </div>
            </div>
            <div class="text-center mt-5 pt-4 border-top"
                style="border-color: rgba(255,255,255,0.1) !important; color: #64748B; font-size: 0.85rem;">
                &copy; {{ date('Y') }} Developed by <b class="text-white">Kelompok PKL 2 C2 Dimajar 2</b> | Sistem
                Informasi Geografis Universitas Gadjah Mada. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 800
        });

        // ---------------------------------------------------------------
        // 1. NAVBAR & PARALLAX BACKGROUND
        // ---------------------------------------------------------------
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNav');
            const scrolled = window.scrollY;

            if (scrolled > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');

            const parallaxContainer = document.getElementById('parallaxParticles');
            const radarBg = document.getElementById('radarBg');
            if (parallaxContainer) parallaxContainer.style.transform = `translateY(${scrolled * 0.2}px)`;
            if (radarBg) radarBg.style.marginTop = `${scrolled * 0.15}px`;
        });

        // ---------------------------------------------------------------
        // 2. ANIMASI BARU: COUNT UP NUMBER (ANGKA BERJALAN)
        // ---------------------------------------------------------------
        const countObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.innerText, 10);
                    if (isNaN(target)) return;

                    let count = 0;
                    const duration = 1800;
                    const increment = target / (duration / 16);

                    const updateCount = () => {
                        count += increment;
                        if (count < target) {
                            el.innerText = Math.ceil(count);
                            requestAnimationFrame(updateCount);
                        } else {
                            el.innerText = target;
                        }
                    };
                    el.innerText = '0';
                    updateCount();
                    observer.unobserve(el);
                }
            });
        }, {
            threshold: 0.6
        });

        document.querySelectorAll('.stat-number').forEach(c => countObserver.observe(c));

        // ---------------------------------------------------------------
        // 3. ANIMASI BARU: 3D TILT EFFECT & SPOTLIGHT GLOW
        // ---------------------------------------------------------------
        document.querySelectorAll('.spotlight-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);

                if (card.classList.contains('history-card') || card.classList.contains('stat-card')) {
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = ((y - centerY) / centerY) * -8;
                    const rotateY = ((x - centerX) / centerX) * 8;
                    card.style.transform =
                        `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px) scale(1.02)`;
                }
            });

            card.addEventListener('mouseleave', () => {
                if (card.classList.contains('history-card') || card.classList.contains('stat-card')) {
                    card.style.transform =
                        'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px) scale(1)';
                }
            });
        });

        // ---------------------------------------------------------------
        // 4. INISIALISASI PETA LEAFLET (FOKUS KE TEMPURAN MAGELANG)
        // ---------------------------------------------------------------
        var map = L.map('map', {
            center: [-7.55350, 110.16800], // Telah disesuaikan tepat ke wilayah Tempuran, Magelang
            zoom: 16.5,
            zoomControl: false
        });
        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        var googleSat = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google'
        });
        googleSat.addTo(map);

        var readCoord = document.getElementById('readCoord');
        if (readCoord) {
            map.on('mousemove', function(e) {
                readCoord.textContent = `LAT: ${e.latlng.lat.toFixed(5)} | LON: ${e.latlng.lng.toFixed(5)}`;
            });
        }

        // ---------------------------------------------------------------
        // 5. DEFINISI GROUP LAYER (DASAR & TEMATIK)
        // ---------------------------------------------------------------
        // Peta Dasar
        var layerAdmin = L.layerGroup();
        var layerPL = L.layerGroup();
        var layerSarpras = L.layerGroup();
        var layerJalan = L.layerGroup();

        // Peta Tematik
        var layerListrik = L.layerGroup().addTo(map); // Checked default
        var layerPekerjaan = L.layerGroup().addTo(map); // Checked default
        var layerHunian = L.layerGroup();
        var layerAir = L.layerGroup();
        var layerTopografi = L.layerGroup();

        // [PERBAIKAN 2]: Ditambahkan tanda koma (,) setelah air: layerAir
        var layerGroups = {
            admin: layerAdmin,
            pl: layerPL,
            sarpras: layerSarpras,
            jalan: layerJalan,
            listrik: layerListrik,
            pekerjaan: layerPekerjaan,
            hunian: layerHunian,
            air: layerAir,
            topografi: layerTopografi
        };

        // ---------------------------------------------------------------
        // 6. KONFIGURASI LEGENDA & WARNA
        // ---------------------------------------------------------------
        var layerConfig = {
            // Peta Dasar
            admin: {
                label: '🗺️ Batas Admin & RTRW',
                swatchType: 'square',
                legend: [{
                        c: '#F97316',
                        l: 'RT 002 / RW 015 (Bagian Atas)'
                    },
                    {
                        c: '#3B82F6',
                        l: 'RT 001 / RW 015 (Bagian Bawah)'
                    },
                    {
                        c: '#475569',
                        l: 'Garis Batas Administrasi'
                    }
                ]
            },
            pl: {
                label: '🌱 Penutup & Penggunaan Lahan (PL)',
                swatchType: 'square',
                legend: [
                    // --- KELOMPOK TERBANGUN ---
                    {
                        c: '#E879F9',
                        l: 'Bangunan Gedung'
                    },
                    {
                        c: '#DEB887',
                        l: 'Olahraga'
                    },
                    {
                        c: '#94A3B8',
                        l: 'Transportasi'
                    },
                    {
                        c: '#7DD3FC',
                        l: 'Perikanan Air Tawar'
                    },
                    {
                        c: '#B45309',
                        l: 'Peternakan'
                    },
                    {
                        c: '#FCA5A5',
                        l: 'Tempat Tinggal'
                    },
                    {
                        c: '#D4C4A8',
                        l: 'Pendidikan'
                    },
                    {
                        c: '#FBCFE8',
                        l: 'Perdagangan dan Jasa'
                    },
                    {
                        c: '#FB923C',
                        l: 'Industri dan Pergudangan'
                    },
                    {
                        c: '#A855F7',
                        l: 'Peribadatan'
                    },
                    // --- KELOMPOK NON-TERBANGUN ---
                    {
                        c: '#BBF7D0',
                        l: 'Perkebunan / Pekarangan'
                    },
                    {
                        c: '#BAE6FD',
                        l: 'Sawah / Tubuh Air'
                    },
                    {
                        c: '#FEF08A',
                        l: 'Tegalan / Ladang'
                    },
                    {
                        c: '#4ADE80',
                        l: 'Kebun Campur / Semak Belukar'
                    },
                    {
                        c: '#FFFFFF',
                        l: 'Lahan Terbuka (Tanah Kosong)'
                    }
                ]
            },
            sarpras: {
                label: '🏛️ Sarana & Prasarana',
                swatchType: 'icon-circle',
                legend: [{
                        l: 'Pendidikan dasar',
                        icon: 'fa-solid fa-book-open',
                        iconColor: '#EF4444'
                    },
                    {
                        l: 'Pendidikan Taman Kanak-kanak',
                        icon: 'fa-solid fa-book-open',
                        iconColor: '#F97316'
                    },
                    {
                        l: 'Pendidikan Agama',
                        icon: 'fa-solid fa-book-open',
                        iconColor: '#22C55E'
                    },
                    {
                        l: 'Industri kecil / rumah tangga / UMKM',
                        icon: 'fa-solid fa-store',
                        iconColor: '#000000'
                    },
                    {
                        l: 'Masjid / Mushola',
                        icon: 'fa-solid fa-mosque',
                        iconColor: '#000000'
                    },
                    {
                        l: 'Pabrik',
                        icon: 'fa-solid fa-industry',
                        iconColor: '#000000'
                    }
                ]
            },
            jalan: {
                label: '🛣️ Jaringan Jalan',
                swatchType: 'line',
                legend: [{
                    c: '#F97316',
                    l: 'Jalan Dusun / Transportasi'
                }]
            },

            // Peta Tematik
            listrik: {
                label: '⚡ Daya Listrik',
                swatchType: 'square',
                legend: [{
                        c: '#B0B0B0',
                        l: 'Tidak Teridentifikasi'
                    },
                    {
                        c: '#FFA07A',
                        l: 'Rumah Kosong'
                    },
                    {
                        c: '#E0B0FF',
                        l: '450 VA'
                    },
                    {
                        c: '#9966CC',
                        l: '900 VA'
                    },
                    {
                        c: '#4B0082',
                        l: '1300 VA'
                    }
                ]
            },
            pekerjaan: {
                label: '💼 Jumlah Anggota Bekerja',
                swatchType: 'square',
                legend: [{
                        c: '#B0B0B0',
                        l: 'Bangunan Lainnya'
                    },
                    {
                        c: '#FFA07A',
                        l: 'Rumah Kosong'
                    },
                    {
                        c: '#FFFACD',
                        l: 'Tidak Bekerja'
                    },
                    {
                        c: '#A9DFBF',
                        l: '1 Orang'
                    },
                    {
                        c: '#58D68D',
                        l: '2 Orang'
                    },
                    {
                        c: '#1E8449',
                        l: '3 Orang'
                    }
                ]
            },
            hunian: {
                label: '👨‍👩‍👧‍👦 Kepadatan Hunian (Anggota Keluarga)',
                swatchType: 'square',
                legend: [{
                        c: '#B0B0B0',
                        l: 'Bangunan Lainnya'
                    },
                    {
                        c: '#FFFACD',
                        l: 'Rumah Kosong'
                    },
                    {
                        c: '#FCD34D',
                        l: '1 - 2 Jiwa'
                    },
                    {
                        c: '#F97316',
                        l: '3 - 4 Jiwa'
                    },
                    {
                        c: '#EA580C',
                        l: '5 - 6 Jiwa'
                    },
                    {
                        c: '#8B4513',
                        l: '7 - 8 Jiwa'
                    }
                ]
            },
            air: {
                label: '💧 Sumber Air Bersih',
                swatchType: 'square',
                legend: [{
                        c: '#B0B0B0',
                        l: 'Tidak Teridentifikasi/Bangunan Lainnya'
                    },
                    {
                        c: '#FFA07A',
                        l: 'Rumah Kosong'
                    },
                    {
                        c: '#CCEEFF',
                        l: 'Sumur Gali'
                    },
                    {
                        c: '#00A8E8',
                        l: 'Sumur Bor'
                    },
                    {
                        c: '#002266',
                        l: 'Sungai'
                    }
                ]
            },
            topografi: {
                label: '⛰️ Elevasi Topografi (mdpl)',
                swatchType: 'square',
                legend: [{
                        c: '#1E8449',
                        l: '255 - 264 mdpl (Terendah)'
                    },
                    {
                        c: '#58D68D',
                        l: '264 - 269 mdpl (Dataran Rendah)'
                    },
                    {
                        c: '#FACC15',
                        l: '269 - 273 mdpl (Dataran Sedang)'
                    },
                    {
                        c: '#F97316',
                        l: '273 - 276 mdpl (Dataran Tinggi)'
                    },
                    {
                        c: '#DC2626',
                        l: '276 - 282 mdpl (Tertinggi)'
                    }
                ]
            }
        };

        function updateObjekPanel(title, subtitle, htmlContent) {
            const objekContent = document.getElementById('objekContent');
            if (!objekContent) return;

            objekContent.innerHTML = `
                <div class="mb-2"><span class="legend-heading" style="margin:0;">${subtitle}</span></div>
                <h6 class="fw-bold mb-3" style="color:var(--secondary);">${title}</h6>
                ${htmlContent}
            `;
            // Buka tab tematik (objek) dan scroll halus ke panel info
            showPanelTab('objek');
            objekContent.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }

        // FUNGSI KHUSUS AGAR PETA OTOMATIS BERGESER & NGE-ZOOM TEPAT KE DATA DUSUN DIMAJAR 2
        let hasAutoZoomed = false;

        function autoFocusToData(layer) {
            if (!hasAutoZoomed && layer && layer.getBounds && layer.getBounds().isValid()) {
                map.fitBounds(layer.getBounds(), {
                    padding: [40, 40],
                    maxZoom: 18
                });
                hasAutoZoomed = true;
            }
        }

        // ---------------------------------------------------------------
        // 7. PEMANGGILAN DATA GEOJSON VIA FETCH API (PETA DASAR & TEMATIK)
        // ---------------------------------------------------------------

        // --- PETA DASAR ---
        // 1. Admin & RTRW
        fetch('/geojson/admin_RTRW.geojson').then(res => res.json()).then(data => {
            let urutanPoligon = 0; // Penghitung cadangan jika atribut GIS kosong

            L.geoJSON(data, {
                style: function(feature) {
                    let props = feature.properties || {};
                    let allPropsString = JSON.stringify(props).toUpperCase();

                    // 1. Cek dari teks atribut (mendukung format angka tunggal "1" dan "2")
                    let isRT1 = allPropsString.includes("001") ||
                        allPropsString.includes("01") ||
                        allPropsString.includes(":1,") ||
                        allPropsString.includes(": 1,") ||
                        allPropsString.includes('"1"') ||
                        allPropsString.includes("BAWAH") ||
                        allPropsString.includes("SELATAN");

                    let isRT2 = allPropsString.includes("002") ||
                        allPropsString.includes("02") ||
                        allPropsString.includes(":2,") ||
                        allPropsString.includes(": 2,") ||
                        allPropsString.includes('"2"') ||
                        allPropsString.includes("ATAS") ||
                        allPropsString.includes("UTARA");

                    // 2. JURUS PAMUNGKAS: Jika atribut kosong/tidak terdeteksi, bagi warna berdasarkan urutan poligon
                    if (!isRT1 && !isRT2) {
                        if (urutanPoligon === 0) {
                            isRT2 = true; // Poligon pertama otomatis jadi RT 002 (Atas - Oranye)
                        } else {
                            isRT1 = true; // Poligon kedua otomatis jadi RT 001 (Bawah - Biru)
                        }
                    }
                    urutanPoligon++;

                    // Penentuan Warna Sesuai Legenda
                    let fillColor = "#FACC15"; // Kuning (default)
                    let strokeColor = "#CA8A04";

                    if (isRT2) {
                        fillColor = "#F97316"; // Oranye Terang (RT 002 / Bagian Atas)
                        strokeColor = "#C2410C"; // Garis Oranye Tua
                    } else if (isRT1) {
                        fillColor = "#3B82F6"; // Biru Elektrik (RT 001 / Bagian Bawah)
                        strokeColor = "#1D4ED8"; // Garis Biru Tua
                    }

                    return {
                        color: strokeColor,
                        weight: 3.5,
                        dashArray: '8, 6',
                        fillColor: fillColor,
                        fillOpacity: 0.70
                    };
                },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function(e) {
                        L.DomEvent.stopPropagation(e);
                        let p = feature.properties || {};

                        // Cari nama RT otomatis, jika kosong ambil dari warna poligonnya
                        let namaRt = p.RT || p.rt || p.NAME || p.Name || p.WADMRT || p
                            .keterangan || p.REMARK;
                        if (!namaRt || namaRt === "null") {
                            let color = layer.options.fillColor;
                            namaRt = (color === "#F97316") ? "RT 002 (Bagian Atas)" :
                                "RT 001 (Bagian Bawah)";
                        }
                        let namaRw = p.RW || p.rw || p.WADMRW || "RW 015";

                        updateObjekPanel("Batas Administrasi", "TEMA ADMIN & RTRW",
                            `<div class="attr-box">
                                <span class="attr-label">Wilayah Administrasi</span>
                                <span class="attr-val" style="color:#1D4ED8; font-weight:bold;">${namaRt} / ${namaRw}</span>
                             </div>
                             <div class="attr-box">
                                <span class="attr-label">Dusun / Desa</span>
                                <span class="attr-val">Dusun Dimajar 2, Desa Sumberarum</span>
                             </div>`);
                        map.flyTo(e.latlng, 17.5, {
                            animate: true,
                            duration: 1
                        });
                    });
                }
            }).addTo(layerAdmin);
        }).catch(e => console.warn("File admin_RTRW.geojson gagal dimuat:", e));

        // 2. Penutup Lahan (PL)
        fetch('/geojson/PL_merge_dimajar.geojson').then(res => res.json()).then(data => {
            L.geoJSON(data, {
                style: function(feature) {
                    let props = feature.properties || {};
                    // Menggabungkan semua value atribut dan mengubahnya ke huruf besar untuk pencarian presisi
                    let allProps = JSON.stringify(props).toUpperCase();

                    // WARNA DEFAULT: Hijau Muda (Perkebunan) agar area yang tidak teridentifikasi tetap asri
                    let fillColor = "#BBF7D0";
                    let fillOpacity = 0.75;

                    // ==========================================
                    // --- KELOMPOK NON-TERBANGUN (VEGETASI & AIR) ---
                    // ==========================================
                    // 1. Sawah / Tubuh Air (Sisi Kiri Peta - Biru Irigasi)
                    if (allProps.includes("SAWAH") || allProps.includes("PADI") || allProps.includes(
                            "AIR") || allProps.includes("IRIGASI") || allProps.includes("RWA")) {
                        fillColor = "#BAE6FD"; // Biru Cyan Lembut (persis warna sawah di referensi)
                    }
                    // 2. Kebun Campur / Semak Belukar / Vegetasi Lebat (Hijau Sedang/Gelap di Tengah & Selatan)
                    else if (allProps.includes("CAMPUR") || allProps.includes("SEMAK") || allProps
                        .includes("BELUKAR") || allProps.includes("HUTAN") || allProps.includes(
                        "LEBAT") || allProps.includes("MIXED")) {
                        fillColor = "#4ADE80"; // Hijau Daun Sedang
                    }
                    // 3. Tegalan / Ladang / Tanah Kering (Bercak Kuning di Atas & Kanan)
                    else if (allProps.includes("TEGAL") || allProps.includes("LADANG") || allProps
                        .includes("KERING") || allProps.includes("JAGUNG") || allProps.includes(
                            "PALAWIJA")) {
                        fillColor = "#FEF08A"; // Kuning Soft
                    }
                    // 4. Perkebunan / Pekarangan / Vegetasi Non-Budidaya (Dominasi Hijau Muda/Kekuningan)
                    else if (allProps.includes("KEBUN") || allProps.includes("PERKEBUNAN") || allProps
                        .includes("PEKARANGAN") || allProps.includes("VEGETASI") || allProps.includes(
                            "RUMPUT") || allProps.includes("GARDEN")) {
                        fillColor = "#BBF7D0"; // Hijau Muda Pastel (Dominan di bagian kanan/utara)
                    }
                    // 5. Lahan Terbuka / Tanah Kosong (Bercak Putih)
                    else if (allProps.includes("TERBUKA") || allProps.includes("KOSONG") || allProps
                        .includes("TANAH") || allProps.includes("BARE")) {
                        fillColor = "#FFFFFF"; // Putih Bersih
                    }

                    // ==========================================
                    // --- KELOMPOK TERBANGUN (BANGUNAN & FASILITAS) ---
                    // ==========================================
                    // 6. Tempat Tinggal / Permukiman (Mayoritas Bangunan - Merah Muda/Salmon)
                    else if (allProps.includes("TINGGAL") || allProps.includes("MUKIM") || allProps
                        .includes("RUMAH") || allProps.includes("PEMUKIMAN") || allProps.includes(
                            "RESIDENTIAL")) {
                        fillColor = "#FCA5A5"; // Salmon Pink
                    }
                    // 7. Bangunan Gedung / Fasilitas Umum (Balai/Gedung - Magenta Terang)
                    else if (allProps.includes("GEDUNG") || allProps.includes("BANGUNAN") || allProps
                        .includes("KANTOR") || allProps.includes("BALAI") || allProps.includes(
                            "BUILDING")) {
                        fillColor = "#E879F9"; // Magenta / Pink Menyala
                    }
                    // 8. Peribadatan (Masjid/Mushola - Ungu)
                    else if (allProps.includes("IBADAH") || allProps.includes("PERIBADATAN") || allProps
                        .includes("MASJID") || allProps.includes("MUSHOLA") || allProps.includes(
                            "GEREJA")) {
                        fillColor = "#A855F7"; // Ungu
                    }
                    // 9. Pendidikan (Sekolah - Cokelat Krem/Beige)
                    else if (allProps.includes("DIDIK") || allProps.includes("PENDIDIKAN") || allProps
                        .includes("SEKOLAH") || allProps.includes("PAUD") || allProps.includes("TK") ||
                        allProps.includes("SD")) {
                        fillColor = "#D4C4A8"; // Cokelat Krem
                    }
                    // 10. Perdagangan dan Jasa (Toko/Warung - Pink Muda)
                    else if (allProps.includes("DAGANG") || allProps.includes("JASA") || allProps
                        .includes("TOKO") || allProps.includes("WARUNG") || allProps.includes(
                        "PASAR") || allProps.includes("COMMERCIAL")) {
                        fillColor = "#FBCFE8"; // Pink Pastel
                    }
                    // 11. Industri & Pergudangan (Pabrik/Gudang - Oranye)
                    else if (allProps.includes("INDUSTRI") || allProps.includes("GUDANG") || allProps
                        .includes("PABRIK") || allProps.includes("PERGUDANGAN") || allProps.includes(
                            "INDUSTRIAL")) {
                        fillColor = "#FB923C"; // Oranye Terang
                    }
                    // 12. Olahraga / Lapangan (Cokelat Muda / Burlywood)
                    else if (allProps.includes("RAGA") || allProps.includes("OLAHRAGA") || allProps
                        .includes("LAPANGAN") || allProps.includes("SPORT")) {
                        fillColor = "#DEB887"; // Burlywood
                    }
                    // 13. Transportasi / Jalan (Abu-abu Slate)
                    else if (allProps.includes("JALAN") || allProps.includes("TRANSPORTASI") || allProps
                        .includes("ASPAL") || allProps.includes("PARKIR")) {
                        fillColor = "#94A3B8"; // Abu-abu Jalan
                    }
                    // 14. Perikanan Air Tawar / Kolam (Biru Air)
                    else if (allProps.includes("IKAN") || allProps.includes("PERIKANAN") || allProps
                        .includes("KOLAM") || allProps.includes("TAMBAK")) {
                        fillColor = "#7DD3FC"; // Biru Kolam
                    }
                    // 15. Peternakan / Kandang (Cokelat Emas)
                    else if (allProps.includes("TERNAK") || allProps.includes("PETERNAKAN") || allProps
                        .includes("KANDANG") || allProps.includes("AYAM") || allProps.includes("SAPI")
                        ) {
                        fillColor = "#B45309"; // Cokelat Olive
                    }

                    return {
                        color: "#64748B", // Warna garis batas antar persil (abu-abu gelap tipis persis di peta referensi)
                        weight: 0.5, // Ketebalan 0.5px agar garis tidak menutupi warna poligon
                        fillColor: fillColor,
                        fillOpacity: fillOpacity
                    };
                },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function(e) {
                        L.DomEvent.stopPropagation(e);
                        let p = feature.properties || {};

                        // Deteksi otomatis kolom nama penggunaan lahan
                        let jenisPl = p.REMARK || p.keterangan || p.PL || p.Penggunaan || p
                            .NAME || p.Name || p.LEGEND || p.LandUse || p.JENIS ||
                            "Penggunaan Lahan";

                        updateObjekPanel("Penutup & Penggunaan Lahan", "TEMA PENGGUNAAN LAHAN",
                            `<div class="attr-box">
                                <span class="attr-label">Jenis Penggunaan Lahan</span>
                                <span class="attr-val" style="color:#16A34A; font-weight:bold;">${jenisPl}</span>
                             </div>
                             <div class="attr-box">
                                <span class="attr-label">Dusun / Desa</span>
                                <span class="attr-val">Dusun Dimajar 2, Desa Sumberarum</span>
                             </div>`);
                        map.flyTo(e.latlng, 18, {
                            animate: true,
                            duration: 1
                        });
                    });
                }
            }).addTo(layerPL);
        }).catch(e => console.warn("File PL_merge_dimajar.geojson gagal dimuat:", e));

        // 3. Sarana Prasarana
        fetch('/geojson/sarana_prasarana.geojson').then(res => res.json()).then(data => {
            L.geoJSON(data, {
                pointToLayer: function(f, latlng) {
                    let props = f.properties || {};
                    let allProps = JSON.stringify(props).toUpperCase();

                    // Pengaturan default (jika kategori tidak teridentifikasi)
                    let iconClass = "fa-solid fa-building";
                    let iconColor = "#64748B"; // Abu-abu default

                    // Klasifikasi 1: Pendidikan Dasar (SD/MI/Sederajat - Buku Merah)
                    if (allProps.includes("SD") || allProps.includes("DASAR") || allProps.includes(
                        "MI") || allProps.includes("NEGERI") || allProps.includes("PRIMARY")) {
                        iconClass = "fa-solid fa-book-open";
                        iconColor = "#EF4444"; // Merah
                    }
                    // Klasifikasi 2: Pendidikan Taman Kanak-kanak (TK/PAUD/KB - Buku Oranye)
                    else if (allProps.includes("TK") || allProps.includes("PAUD") || allProps.includes(
                            "KANAK") || allProps.includes("TUNAS") || allProps.includes(
                        "KINDERGARTEN")) {
                        iconClass = "fa-solid fa-book-open";
                        iconColor = "#F97316"; // Oranye
                    }
                    // Klasifikasi 3: Pendidikan Agama (Madrasah/Diniyah/TPA - Buku Hijau)
                    else if (allProps.includes("AGAMA") || allProps.includes("MADRASAH") || allProps
                        .includes("DINIYAH") || allProps.includes("TPA") || allProps.includes("TPQ") ||
                        allProps.includes("PONDOK")) {
                        iconClass = "fa-solid fa-book-open";
                        iconColor = "#22C55E"; // Hijau
                    }
                    // Klasifikasi 4: Industri Kecil / Rumah Tangga / UMKM (Keranjang/Toko - Hitam)
                    else if (allProps.includes("UMKM") || allProps.includes("KECIL") || allProps
                        .includes("RUMAH TANGGA") || allProps.includes("TOKO") || allProps.includes(
                            "WARUNG") || allProps.includes("KERAJINAN")) {
                        iconClass = "fa-solid fa-store"; // Atau bisa ganti 'fa-shopping-basket'
                        iconColor = "#000000"; // Hitam
                    }
                    // Klasifikasi 5: Masjid / Mushola (Kubah/Masjid - Hitam)
                    else if (allProps.includes("MASJID") || allProps.includes("MUSHOLA") || allProps
                        .includes("SURAU") || allProps.includes("IBADAH")) {
                        iconClass = "fa-solid fa-mosque";
                        iconColor = "#000000"; // Hitam
                    }
                    // Klasifikasi 6: Pabrik / Industri Besar (Pabrik - Hitam)
                    else if (allProps.includes("PABRIK") || allProps.includes("INDUSTRI") || allProps
                        .includes("PT") || allProps.includes("CV") || allProps.includes("MANUFAKTUR") ||
                        allProps.includes("PAPERBAG")) {
                        iconClass = "fa-solid fa-industry";
                        iconColor = "#000000"; // Hitam
                    }

                    // Membuat kustom ikon HTML menyerupai legenda (Lingkaran bergaris hitam)
                    let customIcon = L.divIcon({
                        className: 'custom-sarpras-icon',
                        html: `<div style="
                                    width: 26px;
                                    height: 26px;
                                    background-color: #FFFFFF;
                                    border: 2px solid #000000;
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    box-shadow: 0 2px 4px rgba(0,0,0,0.3);
                                ">
                                    <i class="${iconClass}" style="color: ${iconColor}; font-size: 12px;"></i>
                               </div>`,
                        iconSize: [26, 26],
                        iconAnchor: [13,
                        13], // Titik tengah ikon tepat berada di atas koordinat lokasi
                        popupAnchor: [0, -13]
                    });

                    return L.marker(latlng, {
                        icon: customIcon
                    });
                },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function(e) {
                        L.DomEvent.stopPropagation(e);
                        let p = feature.properties || {};

                        let namaSarpras = p.REMARK || p.NAME || p.Name || p.NAMA || p
                            .keterangan || p.FASILITAS || "Fasilitas Umum";
                        let kategori = p.KATEGORI || p.JENIS || p.TYPE || "Sarana & Prasarana";

                        updateObjekPanel("Sarana & Prasarana", "TEMA FASILITAS UMUM",
                            `<div class="attr-box">
                                <span class="attr-label">Nama Fasilitas</span>
                                <span class="attr-val" style="color:#0F172A; font-weight:bold;">${namaSarpras}</span>
                             </div>
                             <div class="attr-box">
                                <span class="attr-label">Kategori / Jenis</span>
                                <span class="attr-val" style="color:#475569;">${kategori}</span>
                             </div>
                             <div class="attr-box">
                                <span class="attr-label">Lokasi</span>
                                <span class="attr-val">Dusun Dimajar 2, Desa Sumberarum</span>
                             </div>`);
                        map.flyTo(e.latlng, 18.5, {
                            animate: true,
                            duration: 1
                        });
                    });
                }
            }).addTo(layerSarpras);
        }).catch(e => console.warn("File sarana_prasarana.geojson gagal dimuat:", e));

        // 4. Jaringan Jalan
        fetch('/geojson/jaringan_jalan.geojson').then(res => res.json()).then(data => {
            L.geoJSON(data, {
                style: {
                    color: "#F97316",
                    weight: 2.5,
                    opacity: 0.8
                }
            }).addTo(layerJalan);
        }).catch(e => console.warn("File jaringan_jalan.geojson gagal dimuat:", e));

        // --- PETA TEMATIK ---
        // A. LAYER DAYA LISTRIK (data-layer="listrik")
        fetch('/geojson/persil_daya_listrik.geojson').then(res => res.json()).then(data => {
            let geoLayer = L.geoJSON(data, {
                style: function(feature) {
                    let props = feature.properties;
                    let va = parseInt(props.DAYA_LISTRIK || props.daya_listrik) || 0;
                    let fungsi = (props.FUNGSI || props.fungsi || props.KETERANGAN || props
                        .keterangan || '').toUpperCase();
                    let color = "#B0B0B0"; // Default: Abu-abu (TIDAK TERIDENTIFIKASI)

                    if (fungsi.includes("KOSONG")) {
                        color = "#FFA07A"; // Light Salmon / Orange Muda (RUMAH KOSONG)
                    } else if (va === 450) {
                        color = "#E0B0FF"; // Ungu Muda / Mauve (450 VA)
                    } else if (va === 900) {
                        color = "#9966CC"; // Ungu Sedang / Amethyst (900 VA)
                    } else if (va >= 1300) {
                        color = "#4B0082"; // Ungu Gelap / Indigo (1300 VA ke atas)
                    } else if (va === 0) {
                        color = "#B0B0B0"; // Abu-abu (TIDAK TERIDENTIFIKASI)
                    }

                    return {
                        fillColor: color,
                        color: "#555555",
                        weight: 0.8,
                        fillOpacity: 0.85
                    };
                },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function(e) {
                        L.DomEvent.stopPropagation(e);
                        let p = feature.properties;
                        let dayaTeks = (p.DAYA_LISTRIK || p.daya_listrik) ?
                            `${p.DAYA_LISTRIK || p.daya_listrik} VA` : 'Tidak Teridentifikasi';

                        updateObjekPanel(`Persil Bangunan #${p.OBJECTID || p.id || '-'}`,
                            "TEMA DAYA LISTRIK",
                            `<div class="attr-box">
                                <span class="attr-label">Daya Terpasang</span>
                                <span class="attr-val" style="color:#9966CC; font-weight:bold;">${dayaTeks}</span>
                             </div>
                             <div class="attr-box">
                                <span class="attr-label">Fungsi / Status Bangunan</span>
                                <span class="attr-val">${p.FUNGSI || p.fungsi || p.KETERANGAN || 'Rumah Tinggal'}</span>
                             </div>`);
                        map.flyTo(e.latlng, 18.5, {
                            animate: true,
                            duration: 1
                        });
                    });
                }
            }).addTo(layerListrik);

            autoFocusToData(geoLayer);
        }).catch(e => console.warn("File persil_daya_listrik.geojson belum tersedia atau gagal dimuat:", e));

        // B. LAYER JUMLAH BEKERJA (data-layer="pekerjaan")
        fetch('/geojson/persil_jumlah_bekerja.geojson').then(res => res.json()).then(data => {
            let geoLayer = L.geoJSON(data, {
                style: function(feature) {
                    let props = feature.properties;
                    let kerja = parseFloat(props.ANGGOTA_BEKERJA || props.anggota_bekerja);
                    let fungsi = (props.FUNGSI || props.fungsi || props.KETERANGAN || props
                        .keterangan || '').toUpperCase();

                    let color = "#B0B0B0"; // Default: Abu-abu (BANGUNAN LAINNYA)

                    if (fungsi.includes("KOSONG")) {
                        color = "#FFA07A"; // Orange Muda / Light Salmon (RUMAH KOSONG)
                    } else if (isNaN(kerja) || fungsi.includes("LAIN") || (kerja === 0 && !props
                            .hasOwnProperty('ANGGOTA_BEKERJA') && !props.hasOwnProperty(
                                'anggota_bekerja'))) {
                        color = "#B0B0B0"; // Abu-abu (BANGUNAN LAINNYA)
                    } else if (kerja === 0) {
                        color = "#FFFACD"; // Kuning Sangat Muda / Krem (TIDAK BEKERJA)
                    } else if (kerja === 1) {
                        color = "#A9DFBF"; // Hijau Muda (1 ORANG)
                    } else if (kerja === 2) {
                        color = "#58D68D"; // Hijau Sedang (2 ORANG)
                    } else if (kerja >= 3) {
                        color = "#1E8449"; // Hijau Tua / Gelap (3 ORANG)
                    }

                    return {
                        fillColor: color,
                        color: "#555555",
                        weight: 0.8,
                        fillOpacity: 0.85
                    };
                },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function(e) {
                        L.DomEvent.stopPropagation(e);
                        let p = feature.properties;
                        let kerjaTeks = (p.ANGGOTA_BEKERJA !== undefined && p
                                .ANGGOTA_BEKERJA !== null) ? `${p.ANGGOTA_BEKERJA} Orang` :
                            'Bangunan Lainnya / Kosong';

                        updateObjekPanel(`Persil Bangunan #${p.OBJECTID || p.id || '-'}`,
                            "TEMA JUMLAH BEKERJA",
                            `<div class="attr-box">
                                <span class="attr-label">Anggota Keluarga Bekerja</span>
                                <span class="attr-val" style="color:#2E8B57; font-weight:bold;">${kerjaTeks}</span>
                             </div>
                             <div class="attr-box">
                                <span class="attr-label">Total Anggota Keluarga</span>
                                <span class="attr-val">${p.JUMLAH_ANGGOTA || p.jumlah_anggota || '-'} Jiwa</span>
                             </div>`);
                        map.flyTo(e.latlng, 18.5, {
                            animate: true,
                            duration: 1
                        });
                    });
                }
            }).addTo(layerPekerjaan);

            autoFocusToData(geoLayer);
        }).catch(e => console.warn("File persil_jumlah_bekerja.geojson belum tersedia atau gagal dimuat:", e));

        // C. LAYER KEPADATAN HUNIAN (data-layer="hunian")
        fetch('/geojson/persil_anggota_keluarga.geojson').then(res => res.json()).then(data => {
            let geoLayer = L.geoJSON(data, {
                style: function(feature) {
                    let props = feature.properties;
                    let jml = parseFloat(props.JUMLAH_ANGGOTA || props.jumlah_anggota);
                    let fungsi = (props.FUNGSI || props.fungsi || props.KETERANGAN || props
                        .keterangan || '').toUpperCase();

                    let color = "#B0B0B0"; // Default: Abu-abu (BANGUNAN LAINNYA)

                    if (fungsi.includes("KOSONG")) {
                        color = "#FFFACD"; // Kuning Sangat Muda / Krem (RUMAH KOSONG)
                    } else if (isNaN(jml) || fungsi.includes("LAIN") || (jml === 0 && !props
                            .hasOwnProperty('JUMLAH_ANGGOTA') && !props.hasOwnProperty('jumlah_anggota')
                            )) {
                        color = "#B0B0B0"; // Abu-abu (BANGUNAN LAINNYA)
                    } else if (jml >= 1 && jml <= 2) {
                        color = "#FCD34D"; // Kuning - Orange Muda (1 - 2 JIWA)
                    } else if (jml >= 3 && jml <= 4) {
                        color = "#F97316"; // Orange Sedang (3 - 4 JIWA)
                    } else if (jml >= 5 && jml <= 6) {
                        color = "#EA580C"; // Orange Tua / Gelap (5 - 6 JIWA)
                    } else if (jml >= 7) {
                        color = "#8B4513"; // Cokelat (7 - 8 JIWA / > 6 Jiwa)
                    } else if (jml === 0) {
                        color = "#FFFACD";
                    }

                    return {
                        fillColor: color,
                        color: "#555555",
                        weight: 0.8,
                        fillOpacity: 0.85
                    };
                },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function(e) {
                        L.DomEvent.stopPropagation(e);
                        let p = feature.properties;
                        let penghuniTeks = (p.JUMLAH_ANGGOTA !== undefined && p
                                .JUMLAH_ANGGOTA !== null) ? `${p.JUMLAH_ANGGOTA} Jiwa` :
                            'Bangunan Lainnya / Kosong';
                        let statusPadat = (p.JUMLAH_ANGGOTA || 0) > 4 ? 'Padat' : ((p
                            .JUMLAH_ANGGOTA || 0) > 0 ? 'Normal / Ideal' : '-');

                        updateObjekPanel(`Persil Bangunan #${p.OBJECTID || p.id || '-'}`,
                            "TEMA KEPADATAN HUNIAN",
                            `<div class="attr-box">
                                <span class="attr-label">Penghuni / Anggota Keluarga</span>
                                <span class="attr-val" style="color:#EA580C; font-weight:bold;">${penghuniTeks}</span>
                             </div>
                             <div class="attr-box">
                                <span class="attr-label">Status Kepadatan</span>
                                <span class="attr-val">${statusPadat}</span>
                             </div>`);
                        map.flyTo(e.latlng, 18.5, {
                            animate: true,
                            duration: 1
                        });
                    });
                }
            }).addTo(layerHunian);

            autoFocusToData(geoLayer);
        }).catch(e => console.warn("File persil_anggota_keluarga.geojson belum tersedia atau gagal dimuat:", e));

        // D. LAYER SUMBER AIR BERSIH (data-layer="air")
        fetch('/geojson/persil_sumber_air.geojson').then(res => res.json()).then(data => {
            let geoLayer = L.geoJSON(data, {
                style: function(feature) {
                    let props = feature.properties;
                    let air = (props.SUMBER_AIR || props.sumber_air || '').toLowerCase();
                    let fungsi = (props.FUNGSI || props.fungsi || props.KETERANGAN || props
                        .keterangan || '').toUpperCase();

                    let color = "#B0B0B0"; // Default: Abu-abu (TIDAK TERIDENTIFIKASI/BANGUNAN LAINNYA)

                    if (fungsi.includes("KOSONG")) {
                        color = "#FFA07A"; // Orange Muda / Light Salmon (RUMAH KOSONG)
                    } else if (air.includes('gali')) {
                        color = "#CCEEFF"; // Biru Sangat Muda / Light Sky Blue (SUMUR GALI)
                    } else if (air.includes('bor')) {
                        color = "#00A8E8"; // Biru Sedang / Cerulean (SUMUR BOR)
                    } else if (air.includes('sungai') || air.includes('mata air')) {
                        color = "#002266"; // Biru Dongker / Dark Navy (SUNGAI)
                    } else if (air === '' || air.includes('lain') || air.includes('tidak')) {
                        color = "#B0B0B0"; // Abu-abu
                    }

                    return {
                        fillColor: color,
                        color: "#555555",
                        weight: 0.8,
                        fillOpacity: 0.85
                    };
                },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function(e) {
                        L.DomEvent.stopPropagation(e);
                        let p = feature.properties;
                        let airTeks = (p.SUMBER_AIR || p.sumber_air) ? (p.SUMBER_AIR || p
                            .sumber_air) : 'Tidak Teridentifikasi / Bangunan Lainnya';

                        updateObjekPanel(`Persil Bangunan #${p.OBJECTID || p.id || '-'}`,
                            "TEMA SUMBER AIR BERSIH",
                            `<div class="attr-box">
                                <span class="attr-label">Jenis Sumber Air</span>
                                <span class="attr-val" style="color:#00A8E8; font-weight:bold;">${airTeks}</span>
                             </div>
                             <div class="attr-box">
                                <span class="attr-label">Fungsi / Status Bangunan</span>
                                <span class="attr-val">${p.FUNGSI || p.fungsi || p.KETERANGAN || 'Rumah Tinggal'}</span>
                             </div>`);
                        map.flyTo(e.latlng, 18.5, {
                            animate: true,
                            duration: 1
                        });
                    });
                }
            }).addTo(layerAir);

            autoFocusToData(geoLayer);
        }).catch(e => console.warn("File persil_sumber_air.geojson belum tersedia atau gagal dimuat:", e));

        // E. LAYER TOPOGRAFI & LERENG (data-layer="topografi")
        fetch('/geojson/topografi.geojson').then(res => res.json()).then(data => {
            let geoLayer = L.geoJSON(data, {
                style: function(feature) {
                    // Membaca angka kelas 1, 2, 3, 4, atau 5 dari hasil Reclassify DEM
                    let zona = feature.properties.gridcode || feature.properties.GRIDCODE || feature
                        .properties.grid_code || 1;

                    let color = "#CBD5E1";
                    if (zona === 1) color = "#1E8449"; // Hijau Tua (255 - 264 mdpl)
                    else if (zona === 2) color = "#58D68D"; // Hijau Muda (264 - 269 mdpl)
                    else if (zona === 3) color = "#FACC15"; // Kuning (269 - 273 mdpl)
                    else if (zona === 4) color = "#F97316"; // Oranye (273 - 276 mdpl)
                    else if (zona >= 5) color = "#DC2626"; // Merah (276 - 282 mdpl)

                    // Garis tepi disamakan warnanya dengan isian agar menyatu solid ("full warna")
                    return {
                        fillColor: color,
                        color: color,
                        weight: 0.5,
                        opacity: 0.95,
                        fillOpacity: 0.90
                    };
                },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function(e) {
                        L.DomEvent.stopPropagation(e);
                        let p = feature.properties;
                        let zona = p.gridcode || p.GRIDCODE || p.grid_code || 1;

                        let elevTeks = zona === 1 ? "255 - 264 mdpl" :
                            zona === 2 ? "264 - 269 mdpl" :
                            zona === 3 ? "269 - 273 mdpl" :
                            zona === 4 ? "273 - 276 mdpl" : "276 - 282 mdpl";

                        let ketTeks = zona === 1 ? "Dataran Terendah / Lembah" :
                            zona === 2 ? "Dataran Rendah" :
                            zona === 3 ? "Dataran Sedang / Transisi" :
                            zona === 4 ? "Dataran Tinggi / Perbukitan" : "Puncak Tertinggi";

                        updateObjekPanel("Zona Topografi Wilayah", "TEMA ELEVASI TOPOGRAFI",
                            `<div class="attr-box">
                                <span class="attr-label">Rentang Ketinggian (Elevasi)</span>
                                <span class="attr-val" style="color:#DC2626; font-weight:bold;">${elevTeks}</span>
                             </div>
                             <div class="attr-box">
                                <span class="attr-label">Keterangan Zona</span>
                                <span class="attr-val">${ketTeks}</span>
                             </div>`);
                        map.flyTo(e.latlng, 17.5, {
                            animate: true,
                            duration: 1
                        });
                    });
                }
            }).addTo(layerTopografi);

            autoFocusToData(geoLayer);
        }).catch(e => console.warn("File topografi.geojson belum tersedia atau gagal dimuat:", e));

        // ---------------------------------------------------------------
        // 8. KONTROL TOGGLE LAYER & RENDER LEGENDA OTOMATIS
        // ---------------------------------------------------------------
        function updateActiveCountBadge() {
            const badge = document.getElementById('activeCountBadge');
            if (badge) badge.textContent = document.querySelectorAll('.layer-toggle:checked').length;
        }

        // Fungsi render legenda dipisah untuk tab Peta Dasar dan Peta Tematik
        function renderLegend() {
            const containerDasar = document.getElementById('legendContainerDasar');
            const containerTematik = document.getElementById('legendContainer');
            if (!containerDasar || !containerTematik) return;

            // Render Legenda Peta Dasar
            const checkedDasar = [...document.querySelectorAll('.layer-dasar:checked')].map(c => c.dataset.layer);
            if (checkedDasar.length === 0) {
                containerDasar.innerHTML =
                    '<p class="panel-empty">Aktifkan minimal satu layer untuk menampilkan legenda peta dasar.</p>';
            } else {
                containerDasar.innerHTML = checkedDasar.map(key => {
                    const cfg = layerConfig[key];
                    if (!cfg) return '';
                    const rows = cfg.legend.map(item => {
                        let swatchHtml = '';

                        // [PERBAIKAN IKON LEGENDA]: Memeriksa tipe swatch icon-circle agar simbol tampil sempurna
                        if (cfg.swatchType === 'icon-circle' || item.icon) {
                            swatchHtml = `<span style="
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                width: 22px;
                                height: 22px;
                                border: 1.5px solid #000000;
                                border-radius: 50%;
                                background-color: #FFFFFF;
                                margin-right: 10px;
                                flex-shrink: 0;
                                box-shadow: 0 1px 2px rgba(0,0,0,0.15);
                            "><i class="${item.icon}" style="color: ${item.iconColor}; font-size: 10px;"></i></span>`;
                        } else if (cfg.swatchType === 'round') {
                            swatchHtml =
                                `<span class="legend-swatch round" style="background:${item.c}"></span>`;
                        } else if (cfg.swatchType === 'line') {
                            swatchHtml =
                                `<span class="legend-swatch line" style="background:${item.c}"></span>`;
                        } else {
                            swatchHtml =
                                `<span class="legend-swatch square" style="background:${item.c}"></span>`;
                        }

                        return `
                        <div class="legend-row">
                            ${swatchHtml}${item.l}
                        </div>`;
                    }).join('');
                    return `<div class="legend-block"><div class="legend-heading">${cfg.label}</div>${rows}</div>`;
                }).join('');
            }

            // Render Legenda Peta Tematik
            const checkedTematik = [...document.querySelectorAll('.layer-tematik:checked')].map(c => c.dataset.layer);
            if (checkedTematik.length === 0) {
                containerTematik.innerHTML =
                    '<p class="panel-empty">Aktifkan minimal satu layer untuk menampilkan legenda peta tematik.</p>';
            } else {
                containerTematik.innerHTML = checkedTematik.map(key => {
                    const cfg = layerConfig[key];
                    if (!cfg) return '';
                    const rows = cfg.legend.map(item => {
                        let swatchHtml = '';

                        if (cfg.swatchType === 'icon-circle' || item.icon) {
                            swatchHtml = `<span style="
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                width: 22px;
                                height: 22px;
                                border: 1.5px solid #000000;
                                border-radius: 50%;
                                background-color: #FFFFFF;
                                margin-right: 10px;
                                flex-shrink: 0;
                                box-shadow: 0 1px 2px rgba(0,0,0,0.15);
                            "><i class="${item.icon}" style="color: ${item.iconColor}; font-size: 10px;"></i></span>`;
                        } else if (cfg.swatchType === 'round') {
                            swatchHtml =
                                `<span class="legend-swatch round" style="background:${item.c}"></span>`;
                        } else if (cfg.swatchType === 'line') {
                            swatchHtml =
                                `<span class="legend-swatch line" style="background:${item.c}"></span>`;
                        } else {
                            swatchHtml =
                                `<span class="legend-swatch square" style="background:${item.c}"></span>`;
                        }

                        return `
                        <div class="legend-row">
                            ${swatchHtml}${item.l}
                        </div>`;
                    }).join('');
                    return `<div class="legend-block"><div class="legend-heading">${cfg.label}</div>${rows}</div>`;
                }).join('');
            }
        }

        // Event Listener untuk setiap tombol Switch
        document.querySelectorAll('.layer-toggle').forEach(chk => {
            chk.addEventListener('change', function() {
                const key = this.dataset.layer;
                if (this.checked && layerGroups[key]) {
                    map.addLayer(layerGroups[key]);
                } else if (!this.checked && layerGroups[key]) {
                    map.removeLayer(layerGroups[key]);
                }
                renderLegend();
                updateActiveCountBadge();
            });
        });

        // Fungsi untuk tombol Aktifkan/Matikan Semua per kategori (dasar vs tematik)
        function setAllLayers(state, tipe) {
            const selector = tipe === 'dasar' ? '.layer-dasar' : '.layer-tematik';
            document.querySelectorAll(selector).forEach(chk => {
                chk.checked = state;
                const key = chk.dataset.layer;
                if (state && layerGroups[key]) map.addLayer(layerGroups[key]);
                else if (!state && layerGroups[key]) map.removeLayer(layerGroups[key]);
            });
            renderLegend();
            updateActiveCountBadge();
        }

        // Fungsi untuk navigasi Tab di panel kanan (Peta Dasar vs Peta Tematik)
        function showPanelTab(tab) {
            document.querySelectorAll('.panel-tab-btn').forEach(b => {
                b.classList.toggle('active', b.dataset.tab === tab);
            });
            document.querySelectorAll('.panel-pane').forEach(p => {
                p.classList.toggle('d-none', p.dataset.pane !== tab);
            });
        }

        renderLegend();
        updateActiveCountBadge();

        var controlPanelCollapse = document.getElementById('controlPanelCollapse');
        if (controlPanelCollapse) {
            controlPanelCollapse.addEventListener('shown.bs.collapse', () => map.invalidateSize());
            controlPanelCollapse.addEventListener('hidden.bs.collapse', () => map.invalidateSize());
        }
        window.addEventListener('resize', () => map.invalidateSize());
        setTimeout(() => map.invalidateSize(), 400);
    </script>
</body>

</html>
