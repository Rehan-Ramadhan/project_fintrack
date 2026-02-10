<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\UangMasukController;
use App\Http\Controllers\UangKeluarController;
use App\Http\Controllers\AdminController;

// ========================================================
// ROUTE PUBLIC
// ========================================================
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ========================================================
// Route untuk pengguna yang sudah login
// ========================================================
Route::middleware(['auth'])->group(function () {

    // Dashboard utama setelah login
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Pengelolaan Saldo, Uang Masuk, dan Uang Keluar
    // User biasa hanya mengelola datanya sendiri
    Route::resource('saldo', SaldoController::class);
    Route::resource('uang_masuk', UangMasukController::class);
    Route::resource('uang_keluar', UangKeluarController::class);

});

// ========================================================
// Route khusus Admin
// ========================================================
Route::middleware(['auth', 'admin'])->group(function () {

    // Memanggil AdminController dengan method riwayat
    Route::get('/admin/riwayat', [AdminController::class, 'riwayat'])->name('admin.riwayat');
    // Route Export Excel
    Route::get('/admin/export-riwayat', [AdminController::class, 'exportRiwayat'])->name('admin.reports.export-riwayat');
    // Route Export PDF
    Route::get('/admin/export-pdf', [AdminController::class, 'exportPdf'])->name('admin.reports.export-pdf');
});
