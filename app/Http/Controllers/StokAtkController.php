<?php

namespace App\Http\Controllers;

use App\Models\StokAtk;
use Illuminate\Support\Facades\DB;

class StokAtkController extends Controller
{
    public function index()
    {
        // Gabung berdasarkan nama_atk dan satuan
        $stok = StokAtk::select(
            'atk_id',
            'satuan_id',
            DB::raw('SUM(jumlah) as total_stok')
        )
            ->groupBy('atk_id', 'satuan_id')
            ->with('atk', 'satuan', 'atk.kategori')
            ->get();

        return view('stok.index', compact('stok'));
    }
}
