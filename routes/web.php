<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DetailOrderController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CartController;


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/category/{id}', [CategoriesController::class, 'show'])->name('category.products');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/product/{id}', [HomeController::class, 'showProduct'])->name('product.show');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view')->middleware('auth');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');


// Authentication routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// Route::middleware('auth')->group(function () {

// });
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
    Route::get('products/{product}', [ProductController::class, 'show'])->name('admin.produk.show');// perbaikan di sini

        
    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('admin.order');
    Route::resource('orders', OrderController::class)->except(['index']);
    Route::get('/admin/order/{id}', [DetailOrderController::class, 'show'])->name('admin.order.show');
    
    // Prescriptions
    Route::get('prescriptions', [PrescriptionController::class, 'index'])->name('admin.prescriptions');
    Route::get('prescriptions/create', [PrescriptionController::class, 'create'])->name('admin.prescriptions.create');
    Route::post('prescriptions', [PrescriptionController::class, 'store'])->name('admin.prescriptions.store');
    Route::get('prescriptions/{prescription}', [PrescriptionController::class, 'show'])->name('admin.prescriptions.show');
    Route::get('prescriptions/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('admin.prescriptions.edit');
    Route::put('prescriptions/{prescription}', [PrescriptionController::class, 'update'])->name('admin.prescriptions.update');
    Route::delete('prescriptions/{prescription}', [PrescriptionController::class, 'destroy'])->name('admin.prescriptions.destroy');
    
    //chart
    
    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('admin.seting');
});