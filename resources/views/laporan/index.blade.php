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
                    <form method="GET" action="{{ route('laporan.index') }}" class="d-flex align-items-center">
                        @php
                            $currentBulan = $bulan ? explode('-', $bulan)[1] : date('m');
                            $currentTahun = $bulan ? explode('-', $bulan)[0] : date('Y');
                        @endphp

                        <select name="bulan" class="form-select rounded-end-0 border-end-0" style="min-width: 120px;">
                            <option value="01" {{ $currentBulan == '01' ? 'selected' : '' }}>Januari</option>
                            <option value="02" {{ $currentBulan == '02' ? 'selected' : '' }}>Februari</option>
                            <option value="03" {{ $currentBulan == '03' ? 'selected' : '' }}>Maret</option>
                            <option value="04" {{ $currentBulan == '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ $currentBulan == '05' ? 'selected' : '' }}>Mei</option>
                            <option value="06" {{ $currentBulan == '06' ? 'selected' : '' }}>Juni</option>
                            <option value="07" {{ $currentBulan == '07' ? 'selected' : '' }}>Juli</option>
                            <option value="08" {{ $currentBulan == '08' ? 'selected' : '' }}>Agustus</option>
                            <option value="09" {{ $currentBulan == '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $currentBulan == '10' ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $currentBulan == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $currentBulan == '12' ? 'selected' : '' }}>Desember</option>
                        </select>

                        <select name="tahun" class="form-select rounded-0 border-end-0" style="min-width: 100px;">
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $currentTahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>

                        <button class="btn btn-primary rounded-start-0" type="submit">
                            <i class="bi bi-search"></i> Tampilkan
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body p-4">
                <!-- Info Periode -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-info border-start border-5 border-info mb-4 ps-4">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 text-info me-3"><i class="bi bi-calendar3"></i></div>
                                <div>
                                    <span class="fs-6 text-muted">Periode Laporan</span>
                                    <h5 class="mb-0">
                                        @php
                                            $namaBulan = [
                                                '01' => 'Januari',
                                                '02' => 'Februari',
                                                '03' => 'Maret',
                                                '04' => 'April',
                                                '05' => 'Mei',
                                                '06' => 'Juni',
                                                '07' => 'Juli',
                                                '08' => 'Agustus',
                                                '09' => 'September',
                                                '10' => 'Oktober',
                                                '11' => 'November',
                                                '12' => 'Desember'
                                            ];
                                        @endphp
                                        {{ $namaBulan[$currentBulan] }} {{ $currentTahun }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

                <!-- Saldo -->
                <div class="row mb-4">
                    <div class="col-12">
                        @php
                            $saldo = $totalPemasukan - $totalPengeluaran;
                            $saldoClass = $saldo >= 0 ? 'success' : 'warning';
                            $saldoIcon = $saldo >= 0 ? 'arrow-up-circle' : 'arrow-down-circle';
                            $saldoText = $saldo >= 0 ? 'Surplus' : 'Defisit';
                        @endphp
                        <div class="alert alert-light border-start border-5 border-{{ $saldoClass }} ps-4">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 text-{{ $saldoClass }} me-3"><i class="bi bi-{{ $saldoIcon }}"></i></div>
                                <div>
                                    <span class="fs-6 text-muted">{{ $saldoText }} Bulan Ini</span>
                                    <h4 class="mb-0 text-{{ $saldoClass }}">Rp {{ number_format(abs($saldo), 0, ',', '.') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pemasukan-tab" data-bs-toggle="tab" data-bs-target="#pemasukan"
                            type="button" role="tab">
                            <i class="bi bi-box-arrow-in-down me-1"></i> Pemasukan ({{ $pemasukan->count() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pengeluaran-tab" data-bs-toggle="tab" data-bs-target="#pengeluaran"
                            type="button" role="tab">
                            <i class="bi bi-box-arrow-right me-1"></i> Pengeluaran ({{ $pengeluaran->count() }})
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pemasukan" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th width="15%">Tanggal</th>
                                        <th width="35%">Nama ATK</th>
                                        <th width="15%" class="text-center">Jumlah</th>
                                        <th width="15%" class="text-center">Satuan</th>
                                        <th width="20%" class="text-end">Total Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pemasukan as $p)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_masuk)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="fw-medium">{{ $p->atk->nama_atk }}</div>
                                                @if($p->keterangan)
                                                    <small class="text-muted">{{ $p->keterangan }}</small>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary-subtle text-primary">
                                                    {{ number_format($p->jumlah, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $p->satuan->nama_satuan }}</td>
                                            <td class="text-end">
                                                <strong class="text-success">
                                                    Rp {{ number_format($p->total_biaya, 0, ',', '.') }}
                                                </strong>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="bi bi-inbox fs-1 mb-3 d-block"></i>
                                                    <h6>Tidak ada data pemasukan</h6>
                                                    <small>untuk periode {{ $namaBulan[$currentBulan] }}
                                                        {{ $currentTahun }}</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if($pemasukan->count() > 0)
                                    <tfoot class="table-light">
                                        <tr>
                                            <th colspan="4" class="text-end">Total Pemasukan:</th>
                                            <th class="text-end text-success">
                                                Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                                            </th>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pengeluaran" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th width="15%">Tanggal</th>
                                        <th width="35%">Nama ATK</th>
                                        <th width="15%" class="text-center">Jumlah</th>
                                        <th width="15%" class="text-center">Satuan</th>
                                        <th width="20%" class="text-end">Total Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pengeluaran as $p)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_keluar)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="fw-medium">{{ $p->atk->nama_atk }}</div>
                                                @if($p->keterangan)
                                                    <small class="text-muted">{{ $p->keterangan }}</small>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-subtle text-danger">
                                                    {{ number_format($p->jumlah, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $p->satuan->nama_satuan }}</td>
                                            <td class="text-end">
                                                <strong class="text-danger">
                                                    Rp {{ number_format($p->jumlah * $p->harga_per_unit, 0, ',', '.') }}
                                                </strong>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="bi bi-inbox fs-1 mb-3 d-block"></i>
                                                    <h6>Tidak ada data pengeluaran</h6>
                                                    <small>untuk periode {{ $namaBulan[$currentBulan] }}
                                                        {{ $currentTahun }}</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if($pengeluaran->count() > 0)
                                    <tfoot class="table-light">
                                        <tr>
                                            <th colspan="4" class="text-end">Total Pengeluaran:</th>
                                            <th class="text-end text-danger">
                                                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                                            </th>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Auto submit form ketika dropdown berubah (opsional)
        document.addEventListener('DOMContentLoaded', function () {
            const bulanSelect = document.querySelector('select[name="bulan"]');
            const tahunSelect = document.querySelector('select[name="tahun"]');

            // Uncomment baris di bawah jika ingin auto-submit ketika dropdown berubah
            // bulanSelect.addEventListener('change', function() {
            //     this.form.submit();
            // });

            // tahunSelect.addEventListener('change', function() {
            //     this.form.submit();
            // });
        });
    </script>
@endsection