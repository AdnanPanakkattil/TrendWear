<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\SuperadminController;
use Modules\User\Http\Controllers\UserController;

Route::resource('users', UserController::class)->names('user');


//================ superadmin ===================================

Route::get('/superadmin', [SuperadminController::class, 'index'])
    ->name('backend.superadmin');

//===============================================================


//================ admin ===================================

Route::get('/admin', [SuperadminController::class, 'index'])
    ->name('backend.admin');

//===============================================================


//================ staff ===================================

Route::get('/staff', [SuperadminController::class, 'index'])
    ->name('backend.staff');

//===============================================================


//================ inventorymanager ===================================

Route::get('/inventorymanager', [SuperadminController::class, 'index'])
    ->name('backend.inventorymanager');

//===============================================================


Route::middleware(['auth', 'verified'])->group(function () {});
