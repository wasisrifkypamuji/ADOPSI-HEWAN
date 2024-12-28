<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('signup', [UserController::class, 'showSignupForm'])->name('signup.form');
Route::post('signup', [UserController::class, 'handleSignup'])->name('signup');

// User routes
Route::middleware('auth:web')->group(function () {
    Route::get('/homeuser', function () {
        return view('homeuser');
    })->name('homeuser');
});

// Admin routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/homeadmin', function () {
        return view('admin.homeadmin');
    })->name('admin.homeadmin');
});
