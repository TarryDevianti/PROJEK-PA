<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi UKM FMIPA USK')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #fdf8f2; min-height: 100vh; }
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 12px 0;
        }
        .navbar-custom .brand-text {
            font-weight: 800;
            color: #3d2c1e;
            font-size: 1.3rem;
        }
        .navbar-custom .brand-text span { color: #d4a373; }
        .navbar-custom .nav-link {
            color: #8a7a6a;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
        }
        .navbar-custom .nav-link:hover {
            color: #d4a373;
            background: rgba(212, 163, 115, 0.06);
        }
        .btn-logout {
            background: rgba(220,38,38,0.08);
            color: #dc2626;
            border: 1px solid rgba(220,38,38,0.15);
            border-radius: 50px;
            padding: 6px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-logout:hover { background: rgba(220,38,38,0.15); }
        .btn-login {
            background: linear-gradient(135deg, #d4a373, #e9c46a);
            color: #3d2c1e;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            padding: 8px 24px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 163, 115, 0.3);
            color: #3d2c1e;
        }
        .footer-custom {
            background: #3d2c1e;
            color: rgba(255,255,255,0.5);
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }
        .card-shadow {
            box-shadow: 0 8px 30px rgba(0,0,0,0.05);
            border: none;
            border-radius: 16px;
        }
    </style>
    @stack('styles')
</head>
<body>

   <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3 text-decoration-none" href="{{ route('beranda') }}">
            <img src="{{ asset('assets/img/logofmipa.png') }}" alt="Logo FMIPA" width="45" height="45">
            <span class="brand-text">FMIPA <span>USK</span></span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ukm.saya') }}">UKM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kegiatan.saya') }}">Kegiatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('galeri.saya') }}">Galeri</a>
                </li>

                {{-- Menu Dinamis: Anggota untuk user yang login, Jadwal untuk yang belum login --}}
                @auth
                    @if(Auth::user()->role == 'anggota')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('anggota.daftar') }}">
                                <i class="bi bi-people me-1"></i> Anggota
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jadwal') }}">Jadwal</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jadwal') }}">Jadwal</a>
                    </li>
                @endauth

                {{-- Login/Logout --}}
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 32px; height: 32px; background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 700; font-size: 0.8rem;">
                                {{ Auth::user()->initials ?? 'U' }}
                            </div>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                            @if(Auth::user()->role == 'anggota')
                            <li>
                                <a class="dropdown-item" href="{{ route('anggota.daftar') }}">
                                    <i class="bi bi-people me-2"></i> Daftar Anggota
                                </a>
                            </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-login" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <p class="mb-0 small">&copy; {{ date('Y') }} Sistem Informasi UKM FMIPA USK. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>