<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\AtkController;
use App\Http\Controllers\PemasukanAtkController;
use App\Http\Controllers\PengeluaranAtkController;
use App\Http\Controllers\PermintaanAtkController;
use App\Http\Controllers\VerifikasiPermintaanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\StokAtkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanRincianController;

// Redirect root ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// ============ AUTHENTIKASI ============
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ============ DASHBOARD ============
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'bendaharaDashboard'])
        ->middleware('role:bendahara')
        ->name('dashboard');

    Route::get('/dashboard-user', [DashboardUserController::class, 'userDashboard'])
        ->middleware('role:user')
        ->name('dashboard.user');
});

// ============ PROFIL ============
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ============ SEMUA USER (role:bendahara,user) ============
Route::middleware(['auth', 'role:bendahara,user'])->group(function () {
    // Permintaan
    Route::get('/permintaan', [PermintaanAtkController::class, 'index'])->name('permintaan.index');
    Route::get('/permintaan/cetak', [PermintaanAtkController::class, 'cetak'])->name('permintaan.cetak');

    // Stok
    Route::get('/stok', [StokAtkController::class, 'index'])->name('stok.index');
});

// ============ USER SAJA ============
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/permintaan/create', [PermintaanAtkController::class, 'create'])->name('permintaan.create');
    Route::post('/permintaan', [PermintaanAtkController::class, 'store'])->name('permintaan.store');
    Route::get('/riwayat', [PermintaanAtkController::class, 'riwayat'])->name('permintaan.riwayat');
});

// ============ BENDAHARA SAJA ============
Route::middleware(['auth', 'role:bendahara'])->group(function () {
    // Kategori, Satuan, ATK
    Route::resource('kategori', KategoriController::class);
    Route::resource('satuan', SatuanController::class);
    Route::resource('atk', AtkController::class);

    // Pemasukan & Pengeluaran
    Route::resource('pemasukan', PemasukanAtkController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/pengeluaran', [PengeluaranAtkController::class, 'index'])->name('pengeluaran.index');

    // Pengguna
    Route::resource('pengguna', PenggunaController::class)->except(['show']);

    // Verifikasi Permintaan
    Route::get('/verifikasi', [VerifikasiPermintaanController::class, 'index'])->name('verifikasi.index');
    Route::get('/verifikasi/{id}', [VerifikasiPermintaanController::class, 'show'])->name('verifikasi.show');
    Route::post('/verifikasi-permintaan/{id}', [VerifikasiPermintaanController::class, 'verifikasi'])
        ->middleware('verified')
        ->name('verifikasi.permintaan');

    // Laporan Bulanan & Rincian
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export');

    Route::get('/laporan/rincian', [LaporanRincianController::class, 'index'])->name('laporan.rincian');
    Route::get('/laporan/rincian/export', [LaporanRincianController::class, 'export'])->name('laporan.rincian.export');
});
