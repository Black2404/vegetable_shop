<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatbotController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Trang sản phẩm + tìm kiếm
Route::get('/products', [ProductController::class, 'index'])->name('products.search');

// Đăng nhập và đăng ký
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Thông tin cá nhân
Route::get('/profile', function () {
    return view('user.profile');
})->middleware('auth')->name('profile');

Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

// Giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Xem chi tiết
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product');
Route::post('/product/{id}/review', [ReviewController::class, 'submit'])->name('review.submit');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('review.delete');

// Thanh toán
Route::get('/payment-success', [CartController::class, 'paymentSuccess'])->name('payment.success');

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Products
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    // Orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('orders/{order}/edit', [AdminController::class, 'editOrder'])->name('admin.orders.edit');
    Route::put('orders/{order}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
    Route::delete('orders/{order}', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');


});

Route::get('/chatbot', function () {
    return view('chat'); // resources/views/chat.blade.php
});

// API chatbot
Route::post('/chatbot', [ChatbotController::class, 'chat']);

