<?php

namespace App\Http\Controllers;
use App\Models\PermintaanAtk;
use App\Models\PemasukanAtk;
use App\Models\PengeluaranAtk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function bendaharaDashboard()
    {
        $year = now()->year;

        $total = PermintaanAtk::whereYear('created_at', $year)->count();
        $disetujui = PermintaanAtk::whereYear('created_at', $year)->where('status', 'disetujui')->count();
        $ditolak = PermintaanAtk::whereYear('created_at', $year)->where('status', 'ditolak')->count();

        $totalPemasukan = PemasukanAtk::whereYear('tanggal_masuk', $year)->sum('total_biaya');
        $totalPengeluaran = PengeluaranAtk::whereYear('tanggal_keluar', $year)
            ->selectRaw('SUM(jumlah * harga_per_unit) as total')
            ->value('total') ?? 0;

        // Statistik permintaan per bulan
        $statistik = PermintaanAtk::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->pluck('total', 'bulan');

        $chartData = [];
        foreach (range(1, 12) as $month) {
            $chartData[] = $statistik->get($month, 0);
        }

        return view('dashboard', compact(
            'total',
            'disetujui',
            'ditolak',
            'totalPemasukan',
            'totalPengeluaran',
            'chartData',
            'year'
        ));
    }

}
