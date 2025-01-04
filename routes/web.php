<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeusercontrol;
use App\Http\Controllers\KirimHewanController;
use App\Http\Controllers\AdopsiController;
use App\Http\Controllers\AdminHewanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AccDonasiController;
use App\Http\Controllers\KomenController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('signup', [UserController::class, 'showSignupForm'])->name('signup.form');
Route::post('signup', [UserController::class, 'handleSignup'])->name('signup');
Route::get('/homeuser', [homeusercontrol::class, 'index'])->name('homeuser');


// User routes
Route::get('/', [homeusercontrol::class, 'index'])->name('homeuser');
Route::get('/homeuser', [homeusercontrol::class, 'index'])->name('homeuser');

// edit user
Route::get('/editprofil', [UserController::class, 'edit'])->name('editprofil.show');
Route::put('/profil/update', [UserController::class, 'update'])->name('editprofil.update');



Route::get('/historilaporan/{id_adopsi}', [LaporanController::class, 'index'])->name('historilaporan');

// Admin routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/homeadmin', function () {
        return view('homeadmin');
    })->name('homeadmin');
    // routes tambah hewan
    Route::get('/tambah-hewan', [AdminHewanController::class, 'index'])->name('admin.tambah-hewan');
    Route::post('/kategori', [AdminHewanController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::delete('/kategori/{id}', [AdminHewanController::class, 'deleteKategori'])->name('admin.kategori.delete');
    Route::post('/hewan', [AdminHewanController::class, 'storeHewan'])->name('admin.hewan.store');
    //routes acc donasi
    Route::get('/acc-donasi', [AccDonasiController::class, 'index'])->name('acc-donasi.index');
    Route::get('/acc-donasi/{id}', [AccDonasiController::class, 'show'])->name('acc-donasi.show');
    Route::post('/acc-donasi/{id}/approve', [AccDonasiController::class, 'approve'])->name('acc-donasi.approve');
    Route::post('/acc-donasi/{id}/reject', [AccDonasiController::class, 'reject'])->name('acc-donasi.reject');
    // Route::post('/hewan/store', [AdminHewanController::class, 'store'])->name('admin.hewan.store');
    Route::get('/acc-donasi/{id}/download-bukti', [AccDonasiController::class, 'downloadBukti'])->name('acc-donasi.download-bukti');
    Route::get('/acc-donasi/{id}/status', [AccDonasiController::class, 'checkDonationStatus'])->name('acc-donasi.status');
    Route::post('/acc-donasi/{id}/update-upload-status', [AccDonasiController::class, 'updateUploadStatus'])->name('acc-donasi.update-upload-status');
    Route::post('/acc-donasi/{id}/complete', [AccDonasiController::class, 'markAsCompleted'])->name('acc-donasi.complete');
});

//route donasi
Route::middleware(['auth'])->group(function () {
    Route::get('/donasi', [KirimHewanController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/create', [KirimHewanController::class, 'create'])->name('donasi.create');
    Route::post('/donasi', [KirimHewanController::class, 'store'])->name('donasi.store');
    Route::delete('/donasi/{id}/batalkan', [KirimHewanController::class, 'batalkan'])->name('donasi.batalkan');
    Route::get('/acc-donasi/{id}/bukti-terima', [AccDonasiController::class, 'buktiTerima'])->name('acc-donasi.bukti-terima');
});

// routes untuk adopsi
Route::get('/adopsi', [AdopsiController::class, 'index'])->name('adopsi.index')->middleware('auth');
Route::get('/adopsi/{id}', [AdopsiController::class, 'show'])->name('adopsi.show');


// komen
Route::post('/komentar', [KomenController::class, 'simpanKomentar'])->name('komentar.simpan');

Route::middleware('auth')->group(function () {
    Route::post('/komentar/{parent_id}/reply', [KomenController::class, 'reply'])->name('komentar.reply');
    Route::delete('/komentar/{id}', [KomenController::class, 'destroy'])->name('komentar.destroy');
});





Route::get('/download-template', function () {
    $filePath = storage_path('app/templates/template-perjanjian-donasi.pdf');
    
    \Log::info('Attempting to download file: ' . $filePath);
    \Log::info('File exists: ' . (file_exists($filePath) ? 'Yes' : 'No'));
    
    if (file_exists($filePath)) {
        return Response::file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="template-perjanjian-donasi.pdf"'
        ]);
    }
    
    return abort(404, 'File tidak ditemukan');
})->name('download.template');