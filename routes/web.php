<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLogin'])->name('showLogin');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth:admin')
    ->get('/logout', [LoginController::class, 'logout'])->name('logout');
