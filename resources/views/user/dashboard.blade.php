<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD MAHASISWA - SIM UKM FMIPA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Sesuai dengan Header Mockup */
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 2px solid #f1f2f6;
            padding: 15px 0;
        }
        .navbar-brand img {
            max-height: 50px;
        }
        .nav-link-custom {
            color: #333333;
            font-weight: 500;
            margin: 0 15px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            color: #e67e22;
        }
        .nav-link-custom.disabled {
            color: #bbb !important;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Hero Banner Sesuai Gambar Mockup */
        .hero-banner {
            background-color: #555555;
            color: #ffffff;
            padding: 60px 0;
            margin-bottom: 30px;
        }
        .hero-banner h1 {
            font-size: 2.2rem;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        /* Komponen Card Konten */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            background: #ffffff;
            margin-bottom: 25px;
        }
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }
        .bg-pending { background-color: #fef9e7; color: #f39c12; }
        .bg-diterima { background-color: #e8f8f5; color: #2ecc71; }
        .bg-ditolak { background-color: #fdebd0; color: #e74c3c; }

        .btn-logout {
            color: #e74c3c;
            font-weight: 500;
            border: none;
            background: none;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="https://fmipa.usk.ac.id/wp-content/uploads/2023/10/logo-fmipa-usk.png" alt="Logo FMIPA USK" onerror="this.src='https://via.placeholder.com/150x50?text=FMIPA+USK'">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <div class="navbar-nav mx-auto">
                <a class="nav-link-custom active" href="{{ url('/dashboard') }}">Beranda</a>
                
                @if($pendaftaran && $pendaftaran->status == 'diterima')
                    <a class="nav-link-custom" href="#informasi-ukm">UKM</a>
                @else
                    <a class="nav-link-custom disabled" href="#" title="Akses dikunci hingga pendaftaran disetujui"><i class="fa-solid fa-lock small me-1"></i> UKM</a>
                @endif
                
                <a class="nav-link-custom" href="{{ url('/pusat-bantuan') }}">FAQ</a>
            </div>
            
            <div class="d-flex align-items-center">
                <span class="me-3 fw-semibold text-dark"><i class="fa-regular fa-user me-1"></i> {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="hero-banner text-center text-md-start">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1>SISTEM INFORMASI<br>UNIT KEGIATAN MAHASISWA FMIPA</h1>
                <p class="lead mb-0 opacity-75">Selamat datang kembali di portal pendaftaran dan manajemen organisasi mahasiswa MIPA.</p>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card card-custom p-4 text-center text-dark">
                <div class="mb-3">
                    <i class="fa-solid fa-graduation-cap fa-4x text-secondary"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                <p class="text-muted small mb-3">{{ Auth::user()->npm }}</p>
                <hr>
                <div class="text-start small">
                    <div class="mb-2"><strong>Program Studi:</strong> <br><span class="text-secondary">{{ Auth::user()->prodi ?? Auth::user()->program_studi }}</span></div>
                    <div class="mb-2"><strong>Angkatan:</strong> <br><span class="text-secondary">{{ Auth::user()->angkatan }}</span></div>
                    <div class="mb-0"><strong>No. Telepon:</strong> <br><span class="text-secondary">{{ Auth::user()->no_telepon ?? Auth::user()->telepon }}</span></div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-custom p-4 text-dark">
                <h5 class="fw-bold text-dark border-bottom pb-3 mb-4"><i class="fa-solid fa-file-invoice me-2 text-warning"></i>Status Pendaftaran UKM Kamu</h5>
                
                @if($pendaftaran)
                    <div class="p-4 bg-light rounded border text-center">
                        <p class="mb-1 text-muted fw-semibold text-uppercase">UKM Pilihan: <span class="text-dark">{{ $pendaftaran->ukm_tujuan }}</span></p>
                        <p class="mb-3 text-muted small">Divisi: {{ $pendaftaran->divisi_tujuan }}</p>
                        
                        @if($pendaftaran->status == 'pending')
                            <div class="status-badge bg-pending my-2">
                                <i class="fa-regular fa-clock me-1"></i> BERKAS SEDANG DIPROSES (PENDING)
                            </div>
                            <div class="alert alert-warning border-0 small mt-3 text-start shadow-sm">
                                <i class="fa-solid fa-circle-info me-1"></i> <strong>Pemberitahuan Sistem:</strong><br>
                                Akun Anda saat ini <strong>ditangguhkan sementara</strong> untuk mengakses fitur login internal lainnya. Berkas pendaftaran sedang dalam tahap peninjauan dan penyaringan manual oleh tim pengurus organisasi terkait. Silakan tunggu hingga admin memberikan keputusan kelulusan Anda.
                            </div>
                        
                        @elseif($pendaftaran->status == 'diterima') {{-- PERBAIKAN: Menggunakan @elseif yang benar --}}
                            <div class="status-badge bg-diterima my-2">
                                <i class="fa-solid fa-circle-check me-1"></i> SELAMAT! ANDA NYATAKAN LULUS (DITERIMA)
                            </div>
                            <p class="small text-muted mt-3 mb-0 text-start">Selamat bergabung! Berkas pendaftaran Anda telah disetujui sepenuhnya oleh admin pengurus. Akses fitur login penuh Anda telah dibuka secara otomatis.</p>
                        
                        @elseif($pendaftaran->status == 'ditolak') {{-- PERBAIKAN: Menggunakan @elseif yang benar --}}
                            <div class="status-badge bg-ditolak my-2">
                                <i class="fa-solid fa-circle-xmark me-1"></i> MAAF, BERKAS BELUM MEMENUHI SYARAT (DITOLAK)
                            </div>
                            <p class="small text-muted mt-3 mb-0 text-start">Mohon maaf, berdasarkan hasil seleksi portofolio dan administrasi, pendaftaran Anda saat ini belum memenuhi kriteria untuk bergabung ke kepengurusan organisasi periode ini.</p>
                        @endif

                        @if($pendaftaran->catatan_admin)
                            <div class="alert alert-secondary mt-3 mb-0 text-start small border-0 shadow-sm">
                                <strong class="text-dark"><i class="fa-solid fa-comment-dots me-1"></i> Catatan Pengurus:</strong><br>
                                <span class="text-muted"><em>"{{ $pendaftaran->catatan_admin }}"</em></span>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="p-5 text-center">
                        <div class="mb-3">
                            <i class="fa-regular fa-folder-open fa-3x text-muted"></i>
                        </div>
                        <h6 class="fw-bold text-secondary">Kamu Belum Mendaftar di UKM Manapun</h6>
                        <p class="small text-muted mb-4">Silakan pilih dan ikuti organisasi mahasiswa di lingkungan FMIPA USK dengan mengisi formulir pendaftaran lanjutan.</p>
                        <a href="{{ url('/pendaftaran/isi') }}" class="btn btn-warning text-white fw-bold px-4 py-2 rounded-pill shadow-sm">
                            <i class="fa-solid fa-pen-to-square me-2"></i> Mulai Isi Formulir Pendaftaran
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>