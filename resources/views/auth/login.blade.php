<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Kecamatan Tahunan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #040804;
            overflow: hidden;
            position: relative;
        }

        /* ===== ANIMATED BACKGROUND ===== */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
        }

        .bg-image {
            position: absolute;
            inset: -30px;
            background: url('{{ asset("images/Pedesaan.jpg") }}') center/cover no-repeat;
            filter: blur(3px) brightness(0.25) saturate(1.4);
            transform: scale(1.1);
            animation: bgPulse 20s ease-in-out infinite alternate;
        }

        @keyframes bgPulse {
            0% {
                filter: blur(3px) brightness(0.2) saturate(1.2);
                transform: scale(1.1);
            }

            50% {
                filter: blur(2px) brightness(0.28) saturate(1.5);
                transform: scale(1.15);
            }

            100% {
                filter: blur(3px) brightness(0.22) saturate(1.3);
                transform: scale(1.12);
            }
        }

        /* Dark vignette overlay */
        .bg-vignette {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at center, transparent 20%, rgba(4, 8, 4, 0.85) 100%);
        }

        /* ===== FLOATING PARTICLES ===== */
        .particles {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            opacity: 0;
            animation: floatUp linear infinite;
        }

        @keyframes floatUp {
            0% {
                opacity: 0;
                transform: translateY(100vh) scale(0);
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 0.6;
            }

            100% {
                opacity: 0;
                transform: translateY(-20vh) scale(1);
            }
        }

        /* ===== ANIMATED GRADIENT RING ===== */
        .glow-ring {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            border: 1px solid transparent;
            background: conic-gradient(from 0deg, transparent, rgba(61, 122, 66, 0.15), transparent, rgba(201, 168, 76, 0.1), transparent) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            -webkit-mask-composite: destination-out;
            animation: ringRotate 12s linear infinite;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes ringRotate {
            from {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        /* ===== LOGIN CARD ===== */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .login-card {
            position: relative;
            background: rgba(10, 20, 10, 0.55);
            backdrop-filter: blur(40px) saturate(200%);
            -webkit-backdrop-filter: blur(40px) saturate(200%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow:
                0 40px 80px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.03) inset,
                0 1px 0 rgba(255, 255, 255, 0.05) inset;
            animation: cardEnter 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(30px) scale(0.96);
        }

        @keyframes cardEnter {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Animated border glow */
        .login-card::before {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 25px;
            padding: 1px;
            background: linear-gradient(135deg,
                    rgba(61, 122, 66, 0.4) 0%,
                    transparent 25%,
                    transparent 50%,
                    rgba(201, 168, 76, 0.3) 75%,
                    rgba(61, 122, 66, 0.2) 100%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            -webkit-mask-composite: destination-out;
            animation: borderShift 6s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes borderShift {
            0% {
                background-position: 0% 0%;
                opacity: 0.6;
            }

            100% {
                background-position: 200% 200%;
                opacity: 1;
            }
        }

        /* Green glow behind card */
        .login-card::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80%;
            height: 80%;
            transform: translate(-50%, -50%);
            background: radial-gradient(ellipse, rgba(61, 122, 66, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(40px);
        }

        /* ===== LOGO ===== */
        .logo-container {
            text-align: center;
            margin-bottom: 36px;
            animation: logoEnter 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both;
        }

        @keyframes logoEnter {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 16px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(61, 122, 66, 0.3), rgba(201, 168, 76, 0.2));
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .logo-icon img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            border-radius: 12px;
        }

        .logo-icon::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255, 255, 255, 0.1) 50%, transparent 60%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {

            0%,
            100% {
                transform: translateX(-100%);
            }

            50% {
                transform: translateX(100%);
            }
        }

        .logo-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 24px;
            color: #ffffff;
            letter-spacing: -0.02em;
            margin-bottom: 4px;
        }

        .logo-subtitle {
            font-size: 12px;
            color: rgba(201, 168, 76, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.25em;
            font-weight: 500;
        }

        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 22px;
            animation: fieldEnter 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.4s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.5s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes fieldEnter {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.25);
            font-size: 14px;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            color: #ffffff;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.2);
        }

        .form-input:focus {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(61, 122, 66, 0.5);
            box-shadow:
                0 0 0 4px rgba(61, 122, 66, 0.1),
                0 0 30px rgba(61, 122, 66, 0.1);
        }

        .form-input:focus+.input-focus-line,
        .form-input:focus~.input-icon {
            color: rgba(77, 170, 87, 0.9);
        }

        .input-focus-line {
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #3d7a42, #c9a84c);
            border-radius: 0 0 14px 14px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:focus+.input-focus-line {
            left: 0;
            width: 100%;
        }

        /* Toggle password */
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.25);
            cursor: pointer;
            font-size: 14px;
            transition: color 0.3s;
            z-index: 2;
        }

        .toggle-password:hover {
            color: rgba(201, 168, 76, 0.8);
        }

        /* ===== REMEMBER ME ===== */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            animation: fieldEnter 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.65s both;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-checkbox {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.05);
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .remember-checkbox:checked {
            background: linear-gradient(135deg, #3d7a42, #2a5e2e);
            border-color: #4ade80;
        }

        .remember-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 11px;
            font-weight: bold;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .remember-text {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.4);
        }

        .forgot-link {
            font-size: 13px;
            color: rgba(201, 168, 76, 0.6);
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: rgba(201, 168, 76, 1);
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-submit {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.05em;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #1a4a1e 0%, #2d6e31 50%, #1a4a1e 100%);
            background-size: 200% 200%;
            color: #ffffff;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fieldEnter 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.7s both;
            box-shadow:
                0 4px 20px rgba(61, 122, 66, 0.25),
                0 0 0 1px rgba(61, 122, 66, 0.2) inset;
        }

        .btn-submit:hover {
            background-position: 100% 100%;
            transform: translateY(-2px);
            box-shadow:
                0 8px 40px rgba(61, 122, 66, 0.4),
                0 0 0 1px rgba(77, 170, 87, 0.3) inset,
                0 0 60px rgba(61, 122, 66, 0.15);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Button shine effect */
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-text {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* ===== DIVIDER ===== */
        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            animation: fieldEnter 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.8s both;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
        }

        .divider-text {
            padding: 0 16px;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
            letter-spacing: 0.15em;
        }

        /* ===== BACK TO HOME ===== */
        .back-home {
            text-align: center;
            animation: fieldEnter 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.9s both;
        }

        .back-home a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.35);
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            color: rgba(201, 168, 76, 0.8);
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(201, 168, 76, 0.2);
        }

        /* ===== ERROR MESSAGE ===== */
        .error-msg {
            font-size: 12px;
            color: #f87171;
            margin-top: 6px;
            padding-left: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #fca5a5;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: shakeX 0.5s ease-in-out;
        }

        @keyframes shakeX {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-8px);
            }

            40% {
                transform: translateX(8px);
            }

            60% {
                transform: translateX(-4px);
            }

            80% {
                transform: translateX(4px);
            }
        }

        /* ===== DECORATIVE CORNER ELEMENTS ===== */
        .corner-deco {
            position: absolute;
            width: 60px;
            height: 60px;
            pointer-events: none;
            opacity: 0.15;
        }

        .corner-deco.top-left {
            top: 16px;
            left: 16px;
            border-top: 2px solid #c9a84c;
            border-left: 2px solid #c9a84c;
            border-radius: 4px 0 0 0;
        }

        .corner-deco.top-right {
            top: 16px;
            right: 16px;
            border-top: 2px solid #3d7a42;
            border-right: 2px solid #3d7a42;
            border-radius: 0 4px 0 0;
        }

        .corner-deco.bottom-left {
            bottom: 16px;
            left: 16px;
            border-bottom: 2px solid #3d7a42;
            border-left: 2px solid #3d7a42;
            border-radius: 0 0 0 4px;
        }

        .corner-deco.bottom-right {
            bottom: 16px;
            right: 16px;
            border-bottom: 2px solid #c9a84c;
            border-right: 2px solid #c9a84c;
            border-radius: 0 0 4px 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 480px) {
            .login-card {
                padding: 36px 24px;
                border-radius: 20px;
            }

            .logo-title {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="bg-layer">
        <div class="bg-image"></div>
        <div class="bg-vignette"></div>
    </div>

    <!-- Floating Particles -->
    <div class="particles" id="particles"></div>

    <!-- Rotating Glow Ring -->
    <div class="glow-ring" style="top: 50%; left: 50%;"></div>

    <!-- Login Card -->
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Decorative corners -->
            <div class="corner-deco top-left"></div>
            <div class="corner-deco top-right"></div>
            <div class="corner-deco bottom-left"></div>
            <div class="corner-deco bottom-right"></div>

            <!-- Logo -->
            <div class="logo-container">
                <div class="logo-icon">
                    <img src="{{ asset('images/logo-jepara.png') }}" alt="Logo Jepara">
                </div>
                <div class="logo-title">Admin Panel</div>
                <div class="logo-subtitle">Kecamatan Tahunan</div>
            </div>

            <!-- Error Alert -->
            @if(session('error'))
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login.post') }}" autocomplete="off">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" id="email" class="form-input" placeholder="admin@kecamatan.id"
                            value="{{ old('email') }}" required autofocus>
                        <div class="input-focus-line"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" id="password" class="form-input" placeholder="••••••••"
                            required>
                        <div class="input-focus-line"></div>
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                <div class="remember-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" class="remember-checkbox">
                        <span class="remember-text">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-submit">
                    <span class="btn-text">
                        <i class="fas fa-right-to-bracket"></i>
                        Masuk ke Dashboard
                    </span>
                </button>
            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">atau</span>
                <div class="divider-line"></div>
            </div>

            <div class="back-home">
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Website
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Generate floating particles
        function createParticles() {
            const container = document.getElementById('particles');
            const colors = [
                'rgba(61, 122, 66, 0.6)',
                'rgba(77, 170, 87, 0.4)',
                'rgba(201, 168, 76, 0.3)',
                'rgba(74, 222, 128, 0.3)',
                'rgba(255, 255, 255, 0.15)'
            ];

            for (let i = 0; i < 35; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const size = Math.random() * 4 + 1;
                const color = colors[Math.floor(Math.random() * colors.length)];

                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.background = color;
                particle.style.boxShadow = `0 0 ${size * 3}px ${color}`;
                particle.style.animationDuration = (Math.random() * 15 + 10) + 's';
                particle.style.animationDelay = (Math.random() * 10) + 's';

                container.appendChild(particle);
            }
        }

        createParticles();

        // Add subtle mouse parallax to the card
        const card = document.querySelector('.login-card');
        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth - 0.5) * 8;
            const y = (e.clientY / window.innerHeight - 0.5) * 8;
            card.style.transform = `perspective(1000px) rotateY(${x}deg) rotateX(${-y}deg)`;
        });

        document.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateY(0deg) rotateX(0deg)';
        });
    </script>
</body>

</html>