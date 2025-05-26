@extends('layouts.app')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first('error') }}</div>
    @endif

    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="bg-primary rounded-circle p-2 me-3">
                    <i class="fas fa-history text-white"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">Riwayat Permintaan ATK</h4>
                    <small class="text-muted">Kelola dan pantau status permintaan Pegawai</small>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div>
                <button type="button" class="btn btn-success btn-sm me-2" data-bs-toggle="modal"
                    data-bs-target="#cetakModal">
                    <i class="fas fa-print"></i> Cetak
                </button>
                @if(auth()->user()->role === 'user')
                    <a href="{{ route('permintaan.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Buat Permintaan
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body py-3">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label for="statusFilter" class="form-label small text-muted mb-1">Filter Status</label>
                    <select id="statusFilter" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tanggalFilter" class="form-label small text-muted mb-1">Filter Tanggal</label>
                    <input type="date" id="tanggalFilter" class="form-control form-control-sm">
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">
                        Total: <span class="fw-semibold">{{ $permintaan->count() }}</span> permintaan
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card shadow-sm border-0">
        <div class="card-body px-4 py-3">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($permintaan->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-inbox text-muted opacity-50" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-muted mb-2">Belum Ada Permintaan</h5>
                    <p class="text-muted">Anda belum memiliki riwayat permintaan ATK</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="permintaanTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 py-3"><small class="text-muted fw-semibold">NO</small></th>
                                <th class="border-0 py-3"><small class="text-muted fw-semibold">TANGGAL</small></th>
                                <th class="border-0 py-3"><small class="text-muted fw-semibold">NAMA</small></th>
                                <th class="border-0 py-3"><small class="text-muted fw-semibold">NIP</small></th>
                                <th class="border-0 py-3"><small class="text-muted fw-semibold">STATUS</small></th>
                                <th class="border-0 py-3"><small class="text-muted fw-semibold">DETAIL ATK</small></th>
                                @if(auth()->user()->role !== 'user')
                                    <th class="border-0 py-3"><small class="text-muted fw-semibold">AKSI</small></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permintaan as $p)
                                <tr class="border-bottom">
                                    <td class="py-3">{{ $loop->iteration }}</td>
                                    <td class="py-3">
                                        <div>
                                            <div class="fw-medium">
                                                <span class="d-none">{{ $p->created_at->format('Y-m-d') }}</span>
                                                {{ $p->created_at->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">{{ $p->created_at->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td class="py-3">{{ $p->user->nama }}</td>
                                    <td class="py-3"><span class="text-muted">{{ $p->user->nip }}</span></td>
                                    <td class="py-3">
                                        @php
                                            $statusClass = [
                                                'menunggu' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger'
                                            ];
                                            $statusIcon = [
                                                'menunggu' => 'clock',
                                                'disetujui' => 'check-circle',
                                                'ditolak' => 'times-circle'
                                            ];
                                            $class = $statusClass[$p->status] ?? 'secondary';
                                            $icon = $statusIcon[$p->status] ?? 'question';
                                        @endphp
                                        <span
                                            class="badge bg-{{ $class }} bg-opacity-10 text-{{ $class }} px-3 py-2 rounded-pill border border-{{ $class }} border-opacity-25">
                                            <i class="fas fa-{{ $icon }} me-1"></i> {{ ucfirst($p->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal" data-bs-target="#detailModal{{ $p->id }}">
                                            <i class="fas fa-eye me-1"></i> Lihat Item ({{ $p->detailPermintaan->count() }})
                                        </button>
                                    </td>
                                    @if(auth()->user()->role !== 'user')
                                        <td class="py-3">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('verifikasi.show', $p->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-search"></i> Detail
                                                </a>
                                                @if(auth()->user()->role === 'bendahara' && $p->status === 'menunggu')
                                                    {{-- Form Setujui --}}
                                                    <form action="{{ route('verifikasi.permintaan', $p->id) }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="aksi" value="approve">
    <input type="hidden" name="catatan" value="Disetujui tanpa catatan"> {{-- Optional --}}
    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui permintaan ini?')">
        <i class="fas fa-check"></i>
    </button>
</form>


                                                    {{-- Form Tolak --}}
                                                    <form action="{{ route('verifikasi.permintaan', $p->id) }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="aksi" value="reject">
    <input type="hidden" name="catatan" value="Ditolak karena alasan tertentu"> {{-- Optional --}}
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak permintaan ini?')">
        <i class="fas fa-times"></i>
    </button>
</form>
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>

                                <!-- Modal Detail masih dipakai untuk lihat detail ATK -->
                                <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail ATK - {{ $p->user->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group">
                                                    @foreach($p->detailPermintaan as $d)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $d->atk->nama_atk }}
                                                            <span class="badge bg-primary rounded-pill">
                                                                {{ $d->jumlah }} {{ $d->satuan->nama_satuan }}
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('permintaan.cetak') }}" method="GET" class="d-inline"
                                                    target="_blank">
                                                    <input type="hidden" name="tanggal_mulai"
                                                        value="{{ $p->created_at->format('Y-m-d') }}">
                                                    <input type="hidden" name="tanggal_akhir"
                                                        value="{{ $p->created_at->format('Y-m-d') }}">
                                                    <input type="hidden" name="status" value="{{ $p->status }}">
                                                    <input type="hidden" name="format" value="pdf">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-file-pdf"></i> PDF
                                                    </button>
                                                </form>
                                                <form action="{{ route('permintaan.cetak') }}" method="GET" class="d-inline"
                                                    target="_blank">
                                                    <input type="hidden" name="tanggal_mulai"
                                                        value="{{ $p->created_at->format('Y-m-d') }}">
                                                    <input type="hidden" name="tanggal_akhir"
                                                        value="{{ $p->created_at->format('Y-m-d') }}">
                                                    <input type="hidden" name="status" value="{{ $p->status }}">
                                                    <input type="hidden" name="format" value="excel">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-file-excel"></i> Excel
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </tbody>
                    </table>

                </div>
            @endif
        </div>
    </div>

    <!-- Print Modal -->
    <div class="modal fade" id="cetakModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="printForm" action="{{ route('permintaan.cetak') }}" method="GET" target="_blank"
                class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cetak Laporan Permintaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="format" class="form-label">Format</label>
                        <select name="format" id="format" class="form-select">
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-print"></i> Cetak</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            let table = $('#permintaanTable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                order: [[1, 'desc']], // Sort by tanggal (index 1) descending
                columnDefs: [
                    @if(auth()->user()->role === 'user')
                        { orderable: false, targets: [0, 5] } // No dan Detail ATK columns tidak bisa disort untuk user
                    @else
                            { orderable: false, targets: [0, 5, 6] } // No, Detail ATK, dan Aksi columns tidak bisa disort untuk non-user
                        @endif
                                                ]
            });

            // Filter by status
            $('#statusFilter').on('change', function () {
                const val = $(this).val();
                table.column(4).search(val).draw(); // Column index 4 for status
            });

            // Filter by date
            $('#tanggalFilter').on('change', function () {
                const val = $(this).val();
                table.column(1).search(val).draw(); // Column index 1 for date
            });
            // Set default date values for print modal
            const today = new Date();
            const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);

            const formatDate = (date) => {
                const d = new Date(date);
                return d.toISOString().split('T')[0];
            };

            document.getElementById('tanggal_mulai').value = formatDate(firstDay);
            document.getElementById('tanggal_akhir').value = formatDate(today);
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

        /* Custom styling untuk konsistensi dengan design riwayat */
        .card {
            border-radius: 12px;
        }

        .btn-outline-secondary.rounded-pill {
            border-color: #e9ecef;
            color: #6c757d;
        }

        .btn-outline-secondary.rounded-pill:hover {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .badge.bg-opacity-10 {
            font-weight: 500;
            letter-spacing: 0.025em;
        }
    </style>
@endsection