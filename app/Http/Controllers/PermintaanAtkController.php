<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel; // ← pastikan ini di atas
use App\Models\Atk;
use App\Models\Satuan;
use App\Models\PermintaanAtk;
use App\Models\DetailPermintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;
use App\Exports\PermintaanExport;

class PermintaanAtkController extends Controller
{
    public function index()
    {
        $permintaan = auth()->user()->role === 'user'
            ? PermintaanAtk::with('detailPermintaan.atk', 'detailPermintaan.satuan')
                ->where('user_id', auth()->id())
                ->latest()
                ->get()
            : PermintaanAtk::with('user', 'detailPermintaan.atk', 'detailPermintaan.satuan')
                ->latest()
                ->get();

        return view('permintaan.index', compact('permintaan'));
    }

    public function create()
    {
        $atkList = Atk::with(['kategori', 'stok'])->get(); // pastikan relasi 'stok' sudah disiapkan
        $satuanList = Satuan::all();

        return view('permintaan.create', compact('atkList', 'satuanList'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'atk_id.*' => 'required|exists:atk,id',
            'jumlah.*' => 'required|numeric|min:1',
            'satuan_id.*' => 'required|exists:satuan,id',
        ]);

        // Buat permintaan utama
        $permintaan = PermintaanAtk::create([
            'user_id' => Auth::id(),
            'status' => 'menunggu'
        ]);

        // Tambah detail per item
        foreach ($request->atk_id as $i => $atkId) {
            DetailPermintaan::create([
                'permintaan_id' => $permintaan->id,
                'atk_id' => $atkId,
                'jumlah' => $request->jumlah[$i],
                'satuan_id' => $request->satuan_id[$i],
            ]);
        }

        return redirect()->route('permintaan.index')->with('success', 'Permintaan berhasil diajukan.');
    }


    public function cetak(Request $request)
    {
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;
        $status = $request->status;
        $format = $request->input('format', 'pdf');

        $query = PermintaanAtk::with(['user', 'detailPermintaan.atk', 'detailPermintaan.satuan'])
            ->whereBetween('created_at', [$tanggal_mulai . ' 00:00:00', $tanggal_akhir . ' 23:59:59']);

        if ($status) {
            $query->where('status', $status);
        }

        $permintaan = $query->get();

        if ($format === 'excel') {
            return Excel::download(new PermintaanExport($permintaan), 'laporan-permintaan-atk.xlsx');
        }

        // default PDF
        $pdf = PDF::loadView('permintaan.cetak', [
            'permintaan' => $permintaan,
            'tanggal_mulai' => Carbon::parse($tanggal_mulai)->format('d/m/Y'),
            'tanggal_akhir' => Carbon::parse($tanggal_akhir)->format('d/m/Y'),
            'status' => $status ? ucfirst($status) : 'Semua Status'
        ]);

        return $pdf->stream('laporan-permintaan-atk.pdf');
    }

    public function riwayat()
    {
        $user = auth()->user();

        $permintaan = PermintaanAtk::with([
            'detailPermintaan.atk',
            'detailPermintaan.satuan'
        ])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('permintaan.riwayat', compact('permintaan'));
    }

}
