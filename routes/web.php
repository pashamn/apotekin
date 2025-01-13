<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Authentication routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'level:admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Users
    Route::get('users', [UserController::class, 'index'])->name('admin.user');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    // Categories
    Route::get('categories', [CategoriesController::class, 'index'])->name('admin.categories');
    Route::get('categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{category}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/{category}', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{category}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');

    
    // Products
    Route::get('products', [ProductController::class, 'index'])->name('admin.produk');
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.produk.create');
    Route::post('products', [ProductController::class, 'store'])->name('admin.produk.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.produk.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.produk.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('admin.produk.destroy');
    
    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('admin.order');
    Route::resource('orders', OrderController::class)->except(['index']);
    
    // Analytics
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('admin.analis');
    
    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('admin.seting');
});