

<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="card-title m-0">
                Data Galeri
            </h3>

            <a href="<?php echo e(route('admin-pengurus.galeri.create')); ?>"
               class="btn btn-primary btn-sm">
                + Tambah
            </a>

        </div>

        <div class="card-body">

            <div class="row">

                <?php $__empty_1 = true; $__currentLoopData = $galeri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <div class="col-md-3 mb-4">

                    <div class="card">

                        <img src="<?php echo e(asset('storage/' . $item->gambar)); ?>"
                            class="card-img-top"
                            style="height:200px; object-fit:cover;">

<div class="card-body">
    <h5><?php echo e($item->judul); ?></h5>
    
    <p class="text-muted" style="font-size: 0.9rem;"><?php echo e($item->deskripsi); ?></p>

    <a href="<?php echo e(route('admin-pengurus.galeri.edit', $item->id)); ?>"
       class="btn btn-warning btn-sm">
        Edit
    </a>

    <form action="<?php echo e(route('admin-pengurus.galeri.destroy', $item->id)); ?>"
          method="POST"
          style="display:inline-block;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button class="btn btn-danger btn-sm">
            Hapus
        </button>
    </form>
</div>
                    </div>

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <div class="col-12 text-center">
                    Belum ada galeri
                </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_pengurus.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PROJEK TA TARRY\ta-ukm\resources\views/admin_pengurus/galeri/index.blade.php ENDPATH**/ ?>