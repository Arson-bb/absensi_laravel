<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role->name;
    return $role === 'admin'
        ? redirect()->route('admin.absensi.rekap')
        : redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard');



Route::middleware(['auth', 'checkrole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/absensi', [AbsensiController::class, 'rekap'])->name('absensi.rekap');
    Route::get('/absensi/export', [AdminController::class, 'export'])->name('absensi.export');
    
});


Route::middleware(['auth', 'checkrole:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::post('/absen/masuk', [AbsensiController::class, 'checkIn'])->name('absen.masuk');
    Route::post('/absen/keluar', [AbsensiController::class, 'checkOut'])->name('absen.keluar');
    Route::get('/absen/riwayat', [AbsensiController::class, 'riwayat'])->name('absen.riwayat');
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
