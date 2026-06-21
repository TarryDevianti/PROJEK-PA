<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    {{-- NAVBAR --}}
    @include('admin.partials.navbar')
   
    {{-- CONTENT --}}
    <main class="app-main">

        <div class="app-content">

            <div class="container-fluid py-3">

                @yield('content')

            </div>

        </div>

    </main>

    {{-- FOOTER --}}
    @include('admin.partials.footer')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@adminlte/adminlte@4.0.0-beta1/dist/js/adminlte.min.js"></script>

</body>
</html>