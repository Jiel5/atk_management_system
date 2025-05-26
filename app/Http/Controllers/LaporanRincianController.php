<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atk;
use App\Models\PemasukanAtk;
use App\Models\PengeluaranAtk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanRincianController extends Controller
{
    public function index(Request $request)
    {
        $start = Carbon::parse($request->input('start', '2025-01-01'));
        $end = Carbon::parse($request->input('end', '2025-06-30'));

        $groupedData = $this->generateReportData($start, $end);

        return view('laporan.rincian_barang', compact('groupedData', 'start', 'end'));
    }

    public function export(Request $request)
    {
        $start = Carbon::parse($request->input('start', '2025-01-01'));
        $end = Carbon::parse($request->input('end', '2025-06-30'));

        $groupedData = $this->generateReportData($start, $end);

        $pdf = PDF::loadView('laporan.rincian_barang_pdf', compact('groupedData', 'start', 'end'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-rincian-barang-' . $start->format('dmY') . '-' . $end->format('dmY') . '.pdf');
    }

    private function generateReportData($start, $end)
    {
        $atks = Atk::with(['kategori', 'satuan'])->get();
        $groupedData = [];

        foreach ($atks as $atk) {
            $kategori = $atk->kategori->nama_kategori ?? 'Tanpa Kategori';

            $saldoAwalMasuk = PemasukanAtk::where('atk_id', $atk->id)
                ->whereDate('tanggal_masuk', '<', $start)
                ->sum('jumlah');

            $saldoAwalKeluar = PengeluaranAtk::where('atk_id', $atk->id)
                ->whereDate('tanggal_keluar', '<', $start)
                ->sum('jumlah');

            $saldoAwalJumlah = $saldoAwalMasuk - $saldoAwalKeluar;

            $nilaiAwal = PemasukanAtk::where('atk_id', $atk->id)
                ->whereDate('tanggal_masuk', '<', $start)
                ->sum('total_biaya');

            $masuk = PemasukanAtk::where('atk_id', $atk->id)
                ->whereBetween('tanggal_masuk', [$start, $end])
                ->sum('jumlah');

            $keluar = PengeluaranAtk::where('atk_id', $atk->id)
                ->whereBetween('tanggal_keluar', [$start, $end])
                ->sum('jumlah');

            $akhirJumlah = $saldoAwalJumlah + $masuk - $keluar;

            $nilaiAkhir = PemasukanAtk::where('atk_id', $atk->id)
                ->whereDate('tanggal_masuk', '<=', $end)
                ->sum('total_biaya')
                -
                PengeluaranAtk::where('atk_id', $atk->id)
                    ->whereDate('tanggal_keluar', '<=', $end)
                    ->sum(DB::raw('jumlah * harga_per_unit'));

            $groupedData[$kategori][] = [
                'kode' => $atk->id,
                'nama' => $atk->nama_atk,
                'saldo_awal_jumlah' => $saldoAwalJumlah,
                'nilai_awal' => $nilaiAwal,
                'masuk' => $masuk,
                'keluar' => $keluar,
                'saldo_akhir_jumlah' => $akhirJumlah,
                'nilai_akhir' => $nilaiAkhir,
            ];
        }

        return $groupedData;
    }
}