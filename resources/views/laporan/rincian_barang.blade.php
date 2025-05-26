@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 fw-bold text-primary">Laporan Rincian Barang Persediaan</h5>
                <small class="text-muted">Periode: {{ $start->format('d-m-Y') }} s/d {{ $end->format('d-m-Y') }}</small>
            </div>
            <div class="d-flex">
                <form method="GET" action="{{ route('laporan.rincian') }}" class="d-flex align-items-center me-2">
                    <div class="input-group input-group-sm">
                        <input type="date" name="start" id="start" class="form-control"
                            value="{{ request('start', $start->format('Y-m-d')) }}">
                        <span class="input-group-text bg-light">s/d</span>
                        <input type="date" name="end" id="end" class="form-control"
                            value="{{ request('end', $end->format('Y-m-d')) }}">
                        <button type="submit" class="btn btn-primary px-3">
                            Filter
                        </button>
                    </div>
                </form>
                <div>
                    <a href="{{ route('laporan.rincian.export', ['start' => request('start', $start->format('Y-m-d')), 'end' => request('end', $end->format('Y-m-d'))]) }}"
                        class="btn btn-sm btn-success me-1">
                        Export PDF
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive" id="report-container">
                <table class="table table-bordered table-hover table-sm mb-0">
                    <thead>
                        <tr class="text-center bg-light">
                            <th rowspan="2" class="align-middle border-end">KODE</th>
                            <th rowspan="2" class="align-middle border-end">URAIAN</th>
                            <th colspan="2" class="border-bottom border-end">S/D {{ $start->format('d-m-Y') }}</th>
                            <th colspan="2" class="border-bottom border-end">MUTASI</th>
                            <th colspan="2" class="border-bottom">S/D {{ $end->format('d-m-Y') }}</th>
                        </tr>
                        <tr class="text-center bg-light">
                            <th class="border-end">JUMLAH</th>
                            <th class="border-end">RUPIAH</th>
                            <th class="border-end">MASUK</th>
                            <th class="border-end">KELUAR</th>
                            <th class="border-end">JUMLAH</th>
                            <th>RUPIAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotalAwal = $grandTotalMasuk = $grandTotalKeluar = $grandTotalAkhir = 0;
                            $grandRupiahAwal = $grandRupiahAkhir = 0;
                        @endphp

                        @foreach($groupedData as $kategori => $items)
                            {{-- Kategori Header --}}
                            <tr class="bg-primary bg-opacity-10">
                                <td colspan="8" class="fw-bold py-2">{{ strtoupper($kategori) }}</td>
                            </tr>

                            @php
                                $totalAwal = $totalMasuk = $totalKeluar = $totalAkhir = 0;
                                $rupiahAwal = $rupiahAkhir = 0;
                            @endphp

                            @foreach($items as $row)
                                <tr>
                                    <td class="text-center">{{ $row['kode'] }}</td>
                                    <td>{{ $row['nama'] }}</td>
                                    <td class="text-end">{{ $row['saldo_awal_jumlah'] }}</td>
                                    <td class="text-end">{{ number_format($row['nilai_awal'], 0, ',', '.') }}</td>
                                    <td class="text-end">{{ $row['masuk'] }}</td>
                                    <td class="text-end">{{ $row['keluar'] }}</td>
                                    <td class="text-end">{{ $row['saldo_akhir_jumlah'] }}</td>
                                    <td class="text-end">{{ number_format($row['nilai_akhir'], 0, ',', '.') }}</td>
                                </tr>
                                @php
                                    $totalAwal += $row['saldo_awal_jumlah'];
                                    $rupiahAwal += $row['nilai_awal'];
                                    $totalMasuk += $row['masuk'];
                                    $totalKeluar += $row['keluar'];
                                    $totalAkhir += $row['saldo_akhir_jumlah'];
                                    $rupiahAkhir += $row['nilai_akhir'];

                                    $grandTotalAwal += $row['saldo_awal_jumlah'];
                                    $grandRupiahAwal += $row['nilai_awal'];
                                    $grandTotalMasuk += $row['masuk'];
                                    $grandTotalKeluar += $row['keluar'];
                                    $grandTotalAkhir += $row['saldo_akhir_jumlah'];
                                    $grandRupiahAkhir += $row['nilai_akhir'];
                                @endphp
                            @endforeach

                            {{-- Total per kategori --}}
                            <tr class="bg-light fw-bold">
                                <td colspan="2" class="text-end">TOTAL {{ strtoupper($kategori) }}</td>
                                <td class="text-end">{{ $totalAwal }}</td>
                                <td class="text-end">{{ number_format($rupiahAwal, 0, ',', '.') }}</td>
                                <td class="text-end">{{ $totalMasuk }}</td>
                                <td class="text-end">{{ $totalKeluar }}</td>
                                <td class="text-end">{{ $totalAkhir }}</td>
                                <td class="text-end">{{ number_format($rupiahAkhir, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach

                        {{-- Grand Total --}}
                        <tr class="bg-secondary bg-opacity-10 fw-bold">
                            <td colspan="2" class="text-end">GRAND TOTAL</td>
                            <td class="text-end">{{ $grandTotalAwal }}</td>
                            <td class="text-end">{{ number_format($grandRupiahAwal, 0, ',', '.') }}</td>
                            <td class="text-end">{{ $grandTotalMasuk }}</td>
                            <td class="text-end">{{ $grandTotalKeluar }}</td>
                            <td class="text-end">{{ $grandTotalAkhir }}</td>
                            <td class="text-end">{{ number_format($grandRupiahAkhir, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection