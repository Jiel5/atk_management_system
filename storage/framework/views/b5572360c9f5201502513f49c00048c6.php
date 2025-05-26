

<?php $__env->startSection('content'); ?>
    <style>
        /* Tambahan spacing jika butuh padding atas */
        @media (min-width: 768px) {
            .content-wrapper {
                padding-top: 20px;
            }
        }

        .modern-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .modern-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .gradient-primary-modern {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .gradient-success-modern {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .gradient-danger-modern {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .financial-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .financial-card.income {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }

        .financial-card.expense {
            background: linear-gradient(135deg, #ff6b6b, #feca57);
        }

        .balance-card {
            background: linear-gradient(135deg, #4834d4, #686de0);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(6px);
        }

        .number-display {
            font-size: 2rem;
            font-weight: 700;
        }

        .card-title-modern {
            font-size: 0.85rem;
            font-weight: 500;
            opacity: 0.9;
        }

        .page-header-modern {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 2rem;
            border-radius: 20px;
            margin-bottom: 2rem;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideInUp 0.6s ease-out both;
        }

        .animate-delay-1 {
            animation-delay: 0.1s;
        }

        .animate-delay-2 {
            animation-delay: 0.2s;
        }

        .animate-delay-3 {
            animation-delay: 0.3s;
        }

        .animate-delay-4 {
            animation-delay: 0.4s;
        }

        .animate-delay-5 {
            animation-delay: 0.5s;
        }

        .animate-delay-6 {
            animation-delay: 0.6s;
        }

        /* Hapus styling global ini karena bisa bentrok dengan layout template */
        /* .container-fluid, .main-panel { padding-top: 0 !important; margin-top: 0 !important; } */
    </style>


    <!-- Header -->
    <div class="page-header-modern">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-2" style="font-size: 1.8rem; font-weight: 600;">
                    <i class="mdi mdi-account-cash me-2"></i>
                    Dashboard Bendahara
                </h3>
                <p class="mb-0 opacity-75">Kelola keuangan dan pantau permintaan ATK dengan mudah dan efisien.</p>
            </div>
            <div class="bg-white bg-opacity-10 rounded px-3 py-2 backdrop-blur">
                <span class="small">
                    <i class="mdi mdi-calendar me-1"></i>
                    Tahun <?php echo e($year); ?>

                </span>
            </div>
        </div>
    </div>

    <!-- Baris 1 -->
    <div class="row mb-3">
        <!-- Total Permintaan -->
        <div class="col-md-4 animate-slide-up animate-delay-1">
            <div class="card modern-card gradient-primary-modern text-white h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title-modern">Total Permintaan</h6>
                            <div class="number-display"><?php echo e($total); ?></div>
                            <small><i class="mdi mdi-trending-up me-1"></i> Semua permintaan ATK</small>
                        </div>
                        <div class="stat-icon">
                            <i class="mdi mdi-file-document-multiple mdi-18px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Disetujui -->
        <div class="col-md-4 animate-slide-up animate-delay-2">
            <div class="card modern-card gradient-success-modern text-white h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title-modern">Disetujui</h6>
                            <div class="number-display"><?php echo e($disetujui); ?></div>
                            <small><i class="mdi mdi-check-circle me-1"></i> Permintaan disetujui</small>
                        </div>
                        <div class="stat-icon">
                            <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ditolak -->
        <div class="col-md-4 animate-slide-up animate-delay-3">
            <div class="card modern-card gradient-danger-modern text-white h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title-modern">Ditolak</h6>
                            <div class="number-display"><?php echo e($ditolak); ?></div>
                            <small><i class="mdi mdi-close-circle me-1"></i> Permintaan ditolak</small>
                        </div>
                        <div class="stat-icon">
                            <i class="mdi mdi-close-circle-outline mdi-18px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Baris 2 -->
    <div class="row">
        <!-- Pemasukan -->
        <div class="col-md-4 animate-slide-up animate-delay-4">
            <div class="card modern-card financial-card income text-white h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title-modern">Total Pemasukan</h6>
                            <div class="number-display">Rp <?php echo e(number_format($totalPemasukan, 0, ',', '.')); ?></div>
                            <small><i class="mdi mdi-trending-up me-1"></i> Dana masuk tahun <?php echo e($year); ?></small>
                        </div>
                        <div class="stat-icon">
                            <i class="mdi mdi-cash-plus mdi-18px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div class="col-md-4 animate-slide-up animate-delay-5">
            <div class="card modern-card financial-card expense text-white h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title-modern">Total Pengeluaran</h6>
                            <div class="number-display">Rp <?php echo e(number_format($totalPengeluaran, 0, ',', '.')); ?></div>
                            <small><i class="mdi mdi-trending-down me-1"></i> Dana keluar tahun <?php echo e($year); ?></small>
                        </div>
                        <div class="stat-icon">
                            <i class="mdi mdi-cash-minus mdi-18px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Saldo -->
        <div class="col-md-4 animate-slide-up animate-delay-6">
            <div class="card modern-card balance-card text-white h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title-modern">Saldo Akhir</h6>
                            <div class="number-display">
                                Rp <?php echo e(number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.')); ?>

                            </div>
                            <small><i class="mdi mdi-wallet-outline me-1"></i> Saldo tahun <?php echo e($year); ?></small>
                        </div>
                        <div class="stat-icon">
                            <i class="mdi mdi-wallet mdi-18px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Chart Section -->
    <div class="row mt-4">
        <div class="col-12 animate-slide-up animate-delay-4">
            <div class="card chart-card">
                <div class="card-body chart-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="card-title mb-2" style="color: #2c3e50; font-weight: 600;">
                                <i class="mdi mdi-chart-bar me-2 text-primary"></i>
                                Statistik Permintaan ATK Tahun <?php echo e($year); ?>

                            </h4>
                            <p class="text-muted mb-0">Grafik menunjukkan tren permintaan ATK bulanan sepanjang tahun</p>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded me-2" style="width: 12px; height: 12px;"></div>
                                <small class="text-muted">Jumlah Permintaan</small>
                            </div>
                        </div>
                    </div>

                    <div class="position-relative">
                        <canvas id="permintaanChart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Summary -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-body p-4">
                    <h5 class="mb-3" style="color: #2c3e50; font-weight: 600;">
                        <i class="mdi mdi-finance me-2"></i>
                        Ringkasan Keuangan ATK
                    </h5>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-clock-outline text-warning mdi-24px mb-2"></i>
                                <h6 class="mb-1">Pending</h6>
                                <p class="text-muted mb-0"><?php echo e($total - $disetujui - $ditolak); ?> permintaan</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-percent text-info mdi-24px mb-2"></i>
                                <h6 class="mb-1">Tingkat Persetujuan</h6>
                                <p class="text-muted mb-0"><?php echo e($total > 0 ? round(($disetujui / $total) * 100, 1) : 0); ?>%</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-chart-line text-success mdi-24px mb-2"></i>
                                <h6 class="mb-1">Efisiensi Anggaran</h6>
                                <p class="text-muted mb-0">
                                    <?php echo e($totalPemasukan > 0 ? round(($totalPengeluaran / $totalPemasukan) * 100, 1) : 0); ?>%
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-star text-warning mdi-24px mb-2"></i>
                                <h6 class="mb-1">Status Keuangan</h6>
                                <p class="text-muted mb-0">
                                    <?php echo e($totalPemasukan - $totalPengeluaran >= 0 ? 'Sehat' : 'Perlu Perhatian'); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('permintaanChart').getContext('2d');

        // Create gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(102, 126, 234, 0.8)');
        gradient.addColorStop(1, 'rgba(102, 126, 234, 0.1)');

        const permintaanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Permintaan ATK',
                    data: <?php echo json_encode($chartData, 15, 512) ?>,
                    backgroundColor: gradient,
                    borderColor: '#667eea',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            title: function (context) {
                                return 'Bulan ' + context[0].label;
                            },
                            label: function (context) {
                                return 'Jumlah Permintaan ATK: ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#8892b0',
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(136, 146, 176, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            precision: 0,
                            color: '#8892b0',
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\JIHAN DOC\Project Portofolio\atk-management\resources\views/dashboard.blade.php ENDPATH**/ ?>