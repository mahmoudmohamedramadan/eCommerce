<?php

use App\Http\Controllers\Admin\ProductsOfStoreController;
use App\Http\Controllers\Admin\WorkersOfStoreController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\DebtController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('login', [LoginController::class, 'showLogin'])->name('showLogin');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth:admin')
    ->get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:admin', 'localeSessionRedirect'], 'prefix' => LaravelLocalization::setLocale()], function () {
    //category routes
    Route::get('main', [DashboardController::class, 'index'])->name('dashboard');
    //category routes
    Route::resource('admin', AdminController::class)->only(['edit', 'update']);
    //debt notifications
    Route::get('admin/getNotifications', [AdminController::class, 'pushNotifications'])->name('pushNotifications');
    //read all debt notifications
    Route::get('admin/readAllNotifications', [DebtController::class, 'readAllNotifications'])->name('readAllNotifications');
    //store routes
    Route::resource('stores', StoreController::class)->except('show');
    //workers of store routes
    Route::resource('stores.workers', WorkersOfStoreController::class)->except(['create', 'store', 'edit']);
    //products of store routes
    Route::resource('stores.products', ProductsOfStoreController::class)->except(['create', 'store', 'edit']);
    //check quantity of product
    Route::get('stores/products/check-product-quantity', [ProductsOfStoreController::class, 'checkQuantity'])
        ->name('stores.products.checkQuantity');
    //worker routes
    Route::resource('workers', WorkerController::class)->except('show');
    //company routes
    Route::resource('companies', CompanyController::class)->except('show');
    //product routes
    Route::resource('products', ProductController::class)->except('show');
    //product show function
    Route::get('products/{product}/{notification_id}', [ProductController::class, 'show'])->name('products.show');
    //get modal validation
    Route::post('products/create/modal_value', [ProductController::class, 'getModalValue'])->name('getModalValue');
    //sale routes
    Route::resource('sales', SaleController::class)->except('show');
    //get sale's product values
    Route::get('sales/create/product_field', [SaleController::class, 'getSalesField'])->name('getSalesField');
    //check sale's product quantity
    Route::get('sales/create/check_product_quantity', [SaleController::class, 'checkProductQuantity'])
        ->name('checkProductQuantity');
    //print last sale data
    Route::get('sales/create/print', [SaleController::class, 'printLastSale'])->name('printLastSale');
    //debt routes
    Route::resource('debts', DebtController::class)->except('show');
    //debt show function
    Route::get('debts/{debt}/{notification_id}', [DebtController::class, 'show'])->name('debts.show');
});
