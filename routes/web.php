<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\PageController;

// Frontend Routes
Route::name('home')->get('/', [HomeController::class, 'index']);
Route::name('about')->get('/about-us', [PageController::class, 'about']);
Route::name('contact')->get('/contact-us', [PageController::class, 'contact']);
Route::name('terms')->get('/terms-of-service', [PageController::class, 'terms']);
Route::name('products.index')->get('/products', [FrontendProductController::class, 'index']);
Route::name('products.show')->get('/products/{slug}', [FrontendProductController::class, 'show']);
Route::name('cart.index')->get('/cart', [CartController::class, 'index']);
Route::name('cart.add')->post('/cart/add', [CartController::class, 'add']);
Route::name('cart.remove')->post('/cart/remove', [CartController::class, 'remove']);
Route::name('cart.update')->post('/cart/update', [CartController::class, 'update']);

// Frontend Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [App\Http\Controllers\Frontend\AuthController::class, 'login'])->name('login');
    Route::post('login', [App\Http\Controllers\Frontend\AuthController::class, 'authenticate']);
    Route::get('register', [App\Http\Controllers\Frontend\AuthController::class, 'register'])->name('register');
    Route::post('register', [App\Http\Controllers\Frontend\AuthController::class, 'store']);
});

Route::post('logout', [App\Http\Controllers\Frontend\AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::name('checkout.index')->get('/checkout', [CheckoutController::class, 'index']);
    Route::name('checkout.store')->post('/checkout', [CheckoutController::class, 'store']);
    Route::name('checkout.success')->get('/checkout/success/{order}', [CheckoutController::class, 'success']);

    Route::name('user.dashboard')->get('/my-account', [UserController::class, 'index']);
    Route::name('user.orders')->get('/my-orders', [UserController::class, 'orders']);
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
    });

    // Authenticated Admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('banners', BannerController::class);
    });
});
