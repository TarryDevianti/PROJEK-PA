<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $ukm->nama_ukm }} - FMIPA USK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3d2c1e;
            --secondary: #f5ede6;
            --bg-light: #fdf8f2;
            --bg-white: #ffffff;
            --accent-1: #d4a373;
            --accent-2: #e9c46a;
            --accent-3: #f4a261;
            --accent-4: #e8ddd0;
            --accent-5: #f5ede6;
            --accent-6: #8a7a6a;
            --accent-7: #b8a89a;
            --text-dark: #3d2c1e;
            --text-muted: #8a7a6a;
            --text-light: #ffffff;
            --shadow: 0 8px 30px rgba(61, 44, 30, 0.08);
            --shadow-hover: 0 15px 50px rgba(61, 44, 30, 0.15);
            --gradient-1: linear-gradient(135deg, #d4a373, #e9c46a);
            --gradient-2: linear-gradient(135deg, #f5ede6, #ede4db);
            --gradient-3: linear-gradient(135deg, #d4a373, #f4a261);
        }

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
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

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }

        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes rotateSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes bounceIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.1); }
            70% { transform: scale(0.95); }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(15deg); }
            75% { transform: rotate(-15deg); }
        }

        @keyframes floatParticle {
            0% { transform: translateY(0) translateX(0); opacity: 0.6; }
            100% { transform: translateY(-150px) translateX(50px); opacity: 0; }
        }

        @keyframes borderGlow {
            0%, 100% { border-color: rgba(212, 163, 115, 0.15); }
            50% { border-color: rgba(212, 163, 115, 0.4); }
        }

        @keyframes textShimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ==========================================
           PARTICLES BACKGROUND - Warna Hangat
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
            opacity: 0.4;
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
            animation: rotateSlow 20s linear infinite;
        }

        .navbar-brand-custom .logo-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .navbar-brand-custom:hover .logo-wrapper img {
            transform: scale(1.1) rotate(-5deg);
        }

        .navbar-brand-custom .brand-text {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: 1px;
        }

        .navbar-brand-custom .brand-divider {
            width: 2px;
            height: 40px;
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
            padding: 8px 16px !important;
            border-radius: 12px;
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
            background: rgba(212, 163, 115, 0.05);
        }

        .nav-link-custom:hover::after {
            width: 60%;
        }

        .nav-link-custom.active {
            color: var(--accent-1) !important;
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
           DETAIL HEADER - Warna Hangat
        ========================================== */
        .detail-header {
            position: relative;
            padding: 80px 0 60px;
            background: linear-gradient(135deg, #fdf8f2 0%, #f5ede6 50%, #ede4db 100%);
            overflow: hidden;
            z-index: 1;
            border-bottom: 3px solid var(--accent-1);
        }

        .detail-header::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 50%;
            height: 150%;
            background: radial-gradient(ellipse, rgba(212, 163, 115, 0.06), transparent 70%);
            animation: pulseGlow 6s ease-in-out infinite;
        }

        .detail-header::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 40%;
            height: 100%;
            background: radial-gradient(ellipse, rgba(212, 163, 115, 0.04), transparent 70%);
            animation: pulseGlow 8s ease-in-out infinite 1s;
        }

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

        .floating-element-3 {
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(244, 162, 97, 0.04), transparent);
            top: 50%;
            left: 30%;
            animation: float 12s ease-in-out infinite 2s;
        }

        .detail-header .container {
            position: relative;
            z-index: 2;
        }

        .ukm-logo-detail-wrapper {
            width: 100%;
            max-width: 200px;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-white);
            border-radius: 20px;
            padding: 20px;
            box-shadow: var(--shadow);
            animation: slideInLeft 0.8s ease-out;
            margin: 0 auto;
            transition: all 0.3s ease;
            border: 1px solid rgba(212, 163, 115, 0.1);
        }

        .ukm-logo-detail-wrapper:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-hover);
            border-color: var(--accent-1);
        }

        .ukm-logo-detail-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .detail-title {
            font-size: 3rem;
            font-weight: 900;
            animation: slideInRight 0.8s ease-out 0.1s both;
            color: var(--text-dark);
        }

        .detail-title .highlight {
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientMove 3s ease-in-out infinite;
        }

        .detail-title .highlight::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--gradient-1);
            border-radius: 2px;
        }

        .detail-desc {
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.9;
            animation: slideInRight 0.8s ease-out 0.2s both;
            margin-bottom: 20px;
        }

        .detail-desc-full {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.8;
            animation: slideInRight 0.8s ease-out 0.25s both;
            margin-bottom: 25px;
            padding: 18px 22px;
            background: rgba(212, 163, 115, 0.06);
            border-radius: 12px;
            border-left: 4px solid var(--accent-1);
        }

        .btn-daftar {
            background: var(--gradient-1);
            color: var(--text-dark);
            font-weight: 700;
            padding: 14px 40px;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 30px rgba(212, 163, 115, 0.25);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            animation: slideInRight 0.8s ease-out 0.3s both;
        }

        .btn-daftar:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 40px rgba(212, 163, 115, 0.35);
            color: var(--text-dark);
        }

        /* ==========================================
           SECTION TITLE
        ========================================== */
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title .subtitle {
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 10px 0 15px;
            color: var(--text-dark);
        }

        .section-title .divider {
            width: 60px;
            height: 4px;
            background: var(--gradient-1);
            border-radius: 2px;
            margin: 15px auto 0;
            animation: gradientMove 3s ease-in-out infinite;
        }

        /* ==========================================
           STRUKTUR PENGURUS
        ========================================== */
        .struktur-section {
            padding: 80px 0;
            background: var(--bg-white);
            position: relative;
            z-index: 1;
        }

        .struktur-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(212, 163, 115, 0.15), transparent);
        }

        .pengurus-card {
            background: var(--bg-light);
            border: 1px solid rgba(61, 44, 30, 0.06);
            border-radius: 24px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .pengurus-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-1);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .pengurus-card:hover {
            transform: translateY(-10px);
            border-color: rgba(212, 163, 115, 0.15);
            box-shadow: var(--shadow-hover);
        }

        .pengurus-card:hover::before {
            opacity: 1;
        }

        .pengurus-card .pengurus-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(212, 163, 115, 0.2);
            margin: 0 auto 15px;
            transition: all 0.4s ease;
        }

        .pengurus-card:hover .pengurus-photo {
            transform: scale(1.05);
            border-color: var(--accent-1);
        }

        .pengurus-card .pengurus-name {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .pengurus-card .pengurus-jabatan {
            color: var(--accent-1);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .pengurus-card .pengurus-periode {
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        .pengurus-empty {
            color: var(--text-muted);
            padding: 30px;
            text-align: center;
        }

        /* ==========================================
           KEGIATAN / DIVISI
        ========================================== */
        .kegiatan-section {
            padding: 80px 0;
            background: var(--bg-light);
            position: relative;
            z-index: 1;
        }

        .kegiatan-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(212, 163, 115, 0.15), transparent);
        }

        .kegiatan-card {
            background: var(--bg-white);
            border: 1px solid rgba(61, 44, 30, 0.06);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
        }

        .kegiatan-card:hover {
            transform: translateY(-10px);
            border-color: rgba(212, 163, 115, 0.2);
            box-shadow: var(--shadow-hover);
        }

        .kegiatan-card .kegiatan-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .kegiatan-card:hover .kegiatan-img {
            transform: scale(1.05);
        }

        .kegiatan-card .kegiatan-body {
            padding: 20px 25px 25px;
        }

        .kegiatan-card .kegiatan-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .kegiatan-card .kegiatan-desc {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .kegiatan-card .kegiatan-date {
            display: inline-block;
            background: rgba(212, 163, 115, 0.08);
            color: var(--accent-1);
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 10px;
        }

        /* ==========================================
           GALERI
        ========================================== */
        .galeri-section {
            padding: 80px 0;
            background: var(--bg-white);
            position: relative;
            z-index: 1;
        }

        .galeri-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(212, 163, 115, 0.15), transparent);
        }

        .galeri-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: var(--shadow);
        }

        .galeri-item:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-hover);
        }

        .galeri-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .galeri-item:hover img {
            transform: scale(1.1);
        }

        .galeri-item .galeri-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(to top, rgba(61, 44, 30, 0.8), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .galeri-item:hover .galeri-overlay {
            opacity: 1;
        }

        .galeri-item .galeri-overlay h6 {
            color: white;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .galeri-item .galeri-overlay small {
            color: rgba(255,255,255,0.7);
        }

        /* ==========================================
           JADWAL
        ========================================== */
        .jadwal-section {
            padding: 80px 0;
            background: var(--bg-light);
            position: relative;
            z-index: 1;
        }

        .jadwal-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(212, 163, 115, 0.15), transparent);
        }

        .jadwal-card {
            background: var(--bg-white);
            border: 1px solid rgba(61, 44, 30, 0.06);
            border-radius: 24px;
            padding: 40px;
            transition: all 0.4s ease;
            animation: borderGlow 3s ease-in-out infinite;
        }

        .jadwal-card:hover {
            border-color: rgba(212, 163, 115, 0.2);
            box-shadow: var(--shadow-hover);
        }

        .jadwal-card .jadwal-title {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 30px;
        }

        .jadwal-table {
            width: 100%;
            border-collapse: collapse;
        }

        .jadwal-table th {
            background: rgba(212, 163, 115, 0.08);
            color: var(--accent-1);
            padding: 12px 20px;
            font-weight: 700;
            text-align: center;
            border: 1px solid rgba(61, 44, 30, 0.06);
        }

        .jadwal-table td {
            padding: 12px 20px;
            text-align: center;
            color: var(--text-muted);
            border: 1px solid rgba(61, 44, 30, 0.06);
        }

        .jadwal-table .label-cell {
            color: var(--text-dark);
            font-weight: 600;
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
            font-weight: 500;
            transition: color 0.3s ease;
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
           MODAL
        ========================================== */
        .modal-content {
            background: var(--bg-white);
            border: 1px solid rgba(61, 44, 30, 0.06);
            border-radius: 20px;
        }

        .modal-header {
            border-bottom: 1px solid rgba(61, 44, 30, 0.06);
        }

        .modal-header .modal-title {
            color: var(--text-dark);
            font-weight: 700;
        }

        .modal-body {
            color: var(--text-muted);
        }

        /* ==========================================
           RESPONSIVE
        ========================================== */
        @media (max-width: 991.98px) {
            .detail-title {
                font-size: 2.2rem;
            }

            .ukm-logo-detail-wrapper {
                max-width: 150px;
                height: 150px;
            }

            .section-title h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 767.98px) {
            .detail-title {
                font-size: 1.8rem;
            }

            .detail-header {
                padding: 50px 0 30px;
            }

            .ukm-logo-detail-wrapper {
                max-width: 120px;
                height: 120px;
            }

            .section-title h2 {
                font-size: 1.6rem;
            }

            .pengurus-card .pengurus-photo {
                width: 100px;
                height: 100px;
            }

            .kegiatan-card .kegiatan-img {
                height: 180px;
            }

            .jadwal-card {
                padding: 25px;
            }

            .jadwal-table th,
            .jadwal-table td {
                padding: 8px 12px;
                font-size: 0.85rem;
            }

            .footer-socials {
                justify-content: center;
                margin-top: 12px;
            }

            .footer-section .footer-text {
                text-align: center;
            }

            .detail-desc-full {
                font-size: 0.9rem;
                padding: 12px 15px;
            }
        }

        @media (max-width: 575.98px) {
            .detail-title {
                font-size: 1.4rem;
            }

            .navbar-brand-custom .brand-text {
                font-size: 1.2rem;
            }

            .navbar-brand-custom .sub-text {
                font-size: 8px;
            }

            .ukm-logo-detail-wrapper {
                max-width: 100px;
                height: 100px;
            }

            .btn-daftar {
                padding: 10px 25px;
                font-size: 0.9rem;
            }

            .galeri-item img {
                height: 150px;
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
                <ul class="navbar-nav ms-auto align-items-center gap-2 gap-lg-3" id="mainNavbar">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ $activeTab == 'ukm' ? 'active' : '' }}" 
                           href="{{ url('/ukm/'.$ukm->slug.'/ukm') }}">UKM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ $activeTab == 'divisi' ? 'active' : '' }}" 
                           href="{{ url('/ukm/'.$ukm->slug.'/divisi') }}">Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ $activeTab == 'galeri' ? 'active' : '' }}" 
                           href="{{ url('/ukm/'.$ukm->slug.'/galeri') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ $activeTab == 'jadwal' ? 'active' : '' }}" 
                           href="{{ url('/ukm/'.$ukm->slug.'/jadwal') }}">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        @auth
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-login">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ==========================================
    DETAIL HEADER - UKM
    ========================================== -->
    @if($activeTab == 'ukm')
    <header class="detail-header">
        <div class="floating-element floating-element-1"></div>
        <div class="floating-element floating-element-2"></div>
        <div class="floating-element floating-element-3"></div>

        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-4 text-center text-md-start">
                    <div class="ukm-logo-detail-wrapper">
                        <img src="{{ asset($ukm->logo) }}"
                             alt="Logo {{ $ukm->nama_ukm }}"
                             class="ukm-logo-detail-img">
                    </div>
                    <!-- ===== LABEL LOGO ===== -->
                    <p class="text-muted text-center mt-2" style="font-size: 0.85rem; font-weight: 500; letter-spacing: 0.3px;">
                        <i class="bi bi-tag me-1"></i> Logo {{ $ukm->nama_ukm }}
                    </p>
                </div>

                <div class="col-md-8">
                    <h1 class="detail-title">
                        {{ $ukm->nama_ukm }}
                        <br>
                        <span class="highlight">FMIPA USK</span>
                    </h1>

                    <p class="detail-desc">
                        {{ $ukm->deskripsi }}
                    </p>

                    <!-- DESKRIPSI PANJANG BERDASARKAN SLUG -->
                    @php
                        $deskripsiPanjang = [
                            'seuramoe' => 'UKM Seuramoe merupakan wadah pengembangan minat dan bakat mahasiswa FMIPA di bidang seni dan budaya. Kami aktif dalam berbagai kegiatan seperti pentas seni, musik, tari tradisional, teater, dan produksi multimedia kreatif. Seuramoe menjadi rumah bagi mahasiswa yang memiliki passion di bidang kesenian dan ingin mengembangkan kreativitas serta kemampuan berekspresi melalui berbagai event dan perlombaan, baik di tingkat universitas maupun nasional. Kami percaya bahwa seni adalah jembatan untuk mengekspresikan diri dan membangun karakter yang kreatif dan inovatif.',
                            
                            'ldf-ulul-albab' => 'LDF Ulul Albab adalah Lembaga Dakwah Fakultas yang berkomitmen menjadi pusat syiar Islam dan pembinaan karakter islami di lingkungan FMIPA. Kami aktif dalam kegiatan kajian rutin, pelatihan kepemimpinan, bakti sosial, dan berbagai program dakwah yang bertujuan membentuk mahasiswa yang berakhlak mulia, berwawasan luas, dan memiliki kepedulian sosial tinggi. Ulul Albab menjadi wadah bagi mahasiswa yang ingin memperdalam ilmu agama dan mengamalkannya dalam kehidupan sehari-hari, serta menjadi generasi muslim yang rahmatan lil alamin.',
                            
                            'barracuda' => 'UKM Barracuda adalah komunitas pecinta alam FMIPA yang berfokus pada kegiatan pelestarian alam, penjelajahan gunung dan hutan, serta pendidikan tanggap darurat. Kami aktif dalam berbagai kegiatan seperti pendakian, camping, konservasi lingkungan, pelatihan P3K, dan kegiatan sosial yang berkaitan dengan kebencanaan. Barracuda menjadi tempat bagi mahasiswa yang memiliki jiwa petualang, cinta alam, dan ingin berkontribusi dalam menjaga kelestarian lingkungan serta kesiapsiagaan bencana. Kami mengajarkan nilai-nilai kepedulian terhadap alam dan sesama.'
                        ];
                        $deskripsiUKM = $deskripsiPanjang[$ukm->slug] ?? 'UKM ini merupakan wadah pengembangan diri mahasiswa FMIPA. Kami membuka kesempatan bagi seluruh mahasiswa untuk bergabung dan mengembangkan potensi diri melalui berbagai kegiatan yang bermanfaat.';
                    @endphp
                    <div class="detail-desc-full">
                        {{ $deskripsiUKM }}
                    </div>

                    <a href="{{ route('mahasiswa.pendaftaran.isi', ['ukm_slug' => $ukm->slug]) }}" 
                       class="btn-daftar">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ==========================================
    STRUKTUR PENGURUS
    ========================================== -->
    <section class="struktur-section" id="struktur">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="subtitle">✦ Pengurus</span>
                <h2>STRUKTUR PENGURUS</h2>
                <div class="divider"></div>
            </div>

            @php
                $ketua = \App\Models\Pengurus::whereHas('ukm', function($query) use ($ukm) {
                    $query->where('nama_ukm', $ukm->nama_ukm);
                })->where('jabatan', 'Ketua')->first();

                $sekretaris = \App\Models\Pengurus::whereHas('ukm', function($query) use ($ukm) {
                    $query->where('nama_ukm', $ukm->nama_ukm);
                })->where('jabatan', 'Sekretaris')->first();

                $bendahara = \App\Models\Pengurus::whereHas('ukm', function($query) use ($ukm) {
                    $query->where('nama_ukm', $ukm->nama_ukm);
                })->where('jabatan', 'Bendahara')->first();
            @endphp

            <div class="row g-4 justify-content-center">
                {{-- Ketua --}}
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="pengurus-card">
                        @if($ketua)
                            <img src="{{ $ketua->foto ? asset('storage/' . $ketua->foto) : asset('assets/img/default-user.png') }}"
                                 alt="Ketua"
                                 class="pengurus-photo">
                            <h5 class="pengurus-name">{{ $ketua->nama }}</h5>
                            <p class="pengurus-jabatan">Ketua</p>
                            <small class="pengurus-periode">Periode {{ $ketua->periode }}</small>
                        @else
                            <div class="pengurus-empty">
                                <i class="bi bi-person-x fs-1 d-block mb-2" style="color: var(--text-muted);"></i>
                                <p class="mb-0">Ketua belum tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Sekretaris --}}
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="pengurus-card">
                        @if($sekretaris)
                            <img src="{{ $sekretaris->foto ? asset('storage/' . $sekretaris->foto) : asset('assets/img/default-user.png') }}"
                                 alt="Sekretaris"
                                 class="pengurus-photo">
                            <h5 class="pengurus-name">{{ $sekretaris->nama }}</h5>
                            <p class="pengurus-jabatan">Sekretaris</p>
                            <small class="pengurus-periode">Periode {{ $sekretaris->periode }}</small>
                        @else
                            <div class="pengurus-empty">
                                <i class="bi bi-person-x fs-1 d-block mb-2" style="color: var(--text-muted);"></i>
                                <p class="mb-0">Sekretaris belum tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Bendahara --}}
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="pengurus-card">
                        @if($bendahara)
                            <img src="{{ $bendahara->foto ? asset('storage/' . $bendahara->foto) : asset('assets/img/default-user.png') }}"
                                 alt="Bendahara"
                                 class="pengurus-photo">
                            <h5 class="pengurus-name">{{ $bendahara->nama }}</h5>
                            <p class="pengurus-jabatan">Bendahara</p>
                            <small class="pengurus-periode">Periode {{ $bendahara->periode }}</small>
                        @else
                            <div class="pengurus-empty">
                                <i class="bi bi-person-x fs-1 d-block mb-2" style="color: var(--text-muted);"></i>
                                <p class="mb-0">Bendahara belum tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ==========================================
    KEGIATAN / DIVISI
    ========================================== -->
    @if($activeTab == 'divisi')
    <section class="kegiatan-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="subtitle">✦ Kegiatan</span>
                <h2>KEGIATAN {{ $ukm->nama_ukm }}</h2>
                <div class="divider"></div>
            </div>

            <div class="row g-4">
                @forelse($kegiatan as $item)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="kegiatan-card">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                     alt="{{ $item->judul }}"
                                     class="kegiatan-img">
                            @else
                                <div class="kegiatan-img" style="background: linear-gradient(135deg, #ede4db, #e8ddd0); display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-calendar-event" style="font-size: 4rem; color: var(--text-muted);"></i>
                                </div>
                            @endif
                            <div class="kegiatan-body">
                                <h5 class="kegiatan-title">{{ $item->judul }}</h5>
                                <p class="kegiatan-desc">{{ Str::limit($item->deskripsi, 100) }}</p>
                                <span class="kegiatan-date">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $item->tanggal_kegiatan }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center" data-aos="fade-up">
                        <div class="pengurus-empty" style="padding: 60px 20px; background: var(--bg-white); border-radius: 20px; border: 1px solid rgba(61,44,30,0.06);">
                            <i class="bi bi-calendar-x fs-1 d-block mb-3" style="color: var(--text-muted);"></i>
                            <p class="mb-0" style="color: var(--text-muted);">Belum ada kegiatan yang tersedia.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- ==========================================
    GALERI
    ========================================== -->
    @if($activeTab == 'galeri')
    <section class="galeri-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="subtitle">✦ Galeri</span>
                <h2>GALERI {{ $ukm->nama_ukm }}</h2>
                <div class="divider"></div>
            </div>

            <div class="row g-4">
                @forelse($galeri as $item)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="galeri-item"
                             data-bs-toggle="modal"
                             data-bs-target="#galeriModal"
                             onclick="showImage(
                                '{{ asset('storage/' . $item->gambar) }}',
                                '{{ $item->judul }}',
                                '{{ $item->deskripsi }}'
                             )">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                            <div class="galeri-overlay">
                                <h6>{{ $item->judul }}</h6>
                                <small>{{ $item->deskripsi }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center" data-aos="fade-up">
                        <div class="pengurus-empty" style="padding: 60px 20px; background: var(--bg-white); border-radius: 20px; border: 1px solid rgba(61,44,30,0.06);">
                            <i class="bi bi-images fs-1 d-block mb-3" style="color: var(--text-muted);"></i>
                            <p class="mb-0" style="color: var(--text-muted);">Belum ada galeri untuk UKM ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Modal Galeri -->
    <div class="modal fade" id="galeriModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalJudul"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid rounded mb-3" style="max-height: 600px; width: 100%; object-fit: contain;">
                    <p id="modalDeskripsi" style="color: var(--text-muted);"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImage(image, judul, deskripsi) {
            document.getElementById('modalImage').src = image;
            document.getElementById('modalJudul').innerText = judul;
            document.getElementById('modalDeskripsi').innerText = deskripsi;
        }
    </script>
    @endif

    <!-- ==========================================
    JADWAL
    ========================================== -->
    @if($activeTab == 'jadwal')
    <section class="jadwal-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="subtitle">✦ Jadwal</span>
                <h2>JADWAL {{ $ukm->nama_ukm }}</h2>
                <div class="divider"></div>
            </div>

            @if($jadwal)
                <div class="jadwal-card" data-aos="fade-up">
                    <h4 class="jadwal-title">
                        <i class="bi bi-calendar-range me-2" style="color: var(--accent-1);"></i>
                        {{ $jadwal->uraian }}
                    </h4>

                    <div class="table-responsive">
                        <table class="jadwal-table">
                            <thead>
                                <tr>
                                    <th>Jadwal</th>
                                    <th>Sesi 1</th>
                                    <th>Sesi 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="label-cell">Pembukaan</td>
                                    <td>{{ $jadwal->sesi_1_buka ?? '-' }}</td>
                                    <td>{{ $jadwal->sesi_2_buka ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="label-cell">Penutupan</td>
                                    <td>{{ $jadwal->sesi_1_tutup ?? '-' }}</td>
                                    <td>{{ $jadwal->sesi_2_tutup ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div data-aos="fade-up">
                    <div class="pengurus-empty" style="padding: 60px 20px; background: var(--bg-white); border-radius: 20px; border: 1px solid rgba(61,44,30,0.06);">
                        <i class="bi bi-clock fs-1 d-block mb-3" style="color: var(--text-muted);"></i>
                        <p class="mb-0" style="color: var(--text-muted);">Jadwal belum tersedia.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @endif

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
            // ACTIVE NAV LINK
            // ==========================================
            const navLinks = document.querySelectorAll('#mainNavbar .nav-link-custom');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
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