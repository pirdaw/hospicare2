<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\TenagaKesehatanController;

// ─── AUTH (guest only) ───────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── DASHBOARD PER ROLE ───────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('dashboard.admin');

    Route::get('/dashboard/petugas', [DashboardController::class, 'petugas'])
        ->middleware('role:admin,petugas_pendaftaran')
        ->name('dashboard.petugas');

    Route::get('/dashboard/nakes', [DashboardController::class, 'nakes'])
        ->middleware('role:admin,tenaga_kesehatan')
        ->name('dashboard.nakes');

    Route::get('/dashboard/kepala', [DashboardController::class, 'kepala'])
        ->middleware('role:admin,kepala_rm')
        ->name('dashboard.kepala');
});

// ─── POLI ─────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('poli', PoliController::class);
});

// ─── PASIEN ───────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin,petugas_pendaftaran'])->group(function () {
    Route::resource('pasien', PasienController::class);
    Route::post('/pasien/cari', [PasienController::class, 'cari'])->name('pasien.cari');
});

// ─── KUNJUNGAN ────────────────────────────────────────────────────────────────

// TARUH INI DULU (DI ATAS) — berisi /kunjungan/create
Route::middleware(['auth', 'role:admin,petugas_pendaftaran'])->group(function () {
    Route::get('/kunjungan/create', [KunjunganController::class, 'create'])->name('kunjungan.create');
    Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
    Route::get('/kunjungan/{kunjungan}/edit', [KunjunganController::class, 'edit'])->name('kunjungan.edit');
    Route::put('/kunjungan/{kunjungan}', [KunjunganController::class, 'update'])->name('kunjungan.update');
    Route::delete('/kunjungan/{kunjungan}', [KunjunganController::class, 'destroy'])->name('kunjungan.destroy');
});

// BARU INI (DI BAWAH) — berisi /kunjungan/{kunjungan} untuk show
Route::middleware(['auth', 'role:admin,petugas_pendaftaran,kepala_rm,tenaga_kesehatan'])->group(function () {
    Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
    Route::get('/kunjungan-cetak', [KunjunganController::class, 'cetak'])->name('kunjungan.cetak');
    Route::get('/kunjungan/{kunjungan}', [KunjunganController::class, 'show'])->name('kunjungan.show');
});

// ─── PEMERIKSAAN (SOAP) ───────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin,tenaga_kesehatan'])->group(function () {
    Route::get(
        '/pemeriksaan/kunjungan/{kunjungan}',
        [PemeriksaanController::class, 'create']
    )->name('pemeriksaan.create');
    Route::post(
        '/pemeriksaan',
        [PemeriksaanController::class, 'store']
    )->name('pemeriksaan.store');
    Route::get(
        '/pemeriksaan/{pemeriksaan}',
        [PemeriksaanController::class, 'show']
    )->name('pemeriksaan.show');
    Route::get(
        '/pemeriksaan/{pemeriksaan}/edit',
        [PemeriksaanController::class, 'edit']
    )->name('pemeriksaan.edit');
    Route::put(
        '/pemeriksaan/{pemeriksaan}',
        [PemeriksaanController::class, 'update']
    )->name('pemeriksaan.update');
});

// ─── TENAGA KESEHATAN ─────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('tenaga-kesehatan', TenagaKesehatanController::class);
});
