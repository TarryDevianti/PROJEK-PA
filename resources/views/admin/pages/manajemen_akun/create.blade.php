@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4">
    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-header bg-white border-0 pt-4 ps-4">
            <h4 class="fw-bold">Tambah Akun Pengguna Baru</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('manajemen-akun.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold mb-2">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-pill" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold mb-2">NPM</label>
                        <input type="text" name="npm" class="form-control rounded-pill" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold mb-2">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control rounded-pill-start" required>
                            <button class="btn btn-outline-secondary rounded-pill-end" type="button" onclick="togglePassword('password')">
                                <i class="bi bi-eye" id="eye-icon-password"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold mb-2">Kategori Unit Kegiatan Mahasiswa (UKM)</label>
                        <select name="ukm_id" class="form-select rounded-pill" required>
                            <option value="" disabled selected>-- Pilih Kelompok Kerja UKM --</option>
                            @foreach($ukms as $ukm)
                                <option value="{{ $ukm->id }}">{{ $ukm->nama_ukm }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark px-4 rounded-pill">Simpan Akun</button>
                    <a href="{{ route('manajemen-akun.index') }}" class="btn btn-light border px-4 rounded-pill">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById('eye-icon-' + inputId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>

<style>
    .rounded-pill-start { border-top-left-radius: 50rem !important; border-bottom-left-radius: 50rem !important; }
    .rounded-pill-end { border-top-right-radius: 50rem !important; border-bottom-right-radius: 50rem !important; }
</style>
@endsection