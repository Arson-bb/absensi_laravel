<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role->name;
    return $role === 'admin'
        ? redirect('/admin/dashboard')
        : redirect('/user/dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
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

Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::get('/admin/absensi', [AbsensiController::class, 'rekap'])
    ->name('admin.absensi.rekap')
    ->middleware(['auth', 'checkrole:admin']);

Route::get('/debug', function () {
    return 'Semua routing OK!';
});

require __DIR__.'/auth.php';
