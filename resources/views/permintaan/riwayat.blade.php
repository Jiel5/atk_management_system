@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="bg-primary rounded-circle p-2 me-3">
                    <i class="fas fa-history text-white"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">Riwayat Permintaan Anda</h4>
                    <small class="text-muted">Kelola dan pantau status permintaan Anda</small>
                </div>
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
                    <table class="table table-hover align-middle mb-0" id="riwayatTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 py-3">
                                    <small class="text-muted fw-semibold">TANGGAL</small>
                                </th>
                                <th class="border-0 py-3">
                                    <small class="text-muted fw-semibold">STATUS</small>
                                </th>
                                <th class="border-0 py-3">
                                    <small class="text-muted fw-semibold">ITEMS</small>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permintaan as $item)
                                <tr class="border-bottom">
                                    <td class="py-3">
                                        <div>
                                            <div class="fw-medium">
                                                <span class="d-none">{{ $item->created_at->format('Y-m-d') }}</span>
                                                {{ $item->created_at->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                        </div>
                                    </td>
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
                                            $class = $statusClass[$item->status] ?? 'secondary';
                                            $icon = $statusIcon[$item->status] ?? 'question';
                                        @endphp
                                        <span
                                            class="badge bg-{{ $class }} bg-opacity-10 text-{{ $class }} px-3 py-2 rounded-pill border border-{{ $class }} border-opacity-25">
                                            <i class="fas fa-{{ $icon }} me-1"></i> {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 pe-4">
                                        @if ($item->detailPermintaan && $item->detailPermintaan->count() > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($item->detailPermintaan->take(3) as $detail)
                                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill small">
                                                        {{ $detail->atk->nama_atk }} <span class="text-muted">×{{ $detail->jumlah }}</span>
                                                    </span>
                                                @endforeach
                                                @if($item->detailPermintaan->count() > 3)
                                                    <span class="badge bg-secondary text-white px-2 py-1 rounded-pill small">
                                                        +{{ $item->detailPermintaan->count() - 3 }} lainnya
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <small class="text-muted fst-italic">Tidak ada data</small>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            let table = $('#riwayatTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                },
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                columnDefs: [
                    { orderable: false, targets: 2 } // Kolom "ITEMS"
                ]
            });

            $('#statusFilter').on('change', function () {
                const val = $(this).val();
                table.column(1).search(val).draw(); // Fixed column index for status
            });

            $('#tanggalFilter').on('change', function () {
                const val = $(this).val();
                table.column(0).search(val).draw(); // Fixed column index for date
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

@endsection