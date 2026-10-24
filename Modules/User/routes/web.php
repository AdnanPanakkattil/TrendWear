<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\SuperadminController;
use Modules\User\Http\Controllers\StaffController;
use Modules\User\Http\Controllers\AdminController;
use Modules\User\Http\Controllers\InventoryManagerController;
use Modules\User\Http\Controllers\UserController;

Route::resource('users', UserController::class)->names('user');


//================ superadmin ===================================

Route::get('/superadmin', [SuperadminController::class, 'index'])->name('backend.superadmin');
Route::post('/superadmin/store', [SuperadminController::class, 'store'])->name('superadmin.store');
Route::get('/superadmin/data', [SuperadminController::class,'data'])->name('superadmin.data');

//===============================================================


//================ admin ===================================

//================ ADMIN ===================================

Route::get('/admin', [AdminController::class, 'index'])
    ->name('backend.admin');

Route::post('/admin/store', [AdminController::class, 'store'])
    ->name('admin.store');

Route::get('/admin/data', [AdminController::class, 'data'])
    ->name('admin.data');

//=========================================================

//===============================================================


//================ staff ===================================

Route::get('/staff', [StaffController::class, 'index'])
    ->name('backend.staff');

//===============================================================


//================ inventorymanager ===================================

Route::get('/inventorymanager', [InventoryManagerController::class, 'index'])
    ->name('backend.inventorymanager');

//===============================================================


Route::middleware(['auth', 'verified'])->group(function () {});
