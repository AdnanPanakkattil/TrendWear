<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/dashboard', [BackendController::class, 'index'])
    ->name('backend.dashboard');