<!-- Modal Edit FAQ -->
<div class="modal fade" id="modalEdit{{ $faq->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $faq->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
            <!-- Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #3d2c1e, #5a4a3a); border: none; padding: 20px 30px;">
                <h5 class="modal-title fw-bold" id="modalEditLabel{{ $faq->id }}" style="color: #f5ede6;">
                    <i class="bi bi-pencil-square me-2"></i> Edit Pusat Bantuan
                </h5>
                <!-- Tombol Edit -->
<button class="btn btn-sm rounded-pill px-3" 
        style="background: rgba(212, 163, 115, 0.08); color: #d4a373; transition: all 0.3s ease;"
        data-bs-toggle="modal" 
        data-bs-target="#modalEdit{{ $faq->id }}"
        title="Edit FAQ">
    <i class="bi bi-pencil me-1"></i> Edit
</button>
            </div>

            <!-- Body -->
            <form action="{{ route('pusat-bantuan.update', $faq->id) }}" method="POST" id="editForm{{ $faq->id }}">
                @csrf
                @method('PUT')
                <div class="modal-body p-4" style="background: #fdf8f2;">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #3d2c1e;">
                            <i class="bi bi-question-circle me-1" style="color: #d4a373;"></i> Pertanyaan
                        </label>
                        <input type="text" name="pertanyaan" class="form-control rounded-3" 
                               value="{{ old('pertanyaan', $faq->pertanyaan) }}" required
                               style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white; transition: all 0.3s ease;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #3d2c1e;">
                            <i class="bi bi-tag me-1" style="color: #d4a373;"></i> Kategori
                        </label>
                        <select name="kategori" class="form-select rounded-3" required
                                style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white; color: #3d2c1e; transition: all 0.3s ease;">
                            <option value="Umum" {{ ($faq->kategori ?? '') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            <option value="Pendaftaran" {{ ($faq->kategori ?? '') == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                            <option value="Kegiatan" {{ ($faq->kategori ?? '') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Teknis" {{ ($faq->kategori ?? '') == 'Teknis' ? 'selected' : '' }}>Teknis</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color: #3d2c1e;">
                            <i class="bi bi-chat-dots me-1" style="color: #d4a373;"></i> Jawaban
                        </label>
                        <textarea name="jawaban" class="form-control rounded-3" rows="5" required
                                  style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white; resize: vertical; transition: all 0.3s ease;">{{ old('jawaban', $faq->jawaban) }}</textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0" style="background: #fdf8f2; padding: 16px 30px 20px;">
                    <button type="button" class="btn rounded-pill px-4" data-bs-dismiss="modal" 
                            style="background: rgba(184, 168, 154, 0.15); color: #8a7a6a; font-weight: 500; transition: all 0.3s ease;"
                            onmouseover="this.style.background='rgba(184, 168, 154, 0.25)'"
                            onmouseout="this.style.background='rgba(184, 168, 154, 0.15)'">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn rounded-pill px-4" 
                            style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3); transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(212, 163, 115, 0.4)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(212, 163, 115, 0.3)'">
                        <i class="bi bi-check-lg me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk handle modal edit -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reset form saat modal ditutup
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            const form = this.querySelector('form');
            if (form) {
                // Hapus error states jika ada
                form.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
            }
        });
    });

    // Handle form submission dengan AJAX (opsional)
    document.querySelectorAll('form[id^="editForm"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            // Form akan submit normal, tidak perlu preventDefault
            // Tapi kita bisa tambahkan loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...';
                submitBtn.disabled = true;
            }
        });
    });
});
</script>