<!DOCTYPE html>
<html lang="en">

<head>

    <?php echo $__env->make('admin_pengurus.partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    
    <?php echo $__env->make('admin_pengurus.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('admin_pengurus.partials.sidebar_admin_pengurus', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main class="app-main">

        
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
                            <?php echo e(auth()->user()->name); ?>

                        </small>

                    </div>

                </div>

            </div>

        </div>

        
        <div class="app-content">

            <div class="container-fluid py-3">

                <?php echo $__env->yieldContent('content'); ?>

            </div>

        </div>

    </main>

    
    <?php echo $__env->make('admin_pengurus.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/js/adminlte.min.js"></script>

</body>
</html><?php /**PATH D:\PROJEK TA TARRY\ta-ukm\resources\views/admin_pengurus/layouts/main.blade.php ENDPATH**/ ?>