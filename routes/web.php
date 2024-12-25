<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('signup', [UserController::class, 'showSignupForm'])->name('signup.form');
Route::post('signup', [UserController::class, 'handleSignup'])->name('signup');
Route::resource('users', UserController::class);
Route::get('/', function () {
    return view('welcome');
});