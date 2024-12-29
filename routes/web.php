<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KirimHewanController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('signup', [UserController::class, 'showSignupForm'])->name('signup.form');
Route::post('signup', [UserController::class, 'handleSignup'])->name('signup');

Route::resource('users', UserController::class);
Route::get('/', function () {
    return view('homeuser');
});

Route::get('/homeuser', function () {
    return view('homeuser');
}); 


//route donasi
Route::get('/donasi', [KirimHewanController::class, 'index'])->name('donasi.index');
Route::get('/donasi/create', [KirimHewanController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [KirimHewanController::class, 'store'])->name('donasi.store');
Route::get('/donasi/{id}', [KirimHewanController::class, 'show'])->name('donasi.show');
Route::delete('/donasi/{id}/batalkan', [KirimHewanController::class, 'batalkan'])->name('donasi.batalkan');