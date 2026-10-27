        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Trend wear</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        :root {
            --primary-orange: #f25625;
            --primary-orange-hover: #e0461a;
            --brand-navy: #233458;
            --brand-dark: #192434;
            --text-muted: #6b7280;
            --border-color: #e2e8f0;
            --input-bg: #ffffff;
        }

        html, body {
            height: 100%;
            width: 100%;
            background-color: #ffffff;
            overflow: hidden;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
        }

        .login-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        /* ---------------- Left Side Panel ---------------- */
        .left-panel {
            flex: 1.05;
            position: relative;
            background-image: url("{{ asset('assets/img/image-left-side.png') }}");
            background-size: cover;
            background-position: center right;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 44px 50px;
            overflow: hidden;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 14px;
            z-index: 2;
        }

        .brand-header .logo-mark {
            height: 38px;
            width: auto;
            object-fit: contain;
        }

        .brand-header .divider {
            color: #d1d5db;
            font-size: 24px;
            font-weight: 300;
            line-height: 1;
        }

        .brand-header .brand-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--brand-dark);
            letter-spacing: -0.5px;
        }

        .left-content {
            margin-top: auto;
            margin-bottom: auto;
            max-width: 380px;
            z-index: 2;
            padding: 10px 0;
        }

        .left-content h1 {
            font-size: 44px;
            font-weight: 700;
            color: var(--brand-dark);
            line-height: 1.18;
            letter-spacing: -1px;
            margin-bottom: 6px;
        }

        .left-content h1 .highlight {
            color: var(--primary-orange);
            font-weight: 800;
            display: block;
        }

        .left-content p {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.5;
            margin-top: 12px;
            max-width: 320px;
        }

        .features-row {
            display: flex;
            align-items: center;
            gap: 32px;
            z-index: 2;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .feature-icon-box {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(242, 86, 37, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-orange);
            font-size: 17px;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .feature-item:hover .feature-icon-box {
            transform: scale(1.08);
        }

        .feature-text h4 {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--brand-dark);
            margin-bottom: 2px;
        }

        .feature-text span {
            font-size: 11.5px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        /* ---------------- Right Side Panel ---------------- */
        .right-panel {
            flex: 0.95;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 40px;
            position: relative;
            background: linear-gradient(135deg, #ffffff 0%, #fff9f5 100%);
            overflow: hidden;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        .login-box h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--brand-dark);
            text-align: center;
            margin-bottom: 36px;
            letter-spacing: -0.4px;
        }

        /* Field Row with left icon outside input */
        .field-row {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 22px;
        }

        .field-icon {
            font-size: 18px;
            color: var(--primary-orange);
            margin-top: 36px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .field-row:focus-within .field-icon {
            color: var(--primary-orange-hover);
            transform: scale(1.1);
        }

        .textbox-1 {
            flex: 1;
        }

        .form-label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--brand-dark);
            margin-bottom: 8px;
        }

        .form-label .required {
            color: var(--primary-orange);
            font-weight: 700;
            margin-left: 2px;
        }

        .form-control {
            width: 100%;
            height: 48px;
            padding: 10px 16px;
            font-size: 14px;
            color: var(--brand-dark);
            background-color: #ffffff;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-size: 13.5px;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3.5px rgba(242, 86, 37, 0.14);
        }

        /* Prevent Chrome/Edge autofill baby-blue background */
        .form-control:-webkit-autofill,
        .form-control:-webkit-autofill:hover,
        .form-control:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 30px #ffffff inset !important;
            -webkit-text-fill-color: var(--brand-dark) !important;
        }

        /* Password input with eye toggle */
        .input-with-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-with-icon .form-control {
            padding-right: 44px;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            color: #94a3b8;
            font-size: 16px;
            cursor: pointer;
            user-select: none;
            transition: color 0.2s ease;
        }

        .toggle-password:hover {
            color: var(--primary-orange);
        }

        .text-danger {
            font-size: 12px;
            color: #ef4444;
            margin-top: 4px;
            font-weight: 500;
        }

        /* Forgot password link centered */
        .forgot-wrapper {
            text-align: center;
            margin: 22px 0 24px;
        }

        .forgot-link {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary-orange);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .forgot-link:hover {
            color: var(--primary-orange-hover);
            text-decoration: underline;
        }

        /* Login button pill centered */
        .btn-wrapper {
            text-align: center;
        }

        .btn-login {
            min-width: 140px;
            padding: 11px 44px;
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            background: linear-gradient(135deg, #f25625 0%, #ff6e3a 100%);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(242, 86, 37, 0.32);
            transition: all 0.25s ease;
            outline: none;
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #e0461a 0%, #f25625 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(242, 86, 37, 0.45);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(242, 86, 37, 0.28);
        }

        .btn-login:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .alert {
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-top: 14px;
            text-align: center;
        }

        .alert-danger {
            background-color: #fff1f0;
            color: #cf1322;
            border: 1px solid #ffa39e;
        }

        .d-none {
            display: none !important;
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .left-panel {
                padding: 32px 36px;
            }
            .left-content h1 {
                font-size: 36px;
            }
        }

        @media (max-width: 860px) {
            html, body {
                overflow-y: auto;
            }
            .login-wrapper {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }
            .left-panel {
                display: none;
            }
            .right-panel {
                min-height: 100vh;
                padding: 40px 24px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <!-- ================= Left Hero Panel ================= -->
        <div class="left-panel">

            <!-- Brand Logo -->
            <div class="brand-header">
                <img src="{{ asset('assets/img/logo-img/logo2.png') }}" alt="Trend wear" class="logo-mark">
                <span class="divider">|</span>
                <span class="brand-title">Trend wear</span>
            </div>

            <!-- Main Heading & Intro -->
            <div class="left-content">
                <h1>Welcome back to <span class="highlight">Trend wear</span></h1>
                <p>Manage your store, users, and products in one place.</p>
            </div>

            <!-- Features Badges -->
            <div class="features-row">
                <div class="feature-item">
                    <div class="feature-icon-box">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Secure</h4>
                        <span>Your data is safe</span>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon-box">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Fast</h4>
                        <span>Better productivity</span>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon-box">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Reliable</h4>
                        <span>We're here for you</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- ================= Right Form Panel ================= -->
        <div class="right-panel">

            <div class="login-box">

                <h1>Login To Your Account</h1>

                <form id="login-form" action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <!-- Email or Username Field -->
                    <div class="field-row">
                        <i class="fa-solid fa-user field-icon"></i>

                        <div class="textbox-1">
                            <label for="email_or_username" class="form-label">
                                Email or Username <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="email_or_username"
                                name="email_or_username"
                                value="{{ old('email_or_username') }}"
                                placeholder="Enter your email or username"
                                autofocus
                            >

                            <div class="text-danger" id="username_error"></div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="field-row">
                        <i class="fa-solid fa-lock field-icon"></i>

                        <div class="textbox-1">
                            <label for="password" class="form-label">
                                Password <span class="required">*</span>
                            </label>

                            <div class="input-with-icon">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="••••••••"
                                >

                                <i
                                    class="fa-solid fa-eye-slash toggle-password"
                                    id="toggle-password"
                                    onclick="togglePasswordVisibility()"
                                ></i>
                            </div>

                            <div class="text-danger" id="password_error"></div>
                        </div>
                    </div>

                    <!-- Forgot Password -->
                    <div class="forgot-wrapper">
                        <a href="{{ url('/forgot-password') }}" class="forgot-link">Forgot Password?</a>
                    </div>

                    <!-- Login Button -->
                    <div class="btn-wrapper">
                        <button class="btn-login" id="login-button" type="submit">Login</button>
                    </div>

                    <!-- Global Alert -->
                    <div class="alert alert-danger d-none" id="login_error"></div>

                </form>

            </div>

        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-password');
            if (!passwordInput || !toggleIcon) return;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        function showLoader() {
            const btn = document.getElementById('login-button');
            if (btn) {
                btn.disabled = true;
                btn.dataset.originalHtml = btn.innerHTML;
                btn.innerText = 'Logging in...';
            }
        }

        function hideLoader() {
            const btn = document.getElementById('login-button');
            if (btn) {
                btn.disabled = false;
                if (btn.dataset.originalHtml) {
                    btn.innerHTML = btn.dataset.originalHtml;
                }
            }
        }

        $(document).ready(function() {
            $('#email_or_username').on('input', function() {
                $('#username_error').text('');
            });
            $('#password').on('input', function() {
                $('#password_error').text('');
            });
        });
    </script>

    <script src="{{ asset('assets/backend-page-js/login.js') }}"></script>

</body>
</html>