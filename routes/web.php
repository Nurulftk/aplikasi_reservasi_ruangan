<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ============================================
// Auth Routes
// ============================================
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================
// Admin Routes
// ============================================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // Ruangan CRUD
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

    // Reservasi Management
    Route::get('/reservasi', [ReservasiController::class, 'adminIndex'])->name('reservasi.index');
    Route::post('/reservasi/{id}/approve', [ReservasiController::class, 'approve'])->name('reservasi.approve');
    Route::post('/reservasi/{id}/reject', [ReservasiController::class, 'reject'])->name('reservasi.reject');

    // Jadwal
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// ============================================
// Mahasiswa Routes
// ============================================
Route::prefix('mahasiswa')->middleware(['auth', 'role:mahasiswa'])->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'mahasiswa'])->name('dashboard');

    // Reservasi
    Route::get('/reservasi', [ReservasiController::class, 'myReservasi'])->name('reservasi.index');
    Route::get('/reservasi/create', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
    Route::delete('/reservasi/{id}/cancel', [ReservasiController::class, 'cancel'])->name('reservasi.cancel');

    // Jadwal
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

    // Profil
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::put('/profil', [UserController::class, 'updateProfil'])->name('profil.update');
});
