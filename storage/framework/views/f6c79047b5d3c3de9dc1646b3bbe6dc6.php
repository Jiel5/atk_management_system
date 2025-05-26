
<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success rounded-3 p-3 me-3"
                            style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-boxes text-white fs-4"></i>
                        </div>
                        <div>
                            <h3 class="mb-1 fw-bold text-dark">Stok ATK</h3>
                            <p class="text-muted mb-0">Kelola dan pantau ketersediaan alat tulis kantor</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                            <i class="fas fa-cube me-1"></i>
                            Total: <?php echo e($stok->count()); ?> Item
                        </span>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body py-3">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label for="kategoriFilter" class="form-label small text-muted mb-1">Filter Kategori</label>
                                <select id="kategoriFilter" class="form-select form-select-sm">
                                    <option value="">Semua Kategori</option>
                                    <?php $__currentLoopData = $stok->pluck('atk.kategori')->filter()->unique('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kategori->nama_kategori); ?>"><?php echo e($kategori->nama_kategori); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="stokFilter" class="form-label small text-muted mb-1">Filter Stok</label>
                                <select id="stokFilter" class="form-select form-select-sm">
                                    <option value="">Semua Stok</option>
                                    <option value="Banyak">Banyak (>50)</option>
                                    <option value="Sedang">Sedang (21-50)</option>
                                    <option value="Sedikit">Sedikit (≤20)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="satuanFilter" class="form-label small text-muted mb-1">Filter Satuan</label>
                                <select id="satuanFilter" class="form-select form-select-sm">
                                    <option value="">Semua Satuan</option>
                                    <?php $__currentLoopData = $stok->pluck('satuan')->unique('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $satuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($satuan->nama_satuan); ?>"><?php echo e($satuan->nama_satuan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 text-end">
                                <small class="text-muted">
                                    Total: <span class="fw-semibold"><?php echo e($stok->count()); ?></span> item
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-4 py-3">
                        <!-- Table Header -->
                        <div class="bg-light px-4 py-3 border-bottom">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-table text-primary me-2"></i>
                                        <h6 class="mb-0 fw-semibold">Data Stok ATK</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        Diperbarui: <?php echo e(now()->format('d M Y, H:i')); ?>

                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Table Container -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="stoktable">
                                <thead class="bg-primary bg-opacity-10">
                                    <tr>
                                        <th class="border-0 py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <span class="fw-semibold text-dark">No</span>
                                            </div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-tag text-primary me-2"></i>
                                                <span class="fw-semibold text-dark">Nama ATK</span>
                                            </div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-folder text-primary me-2"></i>
                                                <span class="fw-semibold text-dark">Kategori</span>
                                            </div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calculator text-primary me-2"></i>
                                                <span class="fw-semibold text-dark">Jumlah</span>
                                            </div>
                                        </th>
                                        <th class="border-0 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-balance-scale text-primary me-2"></i>
                                                <span class="fw-semibold text-dark">Satuan</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $stok; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="border-bottom border-light">
                                            <td class="py-3 px-4">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width: 32px; height: 32px;">
                                                    <small class="fw-semibold text-primary"><?php echo e($index + 1); ?></small>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-info bg-opacity-10 rounded-2 p-2 me-3">
                                                        <i class="fas fa-pencil-alt text-info" style="font-size: 0.875rem;"></i>
                                                    </div>
                                                    <div>
                                                        <span class="fw-medium text-dark"><?php echo e($item->atk->nama_atk); ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <?php if($item->atk->kategori): ?>
                                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">
                                                        <?php echo e($item->atk->kategori->nama_kategori); ?>

                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-muted fst-italic">
                                                        <i class="fas fa-minus-circle me-1"></i>Tidak ada kategori
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <?php
                                                        $stockLevel = '';
                                                        $stockColor = '';
                                                        if ($item->total_stok > 50) {
                                                            $stockLevel = 'Banyak';
                                                            $stockColor = 'success';
                                                        } elseif ($item->total_stok > 20) {
                                                            $stockLevel = 'Sedang';
                                                            $stockColor = 'warning';
                                                        } else {
                                                            $stockLevel = 'Sedikit';
                                                            $stockColor = 'danger';
                                                        }
                                                    ?>
                                                    <span class="fw-bold text-dark me-2"><?php echo e($item->total_stok); ?></span>
                                                    <span
                                                        class="badge bg-<?php echo e($stockColor); ?>-subtle text-<?php echo e($stockColor); ?> px-2 py-1 rounded-pill">
                                                        <i class="fas fa-circle" style="font-size: 0.5rem;"></i>
                                                        <small><?php echo e($stockLevel); ?></small>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <span class="bg-light px-3 py-2 rounded-pill text-dark fw-medium">
                                                    <?php echo e($item->satuan->nama_satuan); ?>

                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center justify-content-center">
                                                    <div class="bg-light rounded-circle p-4 mb-3">
                                                        <i class="fas fa-inbox text-muted fs-2"></i>
                                                    </div>
                                                    <h6 class="text-muted mb-2">Data Stok Kosong</h6>
                                                    <small class="text-muted">Belum ada data stok ATK yang tersedia</small>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Footer Info -->
                <?php if($stok->count() > 0): ?>
                    <div class="row mt-4">
                        <?php
                            $totalStock = $stok->sum('total_stok');
                            $lowStock = $stok->where('total_stok', '<=', 20)->count();
                            $categories = $stok->pluck('atk.kategori.nama_kategori')->filter()->unique()->count();
                        ?>
                        <div class="col-md-4">
                            <div class="card border-0 bg-primary bg-opacity-10 h-100">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-cubes text-primary fs-2 mb-3"></i>
                                    <h4 class="fw-bold text-primary mb-1"><?php echo e($totalStock); ?></h4>
                                    <small class="text-muted">Total Stok</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-warning bg-opacity-10 h-100">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-exclamation-triangle text-warning fs-2 mb-3"></i>
                                    <h4 class="fw-bold text-warning mb-1"><?php echo e($lowStock); ?></h4>
                                    <small class="text-muted">Stok Rendah</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-info bg-opacity-10 h-100">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-tags text-info fs-2 mb-3"></i>
                                    <h4 class="fw-bold text-info mb-1"><?php echo e($categories); ?></h4>
                                    <small class="text-muted">Kategori</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {
            let table = $('#stoktable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                },
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                columnDefs: [
                    { orderable: false, targets: 0 } // Kolom nomor tidak bisa diurutkan
                ],
                dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
            });

            // Filter berdasarkan kategori
            $('#kategoriFilter').on('change', function () {
                const val = $(this).val();
                table.column(2).search(val).draw(); // Kolom kategori (index 2)
            });

            // Filter berdasarkan level stok
            $('#stokFilter').on('change', function () {
                const val = $(this).val();
                table.column(3).search(val).draw(); // Kolom jumlah (index 3)
            });

            // Filter berdasarkan satuan
            $('#satuanFilter').on('change', function () {
                const val = $(this).val();
                table.column(4).search(val).draw(); // Kolom satuan (index 4)
            });
        });
    </script>

    <style>
        /* Padding DataTables */
        .dataTables_wrapper {
            padding-top: 1rem;
        }

        /* Tabel bisa discroll horizontal jika overflow */
        .table-responsive {
            overflow-x: auto;
            border: none;
        }

        /* Jarak antar komponen DataTables */
        .dataTables_wrapper .row {
            margin-bottom: 0.75rem;
        }

        /* Responsif sederhana untuk layar kecil */
        @media (max-width: 768px) {

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                margin-bottom: 1rem;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\JIHAN DOC\Project Portofolio\atk-management\resources\views/stok/index.blade.php ENDPATH**/ ?>