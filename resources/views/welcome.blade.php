<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi UKM FMIPA USK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3d2c1e;
            --secondary: #5a4a3a;
            --accent-1: #d4a373;
            --accent-2: #e9c46a;
            --accent-3: #f4a261;
            --accent-4: #e8ddd0;
            --accent-5: #f5ede6;
            --bg-light: #fdf8f2;
            --bg-white: #ffffff;
            --text-dark: #3d2c1e;
            --text-muted: #8a7a6a;
            --text-light: #ffffff;
            --shadow: 0 8px 30px rgba(61, 44, 30, 0.08);
            --shadow-hover: 0 15px 50px rgba(61, 44, 30, 0.15);
            --gradient-1: linear-gradient(135deg, #d4a373, #e9c46a);
            --gradient-2: linear-gradient(135deg, #f5ede6, #ede4db);
        }

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* ==========================================
           ANIMATIONS
        ========================================== */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        @keyframes floatReverse {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(10px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }

        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes floatParticle {
            0% { transform: translateY(0) translateX(0); opacity: 0.6; }
            100% { transform: translateY(-150px) translateX(50px); opacity: 0; }
        }

        /* ==========================================
           PARTICLES BACKGROUND
        ========================================== */
        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            animation: floatParticle 10s ease-in-out infinite;
            opacity: 0.3;
        }

        .particle:nth-child(1) { left: 5%; animation-delay: 0s; background: #d4a373; width: 8px; height: 8px; }
        .particle:nth-child(2) { left: 15%; animation-delay: 1.2s; background: #e9c46a; width: 12px; height: 12px; }
        .particle:nth-child(3) { left: 25%; animation-delay: 2.5s; background: #f4a261; width: 6px; height: 6px; }
        .particle:nth-child(4) { left: 35%; animation-delay: 0.8s; background: #d4a373; width: 10px; height: 10px; }
        .particle:nth-child(5) { left: 45%; animation-delay: 1.8s; background: #e9c46a; width: 8px; height: 8px; }
        .particle:nth-child(6) { left: 55%; animation-delay: 3s; background: #f4a261; width: 14px; height: 14px; }
        .particle:nth-child(7) { left: 65%; animation-delay: 0.5s; background: #d4a373; width: 6px; height: 6px; }
        .particle:nth-child(8) { left: 75%; animation-delay: 1.5s; background: #e9c46a; width: 10px; height: 10px; }
        .particle:nth-child(9) { left: 85%; animation-delay: 2.8s; background: #f4a261; width: 8px; height: 8px; }
        .particle:nth-child(10) { left: 95%; animation-delay: 3.5s; background: #d4a373; width: 12px; height: 12px; }

        /* ==========================================
           NAVBAR
        ========================================== */
        .navbar-custom {
            background: rgba(255, 248, 240, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(61, 44, 30, 0.06);
            padding: 12px 0;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1000;
        }

        .navbar-custom.scrolled {
            background: rgba(255, 248, 240, 0.98);
            box-shadow: 0 4px 20px rgba(61, 44, 30, 0.08);
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }

        .navbar-brand-custom .logo-wrapper {
            width: 50px;
            height: 50px;
            flex-shrink: 0;
        }

        .navbar-brand-custom .logo-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .navbar-brand-custom .brand-text {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: 0.5px;
        }

        .navbar-brand-custom .brand-divider {
            width: 2px;
            height: 35px;
            background: var(--text-muted);
            opacity: 0.3;
        }

        .navbar-brand-custom .sub-text {
            font-size: 10px;
            line-height: 1.2;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-link-custom {
            color: var(--text-muted) !important;
            font-weight: 600;
            padding: 8px 18px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            position: relative;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--gradient-1);
            border-radius: 2px;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link-custom:hover {
            color: var(--text-dark) !important;
            background: rgba(212, 163, 115, 0.06);
        }

        .nav-link-custom:hover::after {
            width: 60%;
        }

        .nav-link-custom.active {
            color: var(--accent-1) !important;
            background: rgba(212, 163, 115, 0.08);
        }

        .nav-link-custom.active::after {
            width: 60%;
        }

        .btn-login {
            background: var(--gradient-1);
            color: var(--text-dark) !important;
            font-weight: 600;
            padding: 10px 28px !important;
            border-radius: 50px !important;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 163, 115, 0.25);
            font-size: 0.9rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 163, 115, 0.35);
            color: var(--text-dark) !important;
        }

        /* ==========================================
           HERO SECTION
        ========================================== */
        .hero-section {
            position: relative;
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #fdf8f2 0%, #f5ede6 50%, #ede4db 100%);
            overflow: hidden;
            z-index: 1;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 50%;
            height: 150%;
            background: radial-gradient(ellipse, rgba(212, 163, 115, 0.04), transparent 70%);
            animation: pulseGlow 6s ease-in-out infinite;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 40%;
            height: 100%;
            background: radial-gradient(ellipse, rgba(212, 163, 115, 0.03), transparent 70%);
            animation: pulseGlow 8s ease-in-out infinite 1s;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(212, 163, 115, 0.08);
            border: 1px solid rgba(212, 163, 115, 0.12);
            color: var(--accent-1);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 25px;
            animation: slideInLeft 0.8s ease-out;
        }

        .hero-badge i {
            margin-right: 8px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            animation: slideInLeft 0.8s ease-out 0.1s both;
            color: var(--text-dark);
        }

        .hero-title .highlight {
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientMove 3s ease-in-out infinite;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 520px;
            line-height: 1.8;
            margin-bottom: 35px;
            animation: slideInLeft 0.8s ease-out 0.2s both;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            animation: slideInLeft 0.8s ease-out 0.3s both;
        }

        .btn-hero-primary {
            background: var(--gradient-1);
            color: var(--text-dark);
            font-weight: 600;
            padding: 12px 35px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(212, 163, 115, 0.25);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(212, 163, 115, 0.35);
            color: var(--text-dark);
        }

        .btn-hero-secondary {
            background: var(--bg-white);
            border: 1px solid rgba(61, 44, 30, 0.1);
            color: var(--text-dark);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .btn-hero-secondary:hover {
            border-color: var(--accent-1);
            color: var(--accent-1);
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(61, 44, 30, 0.06);
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 45px;
            animation: slideInLeft 0.8s ease-out 0.4s both;
        }

        .hero-stats .stat-item {
            text-align: left;
        }

        .hero-stats .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
            display: block;
        }

        .hero-stats .stat-number .accent {
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-stats .stat-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .hero-carousel-wrapper {
            position: relative;
            z-index: 2;
            animation: slideInRight 0.8s ease-out 0.2s both;
        }

        .hero-carousel-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-hover);
            position: relative;
            background: var(--bg-white);
            border: 1px solid rgba(212, 163, 115, 0.1);
        }

        .hero-carousel-container::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(61, 44, 30, 0.3), transparent);
            z-index: 1;
            pointer-events: none;
        }

        .hero-carousel-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .hero-carousel-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 25px 30px;
            z-index: 2;
            text-align: left;
        }

        .hero-carousel-caption .tag {
            display: inline-block;
            background: var(--gradient-1);
            color: var(--text-dark);
            padding: 3px 12px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .hero-carousel-caption h5 {
            font-weight: 700;
            margin-bottom: 3px;
            color: white;
            font-size: 1.1rem;
        }

        .hero-carousel-caption p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.7);
            margin: 0;
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-element-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(212, 163, 115, 0.04), transparent);
            top: 5%;
            right: 5%;
            animation: float 8s ease-in-out infinite;
        }

        .floating-element-2 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(233, 196, 106, 0.04), transparent);
            bottom: 10%;
            left: 10%;
            animation: floatReverse 10s ease-in-out infinite;
        }

        /* ==========================================
           UKM SECTION
        ========================================== */
        .ukm-section {
            padding: 80px 0;
            background: var(--bg-white);
            position: relative;
            z-index: 1;
        }

        .ukm-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(212, 163, 115, 0.15), transparent);
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header .subtitle {
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .section-header h2 {
            font-size: 2.4rem;
            font-weight: 800;
            margin: 8px 0 12px;
            color: var(--text-dark);
        }

        .section-header p {
            color: var(--text-muted);
            max-width: 500px;
            margin: 0 auto;
            font-size: 1rem;
        }

        .section-header .divider {
            width: 50px;
            height: 3px;
            background: var(--gradient-1);
            border-radius: 2px;
            margin: 12px auto 0;
            animation: gradientMove 3s ease-in-out infinite;
        }

        .ukm-card {
            background: var(--bg-light);
            border: 1px solid rgba(61, 44, 30, 0.06);
            border-radius: 20px;
            padding: 30px 25px 25px;
            text-align: center;
            height: 100%;
            transition: all 0.4s ease;
            position: relative;
        }

        .ukm-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(212, 163, 115, 0.15);
        }

        .ukm-logo-wrapper {
            width: 120px;
            height: 120px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-white);
            border-radius: 50%;
            padding: 20px;
            box-shadow: var(--shadow);
            transition: all 0.4s ease;
        }

        .ukm-card:hover .ukm-logo-wrapper {
            transform: scale(1.05);
            box-shadow: var(--shadow-hover);
        }

        .ukm-logo-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .ukm-card h4 {
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--text-dark);
            font-size: 1.2rem;
            letter-spacing: 0.5px;
        }

        .ukm-card .ukm-desc {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 18px;
            min-height: 50px;
        }

        .ukm-card .btn-detail {
            background: transparent;
            border: 1px solid rgba(212, 163, 115, 0.2);
            color: var(--accent-1);
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 0.85rem;
        }

        .ukm-card .btn-detail:hover {
            background: var(--gradient-1);
            color: var(--text-dark);
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(212, 163, 115, 0.25);
        }

        .ukm-card .btn-detail i {
            margin-left: 6px;
            transition: transform 0.3s ease;
        }

        .ukm-card .btn-detail:hover i {
            transform: translateX(4px);
        }

        /* ==========================================
           FAQ SECTION
        ========================================== */
        .faq-section {
            padding: 80px 0;
            background: var(--bg-light);
            position: relative;
            z-index: 1;
        }

        .faq-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(212, 163, 115, 0.15), transparent);
        }

        .faq-accordion .accordion-item {
            background: var(--bg-white);
            border: 1px solid rgba(61, 44, 30, 0.06);
            border-radius: 12px !important;
            margin-bottom: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-accordion .accordion-item:hover {
            border-color: rgba(212, 163, 115, 0.15);
        }

        .faq-accordion .accordion-button {
            background: transparent;
            color: var(--text-dark);
            padding: 18px 22px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            box-shadow: none;
        }

        .faq-accordion .accordion-button:not(.collapsed) {
            background: rgba(212, 163, 115, 0.03);
            color: var(--accent-1);
            box-shadow: none;
        }

        .faq-accordion .accordion-button:focus {
            box-shadow: none;
            border-color: transparent;
        }

        .faq-accordion .accordion-button::after {
            width: 18px;
            height: 18px;
            background-size: 18px;
        }

        .faq-accordion .accordion-body {
            padding: 0 22px 18px;
            color: var(--text-muted);
            line-height: 1.8;
            border-top: 1px solid rgba(61, 44, 30, 0.04);
            padding-top: 16px;
            font-size: 0.95rem;
        }

        .faq-accordion .accordion-body .faq-answer-icon {
            color: var(--accent-1);
            margin-right: 10px;
        }

        .faq-empty {
            text-align: center;
            padding: 50px 20px;
            background: var(--bg-white);
            border-radius: 20px;
            border: 1px solid rgba(61, 44, 30, 0.06);
        }

        .faq-empty i {
            font-size: 2.5rem;
            color: var(--text-muted);
            margin-bottom: 12px;
            display: block;
        }

        .faq-empty p {
            color: var(--text-muted);
            margin: 0;
        }

        /* ==========================================
           FOOTER
        ========================================== */
        .footer-section {
            padding: 40px 0;
            background: var(--primary);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
            z-index: 1;
        }

        .footer-section .footer-text {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }

        .footer-section .footer-text a {
            color: var(--accent-1);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .footer-section .footer-text a:hover {
            color: var(--accent-2);
        }

        .footer-socials {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .footer-socials a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            color: rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        .footer-socials a:hover {
            background: var(--accent-1);
            color: var(--primary);
            transform: translateY(-2px);
            border-color: transparent;
        }

        /* ==========================================
           RESPONSIVE
        ========================================== */
        @media (max-width: 991.98px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .hero-carousel-img {
                height: 300px;
            }

            .hero-stats {
                gap: 30px;
            }
        }

        @media (max-width: 767.98px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-section {
                min-height: auto;
                padding: 100px 0 50px;
            }

            .hero-carousel-img {
                height: 220px;
            }

            .hero-stats {
                gap: 20px;
                flex-wrap: wrap;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .ukm-card {
                padding: 20px;
            }

            .ukm-logo-wrapper {
                width: 100px;
                height: 100px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .hero-buttons .btn {
                width: 100%;
                justify-content: center;
            }

            .footer-socials {
                justify-content: center;
                margin-top: 12px;
            }

            .footer-section .footer-text {
                text-align: center;
            }
        }

        @media (max-width: 575.98px) {
            .hero-title {
                font-size: 1.6rem;
            }

            .navbar-brand-custom .brand-text {
                font-size: 1.1rem;
            }

            .navbar-brand-custom .sub-text {
                font-size: 7px;
            }

            .hero-stats .stat-number {
                font-size: 1.4rem;
            }

            .btn-hero-primary,
            .btn-hero-secondary {
                padding: 10px 20px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>

    <!-- ==========================================
    PARTICLES BACKGROUND
    ========================================== -->
    <div class="particles-container">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- ==========================================
    NAVBAR
    ========================================== -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand-custom" href="/">
                <div class="logo-wrapper">
                    <img src="{{ asset('assets/img/logofmipa.png') }}" alt="Logo FMIPA">
                </div>
                <span class="brand-text">FMIPA</span>
                <span class="brand-divider"></span>
                <span class="sub-text">
                    UNIVERSITAS<br>
                    SYIAH KUALA
                </span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1 gap-lg-2" id="mainNavbar">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom active" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#ukm">UKM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ==========================================
    HERO SECTION
    ========================================== -->
    <section class="hero-section" id="hero">
        <div class="floating-element floating-element-1"></div>
        <div class="floating-element floating-element-2"></div>

        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 hero-content">
                    <div class="hero-badge">
                        <i class="bi bi-building"></i>
                        Platform Resmi UKM FMIPA
                    </div>

                    <h1 class="hero-title">
                        Sistem Informasi<br>
                        Unit Kegiatan<br>
                        <span class="highlight">Mahasiswa FMIPA</span>
                    </h1>

                    <p class="hero-subtitle">
                        Wadah kreativitas, kepemimpinan, dan pengembangan diri mahasiswa 
                        Fakultas Matematika dan Ilmu Pengetahuan Alam Universitas Syiah Kuala.
                    </p>

                    <div class="hero-buttons">
                        <a href="#ukm" class="btn-hero-primary">
                            <i class="bi bi-compass"></i>
                            Jelajahi UKM
                        </a>
                        <a href="#faq" class="btn-hero-secondary">
                            <i class="bi bi-question-circle"></i>
                            FAQ
                        </a>
                    </div>

                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number"><span class="accent">3</span></span>
                            <span class="stat-label">UKM Aktif</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><span class="accent">500</span>+</span>
                            <span class="stat-label">Anggota</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><span class="accent">50</span>+</span>
                            <span class="stat-label">Kegiatan/Tahun</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 hero-carousel-wrapper">
                    <div class="hero-carousel-container">
                        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                            </div>

                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="4000">
                                    <img src="{{ asset('assets/img/kegiatan_seuramoe.jpeg') }}" class="hero-carousel-img" alt="Kegiatan Seuramoe">
                                    <div class="hero-carousel-caption">
                                        <span class="tag">Seni & Kreatif</span>
                                        <h5>UKM Seuramoe</h5>
                                        <p>Pentas seni, musik, tari & multimedia</p>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="4000">
                                    <img src="{{ asset('assets/img/kegiatan_ululalbab.jpeg') }}" class="hero-carousel-img" alt="Kegiatan Ulul Albab">
                                    <div class="hero-carousel-caption">
                                        <span class="tag">Dakwah & Karakter</span>
                                        <h5>LDF Ulul Albab</h5>
                                        <p>Syiar Islam & pembinaan karakter</p>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="4000">
                                                                       <img src="{{ asset('assets/img/kegiatan_barracuda.jpg') }}" class="hero-carousel-img" alt="Kegiatan Barracuda">
                                    <div class="hero-carousel-caption">
                                        <span class="tag">Pecinta Alam</span>
                                        <h5>UKM Barracuda</h5>
                                        <p>Jelajah alam & tanggap darurat</p>
                                    </div>
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
    UKM SECTION
    ========================================== -->
    <section class="ukm-section" id="ukm">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="subtitle">✦ Unit Kegiatan Mahasiswa</span>
                <h2>Kenali UKM FMIPA</h2>
                <p>Temukan komunitas pengembang diri yang cocok untukmu</p>
                <div class="divider"></div>
            </div>

            <div class="row g-4">
                <!-- UKM 1: Seuramoe -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="ukm-card">
                        <div class="ukm-logo-wrapper">
                            <img src="{{ asset('assets/img/seuramoe.png') }}" alt="Logo Seuramoe">
                        </div>
                        <h4>SEURAMOE</h4>
                        <p class="ukm-desc">Wadah pengembangan minat bakat di bidang seni suara, musik, tari, dan multimedia kreatif.</p>
                        <a href="{{ route('ukm.detail-publik', ['slug' => 'ukm-seramoe']) }}" class="btn-detail">
                            Detail <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- UKM 2: Ulul Albab -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="ukm-card">
                        <div class="ukm-logo-wrapper">
                            <img src="{{ asset('assets/img/ululalbab.png') }}" alt="Logo Ulul Albab">
                        </div>
                        <h4>LDF ULUL ALBAB</h4>
                        <p class="ukm-desc">Lembaga Dakwah Fakultas yang bergerak dalam syiar Islam, pembinaan karakter, dan ukhuwah.</p>
                        <a href="{{ route('ukm.detail-publik', ['slug' => 'ukm-ldf-ulul-albab']) }}" class="btn-detail">
                            Detail <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- UKM 3: Barracuda -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="ukm-card">
                        <div class="ukm-logo-wrapper">
                            <img src="{{ asset('assets/img/barracuda.png') }}" alt="Logo Barracuda">
                        </div>
                        <h4>BARRACUDA</h4>
                        <p class="ukm-desc">Komunitas pecinta alam FMIPA yang berfokus pada pelestarian alam, jelajah gunung, dan tanggap darurat.</p>
                        <a href="{{ route('ukm.detail-publik', ['slug' => 'ukm-barracuda']) }}" class="btn-detail">
                            Detail <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
    FAQ SECTION
    ========================================== -->
    <section class="faq-section" id="faq">
        <div class="container" style="max-width: 900px;">
            <div class="section-header" data-aos="fade-up">
                <span class="subtitle">❓ Bantuan</span>
                <h2>Frequently Asked Questions</h2>
                <p>Pertanyaan yang paling sering diajukan</p>
                <div class="divider"></div>
            </div>

            @if(isset($faqs) && count($faqs) > 0)
                <div class="accordion faq-accordion" id="accordionFaq">
                    @foreach($faqs as $index => $faq)
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{ $index }}" 
                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                        aria-controls="collapse{{ $index }}">
                                    <i class="bi bi-question-circle me-3" style="color: var(--accent-1);"></i>
                                    {{ $faq->pertanyaan }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" 
                                 class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                                 aria-labelledby="heading{{ $index }}" 
                                 data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <i class="bi bi-arrow-right-circle-fill faq-answer-icon"></i>
                                    {{ $faq->jawaban }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="faq-empty" data-aos="fade-up">
                    <i class="bi bi-chat-left-dots"></i>
                    <p>Belum ada data FAQ yang ditambahkan oleh Admin.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ==========================================
    FOOTER
    ========================================== -->
    <footer class="footer-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="footer-text mb-0">
                        &copy; {{ date('Y') }} <a href="/">Sistem Informasi UKM FMIPA</a> — 
                        Universitas Syiah Kuala
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-socials">
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ==========================================
    SCRIPTS
    ========================================== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        // ==========================================
        // NAVBAR SCROLL EFFECT
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('mainNav');
            
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // ==========================================
            // ACTIVE NAV LINK ON SCROLL
            // ==========================================
            const sections = document.querySelectorAll('section[id], header[id]');
            const navLinks = document.querySelectorAll('#mainNavbar .nav-link-custom');

            const observerOptions = {
                root: null,
                rootMargin: '-30% 0px -60% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        
                        navLinks.forEach(link => {
                            link.classList.remove('active');
                            
                            if (link.getAttribute('href') === `#${id}`) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            }, observerOptions);

            sections.forEach(section => {
                if (section.getAttribute('id')) {
                    observer.observe(section);
                }
            });

            // ==========================================
            // SMOOTH SCROLL FOR NAV LINKS
            // ==========================================
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId && targetId.startsWith('#')) {
                        e.preventDefault();
                        const target = document.querySelector(targetId);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });

            // ==========================================
            // CLOSE MOBILE MENU ON LINK CLICK
            // ==========================================
            const navbarCollapse = document.getElementById('navbarNav');
            const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                toggle: false
            });

            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        bsCollapse.hide();
                    }
                });
            });
        });

        // ==========================================
        // CAROUSEL AUTO PLAY WITH PAUSE ON HOVER
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('heroCarousel');
            if (carousel) {
                const bsCarousel = new bootstrap.Carousel(carousel, {
                    interval: 4000,
                    pause: 'hover',
                    wrap: true,
                    touch: true
                });

                const carouselContainer = carousel.closest('.hero-carousel-container');
                if (carouselContainer) {
                    carouselContainer.addEventListener('mouseenter', function() {
                        bsCarousel.pause();
                    });
                    carouselContainer.addEventListener('mouseleave', function() {
                        bsCarousel.cycle();
                    });
                }
            }
        });

        // ==========================================
        // COUNTER ANIMATION FOR STATS
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            const statNumbers = document.querySelectorAll('.stat-number');
            
            const animateNumber = (element, target, duration) => {
                const start = 0;
                const increment = target / (duration / 16);
                let current = start;
                
                const updateNumber = () => {
                    current += increment;
                    if (current < target) {
                        element.textContent = Math.floor(current);
                        requestAnimationFrame(updateNumber);
                    } else {
                        element.textContent = target;
                    }
                };
                
                updateNumber();
            };

            const statObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const text = element.textContent;
                        const number = parseInt(text.replace(/[^0-9]/g, ''));
                        
                        if (!isNaN(number) && number > 0) {
                            const accentSpan = element.querySelector('.accent');
                            if (accentSpan) {
                                const accentNumber = parseInt(accentSpan.textContent);
                                if (!isNaN(accentNumber)) {
                                    element.textContent = '0';
                                    animateNumber(element, accentNumber, 1500);
                                    if (text.includes('+')) {
                                        setTimeout(() => {
                                            element.textContent = accentNumber + '+';
                                        }, 1600);
                                    }
                                }
                            }
                        }
                        statObserver.unobserve(element);
                    }
                });
            }, { threshold: 0.5 });

            statNumbers.forEach(stat => {
                statObserver.observe(stat);
            });
        });

        // ==========================================
        // PREVENT DEFAULT FOR EMPTY LINKS
        // ==========================================
        document.querySelectorAll('a[href="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
            });
        });

        // ==========================================
        // PARTICLES DYNAMIC GENERATION
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.querySelector('.particles-container');
            const colors = ['#d4a373', '#e9c46a', '#f4a261', '#e8ddd0', '#b8a89a', '#8a7a6a'];
            
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.width = (Math.random() * 10 + 4) + 'px';
                particle.style.height = particle.style.width;
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.animationDelay = (Math.random() * 5) + 's';
                particle.style.animationDuration = (Math.random() * 12 + 8) + 's';
                particle.style.borderRadius = Math.random() > 0.5 ? '50%' : '30% 70% 50% 50%';
                particlesContainer.appendChild(particle);
            }
        });
    </script>

</body>
</html>