<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\SuperadminController;
use Modules\User\Http\Controllers\StaffController;
use Modules\User\Http\Controllers\AdminController;
use Modules\User\Http\Controllers\InventoryManagerController;
use Modules\User\Http\Controllers\UserController;

//================ USERS CRUD & DATA =============================

Route::get('/users/data', [UserController::class, 'data'])->name('user.data');
Route::get('/users/get/{id}', [UserController::class, 'showUser'])->name('user.get');
Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
Route::resource('users', UserController::class)->names('user');

//===============================================================

//================ SUPERADMIN CRUD ===============================

Route::get('/superadmin', [SuperadminController::class, 'index'])->name('backend.superadmin');
Route::post('/superadmin/store', [SuperadminController::class, 'store'])->name('superadmin.store');
Route::get('/superadmin/data', [SuperadminController::class, 'data'])->name('superadmin.data');
Route::get('/superadmin/edit/{id}', [SuperadminController::class, 'edit'])->name('superadmin.edit');
Route::post('/superadmin/update/{id}', [SuperadminController::class, 'update'])->name('superadmin.update');
Route::post('/superadmin/delete/{id}', [SuperadminController::class, 'destroy'])->name('superadmin.destroy');

//===============================================================

//================ ADMIN CRUD ===================================

Route::get('/admin', [AdminController::class, 'index'])->name('backend.admin');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/data', [AdminController::class, 'data'])->name('admin.data');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::post('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

//===============================================================

//================ STAFF ========================================

Route::get('/staff', [StaffController::class, 'index'])->name('backend.staff');

//===============================================================

//================ INVENTORY MANAGER ============================

Route::get('/inventorymanager', [InventoryManagerController::class, 'index'])->name('backend.inventorymanager');

//===============================================================

Route::middleware(['auth', 'verified'])->group(function () {});
