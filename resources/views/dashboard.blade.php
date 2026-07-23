<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} — Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair+display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=dm+sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { font-family: 'DM Sans', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold: #b8860b;
            --gold-light: #daa520;
            --gold-pale: #f5ecd7;
            --gold-ghost: rgba(184,134,11,0.06);
            --ink: #1a1a1a;
            --ink-light: #3d3d3d;
            --ink-muted: #7a7a72;
            --ink-faint: #b0afa6;
            --cream: #faf8f4;
            --cream-warm: #f5f1ea;
            --cream-dark: #ece7dc;
            --parchment: #f0ebe0;
            --ivory: #fffff8;
            --sidebar-bg: #1c1914;
            --sidebar-ink: #c4b99a;
            --sidebar-muted: #6b6152;
            --border-classic: #e2ddd2;
            --border-light: #ede9e0;
            --emerald: #2d6a4f;
            --emerald-light: #40916c;
            --emerald-pale: #d8f3dc;
            --ruby: #9b2226;
            --ruby-pale: #fde8e8;
            --amber: #b45309;
            --amber-pale: #fef3c7;
            --sapphire: #1e40af;
            --sapphire-pale: #dbeafe;
        }

        body {
            background: var(--cream);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .font-serif { font-family: 'Playfair Display', Georgia, 'Times New Roman', serif; }

        /* ─── SIDEBAR ─── */
        .sidebar {
            background: var(--sidebar-bg);
            width: 260px;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            border-right: 1px solid rgba(184,134,11,0.15);
        }
        .sidebar-logo {
            height: 72px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 24px;
            border-bottom: 1px solid rgba(184,134,11,0.1);
        }
        .sidebar-logo-icon {
            width: 36px;
            height: 36px;
            border-radius: 4px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(184,134,11,0.3);
        }
        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
            overflow-y: auto;
        }
        .sidebar-nav::-webkit-scrollbar { width: 0; }
        .nav-group-label {
            font-size: 9px;
            font-weight: 700;
            color: var(--sidebar-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 20px 24px 8px;
            font-family: 'DM Sans', sans-serif;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 24px;
            font-size: 13px;
            font-weight: 500;
            color: var(--sidebar-ink);
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border-left: 2px solid transparent;
            position: relative;
        }
        .nav-item:hover {
            color: #e8dcc8;
            background: rgba(184,134,11,0.04);
        }
        .nav-item.active {
            color: var(--gold-light);
            background: rgba(184,134,11,0.08);
            border-left-color: var(--gold);
        }
        .nav-item .nav-ico {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            opacity: 0.55;
        }
        .nav-item.active .nav-ico { opacity: 1; }
        .nav-item:hover .nav-ico { opacity: 0.8; }
        .nav-badge {
            margin-left: auto;
            font-size: 8px;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 2px;
            background: rgba(184,134,11,0.2);
            color: var(--gold-light);
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .nav-external {
            width: 12px;
            height: 12px;
            margin-left: auto;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .nav-item:hover .nav-external { opacity: 0.4; }
        .nav-divider {
            height: 1px;
            background: rgba(184,134,11,0.08);
            margin: 12px 24px;
        }
        .sidebar-user {
            padding: 16px 20px;
            border-top: 1px solid rgba(184,134,11,0.1);
            display: flex;
            align-items: center;
            gap: 11px;
        }
        .sidebar-avatar {
            width: 34px;
            height: 34px;
            border-radius: 4px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-bg);
            font-size: 12px;
            font-weight: 800;
            flex-shrink: 0;
            font-family: 'Playfair Display', serif;
        }
        .sidebar-logout {
            margin-left: auto;
            width: 30px;
            height: 30px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-muted);
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .sidebar-logout:hover {
            color: #e74c3c;
            background: rgba(231,76,60,0.1);
        }

        /* ─── TOPBAR ─── */
        .topbar {
            height: 72px;
            background: var(--ivory);
            border-bottom: 1px solid var(--border-classic);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            flex-shrink: 0;
        }
        .topbar-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--cream);
            border: 1px solid var(--border-classic);
            border-radius: 4px;
            padding: 8px 14px;
            width: 300px;
            transition: all 0.25s ease;
        }
        .topbar-search:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px var(--gold-ghost);
            background: var(--ivory);
        }
        .topbar-search input {
            background: none;
            border: none;
            outline: none;
            font-size: 13px;
            color: var(--ink);
            width: 100%;
            font-weight: 400;
        }
        .topbar-search input::placeholder { color: var(--ink-faint); }
        .btn-classic {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--ink);
            color: var(--ivory);
            border: none;
            border-radius: 4px;
            padding: 9px 18px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
        }
        .btn-classic:hover { background: #333; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #1a1a1a;
            border: none;
            border-radius: 4px;
            padding: 9px 18px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 8px rgba(184,134,11,0.25);
        }
        .btn-gold:hover { transform: translateY(-1px); box-shadow: 0 4px 16px rgba(184,134,11,0.35); }
        .btn-outline-classic {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: var(--ink-light);
            border: 1px solid var(--border-classic);
            border-radius: 4px;
            padding: 9px 18px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
        }
        .btn-outline-classic:hover { border-color: var(--gold); color: var(--gold); background: var(--gold-ghost); }

        /* ─── CONTENT AREA ─── */
        .main-content {
            flex: 1;
            overflow-y: auto;
            background: var(--cream);
            padding: 32px;
        }
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
        }
        .page-subtitle {
            font-size: 13px;
            color: var(--ink-muted);
            margin-bottom: 28px;
            font-weight: 400;
        }
        .page-ornament {
            width: 48px;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), transparent);
            margin-bottom: 24px;
            border-radius: 1px;
        }

        /* ─── STAT CARDS ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }
        @media (max-width: 1024px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .stats-grid { grid-template-columns: 1fr; } }
        .stat-card {
            background: var(--ivory);
            border: 1px solid var(--border-classic);
            border-radius: 6px;
            padding: 22px;
            position: relative;
            overflow: hidden;
            transition: all 0.25s ease;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
        }
        .stat-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.06); transform: translateY(-2px); }
        .stat-card:nth-child(1)::before { background: var(--emerald); }
        .stat-card:nth-child(2)::before { background: var(--sapphire); }
        .stat-card:nth-child(3)::before { background: var(--amber); }
        .stat-card:nth-child(4)::before { background: var(--ruby); }
        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }
        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
        }
        .stat-label {
            font-size: 11px;
            color: var(--ink-muted);
            margin-top: 5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ─── PANELS ─── */
        .panel {
            background: var(--ivory);
            border: 1px solid var(--border-classic);
            border-radius: 6px;
            margin-bottom: 24px;
            overflow: hidden;
        }
        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            border-bottom: 1px solid var(--border-light);
            background: linear-gradient(180deg, rgba(245,236,215,0.3), transparent);
        }
        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--ink);
        }
        .panel-body { padding: 0; }

        /* ─── TABLE ─── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table thead th {
            font-size: 10px;
            font-weight: 700;
            color: var(--ink-muted);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            text-align: left;
            padding: 12px 24px;
            background: var(--cream-warm);
            border-bottom: 1px solid var(--border-classic);
        }
        .data-table tbody td {
            font-size: 13px;
            color: var(--ink-light);
            padding: 14px 24px;
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
        }
        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover { background: var(--gold-ghost); }
        .data-table .name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .name-avatar {
            width: 34px;
            height: 34px;
            border-radius: 4px;
            background: var(--cream-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--ink-muted);
            flex-shrink: 0;
            font-family: 'Playfair Display', serif;
        }
        .name-text {
            font-weight: 600;
            color: var(--ink);
        }
        .name-sub {
            font-size: 11px;
            color: var(--ink-faint);
            font-weight: 400;
        }

        /* ─── STATUS BADGES ─── */
        .badge {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 3px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }
        .badge-active { background: var(--emerald-pale); color: var(--emerald); }
        .badge-suspended { background: var(--ruby-pale); color: var(--ruby); }
        .badge-expired { background: var(--amber-pale); color: var(--amber); }
        .badge-pending { background: var(--sapphire-pale); color: var(--sapphire); }

        /* ─── VIEW ALL LINK ─── */
        .view-all {
            font-size: 12px;
            font-weight: 600;
            color: var(--gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.2s ease;
            letter-spacing: 0.3px;
        }
        .view-all:hover { color: var(--gold-light); }

        /* ─── WELCOME PANEL ─── */
        .welcome-panel {
            background: var(--sidebar-bg);
            border-radius: 8px;
            padding: 48px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(184,134,11,0.15);
        }
        .welcome-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
        .welcome-panel::after {
            content: '';
            position: absolute;
            top: -60%;
            right: -15%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(184,134,11,0.04);
            pointer-events: none;
        }
        .welcome-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 12px;
            position: relative;
        }
        .welcome-title {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            font-weight: 700;
            color: #f0ebe0;
            margin-bottom: 12px;
            position: relative;
            line-height: 1.2;
        }
        .welcome-desc {
            font-size: 14px;
            color: var(--sidebar-ink);
            max-width: 520px;
            line-height: 1.7;
            margin-bottom: 28px;
            position: relative;
            font-weight: 300;
        }
        .welcome-actions {
            display: flex;
            gap: 12px;
            position: relative;
        }
        .btn-outline-warm {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: var(--sidebar-ink);
            border: 1px solid rgba(184,134,11,0.2);
            border-radius: 4px;
            padding: 9px 18px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
        }
        .btn-outline-warm:hover {
            background: rgba(184,134,11,0.08);
            border-color: rgba(184,134,11,0.4);
            color: var(--gold-light);
        }

        /* ─── QUICK ACTIONS ─── */
        .quick-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }
        @media (max-width: 1024px) { .quick-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .quick-grid { grid-template-columns: 1fr; } }
        .quick-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            background: var(--ivory);
            border: 1px solid var(--border-classic);
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.25s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .quick-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gold);
            transform: scaleX(0);
            transition: transform 0.25s ease;
        }
        .quick-item:hover::after { transform: scaleX(1); }
        .quick-item:hover { border-color: var(--gold); box-shadow: 0 4px 16px rgba(184,134,11,0.08); }
        .quick-ico {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .quick-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
        }
        .quick-desc {
            font-size: 11px;
            color: var(--ink-faint);
            margin-top: 2px;
        }
        .quick-arrow {
            margin-left: auto;
            color: var(--ink-faint);
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .quick-item:hover .quick-arrow { color: var(--gold); transform: translateX(2px); }

        /* ─── CATEGORY CHIPS ─── */
        .chip-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 20px 24px;
        }
        .chip {
            font-size: 11px;
            font-weight: 600;
            color: var(--ink-muted);
            background: var(--cream);
            border: 1px solid var(--border-classic);
            padding: 6px 14px;
            border-radius: 3px;
            transition: all 0.2s ease;
            letter-spacing: 0.2px;
        }
        .chip:hover {
            background: var(--gold-pale);
            border-color: var(--gold);
            color: var(--gold);
        }

        /* ─── ALERTS ─── */
        .alert {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 24px;
            border-left: 3px solid;
        }
        .alert-success { background: var(--emerald-pale); color: var(--emerald); border-left-color: var(--emerald); }
        .alert-warning { background: var(--amber-pale); color: var(--amber); border-left-color: var(--amber); }
        .alert-error { background: var(--ruby-pale); color: var(--ruby); border-left-color: var(--ruby); }

        /* ─── CHART ROW ─── */
        .chart-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 24px;
        }
        .chart-row + .chart-row { border-top: 1px solid var(--border-light); }
        .chart-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .chart-label {
            font-size: 12px;
            color: var(--ink-muted);
            width: 140px;
            flex-shrink: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .chart-bar-bg {
            flex: 1;
            height: 5px;
            background: var(--cream-dark);
            border-radius: 3px;
            overflow: hidden;
        }
        .chart-bar-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.8s ease;
        }
        .chart-num {
            font-size: 12px;
            font-weight: 700;
            color: var(--ink);
            width: 30px;
            text-align: right;
            flex-shrink: 0;
            font-family: 'Playfair Display', serif;
        }

        /* ─── DONUT ─── */
        .donut-wrap {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 20px 24px;
        }
        .donut-legend-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 5px 0;
        }
        .donut-legend-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .donut-dot {
            width: 8px;
            height: 8px;
            border-radius: 2px;
            flex-shrink: 0;
        }
        .donut-legend-label {
            font-size: 12px;
            color: var(--ink-muted);
        }
        .donut-legend-val {
            font-size: 12px;
            font-weight: 700;
            color: var(--ink);
            font-family: 'Playfair Display', serif;
        }

        /* ─── TREND BARS ─── */
        .trend-wrap {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 6px;
            height: 130px;
            padding: 16px 24px 12px;
        }
        .trend-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }
        .trend-val {
            font-size: 10px;
            font-weight: 700;
            color: var(--ink-muted);
            font-family: 'Playfair Display', serif;
        }
        .trend-bar {
            width: 100%;
            border-radius: 3px 3px 0 0;
            min-height: 4px;
            transition: height 0.6s ease;
        }
        .trend-label {
            font-size: 9px;
            color: var(--ink-faint);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
            color: var(--ink-faint);
            text-align: center;
        }
        .empty-state svg { margin-bottom: 16px; opacity: 0.3; }
        .empty-state-text { font-size: 13px; font-weight: 500; }

        /* ─── PDF BUTTON ─── */
        .pdf-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--ivory);
            color: var(--ink-light);
            border: 1px solid var(--border-classic);
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
        }
        .pdf-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-ghost);
            box-shadow: 0 2px 8px rgba(184,134,11,0.1);
        }
        .pdf-btn.loading {
            opacity: 0.7;
            pointer-events: none;
        }
        .pdf-btn .spinner {
            display: none;
            width: 14px;
            height: 14px;
            border: 2px solid var(--border-classic);
            border-top-color: var(--gold);
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        .pdf-btn.loading .spinner { display: block; }
        .pdf-btn.loading .pdf-icon { display: none; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ─── PDF TOAST ─── */
        .pdf-toast {
            position: fixed;
            bottom: 32px;
            right: 32px;
            background: var(--sidebar-bg);
            color: #f0ebe0;
            padding: 14px 22px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            border: 1px solid rgba(184,134,11,0.2);
            transform: translateY(120%);
            opacity: 0;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 100;
        }
        .pdf-toast.show {
            transform: translateY(0);
            opacity: 1;
        }
        .pdf-toast .toast-gold {
            color: var(--gold-light);
        }

        /* ─── MOBILE ─── */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--ink-muted);
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
        }
        .mobile-toggle:hover { background: var(--cream-warm); }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 40;
            backdrop-filter: blur(2px);
        }
        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                inset-y: 0;
                left: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .mobile-toggle { display: flex; }
            .topbar-search { width: 200px; }
        }
        @media (max-width: 640px) {
            .topbar-search { display: none; }
            .main-content { padding: 20px 16px; }
            .page-title { font-size: 22px; }
            .welcome-panel { padding: 28px 24px; }
            .welcome-title { font-size: 22px; }
            .stats-grid { gap: 12px; }
        }

        /* ─── PRINT/PDF STYLES ─── */
        @media print {
            .sidebar, .topbar, .sidebar-overlay, .pdf-btn, .btn-classic, .btn-gold, .btn-outline-classic, .mobile-toggle, .welcome-actions, .quick-grid { display: none !important; }
            .main-content { padding: 0 !important; overflow: visible !important; }
            .panel { break-inside: avoid; box-shadow: none !important; border: 1px solid #ddd !important; }
            .stat-card { break-inside: avoid; box-shadow: none !important; }
            body { background: #fff !important; }
            .page-header { display: block !important; }
            .page-header .pdf-btn { display: none !important; }
        }

        /* ─── CLASSIC ORNAMENTAL DIVIDER ─── */
        .ornamental-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
        }
        .ornamental-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-classic), transparent);
        }
        .ornamental-diamond {
            width: 6px;
            height: 6px;
            background: var(--gold);
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        /* ─── FOOTER STAMP ─── */
        .classic-footer {
            text-align: center;
            padding: 20px 0 8px;
            color: var(--ink-faint);
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div style="display:flex; height:100vh; overflow:hidden;">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="sidebar">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">
                    <svg width="18" height="18" fill="none" stroke="#1a1a1a" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <div>
                    <div style="font-family:'Playfair Display',serif; font-size:16px; font-weight:700; color:#f0ebe0; line-height:1.2;">CPRS</div>
                    <div style="font-size:8px; color:var(--sidebar-muted); font-weight:700; letter-spacing:2px; text-transform:uppercase;">{{ env('COUNTY_NAME', 'Cultural Registry') }}</div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-group-label">Overview</div>
                <a href="{{ route('dashboard') }}" class="nav-item active">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                    Dashboard
                </a>

                <div class="nav-group-label">Practitioners</div>
                <a href="{{ route('practitioners.index') }}" class="nav-item">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                    All Practitioners
                </a>
                <a href="{{ route('practitioners.create') }}" class="nav-item">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    Register New
                    <span class="nav-badge">New</span>
                </a>

                <div class="nav-divider"></div>
                <div class="nav-group-label">Manage</div>
                <a href="#" class="nav-item">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h10"/><circle cx="19" cy="17" r="3"/></svg>
                    Categories
                </a>
                <a href="#" class="nav-item">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Locations
                </a>
                <a href="#" class="nav-item">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    Reports
                </a>

                <div class="nav-divider"></div>
                <div class="nav-group-label">System</div>
                <a href="/verify" target="_blank" class="nav-item">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Public Verification
                    <svg class="nav-external" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
                @if(auth()->user()->isSuperAdmin())
                <a href="#" class="nav-item">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
                    Settings
                </a>
                @endif
            </nav>

            <div class="sidebar-user">
                <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div style="min-width:0; flex:1;">
                    <div style="font-size:12px; font-weight:600; color:#f0ebe0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
                    <div style="font-size:9px; color:var(--sidebar-muted); text-transform:uppercase; letter-spacing:1px; font-weight:600;">{{ str_replace('_', ' ', auth()->user()->role) }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-logout" title="Sign out">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- MOBILE OVERLAY -->
        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <!-- MAIN -->
        <div style="flex:1; display:flex; flex-direction:column; overflow:hidden;">
            <!-- TOPBAR -->
            <div class="topbar">
                <div style="display:flex; align-items:center; gap:14px;">
                    <button class="mobile-toggle" onclick="toggleSidebar()">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>
                    <div>
                        <div class="page-title" style="margin-bottom:0; font-size:18px;">Dashboard</div>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="topbar-search">
                        <svg width="15" height="15" fill="none" stroke="var(--ink-faint)" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" placeholder="Search practitioners...">
                        <kbd style="font-size:9px; color:var(--ink-faint); background:var(--cream-warm); padding:2px 6px; border-radius:3px; font-family:'DM Sans',monospace; border:1px solid var(--border-classic);">/</kbd>
                    </div>
                    <button class="pdf-btn" id="pdfBtn" onclick="downloadPDF()">
                        <div class="spinner"></div>
                        <svg class="pdf-icon" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><polyline points="9 15 12 18 15 15"/></svg>
                        <span class="hidden sm:inline">Export PDF</span>
                    </button>
                    <a href="{{ route('practitioners.create') }}" class="btn-gold">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        <span class="hidden sm:inline">Register</span>
                    </a>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="main-content" id="pdfContent">

                @if (session('success'))
                    <div class="alert alert-success">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        {{ session('warning') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if($totalPractitioners === 0)

                <!-- EMPTY STATE -->
                <div class="welcome-panel">
                    <div class="welcome-eyebrow">Established {{ date('Y') }}</div>
                    <div class="welcome-title">Welcome to {{ env('COUNTY_NAME', 'CPRS') }}</div>
                    <div class="welcome-desc">Your Cultural Practitioners Registry is established and ready. Begin by registering your first practitioner to bring the dashboard to life.</div>
                    <div class="welcome-actions">
                        <a href="{{ route('practitioners.create') }}" class="btn-gold">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            Register First Practitioner
                        </a>
                        <a href="/verify" target="_blank" class="btn-outline-warm">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            Verification Portal
                        </a>
                    </div>
                </div>

                <div class="ornamental-divider">
                    <div class="ornamental-line"></div>
                    <div class="ornamental-diamond"></div>
                    <div class="ornamental-line"></div>
                </div>

                <!-- QUICK ACTIONS -->
                <div class="quick-grid">
                    <a href="{{ route('practitioners.create') }}" class="quick-item">
                        <div class="quick-ico" style="background:var(--emerald-pale);">
                            <svg width="16" height="16" fill="none" stroke="var(--emerald)" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                        <div>
                            <div class="quick-label">Register Practitioner</div>
                            <div class="quick-desc">Add to the registry</div>
                        </div>
                        <svg class="quick-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    <a href="/verify" target="_blank" class="quick-item">
                        <div class="quick-ico" style="background:var(--sapphire-pale);">
                            <svg width="16" height="16" fill="none" stroke="var(--sapphire)" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div>
                            <div class="quick-label">Verify Certificate</div>
                            <div class="quick-desc">Public verification</div>
                        </div>
                        <svg class="quick-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    <a href="#" class="quick-item">
                        <div class="quick-ico" style="background:var(--amber-pale);">
                            <svg width="16" height="16" fill="none" stroke="var(--amber)" stroke-width="2" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h10"/><circle cx="19" cy="17" r="3"/></svg>
                        </div>
                        <div>
                            <div class="quick-label">Manage Categories</div>
                            <div class="quick-desc">Configure types</div>
                        </div>
                        <svg class="quick-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    <a href="#" class="quick-item">
                        <div class="quick-ico" style="background:#f5f0ff;">
                            <svg width="16" height="16" fill="none" stroke="#6d28d9" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </div>
                        <div>
                            <div class="quick-label">View Reports</div>
                            <div class="quick-desc">Analytics & trends</div>
                        </div>
                        <svg class="quick-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>

                <!-- BOTTOM ROW -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                    <div class="panel">
                        <div class="panel-header">
                            <div class="panel-title">System Status</div>
                        </div>
                        <div style="padding:20px 24px; display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:8px; height:8px; border-radius:50%; background:var(--emerald);"></div>
                                <span style="font-size:12px; color:var(--ink-muted);">Categories</span>
                                <span style="margin-left:auto; font-family:'Playfair Display',serif; font-size:15px; font-weight:700; color:var(--ink);">{{ $totalCategories }}</span>
                            </div>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:8px; height:8px; border-radius:50%; background:var(--sapphire);"></div>
                                <span style="font-size:12px; color:var(--ink-muted);">Counties</span>
                                <span style="margin-left:auto; font-family:'Playfair Display',serif; font-size:15px; font-weight:700; color:var(--ink);">47</span>
                            </div>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:8px; height:8px; border-radius:50%; background:var(--amber);"></div>
                                <span style="font-size:12px; color:var(--ink-muted);">Certificates</span>
                                <span style="margin-left:auto; font-family:'Playfair Display',serif; font-size:15px; font-weight:700; color:var(--ink);">{{ number_format($totalCertificates) }}</span>
                            </div>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:8px; height:8px; border-radius:50%; background:var(--emerald);"></div>
                                <span style="font-size:12px; color:var(--ink-muted);">Status</span>
                                <span style="margin-left:auto; font-size:12px; font-weight:700; color:var(--emerald); text-transform:uppercase; letter-spacing:0.8px;">Ready</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-header">
                            <div class="panel-title">Categories</div>
                            <span style="font-size:11px; color:var(--ink-faint); font-weight:500;">{{ $totalCategories }} configured</span>
                        </div>
                        <div class="chip-list">
                            @php $allCats = \App\Models\Category::active()->orderBy('name')->take(12)->get(); @endphp
                            @foreach($allCats as $cat)
                                <span class="chip">{{ $cat->name }}</span>
                            @endforeach
                            @if($totalCategories > 12)
                                <span class="chip" style="color:var(--ink-faint);">+{{ $totalCategories - 12 }} more</span>
                            @endif
                        </div>
                    </div>
                </div>

                @else

                <!-- PAGE HEADER -->
                <div class="page-header">
                    <div>
                        <div class="page-title">Registry Overview</div>
                    </div>
                    <div style="display:flex; gap:8px;">
                        <button class="pdf-btn" onclick="downloadPDF()">
                            <div class="spinner"></div>
                            <svg class="pdf-icon" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><polyline points="9 15 12 18 15 15"/></svg>
                            Export PDF
                        </button>
                    </div>
                </div>
                <div class="page-ornament"></div>
                <div class="page-subtitle">Cultural Practitioners Registration System — {{ date('F j, Y') }}</div>

                <!-- STAT CARDS -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background:var(--emerald-pale);">
                            <svg width="20" height="20" fill="none" stroke="var(--emerald)" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                        </div>
                        <div class="stat-value">{{ number_format($totalPractitioners) }}</div>
                        <div class="stat-label">Total Practitioners</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background:var(--sapphire-pale);">
                            <svg width="20" height="20" fill="none" stroke="var(--sapphire)" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div class="stat-value">{{ number_format($activePractitioners) }}</div>
                        <div class="stat-label">Active</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background:var(--amber-pale);">
                            <svg width="20" height="20" fill="none" stroke="var(--amber)" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                        <div class="stat-value">{{ number_format($newThisMonth) }}</div>
                        <div class="stat-label">This Month</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background:var(--ruby-pale);">
                            <svg width="20" height="20" fill="none" stroke="var(--ruby)" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        </div>
                        <div class="stat-value">{{ number_format($expiredCertificates) }}</div>
                        <div class="stat-label">Expired Certs</div>
                    </div>
                </div>

                <!-- MAIN TABLE -->
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title">Recent Registrations</div>
                        <div style="display:flex; align-items:center; gap:14px;">
                            <a href="{{ route('practitioners.index') }}" class="view-all">
                                View all
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                            </a>
                            <a href="{{ route('practitioners.create') }}" class="btn-classic" style="padding:7px 14px; font-size:11px;">
                                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                Add New
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div style="overflow-x:auto;">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Practitioner</th>
                                        <th>Category</th>
                                        <th>Location</th>
                                        <th>Activity</th>
                                        <th>Status</th>
                                        <th>Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentRegistrations as $p)
                                        @php
                                            $badgeClass = match($p->status) {
                                                'Active' => 'badge-active',
                                                'Suspended' => 'badge-suspended',
                                                'Expired' => 'badge-expired',
                                                default => 'badge-pending',
                                            };
                                            $nameParts = explode(' ', $p->name ?? '', 2);
                                            $initials = strtoupper(substr($nameParts[0] ?? '', 0, 1)) . strtoupper(substr($nameParts[1] ?? '', 0, 1));
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="name-cell">
                                                    <div class="name-avatar">{{ $initials }}</div>
                                                    <div>
                                                        <div class="name-text">{{ $p->name ?? 'Unknown' }}</div>
                                                        <div class="name-sub">{{ $p->email ?? '—' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $p->category?->name ?? '—' }}</td>
                                            <td>{{ $p->subCounty?->name ?? '—' }}</td>
                                            <td style="color:var(--ink-muted); font-size:12px;">{{ $p->activity ?? '—' }}</td>
                                            <td><span class="badge {{ $badgeClass }}">{{ $p->status }}</span></td>
                                            <td style="color:var(--ink-muted); font-size:12px;">{{ $p->created_at?->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="ornamental-divider">
                    <div class="ornamental-line"></div>
                    <div class="ornamental-diamond"></div>
                    <div class="ornamental-line"></div>
                </div>

                <!-- CHARTS ROW -->
                <div style="display:grid; grid-template-columns:1fr 300px 1fr; gap:20px; margin-top:4px;">

                    <!-- BY CATEGORY -->
                    <div class="panel">
                        <div class="panel-header">
                            <div class="panel-title">By Category</div>
                            <span style="font-size:11px; color:var(--ink-faint); font-weight:500;">{{ $totalCategories }} categories</span>
                        </div>
                        <div class="panel-body">
                            @if($byCategory->isEmpty())
                                <div class="empty-state">
                                    <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h10"/><circle cx="19" cy="17" r="3"/></svg>
                                    <div class="empty-state-text">No categorized data yet</div>
                                </div>
                            @else
                                @php $maxCount = $byCategory->first()->count; @endphp
                                @foreach($byCategory as $index => $item)
                                    @php
                                        $pct = $maxCount > 0 ? round(($item->count / $maxCount) * 100) : 0;
                                        $colors = ['#b8860b','#2d6a4f','#1e40af','#9b2226','#b45309','#6d28d9','#0f766e','#c2410c'];
                                        $c = $colors[$index % count($colors)];
                                    @endphp
                                    <div class="chart-row">
                                        <div class="chart-dot" style="background:{{ $c }};"></div>
                                        <div class="chart-label">{{ $item->category?->name ?? 'Uncategorized' }}</div>
                                        <div class="chart-bar-bg">
                                            <div class="chart-bar-fill" style="width:{{ $pct }}%; background:{{ $c }};"></div>
                                        </div>
                                        <div class="chart-num">{{ $item->count }}</div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- GENDER DONUT -->
                    <div class="panel">
                        <div class="panel-header">
                            <div class="panel-title">Gender</div>
                        </div>
                        @php
                            $m = $byGender['Male']->count ?? 0;
                            $f = $byGender['Female']->count ?? 0;
                            $o = $byGender['Other']->count ?? 0;
                            $t = $m + $f + $o;
                            $mp = $t > 0 ? round(($m/$t)*100) : 0;
                            $fp = $t > 0 ? round(($f/$t)*100) : 0;
                            $op = $t > 0 ? 100 - $mp - $fp : 0;
                        @endphp
                        <div class="donut-wrap" style="flex-direction:column; align-items:center; gap:16px;">
                            @if($t === 0)
                                <div class="empty-state" style="padding: 24px 0;">
                                    <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    <div class="empty-state-text">No gender data yet</div>
                                </div>
                            @else
                                <div style="position:relative; width:100px; height:100px;">
                                    <svg viewBox="0 0 36 36" style="width:100%; height:100%; transform:rotate(-90deg);">
                                        <circle cx="18" cy="18" r="14" fill="none" stroke="var(--cream-dark)" stroke-width="3"/>
                                        <circle cx="18" cy="18" r="14" fill="none" stroke="var(--sapphire)" stroke-width="3" stroke-dasharray="{{ $mp*0.88 }} 88" stroke-linecap="round"/>
                                        <circle cx="18" cy="18" r="14" fill="none" stroke="#be185d" stroke-width="3" stroke-dasharray="{{ $fp*0.88 }} 88" stroke-dashoffset="-{{ $mp*0.88 }}" stroke-linecap="round"/>
                                        @if($op > 0)
                                        <circle cx="18" cy="18" r="14" fill="none" stroke="var(--gold)" stroke-width="3" stroke-dasharray="{{ $op*0.88 }} 88" stroke-dashoffset="-{{ ($mp+$fp)*0.88 }}" stroke-linecap="round"/>
                                        @endif
                                    </svg>
                                    <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center;">
                                        <span style="font-family:'Playfair Display',serif; font-size:20px; font-weight:700; color:var(--ink);">{{ $t }}</span>
                                    </div>
                                </div>
                                <div style="width:100%;">
                                    <div class="donut-legend-item">
                                        <div class="donut-legend-left">
                                            <div class="donut-dot" style="background:var(--sapphire);"></div>
                                            <span class="donut-legend-label">Male</span>
                                        </div>
                                        <span class="donut-legend-val">{{ $m }} <span style="font-family:'DM Sans';font-size:10px;color:var(--ink-faint);font-weight:500;">({{ $mp }}%)</span></span>
                                    </div>
                                    <div class="donut-legend-item">
                                        <div class="donut-legend-left">
                                            <div class="donut-dot" style="background:#be185d;"></div>
                                            <span class="donut-legend-label">Female</span>
                                        </div>
                                        <span class="donut-legend-val">{{ $f }} <span style="font-family:'DM Sans';font-size:10px;color:var(--ink-faint);font-weight:500;">({{ $fp }}%)</span></span>
                                    </div>
                                    @if($op > 0)
                                    <div class="donut-legend-item">
                                        <div class="donut-legend-left">
                                            <div class="donut-dot" style="background:var(--gold);"></div>
                                            <span class="donut-legend-label">Other</span>
                                        </div>
                                        <span class="donut-legend-val">{{ $o }} <span style="font-family:'DM Sans';font-size:10px;color:var(--ink-faint);font-weight:500;">({{ $op }}%)</span></span>
                                    </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- MONTHLY TREND -->
                    <div class="panel">
                        <div class="panel-header">
                            <div class="panel-title">Monthly Trend</div>
                            <span style="font-size:11px; color:var(--ink-faint); font-weight:500;">Last 6 months</span>
                        </div>
                        @php
                            $months = [];
                            for($i = 5; $i >= 0; $i--) {
                                $d = \Carbon\Carbon::now()->subMonths($i);
                                $months[] = (object)[
                                    'label' => $d->format('M'),
                                    'count' => \App\Models\Practitioner::whereMonth('created_at', $d->month)->whereYear('created_at', $d->year)->count()
                                ];
                            }
                            $trendMax = max(collect($months)->pluck('count')->toArray()) ?: 1;
                        @endphp
                        <div class="trend-wrap">
                            @foreach($months as $m)
                                @php $h = max(4, round(($m->count / $trendMax) * 90)); @endphp
                                <div class="trend-col">
                                    <div class="trend-val">{{ $m->count }}</div>
                                    <div class="trend-bar" style="height:{{ $h }}px; background:linear-gradient(180deg, var(--gold), var(--gold-light));"></div>
                                    <div class="trend-label">{{ $m->label }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="classic-footer" style="margin-top:8px;">
                    {{ env('COUNTY_NAME', 'Cultural Practitioners Registry') }} &mdash; Generated {{ date('F j, Y \a\t g:i A') }}
                </div>

                @endif
            </div>
        </div>
    </div>

    <!-- PDF TOAST -->
    <div class="pdf-toast" id="pdfToast">
        <svg width="18" height="18" fill="none" stroke="var(--gold-light)" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
        <span>Report exported successfully</span>
    </div>

    <script>
        // ─── SIDEBAR TOGGLE ───
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('open');
        }

        // ─── KEYBOARD SHORTCUT ───
        document.addEventListener('keydown', function(e) {
            if (e.key === '/' && !['INPUT','TEXTAREA','SELECT'].includes(document.activeElement.tagName)) {
                e.preventDefault();
                const search = document.querySelector('.topbar-search input');
                if (search) search.focus();
            }
            if (e.key === 'Escape') closeSidebar();
        });

        // ─── PDF DOWNLOAD ───
        function downloadPDF() {
            const buttons = document.querySelectorAll('.pdf-btn');
            const content = document.getElementById('pdfContent');

            // Show loading state on all PDF buttons
            buttons.forEach(btn => btn.classList.add('loading'));

            const opt = {
                margin: [12, 10, 12, 10],
                filename: 'CPRS-Dashboard-Report-' + new Date().toISOString().slice(0,10) + '.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    backgroundColor: '#faf8f4',
                    logging: false
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'landscape'
                },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
            };

            html2pdf().set(opt).from(content).save().then(function() {
                buttons.forEach(btn => btn.classList.remove('loading'));
                showToast();
            }).catch(function() {
                buttons.forEach(btn => btn.classList.remove('loading'));
            });
        }

        function showToast() {
            const toast = document.getElementById('pdfToast');
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3500);
        }
    </script>
</body>
</html>