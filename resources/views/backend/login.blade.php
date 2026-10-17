<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Sign In — Trend Wear</title>
    <meta name="description" content="Sign in to your Trend Wear admin dashboard to manage your store." />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        :root {
            --tw-orange: #f05a28;
            --tw-orange-dark: #d94a18;
            --tw-orange-light: #fff4f0;
            --tw-dark: #1a1a2e;
            --tw-text: #2d2d3a;
            --tw-muted: #8a8a99;
            --tw-border: #e8e8f0;
            --tw-card-bg: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background: #1a1018;
        }

        /* ─── Full-page wrapper ─── */
        .login-page {
            min-height: 100vh;
            display: flex;
            flex-direction: row;
            position: relative;
            background-image:
                linear-gradient(to right,
                    rgba(10, 8, 15, 0.10) 0%,
                    rgba(10, 8, 15, 0.05) 55%,
                    rgba(10, 8, 15, 0.22) 100%
                ),
                url('{{ asset('assets/img/login-bagrount.png') }}');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }

        /* ─── LEFT PANEL ─── */
        .login-left {
            flex: 1 1 55%;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }

        .login-left__bg {
            display: none;
        }

        /* Gradient overlay — darkens bottom-left for readability */
        .login-left__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                160deg,
                rgba(240, 90, 40, 0.04) 0%,
                rgba(15, 10, 20, 0.05) 40%,
                rgba(15, 10, 20, 0.62) 80%,
                rgba(240, 90, 40, 0.28) 100%
            );
        }

        /* Top-left brand mark on left panel */
        .login-left__brand {
            position: absolute;
            top: 2rem;
            left: 2.25rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            z-index: 2;
        }

        .login-left__brand .brand-logo-icon {
            width: 40px;
            height: 40px;
        }

        .login-left__brand .brand-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.01em;
        }

        /* Bottom content on left panel */
        .login-left__content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2.5rem 2.25rem 2.75rem;
            z-index: 2;
        }

        .login-left__tagline {
            font-size: 2rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.25;
            margin-bottom: 0.35rem;
        }

        .login-left__tagline span {
            color: var(--tw-orange);
        }

        .login-left__sub {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.72);
            margin-bottom: 2rem;
        }

        /* Stats row */
        .stats-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .stat-pill {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 50px;
            padding: 0.55rem 1.1rem;
        }

        .stat-pill__icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(240, 90, 40, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--tw-orange);
            font-size: 0.9rem;
        }

        .stat-pill__text {
            color: #ffffff;
        }

        .stat-pill__text strong {
            display: block;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .stat-pill__text small {
            font-size: 0.72rem;
            opacity: 0.72;
        }

        /* ─── RIGHT PANEL ─── */
        .login-right {
            flex: 0 0 min(500px, 45%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 2.5rem;

            position: relative;
        }



        /* ─── Login Card ─── */
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 20px;
            padding: 2.75rem 2.5rem 2.25rem;
            box-shadow: 0 4px 32px rgba(0, 0, 0, 0.08), 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        /* Card header */
        .card-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1.75rem;
        }

        .card-logo__icon-wrap {
            display: flex;
            align-items: center;
            gap: 0rem;
            margin-bottom: 0.3rem;
        }

        .card-logo__tw {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1;
        }

        .card-logo__tw .letter-t {
            color: var(--tw-orange);
        }

        .card-logo__tw .letter-w {
            color: var(--tw-text);
        }

        .card-logo__name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--tw-text);
            letter-spacing: 0.01em;
        }

        .card-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--tw-text);
            text-align: center;
            margin-bottom: 0.3rem;
        }

        .card-subtitle {
            font-size: 0.85rem;
            color: var(--tw-muted);
            text-align: center;
            margin-bottom: 1.75rem;
        }

        /* Form fields */
        .form-field {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-field__icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--tw-muted);
            font-size: 1rem;
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-field__input {
            width: 100%;
            padding: 0.78rem 1rem 0.78rem 2.75rem;
            border: 1.5px solid var(--tw-border);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: var(--tw-text);
            background: #fafafa;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-field__input::placeholder {
            color: var(--tw-muted);
        }

        .form-field__input:focus {
            border-color: var(--tw-orange);
            background: #ffffff;
            box-shadow: 0 0 0 3.5px rgba(240, 90, 40, 0.10);
        }

        .form-field__input:focus + .form-field__label-icon,
        .form-field:focus-within .form-field__icon {
            color: var(--tw-orange);
        }

        /* Password toggle */
        .form-field__toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--tw-muted);
            cursor: pointer;
            font-size: 1rem;
            padding: 0;
            transition: color 0.2s;
        }

        .form-field__toggle:hover {
            color: var(--tw-orange);
        }

        /* Remember / Forgot row */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.4rem;
            margin-top: 0.25rem;
        }

        .form-check-label {
            font-size: 0.83rem;
            color: var(--tw-text);
            user-select: none;
        }

        .form-check-input:checked {
            background-color: var(--tw-orange);
            border-color: var(--tw-orange);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(240, 90, 40, 0.15);
            border-color: var(--tw-orange);
        }

        .forgot-link {
            font-size: 0.83rem;
            color: var(--tw-orange);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--tw-orange-dark);
            text-decoration: underline;
        }

        /* Sign-in button */
        .btn-signin {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, #f05a28 0%, #e0461a 100%);
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            letter-spacing: 0.01em;
            transition: transform 0.18s, box-shadow 0.18s, background 0.2s;
            box-shadow: 0 4px 16px rgba(240, 90, 40, 0.30);
            margin-bottom: 1.25rem;
        }

        .btn-signin:hover {
            background: linear-gradient(135deg, #e0461a 0%, #c93c0f 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(240, 90, 40, 0.38);
        }

        .btn-signin:active {
            transform: translateY(0);
        }

        /* Divider */
        .or-divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.1rem;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--tw-border);
        }

        .or-divider span {
            font-size: 0.78rem;
            color: var(--tw-muted);
            white-space: nowrap;
        }

        /* Google button */
        .btn-google {
            width: 100%;
            padding: 0.78rem;
            background: #ffffff;
            color: var(--tw-text);
            font-size: 0.88rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            border: 1.5px solid var(--tw-border);
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.65rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            margin-bottom: 1.5rem;
        }

        .btn-google:hover {
            border-color: #c0c0cc;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .btn-google img {
            width: 18px;
            height: 18px;
        }

        /* Footer text */
        .card-footer-text {
            text-align: center;
            font-size: 0.82rem;
            color: var(--tw-muted);
        }

        .card-footer-text a {
            color: var(--tw-orange);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .card-footer-text a:hover {
            color: var(--tw-orange-dark);
            text-decoration: underline;
        }

        /* ─── Responsive: mobile stacks vertically ─── */
        @media (max-width: 991.98px) {
            .login-page {
                flex-direction: column;
            }

            .login-left {
                flex: 0 0 260px;
                min-height: 260px;
            }

            .login-left__tagline {
                font-size: 1.45rem;
            }

            .login-right {
                flex: 1;
                min-height: auto;
                padding: 2rem 1.25rem 2.5rem;
            }

            .login-card {
                max-width: 100%;
                border-radius: 16px;
                padding: 2rem 1.5rem 1.75rem;
            }
        }

        @media (max-width: 575.98px) {
            .login-left {
                flex: 0 0 220px;
                min-height: 220px;
            }

            .login-left__content {
                padding: 1.5rem 1.25rem 1.75rem;
            }

            .login-left__tagline {
                font-size: 1.25rem;
            }

            .stats-row {
                gap: 0.6rem;
            }

            .stat-pill {
                padding: 0.4rem 0.75rem;
            }

            .login-card {
                padding: 1.5rem 1.25rem;
            }
        }

        /* Loading spinner on sign-in */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }
    </style>
