<?php
namespace App\Http\Controllers;
use App\Models\PemasukanAtk;
use App\Models\PengeluaranAtk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->format('Y-m'); // format: 2025-05
        $tanggalAwal = Carbon::parse($bulan . '-01')->startOfMonth();
        $tanggalAkhir = Carbon::parse($bulan . '-01')->endOfMonth();

        $pemasukan = PemasukanAtk::with(['atk', 'satuan'])
            ->whereBetween('tanggal_masuk', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $pengeluaran = PengeluaranAtk::with(['atk', 'satuan'])
            ->whereBetween('tanggal_keluar', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('tanggal_keluar', 'desc')
            ->get();

        $totalPemasukan = $pemasukan->sum('total_biaya');
        $totalPengeluaran = $pengeluaran->sum(function ($item) {
            return $item->jumlah * $item->harga_per_unit;
        });

        // Format bulan untuk ditampilkan
        $namaBulan = Carbon::parse($bulan)->format('F Y');

        return view('laporan.index', compact(
            'bulan',
            'namaBulan',
            'pemasukan',
            'pengeluaran',
            'totalPemasukan',
            'totalPengeluaran'
        ));
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->format('Y-m');
        $tanggalAwal = Carbon::parse($bulan . '-01')->startOfMonth();
        $tanggalAkhir = Carbon::parse($bulan . '-01')->endOfMonth();

        $pemasukan = PemasukanAtk::with(['atk', 'satuan'])
            ->whereBetween('tanggal_masuk', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $pengeluaran = PengeluaranAtk::with(['atk', 'satuan'])
            ->whereBetween('tanggal_keluar', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('tanggal_keluar', 'desc')
            ->get();

        $totalPemasukan = $pemasukan->sum('total_biaya');
        $totalPengeluaran = $pengeluaran->sum(function ($item) {
            return $item->jumlah * $item->harga_per_unit;
        });

        // Format bulan untuk ditampilkan
        $namaBulan = Carbon::parse($bulan)->format('F Y');

        $pdf = PDF::loadView('laporan.pdf', compact(
            'bulan',
            'namaBulan',
            'pemasukan',
            'pengeluaran',
            'totalPemasukan',
            'totalPengeluaran'
        ))->setPaper('a4', 'portrait');

        $filename = 'laporan-atk-' . Carbon::parse($bulan)->format('Y-m') . '.pdf';
        return $pdf->download($filename);
    }
}