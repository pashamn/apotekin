<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Authentication routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'level:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('produk', [DashboardController::class, 'produk'])->name('admin.produk');
    Route::get('orders', [DashboardController::class, 'orders'])->name('admin.orders');
    Route::get('users', [DashboardController::class, 'users'])->name('admin.users');
    Route::get('order', [DashboardController::class, 'order'])->name('admin.order');
    Route::get('categories', [DashboardController::class, 'categories'])->name('admin.categories');
    Route::get('analis', [DashboardController::class, 'analis'])->name('admin.analis');
    Route::get('seting', [DashboardController::class, 'seting'])->name('admin.seting');
});