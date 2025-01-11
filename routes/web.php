<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;



// Authentication routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
// Route::middleware(['auth', 'level:admin'])->prefix('admin')->group(function () {
//     Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
//     Route::get('produk', [DashboardController::class, 'produk'])->name('admin.produk');
//     Route::get('orders', [DashboardController::class, 'orders'])->name('admin.orders');
//     Route::get('users', [DashboardController::class, 'users'])->name('admin.users');
//     Route::resource('users', UserController::class);
// });

Route::middleware(['auth', 'level:admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Users
    Route::get('users', [UserController::class, 'index'])->name('admin.user');
    // Route::resource('users', UserController::class)->except(['index']);
    
    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories');
    // Route::resource('categories', CategoryController::class)->except(['index']);
    
    // Products
    Route::resource('admin/produk', ProductController::class)->names('admin.produk');
    Route::get('products', [ProductController::class, 'index'])->name('admin.produk');
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.produk.create');
    Route::post('products', [ProductController::class, 'store'])->name('admin.produk.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.produk.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.produk.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('admin.produk.destroy');
    
    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('admin.order');
    // Route::resource('orders', OrderController::class)->except(['index']);
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('admin.analis');
    
    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('admin.seting');
    

});