</head>

<body>
    <div class="login-page">

        <!-- ════════════════════════════════
             LEFT PANEL — Background image
             ════════════════════════════════ -->
        <div class="login-left">
            <!-- Background image -->
            <div class="login-left__bg"></div>
            <!-- Overlay gradient -->
            <div class="login-left__overlay"></div>

            <!-- Top-left brand -->
            <div class="login-left__brand">
                <!-- TW SVG logo mark -->
                <svg class="brand-logo-icon" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="8" fill="#f05a28"/>
                    <text x="50%" y="58%" dominant-baseline="middle" text-anchor="middle"
                          font-family="Inter,sans-serif" font-weight="800" font-size="18"
                          fill="#ffffff">TW</text>
                </svg>
                <span class="brand-name">Trend Wear</span>
            </div>

            <!-- Bottom content -->
            <div class="login-left__content">
                <p class="login-left__tagline">
                    Welcome back to<br>
                    <span>Trend Wear</span>
                </p>
                <p class="login-left__sub">Manage your store. Grow your style.</p>

                <!-- Stats pills -->
                <div class="stats-row">
                    <div class="stat-pill">
                        <div class="stat-pill__icon">
                            <i class="bi bi-cart3"></i>
                        </div>
                        <div class="stat-pill__text">
                            <strong>1,250+</strong>
                            <small>Orders</small>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-pill__icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="stat-pill__text">
                            <strong>320+</strong>
                            <small>Products</small>
                        </div>
                    </div>
                    <div class="stat-pill">
                        <div class="stat-pill__icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div class="stat-pill__text">
                            <strong>98%</strong>
                            <small>Analytics</small>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /login-left -->


        <!-- ════════════════════════════════
             RIGHT PANEL — Login card
             ════════════════════════════════ -->
        <div class="login-right">

            <!-- Card -->
            <div class="login-card">

                <!-- Logo -->
                <div class="card-logo">
                    <div class="card-logo__icon-wrap">
                        <span class="card-logo__tw"><span class="letter-t">T</span><span class="letter-w">w</span></span>
                    </div>
                    <span class="card-logo__name">Trend wear</span>
                </div>

                <h1 class="card-title">Sign in to your account</h1>
                <p class="card-subtitle">Enter your details to access your dashboard</p>

                <!-- Form -->
                <form id="loginForm" method="POST" action="{{ route('backend.login') }}" novalidate>
                    @csrf

                    <!-- Email field -->
                    <div class="form-field">
                        <i class="bi bi-envelope form-field__icon"></i>
                        <input
                            type="email"
                            id="loginEmail"
                            name="email"
                            class="form-field__input"
                            placeholder="Email address"
                            autocomplete="email"
                            required
                        />
                    </div>

                    <!-- Password field -->
                    <div class="form-field">
                        <i class="bi bi-lock form-field__icon"></i>
                        <input
                            type="password"
                            id="loginPassword"
                            name="password"
                            class="form-field__input"
                            placeholder="Password"
                            autocomplete="current-password"
                            required
                            style="padding-right: 3rem;"
                        />
                        <button type="button" class="form-field__toggle" id="togglePassword" aria-label="Show/hide password">
                            <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>

                    <!-- Remember me / Forgot password -->
                    <div class="form-options">
                        <div class="form-check d-flex align-items-center gap-2 mb-0">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" style="margin-top:0;" />
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>

                    <!-- Sign-in button -->
                    <button type="submit" class="btn-signin" id="signInBtn">
                        <span id="signInText">Sign In</span>
                        <i class="bi bi-arrow-right" id="signInArrow"></i>
                        <span class="spinner-border spinner-border-sm d-none" id="signInSpinner" role="status"></span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="or-divider">
                    <span>or continue with</span>
                </div>

                <!-- Google button -->
                <button type="button" class="btn-google" id="googleSignInBtn">
                    <!-- Google 'G' SVG -->
                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844c-.209 1.125-.843 2.078-1.796 2.717v2.258h2.908c1.702-1.567 2.684-3.875 2.684-6.615z" fill="#4285F4"/>
                        <path d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332C2.438 15.983 5.482 18 9 18z" fill="#34A853"/>
                        <path d="M3.964 10.71c-.18-.54-.282-1.117-.282-1.71s.102-1.17.282-1.71V4.958H.957C.347 6.173 0 7.548 0 9s.347 2.827.957 4.042l3.007-2.332z" fill="#FBBC05"/>
                        <path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0 5.482 0 2.438 2.017.957 4.958l3.007 2.332C4.672 5.163 6.656 3.58 9 3.58z" fill="#EA4335"/>
                    </svg>
                    Sign in with Google
                </button>

                <!-- Footer -->
                <p class="card-footer-text">
                    New to Trend Wear? <a href="mailto:admin@trendwear.com">Contact your administrator</a>
                </p>

            </div><!-- /login-card -->
        </div>
    </div><!-- /login-page -->


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ── Password show/hide ──
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput  = document.getElementById('loginPassword');
        const toggleIcon     = document.getElementById('togglePasswordIcon');

        togglePassword.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            toggleIcon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
        });

        // ── Sign-in spinner ──
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn      = document.getElementById('signInBtn');
            const text     = document.getElementById('signInText');
            const arrow    = document.getElementById('signInArrow');
            const spinner  = document.getElementById('signInSpinner');

            btn.disabled      = true;
            text.textContent  = 'Signing in…';
            arrow.classList.add('d-none');
            spinner.classList.remove('d-none');
        });


    </script>
</body>
</html>