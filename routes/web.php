<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeusercontrol;


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
        return view('admin.homeadmin');
    })->name('admin.homeadmin');
});
