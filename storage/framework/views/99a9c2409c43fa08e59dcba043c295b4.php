

<?php $__env->startSection('content'); ?>
    <!-- Custom Styles -->
    <style>
        /* Adjust content positioning to account for fixed navbar */
        .content-wrapper {
            padding-top: 2rem;
            /* Tambah jarak dari top */
        }

        .modern-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
        }

        .gradient-primary-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-success-modern {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .gradient-danger-modern {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .gradient-warning-modern {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .chart-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        }

        .page-header-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
        }

        .breadcrumb-modern {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 0.5rem 1rem;
            backdrop-filter: blur(10px);
        }

        .number-display {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 1rem 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-title-modern {
            font-size: 1rem;
            font-weight: 500;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .chart-container {
            position: relative;
            padding: 2rem;
        }

        /* Fixed stats grid - ensure 3 cards stay in one row */
        .stats-grid {
            gap: 1rem;
            /* Reduced gap */
        }

        .stats-grid .col-stat {
            flex: 1;
            min-width: 0;
            /* Allow flex items to shrink */
            max-width: calc(33.333% - 0.67rem);
            /* Ensure proper width calculation */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stats-grid .col-stat {
                max-width: 100%;
                margin-bottom: 1rem;
            }

            .number-display {
                font-size: 2rem;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
            }
        }

        @media (min-width: 769px) {
            .stats-grid {
                display: flex;
                flex-wrap: nowrap;
                /* Prevent wrapping */
            }
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
            animation: slideInUp 0.6s ease-out;
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
    </style>

    <!-- Page Header -->
    <div class="page-header-modern animate-slide-up">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-2" style="font-size: 1.8rem; font-weight: 600;">
                    <i class="mdi mdi-view-dashboard me-2"></i>
                    Dashboard Analytics
                </h3>
                <p class="mb-0 opacity-75">Selamat datang kembali! Berikut adalah ringkasan aktivitas permintaan Anda.</p>
            </div>
            <div class="breadcrumb-modern">
                <span class="small">
                    <i class="mdi mdi-home me-1"></i>
                    Dashboard / Overview
                </span>
            </div>
        </div>
    </div>

    <!-- Statistics Cards (3 cards in 1 row - Fixed) -->
    <div class="stats-grid mb-3">
        <div class="col-stat animate-slide-up animate-delay-1">
            <div class="card modern-card gradient-primary-modern text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="card-title-modern">Total Permintaan</h6>
                            <div class="number-display"><?php echo e($total); ?></div>
                            <p class="small mb-0 opacity-75">
                                <i class="mdi mdi-trending-up me-1"></i>
                                Semua permintaan yang diajukan
                            </p>
                        </div>
                        <div class="stat-icon">
                            <i class="mdi mdi-file-document-multiple mdi-24px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-stat animate-slide-up animate-delay-2">
            <div class="card modern-card gradient-success-modern text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="card-title-modern">Disetujui</h6>
                            <div class="number-display"><?php echo e($disetujui); ?></div>
                            <p class="small mb-0 opacity-75">
                                <i class="mdi mdi-check-circle me-1"></i>
                                Permintaan yang disetujui
                            </p>
                        </div>
                        <div class="stat-icon">
                            <i class="mdi mdi-check-circle-outline mdi-24px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-stat animate-slide-up animate-delay-3">
            <div class="card modern-card gradient-danger-modern text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="card-title-modern">Ditolak</h6>
                            <div class="number-display"><?php echo e($ditolak); ?></div>
                            <p class="small mb-0 opacity-75">
                                <i class="mdi mdi-close-circle me-1"></i>
                                Permintaan yang ditolak
                            </p>
                        </div>
                        <div class="stat-icon">
                            <i class="mdi mdi-close-circle-outline mdi-24px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="row">
        <div class="col-12 animate-slide-up animate-delay-3">
            <div class="card chart-card">
                <div class="card-body chart-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="card-title mb-2" style="color: #2c3e50; font-weight: 600;">
                                <i class="mdi mdi-chart-bar me-2 text-primary"></i>
                                Statistik Permintaan Tahun <?php echo e($year); ?>

                            </h4>
                            <p class="text-muted mb-0">Grafik menunjukkan tren permintaan bulanan sepanjang tahun</p>
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

    <!-- Quick Stats Summary -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-body p-4">
                    <h5 class="mb-3" style="color: #2c3e50; font-weight: 600;">
                        <i class="mdi mdi-information-outline me-2"></i>
                        Ringkasan Cepat
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
                                <i class="mdi mdi-calendar-month text-info mdi-24px mb-2"></i>
                                <h6 class="mb-1">Bulan Ini</h6>
                                <p class="text-muted mb-0"><?php echo e(end($chartData)); ?> permintaan</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-trending-up text-success mdi-24px mb-2"></i>
                                <h6 class="mb-1">Trend</h6>
                                <p class="text-muted mb-0">
                                    <?php echo e(count($chartData) >= 2 && end($chartData) > prev($chartData) ? 'Meningkat' : 'Stabil'); ?>

                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-star text-warning mdi-24px mb-2"></i>
                                <h6 class="mb-1">Status</h6>
                                <p class="text-muted mb-0">
                                    <?php echo e($total > 0 && ($disetujui / $total) > 0.7 ? 'Sangat Baik' : 'Baik'); ?>

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
                    label: 'Jumlah Permintaan',
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
                                return 'Jumlah Permintaan: ' + context.parsed.y;
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\JIHAN DOC\Project Portofolio\atk-management\resources\views/dashboard-user.blade.php ENDPATH**/ ?>