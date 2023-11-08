<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\DebtController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WorkersOfStoreController;
use App\Http\Controllers\Admin\ProductsOfStoreController;

Route::middleware(['auth:admin', 'localeSessionRedirect'])
    ->prefix(LaravelLocalization::setLocale())->group(function () {
        Route::get('main', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('admin', AdminController::class)->only(['edit', 'update']);
        Route::get('admin/getNotifications', [AdminController::class, 'pushNotifications'])
            ->name('pushNotifications');
        Route::get('admin/readAllNotifications', [DebtController::class, 'readAllNotifications'])->name('readAllNotifications');
        //store routes
        Route::resource('stores', StoreController::class)->except('show');
        Route::resource('stores.workers', WorkersOfStoreController::class)
            ->except(['create', 'store', 'edit']);
        Route::resource('stores.products', ProductsOfStoreController::class)
            ->except(['create', 'store', 'edit']);
        Route::get('stores/products/check-product-quantity', [ProductsOfStoreController::class, 'checkQuantity'])
            ->name('stores.products.checkQuantity');
        Route::resource('workers', WorkerController::class)->except('show');
        Route::resource('companies', CompanyController::class)->except('show');
        Route::resource('products', ProductController::class)->except('show');
        Route::get('products/{product}/{notification_id}', [ProductController::class, 'show'])
            ->name('products.show');
        Route::post('products/create/modal_value', [ProductController::class, 'getModalValue'])
            ->name('getModalValue');
        Route::resource('sales', SaleController::class)->except('show');
        Route::get('sales/create/product_field', [SaleController::class, 'getSalesField'])
            ->name('getSalesField');
        Route::get('sales/create/check_product_quantity', [SaleController::class, 'checkProductQuantity'])
            ->name('checkProductQuantity');
        Route::get('sales/create/print', [SaleController::class, 'printLastSale'])
            ->name('printLastSale');
        Route::resource('debts', DebtController::class)->except('show');
        Route::get('debts/{debt}/{notification_id}', [DebtController::class, 'show'])
            ->name('debts.show');
    });
