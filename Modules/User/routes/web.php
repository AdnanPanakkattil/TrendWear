<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AdminController;
use Modules\User\Http\Controllers\CustomerController;
use Modules\User\Http\Controllers\InventoryManagerController;
use Modules\User\Http\Controllers\StaffController;
use Modules\User\Http\Controllers\SuperadminController;
use Modules\User\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    // ================ USERS CRUD & DATA =============================
    Route::get('/users/data', [UserController::class, 'data'])->name('user.data');
    Route::get('/users/get/{id}', [UserController::class, 'showUser'])->name('user.get');
    Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::resource('users', UserController::class)->names('user');

    // ===============================================================

    // ================ SUPERADMIN CRUD ===============================
    Route::get('/superadmin', [SuperadminController::class, 'index'])->name('backend.superadmin');
    Route::post('/superadmin/store', [SuperadminController::class, 'store'])->name('superadmin.store');
    Route::get('/superadmin/data', [SuperadminController::class, 'data'])->name('superadmin.data');
    Route::get('/superadmin/edit/{id}', [SuperadminController::class, 'edit'])->name('superadmin.edit');
    Route::post('/superadmin/update/{id}', [SuperadminController::class, 'update'])->name('superadmin.update');
    Route::post('/superadmin/delete/{id}', [SuperadminController::class, 'destroy'])->name('superadmin.destroy');

    // ===============================================================

    // ================ ADMIN CRUD ===================================
    Route::get('/admin', [AdminController::class, 'index'])->name('backend.admin');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/data', [AdminController::class, 'data'])->name('admin.data');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // ===============================================================

    // ================ STAFF CRUD ===================================
    Route::get('/staff', [StaffController::class, 'index'])->name('backend.staff');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/data', [StaffController::class, 'data'])->name('staff.data');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::post('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::post('/staff/delete/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

    // ===============================================================

    // ================ INVENTORY MANAGER CRUD =======================
    Route::get('/inventorymanager', [InventoryManagerController::class, 'index'])->name('backend.inventorymanager');
    Route::post('/inventorymanager/store', [InventoryManagerController::class, 'store'])->name('inventorymanager.store');
    Route::get('/inventorymanager/data', [InventoryManagerController::class, 'data'])->name('inventorymanager.data');
    Route::get('/inventorymanager/edit/{id}', [InventoryManagerController::class, 'edit'])->name('inventorymanager.edit');
    Route::post('/inventorymanager/update/{id}', [InventoryManagerController::class, 'update'])->name('inventorymanager.update');
    Route::post('/inventorymanager/delete/{id}', [InventoryManagerController::class, 'destroy'])->name('inventorymanager.destroy');

    // ===============================================================

    // ================ CUSTOMER CRUD ================================
    Route::get('/customer', [CustomerController::class, 'index'])->name('backend.customer');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/data', [CustomerController::class, 'data'])->name('customer.data');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::post('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});
