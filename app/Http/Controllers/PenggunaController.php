<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pengguna.index', compact('users'));
    }

    public function create()
    {
        $jabatans = config('jabatan');
        return view('pengguna.create', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $jabatans = config('jabatan');

        // Validasi data input termasuk no_hp, nip, dan email
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'jabatan' => ['required', Rule::in($jabatans)],
            'role' => ['required', Rule::in(['user', 'bendahara'])],
            'no_hp' => 'nullable|string|max:15', // Validasi no_hp
            'nip' => 'nullable|string|max:20',   // Validasi nip
            'email' => 'nullable|email|max:255|unique:users,email', // Validasi email
        ]);

        $validated['password'] = bcrypt($validated['password']);

        // Menyimpan pengguna ke database dengan data yang divalidasi
        User::create($validated);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $pengguna)
    {
        $jabatans = config('jabatan');
        return view('pengguna.edit', compact('pengguna', 'jabatans'));
    }

    public function update(Request $request, User $pengguna)
    {
        $jabatans = config('jabatan');

        // Validasi data input untuk update, termasuk no_hp, nip, dan email
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($pengguna->id)],
            'jabatan' => ['required', Rule::in($jabatans)],
            'role' => ['required', Rule::in(['user', 'bendahara'])],
            'password' => 'nullable|string|min:6|confirmed',
            'no_hp' => 'nullable|string|max:15', // Validasi no_hp
            'nip' => 'nullable|string|max:20',   // Validasi nip
            'email' => 'nullable|email|max:255|unique:users,email,' . $pengguna->id, // Validasi email dengan pengecualian untuk pengguna yang sama
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Update pengguna dengan data yang divalidasi
        $pengguna->update($validated);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        $pengguna->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
