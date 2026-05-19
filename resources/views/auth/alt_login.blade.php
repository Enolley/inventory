<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Login — EmpServe</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.x/tabler-icons.min.css">

    <style>

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
        }

        /* ── Layout ── */

        .page {
            display: flex;
            min-height: 100vh;
        }

        /* ── Left branding panel ── */

        .left-panel {
            width: 44%;
            background: #1b3f8b;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -80px;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -70px;
            left: -50px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        /* Brand */

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: #f47c20;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon i {
            font-size: 20px;
            color: #fff;
        }

        .brand-name {
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: -0.3px;
        }

        /* Hero */

        .hero-text {
            z-index: 1;
        }

        .tagline-pill {
            display: inline-block;
            background: #f47c20;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
            letter-spacing: 0.3px;
        }

        .hero-text h1 {
            color: #fff;
            font-size: 30px;
            font-weight: bold;
            line-height: 1.35;
            margin-bottom: 14px;
        }

        .hero-text p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            line-height: 1.75;
        }

        /* Stats */

        .stats {
            display: flex;
            z-index: 1;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 24px;
        }

        .stat {
            flex: 1;
            border-right: 1px solid rgba(255, 255, 255, 0.12);
            padding-right: 20px;
        }

        .stat:not(:first-child) {
            padding-left: 20px;
        }

        .stat:last-child {
            border-right: none;
        }

        .stat-num {
            color: #f47c20;
            font-size: 22px;
            font-weight: bold;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.55);
            font-size: 12px;
            margin-top: 3px;
        }

        /* ── Right login panel ── */

        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 40px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        }

        /* Card header */

        .card-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .card-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f47c20;
            flex-shrink: 0;
        }

        .card-eyebrow span {
            font-size: 11px;
            font-weight: bold;
            color: #94a3b8;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .card-subtitle {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 28px;
        }

        /* Error */

        .error-box {
            background: #fff7f2;
            border: 1px solid #f4b48a;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 13px;
            color: #7a3200;
        }

        .error-box i {
            font-size: 16px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* Form */

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #475569;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aab0bb;
            font-size: 16px;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 11px 12px 11px 38px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            color: #1e293b;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-input:focus {
            outline: none;
            border-color: #1b3f8b;
            box-shadow: 0 0 0 3px rgba(27, 63, 139, 0.12);
        }

        .form-input::placeholder {
            color: #c0c9d4;
        }

        /* Forgot link */

        .form-footer {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 22px;
        }

        .forgot-link {
            font-size: 13px;
            color: #1b3f8b;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* Submit button */

        .btn-login {
            width: 100%;
            padding: 13px;
            background: #f47c20;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-login i {
            font-size: 16px;
        }

        .btn-login:hover {
            background: #e06b10;
        }

        .btn-login:active {
            transform: scale(0.99);
        }

        /* Footer */

        .card-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #94a3b8;
        }

        .card-footer strong {
            color: #1b3f8b;
        }

        /* ── Responsive ── */

        @media (max-width: 700px) {
            .left-panel {
                display: none;
            }

            .right-panel {
                padding: 24px;
            }
        }

    </style>

</head>
<body>

<div class="page">

    {{-- ── Left branding panel ── --}}

    <div class="left-panel">

        <div class="brand">
            <div class="brand-icon">
                <i class="ti ti-bolt" aria-hidden="true"></i>
            </div>
            <span class="brand-name">EmpServe</span>
        </div>

        <div class="hero-text">
            <div class="tagline-pill">Innovate &middot; Create &middot; Impact</div>
            <h1>Empowering Kenya's youth through technology</h1>
            <p>Building skills, confidence, and connections for young people to shape their futures and their communities.</p>
        </div>

        <div class="stats">
            <div class="stat">
                <div class="stat-num">10K+</div>
                <div class="stat-label">Youth impacted</div>
            </div>
            <div class="stat">
                <div class="stat-num">30+</div>
                <div class="stat-label">Projects</div>
            </div>
            <div class="stat">
                <div class="stat-num">100%</div>
                <div class="stat-label">Community led</div>
            </div>
        </div>

    </div>

    {{-- ── Right login panel ── --}}

    <div class="right-panel">

        <div class="login-card">

            <div class="card-eyebrow">
                <div class="card-dot"></div>
                <span>Inventory System</span>
            </div>

            <h1 class="card-title">Welcome back</h1>
            <p class="card-subtitle">Sign in to your account to continue</p>

            @if(session('error'))
                <div class="error-box">
                    <i class="ti ti-alert-circle" aria-hidden="true"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">

                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email address</label>
                    <div class="input-wrap">
                        <i class="ti ti-mail input-icon" aria-hidden="true"></i>
                        <input
                            class="form-input"
                            type="email"
                            id="email"
                            name="email"
                            placeholder="you@empserve.org"
                            value="{{ old('email') }}"
                            required
                            autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <i class="ti ti-lock input-icon" aria-hidden="true"></i>
                        <input
                            class="form-input"
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required>
                    </div>
                </div>

                <div class="form-footer">
                    <a class="forgot-link" href="#">Forgot password?</a>
                </div>

                <button class="btn-login" type="submit">
                    <i class="ti ti-login" aria-hidden="true"></i>
                    Sign in
                </button>

            </form>

            <div class="card-footer">
                Powered by <strong>EmpServe</strong> &middot; Inventory v2
            </div>

        </div>

    </div>

</div>

</body>
</html>