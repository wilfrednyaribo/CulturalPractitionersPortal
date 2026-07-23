<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} — Cultural Practitioners Registry</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair+display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=dm+sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --ke-red: #c62828;
            --ke-red-light: #e53935;
            --ke-red-pale: #fce8e8;
            --ke-red-ghost: rgba(198,40,40,0.05);
            --ke-red-glow: rgba(198,40,40,0.07);
            --ke-green: #2e7d32;
            --ke-green-light: #43a047;
            --ke-green-pale: #e8f5e9;
            --ke-green-ghost: rgba(46,125,50,0.05);
            --ke-black: #111111;
            --ke-black-light: #1a1a1a;
            --ink: #111111;
            --ink-light: #333333;
            --ink-muted: #666666;
            --ink-faint: #999999;
            --cream: #fafafa;
            --cream-warm: #f5f5f5;
            --ivory: #ffffff;
            --border-classic: #e0e0e0;
            --border-light: #eeeeee;
        }

        html { height: 100%; }
        body {
            font-family: 'DM Sans', -apple-system, sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100%;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        /* ─── KENYAN THREE STRIPES ─── */
        .ke-stripes {
            flex-shrink: 0;
            position: relative;
            z-index: 200;
        }
        .ke-stripe {
            width: 100%;
            height: 5px;
        }
        .ke-stripe-red { background: var(--ke-red); }
        .ke-stripe-black { background: var(--ke-black); }
        .ke-stripe-green { background: var(--ke-green); }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes expandLine {
            from { width: 0; }
            to { width: 80px; }
        }
        @keyframes pulseGlow {
            0%, 100% { opacity: 0.06; transform: scale(1); }
            50% { opacity: 0.1; transform: scale(1.04); }
        }
        @keyframes slowSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes driftFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(-4px) rotate(-1deg); }
        }
        @keyframes shieldFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        .anim-up { opacity: 0; animation: fadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .d1 { animation-delay: 0.12s; }
        .d2 { animation-delay: 0.24s; }
        .d3 { animation-delay: 0.36s; }
        .d4 { animation-delay: 0.48s; }
        .d5 { animation-delay: 0.6s; }
        .d6 { animation-delay: 0.72s; }
        .d7 { animation-delay: 0.84s; }

        /* ─── NAV ─── */
        .landing-nav {
            position: fixed;
            top: 15px; left: 0; right: 0;
            z-index: 100;
            padding: 0 48px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.4s ease;
        }
        .landing-nav.scrolled {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-classic);
            box-shadow: 0 1px 12px rgba(0,0,0,0.06);
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .nav-brand-icon {
            width: 40px; height: 40px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
            overflow: hidden;
            position: relative;
            background: #ffffff;
        }
        .nav-brand-icon-inner {
            display: flex;
            flex-direction: column;
            width: 100%;
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
        }
        .nav-brand-icon-inner span {
            flex: 1;
            display: block;
        }
        .nav-brand-icon-inner .s-red { background: var(--ke-red); }
        .nav-brand-icon-inner .s-black { background: var(--ke-black); }
        .nav-brand-icon-inner .s-green { background: var(--ke-green); }
        .nav-brand-icon svg {
            position: relative;
            z-index: 2;
            filter: drop-shadow(0 0 2px rgba(0,0,0,0.3));
        }
        .nav-brand:hover .nav-brand-icon { transform: rotate(-5deg) scale(1.05); }
        .nav-brand-name {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 18px; font-weight: 700;
            color: var(--ink); line-height: 1.1;
        }
        .nav-brand-sub {
            font-size: 8px; color: var(--ink-muted);
            font-weight: 700; letter-spacing: 2.5px;
            text-transform: uppercase;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-link {
            font-size: 12px; font-weight: 600;
            color: var(--ink-muted);
            text-decoration: none;
            padding: 8px 16px; border-radius: 4px;
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
        }
        .nav-link:hover { color: var(--ink); background: var(--ke-red-ghost); }
        .nav-link-cta {
            background: var(--ke-black);
            color: var(--ivory) !important;
            padding: 9px 20px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .nav-link-cta:hover { background: #222 !important; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(0,0,0,0.25) !important; }

        /* ─── HERO ─── */
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 72px 48px 48px;
            min-height: 100vh;
        }
        .hero-bg-pattern {
            position: absolute; inset: 0;
            opacity: 0.015;
            background-image:
                linear-gradient(var(--ke-black) 1px, transparent 1px),
                linear-gradient(90deg, var(--ke-black) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }
        .hero-glow-1 {
            position: absolute;
            width: 700px; height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--ke-red-glow), transparent 70%);
            top: -18%; right: -10%;
            pointer-events: none;
            animation: pulseGlow 10s ease-in-out infinite;
        }
        .hero-glow-2 {
            position: absolute;
            width: 550px; height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--ke-green-ghost), transparent 70%);
            bottom: -18%; left: -10%;
            pointer-events: none;
            animation: pulseGlow 10s ease-in-out 5s infinite;
        }
        .hero-glow-3 {
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(17,17,17,0.04), transparent 70%);
            top: 38%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            animation: pulseGlow 14s ease-in-out 2s infinite;
        }

        /* Shield watermark */
        .hero-shield {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 280px; height: 320px;
            pointer-events: none;
            opacity: 0.025;
            animation: shieldFloat 8s ease-in-out infinite;
        }

        /* Decorative rings */
        .hero-ring {
            position: absolute;
            width: 520px; height: 520px;
            border-radius: 50%;
            border: 1px solid rgba(46,125,50,0.05);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            animation: slowSpin 120s linear infinite;
        }
        .hero-ring::before {
            content: '';
            position: absolute;
            width: 8px; height: 8px;
            background: rgba(198,40,40,0.12);
            border-radius: 50%;
            top: -4px; left: 50%;
            transform: translateX(-50%);
        }
        .hero-ring::after {
            content: '';
            position: absolute;
            width: 6px; height: 6px;
            background: rgba(17,17,17,0.1);
            border-radius: 50%;
            bottom: -3px; left: 50%;
            transform: translateX(-50%);
        }
        .hero-ring-2 {
            position: absolute;
            width: 380px; height: 380px;
            border-radius: 50%;
            border: 1px dashed rgba(198,40,40,0.04);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            animation: slowSpin 90s linear infinite reverse;
        }
        .hero-ring-2::before {
            content: '';
            position: absolute;
            width: 5px; height: 5px;
            background: rgba(46,125,50,0.1);
            border-radius: 50%;
            top: -2px; left: 50%;
            transform: translateX(-50%);
        }

        /* Floating shapes */
        .hero-float {
            position: absolute;
            pointer-events: none;
            opacity: 0.05;
        }
        .hero-float-1 {
            top: 20%; left: 11%;
            animation: driftFloat 7s ease-in-out infinite;
        }
        .hero-float-2 {
            bottom: 26%; right: 13%;
            animation: driftFloat 9s ease-in-out 2s infinite;
        }
        .hero-float-3 {
            top: 33%; right: 9%;
            animation: driftFloat 8s ease-in-out 4s infinite;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            position: relative;
            z-index: 2;
        }

        /* Ornament with tri-color */
        .hero-ornament-top {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 44px;
        }
        .hero-orn-line {
            width: 50px; height: 1px;
            animation: expandLine 1s ease forwards;
        }
        .hero-orn-line.orn-red { background: linear-gradient(90deg, transparent, var(--ke-red)); }
        .hero-orn-line.orn-green { background: linear-gradient(90deg, var(--ke-green), transparent); }
        .hero-orn-dots {
            display: flex;
            gap: 6px;
            padding: 0 14px;
        }
        .hero-orn-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            animation: fadeIn 1s ease 0.3s forwards;
            opacity: 0;
        }
        .dot-red { background: var(--ke-red); }
        .dot-black { background: var(--ke-black); }
        .dot-green { background: var(--ke-green); }

        /* Eyebrow with tri-color border */
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 10px; font-weight: 700;
            color: var(--ke-black);
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 28px;
            background: var(--ivory);
            border: 1px solid var(--border-classic);
            border-top: 3px solid var(--ke-red);
            padding: 10px 22px 8px;
            border-radius: 6px;
            position: relative;
        }
        .hero-eyebrow::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 20px; right: 20px;
            height: 2px;
            background: linear-gradient(90deg, var(--ke-red), var(--ke-black), var(--ke-green));
            border-radius: 1px;
        }

        /* Title */
        .hero-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 62px; font-weight: 700;
            color: var(--ke-black); line-height: 1.06;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }
        .hero-title em {
            font-style: italic;
            color: var(--ke-red);
        }

        /* Subtitle */
        .hero-subtitle {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 20px; font-weight: 400;
            color: var(--ink-muted);
            margin-bottom: 24px;
            font-style: italic;
        }

        /* Description */
        .hero-desc {
            font-size: 15px; color: var(--ink-muted);
            line-height: 1.85;
            max-width: 560px;
            margin: 0 auto 24px;
            font-weight: 300;
        }

        /* Trust strip with tri-color icons */
        .hero-trust {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 24px;
            margin-bottom: 44px;
            flex-wrap: wrap;
        }
        .hero-trust-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: var(--ink-faint);
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .hero-trust-icon {
            width: 30px; height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid;
        }
        .trust-icon-red {
            background: var(--ke-red-pale);
            border-color: rgba(198,40,40,0.15);
        }
        .trust-icon-black {
            background: #f0f0f0;
            border-color: rgba(0,0,0,0.1);
        }
        .trust-icon-green {
            background: var(--ke-green-pale);
            border-color: rgba(46,125,50,0.15);
        }
        .hero-trust-sep {
            width: 1px; height: 16px;
            background: var(--border-light);
        }

        /* Actions */
        .hero-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }
        .btn-hero-red {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--ke-red);
            color: #ffffff; border: none;
            border-radius: 6px;
            padding: 16px 40px;
            font-size: 13px; font-weight: 700;
            cursor: pointer; text-decoration: none;
            transition: all 0.25s ease;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 24px rgba(198,40,40,0.3);
            font-family: 'DM Sans', sans-serif;
        }
        .btn-hero-red:hover { transform: translateY(-2px); box-shadow: 0 8px 36px rgba(198,40,40,0.4); background: var(--ke-red-light); }
        .btn-hero-black {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--ke-black);
            color: #ffffff; border: none;
            border-radius: 6px;
            padding: 16px 40px;
            font-size: 13px; font-weight: 700;
            cursor: pointer; text-decoration: none;
            transition: all 0.25s ease;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            font-family: 'DM Sans', sans-serif;
        }
        .btn-hero-black:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(0,0,0,0.3); background: var(--ke-black-light); }
        .btn-hero-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            color: var(--ink-light);
            border: 1px solid var(--border-classic);
            border-radius: 6px;
            padding: 16px 40px;
            font-size: 13px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: all 0.25s ease;
            letter-spacing: 0.5px;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-hero-outline:hover { border-color: var(--ke-green); color: var(--ke-green); background: var(--ke-green-ghost); transform: translateY(-2px); }

        /* ─── FOOTER ─── */
        .landing-footer {
            flex-shrink: 0;
            position: relative;
        }
        .footer-stripes {
            height: 3px;
            display: flex;
        }
        .footer-stripes span { flex: 1; }
        .fs-red { background: var(--ke-red); }
        .fs-black { background: var(--ke-black); }
        .fs-green { background: var(--ke-green); }
        .footer-body {
            padding: 24px 48px;
            border-top: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            background: var(--ivory);
        }
        .footer-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .footer-logo {
            width: 22px; height: 22px;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .footer-logo span { flex: 1; display: block; }
        .footer-text {
            font-size: 12px; color: var(--ink-muted);
        }
        .footer-text strong { color: var(--ink); font-weight: 600; }
        .footer-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .footer-link {
            font-size: 11px; color: var(--ink-faint);
            text-decoration: none; font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.2s ease;
        }
        .footer-link:hover { color: var(--ke-red); }
        .footer-copyright {
            font-size: 10px; color: var(--ink-faint);
            letter-spacing: 1px; text-transform: uppercase;
            font-weight: 600;
        }
        .footer-sep {
            width: 1px; height: 14px;
            background: var(--border-light);
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .landing-nav { padding: 0 20px; }
            .nav-links .nav-link:not(.nav-link-cta) { display: none; }
            .hero { padding: 72px 20px 40px; }
            .hero-title { font-size: 36px; }
            .hero-subtitle { font-size: 17px; }
            .hero-desc { font-size: 14px; }
            .hero-eyebrow { font-size: 9px; letter-spacing: 3px; padding: 8px 16px 7px; }
            .hero-trust { gap: 16px; }
            .hero-trust-sep { display: none; }
            .hero-ring, .hero-ring-2, .hero-shield { display: none; }
            .hero-float { display: none; }
            .footer-body { padding: 20px; flex-direction: column; text-align: center; }
            .footer-right { flex-direction: column; gap: 10px; }
            .footer-sep { display: none; }
            .btn-hero-red, .btn-hero-black, .btn-hero-outline { padding: 14px 28px; }
        }
        @media (max-width: 480px) {
            .hero-title { font-size: 30px; }
            .hero-subtitle { font-size: 15px; }
            .hero-actions { flex-direction: column; width: 100%; }
            .btn-hero-red, .btn-hero-black, .btn-hero-outline { width: 100%; justify-content: center; }
            .hero-trust { flex-direction: column; gap: 12px; }
        }
    </style>
</head>
<body>

    <!-- KENYAN THREE STRIPES -->
    <div class="ke-stripes">
        <div class="ke-stripe ke-stripe-red"></div>
        <div class="ke-stripe ke-stripe-black"></div>
        <div class="ke-stripe ke-stripe-green"></div>
    </div>

    <!-- NAVIGATION -->
    <nav class="landing-nav" id="landingNav">
        <a href="/" class="nav-brand">
            <div class="nav-brand-icon">
                <div class="nav-brand-icon-inner">
                    <span class="s-red"></span>
                    <span class="s-black"></span>
                    <span class="s-green"></span>
                </div>
                <svg width="16" height="16" fill="none" stroke="#ffffff" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <div>
                <div class="nav-brand-name">{{ config('app.name', 'CPRS') }}</div>
                <div class="nav-brand-sub">{{ env('COUNTY_NAME', 'Cultural Registry') }}</div>
            </div>
        </a>
        <div class="nav-links">
            @guest
                <a href="{{ route('login') }}" class="nav-link">Sign In</a>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link nav-link-cta">Dashboard</a>
            @endauth
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-bg-pattern"></div>
        <div class="hero-glow-1"></div>
        <div class="hero-glow-2"></div>
        <div class="hero-glow-3"></div>
        <div class="hero-ring"></div>
        <div class="hero-ring-2"></div>

        <!-- Kenyan shield watermark -->
        <svg class="hero-shield" viewBox="0 0 100 120" fill="none" stroke="var(--ke-black)" stroke-width="0.8">
            <path d="M50 5 L10 30 L10 70 Q10 110 50 115 Q90 110 90 70 L90 30 Z"/>
            <line x1="10" y1="45" x2="90" y2="45"/>
            <rect x="25" y="18" width="12" height="20" rx="1"/>
            <rect x="40" y="14" width="20" height="24" rx="1"/>
            <rect x="63" y="18" width="12" height="20" rx="1"/>
            <line x1="50" y1="38" x2="50" y2="45"/>
            <circle cx="50" cy="65" r="8"/>
            <line x1="42" y1="65" x2="58" y2="65"/>
            <line x1="50" y1="57" x2="50" y2="73"/>
            <path d="M30 85 Q50 100 70 85" stroke-width="0.6"/>
            <path d="M25 95 Q50 112 75 95" stroke-width="0.6"/>
        </svg>

        <!-- Floating decorative shapes -->
        <svg class="hero-float hero-float-1" width="32" height="32" viewBox="0 0 32 32" fill="none"><rect x="4" y="4" width="24" height="24" rx="4" stroke="var(--ke-red)" stroke-width="1"/></svg>
        <svg class="hero-float hero-float-2" width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="14" cy="14" r="12" stroke="var(--ke-green)" stroke-width="1"/></svg>
        <svg class="hero-float hero-float-3" width="24" height="24" viewBox="0 0 24 24" fill="none"><polygon points="12,2 15,9 22,9 16,14 18,21 12,17 6,21 8,14 2,9 9,9" stroke="var(--ke-black)" stroke-width="1"/></svg>

        <div class="hero-content">
            <!-- Tri-color ornament -->
            <div class="hero-ornament-top anim-up">
                <div class="hero-orn-line orn-red"></div>
                <div class="hero-orn-dots">
                    <div class="hero-orn-dot dot-red"></div>
                    <div class="hero-orn-dot dot-black"></div>
                    <div class="hero-orn-dot dot-green"></div>
                </div>
                <div class="hero-orn-line orn-green"></div>
            </div>

            <div class="hero-eyebrow anim-up d1">
                Republic of Kenya
            </div>

            <h1 class="hero-title anim-up d2">
                Preserving Our<br><em>Cultural Heritage</em>
            </h1>

            <p class="hero-subtitle anim-up d3">A unified registry for cultural practitioners across the nation</p>

            <p class="hero-desc anim-up d4">
                Register and manage cultural practitioners — from traditional musicians and dancers to artisans and oral historians. Ensuring authenticity and preserving identity for generations to come.
            </p>

            <!-- Trust strip with tri-color icons -->
            <div class="hero-trust anim-up d5">
                <div class="hero-trust-item">
                    <div class="hero-trust-icon trust-icon-red">
                        <svg width="12" height="12" fill="none" stroke="var(--ke-red)" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span>Official Registry</span>
                </div>
                <div class="hero-trust-sep"></div>
                <div class="hero-trust-item">
                    <div class="hero-trust-icon trust-icon-black">
                        <svg width="12" height="12" fill="none" stroke="var(--ke-black)" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <span>Certified Practitioners</span>
                </div>
                <div class="hero-trust-sep"></div>
                <div class="hero-trust-item">
                    <div class="hero-trust-icon trust-icon-green">
                        <svg width="12" height="12" fill="none" stroke="var(--ke-green)" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <span>Live Analytics</span>
                </div>
            </div>

            <div class="hero-actions anim-up d6">
                @guest
                    <a href="{{ route('login') }}" class="btn-hero-red">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        Enter Portal
                    </a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-hero-red">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        Open Dashboard
                    </a>
                @endauth
                <a href="{{ env('COUNTY_URL', '#') }}" class="btn-hero-black" target="_blank">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    Government Portal
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="landing-footer">
        <div class="footer-stripes">
            <span class="fs-red"></span>
            <span class="fs-black"></span>
            <span class="fs-green"></span>
        </div>
        <div class="footer-body">
            <div class="footer-left">
                <div class="footer-logo">
                    <span style="background:var(--ke-red)"></span>
                    <span style="background:var(--ke-black)"></span>
                    <span style="background:var(--ke-green)"></span>
                </div>
                <div class="footer-text">
                    <strong>{{ config('app.name', 'CPRS') }}</strong> &mdash; {{ env('COUNTY_NAME', 'Cultural Practitioners Registry') }}
                </div>
            </div>
            <div class="footer-right">
                @guest
                    <a href="{{ route('login') }}" class="footer-link">Sign In</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="footer-link">Dashboard</a>
                @endauth
                <div class="footer-sep"></div>
                <span class="footer-copyright">&copy; {{ date('Y') }} Republic of Kenya</span>
            </div>
        </div>
    </footer>

    <script>
        const nav = document.getElementById('landingNav');
        window.addEventListener('scroll', function() {
            nav.classList.toggle('scrolled', window.scrollY > 40);
        }, { passive: true });
    </script>
</body>
</html>