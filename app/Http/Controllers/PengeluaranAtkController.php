<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengeluaranAtk;

class PengeluaranAtkController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ], [
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.'
        ]);

        // Query dasar dengan relasi
        $query = PengeluaranAtk::with(['atk', 'satuan']);

        // Filter berdasarkan tanggal jika ada input
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_keluar', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_keluar', '<=', $request->tanggal_selesai);
        }

        // Ambil data dengan ordering (menggunakan latest() seperti sebelumnya)
        $pengeluaran = $query->latest()->get();

        return view('pengeluaran.index', compact('pengeluaran'));
    }


}