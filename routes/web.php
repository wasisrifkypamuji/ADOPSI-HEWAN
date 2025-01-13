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
use App\Http\Controllers\AdopsiAdminController;
use App\Http\Controllers\admincontrol;
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



Route::middleware(['auth'])->group(function () {
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/historilaporan/{id_adopsi}', [LaporanController::class, 'index'])->name('laporan.index');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
});



// Admin routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/homeadmin', function () {
        return view('homeadmin');

    })->name('homeadmin');
    Route::get('/adopsi/riwayat', [AdminHewanController::class, 'riwayatAdopsi'])->name('admin.adopsi.riwayat');
    Route::get('/adopsi/laporan/{id}', [AdminHewanController::class, 'report'])->name('admin.adopsi.laporan');
    // routes tambah hewan
    Route::get('/adopsi', [AdminHewanController::class, 'index'])->name('admin.tambah-hewan');
    Route::get('/tambah-hewan', [AdminHewanController::class, 'index'])->name('admin.tambah-hewan');
    Route::post('/kategori', [AdminHewanController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::delete('/kategori/{id}', [AdminHewanController::class, 'deleteKategori'])->name('admin.kategori.delete');
    Route::post('/hewan', [AdminHewanController::class, 'storeHewan'])->name('admin.hewan.store');
    
    Route::get('/admin/hewan/{id_hewan}/detail', [AdminHewanController::class, 'detail'])->name('admin.detailhewan');

    // routes komen
    Route::get('/homeadmin', [AdminHewanController::class, 'home'])->name('homeadmin.index');

    // routes adopsi
    Route::get('/adopsi', [AdminHewanController::class, 'adoptions'])->name('admin.adopsi.index');
    Route::delete('/adopsi/{id}', [AdminHewanController::class, 'deleteAdoption'])->name('admin.adopsi.delete');

    // routes edit hewan
    Route::get('/adopsi/{id}/edit', [AdopsiAdminController::class, 'edit'])->name('adopsi.edit');
    Route::put('/adopsi/{id}', [AdopsiAdminController::class, 'update'])->name('adopsi.update');


    // Tambahkan routes untuk permintaan adopsi
    Route::get('/permintaanadopsi', [AdopsiAdminController::class, 'index'])->name('admin.permintaanadopsi');
    Route::put('/permintaanadopsi/{id}/accept', [AdopsiAdminController::class, 'accept'])->name('admin.adopsi.accept');
    Route::put('/permintaanadopsi/{id}/reject', [AdopsiAdminController::class, 'reject'])->name('admin.adopsi.reject');
    Route::get('/permintaanadopsi/form/{id}', [AdopsiAdminController::class, 'viewForm'])->name('admin.adopsi.view-form');

    //routes acc donasi
    Route::get('/acc-donasi', [AccDonasiController::class, 'index'])->name('acc-donasi.index');
    Route::get('/acc-donasi/{id}', [AccDonasiController::class, 'show'])->name('acc-donasi.show');
    Route::post('/acc-donasi/{id}/approve', [AccDonasiController::class, 'approve'])->name('acc-donasi.approve');
    Route::post('/acc-donasi/{id}/reject', [AccDonasiController::class, 'reject'])->name('acc-donasi.reject');
    Route::get('/acc-donasi/{id}/download-bukti', [AccDonasiController::class, 'downloadBukti'])->name('acc-donasi.download-bukti');
    Route::get('/acc-donasi/{id}/status', [AccDonasiController::class, 'checkDonationStatus'])->name('acc-donasi.status');
    Route::post('/acc-donasi/{id}/update-upload-status', [AccDonasiController::class, 'updateUploadStatus'])->name('acc-donasi.update-upload-status');
    Route::post('/acc-donasi/{id}/complete', [AccDonasiController::class, 'markAsCompleted'])->name('acc-donasi.complete');Route::get('/acc-donasi/bukti-terima/{id}', [AccDonasiController::class, 'buktiTerima'])->name('acc-donasi.bukti-terima');
    Route::get('/acc-donasi/download-bukti/{id}', [AccDonasiController::class, 'downloadBuktiTerima'])->name('acc-donasi.download-bukti');
    

});

//route donasi
Route::middleware(['auth'])->group(function () {
    Route::get('/donasi', [KirimHewanController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/create', [KirimHewanController::class, 'create'])->name('donasi.create');
    Route::post('/donasi', [KirimHewanController::class, 'store'])->name('donasi.store');
    Route::delete('/donasi/{id}/batalkan', [KirimHewanController::class, 'batalkan'])->name('donasi.batalkan');
    Route::get('/acc-donasi/{id}/bukti-terima', [AccDonasiController::class, 'buktiTerima'])
        ->name('acc-donasi.bukti-terima')
        ->middleware(['auth.donation']);// Tambahkan middleware ini
});

Route::get('/download-template-perjanjian', function() {
    $filePath = public_path('templates/perjanjian-donasi.pdf');
    
    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan');
    }

    $content = file_get_contents($filePath);
    
    return response($content)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="perjanjian-donasi.pdf"')
        ->header('Content-Length', strlen($content));
});

Route::get('/download-template-adopsi', function() {
    $filePath = public_path('templates/perjanjian-adopsi.pdf');
    
    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan');
    }

    $content = file_get_contents($filePath);
    
    return response($content)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="perjanjian-adopsi.pdf"')
        ->header('Content-Length', strlen($content));
})->name('download.template.adopsi');

// routes untuk adopsi
Route::get('/adopsi', [AdopsiController::class, 'index'])->name('adopsi.index')->middleware('auth');
Route::get('/adopsi/{id}', [AdopsiController::class, 'show'])->name('adopsi.show');
Route::middleware(['auth'])->group(function () {
    Route::get('/adopsi/create/{id}', [AdopsiController::class, 'create'])->name('adopsi.create');
    Route::post('/adopsi/store', [AdopsiController::class, 'store'])->name('adopsi.store');
});


// komen
Route::post('/komentar', [KomenController::class, 'simpanKomentar'])->name('komentar.simpan');

Route::middleware('auth:web,admin')->group(function () {
    Route::post('/komentar/{parent_id}/reply', [KomenController::class, 'reply'])->name('komentar.reply');
    // Tambahkan name untuk route delete
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


//adopsiMU
Route::get('/my-adoptions', [AdopsiController::class, 'userAdoptions'])
    ->name('adopsi.my-adoptions')
    ->middleware('auth');

    Route::delete('/adoptions/{id}/cancel', [AdopsiController::class, 'cancel'])
    ->name('adopsi.cancel')
    ->middleware('auth');

//Info formm adopsi
Route::get('/adoptions/{id}/form', [AdopsiController::class, 'viewForm'])
    ->name('adopsi.view-form')
    ->middleware('auth');

    Route::get('/adopsi/{id}/download', [AdopsiController::class, 'downloadPdf'])->name('adopsi.download-pdf');
    

    //passwot
    Route::prefix('auth')->group(function () {
        Route::get('/lupa-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
        Route::post('/lupa-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
        Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    });
    
    //tambah admin
    Route::prefix('admin')->middleware('auth:admin')->group(function () {
        Route::get('/tambah-admin', [AdminControl::class, 'showAddAdminForm'])->name('admin.create');
        Route::post('/tambah-admin', [AdminControl::class, 'store'])->name('admin.store');
    });