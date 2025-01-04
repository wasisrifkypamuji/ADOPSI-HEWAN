<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeusercontrol;
use App\Http\Controllers\KirimHewanController;
use App\Http\Controllers\AdopsiController;
use App\Http\Controllers\AdminHewanController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('signup', [UserController::class, 'showSignupForm'])->name('signup.form');
Route::post('signup', [UserController::class, 'handleSignup'])->name('signup');
Route::get('/homeuser', [homeusercontrol::class, 'index'])->name('homeuser');

Route::get('/', function () {
    return view('homeuser');
})->name('homeuser');

// User routes
Route::get('/homeuser', function () {
    return view('homeuser');
})->name('homeuser');



// Admin routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/homeadmin', function () {
        return view('homeadmin');

    })->name('homeadmin');
    // routes tambah hewan
    Route::get('/adopsi', [AdminHewanController::class, 'index'])->name('admin.tambah-hewan');
    Route::get('/tambah-hewan', [AdminHewanController::class, 'index'])->name('admin.tambah-hewan');
    Route::post('/kategori', [AdminHewanController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::delete('/kategori/{id}', [AdminHewanController::class, 'deleteKategori'])->name('admin.kategori.delete');
    Route::post('/hewan', [AdminHewanController::class, 'storeHewan'])->name('admin.hewan.store');

    Route::get('/adopsi', [AdminHewanController::class, 'adoptions'])->name('admin.adopsi.index');
    Route::get('/adopsi/riwayat', [AdminHewanController::class, 'riwayatAdopsi'])->name('admin.adopsi.riwayat');
    Route::get('/adopsi/laporan/{id}', [AdminHewanController::class, 'report'])->name('admin.adopsi.laporan');
    Route::delete('/adopsi/{id}', [AdminHewanController::class, 'deleteAdoption'])->name('admin.adopsi.delete');
});

//route donasi
Route::get('/donasi', [KirimHewanController::class, 'index'])->name('donasi.index');
Route::get('/donasi/create', [KirimHewanController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [KirimHewanController::class, 'store'])->name('donasi.store');
Route::get('/donasi/{id}', [KirimHewanController::class, 'show'])->name('donasi.show');
Route::delete('/donasi/{id}/batalkan', [KirimHewanController::class, 'batalkan'])->name('donasi.batalkan');

// Routes untuk AccDonasi
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/acc-donasi', [AccDonasiController::class, 'index'])->name('acc-donasi.index');
    Route::get('/admin/acc-donasi/{id}', [AccDonasiController::class, 'show'])->name('acc-donasi.show');
    Route::post('/admin/acc-donasi/{id}/approve', [AccDonasiController::class, 'approve'])->name('acc-donasi.approve');
    Route::post('/admin/acc-donasi/{id}/reject', [AccDonasiController::class, 'reject'])->name('acc-donasi.reject');
});

// routes untuk adopsi
Route::get('/adopsi', [AdopsiController::class, 'index'])->name('adopsi.index');
Route::get('/adopsi/{id}', [AdopsiController::class, 'show'])->name('adopsi.show');