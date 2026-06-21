<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail <?php echo e($ukm->nama_ukm); ?> - FMIPA USK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f6f9;
            color: #333438;
        }

        .navbar {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e2e8f0;
        }

        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link.active-menu {
            color: #1a1d20 !important;
            font-weight: 700;
        }

        .nav-link.active-menu::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #ffc107;
            border-radius: 2px;
        }

        .detail-header-gradient {
            background: linear-gradient(135deg, #1e2229 0%, #2b303a 100%);
            color: white;
            padding: 90px 0;
            border-bottom: 5px solid #ffc107;
        }

        .ukm-logo-detail-wrapper {
            width: 100%;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.05);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            padding: 15px;
        }

        .ukm-logo-detail-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .card-divisi {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            transition: 0.3s;
        }

        .card-divisi:hover {
            transform: translateY(-8px);
        }

        .divisi-img-container {
            width: 100%;
            height: 210px;
            overflow: hidden;
            border-radius: 12px;
        }

        .divisi-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .galeri-container {
            background-color: #ebedf2;
            border-radius: 20px;
            padding: 35px;
        }

        .galeri-card {
            background-color: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .galeri-img-wrapper {
            width: 100%;
            height: 160px;
            background: linear-gradient(135deg, #f6f8fa 0%, #e9ecef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
        }

        .galeri-img-wrapper i {
            font-size: 3rem;
        }

        .custom-table-card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.04);
        }

        .table thead {
            background-color: #1e2229;
            color: #ffffff;
        }

        .title-line {
            background: linear-gradient(90deg, transparent, #ffc107, transparent);
            height: 4px;
            width: 120px;
            margin: 12px auto 0 auto;
            border-radius: 2px;
        }

        .jadwal-wrapper{
            max-width: 900px;
        }

        .jadwal-box{
            background: #2b303a;
            padding: 60px 40px;
            border-radius: 8px;
        }

        .jadwal-title{
            color: white;
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 40px;
            text-transform: uppercase;
        }

        .jadwal-table{
            background: #2b303a;
            margin: auto;
            width: 70%;
            border: 1px solid #444;
        }

        .jadwal-table th{
            background: #f1f1f1;
            border: 1px solid #444;
            font-weight: 700;
            color: #000;
        }

        .jadwal-table td{
            border: 1px solid #444;
        }

        @media(max-width:768px){

            .jadwal-box{
                padding: 30px 20px;
            }

            .jadwal-title{
                font-size: 20px;
            }

            .jadwal-table{
                width: 100%;
            }

        }

    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light py-3 shadow-sm sticky-top">

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

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ms-auto align-items-center gap-4">

                <li class="nav-item">
                    <a class="nav-link fw-bold text-secondary"
                       href="/">Beranda</a>
                </li>

                            <li class="nav-item">
                <a class="nav-link fw-bold text-secondary <?php echo e($activeTab == 'ukm' ? 'active-menu' : ''); ?>"
                href="<?php echo e(url('/ukm/'.$ukm->slug.'/ukm')); ?>">
                    UKM
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-bold text-secondary <?php echo e($activeTab == 'divisi' ? 'active-menu' : ''); ?>"
                href="<?php echo e(url('/ukm/'.$ukm->slug.'/divisi')); ?>">
                    Kegiatan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-bold text-secondary <?php echo e($activeTab == 'galeri' ? 'active-menu' : ''); ?>"
                href="<?php echo e(url('/ukm/'.$ukm->slug.'/galeri')); ?>">
                    Galeri
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-bold text-secondary <?php echo e($activeTab == 'jadwal' ? 'active-menu' : ''); ?>"
                href="<?php echo e(url('/ukm/'.$ukm->slug.'/jadwal')); ?>">
                    Jadwal
                </a>
            </li>

                
                <li class="nav-item">

                    <?php if(auth()->guard()->check()): ?>

                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>

                            <button type="submit"
                                    class="btn btn-link nav-link fw-bold text-danger p-0">
                                Logout
                            </button>

                        </form>

                    <?php else: ?>

                        <a class="nav-link fw-bold text-primary"
                           href="<?php echo e(route('login')); ?>">
                            Login
                        </a>

                    <?php endif; ?>

                </li>

            </ul>

        </div>

    </div>

</nav>



<?php if($activeTab == 'ukm'): ?>

<header class="detail-header-gradient">

    <div class="container">

        <div class="row align-items-center g-5 text-center text-md-start">

            <div class="col-md-4">

                <div class="ukm-logo-detail-wrapper">

                    <img src="<?php echo e(asset($ukm->logo)); ?>"
                         alt="Logo <?php echo e($ukm->nama_ukm); ?>"
                         class="ukm-logo-detail-img">

                </div>

            </div>

            <div class="col-md-8">

                <h1 class="display-4 fw-bold text-uppercase mb-3">
                    <?php echo e($ukm->nama_ukm); ?>

                </h1>

                <p class="text-white-50 fs-5 mb-4">
                    <?php echo e($ukm->deskripsi); ?>

                </p>

                <a href="<?php echo e(route('mahasiswa.pendaftaran.isi', ['ukm_slug' => $ukm->slug])); ?>" class="btn btn-warning shadow">
                        Daftar Sekarang
                    </a>

            </div>

        </div>

    </div>

</header>



<section class="container my-5">

    <div class="text-center mb-4">

        <h2 class="fw-bold text-uppercase">
            STRUKTUR PENGURUS
        </h2>

        <div class="title-line"></div>

    </div>

    <div class="row g-4 justify-content-center">
<?php
    // Ganti $ukmId menjadi $ukm->id
   $ketua = \App\Models\Pengurus::whereHas('ukm', function($query) use ($ukm) {
                    $query->where('nama_ukm', $ukm->nama_ukm);
                })
                ->where('jabatan', 'Ketua')
                ->first();

    $sekretaris = \App\Models\Pengurus::whereHas('ukm', function($query) use ($ukm) {
                    $query->where('nama_ukm', $ukm->nama_ukm);
                })
                ->where('jabatan', 'Sekretaris')
                ->first();

    $bendahara = \App\Models\Pengurus::whereHas('ukm', function($query) use ($ukm) {
                    $query->where('nama_ukm', $ukm->nama_ukm);
                })
                ->where('jabatan', 'Bendahara')
                ->first();
?>
        
        <div class="col-md-4">

            <div class="card shadow-sm border-0 rounded-4 h-100">

                <div class="card-body text-center p-4">

                    <?php if($ketua): ?>

                        <img src="<?php echo e($ketua->foto 
                                ? asset('storage/' . $ketua->foto)
                                : asset('assets/img/default-user.png')); ?>"
                             alt="Ketua"
                             style="width:120px;
                                    height:120px;
                                    border-radius:50%;
                                    object-fit:cover;
                                    border:4px solid #ffc107;">

                        <h4 class="fw-bold mt-3">
                            <?php echo e($ketua->nama); ?>

                        </h4>

                        <p class="text-muted mb-1">
                            Ketua
                        </p>

                        <small class="text-secondary">
                            Periode <?php echo e($ketua->periode); ?>

                        </small>

                    <?php else: ?>

                        <p class="text-muted">
                            Ketua belum tersedia
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        
        <div class="col-md-4">

            <div class="card shadow-sm border-0 rounded-4 h-100">

                <div class="card-body text-center p-4">

                    <?php if($sekretaris): ?>

                        <img src="<?php echo e($sekretaris->foto 
                                ? asset('storage/' . $sekretaris->foto)
                                : asset('assets/img/default-user.png')); ?>"
                             alt="Sekretaris"
                             style="width:120px;
                                    height:120px;
                                    border-radius:50%;
                                    object-fit:cover;
                                    border:4px solid #0d6efd;">

                        <h4 class="fw-bold mt-3">
                            <?php echo e($sekretaris->nama); ?>

                        </h4>

                        <p class="text-muted mb-1">
                            Sekretaris
                        </p>

                        <small class="text-secondary">
                            Periode <?php echo e($sekretaris->periode); ?>

                        </small>

                    <?php else: ?>

                        <p class="text-muted">
                            Sekretaris belum tersedia
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        
        <div class="col-md-4">

            <div class="card shadow-sm border-0 rounded-4 h-100">

                <div class="card-body text-center p-4">

                    <?php if($bendahara): ?>

                        <img src="<?php echo e($bendahara->foto 
                                ? asset('storage/' . $bendahara->foto)
                                : asset('assets/img/default-user.png')); ?>"
                             alt="Bendahara"
                             style="width:120px;
                                    height:120px;
                                    border-radius:50%;
                                    object-fit:cover;
                                    border:4px solid #198754;">

                        <h4 class="fw-bold mt-3">
                            <?php echo e($bendahara->nama); ?>

                        </h4>

                        <p class="text-muted mb-1">
                            Bendahara
                        </p>

                        <small class="text-secondary">
                            Periode <?php echo e($bendahara->periode); ?>

                        </small>

                    <?php else: ?>

                        <p class="text-muted">
                            Bendahara belum tersedia
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</section>

