<div class="modal fade" id="modalEdit{{ $faq->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header bg-secondary text-white" style="border-radius: 15px 15px 0 0;">
                <h5 class="modal-title fw-bold">EDIT PUSAT BANTUAN</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pusat-bantuan.update', $faq->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pertanyaan</label>
                        <input type="text" name="pertanyaan" class="form-control" value="{{ $faq->pertanyaan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Umum" {{ $faq->kategori == 'Umum' ? 'selected' : '' }}>Umum</option>
                            <option value="Pendaftaran" {{ $faq->kategori == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                            </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jawaban</label>
                        <textarea name="jawaban" class="form-control" rows="5" required>{{ $faq->jawaban }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4">
                    <button type="button" class="btn btn-light border px-4" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary px-4">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>