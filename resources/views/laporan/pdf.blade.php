<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan ATK - {{ $namaBulan }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0 0 5px 0;
            font-size: 18px;
            color: #333;
        }

        .header p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 7px;
        }

        table th {
            background-color: #f5f5f5;
            text-align: left;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .summary {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .summary table {
            width: 50%;
            margin-left: auto;
        }

        .summary table td {
            border: none;
            padding: 5px;
        }

        .summary .total-row {
            font-weight: bold;
            border-top: 1px solid #ddd;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN PEMASUKAN DAN PENGELUARN BULANAN</h1>
        <p>Periode: {{ $namaBulan }}</p>
    </div>

    <div class="section">
        <div class="section-title">PEMASUKAN ATK</div>
        <table>
            <thead>
                <tr>
                    <th width="15%">Tanggal</th>
                    <th width="35%">Nama ATK</th>
                    <th width="10%">Jumlah</th>
                    <th width="15%">Satuan</th>
                    <th width="25%">Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemasukan as $p)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_masuk)->format('d/m/Y') }}</td>
                        <td>{{ $p->atk->nama_atk }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>{{ $p->satuan->nama_satuan }}</td>
                        <td class="text-right">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada data pemasukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <p><strong>Total Biaya Pemasukan:</strong> Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
    </div>

    <div class="section">
        <div class="section-title">PENGELUARAN ATK</div>
        <table>
            <thead>
                <tr>
                    <th width="15%">Tanggal</th>
                    <th width="35%">Nama ATK</th>
                    <th width="10%">Jumlah</th>
                    <th width="15%">Satuan</th>
                    <th width="25%">Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluaran as $p)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_keluar)->format('d/m/Y') }}</td>
                        <td>{{ $p->atk->nama_atk }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>{{ $p->satuan->nama_satuan }}</td>
                        <td class="text-right">Rp {{ number_format($p->jumlah * $p->harga_per_unit, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada data pengeluaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <p><strong>Total Biaya Pengeluaran:</strong> Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
    </div>

    <div class="summary">
        <table>
            <tr>
                <td>Total Pemasukan</td>
                <td class="text-right">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Pengeluaran</td>
                <td class="text-right">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>Saldo</td>
                <td class="text-right">Rp {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    </div>
</body>

</html>