<?php

namespace App\Http\Controllers;

use App\Models\Atk;
use App\Models\Satuan;
use App\Models\PemasukanAtk;
use App\Models\PengeluaranAtk;
use App\Models\StokAtk;
use Illuminate\Http\Request;

class PemasukanAtkController extends Controller
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
        $query = PemasukanAtk::with('atk', 'satuan');

        // Filter berdasarkan tanggal jika ada input
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_masuk', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_masuk', '<=', $request->tanggal_selesai);
        }

        // Ambil data dengan ordering (menggunakan latest() seperti sebelumnya)
        $pemasukan = $query->latest()->get();

        // Cek status sudah dipakai untuk setiap item
        foreach ($pemasukan as $item) {
            // Cek apakah ATK ini pernah keluar (digunakan)
            $item->sudah_dipakai = PengeluaranAtk::where('atk_id', $item->atk_id)->exists();
        }

        return view('pemasukan.index', compact('pemasukan'));
    }

    public function create()
    {
        return view('pemasukan.create', [
            'atkList' => Atk::all(),
            'satuanList' => Satuan::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'atk_id' => 'required|exists:atk,id',
            'jumlah' => 'required|numeric|min:1',
            'satuan_id' => 'required|exists:satuan,id',
            'total_biaya' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        // Simpan ke pemasukan
        $pemasukan = PemasukanAtk::create($request->all());

        // Simpan ke stok (FIFO)
        StokAtk::create([
            'atk_id' => $request->atk_id,
            'jumlah' => $request->jumlah,
            'satuan_id' => $request->satuan_id,
            'harga_per_unit' => $request->total_biaya / $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan ATK berhasil dicatat.');
    }

    private function hasApprovedUsage($pemasukan)
    {
        // Cek apakah ada permintaan disetujui yang sudah menyebabkan pengeluaran ATK ini
        return $pemasukan->atk
            ->pengeluaran()
            ->where('status', 'disetujui') // status dari permintaan terkait
            ->exists();
    }

    public function edit($id)
    {
        $pemasukan = PemasukanAtk::findOrFail($id);
        $sudahDipakai = PengeluaranAtk::where('atk_id', $pemasukan->atk_id)->exists();

        if ($sudahDipakai) {
            return redirect()->route('pemasukan.index')->with('error', 'Data pemasukan tidak dapat diedit karena sudah digunakan dalam permintaan yang disetujui.');
        }

        return view('pemasukan.edit', [
            'pemasukan' => $pemasukan,
            'atkList' => Atk::all(),
            'satuanList' => Satuan::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $pemasukan = PemasukanAtk::findOrFail($id);
        $sudahDipakai = PengeluaranAtk::where('atk_id', $pemasukan->atk_id)->exists();

        if ($sudahDipakai) {
            return redirect()->route('pemasukan.index')->with('error', 'Data pemasukan tidak dapat diperbarui karena sudah digunakan dalam permintaan yang disetujui.');
        }

        $request->validate([
            'atk_id' => 'required|exists:atk,id',
            'jumlah' => 'required|numeric|min:1',
            'satuan_id' => 'required|exists:satuan,id',
            'total_biaya' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        $pemasukan->update($request->all());

        // Update stok_atk jika perlu
        // (opsional jika kamu ingin menyinkronkan perubahan di pemasukan ke stok)

        return redirect()->route('pemasukan.index')->with('success', 'Data pemasukan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemasukan = PemasukanAtk::findOrFail($id);
        $sudahDipakai = PengeluaranAtk::where('atk_id', $pemasukan->atk_id)->exists();

        if ($sudahDipakai) {
            return redirect()->route('pemasukan.index')->with('error', 'Data pemasukan tidak dapat dihapus karena sudah digunakan dalam permintaan yang disetujui.');
        }

        $pemasukan->delete();

        return redirect()->route('pemasukan.index')->with('success', 'Data pemasukan berhasil dihapus.');
    }
}