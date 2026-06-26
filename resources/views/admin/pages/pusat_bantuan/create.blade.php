<!-- Modal Tambah FAQ -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <!-- Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #3d2c1e, #5a4a3a); border: none; padding: 20px 30px;">
                <h5 class="modal-title fw-bold" style="color: #f5ede6;">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Pusat Bantuan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <form action="{{ route('pusat-bantuan.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4" style="background: #fdf8f2;">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #3d2c1e;">
                            <i class="bi bi-question-circle me-1" style="color: #d4a373;"></i> Pertanyaan
                        </label>
                        <input type="text" name="pertanyaan" class="form-control rounded-3" 
                               placeholder="Masukkan pertanyaan..." required
                               style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #3d2c1e;">
                            <i class="bi bi-tag me-1" style="color: #d4a373;"></i> Kategori
                        </label>
                        <select name="kategori" class="form-select rounded-3" required
                                style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white; color: #3d2c1e;">
                            <option value="Umum">Umum</option>
                            <option value="Pendaftaran">Pendaftaran</option>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Teknis">Teknis</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #3d2c1e;">
                            <i class="bi bi-chat-dots me-1" style="color: #d4a373;"></i> Jawaban
                        </label>
                        <textarea name="jawaban" class="form-control rounded-3" rows="5" 
                                  placeholder="Masukkan jawaban..." required
                                  style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white; resize: vertical;"></textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0" style="background: #fdf8f2; padding: 16px 30px 20px;">
                    <button type="button" class="btn rounded-pill px-4" data-bs-dismiss="modal" 
                            style="background: rgba(184, 168, 154, 0.15); color: #8a7a6a; font-weight: 500;">
                        Batal
                    </button>
                    <button type="submit" class="btn rounded-pill px-4" 
                            style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);">
                        <i class="bi bi-save me-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>