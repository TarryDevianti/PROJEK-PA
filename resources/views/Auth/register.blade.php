<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER - SISTEM INFORMASI UKM FMIPA USK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
<style>
body {
    background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
    color: #ffffff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
    margin: 0;
    position: relative;
}

/* Logo */
.logo-container {
    position: absolute;
    top: 0;
    left: 0;
    background: #ffffff;
    padding: 15px 25px 15px 20px;
    border-bottom-right-radius: 40px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    z-index: 10;
}

.logo-container img {
    height: 55px;
    width: auto;
}

/* Wrapper */
.main-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 0;
}

/* Card */
.register-card {
    width: 100%;
    max-width: 550px;
    text-align: center;

    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(15px);

    border-radius: 20px;
    padding: 40px;

    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

/* Icon */
.register-icon-wrapper {
    font-size: 4rem;
    color: #ffffff;
    margin-bottom: 10px;
}

/* Judul */
.register-card h3 {
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 30px;
    color: #ffffff;
}

/* Input */
.custom-input,
.custom-select {
    background: #ffffff !important;
    border: none !important;
    border-radius: 12px !important;
    padding: 14px 18px;
    font-size: 1rem;
    color: #222 !important;
}

.custom-input::placeholder {
    color: #777;
}

.custom-select {
    color: #555 !important;
}

.custom-input:focus,
.custom-select:focus {
    border: none !important;
    box-shadow: 0 0 0 4px rgba(59,130,246,.3);
}

/* Button */
.btn-custom {
    border: none;
    border-radius: 12px;
    padding: 12px 40px;
    font-weight: 600;
    transition: all .3s ease;
}

.btn-next {
    background: #3b82f6;
    color: white;
}

.btn-next:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

.btn-back {
    background: #64748b;
    color: white;
}

.btn-back:hover {
    background: #475569;
}

.btn-submit {
    background: #f97316;
    color: white;
}

.btn-submit:hover {
    background: #ea580c;
    transform: translateY(-2px);
}

/* Login text */
.login-back-text {
    color: #ffffff;
    margin-top: 25px;
}

.login-link {
    color: #fbbf24 !important;
    font-weight: bold;
    text-decoration: none;
}

.login-link:hover {
    text-decoration: underline;
}

/* Step Form */
.form-step {
    display: none;
}

.form-step-active {
    display: block;
}

/* Alert */
.alert-danger {
    border-radius: 10px !important;
}

/* Responsive */
@media(max-width:768px){

    .register-card{
        margin:20px;
        padding:25px;
    }

    .register-icon-wrapper{
        font-size:3rem;
    }

    .register-card h3{
        font-size:1.4rem;
    }
}
</style>
</head>
<body>

<div class="logo-container">
    <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo USK">
</div>

<div class="container main-wrapper">
    <div class="register-card">
        
        <div class="register-icon-wrapper">
            <i class="bi bi-person-circle"></i>
        </div>
        <h3 id="form-title">Register</h3>

        @if($errors->any())
            <div class="alert alert-danger p-2 small text-start mb-3 border-0" style="border-radius: 4px; color: #721c24; background-color: #f8d7da;">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        <form id="multi-step-form" method="POST" action="{{ url('/register') }}">
            @csrf
            
            <div class="form-step form-step-active" id="step-1">
                <div class="mb-3">
                    <input type="text" class="form-control custom-input" id="nama" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control custom-input" id="npm-input" placeholder="NPM (Nomor Pokok Mahasiswa)" value="{{ old('npm') }}" required>
                </div>
                
                <div class="mb-3">
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

                <div class="mb-3">
                    <input type="email" class="form-control custom-input" id="email-input" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control custom-input" id="telepon-input" placeholder="Nomor Telepon / WA" value="{{ old('telepon') }}" required>
                </div>

                <div class="mt-4">
                    <button type="button" class="btn btn-custom btn-next shadow-sm" onclick="nextStep()">Next</button>
                </div>
            </div>

            <div class="form-step" id="step-2">
                <div class="mb-3">
                    <input type="text" class="form-control custom-input" name="angkatan" placeholder="Angkatan (Contoh: 2023)" value="{{ old('angkatan') }}" required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control custom-input" name="password" placeholder="Buat Password Akun" required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control custom-input" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>
                
                <input type="hidden" id="hidden-nama" name="name"> 
                <input type="hidden" id="hidden-npm" name="npm">
                <input type="hidden" id="hidden-prodi" name="program_studi">
                <input type="hidden" id="hidden-email" name="email">
                <input type="hidden" id="hidden-telepon" name="telepon">

                <div class="mt-4">
                    <button type="button" class="btn btn-custom btn-back shadow-sm" onclick="backStep()">Back</button>
                    <button type="submit" class="btn btn-custom btn-submit shadow-sm">Daftar Akun</button>
                </div>
            </div>

            <p class="login-back-text">
                Sudah punya akun? <a href="{{ url('/login') }}" class="login-link fw-bold text-decoration-none">Login disini</a>
            </p>
        </form>

    </div>
</div>

<script>
    function nextStep() {
        const nama = document.getElementById('nama');
        const npm = document.getElementById('npm-input');
        const prodi = document.getElementById('program_studi');
        const email = document.getElementById('email-input');
        const telepon = document.getElementById('telepon-input');

        // Validasi Step 1: Cegah klik Next kalau data kontak ada yang kosong
        if (!nama.value || !npm.value || !prodi.value || !email.value || !telepon.value) {
            alert('Mohon isi Nama, NPM, Prodi, Email, dan Telepon terlebih dahulu!');
            return;
        }

        // Sinkronisasi data ke input hidden agar bisa dikirim saat submit form
        document.getElementById('hidden-nama').value = nama.value;
        document.getElementById('hidden-npm').value = npm.value;
        document.getElementById('hidden-prodi').value = prodi.value;
        document.getElementById('hidden-email').value = email.value;
        document.getElementById('hidden-telepon').value = telepon.value;

        // Berpindah ke Step 2
        document.getElementById('step-1').classList.remove('form-step-active');
        document.getElementById('step-2').classList.add('form-step-active');
        
        // Ubah judul header
        document.getElementById('form-title').innerText = "Detail Akun";
    }

    function backStep() {
        // Kembali ke Step 1
        document.getElementById('step-2').classList.remove('form-step-active');
        document.getElementById('step-1').classList.add('form-step-active');
        
        // Kembalikan judul default
        document.getElementById('form-title').innerText = "Register";
    }
</script>

</body>
</html>