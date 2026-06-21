<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
<div class="sidebar-brand">
    <a href="#" class="brand-link">
        <img src="{{ asset('adminlte/dist/assets/img/AdminLTELogo.png') }}"
             alt="AdminLTE Logo"
             class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">Super Admin</span>
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
                  <a href="{{ route('dashboard.super.admin') }}"
                    class="nav-link {{ request()->routeIs('dashboard.super.admin') ? 'active' : '' }}">

                      <i class="nav-icon bi bi-speedometer2"></i>
                      <p>Dashboard</p>

                  </a>
              </li>

            {{-- DATA PENGURUS --}}
            <li class="nav-item">
                <a href="{{ route('pengurus.admin') }}"
                   class="nav-link {{ request()->is('admin/pengurus*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-person-badge-fill"></i>
                    <p>Data Pengurus UKM</p>
                </a>
            </li>

            {{-- DATA PENDAFTARAN --}}
            <li class="nav-item">
                <a href="{{ route('pendaftaran.admin') }}"
                   class="nav-link {{ request()->is('admin/pendaftaran*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-people-fill"></i>
                    <p>Data Pendaftaran</p>
                </a>
            </li>

           {{-- UKM SEURAMOE --}}
<li class="nav-item {{ request()->is('admin/ukm/1/*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('admin/ukm/1/*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-clipboard-fill"></i>
        <p>
            UKM SEURAMOE
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('kegiatan.ukm', ['slug' => 'ukm-seramoe']) }}"
               class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Kegiatan</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.ukm.anggota', ['ukm_id' => 1]) }}"
               class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Data Anggota</p>
            </a>
        </li>

    </ul>
</li>

            {{-- UKM BARRACUDA --}}
<li class="nav-item {{ request()->is('admin/ukm/3/*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('admin/ukm/3/*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-clipboard-fill"></i>
        <p>
            UKM BARRACUDA
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('kegiatan.ukm', ['slug' => 'ukm-barracuda']) }}"
               class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Kegiatan</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.ukm.anggota', ['ukm_id' => 3]) }}"
               class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Data Anggota</p>
            </a>
        </li>

    </ul>
</li>

            {{-- UKM LDF ULUL ALBAB --}}
<li class="nav-item {{ request()->is('admin/ukm/2/*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('admin/ukm/2/*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-clipboard-fill"></i>
        <p>
            UKM LDF ULUL ALBAB
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('kegiatan.ukm', ['slug' => 'ukm-ldf-ulul-albab']) }}"
               class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Kegiatan</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.ukm.anggota', ['ukm_id' => 2]) }}"
               class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Data Anggota</p>
            </a>
        </li>

    </ul>
</li>

            {{-- MANAJEMEN --}}
            <li class="nav-header border-top mt-2 pt-2 text-uppercase">
                Manajemen
            </li>

            <li class="nav-item">
                <a href="{{ url('/admin/manajemen-ukm') }}"
                   class="nav-link {{ request()->is('admin/manajemen-ukm*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-kanban"></i>
                    <p>Manajemen UKM</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('manajemen-akun.index') }}"
                   class="nav-link {{ request()->is('admin/manajemen-akun*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-person-gear"></i>
                    <p>Manajemen Akun</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('pusat-bantuan.index') }}"
                   class="nav-link {{ request()->is('admin/pusat-bantuan*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-question-circle-fill"></i>
                    <p>Pusat Bantuan</p>
                </a>
            </li>

            {{-- LOGOUT --}}
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                            class="nav-link"
                            style="background:none;border:none;width:100%;text-align:left;color:red;">

                        <i class="bi bi-box-arrow-right"></i>

                        <span style="margin-left:10px;">
                            Logout
                        </span>

                    </button>
                </form>
            </li>

        </ul>

    </nav>
</div>
</aside>