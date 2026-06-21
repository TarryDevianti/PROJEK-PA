@php
    // Default (UKM Seramoe - Cokelat hangat)
    $sidebarColor = '#6B4E24'; 
    $headerColor = '#523C1B';
    $logo = 'assets/img/seuramoe.png';

    if(auth()->check()){
        // UKM Ulul Albab (Hijau Forest yang teduh)
        if(auth()->user()->ukm_id == 2){
            $sidebarColor = '#065F46'; // Hijau gelap (emerald)
            $headerColor = '#EA580C'; // Lebih gelap untuk header
            $logo = 'assets/img/ululalbab.png';
        }
        // UKM Barracuda (Tema Hitam/Abu-abu gelap yang elegan)
        elseif(auth()->user()->ukm_id == 3){
            $sidebarColor = '#1F2937'; // Abu-abu sangat gelap (hampir hitam)
            $headerColor = '#111827'; // Hitam pekat untuk header
            $logo = 'assets/img/barracuda.png';
        }
    }
@endphp

<aside class="app-sidebar shadow"
       style="background-color: {{ $sidebarColor }};"
       data-bs-theme="dark">

<div class="sidebar-brand"
     style="background-color: {{ $headerColor }}; padding: 15px 10px;">

    <a href="{{ route('admin-pengurus.dashboard') }}"
       class="brand-link"
       style="text-decoration:none;color:#FFFFFF;display:flex;align-items:center;">

        <img src="{{ asset($logo) }}"
             alt="Logo"
             class="brand-image shadow"
             style="width:35px;height:40px;margin-right:5px;border-radius:50%;">

        <span class="brand-text"
              style="font-size:1 rem;font-weight:400;letter-spacing:0.5px;">
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

            {{-- ANGGOTA --}}
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

            {{-- LOGOUT --}}
            <li class="nav-item">

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit"
                            class="nav-link border-0 bg-transparent w-100 text-start">

                        <i class="nav-icon bi bi-box-arrow-right"></i>

                        <p>Logout</p>

                    </button>

                </form>

            </li>

        </ul>

    </nav>

</div>

</aside>