@extends('admin_pengurus.layouts.main')

@section('content')

<div class="container-fluid">

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">

        <!-- UKM Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #3d2c1e, #5a4a3a);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase fw-semibold text-white-50 mb-2" style="letter-spacing: 0.5px; font-size: 0.75rem;">
                                UKM
                            </h6>
                            <h2 class="fw-bold mb-0 text-white" style="font-size: 2.5rem;">{{ $ukm->nama_ukm ?? 'UKM' }}</h2>
                        </div>
                        <div class="rounded-circle p-3" style="background: rgba(255,255,255,0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-building" style="font-size: 1.8rem; color: #e9c46a;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge" style="background: rgba(233, 196, 106, 0.2); color: #e9c46a; padding: 6px 14px; border-radius: 50px; font-weight: 500;">
                            <i class="fas fa-check-circle me-1"></i> UKM Admin
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Anggota -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #2d6a4f, #40916c);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase fw-semibold text-white-50 mb-2" style="letter-spacing: 0.5px; font-size: 0.75rem;">
                                Total Anggota
                            </h6>
                            <h2 class="fw-bold mb-0 text-white" style="font-size: 2.5rem;">{{ $jumlahAnggota ?? 0 }}</h2>
                        </div>
                        <div class="rounded-circle p-3" style="background: rgba(255,255,255,0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-users" style="font-size: 1.8rem; color: #52b788;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge" style="background: rgba(82, 183, 136, 0.2); color: #52b788; padding: 6px 14px; border-radius: 50px; font-weight: 500;">
                            <i class="fas fa-user-check me-1"></i> Anggota Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calon Anggota -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #4a2c6a, #6c3cb0);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase fw-semibold text-white-50 mb-2" style="letter-spacing: 0.5px; font-size: 0.75rem;">
                                Calon Anggota
                            </h6>
                            <h2 class="fw-bold mb-0 text-white" style="font-size: 2.5rem;">{{ $calonAnggota ?? 0 }}</h2>
                        </div>
                        <div class="rounded-circle p-3" style="background: rgba(255,255,255,0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-plus" style="font-size: 1.8rem; color: #b388ff;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge" style="background: rgba(179, 136, 255, 0.2); color: #b388ff; padding: 6px 14px; border-radius: 50px; font-weight: 500;">
                            <i class="fas fa-clock me-1"></i> Menunggu Konfirmasi
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kegiatan -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #6d4c41, #8d6e63);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase fw-semibold text-white-50 mb-2" style="letter-spacing: 0.5px; font-size: 0.75rem;">
                                Kegiatan
                            </h6>
                            <h2 class="fw-bold mb-0 text-white" style="font-size: 2.5rem;">{{ $jumlahKegiatan ?? 0 }}</h2>
                        </div>
                        <div class="rounded-circle p-3" style="background: rgba(255,255,255,0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar-alt" style="font-size: 1.8rem; color: #f4a261;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge" style="background: rgba(244, 162, 97, 0.2); color: #f4a261; padding: 6px 14px; border-radius: 50px; font-weight: 500;">
                            <i class="fas fa-calendar-check me-1"></i> Total Kegiatan
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Galeri Card (Tambahan) -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #c0392b, #e74c3c);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase fw-semibold text-white-50 mb-2" style="letter-spacing: 0.5px; font-size: 0.75rem;">
                                Galeri
                            </h6>
                            <h2 class="fw-bold mb-0 text-white" style="font-size: 2.5rem;">{{ $jumlahGaleri ?? 0 }}</h2>
                        </div>
                        <div class="rounded-circle p-3" style="background: rgba(255,255,255,0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-images" style="font-size: 1.8rem; color: #ff6b6b;"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge" style="background: rgba(255, 107, 107, 0.2); color: #ff6b6b; padding: 6px 14px; border-radius: 50px; font-weight: 500;">
                            <i class="fas fa-camera me-1"></i> Total Galeri
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Card - Statistik Pendaftaran -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-transparent border-0 pt-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-0" style="color: #3d2c1e;">
                        <i class="fas fa-chart-bar me-2" style="color: #d4a373;"></i>
                        Statistik Pendaftaran Anggota
                    </h5>
                    <p class="text-muted small mb-0">Distribusi pendaftaran per bulan</p>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div style="position: relative; height: 300px;">
                <canvas id="chartPendaftaran"></canvas>
            </div>
        </div>
    </div>

    <!-- Tabel Terbaru -->
    <div class="row mt-4 g-4">

        <!-- Pendaftaran Terbaru -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0" style="color: #3d2c1e;">
                        <i class="fas fa-clock me-2" style="color: #d4a373;"></i>
                        Pendaftaran Terbaru
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-4 py-3">Nama</th>
                                    <th class="border-0 px-4 py-3">Divisi</th>
                                    <th class="border-0 px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($pendaftaranTerbaru ?? [] as $item)
                                <tr>
                                    <td class="px-4 py-3 fw-semibold">{{ $item->nama_lengkap }}</td>
                                    <td class="px-4 py-3">{{ $item->divisi_tujuan ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        @if($item->status == 'diterima')
                                            <span class="badge" style="background: #c6f6d5; color: #22543d; padding: 6px 14px; border-radius: 50px; font-weight: 600;">
                                                <i class="fas fa-check-circle me-1"></i> Diterima
                                            </span>
                                        @elseif($item->status == 'pending')
                                            <span class="badge" style="background: #fefcbf; color: #744210; padding: 6px 14px; border-radius: 50px; font-weight: 600;">
                                                <i class="fas fa-clock me-1"></i> Pending
                                            </span>
                                        @else
                                            <span class="badge" style="background: #fed7d7; color: #9b2c2c; padding: 6px 14px; border-radius: 50px; font-weight: 600;">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fs-3 d-block mb-2"></i>
                                        Belum ada data pendaftaran
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Galeri Terbaru -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0" style="color: #3d2c1e;">
                        <i class="fas fa-images me-2" style="color: #d4a373;"></i>
                        Galeri Terbaru
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-4 py-3">Judul</th>
                                    <th class="border-0 px-4 py-3">Gambar</th>
                                    <th class="border-0 px-4 py-3">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($galeriTerbaru ?? [] as $item)
                                <tr>
                                    <td class="px-4 py-3">{{ $item->judul ?? 'Tanpa judul' }}</td>
                                    <td class="px-4 py-3">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                                 alt="Galeri"
                                                 style="width: 50px; height: 40px; object-fit: cover; border-radius: 8px; border: 1px solid #edf2f7;">
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fs-3 d-block mb-2"></i>
                                        Belum ada galeri
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

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statistik = @json($statistik ?? []);
    const bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const total = [];
    for (let i = 1; i <= 12; i++) {
        total.push(statistik[i] ?? 0);
    }

    const ctx = document.getElementById('chartPendaftaran').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, '#d4a373');
    gradient.addColorStop(1, '#e9c46a');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: bulan,
            datasets: [{
                label: 'Jumlah Pendaftaran',
                data: total,
                backgroundColor: gradient,
                borderColor: '#d4a373',
                borderWidth: 2,
                borderRadius: 8,
                barPercentage: 0.6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(61, 44, 30, 0.9)',
                    titleColor: '#f5ede6',
                    bodyColor: '#f5ede6',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return 'Pendaftaran: ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(61, 44, 30, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 1,
                        color: '#8a7a6a',
                        font: { size: 12 }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#8a7a6a',
                        font: { size: 13, weight: '600' }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });
});
</script>

@endsection