<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('user/')->middleware(['user', 'auth'])->name('user.')->group(function () {
    Route::resource('products', ProductController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);

    Route::resource('transactions', TransactionController::class);
});