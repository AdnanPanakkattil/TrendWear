<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductManagement\Http\Controllers\BrandController;
use Modules\ProductManagement\Http\Controllers\CategoriesController;
use Modules\ProductManagement\Http\Controllers\ItemMasterController;
use Modules\ProductManagement\Http\Controllers\ProductManagementController;
use Modules\ProductManagement\Http\Controllers\SubCategoriesController;

// =============== item master =========================================================================

Route::get('/item_master', [ItemMasterController::class, 'index'])
    ->name('productmanagement.item_master');
    
// =====================================================================================================

// =============== categories =========================================================================

Route::get('/categories', [CategoriesController::class, 'index'])
    ->name('productmanagement.categories');
    
// =====================================================================================================

// =============== Sub categories =========================================================================

Route::get('/sub_categories', [SubCategoriesController::class, 'index'])
    ->name('productmanagement.sub_categories');
    
// =====================================================================================================

// =============== brand =========================================================================

Route::get('/brands', [BrandController::class, 'index'])
    ->name('productmanagement.brands');
    
// =====================================================================================================

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('productmanagements', ProductManagementController::class)->names('productmanagement');
// });
