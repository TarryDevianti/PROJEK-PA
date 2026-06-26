<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER - SISTEM INFORMASI UKM FMIPA USK</title>
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
        margin: 0;
        position: relative;
        overflow-x: hidden;
    }

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

    .particle-register {
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

    .main-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
        position: relative;
        z-index: 5;
    }

    .register-card {
        width: 100%;
        max-width: 550px;
        text-align: center;
        background: rgba(255, 248, 240, 0.92);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 248, 240, 0.18);
        border-radius: 50px;
        padding: 45px 40px 40px;
        color: #3d2c1e;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35) !important;
        animation: slideUp 0.6s ease-out;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .register-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 40px 100px rgba(0, 0, 0, 0.4) !important;
    }

    .register-card::before {
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

    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .register-card * {
        position: relative;
        z-index: 1;
    }

    .register-card::after {
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

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .register-icon-wrapper {
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

    .register-card h3 {
        font-weight: 800;
        letter-spacing: 2px;
        margin-bottom: 30px;
        color: #3d2c1e;
        position: relative;
        z-index: 1;
        font-size: 1.8rem;
    }

    .register-card h3::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #d4a373, #e9c46a);
        margin: 10px auto 0;
        border-radius: 2px;
        animation: gradientMove 3s ease-in-out infinite;
    }

    .custom-input,
    .custom-select {
        background-color: #fdf8f2 !important;
        border: 2px solid #e8ddd0 !important;
        border-radius: 16px !important;
        padding: 14px 20px;
        font-size: 0.95rem;
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

    .custom-select:focus,
    .custom-select:valid {
        color: #3d2c1e !important;
    }

    .custom-input:focus,
    .custom-select:focus {
        border-color: #d4a373 !important;
        box-shadow: 0 0 0 4px rgba(212, 163, 115, 0.15), 0 4px 20px rgba(212, 163, 115, 0.08);
        transform: translateY(-2px);
    }

    .custom-input:hover,
    .custom-select:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }

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

    .btn-custom {
        border: none;
        border-radius: 50px;
        padding: 12px 40px;
        font-weight: 700;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-custom::before {
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

    .btn-next {
        background: linear-gradient(135deg, #d4a373, #e9c46a);
        color: #3d2c1e;
        box-shadow: 0 8px 25px rgba(212, 163, 115, 0.3);
    }

    .btn-next:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 35px rgba(212, 163, 115, 0.4);
        color: #3d2c1e;
    }

    .btn-back {
        background: linear-gradient(135deg, #b8a89a, #a89788);
        color: white;
        box-shadow: 0 8px 25px rgba(184, 168, 154, 0.3);
    }

    .btn-back:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 35px rgba(184, 168, 154, 0.4);
        color: white;
    }

    .btn-submit {
        background: linear-gradient(135deg, #d4a373, #e9c46a, #f4a261);
        background-size: 200% 200%;
        color: #3d2c1e;
        box-shadow: 0 8px 25px rgba(212, 163, 115, 0.3);
        animation: gradientMove 3s ease-in-out infinite;
    }

    .btn-submit:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 35px rgba(212, 163, 115, 0.4);
        color: #3d2c1e;
    }

    .login-back-text {
        color: #8a7a6a;
        margin-top: 25px;
        font-weight: 400;
        position: relative;
        z-index: 1;
    }

    .login-link {
        background: linear-gradient(135deg, #d4a373, #e9c46a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
    }

    .login-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #d4a373, #e9c46a);
        transition: width 0.3s ease;
    }

    .login-link:hover::after {
        width: 100%;
    }

    .login-link:hover {
        transform: translateX(5px);
    }

    .form-step {
        display: none;
        animation: fadeStep 0.4s ease;
    }

    @keyframes fadeStep {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .form-step-active {
        display: block;
    }

    .alert-danger {
        border-radius: 16px !important;
        border: none !important;
        background: linear-gradient(135deg, #fef2f2, #fee2e2) !important;
        color: #dc2626 !important;
        padding: 14px 20px !important;
        font-weight: 500;
        border-left: 4px solid #dc2626 !important;
    }

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

    @keyframes fadeInOverlay {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .popup-overlay.active {
        display: flex !important;
        align-items: center;
        justify-content: center;
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

    .popup-highlight {
        display: inline-block;
        background: linear-gradient(135deg, #fef2f2, #fecaca);
        color: #dc2626;
        padding: 2px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        margin: 0 2px;
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

    @media(max-width:768px) {
        .register-card {
            margin: 20px;
            padding: 35px 25px 30px;
            border-radius: 35px;
        }

        .register-icon-wrapper {
            font-size: 3.2rem;
        }

        .register-card h3 {
            font-size: 1.4rem;
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

        .btn-custom {
            padding: 10px 30px;
            font-size: 0.9rem;
        }
    }

    @media(max-width:576px) {
        .register-card {
            padding: 25px 20px 25px;
            border-radius: 30px;
        }

        .register-icon-wrapper {
            font-size: 2.8rem;
        }

        .register-card h3 {
            font-size: 1.2rem;
        }

        .custom-input, .custom-select {
            padding: 12px 16px;
            font-size: 0.9rem;
        }

        .input-group-custom .custom-input,
        .input-group-custom .custom-select {
            padding-left: 40px;
        }

        .btn-custom {
            padding: 8px 20px;
            font-size: 0.85rem;
        }
    }

    .form-control, .btn, .popup-container, .popup-overlay {
        transition: all 0.3s ease;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(255,248,240,0.1);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: rgba(212, 163, 115, 0.3);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: rgba(212, 163, 115, 0.5);
    }
    </style>
</head>
<body>

<!-- ==========================================
PARTICLES BACKGROUND - Warna Hangat
========================================== -->
<div class="particles-overlay">
    <div class="particle-register" style="left: 5%; top: 10%; width: 8px; height: 8px; background: #d4a373; animation-delay: 0s;"></div>
    <div class="particle-register" style="left: 15%; top: 30%; width: 12px; height: 12px; background: #e9c46a; animation-delay: 2s;"></div>
    <div class="particle-register" style="left: 25%; top: 60%; width: 6px; height: 6px; background: #f4a261; animation-delay: 4s;"></div>
    <div class="particle-register" style="left: 35%; top: 80%; width: 10px; height: 10px; background: #d4a373; animation-delay: 1s;"></div>
    <div class="particle-register" style="left: 45%; top: 20%; width: 14px; height: 14px; background: #e9c46a; animation-delay: 3s;"></div>
    <div class="particle-register" style="left: 55%; top: 50%; width: 8px; height: 8px; background: #f4a261; animation-delay: 5s;"></div>
    <div class="particle-register" style="left: 65%; top: 70%; width: 6px; height: 6px; background: #d4a373; animation-delay: 2.5s;"></div>
    <div class="particle-register" style="left: 75%; top: 15%; width: 10px; height: 10px; background: #e9c46a; animation-delay: 4.5s;"></div>
    <div class="particle-register" style="left: 85%; top: 45%; width: 8px; height: 8px; background: #f4a261; animation-delay: 1.5s;"></div>
    <div class="particle-register" style="left: 92%; top: 85%; width: 12px; height: 12px; background: #d4a373; animation-delay: 3.5s;"></div>
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
    <div class="register-card">
        
        <div class="register-icon-wrapper">
            <i class="bi bi-person-circle"></i>
        </div>
        <h3 id="form-title">Register</h3>

        @if($errors->any())
            <div class="alert alert-danger p-2 small border-0 text-start mb-3">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        @if(isset($ukm) && $ukm)
            <div class="alert alert-info border-0 rounded-4 shadow-sm" style="background: rgba(212, 163, 115, 0.08); color: #3d2c1e; border-left: 4px solid #d4a373;">
                <i class="bi bi-info-circle me-2"></i>
                Anda akan mendaftar ke UKM <strong>{{ $ukm->nama_ukm }}</strong>
            </div>
        @endif

        <form id="multi-step-form" method="POST" action="{{ url('/register') }}">
            @csrf

            @if(isset($ukm) && $ukm)
                <input type="hidden" name="ukm_slug" value="{{ $ukm->slug }}">
            @endif
            
            <div class="form-step form-step-active" id="step-1">
                <div class="mb-3 input-group-custom">
                    <i class="bi bi-person input-icon"></i>
                    <input type="text" class="form-control custom-input" id="nama" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3 input-group-custom">
                    <i class="bi bi-card-text input-icon"></i>
                    <input type="text" class="form-control custom-input" id="npm-input" placeholder="NPM (Nomor Pokok Mahasiswa)" value="{{ old('npm') }}" required>
                </div>
                
                <div class="mb-3 input-group-custom">
                    <i class="bi bi-mortarboard input-icon"></i>
                    <select class="form-select custom-select" id="program_studi" required>
                        <option value="" disabled selected hidden>Pilih Program Studi</option>
                        <option value="KIMIA">KIMIA</option>
                        <option value="MATEMATIKA">MATEMATIKA</option>
                        <option value="INFORMATIKA">INFORMATIKA</option>
                        <option value="FARMASI">FARMASI</option>
                        <option value="FISIKA">FISIKA</option>
                        <option value="MANAJEMEN INFORMATIKA D3">MANAJEMEN INFORMATIKA D3</option>
                        <option value="BIOLOGI">BIOLOGI</option>
                        <option value="STATISTIKA">STATISTIKA</option>
                    </select>
                </div>

                <div class="mb-3 input-group-custom">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" class="form-control custom-input" id="email-input" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3 input-group-custom">
                    <i class="bi bi-phone input-icon"></i>
                    <input type="text" class="form-control custom-input" id="telepon-input" placeholder="Nomor Telepon / WA" value="{{ old('telepon') }}" required>
                </div>

                <div class="mt-4">
                    <button type="button" class="btn btn-custom btn-next shadow-sm" onclick="nextStep()">
                        <i class="bi bi-arrow-right-circle me-2"></i>Next
                    </button>
                </div>
            </div>

            <div class="form-step" id="step-2">
                <div class="mb-3 input-group-custom">
                    <i class="bi bi-calendar3 input-icon"></i>
                    <input type="text" class="form-control custom-input" name="angkatan" placeholder="Angkatan (Contoh: 2023)" value="{{ old('angkatan') }}" required>
                </div>

                <div class="mb-3 input-group-custom">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" class="form-control custom-input" name="password" placeholder="Buat Password Akun" required>
                </div>

                <div class="mb-3 input-group-custom">
                    <i class="bi bi-shield-lock input-icon"></i>
                    <input type="password" class="form-control custom-input" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>
                
                <input type="hidden" id="hidden-nama" name="name"> 
                <input type="hidden" id="hidden-npm" name="npm">
                <input type="hidden" id="hidden-prodi" name="program_studi">
                <input type="hidden" id="hidden-email" name="email">
                <input type="hidden" id="hidden-telepon" name="telepon">

                <div class="mt-4">
                    <button type="button" class="btn btn-custom btn-back shadow-sm" onclick="backStep()">
                        <i class="bi bi-arrow-left-circle me-2"></i>Back
                    </button>
                    <button type="submit" class="btn btn-custom btn-submit shadow-sm">
                        <i class="bi bi-person-plus me-2"></i>Daftar Akun
                    </button>
                </div>
            </div>

            <p class="login-back-text">
                Sudah punya akun? <a href="{{ url('/login') }}" class="login-link fw-bold text-decoration-none">Login disini</a>
            </p>
        </form>

    </div>
</div>

<!-- ========================================== -->
<!-- MODERN POPUP -->
<!-- ========================================== -->
<div class="popup-overlay" id="popupOverlay">
    <div class="popup-container">
        <div class="popup-header">
            <div class="popup-icon-wrapper">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <h3 class="popup-title" id="popupTitle">🚫 Akses Ditolak</h3>
        </div>
        <div class="popup-body">
            <p class="popup-message" id="popupMessage">
                Maaf, hanya mahasiswa <strong>FMIPA</strong> yang dapat mendaftar di sistem ini.
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

            <button class="popup-button" onclick="closePopup()">
                <i class="bi bi-check-circle me-2"></i>Mengerti
            </button>
        </div>
    </div>
</div>

<script>
    // ==========================================
    // STEP NAVIGATION
    // ==========================================
    function nextStep() {
        const nama = document.getElementById('nama');
        const npm = document.getElementById('npm-input');
        const prodi = document.getElementById('program_studi');
        const email = document.getElementById('email-input');
        const telepon = document.getElementById('telepon-input');

        // Validasi NPM - cek kode fakultas 08
        const npmValue = npm.value.trim();
        if (npmValue.length >= 4) {
            const kodeFakultas = npmValue.substring(2, 4);
            if (kodeFakultas !== '08') {
                // Tampilkan popup modern
                showPopup(npmValue, kodeFakultas);
                npm.focus();
                return;
            }
        } else if (npmValue.length > 0) {
            // Tampilkan popup untuk format tidak valid
            showInvalidFormatPopup(npmValue);
            npm.focus();
            return;
        }

        // Validasi Step 1
        if (!nama.value || !npmValue || !prodi.value || !email.value || !telepon.value) {
            showErrorPopup('Mohon lengkapi semua data terlebih dahulu!');
            return;
        }

        // Sinkronisasi data ke input hidden
        document.getElementById('hidden-nama').value = nama.value;
        document.getElementById('hidden-npm').value = npmValue;
        document.getElementById('hidden-prodi').value = prodi.value;
        document.getElementById('hidden-email').value = email.value;
        document.getElementById('hidden-telepon').value = telepon.value;

        // Berpindah ke Step 2
        document.getElementById('step-1').classList.remove('form-step-active');
        document.getElementById('step-2').classList.add('form-step-active');
        document.getElementById('form-title').innerText = "🔐 Detail Akun";
    }

    function backStep() {
        document.getElementById('step-2').classList.remove('form-step-active');
        document.getElementById('step-1').classList.add('form-step-active');
        document.getElementById('form-title').innerText = "📝 Register";
    }

    // ==========================================
    // POPUP FUNCTIONS
    // ==========================================
    function showPopup(npm, kodeFakultas) {
        const overlay = document.getElementById('popupOverlay');
        const title = document.getElementById('popupTitle');
        const message = document.getElementById('popupMessage');
        const npmDisplay = document.getElementById('popupNpmDisplay');
        const tahunDisplay = document.getElementById('popupTahun');
        const kodeDisplay = document.getElementById('popupKodeFakultas');
        const statusDisplay = document.getElementById('popupStatus');

        // Ambil tahun dari NPM (2 digit pertama)
        const tahun = npm.substring(0, 2);

        title.innerHTML = '🚫 Akses Ditolak';

        message.innerHTML = `
            Maaf, hanya mahasiswa <strong style="color:#d4a373;">FMIPA</strong>
            yang dapat mendaftar di sistem ini.
            <br>
            <span style="font-size:0.9rem; color:#8a7a6a;">Kode fakultas yang diizinkan adalah <strong style="color:#16a34a;">08</strong></span>
        `;

        npmDisplay.textContent = npm;
        tahunDisplay.textContent = tahun;
        kodeDisplay.textContent = kodeFakultas;
        statusDisplay.innerHTML = '❌ Bukan Mahasiswa FMIPA';

        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function showInvalidFormatPopup(npm) {
        const overlay = document.getElementById('popupOverlay');
        const title = document.getElementById('popupTitle');
        const message = document.getElementById('popupMessage');
        const npmDisplay = document.getElementById('popupNpmDisplay');
        const tahunDisplay = document.getElementById('popupTahun');
        const kodeDisplay = document.getElementById('popupKodeFakultas');
        const statusDisplay = document.getElementById('popupStatus');

        title.innerHTML = '⚠️ Format NPM Tidak Valid';

        message.innerHTML = `
            Format NPM yang Anda masukkan tidak valid.
            <br>
            <span style="font-size:0.9rem; color:#8a7a6a;">Contoh format yang benar: <strong style="color:#d4a373;">2308001010033</strong></span>
        `;

        npmDisplay.textContent = npm;
        tahunDisplay.textContent = '-';
        kodeDisplay.textContent = '???';
        statusDisplay.innerHTML = '❌ Format Tidak Valid';

        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function showErrorPopup(message) {
        const overlay = document.getElementById('popupOverlay');
        const title = document.getElementById('popupTitle');
        const popupMessage = document.getElementById('popupMessage');
        const npmDetail = document.getElementById('popupNpmDetail');

        title.innerHTML = '⚠️ Perhatian';
        popupMessage.innerHTML = message;
        npmDetail.style.display = 'none';

        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closePopup() {
        const overlay = document.getElementById('popupOverlay');
        const npmDetail = document.getElementById('popupNpmDetail');
        
        overlay.classList.remove('active');
        document.body.style.overflow = 'auto';
        
        // Reset detail popup
        setTimeout(() => {
            npmDetail.style.display = 'block';
        }, 300);
    }

    // Close popup dengan klik di luar
    document.getElementById('popupOverlay').addEventListener('click', function(e) {
        if (e.target === this) {
            closePopup();
        }
    });

    // Close popup dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePopup();
        }
    });

    // ==========================================
    // REAL-TIME NPM VALIDATION INDICATOR
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        const npmInput = document.getElementById('npm-input');
        
        npmInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (value.length >= 4) {
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
    });

    // ==========================================
    // ADDITIONAL EFFECT - CARD HOVER GLOW
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        const registerCard = document.querySelector('.register-card');
        
        if (registerCard) {
            registerCard.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 20;
                const rotateY = (centerX - x) / 20;
                
                this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
            });
            
            registerCard.addEventListener('mouseleave', function() {
                this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
            });
        }
    });
</script>

</body>
</html>