<?php endif; ?>



<?php if($activeTab == 'divisi'): ?>

<section class="container my-5 py-4">

    <div class="text-center mb-5">

        <h2 class="fw-bold text-uppercase">
            KEGIATAN <?php echo e($ukm->nama_ukm); ?>

        </h2>

        <div class="title-line"></div>

    </div>

    <div class="row g-4">

        <?php $__empty_1 = true; $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <?php if($item->foto): ?>
                    <img src="<?php echo e(asset('storage/' . $item->foto)); ?>"
                         class="card-img-top"
                         alt="<?php echo e($item->judul); ?>">
                <?php endif; ?>

                <div class="card-body">

                    <h5 class="fw-bold">
                        <?php echo e($item->judul); ?>

                    </h5>

                    <p class="text-muted">
                        <?php echo e(Str::limit($item->deskripsi, 100)); ?>

                    </p>

                    <small class="text-secondary">
                        <?php echo e($item->tanggal_kegiatan); ?>

                    </small>

                </div>

            </div>

        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <div class="col-12 text-center">

            <div class="alert alert-info">
                Belum ada kegiatan yang tersedia.
            </div>

        </div>

        <?php endif; ?>

    </div>

</section>

<?php endif; ?>



<?php if($activeTab == 'galeri'): ?>

