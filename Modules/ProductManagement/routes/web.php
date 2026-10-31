<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductManagement\Http\Controllers\BrandController;
use Modules\ProductManagement\Http\Controllers\CategoriesController;
use Modules\ProductManagement\Http\Controllers\ItemMasterController;
use Modules\ProductManagement\Http\Controllers\ProductManagementController;
use Modules\ProductManagement\Http\Controllers\SubCategoriesController;

Route::middleware('auth')->group(function () {
    // =============== item master =========================================================================
    Route::get('/item_master', [ItemMasterController::class, 'index'])
        ->name('productmanagement.item_master');

    Route::get('/add_item_master', [ItemMasterController::class, 'create'])
        ->name('productmanagement.add_item_master');

    // =====================================================================================================

    // =============== categories =========================================================================
    Route::get('/categories', [CategoriesController::class, 'index'])
        ->name('productmanagement.categories');
    Route::get('/categories/data', [CategoriesController::class, 'data'])
        ->name('productmanagement.categories.data');
    Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit'])
        ->name('productmanagement.categories.edit');
    Route::post('/categories/store', [CategoriesController::class, 'store'])
        ->name('productmanagement.categories.store');
    Route::post('/categories/update/{id}', [CategoriesController::class, 'update'])
        ->name('productmanagement.categories.update');
    Route::post('/categories/delete/{id}', [CategoriesController::class, 'destroy'])
        ->name('productmanagement.categories.destroy');

    // =====================================================================================================

    // =============== Sub categories =========================================================================
    Route::get('/sub_categories', [SubCategoriesController::class, 'index'])
        ->name('productmanagement.sub_categories');
    Route::get('/sub_categories/data', [SubCategoriesController::class, 'data'])
        ->name('productmanagement.sub_categories.data');
    Route::get('/sub_categories/edit/{id}', [SubCategoriesController::class, 'edit'])
        ->name('productmanagement.sub_categories.edit');
    Route::post('/sub_categories/store', [SubCategoriesController::class, 'store'])
        ->name('productmanagement.sub_categories.store');
    Route::post('/sub_categories/update/{id}', [SubCategoriesController::class, 'update'])
        ->name('productmanagement.sub_categories.update');
    Route::post('/sub_categories/delete/{id}', [SubCategoriesController::class, 'destroy'])
        ->name('productmanagement.sub_categories.destroy');

    // =====================================================================================================

    // =============== brand =========================================================================
    Route::get('/brands', [BrandController::class, 'index'])
        ->name('productmanagement.brands');

    // =====================================================================================================

    Route::resource('productmanagements', ProductManagementController::class)->names('productmanagement');
});
