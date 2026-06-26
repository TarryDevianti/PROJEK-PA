@php
    // Logo UKM tetap dinamis
    $logo = 'assets/img/seuramoe.png';
    if (auth()->check()) {
        if (auth()->user()->ukm_id == 2) {
            $logo = 'assets/img/ululalbab.png';
        } elseif (auth()->user()->ukm_id == 3) {
            $logo = 'assets/img/barracuda.png';
        }
    }
@endphp

<aside class="app-sidebar shadow"
       style="background: linear-gradient(180deg, #3d2c1e 0%, #2d1f15 100%); border-right: 1px solid rgba(212, 163, 115, 0.1);"
       data-bs-theme="dark">

    <div class="sidebar-brand"
         style="background: rgba(212, 163, 115, 0.08); border-bottom: 1px solid rgba(212, 163, 115, 0.1); padding: 15px 10px;">

        <a href="{{ route('admin-pengurus.dashboard') }}"
           class="brand-link"
           style="text-decoration:none; display:flex; align-items:center; gap:10px;">

            <img src="{{ asset($logo) }}"
                 alt="Logo"
                 class="brand-image shadow"
                 style="width:35px;height:40px;border-radius:50%; border:2px solid #d4a373; padding:2px; background:rgba(255,255,255,0.05);">

            <span class="brand-text"
                  style="color: #e9c46a; font-weight:700; letter-spacing:0.5px; font-size:1.05rem;">
                ADMIN PENGURUS
            </span>

        </a>

    </div>

    <div class="sidebar-wrapper">

        <nav class="mt-2">

            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ route('admin-pengurus.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin-pengurus.dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- KEGIATAN --}}
                <li class="nav-item">
                    <a href="{{ route('admin-pengurus.kegiatan') }}"
                       class="nav-link {{ request()->routeIs('admin-pengurus.kegiatan*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-calendar-event"></i>
                        <p>Kegiatan</p>
                    </a>
                </li>

                {{-- GALERI --}}
                <li class="nav-item">
                    <a href="{{ route('admin-pengurus.galeri') }}"
                       class="nav-link {{ request()->routeIs('admin-pengurus.galeri*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Galeri</p>
                    </a>
                </li>

                {{-- ANGGOTA (dengan dropdown) --}}
                <li class="nav-item {{ request()->routeIs('admin-pengurus.anggota*', 'admin-pengurus.calon-anggota*') ? 'menu-open' : '' }}">
                    <a href="#"
                       class="nav-link {{ request()->routeIs('admin-pengurus.anggota*', 'admin-pengurus.calon-anggota*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            Anggota
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin-pengurus.anggota') }}"
                               class="nav-link {{ request()->routeIs('admin-pengurus.anggota*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Data Anggota</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-pengurus.calon-anggota') }}"
                               class="nav-link {{ request()->routeIs('admin-pengurus.calon-anggota*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Calon Anggota</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- JADWAL --}}
                <li class="nav-item">
                    <a href="{{ route('admin-pengurus.jadwal') }}"
                       class="nav-link {{ request()->routeIs('admin-pengurus.jadwal*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clock"></i>
                        <p>Jadwal</p>
                    </a>
                </li>

                {{-- KONTAK --}}
                <li class="nav-item">
                    <a href="{{ route('admin-pengurus.kontak') }}"
                       class="nav-link {{ request()->routeIs('admin-pengurus.kontak*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-telephone"></i>
                        <p>Kontak</p>
                    </a>
                </li>

                {{-- DATA PENGURUS --}}
                <li class="nav-item">
                    <a href="{{ route('admin_pengurus.data_pengurus.index') }}"
                       class="nav-link {{ request()->routeIs('admin_pengurus.data_pengurus.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-badge-fill"></i>
                        <p>Data Pengurus</p>
                    </a>
                </li>
               

                {{-- LOGOUT --}}
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="nav-link border-0 bg-transparent w-100 text-start"
                                style="cursor:pointer;">
                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>

            </ul>

        </nav>

    </div>

</aside>

<!-- CSS TAMBAHAN (sama seperti sebelumnya) -->
<style>
    /* Warna dasar sidebar */
    .app-sidebar {
        background: linear-gradient(180deg, #3d2c1e 0%, #2d1f15 100%) !important;
        border-right: 1px solid rgba(212, 163, 115, 0.1) !important;
    }

    /* Brand area */
    .sidebar-brand {
        background: rgba(212, 163, 115, 0.08) !important;
        border-bottom: 1px solid rgba(212, 163, 115, 0.1) !important;
    }
    .brand-text {
        color: #e9c46a !important;
    }

    /* Semua nav link */
    .nav-link {
        color: #b8a89a !important;
        transition: all 0.3s ease !important;
    }
    .nav-link i {
        color: #b8a89a !important;
    }
    .nav-link p {
        color: #b8a89a !important;
    }

    /* Aktif */
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

    /* Hover */
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

    /* Submenu (treeview) – AdminLTE bawaan */
    .nav-treeview .nav-link {
        color: #b8a89a !important;
    }
    .nav-treeview .nav-link i {
        color: #d4a373 !important;
    }
    .nav-treeview .nav-link:hover {
        background: rgba(212, 163, 115, 0.06) !important;
        color: #e9c46a !important;
    }
    .nav-treeview .nav-link.active {
        background: rgba(212, 163, 115, 0.1) !important;
        color: #e9c46a !important;
    }
    .nav-treeview .nav-link.active p {
        color: #e9c46a !important;
    }

    /* Panah submenu */
    .nav-arrow {
        color: #b8a89a !important;
        transition: transform 0.3s ease;
    }
    .menu-open .nav-arrow {
        transform: rotate(90deg);
    }

    /* Tombol logout */
    .nav-item form .nav-link {
        color: #ef4444 !important;
    }
    .nav-item form .nav-link i {
        color: #ef4444 !important;
    }
    .nav-item form .nav-link:hover {
        background: rgba(220, 38, 38, 0.1) !important;
    }
</style>