<section class="container my-5 py-4">

```
<div class="text-center mb-5">
    <h2 class="fw-bold text-uppercase">
        GALERI <?php echo e($ukm->nama_ukm); ?>

    </h2>

    <div class="title-line"></div>
</div>

<div class="galeri-container">

    <div class="row g-4 justify-content-center">

        <?php $__empty_1 = true; $__currentLoopData = $galeri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <div class="galeri-card">

                    <a href="#"
                       data-bs-toggle="modal"
                       data-bs-target="#galeriModal"
                       onclick="showImage(
                            '<?php echo e(asset('storage/' . $item->gambar)); ?>',
                            '<?php echo e($item->judul); ?>',
                            '<?php echo e($item->deskripsi); ?>'
                       )">

                        <img
                            src="<?php echo e(asset('storage/' . $item->gambar)); ?>"
                            alt="<?php echo e($item->judul); ?>"
                            class="img-fluid rounded shadow-sm"
                            style="
                                width:100%;
                                height:180px;
                                object-fit:cover;
                                cursor:pointer;
                            "
                        >

                    </a>

                    <div class="mt-2 text-center">

                        <h6 class="fw-bold">
                            <?php echo e($item->judul); ?>

                        </h6>

                        <small class="text-muted">
                            <?php echo e($item->deskripsi); ?>

                        </small>

                    </div>

                </div>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <div class="col-12 text-center">

                <div class="alert alert-info">
                    Belum ada galeri untuk UKM ini.
                </div>

            </div>

        <?php endif; ?>

    </div>

</div>
```

</section>

<!-- Modal Galeri -->

<div class="modal fade" id="galeriModal" tabindex="-1">

```
<div class="modal-dialog modal-xl modal-dialog-centered">

    <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title" id="modalJudul"></h5>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
            </button>

        </div>

        <div class="modal-body text-center">

            <img id="modalImage"
                 src=""
                 class="img-fluid rounded mb-3"
                 style="max-height:700px;">

            <p id="modalDeskripsi"></p>

        </div>

    </div>

</div>
```

</div>

<script>
function showImage(image, judul, deskripsi)
{
    document.getElementById('modalImage').src = image;
    document.getElementById('modalJudul').innerText = judul;
    document.getElementById('modalDeskripsi').innerText = deskripsi;
}
</script>

<?php endif; ?>



<?php if($activeTab == 'jadwal'): ?>

<section class="container my-5 py-4">

    <div class="text-center mb-4">

        <h2 class="fw-bold text-uppercase">
            JADWAL <?php echo e($ukm->nama_ukm); ?>

        </h2>

        <div class="title-line"></div>

    </div>

    <?php if($jadwal): ?>

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-body">

                <h4 class="fw-bold text-center mb-4">
                    <?php echo e($jadwal->uraian); ?>

                </h4>

                <div class="table-responsive">

                    <table class="table table-bordered text-center align-middle">

                        <thead class="table-dark">

                            <tr>
                                <th>Jadwal</th>
                                <th>Sesi 1</th>
                                <th>Sesi 2</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td class="fw-bold">
                                    Pembukaan
                                </td>

                                <td>
                                    <?php echo e($jadwal->sesi_1_buka ?? '-'); ?>

                                </td>

                                <td>
                                    <?php echo e($jadwal->sesi_2_buka ?? '-'); ?>

                                </td>

                            </tr>

                            <tr>

                                <td class="fw-bold">
                                    Penutupan
                                </td>

                                <td>
                                    <?php echo e($jadwal->sesi_1_tutup ?? '-'); ?>

                                </td>

                                <td>
                                    <?php echo e($jadwal->sesi_2_tutup ?? '-'); ?>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    <?php else: ?>

        <div class="alert alert-info text-center">
            Jadwal belum tersedia.
        </div>

    <?php endif; ?>

</section>

<?php endif; ?>

<footer class="bg-white border-top py-4 text-center mt-5">

    <p class="text-muted mb-0 small">
        &copy; 2026 FMIPA. All rights reserved.
    </p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html><?php /**PATH D:\PROJEK TA TARRY\ta-ukm\resources\views/user/ukm/detail.blade.php ENDPATH**/ ?>