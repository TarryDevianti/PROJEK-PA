<!-- Isi file create.blade.php -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold">TAMBAH PUSAT BANTUAN</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('pusat-bantuan.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pertanyaan</label>
                        <input type="text" name="pertanyaan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Umum">Umum</option>
                            <option value="Pendaftaran">Pendaftaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jawaban</label>
                        <textarea name="jawaban" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-dark">SIMPAN DATA</button>
                </div>
            </form>
        </div>
    </div>
</div>