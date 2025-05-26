<?php

namespace App\Http\Controllers;

use App\Models\PermintaanAtk;
use App\Models\PengeluaranAtk;
use App\Models\StokAtk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class VerifikasiPermintaanController extends Controller
{
    public function index()
    {
        $list = PermintaanAtk::with('user')
            ->where('status', 'menunggu')
            ->latest()->get();

        return view('verifikasi.index', compact('list'));
    }

    public function show($id)
    {
        $permintaan = PermintaanAtk::with('user', 'detailPermintaan.atk', 'detailPermintaan.satuan')->findOrFail($id);
        return view('verifikasi.show', compact('permintaan'));
    }
    public function verifikasi(Request $request, $id)
    {
        $permintaan = PermintaanAtk::with(['detailPermintaan.atk', 'detailPermintaan.satuan'])->findOrFail($id);

        try {
            DB::transaction(function () use ($permintaan, $request) {
                foreach ($permintaan->detailPermintaan as $item) {
                    $jumlah_sisa = $item->jumlah;

                    // Ambil stok berdasarkan FIFO
                    $stokList = StokAtk::where('atk_id', $item->atk_id)
                        ->where('jumlah', '>', 0)
                        ->orderBy('tanggal_masuk', 'asc')
                        ->get();

                    foreach ($stokList as $stok) {
                        if ($jumlah_sisa <= 0)
                            break;

                        // Pastikan harga_per_unit tidak null
                        if ($stok->harga_per_unit === null) {
                            throw new \Exception('Data stok ATK "' . $item->atk->nama_atk . '" tanggal masuk ' . $stok->tanggal_masuk . ' tidak memiliki harga_per_unit.');
                        }

                        $ambil = min($stok->jumlah, $jumlah_sisa);

                        $stok->jumlah -= $ambil;
                        $stok->save();

                        PengeluaranAtk::create([
                            'atk_id' => $item->atk_id,
                            'jumlah' => $ambil,
                            'satuan_id' => $item->satuan_id,
                            'harga_per_unit' => $stok->harga_per_unit,
                            'tanggal_keluar' => now(),
                        ]);

                        $jumlah_sisa -= $ambil;
                    }

                    // Jika stok tidak mencukupi
                    if ($jumlah_sisa > 0) {
                        throw new \Exception('Stok tidak cukup untuk ATK: ' . $item->atk->nama_atk);
                    }
                }

                // Update status permintaan
                $permintaan->update([
                    'status' => 'disetujui',
                    'catatan' => $request->input('catatan'),
                ]);
            });

            return redirect()->route('permintaan.index')->with('success', 'Permintaan berhasil disetujui.');
        } catch (\Throwable $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

