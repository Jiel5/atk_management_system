<?php

namespace App\Http\Controllers;

use App\Models\PermintaanAtk;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();

        $total = PermintaanAtk::where('user_id', $user->id)->count();
        $disetujui = PermintaanAtk::where('user_id', $user->id)->where('status', 'disetujui')->count();
        $ditolak = PermintaanAtk::where('user_id', $user->id)->where('status', 'ditolak')->count();

        $year = now()->year;

        $statistik = PermintaanAtk::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->where('user_id', $user->id)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->pluck('total', 'bulan');

        $chartData = [];
        foreach (range(1, 12) as $month) {
            $chartData[] = $statistik->get($month, 0);
        }

        return view('dashboard-user', compact('total', 'disetujui', 'ditolak', 'chartData', 'year'));
    }

}
