<?php

use App\Http\Controllers\Api\EdukasiApiController;
use App\Http\Controllers\Api\LaporanApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('landing');

/* ---------- Hanya untuk tamu (belum login) ---------- */
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

/* ---------- Hanya untuk user yang sudah login ---------- */
Route::middleware('auth')->group(function () {
    // Logout wajib POST (aman dari CSRF); tombolnya ada di sidebar layout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('lokasi', [LokasiController::class, 'index'])->name('lokasi');
    Route::get('edukasi', [EdukasiController::class, 'index'])->name('edukasi');
    Route::get('point', [PointController::class, 'index'])->name('point');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

    // CRUD laporan: index, create, store, edit, update, destroy
    Route::resource('laporan', LaporanController::class)->except('show');

    // REST API internal (dipanggil via fetch/AJAX dari app.js)
    Route::post('api/edukasi/klaim/{edukasi}', [EdukasiApiController::class, 'klaim'])->name('api.edukasi.klaim');
    Route::delete('api/laporan/{id}', [LaporanApiController::class, 'destroy'])->name('api.laporan.destroy');
});
