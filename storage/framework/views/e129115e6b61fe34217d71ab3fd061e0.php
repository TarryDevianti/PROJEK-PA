<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEM INFORMASI UKM FMIPA USK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
       body {
            /* MENGGUNAKAN BACKGROUND FOTO ASLI TANPA OVERLAY WARNA */
            background-image: url("<?php echo e(asset('assets/img/bg_login.jpg')); ?>");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            margin: 0;
            position: relative;
        }

        /* Wadah melengkung putih di pojok kiri atas untuk tempat Logo */
        .logo-container {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ffffff;
            padding: 12px 25px 15px 20px;
            border-bottom-right-radius: 40px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Logo murni berbentuk lingkaran/bunga tanpa teks pendamping */
        .logo-container img {
            height: 55px;
            width: auto;
            object-fit: contain;
        }

        /* Mengatur tinggi container utama agar seimbang di tengah layar */
        .main-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            z-index: 5;
        }

        /* Judul besar di sebelah kiri dengan bayangan agar terbaca di atas foto */
        .headline-text {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.3;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            /* Efek bayangan teks yang dipertebal agar kontras dengan warna gedung */
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.85), -1px -1px 0 rgba(0,0,0,0.5);
        }

        /* Box Card Login berbentuk persegi melengkung warna Putih Bersih */
        .login-card {
            background-color: #ffffff;
            border: none;
            border-radius: 45px;
            padding: 40px 40px;
            color: #333333;
            width: 100%;
            max-width: 460px;
            margin: auto;
            box-shadow: 0 10px 35px rgba(0,0,0,0.25) !important;
        }

        .login-card h3 {
            font-weight: 700;
            letter-spacing: 1px;
            color: #f39c12;
        }

        /* Icon lingkaran User di atas teks SIGN IN */
        .user-icon-wrapper {
            font-size: 3.5rem;
            color: #f39c12;
            line-height: 1;
            margin-bottom: 5px;
        }

        /* Input Form kotak siku murni dengan border abu-abu tipis */
        .custom-input, .custom-select {
            background-color: #f9f9f9 !important;
            border: 1px solid #e0e0e0 !important;
            border-radius: 0px !important;
            padding: 12px 15px;
            font-size: 1.1rem;
            color: #000000 !important;
        }

        .custom-select {
            color: #7a7a7a !important;
            cursor: pointer;
        }

        .custom-select:focus, .custom-select:valid {
            color: #000000 !important;
        }

        .custom-input::placeholder {
            color: #7a7a7a;
            font-weight: 500;
        }

        .custom-input:focus, .custom-select:focus {
            border-color: #f39c12 !important;
            box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.2);
        }

        /* Tombol submit login berbentuk bulat lonjong berwarna oren */
        .btn-login {
            background-color: #f39c12;
            color: #ffffff;
            border: none;
            border-radius: 20px;
            padding: 8px 45px;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
            text-transform: uppercase;
        }

        .btn-login:hover {
            background-color: #e67e22;
            color: #ffffff;
        }

        .register-text {
            font-size: 0.9rem; 
            color: #777777; 
            font-weight: 500;
        }

        .register-link {
            color: #f39c12 !important;
            transition: color 0.2s;
        }

        .register-link:hover {
            color: #e67e22 !important;
            text-decoration: underline !important;
        }
    </style>
</head>
<body>

<div class="logo-container">
    <img src="<?php echo e(asset('assets/img/logo.jpg')); ?>" alt="Logo USK">
</div>

<div class="container main-wrapper">
    <div class="row w-100 align-items-center">
        
        <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start col-xl-7">
            <h1 class="headline-text pe-lg-5">
                Sistem Informasi<br>
                Unit Kegiatan<br>
                Mahasiswa FMIPA
            </h1>
        </div>

        <div class="col-lg-6 col-xl-5 d-flex justify-content-center">
            <div class="login-card text-center">
                
                <div class="user-icon-wrapper">
                    <i class="bi bi-person-circle"></i>
                </div>
                
                <h3 class="mb-4">SIGN IN</h3>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger p-2 small border-0 text-start mb-3" style="border-radius: 8px;">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(url('/login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="mb-3">
                        <select class="form-select custom-select" name="role" required>
                            <option value="" disabled selected hidden>PILIH KATEGORI LOGIN</option>
                            <option value="anggota">Anggota</option>
                            <option value="pengurus">Admin Pengurus</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="text" 
                               class="form-control custom-input" 
                               name="npm" 
                               placeholder="NPM" 
                               value="<?php echo e(old('npm')); ?>" 
                               required>
                    </div>
                    
                    <div class="mb-4">
                        <input type="password" 
                               class="form-control custom-input" 
                               name="password" 
                               placeholder="PASSWORD" 
                               required>
                    </div>
                    
                    <div class="d-flex justify-content-center mb-2">
                        <button type="submit" class="btn btn-login shadow-sm">Login</button>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <p class="mb-0 register-text">
                            Belum mempunyai akun? 
                            <a href="<?php echo e(url('/register')); ?>" class="text-decoration-none fw-bold register-link">
                                Register disini
                            </a>
                        </p>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html><?php /**PATH D:\PROJEK TA TARRY\ta-ukm\resources\views/Auth/login.blade.php ENDPATH**/ ?>