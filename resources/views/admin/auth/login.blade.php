<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('web/assets/images/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet" />
    <style>
        :root {
            --bg-dark: #0a0c10;
            --bg-card: #10141c;
            --bg-input: #181d28;
            --accent: #4f8ef7;
            --accent-glow: rgba(79, 142, 247, 0.18);
            --accent-2: #a78bfa;
            --border: rgba(255, 255, 255, 0.07);
            --border-focus: rgba(79, 142, 247, 0.5);
            --text-primary: #f1f5ff;
            --text-muted: #6b7a99;
            --text-label: #8b97b8;
            --danger: #f87171;
            --success: #34d399;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background-color: var(--bg-dark);
            font-family: 'Sora', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* animated grid background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(79, 142, 247, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(79, 142, 247, 0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
            z-index: 0;
        }

        /* glowing orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            pointer-events: none;
            z-index: 0;
            animation: float 8s ease-in-out infinite;
        }

        .orb-1 {
            width: 380px;
            height: 380px;
            background: rgba(79, 142, 247, 0.12);
            top: -80px;
            left: -80px;
        }

        .orb-2 {
            width: 300px;
            height: 300px;
            background: rgba(167, 139, 250, 0.10);
            bottom: -60px;
            right: -60px;
            animation-delay: -4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(20px);
            }
        }

        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            padding: 1rem;
        }

        .card-login {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.5rem 2.25rem 2.25rem;
            max-width: 420px;
            margin: 0 auto;
            box-shadow: 0 0 0 1px rgba(79, 142, 247, 0.05), 0 32px 64px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* badge top */
        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(79, 142, 247, 0.1);
            border: 1px solid rgba(79, 142, 247, 0.2);
            color: var(--accent);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 100px;
            margin-bottom: 1.5rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .admin-badge i {
            font-size: 10px;
        }

        .card-title {
            color: var(--text-primary);
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
            letter-spacing: -0.02em;
        }

        .card-subtitle {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 2rem;
        }

        /* form label */
        .form-label {
            color: var(--text-label);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        /* input group */
        .input-group-custom {
            position: relative;
            margin-bottom: 1.1rem;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 15px;
            pointer-events: none;
            z-index: 2;
            transition: color 0.2s;
        }

        .form-control-custom {
            width: 100%;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text-primary);
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            height: 46px;
            padding: 0 42px 0 40px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control-custom::placeholder {
            color: var(--text-muted);
        }

        .form-control-custom:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px var(--accent-glow);
            background: #1a2030;
        }

        .form-control-custom:focus+.input-icon,
        .input-group-custom:focus-within .input-icon {
            color: var(--accent);
        }

        .toggle-pw {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0;
            font-size: 15px;
            z-index: 2;
            transition: color 0.2s;
        }

        .toggle-pw:hover {
            color: var(--accent);
        }

        /* remember / forgot row */
        .form-check-input {
            background-color: var(--bg-input);
            border-color: rgba(255, 255, 255, 0.15);
            width: 16px;
            height: 16px;
            margin-top: 2px;
        }

        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .form-check-label {
            color: var(--text-muted);
            font-size: 13px;
            cursor: pointer;
        }

        .forgot-link {
            color: var(--accent);
            font-size: 13px;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .forgot-link:hover {
            opacity: 0.75;
            text-decoration: underline;
        }

        /* submit button */
        .btn-login {
            width: 100%;
            height: 48px;
            background: var(--accent);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.02em;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 20px rgba(79, 142, 247, 0.3);
            margin-top: 0.5rem;
        }

        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.12) 0%, transparent 60%);
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(79, 142, 247, 0.45);
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        /* divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 1.4rem 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            color: var(--text-muted);
            font-size: 12px;
            white-space: nowrap;
        }

        /* 2FA row */
        .twofa-btn {
            width: 100%;
            height: 44px;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text-label);
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: border-color 0.2s, color 0.2s, background 0.2s;
        }

        .twofa-btn:hover {
            border-color: rgba(167, 139, 250, 0.4);
            color: var(--accent-2);
            background: rgba(167, 139, 250, 0.05);
        }

        /* footer */
        .login-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 2rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--border);
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 6px var(--success);
            display: inline-block;
            margin-right: 6px;
        }

        .footer-status {
            color: var(--text-muted);
            font-size: 11px;
            display: flex;
            align-items: center;
        }

        .footer-version {
            color: var(--text-muted);
            font-size: 11px;
            font-family: 'JetBrains Mono', monospace;
        }

        /* alert */
        .alert-custom {
            background: rgba(248, 113, 113, 0.08);
            border: 1px solid rgba(248, 113, 113, 0.2);
            border-radius: 10px;
            color: var(--danger);
            font-size: 13px;
            padding: 10px 14px;
            display: none;
            margin-bottom: 1rem;
            align-items: center;
            gap: 8px;
        }

        /* loading spinner */
        .spinner-sm {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .btn-login .btn-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
    </style>
</head>

<body>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="login-wrapper">
        <div class="card-login">

            <div class="admin-badge">
                <i class="bi bi-shield-lock-fill"></i> Admin Portal
            </div>

            <h1 class="card-title">Welcome back</h1>
            <p class="card-subtitle">Sign in to access your admin dashboard</p>

            <div class="alert-custom" id="errorAlert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span id="errorMsg">Invalid credentials. Please try again.</span>
            </div>

            <form action="{{ route('admin.authenticate') }}" method="post" id="loginForm" novalidate>
                @csrf
                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group-custom">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" class="form-control-custom" id="email"
                            placeholder="admin@company.com" autocomplete="email" required />
                    </div>
                    @error('email')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group-custom">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" class="form-control-custom" id="password" name="password"
                            placeholder="Enter your password" autocomplete="current-password" required />
                        <button type="button" class="toggle-pw" id="togglePw" title="Toggle visibility">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Remember / Forgot -->
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" />
                        <label class="form-check-label" for="remember">Keep me signed in</label>
                    </div>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-login" id="loginBtn">
                    <div class="btn-content">
                        <div class="spinner-sm" id="spinner"></div>
                        <span id="btnText">Sign In to Dashboard</span>
                    </div>
                </button>

            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <span>or use alternative method</span>
                <div class="divider-line"></div>
            </div>

            <button class="twofa-btn" type="button">
                <i class="bi bi-shield-check"></i>
                Sign in with Two-Factor Authentication
            </button>

            <div class="login-footer">
                <div class="footer-status">
                    <span class="status-dot"></span> All systems operational
                </div>
                <div class="footer-version">v2.4.1</div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePw = document.getElementById('togglePw');
        const pwInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePw.addEventListener('click', () => {
            const isHidden = pwInput.type === 'password';
            pwInput.type = isHidden ? 'text' : 'password';
            eyeIcon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
        });

        const form = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btnText');
        const errorAlert = document.getElementById('errorAlert');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value.trim();
            const pass = document.getElementById('password').value;

            errorAlert.style.display = 'none';

            if (!email || !pass) {
                errorAlert.style.display = 'flex';
                document.getElementById('errorMsg').textContent = 'Please fill in all fields.';
                return;
            }

            // loading state
            loginBtn.disabled = true;
            spinner.style.display = 'block';
            btnText.textContent = 'Authenticating...';

            setTimeout(() => {
                spinner.style.display = 'none';
                loginBtn.disabled = false;
                btnText.textContent = 'Sign In to Dashboard';

                // demo: any email/pass shows success
                if (email && pass.length >= 4) {
                    form.submit();
                } else {
                    errorAlert.style.display = 'flex';
                    document.getElementById('errorMsg').textContent =
                        'Password must be at least 4 characters.';
                }
            }, 1800);
        });
    </script>
</body>

</html>
