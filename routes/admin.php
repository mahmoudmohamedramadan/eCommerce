<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\AdminController;
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
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //category routes
    Route::resource('admin', AdminController::class)->except(['index', 'create', 'store', 'show', 'destroy']);
    //worker routes
    Route::resource('workers', WorkerController::class)->except('show');
    //category routes
    Route::resource('categories', CategoryController::class)->except('show');
    //company routes
    Route::resource('companies', CompanyController::class)->except('show');
    //product routes
    Route::resource('products', ProductController::class)->except('show');
    //get modal validation
    Route::post('products/create/modal_value', [ProductController::class, 'getModalValue'])->name('getModalValue');
    //store routes
    Route::resource('stores', StoreController::class)->except('show');
    //sale routes
    Route::resource('sales', SaleController::class)->except('show');
    //get sale's product values
    Route::get('sales/create/product_field', [SaleController::class, 'getSalesField'])->name('getSalesField');
    //get sale's product values
    Route::get('sales/create/check_product_quantity', [SaleController::class, 'checkProductQuantity'])
        ->name('checkProductQuantity');
    //print last sale data
    Route::get('sales/create/print', [SaleController::class, 'printLastSale'])->name('printLastSale');
    //debt routes
    Route::resource('debts', DebtController::class)->except('show');
    //debt show function
    Route::get('debts/{debt}/{notification_id}', [DebtController::class, 'show'])->name('debts.show');
    //debt notifications
    Route::get('debts/getNotifications', [DebtController::class, 'pushNotifications'])->name('pushNotifications');
    //read all debt notifications
    Route::get('debts/readAllNotifications', [DebtController::class, 'readAllNotifications'])->name('readAllNotifications');
});
