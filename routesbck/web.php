<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role->name; 
    return $role === 'admin'
        ? redirect('/admin/dashboard')
        : redirect('/user/dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    // Tambah route admin lain di sini nanti
});


Route::middleware(['auth', 'checkrole:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    });

    Route::post('/absen/masuk', [AbsensiController::class, 'checkIn']);
    Route::post('/absen/keluar', [AbsensiController::class, 'checkOut']);
    Route::get('/absen/riwayat', [AbsensiController::class, 'riwayat']);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/debug', function () {
    return 'Semua routing OK!';
});



require __DIR__.'/auth.php';

