<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi UKM FMIPA USK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9fa; }
        html { scroll-behavior: smooth; scroll-padding-top: 90px; }
        
        /* Hero Section dengan Background Gelap agar teks & slider kontras */
        .hero-section { background-color: #2b303a; color: white; padding: 100px 0; }
        
        /* Pengaturan ukuran slider foto kegiatan UKM */
        .carousel-hero-container {
            width: 100%;
            height: 350px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .carousel-hero-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }

        .navbar-nav .nav-link {
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            padding-bottom: 5px;
        }
        .navbar-nav .nav-link.active-menu { 
            border-bottom: 3px solid #ffc107 !important; 
            color: #000 !important; 
        }

        /* PERUBAHAN BACKGROUND FAQ: Menggunakan gradasi gelap yang estetis */
        #faq-section {
            background: linear-gradient(135deg, #1e222b 0%, #2b303a 100%) !important;
        }
        
        .faq-accordion .accordion-item {
            border: none;
            margin-bottom: 15px;
            border-radius: 12px !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            overflow: hidden;
        }
        
        /* Warna background FAQ saat tertutup (Aksen abu-abu kebiruan lembut) */
        .faq-accordion .accordion-button.collapsed {
            background-color: #f1f3f5;
            color: #2b303a;
        }
        
        .faq-accordion .accordion-button {
            font-weight: 600;
            padding: 20px;
        }
        
        /* Warna background FAQ saat dibuka (Aksen kuning kemasan soft) */
        .faq-accordion .accordion-button:not(.collapsed) {
            background-color: #fff4d4;
            color: #d38200;
            box-shadow: none;
        }
        
        /* Warna isi teks/jawaban FAQ */
        .faq-accordion .accordion-body {
            background-color: #fffcf5;
            color: #495057;
            line-height: 1.6;
            padding: 0 20px 20px 20px;
        }
        
        .faq-accordion .accordion-button::after {
            filter: brightness(0.2);
        }
        .faq-accordion .accordion-button:not(.collapsed)::after {
            filter: sepia(1) saturate(5) hue-rotate(10deg);
        }

        /* PERUBAHAN PROFIL LOGO: Tanpa kontainer abu-abu, langsung nempel rapi */
        .ukm-logo-wrapper {
            width: 100%;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .ukm-logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        .card:hover .ukm-logo-img {
            transform: scale(1.08);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3" href="/">

    <img src="<?php echo e(asset('assets/img/logofmipa.png')); ?>"
         alt="Logo FMIPA"
         width="50"
         height="50"
         class="img-fluid">

    <span class="fs-4 fw-bold text-uppercase text-dark mb-0">
        FMIPA
    </span>

    <div style="
        width:2px;
        align-self:stretch;
        background-color:#6c757d;
    "></div>

    <span class="text-muted"
          style="
            font-size:11px;
            line-height:1.2;
            font-weight:500;
          ">
        UNIVERSITAS<br>
        SYIAH KUALA
    </span>

</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-4" id="mainNavbar">
                    <li class="nav-item">
                        <a class="nav-link fw-bold active-menu" href="#beranda-hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary" href="#jelajah-ukm">UKM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary" href="#faq-section">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-dark fw-bold px-4 rounded-pill">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center text-md-start" id="beranda-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold mb-3">Sistem Informasi<br>Unit Kegiatan Mahasiswa FMIPA</h1>
                    <p class="fs-5 text-white-50 mb-4">Wadah kreativitas, kepemimpinan, dan pengembangan diri mahasiswa Fakultas Matematika dan Ilmu Pengetahuan Alam Universitas Syiah Kuala.</p>
                    <a href="#jelajah-ukm" class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm">JELAJAHI UKM &darr;</a>
                </div>
                
                <div class="col-md-6">
                    <div class="carousel-hero-container">
                        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="3500">
                                    <img src="<?php echo e(asset('assets/img/kegiatan_seuramoe.jpeg')); ?>" class="carousel-hero-img" alt="Kegiatan Seni UKM Seuramoe">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 py-1">
                                        <p class="mb-0 small fw-bold text-warning">Pentas Seni Kreatif - UKM Seuramoe</p>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="3500">
                                    <img src="<?php echo e(asset('assets/img/kegiatan_ululalbab.jpeg')); ?>" class="carousel-hero-img" alt="Kajian LDF Ulul Albab">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 py-1">
                                        <p class="mb-0 small fw-bold text-warning">Karakter Islami & Syiar - LDF Ulul Albab</p>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="3500">
                                    <img src="<?php echo e(asset('assets/img/kegiatan_barracuda.jpg')); ?>" class="carousel-hero-img" alt="Jelajah Alam UKM Barracuda">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 py-1">
                                        <p class="mb-0 small fw-bold text-warning">Pecinta Alam & Tanggap Darurat - UKM Barracuda</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>

 <section class="container my-5 py-5" id="jelajah-ukm">
    <div class="text-center mb-5">
        <p class="text-muted fs-5">Temukan komunitas pengembang diri yang cocok untukmu di FMIPA</p>
        <div class="mx-auto bg-warning rounded" style="width: 60px; height: 4px;"></div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 d-flex align-items-stretch">
        <div class="col">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="ukm-logo-wrapper">
                         <img src="<?php echo e(asset('assets/img/seuramoe.png')); ?>"
         alt="Logo Seuramoe"
         style="width:120px; height:120px; object-fit:contain;">
                    </div>
                    <h4 class="fw-bold text-uppercase mb-3 fs-4">SEURAMOE</h4>
                    <p class="text-muted px-2" style="font-size: 14.5px; min-height: 72px;">Wadah pengembangan minat bakat mahasiswa di bidang seni suara, musik, tari, dan multimedia kreatif.</p>
                </div>
                <div class="mt-4 pt-2">
                    <a href="<?php echo e(route('ukm.detail-publik', ['slug' => 'ukm-seramoe'])); ?>"
                    class="btn btn-dark w-100 rounded-pill py-2.5 fw-bold">
                    Detail
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="ukm-logo-wrapper">
                        <img src="<?php echo e(asset('assets/img/ululalbab.png')); ?>" alt="Logo Ulul Albab" class="ukm-logo-img">
                    </div>
                    <h4 class="fw-bold text-uppercase mb-3 fs-4">LDF ULUL ALBAB</h4>
                    <p class="text-muted px-2" style="font-size: 14.5px; min-height: 72px;">Lembaga Dakwah Fakultas yang bergerak dalam syiar Islam, pembinaan karakter Islami, dan ukhuwah.</p>
                </div>
                <div class="mt-4 pt-2">
                  <a href="<?php echo e(route('ukm.detail-publik', ['slug' => 'ukm-ldf-ulul-albab'])); ?>"
                        class="btn btn-dark w-100 rounded-pill py-2.5 fw-bold">
                        Detail
                        </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="ukm-logo-wrapper">
                        <img src="<?php echo e(asset('assets/img/barracuda.png')); ?>" alt="Logo Barracuda" class="ukm-logo-img">
                    </div>
                    <h4 class="fw-bold text-uppercase mb-3 fs-4">BARRACUDA</h4>
                    <p class="text-muted px-2" style="font-size: 14.5px; min-height: 72px;">Komunitas pecinta alam FMIPA yang berfokus pada pelestarian alam bebas, jelajah gunung hutan, dan tanggap darurat.</p>
                </div>
                <div class="mt-4 pt-2">
                   <a href="<?php echo e(route('ukm.detail-publik', ['slug' => 'ukm-barracuda'])); ?>"
                    class="btn btn-dark w-100 rounded-pill py-2.5 fw-bold">
                    Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

   <section class="py-5 border-top" id="faq-section">
    <div class="container py-4" style="max-width: 900px;">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white">Frequently Asked Questions</h2>
            <p class="text-white-50">Pertanyaan yang paling sering diajukan mengenai pendaftaran dan kegiatan UKM FMIPA</p>
            <div class="mx-auto bg-warning rounded" style="width: 50px; height: 4px;"></div>
        </div>

      <section>
    <div class="container">
        
        <?php if(isset($faqs) && count($faqs) > 0): ?>
            <div class="accordion faq-accordion" id="accordionFaq">
                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="accordion-item shadow-sm">
                        <h2 class="accordion-header" id="heading<?php echo e($index); ?>">
                            <button class="accordion-button <?php echo e($index > 0 ? 'collapsed' : ''); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($index); ?>" aria-expanded="<?php echo e($index == 0 ? 'true' : 'false'); ?>" aria-controls="collapse<?php echo e($index); ?>">
                                <i class="bi bi-question-circle-fill text-warning me-3"></i>
                                <?php echo e($faq->pertanyaan); ?>

                            </button>
                        </h2>
                        <div id="collapse<?php echo e($index); ?>" class="accordion-collapse collapse <?php echo e($index == 0 ? 'show' : ''); ?>" aria-labelledby="heading<?php echo e($index); ?>" data-bs-parent="#accordionFaq">
                            <div class="accordion-body">
                                <hr class="mt-0 mb-3 text-black-50">
                                <?php echo e($faq->jawaban); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5 bg-white bg-opacity-10 rounded-4 shadow-sm border border-secondary border-opacity-25">
                <i class="bi bi-chat-left-dots text-white-50 fs-1 mb-2 d-block"></i>
                <p class="text-white-50 mb-0">Belum ada data FAQ yang ditambahkan oleh Admin.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sections = document.querySelectorAll("header, section");
            const navLinks = document.querySelectorAll("#mainNavbar .nav-link");

            navLinks.forEach(link => {
                link.addEventListener("click", function () {
                    navLinks.forEach(item => item.classList.remove("active-menu", "text-dark"));
                    navLinks.forEach(item => item.classList.add("text-secondary"));
                    
                    this.classList.add("active-menu", "text-dark");
                    this.classList.remove("text-secondary");
                });
            });

            const options = {
                root: null,
                rootMargin: "-30% 0px -60% 0px",
                threshold: 0
            };

            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute("id");
                        
                        navLinks.forEach(link => {
                            link.classList.remove("active-menu", "text-dark");
                            link.classList.add("text-secondary");
                            
                            if (link.getAttribute("href") === `#${id}`) {
                                link.classList.add("active-menu", "text-dark");
                                link.classList.remove("text-secondary");
                            }
                        });
                    }
                });
            }, options);

            sections.forEach(section => {
                if(section.getAttribute("id")) {
                    observer.observe(section);
                }
            });
        });
        
    </script>
    
</body>
</html><?php /**PATH D:\PROJEK TA TARRY\ta-ukm\resources\views/welcome.blade.php ENDPATH**/ ?>