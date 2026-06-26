<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Super Admin - FMIPA USK')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #fdf8f2;
            overflow-x: hidden;
        }

        /* ==========================================
           HIDE DEFAULT ADMINLTE ELEMENTS
        ========================================== */
        /* Sembunyikan header default AdminLTE */
        .app-header,
        .main-header,
        .navbar,
        .navbar-expand {
            display: none !important;
        }

        /* Sembunyikan footer default AdminLTE */
        .app-footer,
        .main-footer {
            display: none !important;
        }

        /* Sembunyikan sidebar default AdminLTE */
        .app-sidebar-default,
        .main-sidebar {
            display: none !important;
        }

        /* Sembunyikan user panel di sidebar */
        .user-panel,
        .user-image,
        .user-info,
        .sidebar-user {
            display: none !important;
        }

        /* Sembunyikan elemen kosong */
        .content-wrapper {
            background: transparent !important;
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .app-wrapper {
            background: transparent !important;
        }

        .app-main {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .app-content {
            padding: 0 !important;
        }

        /* ==========================================
           MAIN CONTENT
        ========================================== */
        .main-content {
            margin-left: 250px;
            padding: 20px 30px;
            min-height: 100vh;
            background: #fdf8f2;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
        }

        /* ==========================================
           SIDEBAR CUSTOM
        ========================================== */
        .app-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #3d2c1e 0%, #2d1f15 100%);
            border-right: 1px solid rgba(212, 163, 115, 0.1);
            z-index: 1030;
            overflow-y: auto;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding-bottom: 60px;
        }

        .app-sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .app-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
        }

        .app-sidebar::-webkit-scrollbar-thumb {
            background: rgba(212, 163, 115, 0.3);
            border-radius: 4px;
        }

        .app-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(212, 163, 115, 0.5);
        }

        /* ==========================================
           SIDEBAR TOGGLE BUTTON
        ========================================== */
        .sidebar-toggle-custom {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1040;
            background: rgba(61, 44, 30, 0.9);
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            color: #f5ede6;
            font-size: 1.5rem;
            cursor: pointer;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .sidebar-toggle-custom:hover {
            background: rgba(61, 44, 30, 1);
            transform: scale(1.05);
        }

        @media (max-width: 991.98px) {
            .sidebar-toggle-custom {
                display: block;
            }

            .app-sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .app-sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1029;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        /* ==========================================
           SIDEBAR BRAND
        ========================================== */
        .sidebar-brand {
            background: rgba(212, 163, 115, 0.08);
            border-bottom: 1px solid rgba(212, 163, 115, 0.1);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-brand .brand-link {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand .brand-image {
            border: 2px solid #d4a373;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            object-fit: contain;
            padding: 4px;
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-brand .brand-text {
            color: #e9c46a;
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 1.1rem;
        }

        /* ==========================================
           SIDEBAR NAVIGATION
        ========================================== */
        .sidebar-wrapper {
            padding: 8px 0;
        }

        .sidebar-wrapper .nav-link {
            color: #b8a89a;
            padding: 10px 16px;
            border-radius: 8px;
            margin: 2px 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            position: relative;
        }

        .sidebar-wrapper .nav-link i {
            color: #b8a89a;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .sidebar-wrapper .nav-link p {
            color: #b8a89a;
            margin: 0;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .sidebar-wrapper .nav-link.active {
            background: rgba(212, 163, 115, 0.12);
            color: #e9c46a;
        }

        .sidebar-wrapper .nav-link.active i {
            color: #e9c46a;
        }

        .sidebar-wrapper .nav-link.active p {
            color: #f5ede6;
        }

        .sidebar-wrapper .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: linear-gradient(135deg, #d4a373, #e9c46a);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-wrapper .nav-link:not(.active):hover {
            background: rgba(212, 163, 115, 0.08);
            color: #f5ede6;
        }

        .sidebar-wrapper .nav-link:not(.active):hover i {
            color: #e9c46a;
        }

        .sidebar-wrapper .nav-link:not(.active):hover p {
            color: #f5ede6;
        }

        /* ==========================================
           TREEVIEW / SUBMENU
        ========================================== */
        .nav-treeview {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            margin: 0 12px;
            padding: 4px 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .nav-item.menu-open .nav-treeview {
            max-height: 500px;
        }

        .nav-treeview .nav-link {
            padding: 8px 16px 8px 35px !important;
            margin: 1px 4px !important;
            border-radius: 6px !important;
            color: #b8a89a !important;
        }

        .nav-treeview .nav-link i {
            font-size: 6px !important;
            color: #d4a373 !important;
            width: 16px !important;
        }

        .nav-treeview .nav-link p {
            color: #b8a89a !important;
            font-size: 0.9rem !important;
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

        .nav-arrow {
            transition: transform 0.3s ease !important;
            margin-left: auto !important;
            color: #b8a89a !important;
        }

        .nav-item.menu-open .nav-arrow {
            transform: rotate(90deg) !important;
        }

        /* ==========================================
           NAV HEADER
        ========================================== */
        .nav-header {
            color: #d4a373;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 0.75rem;
            padding: 12px 16px 8px;
            margin-top: 8px;
            border-top: 1px solid rgba(212, 163, 115, 0.08);
            text-transform: uppercase;
        }

        /* ==========================================
           LOGOUT BUTTON
        ========================================== */
        .logout-btn {
            background: rgba(220, 38, 38, 0.08);
            border: 1px solid rgba(220, 38, 38, 0.15);
            border-radius: 8px;
            margin: 4px 8px;
            width: calc(100% - 16px);
            text-align: left;
            color: #ef4444;
            transition: all 0.3s ease;
            padding: 10px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logout-btn:hover {
            background: rgba(220, 38, 38, 0.15);
            border-color: rgba(220, 38, 38, 0.3);
        }

        .logout-btn i {
            color: #ef4444;
            font-size: 1.1rem;
        }

        .logout-btn span {
            color: #ef4444;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* ==========================================
           SIDEBAR FOOTER
        ========================================== */
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 12px 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            text-align: center;
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.2);
        }

        /* ==========================================
           ALERT AUTO CLOSE
        ========================================== */
        .alert-dismissible {
            transition: opacity 0.5s ease;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- ========================================== -->
    <!-- SIDEBAR OVERLAY (MOBILE) -->
    <!-- ========================================== -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- ========================================== -->
    <!-- SIDEBAR TOGGLE BUTTON (MOBILE) -->
    <!-- ========================================== -->
    <button class="sidebar-toggle-custom" id="sidebarToggleBtn" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <!-- ========================================== -->
    <!-- SIDEBAR -->
    <!-- ========================================== -->
    @include('admin.partials.sidebar')

    <!-- ========================================== -->
    <!-- MAIN CONTENT -->
    <!-- ========================================== -->
    <div class="main-content" id="mainContent">
        @yield('content')
    </div>

    <!-- ========================================== -->
    <!-- SCRIPTS -->
    <!-- ========================================== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // ==========================================
        // SIDEBAR TOGGLE FUNCTION
        // ==========================================
        function toggleSidebar() {
            const sidebar = document.querySelector('.app-sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar) {
                sidebar.classList.toggle('show');
                if (overlay) {
                    overlay.classList.toggle('show');
                }
                // Simpan state
                const isOpen = sidebar.classList.contains('show');
                localStorage.setItem('sidebarState', isOpen ? 'open' : 'closed');
            }
        }

        // ==========================================
        // RESTORE SIDEBAR STATE
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarState = localStorage.getItem('sidebarState');
            const sidebar = document.querySelector('.app-sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth < 992 && sidebarState === 'open') {
                sidebar.classList.add('show');
                if (overlay) {
                    overlay.classList.add('show');
                }
            }

            // Close sidebar on resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('show');
                    if (overlay) {
                        overlay.classList.remove('show');
                    }
                }
            });

            // Close sidebar on outside click (mobile)
            document.addEventListener('click', function(e) {
                const toggleBtn = document.getElementById('sidebarToggleBtn');
                if (window.innerWidth < 992 && sidebar && toggleBtn) {
                    if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                        sidebar.classList.remove('show');
                        if (overlay) {
                            overlay.classList.remove('show');
                        }
                        localStorage.setItem('sidebarState', 'closed');
                    }
                }
            });

            // Keyboard shortcut: Alt + S
            document.addEventListener('keydown', function(e) {
                if (e.altKey && e.key === 's') {
                    e.preventDefault();
                    toggleSidebar();
                }
            });

            // ==========================================
            // TREEVIEW TOGGLE
            // ==========================================
            document.querySelectorAll('.app-sidebar .nav-item').forEach(item => {
                const link = item.querySelector('.nav-link');
                if (link && link.getAttribute('href') === '#') {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        this.closest('.nav-item').classList.toggle('menu-open');
                    });
                }
            });

            // ==========================================
            // AUTO CLOSE ALERT
            // ==========================================
            document.querySelectorAll('.alert-dismissible').forEach(alert => {
                setTimeout(function() {
                    alert.classList.remove('show');
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 300);
                }, 5000);
            });
        });

        // ==========================================
        // PREVENT DEFAULT FOR EMPTY LINKS
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href="#"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>