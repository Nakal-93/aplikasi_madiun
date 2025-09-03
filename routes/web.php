<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// Public routes - OPD can submit applications without login
Route::get('/', [AplikasiController::class, 'index'])->name('aplikasi.index');
Route::get('/aplikasi/create', [AplikasiController::class, 'create'])->name('aplikasi.create');
Route::post('/aplikasi', [AplikasiController::class, 'store'])->name('aplikasi.store');
Route::get('/aplikasi/{aplikasi}', [AplikasiController::class, 'show'])->name('aplikasi.show');

// Auth routes
Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Admin protected routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/aplikasi', [AdminController::class, 'aplikasi'])->name('admin.aplikasi');
    Route::get('/aplikasi/{aplikasi}/edit', [AplikasiController::class, 'edit'])->name('aplikasi.edit');
    Route::put('/aplikasi/{aplikasi}', [AplikasiController::class, 'update'])->name('aplikasi.update');
    Route::delete('/aplikasi/{aplikasi}', [AplikasiController::class, 'destroy'])->name('aplikasi.destroy');
});
