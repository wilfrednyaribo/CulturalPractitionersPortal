<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair+display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=dm+sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

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
            --ivory: #fffff8;
            --border-classic: #e2ddd2;
            --border-light: #ede9e0;
            --emerald: #2d6a4f;
            --emerald-pale: #d8f3dc;
            --ruby: #9b2226;
            --ruby-pale: #fde8e8;
            --amber: #b45309;
            --sidebar-bg: #1c1914;
        }

        html { height: 100%; }
        body {
            font-family: 'DM Sans', -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--cream);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .font-serif { font-family: 'Playfair Display', Georgia, serif; }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes expandWidth {
            from { width: 0; }
            to { width: 56px; }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        .anim-up { opacity: 0; animation: fadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .anim-d1 { animation-delay: 0.1s; }
        .anim-d2 { animation-delay: 0.2s; }
        .anim-d3 { animation-delay: 0.3s; }
        .anim-d4 { animation-delay: 0.4s; }
        .anim-d5 { animation-delay: 0.5s; }
        .anim-d6 { animation-delay: 0.6s; }
        .anim-d7 { animation-delay: 0.7s; }
        .anim-d8 { animation-delay: 0.8s; }

        /* ─── LEFT PANEL ─── */
        .login-left {
            flex: 1;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }
        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
        .login-left::after {
            content: '';
            position: absolute;
            top: -20%;
            right: -15%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(184,134,11,0.04);
            pointer-events: none;
        }
        .left-bg-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.02;
            background-image:
                linear-gradient(rgba(184,134,11,1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(184,134,11,1) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }
        .left-glow {
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(184,134,11,0.04);
            pointer-events: none;
        }
        .left-top { position: relative; z-index: 2; }
        .left-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 48px;
        }
        .left-brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(184,134,11,0.3);
        }
        .left-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: #f0ebe0;
            line-height: 1.1;
        }
        .left-brand-sub {
            font-size: 8px;
            color: #6b6152;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
        }
        .left-headline {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            font-weight: 700;
            color: #f0ebe0;
            line-height: 1.15;
            margin-bottom: 16px;
            max-width: 420px;
        }
        .left-headline em {
            font-style: italic;
            color: var(--gold-light);
        }
        .left-desc {
            font-size: 14px;
            color: #9a8e7a;
            line-height: 1.8;
            max-width: 380px;
            font-weight: 300;
        }
        .left-ornament {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 32px;
        }
        .left-orn-line {
            height: 1px;
            background: linear-gradient(90deg, rgba(184,134,11,0.3), transparent);
            animation: expandWidth 0.8s ease 0.5s forwards;
            width: 0;
        }
        .left-orn-diamond {
            width: 6px;
            height: 6px;
            background: var(--gold);
            transform: rotate(45deg);
            opacity: 0;
            animation: fadeIn 0.6s ease 0.8s forwards;
        }
        .left-bottom {
            position: relative;
            z-index: 2;
        }
        .left-features {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .left-feature {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .left-feature-icon {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            background: rgba(184,134,11,0.08);
            border: 1px solid rgba(184,134,11,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .left-feature-text {
            font-size: 13px;
            color: #9a8e7a;
            font-weight: 400;
        }
        .left-feature-text strong {
            color: #c4b99a;
            font-weight: 600;
        }

        /* ─── RIGHT PANEL ─── */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            position: relative;
            min-height: 100vh;
        }
        .login-right::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(180deg, transparent 10%, var(--border-classic) 50%, transparent 90%);
        }
        .login-form-wrap {
            width: 100%;
            max-width: 400px;
        }

        /* ─── SESSION STATUS ─── */
        .session-status {
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 3px solid;
        }
        .session-status.status-success {
            background: var(--emerald-pale);
            color: var(--emerald);
            border-left-color: var(--emerald);
        }

        /* ─── FORM HEADER ─── */
        .form-eyebrow {
            font-size: 9px;
            font-weight: 700;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 8px;
        }
        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 6px;
        }
        .form-subtitle {
            font-size: 13px;
            color: var(--ink-muted);
            margin-bottom: 36px;
        }

        /* ─── FORM FIELDS ─── */
        .field-group {
            margin-bottom: 20px;
        }
        .field-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--ink-muted);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 8px;
        }
        .field-wrap {
            position: relative;
        }
        .field-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-faint);
            pointer-events: none;
            transition: color 0.2s ease;
        }
        .field-input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            background: var(--ivory);
            border: 1px solid var(--border-classic);
            border-radius: 6px;
            font-size: 14px;
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: all 0.25s ease;
        }
        .field-input::placeholder { color: var(--ink-faint); }
        .field-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px var(--gold-ghost), 0 1px 4px rgba(0,0,0,0.04);
        }
        .field-input:focus ~ .field-icon,
        .field-wrap:focus-within .field-icon { color: var(--gold); }
        .field-input.error {
            border-color: var(--ruby);
            box-shadow: 0 0 0 3px rgba(155,34,38,0.06);
        }
        .field-error {
            font-size: 12px;
            color: var(--ruby);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ─── PASSWORD TOGGLE ─── */
        .pass-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--ink-faint);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.15s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pass-toggle:hover { color: var(--ink-muted); background: var(--cream-warm); }

        /* ─── REMEMBER ME ─── */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .remember-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            user-select: none;
        }
        .remember-checkbox {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 1.5px solid var(--border-classic);
            border-radius: 4px;
            background: var(--ivory);
            cursor: pointer;
            transition: all 0.15s ease;
            position: relative;
            flex-shrink: 0;
        }
        .remember-checkbox:checked {
            background: var(--gold);
            border-color: var(--gold);
        }
        .remember-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 2px;
            width: 5px;
            height: 9px;
            border: solid #1a1a1a;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .remember-checkbox:focus-visible {
            box-shadow: 0 0 0 3px var(--gold-ghost);
        }
        .remember-text {
            font-size: 13px;
            color: var(--ink-muted);
        }
        .forgot-link {
            font-size: 12px;
            color: var(--gold);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.15s ease;
            letter-spacing: 0.2px;
        }
        .forgot-link:hover { color: var(--gold-light); }

        /* ─── SUBMIT BUTTON ─── */
        .submit-btn {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #1a1a1a;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            letter-spacing: 0.5px;
            font-family: 'DM Sans', sans-serif;
            box-shadow: 0 2px 12px rgba(184,134,11,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(184,134,11,0.35);
        }
        .submit-btn:active { transform: translateY(0); }

        /* ─── DIVIDER ─── */
        .form-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 28px 0;
        }
        .form-divider-line {
            flex: 1;
            height: 1px;
            background: var(--border-light);
        }
        .form-divider-text {
            font-size: 10px;
            color: var(--ink-faint);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        /* ─── BACK LINK ─── */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 12px;
            color: var(--ink-faint);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.15s ease;
            margin-top: 28px;
        }
        .back-link:hover { color: var(--gold); }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1024px) {
            .login-left { display: none; }
            .login-right { padding: 32px 24px; }
            .login-right::before { display: none; }
            .form-title { font-size: 24px; }
        }
        @media (max-width: 480px) {
            .login-right { padding: 24px 16px; }
            .remember-row { flex-direction: column; align-items: flex-start; gap: 12px; }
            .form-title { font-size: 22px; }
        }

        /* ─── ERROR ALERT ─── */
        .error-alert {
            padding: 14px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: var(--ruby-pale);
            color: var(--ruby);
            border: 1px solid rgba(155,34,38,0.15);
            border-left: 3px solid var(--ruby);
            line-height: 1.5;
        }
        .error-alert svg { flex-shrink: 0; margin-top: 1px; }
    </style>
