<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Rincian Barang Persediaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.3;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .header h2 {
            margin: 0;
            padding: 0;
            font-size: 16px;
            color: #333;
        }

        .header h3 {
            margin: 5px 0;
            padding: 0;
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 5px;
            font-size: 10px;
        }

        th {
            background-color: #f5f5f5;
            color: #333;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .kategori-header {
            background-color: #eaf2fd;
        }

        .total-kategori {
            background-color: #f5f5f5;
        }

        .grand-total {
            background-color: #eaeaea;
        }

        tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        @page {
            margin: 0.7cm;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LAPORAN RINCIAN BARANG PERSEDIAAN</h2>
        <h3>UNTUK PERIODE YANG BERAKHIR TANGGAL {{ $end->format('d-m-Y') }}</h3>
        <h3>TAHUN ANGGARAN: {{ $end->format('Y') }}</h3>
    </div>

    <table>
        <thead>
            <tr class="text-center">
                <th rowspan="2" style="vertical-align: middle;">KODE</th>
                <th rowspan="2" style="vertical-align: middle;">URAIAN</th>
                <th colspan="2">S/D {{ $start->format('d-m-Y') }}</th>
                <th colspan="2">MUTASI</th>
                <th colspan="2">S/D {{ $end->format('d-m-Y') }}</th>
            </tr>
            <tr class="text-center">
                <th>JUMLAH</th>
                <th>RUPIAH</th>
                <th>MASUK</th>
                <th>KELUAR</th>
                <th>JUMLAH</th>
                <th>RUPIAH</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotalAwal = $grandTotalMasuk = $grandTotalKeluar = $grandTotalAkhir = 0;
                $grandRupiahAwal = $grandRupiahAkhir = 0;
            @endphp

            @foreach($groupedData as $kategori => $items)
                <!-- Kategori Header -->
                <tr class="kategori-header">
                    <td colspan="8" class="fw-bold">{{ strtoupper($kategori) }}</td>
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

                <!-- Total per kategori -->
                <tr class="total-kategori fw-bold">
                    <td colspan="2" class="text-end">TOTAL {{ strtoupper($kategori) }}</td>
                    <td class="text-end">{{ $totalAwal }}</td>
                    <td class="text-end">{{ number_format($rupiahAwal, 0, ',', '.') }}</td>
                    <td class="text-end">{{ $totalMasuk }}</td>
                    <td class="text-end">{{ $totalKeluar }}</td>
                    <td class="text-end">{{ $totalAkhir }}</td>
                    <td class="text-end">{{ number_format($rupiahAkhir, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <!-- Grand Total -->
            <tr class="grand-total fw-bold">
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
</body>

</html>