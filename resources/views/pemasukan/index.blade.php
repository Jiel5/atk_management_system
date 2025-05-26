@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 text-primary">Data Pemasukan ATK</h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                        <i class="fas fa-chart-line me-1"></i>
                        Total: {{ $pemasukan->count() }} Transaksi
                    </span>
                    <a href="{{ route('pemasukan.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="fas fa-plus-circle me-1"></i> Tambah Data
                    </a>
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
                @if($pemasukan->count() > 0)
                    <div class="row mb-4">
                        @php
                            $totalPemasukan = $pemasukan->sum('total_biaya');
                            $totalItem = $pemasukan->sum('jumlah');
                            $rataRataHarga = $pemasukan->avg('total_biaya');
                        @endphp
                        <div class="col-md-4">
                            <div class="card border-0 bg-success bg-opacity-10 h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-money-bill-wave text-success fs-4 mb-2"></i>
                                    <h6 class="fw-bold text-success mb-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                                    </h6>
                                    <small class="text-muted">
                                        Total Pemasukan
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
                                    <i class="fas fa-boxes text-info fs-4 mb-2"></i>
                                    <h6 class="fw-bold text-info mb-1">{{ $totalItem }}</h6>
                                    <small class="text-muted">
                                        Total Item Masuk
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
                                    <i class="fas fa-calculator text-warning fs-4 mb-2"></i>
                                    <h6 class="fw-bold text-warning mb-1">Rp {{ number_format($rataRataHarga, 0, ',', '.') }}</h6>
                                    <small class="text-muted">
                                        Rata-rata Biaya
                                        @if(request('tanggal_mulai') || request('tanggal_selesai'))
                                            <br><span class="badge bg-primary-subtle text-primary mt-1">Periode Terpilih</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Note --}}
                <div class="alert alert-info border-0 bg-info bg-opacity-10 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        <small class="text-info mb-0">
                            <strong>Catatan:</strong> Tombol edit dan hapus akan <strong>nonaktif</strong> jika ATK sudah digunakan dalam pengeluaran.
                        </small>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="tabelPemasukan">
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
                                        <i class="fas fa-coins text-primary me-2"></i>
                                        <span class="fw-semibold text-dark">Total Biaya</span>
                                    </div>
                                </th>
                                <th class="border-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar text-primary me-2"></i>
                                        <span class="fw-semibold text-dark">Tanggal Masuk</span>
                                    </div>
                                </th>
                                <th class="border-0 py-3 text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-cogs text-primary me-2"></i>
                                        <span class="fw-semibold text-dark">Aksi</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemasukan as $index => $item)
                                <tr class="border-bottom border-light">
                                    <td class="py-3">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 32px; height: 32px;">
                                            <small class="fw-semibold text-primary">{{ $index + 1 }}</small>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                                <i class="fas fa-pencil-alt text-success" style="font-size: 0.875rem;"></i>
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
                                            Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-muted me-2"></i>
                                            <span class="text-dark">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex justify-content-center gap-1">
                                            @if(!$item->sudah_dipakai)
                                                <a href="{{ route('pemasukan.edit', $item->id) }}" 
                                                   class="btn btn-sm btn-warning rounded-pill px-3" 
                                                   data-bs-toggle="tooltip" title="Edit Data">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger rounded-pill px-3"
                                                            data-bs-toggle="tooltip" title="Hapus Data"
                                                            onclick="return confirm('Yakin ingin menghapus data pemasukan {{ $item->atk->nama_atk }}?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-secondary rounded-pill px-3" 
                                                        disabled 
                                                        data-bs-toggle="tooltip" title="Sudah digunakan dalam pengeluaran">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-secondary rounded-pill px-3" 
                                                        disabled 
                                                        data-bs-toggle="tooltip" title="Sudah digunakan dalam pengeluaran">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <span class="badge bg-warning-subtle text-warning ms-1" data-bs-toggle="tooltip" title="ATK ini sudah digunakan">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                            @endif
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
                                                {{ (request('tanggal_mulai') || request('tanggal_selesai')) ? 'Tidak Ada Data Pada Periode Tersebut' : 'Belum Ada Pemasukan' }}
                                            </h6>
                                            <small class="text-muted">
                                                {{ (request('tanggal_mulai') || request('tanggal_selesai')) ? 'Coba ubah filter tanggal atau reset filter' : 'Belum ada data pemasukan ATK yang tercatat' }}
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

        /* Hover effect untuk tombol aksi */
        .btn-sm:hover {
            transform: translateY(-1px);
            transition: transform 0.2s ease;
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

            /* Mobile responsive untuk aksi */
            .d-flex.gap-1 {
                flex-direction: column;
                gap: 0.25rem !important;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Initialize DataTables
            $('#tabelPemasukan').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                },
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                columnDefs: [
                    { orderable: false, targets: [0, 6] }, // Kolom nomor dan aksi tidak bisa diurutkan
                    { orderable: true, targets: 5 }        // Kolom tanggal bisa diurutkan
                ],
                order: [[5, 'desc']], // Default sorting berdasarkan tanggal masuk terbaru
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Set default tanggal selesai ke hari ini jika tanggal mulai dipilih
            $('#tanggal_mulai').on('change', function() {
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
            $('#tanggal_selesai').on('change', function() {
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