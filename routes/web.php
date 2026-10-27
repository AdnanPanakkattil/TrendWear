<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

// Guest authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// Alias for backwards compatibility
Route::get('/backend/login', fn () => redirect()->route('login'))->name('backend.login');

// Protected backend routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BackendController::class, 'index'])->name('backend.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
