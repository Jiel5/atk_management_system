

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header"><strong>Edit Satuan</strong></div>
        <div class="card-body">
            <form action="<?php echo e(route('satuan.update', $satuan->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label>Nama Satuan</label>
                    <input type="text" name="nama_satuan" value="<?php echo e($satuan->nama_satuan); ?>" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo e(route('satuan.index')); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\JIHAN DOC\Project Portofolio\atk-management\resources\views/satuan/edit.blade.php ENDPATH**/ ?>