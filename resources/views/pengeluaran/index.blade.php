@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 text-primary">Riwayat Pengeluaran ATK</h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill">
                        <i class="fas fa-chart-line me-1"></i>
                        Total: {{ $pengeluaran->count() }} Transaksi
                    </span>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Filter Tanggal --}}
                <div class="card border-0 bg-light mb-4">
                    <div class="card-body p-3">
                        <form method="GET" action="{{ url()->current() }}" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="tanggal_mulai" class="form-label text-dark fw-medium">
                                    <i class="fas fa-calendar-day text-primary me-1"></i>
                                    Tanggal Mulai
                                </label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ request('tanggal_mulai') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_selesai" class="form-label text-dark fw-medium">
                                    <i class="fas fa-calendar-day text-primary me-1"></i>
                                    Tanggal Selesai
                                </label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                    value="{{ request('tanggal_selesai') }}">
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter me-1"></i>
                                        Filter
                                    </button>
                                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i>
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </form>

                        @if(request('tanggal_mulai') || request('tanggal_selesai'))
                            <div class="mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Menampilkan data
                                    @if(request('tanggal_mulai') && request('tanggal_selesai'))
                                        dari {{ \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d/m/Y') }}
                                        sampai {{ \Carbon\Carbon::parse(request('tanggal_selesai'))->format('d/m/Y') }}
                                    @elseif(request('tanggal_mulai'))
                                        mulai dari {{ \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d/m/Y') }}
                                    @elseif(request('tanggal_selesai'))
                                        sampai {{ \Carbon\Carbon::parse(request('tanggal_selesai'))->format('d/m/Y') }}
                                    @endif
                                </small>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Summary Info --}}
                @if($pengeluaran->count() > 0)
                    <div class="row mb-4">
                        @php
                            $totalPengeluaran = $pengeluaran->sum(function ($item) {
                                return $item->jumlah * $item->harga_per_unit;
                            });
                            $totalItem = $pengeluaran->sum('jumlah');
                            $rataRataHarga = $pengeluaran->avg('harga_per_unit');
                        @endphp
                        <div class="col-md-4">
                            <div class="card border-0 bg-danger bg-opacity-10 h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-money-bill-wave text-danger fs-4 mb-2"></i>
                                    <h6 class="fw-bold text-danger mb-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                                    </h6>
                                    <small class="text-muted">
                                        Total Pengeluaran
                                        @if(request('tanggal_mulai') || request('tanggal_selesai'))
                                            <br><span class="badge bg-primary-subtle text-primary mt-1">Periode Terpilih</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-warning bg-opacity-10 h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-boxes text-warning fs-4 mb-2"></i>
                                    <h6 class="fw-bold text-warning mb-1">{{ $totalItem }}</h6>
                                    <small class="text-muted">
                                        Total Item Keluar
                                        @if(request('tanggal_mulai') || request('tanggal_selesai'))
                                            <br><span class="badge bg-primary-subtle text-primary mt-1">Periode Terpilih</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-info bg-opacity-10 h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-calculator text-info fs-4 mb-2"></i>
                                    <h6 class="fw-bold text-info mb-1">Rp {{ number_format($rataRataHarga, 0, ',', '.') }}</h6>
                                    <small class="text-muted">
                                        Rata-rata Harga
                                        @if(request('tanggal_mulai') || request('tanggal_selesai'))
                                            <br><span class="badge bg-primary-subtle text-primary mt-1">Periode Terpilih</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover" id="tabelPengeluaran">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 py-3">
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
                                <th class="border-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-money-bill text-primary me-2"></i>
                                        <span class="fw-semibold text-dark">Harga Per Unit</span>
                                    </div>
                                </th>
                                <th class="border-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-coins text-primary me-2"></i>
                                        <span class="fw-semibold text-dark">Total Biaya</span>
                                    </div>
                                </th>
                                <th class="border-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar text-primary me-2"></i>
                                        <span class="fw-semibold text-dark">Tanggal Keluar</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengeluaran as $index => $item)
                                <tr class="border-bottom border-light">
                                    <td class="py-3">
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
                                        <span class="fw-bold text-dark">{{ $item->jumlah }}</span>
                                    </td>
                                    <td class="py-3">
                                        <span class="bg-light px-3 py-2 rounded-pill text-dark fw-medium">
                                            {{ $item->satuan->nama_satuan }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                            Rp {{ number_format($item->harga_per_unit, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <span class="fw-bold text-danger">
                                            Rp {{ number_format($item->jumlah * $item->harga_per_unit, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-muted me-2"></i>
                                            <span
                                                class="text-dark">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="bg-light rounded-circle p-4 mb-3">
                                                <i class="fas fa-inbox text-muted fs-2"></i>
                                            </div>
                                            <h6 class="text-muted mb-2">
                                                {{ (request('tanggal_mulai') || request('tanggal_selesai')) ? 'Tidak Ada Data Pada Periode Tersebut' : 'Belum Ada Pengeluaran' }}
                                            </h6>
                                            <small class="text-muted">
                                                {{ (request('tanggal_mulai') || request('tanggal_selesai')) ? 'Coba ubah filter tanggal atau reset filter' : 'Belum ada data pengeluaran ATK yang tercatat' }}
                                            </small>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.03);
            transition: background-color 0.2s ease;
        }

        /* Padding DataTables */
        .dataTables_wrapper {
            padding-top: 1rem;
        }

        /* Jarak antar komponen DataTables */
        .dataTables_wrapper .row {
            margin-bottom: 0.75rem;
        }

        /* Style untuk filter form */
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }

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

            /* Mobile responsive untuk filter */
            .row.g-3 .col-md-4 {
                margin-bottom: 1rem;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#tabelPengeluaran').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                },
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                columnDefs: [
                    { orderable: false, targets: 0 }, // Kolom nomor tidak bisa diurutkan
                    { orderable: true, targets: 6 }   // Kolom tanggal bisa diurutkan
                ],
                order: [[6, 'desc']], // Default sorting berdasarkan tanggal terbaru
            });

            // Set default tanggal selesai ke hari ini jika tanggal mulai dipilih
            $('#tanggal_mulai').on('change', function () {
                var tanggalMulai = $(this).val();
                var tanggalSelesai = $('#tanggal_selesai').val();

                if (tanggalMulai && !tanggalSelesai) {
                    var today = new Date().toISOString().split('T')[0];
                    $('#tanggal_selesai').val(today);
                }

                // Validasi tanggal selesai tidak boleh kurang dari tanggal mulai
                if (tanggalMulai && tanggalSelesai && tanggalSelesai < tanggalMulai) {
                    $('#tanggal_selesai').val(tanggalMulai);
                }
            });

            // Validasi tanggal selesai
            $('#tanggal_selesai').on('change', function () {
                var tanggalMulai = $('#tanggal_mulai').val();
                var tanggalSelesai = $(this).val();

                if (tanggalMulai && tanggalSelesai && tanggalSelesai < tanggalMulai) {
                    alert('Tanggal selesai tidak boleh kurang dari tanggal mulai');
                    $(this).val(tanggalMulai);
                }
            });
        });
    </script>
@endsection