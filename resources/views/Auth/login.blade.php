<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEM INFORMASI UKM FMIPA USK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-image: url("{{ asset('assets/img/bg_login.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        color: #ffffff;
        min-height: 100vh;
        overflow-x: hidden;
        margin: 0;
        position: relative;
    }

    /* Overlay gradasi lebih hangat dan natural */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, 
            rgba(20, 15, 10, 0.75) 0%, 
            rgba(40, 30, 20, 0.65) 40%, 
            rgba(60, 45, 30, 0.50) 100%
        );
        z-index: 1;
    }

    /* Efek partikel bergerak dengan warna hangat */
    .particles-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
        overflow: hidden;
    }

    .particle-login {
        position: absolute;
        border-radius: 50%;
        animation: floatParticle 15s ease-in-out infinite;
        opacity: 0.25;
    }

    @keyframes floatParticle {
        0% { transform: translateY(0) translateX(0) scale(1); opacity: 0.2; }
        25% { transform: translateY(-100px) translateX(30px) scale(1.2); opacity: 0.5; }
        50% { transform: translateY(-200px) translateX(-20px) scale(0.8); opacity: 0.3; }
        75% { transform: translateY(-300px) translateX(40px) scale(1.1); opacity: 0.4; }
        100% { transform: translateY(-400px) translateX(0) scale(1); opacity: 0; }
    }

    /* Logo - Tetap Sama */
    .logo-container {
        position: absolute;
        top: 0;
        left: 0;
        background: #ffffff;
        padding: 12px 25px 15px 20px;
        border-bottom-right-radius: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.25);
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border-bottom: 3px solid #d4a373;
    }

    .logo-container:hover {
        transform: scale(1.05) translateY(2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.35);
    }

    .logo-container img {
        height: 55px;
        width: auto;
        object-fit: contain;
    }

    /* Main wrapper */
    .main-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        z-index: 5;
    }

    /* Headline dengan warna hangat */
    .headline-text {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.2;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        animation: slideInLeft 0.8s ease-out;
        position: relative;
        color: #f5e6d3;
    }

    .headline-text .highlight-head {
        background: linear-gradient(135deg, #d4a373, #e9c46a, #f4a261);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientMove 3s ease-in-out infinite;
    }

    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .headline-text::after {
        content: '✦';
        display: block;
        font-size: 1.5rem;
        color: #e9c46a;
        margin-top: 10px;
        -webkit-text-fill-color: #e9c46a;
        animation: pulseGlow 2s ease-in-out infinite;
    }

    @keyframes pulseGlow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.2); }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-60px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Login Card dengan warna hangat */
    .login-card {
        background: rgba(255, 248, 240, 0.92);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 248, 240, 0.18);
        border-radius: 50px;
        padding: 45px 40px 40px;
        color: #3d2c1e;
        width: 100%;
        max-width: 460px;
        margin: auto;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35) !important;
        animation: slideInRight 0.8s ease-out;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 40px 100px rgba(0, 0, 0, 0.4) !important;
    }

    /* Efek glow border dengan warna hangat */
    .login-card::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 50px;
        padding: 2px;
        background: linear-gradient(135deg, #d4a373, #e9c46a, #f4a261, #d4a373);
        background-size: 300% 300%;
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        animation: gradientMove 4s ease-in-out infinite;
        z-index: 0;
        pointer-events: none;
    }

    .login-card * {
        position: relative;
        z-index: 1;
    }

    .login-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(212, 163, 115, 0.06) 0%, transparent 70%);
        animation: pulseGlowCard 4s ease-in-out infinite;
        z-index: 0;
        pointer-events: none;
    }

    @keyframes pulseGlowCard {
        0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.3; }
        50% { transform: scale(1.5) rotate(10deg); opacity: 0.8; }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(60px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .login-card h3 {
        font-weight: 800;
        letter-spacing: 2px;
        color: #3d2c1e;
        position: relative;
        z-index: 1;
        font-size: 1.8rem;
    }

    .login-card h3::after {
        content: '';
        display: block;
        width: 50px;
        height: 4px;
        background: linear-gradient(90deg, #d4a373, #e9c46a);
        margin: 10px auto 0;
        border-radius: 2px;
        animation: gradientMove 3s ease-in-out infinite;
    }

    /* User Icon dengan warna hangat */
    .user-icon-wrapper {
        font-size: 4.2rem;
        background: linear-gradient(135deg, #d4a373, #e9c46a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 5px;
        position: relative;
        z-index: 1;
        display: inline-block;
        padding: 0 20px;
        border-radius: 50%;
        background-size: 200% 200%;
        animation: floatIcon 3s ease-in-out infinite, gradientMove 3s ease-in-out infinite;
    }

    @keyframes floatIcon {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Input dengan warna hangat */
    .custom-input, .custom-select {
        background-color: #fdf8f2 !important;
        border: 2px solid #e8ddd0 !important;
        border-radius: 16px !important;
        padding: 14px 20px;
        font-size: 1rem;
        color: #3d2c1e !important;
        transition: all 0.3s ease;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }

    .custom-input::placeholder {
        color: #b8a89a;
        font-weight: 400;
    }

    .custom-select {
        color: #b8a89a !important;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23b8a89a' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
    }

    .custom-select:focus, .custom-select:valid {
        color: #3d2c1e !important;
    }

    .custom-input:focus, .custom-select:focus {
        border-color: #d4a373 !important;
        box-shadow: 0 0 0 4px rgba(212, 163, 115, 0.15), 0 4px 20px rgba(212, 163, 115, 0.08);
        transform: translateY(-2px);
    }

    .custom-input:hover, .custom-select:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }

    /* Input dengan ikon */
    .input-group-custom {
        position: relative;
    }

    .input-group-custom .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #b8a89a;
        font-size: 1.1rem;
        z-index: 5;
        transition: all 0.3s ease;
    }

    .input-group-custom .custom-input,
    .input-group-custom .custom-select {
        padding-left: 45px;
    }

    .input-group-custom:focus-within .input-icon {
        color: #d4a373;
    }

    /* Button Login dengan warna hangat */
    .btn-login {
        background: linear-gradient(135deg, #d4a373, #e9c46a, #f4a261);
        background-size: 200% 200%;
        color: #3d2c1e;
        border: none;
        border-radius: 50px;
        padding: 14px 55px;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        box-shadow: 0 8px 30px rgba(212, 163, 115, 0.35);
        position: relative;
        overflow: hidden;
        animation: gradientMove 3s ease-in-out infinite;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.15), transparent);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%) rotate(45deg); }
        100% { transform: translateX(100%) rotate(45deg); }
    }

    .btn-login:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 12px 45px rgba(212, 163, 115, 0.45);
        color: #3d2c1e;
    }

    .btn-login:active {
        transform: scale(0.96);
    }

    .register-text {
        font-size: 0.9rem; 
        color: #8a7a6a; 
        font-weight: 500;
        position: relative;
        z-index: 1;
    }

    .register-link {
        background: linear-gradient(135deg, #d4a373, #e9c46a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        transition: all 0.3s ease;
        font-weight: 700;
        position: relative;
    }

    .register-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #d4a373, #e9c46a);
        transition: width 0.3s ease;
    }

    .register-link:hover::after {
        width: 100%;
    }

    .register-link:hover {
        transform: translateX(5px);
    }

    /* Alert */
    .alert-danger {
        border-radius: 16px !important;
        border: none !important;
        background: linear-gradient(135deg, #fef2f2, #fee2e2) !important;
        color: #dc2626 !important;
        padding: 14px 20px !important;
        font-weight: 500;
        border-left: 4px solid #dc2626 !important;
    }

    /* ========================================== */
    /* MODERN POPUP LOGIN - Warna Hangat */
    /* ========================================== */
    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(20, 15, 10, 0.7);
        backdrop-filter: blur(15px);
        z-index: 9999;
        animation: fadeInOverlay 0.4s ease;
    }

    .popup-overlay.active {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeInOverlay {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .popup-container {
        background: linear-gradient(135deg, #fdf8f2, #f5ede6);
        border-radius: 35px;
        max-width: 480px;
        width: 90%;
        padding: 0;
        box-shadow: 0 40px 100px rgba(0,0,0,0.5);
        animation: popIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        overflow: hidden;
        position: relative;
        border: 1px solid rgba(255,248,240,0.1);
    }

    @keyframes popIn {
        0% {
            opacity: 0;
            transform: scale(0.5) rotate(-8deg);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
    }

    .popup-header {
        background: linear-gradient(135deg, #d4a373, #e9c46a, #f4a261);
        padding: 35px 30px 25px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .popup-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulseGlow 3s ease-in-out infinite;
    }

    .popup-header::after {
        content: '🚫';
        position: absolute;
        top: -20px;
        right: -10px;
        font-size: 6rem;
        opacity: 0.05;
        transform: rotate(15deg);
    }

    .popup-icon-wrapper {
        width: 85px;
        height: 85px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 3.5rem;
        color: #ffffff;
        border: 3px solid rgba(255,255,255,0.3);
        animation: pulseIcon 2s ease-in-out infinite;
        position: relative;
        z-index: 1;
        backdrop-filter: blur(5px);
    }

    @keyframes pulseIcon {
        0%, 100% { transform: scale(1); box-shadow: 0 0 20px rgba(255,255,255,0.1); }
        50% { transform: scale(1.1); box-shadow: 0 0 40px rgba(255,255,255,0.2); }
    }

    .popup-title {
        color: #ffffff;
        font-size: 1.6rem;
        font-weight: 800;
        margin: 0;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 20px rgba(0,0,0,0.2);
    }

    .popup-body {
        padding: 30px 30px 25px;
        text-align: center;
    }

    .popup-message {
        color: #3d2c1e;
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .popup-message strong {
        color: #d4a373;
    }

    .popup-npm-detail {
        background: linear-gradient(135deg, #f5ede6, #ede4db);
        border-radius: 16px;
        padding: 18px 22px;
        margin: 15px 0 20px;
        display: inline-block;
        text-align: left;
        width: 100%;
        border: 1px solid rgba(0,0,0,0.03);
    }

    .popup-npm-detail .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        color: #6b5a4a;
        font-size: 0.9rem;
    }

    .popup-npm-detail .detail-item span:last-child {
        font-weight: 600;
        color: #3d2c1e;
    }

    .popup-npm-detail .detail-divider {
        border-top: 1px dashed #d4c8bc;
        margin: 8px 0;
    }

    .popup-npm-detail .highlight-error {
        color: #dc2626;
        font-weight: 700;
        background: #fee2e2;
        padding: 2px 10px;
        border-radius: 6px;
    }

    .popup-npm-detail .highlight-success {
        color: #16a34a;
        font-weight: 700;
        background: #dcfce7;
        padding: 2px 10px;
        border-radius: 6px;
    }

    .popup-button {
        background: linear-gradient(135deg, #d4a373, #e9c46a);
        color: #3d2c1e;
        border: none;
        border-radius: 50px;
        padding: 14px 50px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 30px rgba(212, 163, 115, 0.3);
        cursor: pointer;
        margin-top: 5px;
        position: relative;
        overflow: hidden;
    }

    .popup-button::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.15), transparent);
        animation: shimmer 3s ease-in-out infinite;
    }

    .popup-button:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 40px rgba(212, 163, 115, 0.4);
        color: #3d2c1e;
    }

    .popup-button:active {
        transform: scale(0.96);
    }

    /* Responsive */
    @media(max-width:768px) {
        .headline-text {
            font-size: 1.8rem;
        }

        .login-card {
            padding: 35px 25px 30px;
            border-radius: 35px;
        }

        .login-card h3 {
            font-size: 1.4rem;
        }

        .user-icon-wrapper {
            font-size: 3.2rem;
        }

        .popup-container {
            width: 95%;
        }

        .popup-header {
            padding: 25px 20px 15px;
        }

        .popup-body {
            padding: 25px 20px 20px;
        }

        .popup-icon-wrapper {
            width: 70px;
            height: 70px;
            font-size: 3rem;
        }

        .popup-title {
            font-size: 1.3rem;
        }

        .btn-login {
            padding: 12px 40px;
            font-size: 0.9rem;
        }
    }

    @media(max-width:576px) {
        .headline-text {
            font-size: 1.4rem;
        }

        .login-card {
            padding: 25px 20px 25px;
            border-radius: 30px;
        }

        .login-card h3 {
            font-size: 1.2rem;
        }

        .user-icon-wrapper {
            font-size: 2.8rem;
        }

        .custom-input, .custom-select {
            padding: 12px 16px;
            font-size: 0.9rem;
        }

        .input-group-custom .custom-input,
        .input-group-custom .custom-select {
            padding-left: 40px;
        }

        .btn-login {
            padding: 10px 30px;
            font-size: 0.85rem;
        }
    }
    </style>
</head>
<body>

<!-- ==========================================
PARTICLES BACKGROUND - Warna Hangat
========================================== -->
<div class="particles-overlay">
    <div class="particle-login" style="left: 5%; top: 10%; width: 8px; height: 8px; background: #d4a373; animation-delay: 0s;"></div>
    <div class="particle-login" style="left: 15%; top: 30%; width: 12px; height: 12px; background: #e9c46a; animation-delay: 2s;"></div>
    <div class="particle-login" style="left: 25%; top: 60%; width: 6px; height: 6px; background: #f4a261; animation-delay: 4s;"></div>
    <div class="particle-login" style="left: 35%; top: 80%; width: 10px; height: 10px; background: #d4a373; animation-delay: 1s;"></div>
    <div class="particle-login" style="left: 45%; top: 20%; width: 14px; height: 14px; background: #e9c46a; animation-delay: 3s;"></div>
    <div class="particle-login" style="left: 55%; top: 50%; width: 8px; height: 8px; background: #f4a261; animation-delay: 5s;"></div>
    <div class="particle-login" style="left: 65%; top: 70%; width: 6px; height: 6px; background: #d4a373; animation-delay: 2.5s;"></div>
    <div class="particle-login" style="left: 75%; top: 15%; width: 10px; height: 10px; background: #e9c46a; animation-delay: 4.5s;"></div>
    <div class="particle-login" style="left: 85%; top: 45%; width: 8px; height: 8px; background: #f4a261; animation-delay: 1.5s;"></div>
    <div class="particle-login" style="left: 92%; top: 85%; width: 12px; height: 12px; background: #d4a373; animation-delay: 3.5s;"></div>
</div>

<!-- ==========================================
LOGO
========================================== -->
<div class="logo-container">
    <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo USK">
</div>

<!-- ==========================================
MAIN CONTENT
========================================== -->
<div class="container main-wrapper">
    <div class="row w-100 align-items-center">
        
        <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start col-xl-7">
            <h1 class="headline-text">
                Sistem Informasi<br>
                Unit Kegiatan<br>
                <span class="highlight-head">Mahasiswa FMIPA</span>
            </h1>
        </div>

        <div class="col-lg-6 col-xl-5 d-flex justify-content-center">
            <div class="login-card text-center">
                
                <div class="user-icon-wrapper">
                    <i class="bi bi-person-circle"></i>
                </div>
                
                <h3 class="mb-4">SIGN IN</h3>

                @if($errors->any())
                    <div class="alert alert-danger p-2 small border-0 text-start mb-3">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST" id="loginForm">
                    @csrf
                    
                    <div class="mb-3 input-group-custom">
                        <i class="bi bi-person-badge input-icon"></i>
                        <select class="form-select custom-select" name="role" id="roleSelect" required>
                            <option value="" disabled selected hidden>PILIH KATEGORI LOGIN</option>
                            <option value="anggota">Anggota (Mahasiswa)</option>
                            <option value="pengurus">Admin Pengurus</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                    </div>

                    <div class="mb-3 input-group-custom">
                        <i class="bi bi-card-text input-icon"></i>
                        <input type="text" 
                               class="form-control custom-input" 
                               name="npm" 
                               id="npmInput"
                               placeholder="NPM" 
                               value="{{ old('npm') }}" 
                               required>
                    </div>
                    
                    <div class="mb-4 input-group-custom">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" 
                               class="form-control custom-input" 
                               name="password" 
                               placeholder="PASSWORD" 
                               required>
                    </div>
                    
                    <div class="d-flex justify-content-center mb-2">
                        <button type="submit" class="btn btn-login shadow-sm">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </button>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <p class="mb-0 register-text">
                            Belum mempunyai akun? 
                            <a href="{{ url('/register') }}" class="text-decoration-none fw-bold register-link">
                                Register disini
                            </a>
                        </p>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<!-- ========================================== -->
<!-- MODERN POPUP LOGIN -->
<!-- ========================================== -->
<div class="popup-overlay" id="loginPopup">
    <div class="popup-container">
        <div class="popup-header">
            <div class="popup-icon-wrapper">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h3 class="popup-title">Akses Terbatas</h3>
        </div>
        <div class="popup-body">
            <p class="popup-message" id="popupMessage">
                Maaf, hanya mahasiswa <strong>FMIPA</strong> yang dapat login sebagai anggota.<br>
                <span style="font-size:0.9rem; color:#8a7a6a;">Admin Pengurus dan Super Admin tidak terbatas.</span>
            </p>
            
            <div class="popup-npm-detail" id="popupNpmDetail">
                <div class="detail-item">
                    <span>📋 NPM yang dimasukkan:</span>
                    <span id="popupNpmDisplay" style="font-weight:700;">2307001010033</span>
                </div>
                <div class="detail-divider"></div>
                <div class="detail-item">
                    <span>📅 Tahun Masuk:</span>
                    <span id="popupTahun">23</span>
                </div>
                <div class="detail-item">
                    <span>🏛️ Kode Fakultas:</span>
                    <span id="popupKodeFakultas" class="highlight-error">07</span>
                </div>
                <div class="detail-item">
                    <span>✅ Kode yang diizinkan:</span>
                    <span class="highlight-success">08</span>
                </div>
                <div class="detail-divider"></div>
                <div class="detail-item" style="color:#dc2626; font-weight:600;">
                    <span>⚠️ Status:</span>
                    <span style="color:#dc2626;" id="popupStatus">❌ Bukan Mahasiswa FMIPA</span>
                </div>
            </div>

            <button class="popup-button" onclick="closeLoginPopup()">
                <i class="bi bi-check-circle me-2"></i>Mengerti
            </button>
        </div>
    </div>
</div>

<script>
    // ==========================================
    // LOGIN POPUP FUNCTIONS
    // ==========================================
    function showLoginPopup(npm, kodeFakultas) {
        const overlay = document.getElementById('loginPopup');
        const npmDisplay = document.getElementById('popupNpmDisplay');
        const kodeDisplay = document.getElementById('popupKodeFakultas');
        const tahunDisplay = document.getElementById('popupTahun');
        const statusDisplay = document.getElementById('popupStatus');
        
        // Ambil tahun dari NPM (2 digit pertama)
        const tahun = npm.substring(0, 2);
        
        npmDisplay.textContent = npm;
        tahunDisplay.textContent = tahun;
        kodeDisplay.textContent = kodeFakultas;
        statusDisplay.innerHTML = '❌ Bukan Mahasiswa FMIPA';
        
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function showInvalidFormatPopup(npm) {
        const overlay = document.getElementById('loginPopup');
        const npmDisplay = document.getElementById('popupNpmDisplay');
        const kodeDisplay = document.getElementById('popupKodeFakultas');
        const tahunDisplay = document.getElementById('popupTahun');
        const statusDisplay = document.getElementById('popupStatus');
        const message = document.getElementById('popupMessage');
        
        message.innerHTML = `
            Format NPM yang Anda masukkan tidak valid.<br>
            <span style="font-size:0.9rem; color:#8a7a6a;">Contoh format: <strong style="color:#d4a373;">2308001010033</strong></span>
        `;
        
        npmDisplay.textContent = npm;
        tahunDisplay.textContent = '-';
        kodeDisplay.textContent = '???';
        statusDisplay.innerHTML = '❌ Format Tidak Valid';
        
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLoginPopup() {
        const overlay = document.getElementById('loginPopup');
        const message = document.getElementById('popupMessage');
        
        overlay.classList.remove('active');
        document.body.style.overflow = 'auto';
        
        // Reset message
        setTimeout(() => {
            message.innerHTML = `
                Maaf, hanya mahasiswa <strong>FMIPA</strong> yang dapat login sebagai anggota.<br>
                <span style="font-size:0.9rem; color:#8a7a6a;">Admin Pengurus dan Super Admin tidak terbatas.</span>
            `;
        }, 300);
    }

    // Close popup dengan klik di luar
    document.getElementById('loginPopup').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLoginPopup();
        }
    });

    // Close popup dengan tombol ESC
    document.addEventListener('key    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLoginPopup();
        }
    });

    // ==========================================
    // VALIDASI LOGIN DI CLIENT-SIDE
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loginForm');
        const roleSelect = document.getElementById('roleSelect');
        const npmInput = document.getElementById('npmInput');
        
        // Real-time validation indicator untuk NPM
        npmInput.addEventListener('input', function() {
            const value = this.value.trim();
            const role = roleSelect.value;
            
            // Hanya validasi jika role = anggota
            if (role === 'anggota' && value.length >= 4) {
                const kodeFakultas = value.substring(2, 4);
                if (kodeFakultas === '08') {
                    this.style.borderColor = '#d4a373';
                    this.style.boxShadow = '0 0 0 4px rgba(212, 163, 115, 0.2)';
                } else if (value.length >= 4) {
                    this.style.borderColor = '#dc2626';
                    this.style.boxShadow = '0 0 0 4px rgba(220, 38, 38, 0.15)';
                }
            } else {
                this.style.borderColor = '';
                this.style.boxShadow = '';
            }
        });

        // Validasi saat submit
        form.addEventListener('submit', function(e) {
            const role = roleSelect.value;
            const npmValue = npmInput.value.trim();
            
            // Hanya validasi untuk role ANGGOTA
            if (role === 'anggota') {
                if (npmValue.length >= 4) {
                    const kodeFakultas = npmValue.substring(2, 4);
                    if (kodeFakultas !== '08') {
                        e.preventDefault();
                        showLoginPopup(npmValue, kodeFakultas);
                        npmInput.focus();
                        return false;
                    }
                } else if (npmValue.length > 0) {
                    e.preventDefault();
                    showInvalidFormatPopup(npmValue);
                    npmInput.focus();
                    return false;
                }
            }
            
            // Untuk super_admin dan pengurus, tidak ada validasi
            return true;
        });

        // Reset indikator saat role berubah
        roleSelect.addEventListener('change', function() {
            if (this.value !== 'anggota') {
                npmInput.style.borderColor = '';
                npmInput.style.boxShadow = '';
                npmInput.placeholder = 'NPM';
            } else {
                npmInput.placeholder = 'NPM (contoh: 2308001010033)';
            }
        });

        // Set placeholder awal
        if (roleSelect.value === 'anggota') {
            npmInput.placeholder = 'NPM (contoh: 2308001010033)';
        }
    });

    // ==========================================
    // ADDITIONAL EFFECT - CARD HOVER GLOW
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        const loginCard = document.querySelector('.login-card');
        
        loginCard.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;
            
            this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
        });
        
        loginCard.addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });
</script>

</body>
</html>