</head>
<body>

    <!-- LEFT PANEL -->
    <div class="login-left">
        <div class="left-bg-pattern"></div>
        <div class="left-glow"></div>

        <div class="left-top">
            <a href="/" class="left-brand anim-up">
                <div class="left-brand-icon">
                    <svg width="18" height="18" fill="none" stroke="#1a1a1a" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <div>
                    <div class="left-brand-name">{{ config('app.name', 'CPRS') }}</div>
                    <div class="left-brand-sub">{{ env('COUNTY_NAME', 'Cultural Registry') }}</div>
                </div>
            </a>
            <div class="left-headline anim-up anim-d1">
                Preserving Our <em>Cultural Heritage</em> Through Registration
            </div>
            <div class="left-desc anim-up anim-d2">
                A unified system for registering, certifying, and verifying cultural practitioners across the county.
            </div>
            <div class="left-ornament anim-up anim-d3">
                <div class="left-orn-line"></div>
                <div class="left-orn-diamond"></div>
            </div>
        </div>

        <div class="left-bottom">
            <div class="left-features">
                <div class="left-feature anim-up anim-d4">
                    <div class="left-feature-icon">
                        <svg width="16" height="16" fill="none" stroke="var(--gold-light)" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="left-feature-text"><strong>Instant Verification</strong> — Public certificate authentication</div>
                </div>
                <div class="left-feature anim-up anim-d5">
                    <div class="left-feature-icon">
                        <svg width="16" height="16" fill="none" stroke="var(--gold-light)" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <div class="left-feature-text"><strong>Live Analytics</strong> — Dashboard with trends & reports</div>
                </div>
                <div class="left-feature anim-up anim-d6">
                    <div class="left-feature-icon">
                        <svg width="16" height="16" fill="none" stroke="var(--gold-light)" stroke-width="1.8" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div class="left-feature-text"><strong>PDF Export</strong> — Beautifully formatted documents</div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="login-right">
        <div class="login-form-wrap">

            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status status-success anim-up">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('status') }}
                </div>
            @endif

            <!-- General Error -->
            @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
                <div class="error-alert anim-up">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <div class="form-eyebrow {{ session('status') ? '' : 'anim-up' }}">Administration</div>
            <h1 class="form-title {{ session('status') ? 'anim-up' : 'anim-up anim-d1' }}">Welcome Back</h1>
            <p class="form-subtitle {{ session('status') ? 'anim-up' : 'anim-up anim-d2' }}">Sign in to access the registry management portal</p>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="field-group anim-up anim-d3">
                    <label class="field-label" for="email">Email Address</label>
                    <div class="field-wrap">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="field-input {{ $errors->has('email') ? 'error' : '' }}"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="you@example.com"
                        >
                        <svg class="field-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 4L12 13 2 4"/></svg>
                    </div>
                    @error('email')
                        <div class="field-error">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="field-group anim-up anim-d4">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-wrap">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="field-input {{ $errors->has('password') ? 'error' : '' }}"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                        >
                        <svg class="field-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <button type="button" class="pass-toggle" onclick="togglePassword()" aria-label="Toggle password visibility">
                            <svg id="eyeOpen" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg id="eyeClosed" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/><path d="M14.12 14.12a3 3 0 01-4.24-4.24"/></svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-error">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="remember-row anim-up anim-d5">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" id="remember_me" class="remember-checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <span class="remember-text">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="submit-btn anim-up anim-d6">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Sign In
                </button>
            </form>

            <div class="form-divider anim-up anim-d7">
                <div class="form-divider-line"></div>
                <div class="form-divider-text">or</div>
                <div class="form-divider-line"></div>
            </div>

            <a href="/" class="back-link anim-up anim-d8">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Back to homepage
            </a>

        </div>
    </div>

    <script>
        // ─── PASSWORD TOGGLE ───
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                input.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }

        // ─── CLEAR FIELD ERROR ON INPUT ───
        document.querySelectorAll('.field-input').forEach(function(input) {
            input.addEventListener('input', function() {
                this.classList.remove('error');
                const errorEl = this.closest('.field-group').querySelector('.field-error');
                if (errorEl) errorEl.style.display = 'none';
            });
        });

        // ─── AUTO-FOCUS ───
        window.addEventListener('load', function() {
            const emailInput = document.getElementById('email');
            if (emailInput && !emailInput.value) {
                setTimeout(function() { emailInput.focus(); }, 800);
            }
        });
    </script>
</body>
</html>