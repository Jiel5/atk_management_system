@extends('layouts.app')

@section('content')

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
                            <div class="number-display">{{ $total }}</div>
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
                            <div class="number-display">{{ $disetujui }}</div>
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
                            <div class="number-display">{{ $ditolak }}</div>
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
                                Statistik Permintaan Tahun {{ $year }}
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
                                <p class="text-muted mb-0">{{ $total - $disetujui - $ditolak }} permintaan</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-calendar-month text-info mdi-24px mb-2"></i>
                                <h6 class="mb-1">Bulan Ini</h6>
                                <p class="text-muted mb-0">{{ end($chartData) }} permintaan</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-trending-up text-success mdi-24px mb-2"></i>
                                <h6 class="mb-1">Trend</h6>
                                <p class="text-muted mb-0">
                                    {{ count($chartData) >= 2 && end($chartData) > prev($chartData) ? 'Meningkat' : 'Stabil' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-star text-warning mdi-24px mb-2"></i>
                                <h6 class="mb-1">Status</h6>
                                <p class="text-muted mb-0">
                                    {{ $total > 0 && ($disetujui / $total) > 0.7 ? 'Sangat Baik' : 'Baik' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
                    data: @json($chartData),
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
@endsection