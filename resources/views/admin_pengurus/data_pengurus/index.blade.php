@extends('admin_pengurus.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: rgba(212, 163, 115, 0.05); border-bottom: 1px solid rgba(212, 163, 115, 0.15);">
                    <h3 class="card-title" style="color: #e9c46a; font-weight: 600; margin: 0;">
                        <i class="bi bi-people-fill me-2"></i> Data Pengurus UKM
                    </h3>
                    <button type="button" class="btn btn-primary btn-tambah-pengurus" onclick="document.getElementById('tambahModal').style.display='block'; document.getElementById('tambahModal').classList.add('show');">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Pengurus
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Jabatan</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Periode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengurus as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-jabatan">{{ ucfirst($item->jabatan) }}</span></td>
                                <td>{{ $item->user->name ?? $item->nama }}</td>
                                <td>{{ $item->user->npm ?? '-' }}</td>
                                <td>{{ $item->periode }}</td>
                                <td>
                                    <div class="btn-group-aksi">
                                        <!-- Tombol Detail -->
                                        <a href="#" class="btn-aksi btn-detail" title="Detail" data-toggle="modal" data-target="#detailModal{{ $item->id }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <!-- Tombol Edit -->
                                        <a href="#" class="btn-aksi btn-edit" title="Edit" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin_pengurus.data_pengurus.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-aksi btn-hapus" title="Hapus" onclick="return confirm('Yakin hapus pengurus ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    <i class="bi bi-info-circle"></i> Belum ada pengurus untuk UKM ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengurus -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin_pengurus.data_pengurus.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background: rgba(212, 163, 115, 0.08); border-bottom: 1px solid rgba(212, 163, 115, 0.15);">
                    <h5 class="modal-title" id="tambahModalLabel" style="color: #e9c46a;">
                        <i class="bi bi-person-plus me-2"></i> Tambah Pengurus
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #e78b3b;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">Pilih Anggota</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($anggota as $a)
                                <option value="{{ $a->id }}">{{ $a->name }} ({{ $a->npm }})</option>
                            @endforeach
                        </select>
                        @if($anggota->isEmpty())
                            <small class="text-muted text-danger">
                                <i class="bi bi-exclamation-circle"></i> Tidak ada anggota yang tersedia untuk diangkat menjadi pengurus.
                            </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control" required>
                            <option value="ketua">Ketua</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                        </select>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-info-circle"></i> Periode akan diisi otomatis berdasarkan tahun berjalan.
                    </small>
                </div>
                <div class="modal-footer" style="background: rgba(0,0,0,0.02); border-top: 1px solid rgba(212, 163, 115, 0.1);">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-simpan">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail & Edit -->
@foreach($pengurus as $item)
<!-- Detail Modal -->
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: rgba(212, 163, 115, 0.08); border-bottom: 1px solid rgba(212, 163, 115, 0.15);">
                <h5 class="modal-title" id="detailModalLabel{{ $item->id }}" style="color: #e9c46a;">
                    <i class="bi bi-person-circle me-2"></i> Detail Pengurus
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #e78b3b;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nama:</strong> {{ $item->user->name ?? $item->nama }}</p>
                <p><strong>NPM:</strong> {{ $item->user->npm ?? '-' }}</p>
                <p><strong>Jabatan:</strong> {{ ucfirst($item->jabatan) }}</p>
                <p><strong>Periode:</strong> {{ $item->periode }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background: rgba(212, 163, 115, 0.08); border-bottom: 1px solid rgba(212, 163, 115, 0.15);">
                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}" style="color: #e9c46a;">
                        <i class="bi bi-pencil-square me-2"></i> Edit Pengurus
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #e78b3b;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan" class="form-control">
                            <option value="ketua" {{ $item->jabatan == 'ketua' ? 'selected' : '' }}>Ketua</option>
                            <option value="sekretaris" {{ $item->jabatan == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                            <option value="bendahara" {{ $item->jabatan == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Periode</label>
                        <input type="text" name="periode" class="form-control" value="{{ $item->periode }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-simpan">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('styles')
<style>
    /* ============================================================
       TOMBOL TAMBAH PENGURUS - WARNA BIRU (BOOTSTRAP PRIMARY)
       ============================================================ */
    .btn-tambah-pengurus {
        background: #2563eb !important; /* Biru solid */
        color: #ffffff !important;
        font-weight: 600;
        padding: 8px 22px;
        border: none;
        border-radius: 30px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        transition: all 0.3s ease;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        cursor: pointer;
    }
    .btn-tambah-pengurus:hover {
        background: #1d4ed8 !important;
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.5);
        color: #ffffff !important;
    }
    .btn-tambah-pengurus:active {
        transform: translateY(0) scale(0.97);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
    }
    .btn-tambah-pengurus i {
        color: #ffffff;
        margin-right: 4px;
    }

    /* ============================================================
       TOMBOL SIMPAN DI MODAL - BIRU
       ============================================================ */
    .btn-simpan {
        background: #2563eb !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        border: none !important;
        padding: 8px 28px !important;
        border-radius: 30px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 3px 10px rgba(37, 99, 235, 0.3) !important;
        cursor: pointer;
    }
    .btn-simpan:hover {
        background: #1d4ed8 !important;
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4) !important;
        color: #ffffff !important;
    }

    /* ============================================================
       BADGE JABATAN - TEKS HITAM
       ============================================================ */
    .badge-jabatan {
        background: linear-gradient(145deg, #f7dc6f, #f1c40f) !important;
        color: #000000 !important;
        padding: 5px 14px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
        box-shadow: inset 0 1px 3px rgba(255,255,255,0.3);
        border: 1px solid rgba(212,163,115,0.3);
    }

    /* ============================================================
       TOMBOL AKSI (Detail, Edit, Hapus) - FILL DENGAN ICON BI
       ============================================================ */
    .btn-group-aksi {
        display: flex;
        gap: 5px;
        align-items: center;
        justify-content: center;
    }

    .btn-aksi {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: none;
        font-size: 1rem;
        transition: all 0.2s ease;
        color: #fff;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-aksi:hover {
        transform: scale(1.15);
        filter: brightness(1.1);
        text-decoration: none;
        color: #fff;
    }

    .btn-detail {
        background: #17a2b8;
    }
    .btn-detail:hover {
        background: #138496;
        color: #fff;
    }

    .btn-edit {
        background: #ffc107;
        color: #212529;
    }
    .btn-edit:hover {
        background: #e0a800;
        color: #212529;
    }

    .btn-hapus {
        background: #dc3545;
    }
    .btn-hapus:hover {
        background: #c82333;
        color: #fff;
    }

    .btn-aksi i {
        font-size: 1rem;
        line-height: 1;
    }

    /* ============================================================
       TABEL & CARD
       ============================================================ */
    .card-title {
        color: #e9c46a;
        font-weight: 600;
    }
    .table {
        color: #f5ede6;
    }
    .table thead th {
        border-bottom: 2px solid rgba(212, 163, 115, 0.2);
        color: #e9c46a;
        font-weight: 600;
        padding: 12px 8px;
    }
    .table tbody tr {
        border-bottom: 1px solid rgba(212, 163, 115, 0.06);
        transition: background 0.2s ease;
    }
    .table tbody tr:hover {
        background: rgba(212, 163, 115, 0.06);
    }
    .table td {
        padding: 10px 8px;
        vertical-align: middle;
    }

    /* ============================================================
       MODAL
       ============================================================ */
    .modal-content {
        background: #2d1f15;
        border: 1px solid rgba(212, 163, 115, 0.2);
        border-radius: 12px;
    }
    .modal-body label {
        color: #e9c46a;
        font-weight: 500;
    }
    .modal-body .form-control {
        background: #1a120c;
        border: 1px solid rgba(212, 163, 115, 0.2);
        color: #f5ede6;
        border-radius: 8px;
    }
    .modal-body .form-control:focus {
        border-color: #d4a373;
        box-shadow: 0 0 0 0.2rem rgba(212, 163, 115, 0.25);
    }
    .modal-body .form-control option {
        background: #2d1f15;
        color: #f5ede6;
    }
</style>
@endpush