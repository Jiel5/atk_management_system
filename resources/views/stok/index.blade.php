@extends('layouts.app')
@section('content')
    <div class="container-fluid px-2 px-md-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex align-items-center justify-content-between mb-3 mb-md-4 flex-wrap gap-2">
                    <div class="d-flex align-items-center">
                        <div class="bg-success rounded-3 p-2 p-md-3 me-2 me-md-3"
                            style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-boxes text-white fs-5 fs-md-4"></i>
                        </div>
                        <div>
                            <h3 class="mb-1 fw-bold text-dark fs-5 fs-md-3">Stok ATK</h3>
                            <p class="text-muted mb-0 small d-none d-sm-block">Kelola dan pantau ketersediaan alat tulis kantor</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary-subtle text-primary px-2 px-md-3 py-1 py-md-2 rounded-pill">
                            <i class="fas fa-cube me-1"></i>
                            <span class="d-none d-sm-inline">Total: </span>{{ $stok->count() }} Item
                        </span>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="card shadow-sm border-0 mb-3 mb-md-4">
                    <div class="card-body py-2 py-md-3">
                        <div class="row align-items-end g-2 g-md-3">
                            <div class="col-6 col-md-3">
                                <label for="kategoriFilter" class="form-label small text-muted mb-1">Kategori</label>
                                <select id="kategoriFilter" class="form-select form-select-sm">
                                    <option value="">Semua</option>
                                    @foreach($stok->pluck('atk.kategori')->filter()->unique('id') as $kategori)
                                        <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="stokFilter" class="form-label small text-muted mb-1">Stok</label>
                                <select id="stokFilter" class="form-select form-select-sm">
                                    <option value="">Semua</option>
                                    <option value="Banyak">Banyak (>50)</option>
                                    <option value="Sedang">Sedang (21-50)</option>
                                    <option value="Sedikit">Sedikit (≤20)</option>
                                </select>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="satuanFilter" class="form-label small text-muted mb-1">Satuan</label>
                                <select id="satuanFilter" class="form-select form-select-sm">
                                    <option value="">Semua</option>
                                    @foreach($stok->pluck('satuan')->unique('id') as $satuan)
                                        <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 col-md-3 text-end d-none d-md-block">
                                <small class="text-muted">
                                    Total: <span class="fw-semibold">{{ $stok->count() }}</span> item
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-2 px-md-4 py-2 py-md-3">
                        <!-- Table Header -->
                        <div class="bg-light px-2 px-md-4 py-2 py-md-3 border-bottom">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-table text-primary me-2"></i>
                                        <h6 class="mb-0 fw-semibold">Data Stok ATK</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end d-none d-md-block">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        Diperbarui: {{ now()->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Card View (visible only on mobile) -->
                        <div class="d-block d-md-none">
                            @forelse($stok as $index => $item)
                                <div class="card border-light mb-2 mobile-card">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="bg-info bg-opacity-10 rounded-2 p-2 me-2">
                                                        <i class="fas fa-pencil-alt text-info" style="font-size: 0.75rem;"></i>
                                                    </div>
                                                    <h6 class="mb-0 fw-medium text-dark">{{ $item->atk->nama_atk }}</h6>
                                                </div>
                                                
                                                @if($item->atk->kategori)
                                                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded-pill small">
                                                        {{ $item->atk->kategori->nama_kategori }}
                                                    </span>
                                                @else
                                                    <span class="text-muted fst-italic small">
                                                        <i class="fas fa-minus-circle me-1"></i>Tidak ada kategori
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <div class="text-end">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-1"
                                                    style="width: 24px; height: 24px;">
                                                    <small class="fw-semibold text-primary" style="font-size: 0.7rem;">{{ $index + 1 }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                @php
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
                                                @endphp
                                                <span class="fw-bold text-dark me-2">{{ $item->total_stok }}</span>
                                                <span class="badge bg-{{ $stockColor }}-subtle text-{{ $stockColor }} px-2 py-1 rounded-pill">
                                                    <i class="fas fa-circle" style="font-size: 0.4rem;"></i>
                                                    <small>{{ $stockLevel }}</small>
                                                </span>
                                            </div>
                                            
                                            <span class="bg-light px-2 py-1 rounded-pill text-dark fw-medium small">
                                                {{ $item->satuan->nama_satuan }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div class="bg-light rounded-circle p-3 mb-3">
                                            <i class="fas fa-inbox text-muted fs-3"></i>
                                        </div>
                                        <h6 class="text-muted mb-2">Data Stok Kosong</h6>
                                        <small class="text-muted">Belum ada data stok ATK yang tersedia</small>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Desktop Table View (hidden on mobile) -->
                        <div class="table-responsive d-none d-md-block">
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
                                    @forelse($stok as $index => $item)
                                        <tr class="border-bottom border-light">
                                            <td class="py-3 px-4">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width: 32px; height: 32px;">
                                                    <small class="fw-semibold text-primary">{{ $index + 1 }}</small>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-info bg-opacity-10 rounded-2 p-2 me-3">
                                                        <i class="fas fa-pencil-alt text-info" style="font-size: 0.875rem;"></i>
                                                    </div>
                                                    <div>
                                                        <span class="fw-medium text-dark">{{ $item->atk->nama_atk }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                @if($item->atk->kategori)
                                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">
                                                        {{ $item->atk->kategori->nama_kategori }}
                                                    </span>
                                                @else
                                                    <span class="text-muted fst-italic">
                                                        <i class="fas fa-minus-circle me-1"></i>Tidak ada kategori
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    @php
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
                                                    @endphp
                                                    <span class="fw-bold text-dark me-2">{{ $item->total_stok }}</span>
                                                    <span
                                                        class="badge bg-{{ $stockColor }}-subtle text-{{ $stockColor }} px-2 py-1 rounded-pill">
                                                        <i class="fas fa-circle" style="font-size: 0.5rem;"></i>
                                                        <small>{{ $stockLevel }}</small>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <span class="bg-light px-3 py-2 rounded-pill text-dark fw-medium">
                                                    {{ $item->satuan->nama_satuan }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
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
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Footer Info -->
                @if($stok->count() > 0)
                    <div class="row mt-3 mt-md-4 g-2 g-md-3">
                        @php
                            $totalStock = $stok->sum('total_stok');
                            $lowStock = $stok->where('total_stok', '<=', 20)->count();
                            $categories = $stok->pluck('atk.kategori.nama_kategori')->filter()->unique()->count();
                        @endphp
                        <div class="col-12 col-md-4">
                            <div class="card border-0 bg-primary bg-opacity-10 h-100">
                                <div class="card-body text-center p-3 p-md-4">
                                    <i class="fas fa-cubes text-primary fs-3 fs-md-2 mb-2 mb-md-3"></i>
                                    <h4 class="fw-bold text-primary mb-1 fs-5 fs-md-4">{{ $totalStock }}</h4>
                                    <small class="text-muted">Total Stok</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card border-0 bg-warning bg-opacity-10 h-100">
                                <div class="card-body text-center p-3 p-md-4">
                                    <i class="fas fa-exclamation-triangle text-warning fs-3 fs-md-2 mb-2 mb-md-3"></i>
                                    <h4 class="fw-bold text-warning mb-1 fs-5 fs-md-4">{{ $lowStock }}</h4>
                                    <small class="text-muted">Stok Rendah</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card border-0 bg-info bg-opacity-10 h-100">
                                <div class="card-body text-center p-3 p-md-4">
                                    <i class="fas fa-tags text-info fs-3 fs-md-2 mb-2 mb-md-3"></i>
                                    <h4 class="fw-bold text-info mb-1 fs-5 fs-md-4">{{ $categories }}</h4>
                                    <small class="text-muted">Kategori</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Initialize DataTable only for desktop view
            if ($(window).width() >= 768) {
                let table = $('#stoktable').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                    },
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                    columnDefs: [
                        { orderable: false, targets: 0 }
                    ],
                    dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
                });

                // Filter berdasarkan kategori
                $('#kategoriFilter').on('change', function () {
                    const val = $(this).val();
                    table.column(2).search(val).draw();
                });

                // Filter berdasarkan level stok
                $('#stokFilter').on('change', function () {
                    const val = $(this).val();
                    table.column(3).search(val).draw();
                });

                // Filter berdasarkan satuan
                $('#satuanFilter').on('change', function () {
                    const val = $(this).val();
                    table.column(4).search(val).draw();
                });
            } else {
                // Mobile filtering for card view
                function filterMobileCards() {
                    const kategoriFilter = $('#kategoriFilter').val().toLowerCase();
                    const stokFilter = $('#stokFilter').val();
                    const satuanFilter = $('#satuanFilter').val().toLowerCase();

                    $('.mobile-card').each(function() {
                        let show = true;
                        const card = $(this);
                        
                        // Filter kategori
                        if (kategoriFilter && kategoriFilter !== '') {
                            const kategori = card.find('.badge').first().text().toLowerCase();
                            if (!kategori.includes(kategoriFilter)) {
                                show = false;
                            }
                        }
                        
                        // Filter stok
                        if (stokFilter && stokFilter !== '') {
                            const stokText = card.find('.fw-bold').text();
                            const stokNum = parseInt(stokText);
                            
                            if (stokFilter === 'Banyak' && stokNum <= 50) show = false;
                            if (stokFilter === 'Sedang' && (stokNum <= 20 || stokNum > 50)) show = false;
                            if (stokFilter === 'Sedikit' && stokNum > 20) show = false;
                        }
                        
                        // Filter satuan
                        if (satuanFilter && satuanFilter !== '') {
                            const satuan = card.find('.bg-light.rounded-pill').text().toLowerCase();
                            if (!satuan.includes(satuanFilter)) {
                                show = false;
                            }
                        }
                        
                        card.toggle(show);
                    });
                }

                $('#kategoriFilter, #stokFilter, #satuanFilter').on('change', filterMobileCards);
            }
        });
    </script>

    <style>
        /* Responsive Design */
        @media (max-width: 767.98px) {
            /* Mobile Header Adjustments */
            .container-fluid {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }
            
            /* Mobile Card Styling */
            .mobile-card {
                border-radius: 0.5rem;
                transition: all 0.2s ease;
            }
            
            .mobile-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            
            /* Compact filter labels */
            .form-label {
                font-size: 0.75rem;
                font-weight: 600;
            }
            
            /* Smaller badges on mobile */
            .badge {
                font-size: 0.7rem;
            }
            
            /* Adjust icon sizes */
            .fas {
                font-size: 0.8rem;
            }
            
            /* Mobile specific spacing */
            .mb-3 {
                margin-bottom: 0.75rem !important;
            }
            
            .p-3 {
                padding: 0.75rem !important;
            }
        }

        /* Tablet adjustments */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .container-fluid {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }

        /* Enhanced DataTables styling */
        .dataTables_wrapper {
            padding-top: 1rem;
        }

        .table-responsive {
            overflow-x: auto;
            border: none;
        }

        .dataTables_wrapper .row {
            margin-bottom: 0.75rem;
        }

        /* Mobile DataTables adjustments */
        @media (max-width: 767.98px) {
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
            
            .dataTables_wrapper .dataTables_paginate {
                text-align: center;
            }
            
            .dataTables_wrapper .dataTables_info {
                text-align: center;
                font-size: 0.8rem;
            }
        }

        /* Smooth transitions */
        .card, .badge, .mobile-card {
            transition: all 0.2s ease-in-out;
        }

        /* Improved touch targets for mobile */
        @media (max-width: 767.98px) {
            .form-select {
                min-height: 38px;
            }
            
            .btn {
                min-height: 38px;
            }
        }

        /* Loading states and animations */
        .mobile-card {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Better scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Improved focus states for accessibility */
        .form-select:focus,
        .btn:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
        }
    </style>
@endsection