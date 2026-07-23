<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm+sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { font-family: 'DM Sans', sans-serif; }

        /* SIDEBAR */
        .sidebar {
            background: #111827;
            width: 250px;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .sidebar-logo {
            height: 64px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .sidebar-logo-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sidebar-nav {
            flex: 1;
            padding: 12px 0;
            overflow-y: auto;
        }
        .sidebar-nav::-webkit-scrollbar { width: 0; }
        .nav-group-label {
            font-size: 10px;
            font-weight: 700;
            color: #4b5563;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 16px 20px 6px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 20px;
            font-size: 13px;
            font-weight: 500;
            color: #9ca3af;
            text-decoration: none;
            transition: all 0.15s ease;
            cursor: pointer;
            border-left: 3px solid transparent;
        }
        .nav-item:hover {
            color: #e5e7eb;
            background: rgba(255,255,255,0.04);
        }
        .nav-item.active {
            color: #ffffff;
            background: rgba(16,185,129,0.08);
            border-left-color: #10b981;
        }
        .nav-item .nav-ico {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            opacity: 0.6;
        }
        .nav-item.active .nav-ico { opacity: 1; }
        .nav-item:hover .nav-ico { opacity: 0.85; }
        .nav-badge {
            margin-left: auto;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 10px;
            background: rgba(16,185,129,0.15);
            color: #34d399;
        }
        .nav-external {
            width: 13px;
            height: 13px;
            margin-left: auto;
            opacity: 0;
            transition: opacity 0.15s ease;
        }
        .nav-item:hover .nav-external { opacity: 0.5; }
        .nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.05);
            margin: 8px 20px;
        }
        .sidebar-user {
            padding: 12px 16px;
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }
        .sidebar-logout {
            margin-left: auto;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .sidebar-logout:hover {
            color: #ef4444;
            background: rgba(239,68,68,0.1);
        }

        /* TOPBAR */
        .topbar {
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            flex-shrink: 0;
        }
        .topbar-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 7px 12px;
            width: 280px;
            transition: all 0.15s ease;
        }
        .topbar-search:focus-within {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16,185,129,0.08);
            background: #fff;
        }
        .topbar-search input {
            background: none;
            border: none;
            outline: none;
            font-size: 13px;
            color: #111827;
            width: 100%;
        }
        .topbar-search input::placeholder { color: #9ca3af; }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #10b981;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s ease;
        }
        .btn-primary:hover { background: #059669; }

        /* CONTENT AREA */
        .main-content {
            flex: 1;
            overflow-y: auto;
            background: #f3f4f6;
            padding: 24px;
        }
        .page-title {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }
        .page-subtitle {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 20px;
        }

        /* STAT CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        @media (max-width: 1024px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .stats-grid { grid-template-columns: 1fr; } }
        .stat-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: box-shadow 0.15s ease;
        }
        .stat-card:hover { box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .stat-value {
            font-size: 22px;
            font-weight: 800;
            color: #111827;
            line-height: 1;
        }
        .stat-label {
            font-size: 12px;
            color: #6b7280;
            margin-top: 3px;
            font-weight: 500;
        }

        /* CARDS / PANELS */
        .panel {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
        }
        .panel-title {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
        }
        .panel-body { padding: 0; }

        /* TABLE */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table thead th {
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            padding: 10px 20px;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }
        .data-table tbody td {
            font-size: 13px;
            color: #374151;
            padding: 12px 20px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover { background: #f9fafb; }
        .data-table .name-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .name-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            flex-shrink: 0;
        }
        .name-text {
            font-weight: 600;
            color: #111827;
        }
        .name-sub {
            font-size: 11px;
            color: #9ca3af;
            font-weight: 400;
        }

        /* STATUS BADGES */
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 6px;
        }
        .badge-active { background: #ecfdf5; color: #059669; }
        .badge-suspended { background: #fef2f2; color: #dc2626; }
        .badge-expired { background: #fffbeb; color: #d97706; }
        .badge-pending { background: #eff6ff; color: #2563eb; }

        /* VIEW ALL LINK */
        .view-all {
            font-size: 12px;
            font-weight: 600;
            color: #10b981;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: color 0.15s ease;
        }
        .view-all:hover { color: #059669; }

        /* WELCOME STATE */
        .welcome-panel {
            background: #111827;
            border-radius: 10px;
            padding: 40px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }
        .welcome-panel::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(16,185,129,0.06);
            pointer-events: none;
        }
        .welcome-title {
            font-size: 24px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 8px;
            position: relative;
        }
        .welcome-desc {
            font-size: 14px;
            color: #9ca3af;
            max-width: 480px;
            line-height: 1.6;
            margin-bottom: 24px;
            position: relative;
        }
        .welcome-actions {
            display: flex;
            gap: 10px;
            position: relative;
        }
        .btn-outline-light {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: #d1d5db;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .btn-outline-light:hover {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.25);
            color: #fff;
        }

        /* QUICK ACTIONS GRID */
        .quick-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }
        @media (max-width: 1024px) { .quick-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .quick-grid { grid-template-columns: 1fr; } }
        .quick-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.15s ease;
            cursor: pointer;
        }
        .quick-item:hover {
            border-color: #10b981;
            box-shadow: 0 1px 3px rgba(16,185,129,0.1);
        }
        .quick-ico {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .quick-label {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
        }
        .quick-desc {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 1px;
        }
        .quick-arrow {
            margin-left: auto;
            color: #d1d5db;
            flex-shrink: 0;
        }
        .quick-item:hover .quick-arrow { color: #10b981; }

        /* CATEGORY CHIPS */
        .chip-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 20px;
        }
        .chip {
            font-size: 12px;
            font-weight: 500;
            color: #4b5563;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            padding: 5px 12px;
            border-radius: 6px;
            transition: all 0.15s ease;
        }
        .chip:hover {
            background: #ecfdf5;
            border-color: #a7f3d0;
            color: #065f46;
        }

        /* ALERT */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-warning { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* BAR CHART ROW */
        .chart-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 20px;
        }
        .chart-row + .chart-row { border-top: 1px solid #f9fafb; }
        .chart-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .chart-label {
            font-size: 12px;
            color: #6b7280;
            width: 140px;
            flex-shrink: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .chart-bar-bg {
            flex: 1;
            height: 6px;
            background: #f3f4f6;
            border-radius: 3px;
            overflow: hidden;
        }
        .chart-bar-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.6s ease;
        }
        .chart-num {
            font-size: 12px;
            font-weight: 700;
            color: #111827;
            width: 30px;
            text-align: right;
            flex-shrink: 0;
        }

        /* DONUT + LEGEND */
        .donut-wrap {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 20px;
        }
        .donut-legend-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 4px 0;
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
            color: #6b7280;
        }
        .donut-legend-val {
            font-size: 12px;
            font-weight: 700;
            color: #111827;
        }

        /* TREND BARS */
        .trend-wrap {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 8px;
            height: 120px;
            padding: 16px 20px 12px;
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
            color: #6b7280;
        }
        .trend-bar {
            width: 100%;
            border-radius: 4px 4px 0 0;
            min-height: 4px;
            transition: height 0.5s ease;
        }
        .trend-label {
            font-size: 10px;
            color: #9ca3af;
            font-weight: 500;
        }

        /* MOBILE */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
        }
        .mobile-toggle:hover { background: #f3f4f6; }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 40;
        }
        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                inset-y: 0;
                left: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.25s ease;
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .mobile-toggle { display: flex; }
            .topbar-search { width: 200px; }
        }
        @media (max-width: 640px) {
            .topbar-search { display: none; }
            .main-content { padding: 16px; }
        }
    </style>
</head>
<body class="bg-[#f3f4f6] text-gray-900 antialiased">
    <div style="display:flex; height:100vh; overflow:hidden;">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="sidebar">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">
                    <svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <div>
                    <div style="font-size:14px; font-weight:800; color:#fff; line-height:1.2;">CPRS</div>
                    <div style="font-size:9px; color:#6b7280; font-weight:600; letter-spacing:0.5px; text-transform:uppercase;">{{ env('COUNTY_NAME', 'Cultural Registry') }}</div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-group-label">Overview</div>
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                    Dashboard
                </a>

                <div class="nav-group-label">Practitioners</div>
                <a href="{{ route('practitioners.index') }}" class="nav-item {{ request()->routeIs('practitioners.index') ? 'active' : '' }}">
                    <svg class="nav-ico" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                    All Practitioners
                </a>
                <a href="{{ route('practitioners.create') }}" class="nav-item {{ request()->routeIs('practitioners.create') ? 'active' : '' }}">
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
                    <div style="font-size:12px; font-weight:600; color:#e5e7eb; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
                    <div style="font-size:10px; color:#6b7280; text-transform:capitalize;">{{ str_replace('_', ' ', auth()->user()->role) }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-logout" title="Sign out">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
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
                <div style="display:flex; align-items:center; gap:12px;">
                    <button class="mobile-toggle" onclick="toggleSidebar()">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>
                    <div>
                        <div class="page-title" style="margin-bottom:0;">
                            @if(request()->routeIs('practitioners.create'))
                                Register Practitioner
                            @elseif(request()->routeIs('practitioners.index'))
                                All Practitioners
                            @else
                                Dashboard
                            @endif
                        </div>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="topbar-search">
                        <svg width="15" height="15" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" placeholder="Search practitioners...">
                        <kbd style="font-size:9px; color:#9ca3af; background:#f3f4f6; padding:1px 5px; border-radius:3px; font-family:monospace; border:1px solid #e5e7eb;">/</kbd>
                    </div>
                    <a href="{{ route('practitioners.create') }}" class="btn-primary">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        <span class="hidden sm:inline">Register</span>
                    </a>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="main-content">

                @if (session('success'))
                    <div class="alert alert-success">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')

            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('open');
        }
    </script>
    @stack('scripts')
</body>
</html>