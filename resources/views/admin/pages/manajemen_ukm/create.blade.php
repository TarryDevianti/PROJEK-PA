@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header" style="background: linear-gradient(135deg, #3d2c1e, #5a4a3a); border: none; padding: 20px 30px; border-radius: 20px 20px 0 0;">
                    <h5 class="mb-0 fw-bold" style="color: #f5ede6;">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Data UKM Baru
                    </h5>
                </div>
                <div class="card-body p-4" style="background: #fdf8f2;">
                    <form action="{{ route('manajemen-ukm.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Data UKM -->
                        <h6 class="fw-bold mb-3" style="color: #3d2c1e;">
                            <i class="bi bi-building me-2" style="color: #d4a373;"></i> Data UKM
                        </h6>
                        <hr style="border-color: rgba(212, 163, 115, 0.1);">

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #3d2c1e;">
                                <i class="bi bi-building me-1" style="color: #d4a373;"></i> Nama UKM
                            </label>
                            <input type="text" name="nama_ukm" class="form-control rounded-3" 
                                   placeholder="Contoh: UKM Seni" value="{{ old('nama_ukm') }}" required
                                   style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                            @error('nama_ukm') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #3d2c1e;">
                                <i class="bi bi-text-paragraph me-1" style="color: #d4a373;"></i> Deskripsi UKM
                            </label>
                            <textarea name="deskripsi" class="form-control rounded-3" rows="3" 
                                      placeholder="Deskripsi singkat tentang UKM" 
                                      style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white; resize: vertical;">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #3d2c1e;">
                                <i class="bi bi-tag me-1" style="color: #d4a373;"></i> Status Awal
                            </label>
                            <select name="status" class="form-select rounded-3" 
                                    style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white; color: #3d2c1e;">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #3d2c1e;">
                                <i class="bi bi-image me-1" style="color: #d4a373;"></i> Logo UKM
                            </label>
                            <input type="file" name="logo" class="form-control rounded-3" 
                                   style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                            <small class="text-muted">Format: jpg, jpeg, png. Maks: 2MB</small>
                            @error('logo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Data Admin Pengurus -->
                        <h6 class="fw-bold mb-3 mt-4" style="color: #3d2c1e;">
                            <i class="bi bi-person-gear me-2" style="color: #d4a373;"></i> Data Admin Pengurus
                            <small class="text-muted d-block" style="font-size: 0.75rem;">Akun untuk mengelola UKM ini</small>
                        </h6>
                        <hr style="border-color: rgba(212, 163, 115, 0.1);">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #3d2c1e; font-size: 0.9rem;">
                                    <i class="bi bi-person me-1" style="color: #d4a373;"></i> Nama Admin
                                </label>
                                <input type="text" name="admin_name" class="form-control rounded-3" 
                                       placeholder="Nama lengkap admin" value="{{ old('admin_name') }}" required
                                       style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                                @error('admin_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #3d2c1e; font-size: 0.9rem;">
                                    <i class="bi bi-envelope me-1" style="color: #d4a373;"></i> Email Admin
                                </label>
                                <input type="email" name="admin_email" class="form-control rounded-3" 
                                       placeholder="email@admin.usk.ac.id" value="{{ old('admin_email') }}" required
                                       style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                                @error('admin_email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #3d2c1e; font-size: 0.9rem;">
                                    <i class="bi bi-lock me-1" style="color: #d4a373;"></i> Password Admin
                                </label>
                                <input type="text" name="admin_password" class="form-control rounded-3" 
                                       placeholder="Minimal 6 karakter" value="{{ old('admin_password') }}" required
                                       style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                                <small class="text-muted">Minimal 6 karakter</small>
                                @error('admin_password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #3d2c1e; font-size: 0.9rem;">
                                    <i class="bi bi-phone me-1" style="color: #d4a373;"></i> Telepon Admin
                                </label>
                                <input type="text" name="admin_telepon" class="form-control rounded-3" 
                                       placeholder="081234567890" value="{{ old('admin_telepon') }}"
                                       style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                            </div>
                        </div>

                        <!-- Jadwal Pendaftaran -->
                        <h6 class="fw-bold mb-3 mt-4" style="color: #3d2c1e;">
                            <i class="bi bi-calendar-range me-2" style="color: #d4a373;"></i> Jadwal Pendaftaran
                        </h6>
                        <hr style="border-color: rgba(212, 163, 115, 0.1);">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #3d2c1e; font-size: 0.9rem;">
                                    Sesi 1 - Buka
                                </label>
                                <input type="date" name="sesi_1_buka" class="form-control rounded-3" 
                                       value="{{ old('sesi_1_buka') }}"
                                       style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #3d2c1e; font-size: 0.9rem;">
                                    Sesi 1 - Tutup
                                </label>
                                <input type="date" name="sesi_1_tutup" class="form-control rounded-3" 
                                       value="{{ old('sesi_1_tutup') }}"
                                       style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #3d2c1e; font-size: 0.9rem;">
                                    Sesi 2 - Buka
                                </label>
                                <input type="date" name="sesi_2_buka" class="form-control rounded-3" 
                                       value="{{ old('sesi_2_buka') }}"
                                       style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #3d2c1e; font-size: 0.9rem;">
                                    Sesi 2 - Tutup
                                </label>
                                <input type="date" name="sesi_2_tutup" class="form-control rounded-3" 
                                       value="{{ old('sesi_2_tutup') }}"
                                       style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn rounded-pill px-4" 
                                    style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);">
                                <i class="bi bi-save me-1"></i> Simpan UKM & Buat Akun
                            </button>
                            <a href="{{ route('manajemen-ukm.index') }}" class="btn rounded-pill px-4" 
                               style="background: rgba(184, 168, 154, 0.15); color: #8a7a6a; font-weight: 500;">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('admin_created'))
<div class="modal fade" id="adminInfoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #2d6a4f, #52b788); border: none; padding: 20px 30px;">
                <h5 class="modal-title fw-bold" style="color: #f5ede6;">
                    <i class="bi bi-person-check me-2"></i> Akun Admin Pengurus Berhasil Dibuat!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background: #fdf8f2;">
                <div class="alert alert-success border-0 rounded-3" style="background: rgba(82, 183, 136, 0.08); border-left: 4px solid #52b788;">
                    <p class="mb-1"><strong>👤 Nama:</strong> {{ session('admin_created')['name'] }}</p>
                    <p class="mb-1"><strong>📧 Email:</strong> {{ session('admin_created')['email'] }}</p>
                    <p class="mb-1"><strong>🔑 Password:</strong> <code>{{ session('admin_created')['password'] }}</code></p>
                    <p class="mb-0"><strong>🏷️ Role:</strong> {{ session('admin_created')['role'] }}</p>
                </div>
                <div class="alert alert-warning border-0 rounded-3" style="background: rgba(244, 162, 97, 0.08); border-left: 4px solid #f4a261;">
                    <i class="bi bi-info-circle me-2"></i>
                    <small>Berikan informasi login ini kepada pengurus UKM. Mereka akan login ke dashboard sendiri untuk mengelola UKM.</small>
                </div>
            </div>
            <div class="modal-footer border-0" style="background: #fdf8f2; padding: 16px 30px 20px;">
                <button type="button" class="btn rounded-pill px-4" data-bs-dismiss="modal" 
                        style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600;">
                    <i class="bi bi-check-lg me-1"></i> Saya Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('adminInfoModal'), {
            backdrop: 'static',
            keyboard: false
        });
        modal.show();
    });
</script>
@endif
@endsection