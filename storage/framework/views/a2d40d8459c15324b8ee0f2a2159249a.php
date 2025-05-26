

<?php $__env->startSection('content'); ?>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 fw-bold text-primary">Laporan Rincian Barang Persediaan</h5>
                <small class="text-muted">Periode: <?php echo e($start->format('d-m-Y')); ?> s/d <?php echo e($end->format('d-m-Y')); ?></small>
            </div>
            <div class="d-flex">
                <form method="GET" action="<?php echo e(route('laporan.rincian')); ?>" class="d-flex align-items-center me-2">
                    <div class="input-group input-group-sm">
                        <input type="date" name="start" id="start" class="form-control"
                            value="<?php echo e(request('start', $start->format('Y-m-d'))); ?>">
                        <span class="input-group-text bg-light">s/d</span>
                        <input type="date" name="end" id="end" class="form-control"
                            value="<?php echo e(request('end', $end->format('Y-m-d'))); ?>">
                        <button type="submit" class="btn btn-primary px-3">
                            Filter
                        </button>
                    </div>
                </form>
                <div>
                    <a href="<?php echo e(route('laporan.rincian.export', ['start' => request('start', $start->format('Y-m-d')), 'end' => request('end', $end->format('Y-m-d'))])); ?>"
                        class="btn btn-sm btn-success me-1">
                        Export PDF
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive" id="report-container">
                <table class="table table-bordered table-hover table-sm mb-0">
                    <thead>
                        <tr class="text-center bg-light">
                            <th rowspan="2" class="align-middle border-end">KODE</th>
                            <th rowspan="2" class="align-middle border-end">URAIAN</th>
                            <th colspan="2" class="border-bottom border-end">S/D <?php echo e($start->format('d-m-Y')); ?></th>
                            <th colspan="2" class="border-bottom border-end">MUTASI</th>
                            <th colspan="2" class="border-bottom">S/D <?php echo e($end->format('d-m-Y')); ?></th>
                        </tr>
                        <tr class="text-center bg-light">
                            <th class="border-end">JUMLAH</th>
                            <th class="border-end">RUPIAH</th>
                            <th class="border-end">MASUK</th>
                            <th class="border-end">KELUAR</th>
                            <th class="border-end">JUMLAH</th>
                            <th>RUPIAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $grandTotalAwal = $grandTotalMasuk = $grandTotalKeluar = $grandTotalAkhir = 0;
                            $grandRupiahAwal = $grandRupiahAkhir = 0;
                        ?>

                        <?php $__currentLoopData = $groupedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <tr class="bg-primary bg-opacity-10">
                                <td colspan="8" class="fw-bold py-2"><?php echo e(strtoupper($kategori)); ?></td>
                            </tr>

                            <?php
                                $totalAwal = $totalMasuk = $totalKeluar = $totalAkhir = 0;
                                $rupiahAwal = $rupiahAkhir = 0;
                            ?>

                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($row['kode']); ?></td>
                                    <td><?php echo e($row['nama']); ?></td>
                                    <td class="text-end"><?php echo e($row['saldo_awal_jumlah']); ?></td>
                                    <td class="text-end"><?php echo e(number_format($row['nilai_awal'], 0, ',', '.')); ?></td>
                                    <td class="text-end"><?php echo e($row['masuk']); ?></td>
                                    <td class="text-end"><?php echo e($row['keluar']); ?></td>
                                    <td class="text-end"><?php echo e($row['saldo_akhir_jumlah']); ?></td>
                                    <td class="text-end"><?php echo e(number_format($row['nilai_akhir'], 0, ',', '.')); ?></td>
                                </tr>
                                <?php
                                    $totalAwal += $row['saldo_awal_jumlah'];
                                    $rupiahAwal += $row['nilai_awal'];
                                    $totalMasuk += $row['masuk'];
                                    $totalKeluar += $row['keluar'];
                                    $totalAkhir += $row['saldo_akhir_jumlah'];
                                    $rupiahAkhir += $row['nilai_akhir'];

                                    $grandTotalAwal += $row['saldo_awal_jumlah'];
                                    $grandRupiahAwal += $row['nilai_awal'];
                                    $grandTotalMasuk += $row['masuk'];
                                    $grandTotalKeluar += $row['keluar'];
                                    $grandTotalAkhir += $row['saldo_akhir_jumlah'];
                                    $grandRupiahAkhir += $row['nilai_akhir'];
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            
                            <tr class="bg-light fw-bold">
                                <td colspan="2" class="text-end">TOTAL <?php echo e(strtoupper($kategori)); ?></td>
                                <td class="text-end"><?php echo e($totalAwal); ?></td>
                                <td class="text-end"><?php echo e(number_format($rupiahAwal, 0, ',', '.')); ?></td>
                                <td class="text-end"><?php echo e($totalMasuk); ?></td>
                                <td class="text-end"><?php echo e($totalKeluar); ?></td>
                                <td class="text-end"><?php echo e($totalAkhir); ?></td>
                                <td class="text-end"><?php echo e(number_format($rupiahAkhir, 0, ',', '.')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <tr class="bg-secondary bg-opacity-10 fw-bold">
                            <td colspan="2" class="text-end">GRAND TOTAL</td>
                            <td class="text-end"><?php echo e($grandTotalAwal); ?></td>
                            <td class="text-end"><?php echo e(number_format($grandRupiahAwal, 0, ',', '.')); ?></td>
                            <td class="text-end"><?php echo e($grandTotalMasuk); ?></td>
                            <td class="text-end"><?php echo e($grandTotalKeluar); ?></td>
                            <td class="text-end"><?php echo e($grandTotalAkhir); ?></td>
                            <td class="text-end"><?php echo e(number_format($grandRupiahAkhir, 0, ',', '.')); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\JIHAN DOC\Project Portofolio\atk-management\resources\views/laporan/rincian_barang.blade.php ENDPATH**/ ?>