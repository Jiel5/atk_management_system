<?php
namespace App\Http\Controllers;

use App\Models\Atk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AtkController extends Controller
{
    public function index()
    {
        $atkList = Atk::with('kategori')->get();
        return view('atk.index', compact('atkList'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('atk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_atk' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        Atk::create($request->all());

        return redirect()->route('atk.index')->with('success', 'ATK berhasil ditambahkan.');
    }

    public function edit(Atk $atk)
    {
        $kategori = Kategori::all();
        return view('atk.edit', compact('atk', 'kategori'));
    }

    public function update(Request $request, Atk $atk)
    {
        $request->validate([
            'nama_atk' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $atk->update($request->all());

        return redirect()->route('atk.index')->with('success', 'ATK berhasil diupdate.');
    }

    public function destroy(Atk $atk)
    {
        $atk->delete();
        return redirect()->route('atk.index')->with('success', 'ATK berhasil dihapus.');
    }
}
