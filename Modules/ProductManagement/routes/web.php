<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductManagement\Http\Controllers\BrandController;
use Modules\ProductManagement\Http\Controllers\CategoriesController;
use Modules\ProductManagement\Http\Controllers\ItemMasterController;
use Modules\ProductManagement\Http\Controllers\ProductManagementController;
use Modules\ProductManagement\Http\Controllers\SizeController;
use Modules\ProductManagement\Http\Controllers\SubCategoriesController;

Route::middleware('auth')->group(function () {
    // =============== item master =========================================================================
    Route::get('/item_master', [ItemMasterController::class, 'index'])
        ->name('productmanagement.item_master');
    Route::get('/item_master/data', [ItemMasterController::class, 'data'])
        ->name('productmanagement.item_master.data');
    Route::get('/add_item_master', [ItemMasterController::class, 'create'])
        ->name('productmanagement.add_item_master');
    Route::post('/item_master/store', [ItemMasterController::class, 'store'])
        ->name('productmanagement.item_master.store');
    Route::get('/item_master/edit/{id}', [ItemMasterController::class, 'edit'])
        ->name('productmanagement.item_master.edit');
    Route::post('/item_master/update/{id}', [ItemMasterController::class, 'update'])
        ->name('productmanagement.item_master.update');
    Route::post('/item_master/delete/{id}', [ItemMasterController::class, 'destroy'])
        ->name('productmanagement.item_master.destroy');
    Route::post('/item_master/toggle-featured/{id}', [ItemMasterController::class, 'toggleFeatured'])
        ->name('productmanagement.item_master.toggle_featured');
    Route::post('/item_master/{id}/media/delete/{mediaId}', [ItemMasterController::class, 'deleteMedia'])
        ->name('productmanagement.item_master.media.delete');

    // =====================================================================================================

    // =============== categories =========================================================================
    Route::get('/categories', [CategoriesController::class, 'index'])
        ->name('productmanagement.categories');
    Route::get('/categories/list', [CategoriesController::class, 'list'])
        ->name('productmanagement.categories.list');
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
    Route::get('/sub_categories/by-category/{categoryId}', [SubCategoriesController::class, 'getByCategory'])
        ->name('productmanagement.sub_categories.by_category');
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
    Route::get('/brands/data', [BrandController::class, 'data'])
        ->name('productmanagement.brands.data');
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])
        ->name('productmanagement.brands.edit');
    Route::post('/brands/store', [BrandController::class, 'store'])
        ->name('productmanagement.brands.store');
    Route::post('/brands/update/{id}', [BrandController::class, 'update'])
        ->name('productmanagement.brands.update');
    Route::post('/brands/delete/{id}', [BrandController::class, 'destroy'])
        ->name('productmanagement.brands.destroy');

    // =====================================================================================================

    // =============== size management =====================================================================
    Route::get('/sizes', [SizeController::class, 'index'])
        ->name('productmanagement.sizes');
    Route::get('/sizes/edit/{id}', [SizeController::class, 'edit'])
        ->name('productmanagement.sizes.edit');
    Route::post('/sizes/store', [SizeController::class, 'store'])
        ->name('productmanagement.sizes.store');
    Route::post('/sizes/delete/{id}', [SizeController::class, 'destroy'])
        ->name('productmanagement.sizes.destroy');

    // =====================================================================================================

    Route::resource('productmanagements', ProductManagementController::class)->names('productmanagement');
});
