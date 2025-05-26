@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold text-primary">Laporan Bulanan</h5>
                <div class="d-flex">
                    <form method="GET" action="{{ route('laporan.export') }}" target="_blank" class="me-2">
                        <input type="hidden" name="bulan" value="{{ $bulan }}">
                        <button class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-file-pdf me-2"></i> Export PDF
                        </button>
                    </form>
                    <form method="GET" action="{{ route('laporan.index') }}" class="d-flex">
                        <input type="month" name="bulan" value="{{ $bulan }}"
                            class="form-control rounded-start rounded-0 border-end-0">
                        <button class="btn btn-primary rounded-start-0"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-light border-start border-5 border-primary mb-4 ps-4">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 text-primary me-3"><i class="bi bi-box-arrow-in-down"></i></div>
                                <div>
                                    <span class="fs-6 text-muted">Total Pemasukan</span>
                                    <h4 class="mb-0">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-light border-start border-5 border-danger mb-4 ps-4">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 text-danger me-3"><i class="bi bi-box-arrow-right"></i></div>
                                <div>
                                    <span class="fs-6 text-muted">Total Pengeluaran</span>
                                    <h4 class="mb-0">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pemasukan-tab" data-bs-toggle="tab" data-bs-target="#pemasukan"
                            type="button" role="tab">
                            <i class="bi bi-box-arrow-in-down me-1"></i> Pemasukan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pengeluaran-tab" data-bs-toggle="tab" data-bs-target="#pengeluaran"
                            type="button" role="tab">
                            <i class="bi bi-box-arrow-right me-1"></i> Pengeluaran
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pemasukan" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama ATK</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th class="text-end">Total Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pemasukan as $p)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_masuk)->format('d/m/Y') }}</td>
                                            <td>{{ $p->atk->nama_atk }}</td>
                                            <td>{{ $p->jumlah }}</td>
                                            <td>{{ $p->satuan->nama_satuan }}</td>
                                            <td class="text-end">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-3 text-muted">Tidak ada data pemasukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pengeluaran" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama ATK</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th class="text-end">Total Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pengeluaran as $p)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_keluar)->format('d/m/Y') }}</td>
                                            <td>{{ $p->atk->nama_atk }}</td>
                                            <td>{{ $p->jumlah }}</td>
                                            <td>{{ $p->satuan->nama_satuan }}</td>
                                            <td class="text-end">Rp
                                                {{ number_format($p->jumlah * $p->harga_per_unit, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-3 text-muted">Tidak ada data pengeluaran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection