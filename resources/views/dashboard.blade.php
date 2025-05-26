@extends('layouts.app')

@section('content')
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
                    Tahun {{ $year }}
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
                            <div class="number-display">{{ $total }}</div>
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
                            <div class="number-display">{{ $disetujui }}</div>
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
                            <div class="number-display">{{ $ditolak }}</div>
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
                            <div class="number-display">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                            <small><i class="mdi mdi-trending-up me-1"></i> Dana masuk tahun {{ $year }}</small>
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
                            <div class="number-display">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                            <small><i class="mdi mdi-trending-down me-1"></i> Dana keluar tahun {{ $year }}</small>
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
                                Rp {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}
                            </div>
                            <small><i class="mdi mdi-wallet-outline me-1"></i> Saldo tahun {{ $year }}</small>
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
                                Statistik Permintaan ATK Tahun {{ $year }}
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
                                <p class="text-muted mb-0">{{ $total - $disetujui - $ditolak }} permintaan</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-percent text-info mdi-24px mb-2"></i>
                                <h6 class="mb-1">Tingkat Persetujuan</h6>
                                <p class="text-muted mb-0">{{ $total > 0 ? round(($disetujui / $total) * 100, 1) : 0 }}%</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-chart-line text-success mdi-24px mb-2"></i>
                                <h6 class="mb-1">Efisiensi Anggaran</h6>
                                <p class="text-muted mb-0">
                                    {{ $totalPemasukan > 0 ? round(($totalPengeluaran / $totalPemasukan) * 100, 1) : 0 }}%
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3">
                                <i class="mdi mdi-star text-warning mdi-24px mb-2"></i>
                                <h6 class="mb-1">Status Keuangan</h6>
                                <p class="text-muted mb-0">
                                    {{ $totalPemasukan - $totalPengeluaran >= 0 ? 'Sehat' : 'Perlu Perhatian' }}
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
                    label: 'Jumlah Permintaan ATK',
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
@endsection