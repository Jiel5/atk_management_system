

<?php $__env->startSection('content'); ?>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-primary">Daftar Pengguna</h5>
            <a href="<?php echo e(route('pengguna.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Tambah Pengguna
            </a>
        </div>
        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table id="usersTable" class="table table-bordered table-hover" style="width:100%; color: #333;">
                    <thead class="table-light" style="color: #212529; font-weight: 600;">
                        <tr>
                            <th class="text-nowrap">Nama</th>
                            <th class="text-nowrap">Username</th>
                            <th class="text-nowrap">NIP</th>
                            <th class="text-nowrap">Nomor HP</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Jabatan</th>
                            <th class="text-nowrap">Role</th>
                            <th class="text-nowrap text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-nowrap"><?php echo e($u->nama); ?></td>
                                <td class="text-nowrap"><?php echo e($u->username); ?></td>
                                <td class="text-nowrap"><?php echo e($u->nip); ?></td>
                                <td class="text-nowrap"><?php echo e($u->no_hp); ?></td>
                                <td class="text-nowrap"><?php echo e($u->email); ?></td>
                                <td class="text-nowrap"><?php echo e($u->jabatan); ?></td>
                                <td class="text-nowrap">
                                    <?php if($u->role == 'bendahara'): ?>
                                        <span class="badge bg-info">Bendahara</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">User</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-nowrap text-center">
                                    <a href="<?php echo e(route('pengguna.edit', $u->id)); ?>" class="btn btn-warning btn-sm me-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?php echo e($u->id); ?>">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="deleteModal<?php echo e($u->id); ?>" tabindex="-1"
                                        aria-labelledby="deleteModalLabel<?php echo e($u->id); ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel<?php echo e($u->id); ?>">Konfirmasi Hapus
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus pengguna
                                                        <strong><?php echo e($u->nama); ?></strong>?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="<?php echo e(route('pengguna.destroy', $u->id)); ?>" method="POST"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle me-1"></i> Tidak ada data pengguna.
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                },
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                columnDefs: [
                    { orderable: false, targets: 7 }
                ]
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\JIHAN DOC\Project Portofolio\atk-management\resources\views/pengguna/index.blade.php ENDPATH**/ ?>