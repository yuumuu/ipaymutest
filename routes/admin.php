<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

Route::prefix('admin/')->middleware(['admin', 'auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class);
});