<!DOCTYPE html>
<html lang="en">

<head>

    @include('admin_pengurus.partials.head')

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    {{-- NAVBAR --}}
    @include('admin_pengurus.partials.navbar')

    {{-- SIDEBAR --}}
    @include('admin_pengurus.partials.sidebar_admin_pengurus')

    {{-- CONTENT --}}
    <main class="app-main">

        {{-- HEADER --}}
        <div class="app-content-header">

            <div class="container-fluid">

                <div class="row mb-3">

                    <div class="col-sm-6">
                        <h3 class="mb-0">
                            Dashboard Admin Pengurus
                        </h3>
                    </div>

                    <div class="col-sm-6 text-end">

                        <small class="text-muted">
                            Selamat datang,
                            {{ auth()->user()->name }}
                        </small>

                    </div>

                </div>

            </div>

        </div>

        {{-- BODY --}}
        <div class="app-content">

            <div class="container-fluid py-3">

                @yield('content')

            </div>

        </div>

    </main>

    {{-- FOOTER --}}
    @include('admin_pengurus.partials.footer')

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/js/adminlte.min.js"></script>

</body>
</html>