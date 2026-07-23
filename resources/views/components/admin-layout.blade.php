{{-- <!DOCTYPE html>
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
        * { font-family: 'DM Sans', sans-serif; }

        /* Sidebar */
        .sidebar-bg {
            background: linear-gradient(180deg, #0a0f1e 0%, #0d1529 40%, #0f1a30 100%);
        }
        .sidebar-glow {
            position: absolute;
            top: -40px;
            left: -40px;
            width: 160px;
            height: 160px;
            background: radial-gradient(circle, rgba(16,185,129,0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .sidebar-glow-bottom {
            position: absolute;
            bottom: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(16,185,129,0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Nav links */
        .nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            color: #7a8599;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.01em;
        }
        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 3px;
            height: 20px;
            border-radius: 0 3px 3px 0;
            background: #10b981;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-link:hover {
            color: #c8d0dc;
            background: rgba(255,255,255,0.03);
        }
        .nav-link:hover .nav-icon {
            color: #9ca8ba;
        }
        .nav-link.active {
            color: #ffffff;
            background: rgba(16, 185, 129, 0.1);
        }
        .nav-link.active::before {
            transform: translateY(-50%) scaleY(1);
        }
        .nav-link.active .nav-icon {
            color: #10b981;
        }
        .nav-link.active .nav-label {
            font-weight: 600;
        }
        .nav-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            color: #5a6478;
            transition: color 0.25s ease;
        }
        .nav-badge {
            margin-left: auto;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            background: rgba(16,185,129,0.15);
            color: #34d399;
            letter-spacing: 0.03em;
        }
        .nav-external {
            width: 14px;
            height: 14px;
            margin-left: auto;
            color: #3d4659;
            opacity: 0;
            transform: translateX(-4px);
            transition: all 0.25s ease;
        }
        .nav-link:hover .nav-external {
            opacity: 1;
            transform: translateX(0);
        }

        /* Section labels */
        .nav-section {
            font-size: 10px;
            font-weight: 700;
            color: #364057;
            text-transform: uppercase;
            letter-spacing: 1.8px;
            padding: 20px 14px 8px;
        }

        /* Separator */
        .nav-sep {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.04), transparent);
            margin: 4px 14px;
        }

        /* User card */
        .user-card {
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(255,255,255,0.04);
            border-radius: 12px;
            padding: 14px;
            transition: background 0.2s ease;
        }
        .user-card:hover {
            background: rgba(255,255,255,0.04);
        }
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: 800;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(16,185,129,0.3);
        }
        .user-status {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            border: 2px solid #0f1a30;
            position: absolute;
            bottom: -1px;
            right: -1px;
        }
        .logout-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4a5568;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        .logout-btn:hover {
            background: rgba(239,68,68,0.1);
            color: #f87171;
        }

        /* Topbar */
        .topbar-search {
            background: #f8f9fb;
            border: 1px solid #e8ecf1;
            border-radius: 10px;
            transition: all 0.25s ease;
        }
        .topbar-search:focus-within {
            background: #ffffff;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16,185,129,0.1);
        }
        .topbar-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 2px 8px rgba(16,185,129,0.25), 0 1px 2px rgba(16,185,129,0.15);
            transition: all 0.25s ease;
        }
        .topbar-btn:hover {
            box-shadow: 0 4px 16px rgba(16,185,129,0.35), 0 2px 4px rgba(16,185,129,0.2);
            transform: translateY(-1px);
        }

        /* Stat cards */
        .stat-card {
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s ease;
            border: 1px solid #f0f2f5;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px -8px rgba(0,0,0,0.08);
        }
        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stat-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        /* Charts */
        .bar-animate { animation: growWidth 0.8s ease-out forwards; }
        @keyframes growWidth { from { width: 0; } }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .trend-bar { transition: height 0.6s ease-out; }

        /* Scrollbar */
        .sidebar-scroll::-webkit-scrollbar { width: 3px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 3px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.12); }

        /* Mobile overlay */
        .sidebar-overlay {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
    </style>
</head>
<body class="bg-[#f5f6fa] text-gray-900 antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- ═══════════ SIDEBAR ═══════════ -->
        <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-[260px] sidebar-bg text-gray-400 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-hidden">

            <!-- Ambient glow effects -->
            <div class="sidebar-glow"></div>
            <div class="sidebar-glow-bottom"></div>

            <!-- Logo Area -->
            <div class="relative z-10 h-[72px] flex items-center gap-3.5 px-5 border-b border-white/[0.04]">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 via-emerald-500 to-emerald-700 flex items-center justify-center flex-shrink-0 shadow-lg shadow-emerald-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5"/>
                        <path d="M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-[15px] font-extrabold tracking-wide text-white truncate">CPRS</p>
                    <p class="text-[10px] text-emerald-500/60 font-medium truncate">{{ env('COUNTY_NAME', 'Cultural Registry') }}</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="relative z-10 flex-1 py-2 px-3 overflow-y-auto sidebar-scroll">

                <p class="nav-section">Overview</p>

                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                    <span class="nav-label">Dashboard</span>
                </a>

                <p class="nav-section">Practitioners</p>

                <a href="{{ route('practitioners.index') }}" class="nav-link {{ request()->routeIs('practitioners.index') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                    <span class="nav-label">All Practitioners</span>
                </a>

                <a href="{{ route('practitioners.create') }}" class="nav-link {{ request()->routeIs('practitioners.create') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    <span class="nav-label">Register New</span>
                    <span class="nav-badge">New</span>
                </a>

                <div class="nav-sep"></div>
                <p class="nav-section">Manage</p>

                <a href="#" class="nav-link">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h10"/><circle cx="19" cy="17" r="3"/></svg>
                    <span class="nav-label">Categories</span>
                </a>

                <a href="#" class="nav-link">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span class="nav-label">Locations</span>
                </a>

                <a href="#" class="nav-link">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    <span class="nav-label">Reports</span>
                </a>

                <div class="nav-sep"></div>
                <p class="nav-section">System</p>

                <a href="/verify" target="_blank" class="nav-link">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span class="nav-label">Public Verification</span>
                    <svg class="nav-external" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>

                @if(auth()->user()->isSuperAdmin())
                <a href="#" class="nav-link">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
                    <span class="nav-label">Settings</span>
                </a>
                @endif

            </nav>

            <!-- User Profile Card -->
            <div class="relative z-10 p-3">
                <div class="user-card flex items-center gap-3">
                    <div class="relative">
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="user-status"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[13px] font-semibold text-gray-200 truncate leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-emerald-500/70 font-medium capitalize mt-0.5">{{ str_replace('_', ' ', auth()->user()->role) }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn" title="Sign out">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile Overlay -->
        <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/40 z-40 hidden lg:hidden" onclick="closeSidebar()"></div>

        <!-- ═══════════ MAIN CONTENT ═══════════ -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Bar -->
            <header class="h-[72px] bg-white/80 backdrop-blur-md border-b border-gray-200/60 flex items-center justify-between px-5 lg:px-8 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2.5 -ml-2.5 text-gray-400 hover:text-gray-600 rounded-xl hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>
                    <div>
                        <h1 class="text-[17px] font-bold text-gray-900 leading-tight">Dashboard</h1>
                        <p class="text-[11px] text-gray-400 mt-0.5 font-medium">{{ now()->format('l, d F Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="topbar-search hidden sm:flex items-center gap-2.5 px-3.5 py-2.5">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" placeholder="Search practitioners..." class="bg-transparent text-sm text-gray-700 placeholder-gray-400 outline-none w-48 font-medium">
                        <kbd class="hidden lg:inline-flex text-[10px] text-gray-400 bg-gray-100 px-1.5 py-0.5 rounded font-mono">/</kbd>
                    </div>
                    <div class="w-px h-8 bg-gray-100 hidden sm:block"></div>
                    <a href="{{ route('practitioners.create') }}" class="topbar-btn hidden sm:inline-flex items-center gap-2 text-white px-5 py-2.5 rounded-xl text-sm font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Register
                    </a>
                    <!-- Mobile register button -->
                    <a href="{{ route('practitioners.create') }}" class="sm:hidden topbar-btn p-2.5 rounded-xl text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-5 lg:p-8">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-emerald-50/80 border border-emerald-200/80 text-emerald-800 rounded-2xl text-sm flex items-center gap-3.5 fade-in">
                        <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="mb-6 p-4 bg-amber-50/80 border border-amber-200/80 text-amber-800 rounded-2xl text-sm flex items-center gap-3.5 fade-in">
                        <div class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        </div>
                        <span class="font-medium">{{ session('warning') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50/80 border border-red-200/80 text-red-800 rounded-2xl text-sm flex items-center gap-3.5 fade-in">
                        <div class="w-7 h-7 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }
        // Keyboard shortcut: press / to focus search
        document.addEventListener('keydown', function(e) {
            if (e.key === '/' && !['INPUT','TEXTAREA','SELECT'].includes(document.activeElement.tagName)) {
                e.preventDefault();
                const searchInput = document.querySelector('.topbar-search input');
                if (searchInput) searchInput.focus();
            }
        });
    </script>
</body>
</html> --}}