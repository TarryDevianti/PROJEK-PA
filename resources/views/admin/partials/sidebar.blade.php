<aside class="app-sidebar" data-bs-theme="dark" style="background: linear-gradient(180deg, #3d2c1e 0%, #2d1f15 100%); border-right: 1px solid rgba(212, 163, 115, 0.1); height: 100vh; overflow-y: auto; position: fixed; top: 0; left: 0; width: 250px; z-index: 1030; transition: all 0.3s ease; padding-bottom: 60px;">
    
    <!-- Sidebar Brand -->
    <div class="sidebar-brand" style="background: rgba(212, 163, 115, 0.08); border-bottom: 1px solid rgba(212, 163, 115, 0.1); padding: 16px 20px; display: flex; align-items: center; justify-content: center;">
        <a href="{{ route('dashboard.super.admin') }}" class="brand-link" style="text-decoration: none; display: flex; align-items: center; gap: 12px;">
            <img src="{{ asset('adminlte/dist/assets/img/AdminLTELogo.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image opacity-75 shadow" 
                 style="border: 2px solid #d4a373; border-radius: 50%; width: 40px; height: 40px; object-fit: contain; padding: 4px; background: rgba(255,255,255,0.05);" />
            <span class="brand-text fw-light" style="color: #e9c46a; font-weight: 700; letter-spacing: 0.5px; font-size: 1.1rem;">Super Admin</span>
        </a>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper" style="padding: 8px 0;">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" role="menu">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.super.admin') }}" class="nav-link {{ request()->routeIs('dashboard.super.admin') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- DATA PENGURUS -->
                <li class="nav-item">
                    <a href="{{ route('pengurus.admin') }}" class="nav-link {{ request()->is('admin/pengurus*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-badge-fill"></i>
                        <p>Data Pengurus UKM</p>
                    </a>
                </li>

                <!-- DATA PENDAFTARAN -->
                <li class="nav-item">
                    <a href="{{ route('pendaftaran.admin') }}" class="nav-link {{ request()->is('admin/pendaftaran*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Data Pendaftaran</p>
                    </a>
                </li>

                <!-- ========================================== -->
                <!-- UKM LIST DENGAN SUBMENU -->
                <!-- ========================================== -->
                @php
                    $ukms = App\Models\Ukm::where('status', 'aktif')->orderBy('nama_ukm')->get();
                @endphp

                @forelse($ukms as $ukm)
                    @php
                        $ukmSlug = $ukm->slug;
                        $ukmName = $ukm->nama_ukm;
                        $ukmId = $ukm->id;
                        $isActive = request()->is('admin/ukm/' . $ukmId . '/*') || 
                                    request()->is('admin/ukm/' . $ukmSlug . '/*') ||
                                    request()->is('admin/ukm/' . $ukmId) ||
                                    (request()->routeIs('kegiatan.ukm') && request()->route('slug') == $ukmSlug) ||
                                    (request()->routeIs('admin.ukm.anggota') && request()->route('ukm_id') == $ukmId);
                    @endphp
                    <li class="nav-item has-treeview {{ $isActive ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)" class="nav-link ukm-toggle {{ $isActive ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clipboard-fill"></i>
                            <p>
                                {{ strtoupper($ukmName) }}
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('kegiatan.ukm', ['slug' => $ukmSlug]) }}" class="nav-link {{ request()->routeIs('kegiatan.ukm') && request()->route('slug') == $ukmSlug ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Kegiatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.ukm.anggota', ['ukm_id' => $ukmId]) }}" class="nav-link {{ request()->routeIs('admin.ukm.anggota') && request()->route('ukm_id') == $ukmId ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data Anggota</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @empty
                    <li class="nav-item">
                        <div style="color: #b8a89a; padding: 10px 20px; font-size: 0.85rem; text-align: center;">
                            <i class="bi bi-info-circle me-1"></i> Belum ada UKM
                        </div>
                    </li>
                @endforelse

                <!-- ========================================== -->
                <!-- MANAJEMEN -->
                <!-- ========================================== -->
                <li class="nav-header">Manajemen</li>

                <li class="nav-item">
                    <a href="{{ url('/admin/manajemen-ukm') }}" class="nav-link {{ request()->is('admin/manajemen-ukm*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-kanban"></i>
                        <p>Manajemen UKM</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('manajemen-akun.index') }}" class="nav-link {{ request()->is('admin/manajemen-akun*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-gear"></i>
                        <p>Manajemen Akun</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pusat-bantuan.index') }}" class="nav-link {{ request()->is('admin/pusat-bantuan*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-question-circle-fill"></i>
                        <p>Pusat Bantuan</p>
                    </a>
                </li>

                <!-- LOGOUT -->
                <li class="nav-item" style="margin-top: 8px;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <span>v1.0.0</span>
    </div>
</aside>

<!-- ========================================== -->
<!-- CSS SIDEBAR - DIPERBAIKI -->
<!-- ========================================== -->
<style>
    /* Sidebar utama */
    .app-sidebar {
        background: linear-gradient(180deg, #3d2c1e 0%, #2d1f15 100%) !important;
        border-right: 1px solid rgba(212, 163, 115, 0.1) !important;
        height: 100vh;
        overflow-y: auto;
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        z-index: 1030;
        transition: all 0.3s ease;
    }

    /* Sidebar brand */
    .sidebar-brand {
        background: rgba(212, 163, 115, 0.08) !important;
        border-bottom: 1px solid rgba(212, 163, 115, 0.1) !important;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .brand-link {
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .brand-image {
        border: 2px solid #d4a373;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        object-fit: contain;
        padding: 4px;
        background: rgba(255,255,255,0.05);
    }

    .brand-text {
        color: #e9c46a !important;
        font-weight: 700;
        letter-spacing: 0.5px;
        font-size: 1.1rem;
    }

    /* Sidebar wrapper */
    .sidebar-wrapper {
        padding: 8px 0;
    }

    /* Nav link */
    .nav-link {
        color: #b8a89a !important;
        padding: 10px 16px !important;
        border-radius: 8px !important;
        margin: 2px 8px !important;
        transition: all 0.3s ease !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        text-decoration: none !important;
        cursor: pointer !important;
    }

    .nav-link i {
        color: #b8a89a !important;
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .nav-link p {
        color: #b8a89a !important;
        margin: 0 !important;
        font-weight: 500 !important;
        font-size: 0.95rem !important;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    /* Active state */
    .nav-link.active {
        background: rgba(212, 163, 115, 0.12) !important;
        color: #e9c46a !important;
    }

    .nav-link.active i {
        color: #e9c46a !important;
    }

    .nav-link.active p {
        color: #f5ede6 !important;
    }

    /* Hover state */
    .nav-link:not(.active):hover {
        background: rgba(212, 163, 115, 0.08) !important;
        color: #f5ede6 !important;
    }

    .nav-link:not(.active):hover i {
        color: #e9c46a !important;
    }

    .nav-link:not(.active):hover p {
        color: #f5ede6 !important;
    }

    /* Nav header */
    .nav-header {
        color: #d4a373 !important;
        font-weight: 700 !important;
        letter-spacing: 1px !important;
        font-size: 0.75rem !important;
        padding: 12px 16px 8px !important;
        margin-top: 8px !important;
        border-top: 1px solid rgba(212, 163, 115, 0.08) !important;
        text-transform: uppercase !important;
    }

    /* ========================================== */
    /* TREEVIEW / SUBMENU - DIPERBAIKI */
    /* ========================================== */
    .has-treeview .nav-treeview {
        max-height: 0 !important;
        overflow: hidden !important;
        transition: max-height 0.4s ease !important;
        background: rgba(0, 0, 0, 0.15) !important;
        border-radius: 8px !important;
        margin: 0 12px !important;
        list-style: none !important;
        padding: 0 !important;
        display: block !important;
    }

    .has-treeview.menu-open .nav-treeview {
        max-height: 300px !important;
        padding: 6px 0 !important;
    }

    /* Submenu items */
    .nav-treeview .nav-link {
        padding: 8px 16px 8px 35px !important;
        margin: 1px 4px !important;
        border-radius: 6px !important;
        color: #b8a89a !important;
        font-size: 0.9rem !important;
        gap: 8px !important;
        cursor: pointer !important;
    }

    .nav-treeview .nav-link i {
        font-size: 6px !important;
        color: #d4a373 !important;
        width: 16px !important;
    }

    .nav-treeview .nav-link p {
        color: #b8a89a !important;
        font-size: 0.9rem !important;
        margin: 0 !important;
    }

    .nav-treeview .nav-link:hover {
        background: rgba(212, 163, 115, 0.06) !important;
        color: #e9c46a !important;
    }

    .nav-treeview .nav-link:hover p {
        color: #e9c46a !important;
    }

    .nav-treeview .nav-link.active {
        background: rgba(212, 163, 115, 0.1) !important;
        color: #e9c46a !important;
    }

    .nav-treeview .nav-link.active p {
        color: #e9c46a !important;
    }

    /* Arrow rotation */
    .nav-arrow {
        transition: transform 0.3s ease !important;
        color: #b8a89a !important;
        font-size: 0.8rem !important;
    }

    .has-treeview.menu-open .nav-arrow {
        transform: rotate(90deg) !important;
    }

    /* Logout button */
    .logout-btn {
        background: rgba(220, 38, 38, 0.08) !important;
        border: 1px solid rgba(220, 38, 38, 0.15) !important;
        border-radius: 8px !important;
        margin: 4px 8px !important;
        width: calc(100% - 16px) !important;
        text-align: left !important;
        color: #ef4444 !important;
        transition: all 0.3s ease !important;
        padding: 10px 16px !important;
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        border: none !important;
    }

    .logout-btn:hover {
        background: rgba(220, 38, 38, 0.15) !important;
        border-color: rgba(220, 38, 38, 0.3) !important;
    }

    .logout-btn i {
        color: #ef4444 !important;
        font-size: 1.1rem;
    }

    .logout-btn span {
        color: #ef4444 !important;
        font-weight: 600 !important;
        font-size: 0.95rem !important;
    }

    /* Sidebar footer */
    .sidebar-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 12px 16px;
        border-top: 1px solid rgba(255,255,255,0.05);
        text-align: center;
        font-size: 0.7rem;
        color: rgba(255,255,255,0.2);
    }

    /* Scrollbar */
    .app-sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .app-sidebar::-webkit-scrollbar-track {
        background: rgba(255,255,255,0.02);
    }

    .app-sidebar::-webkit-scrollbar-thumb {
        background: rgba(212,163,115,0.3);
        border-radius: 4px;
    }

    .app-sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(212,163,115,0.5);
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .app-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            width: 280px;
        }

        .app-sidebar.show {
            transform: translateX(0);
        }
    }
</style>

<!-- ========================================== -->
<!-- SCRIPT TOGGLE MENU - DIPERBAIKI -->
<!-- ========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const toggles = document.querySelectorAll('.ukm-toggle');

    toggles.forEach(toggle => {

        toggle.addEventListener('click', function (e) {
            e.preventDefault();

            const parent = this.closest('.has-treeview');

            if (parent.classList.contains('menu-open')) {
                parent.classList.remove('menu-open');
            } else {
                // Tutup semua menu lain
                document.querySelectorAll('.has-treeview').forEach(item => {
                    item.classList.remove('menu-open');
                });
                parent.classList.add('menu-open');
            }
        });

    });

    // Auto open menu yang aktif
    document.querySelectorAll('.has-treeview.menu-open').forEach(item => {
        const treeview = item.querySelector('.nav-treeview');
        if (treeview) {
            treeview.style.maxHeight = '300px';
            treeview.style.padding = '6px 0';
        }
    });
});
</script>