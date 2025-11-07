<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthPageController;
use App\Http\Controllers\Web\ProductPageController;
use App\Http\Controllers\Web\CartPageController;
use App\Http\Controllers\Web\OrderPageController;
use App\Http\Controllers\Web\ReviewPageController;
use App\Http\Controllers\Web\ProfilePageController;
use App\Http\Controllers\Web\FeedBackPageController;
use App\Http\Controllers\Web\AdminPageController;
use App\Http\Controllers\Web\AdminUserPageController;
use App\Http\Controllers\Web\AdminProductPageController;
use App\Http\Controllers\Web\AdminOrderPageController;
use App\Http\Controllers\Web\AdminFeedbackPageController;
use App\Http\Controllers\Web\ChatbotPageController;
use App\Http\Controllers\Api\ChatbotController;

// Home user
Route::get('/', [AuthPageController::class, 'home'])->name('home');

// Home admin
Route::get('/dashboard', [AuthPageController::class, 'index'])->name('admin.dashboard');


// Authen
Route::get('/register', [AuthPageController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthPageController::class, 'register'])->name('register');
Route::get('/login', [AuthPageController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthPageController::class, 'login'])->name('login');
Route::post('/logout', [AuthPageController::class, 'logout'])->name('logout');

// List product
Route::get('/products', [ProductPageController::class, 'index']);
Route::get('/product/{id}', [ProductPageController::class, 'show']);

// Cart
Route::get('/cart', [CartPageController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartPageController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartPageController::class, 'remove'])->name('cart.remove');
Route::put('/update/{id}', [CartPageController::class, 'update'])->name('cart.update');

// Review
Route::post('/products/{product}/reviews', [ReviewPageController::class, 'store'])->name('reviews.store');
Route::delete('/reviews/{review}', [ReviewPageController::class, 'destroy'])->name('reviews.destroy');

// Checkout
Route::post('/cart/checkout', [CartPageController::class, 'checkout'])->name('cart.checkout');
Route::get('/orders', [OrderPageController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderPageController::class, 'show'])->name('orders.show');

// Profile
Route::get('/profile', [ProfilePageController::class, 'showProfile'])->name('profile.show');
Route::post('/profile/update', [ProfilePageController::class, 'updateProfile'])->name('profile.update');

// Feedback
Route::post('/feedback', [FeedBackPageController::class, 'store'])->name('feedback.store');

// Admin
Route::get('/dashboard', [AdminPageController::class, 'index'])->name('admin.dashboard');
    // Admin.users
Route::get('/admin/users', [AdminUserPageController::class, 'index'])->name('admin.users');
Route::post('/admin/users/store', [AdminUserPageController::class, 'store'])->name('admin.users.store');
Route::delete('/admin/users/delete/{id}', [AdminUserPageController::class, 'delete'])->name('admin.users.delete');
Route::get('/users/{id}/edit', [AdminUserPageController::class, 'edit'])->name('admin.users.edit');
Route::put('/users/{id}', [AdminUserPageController::class, 'update'])->name('admin.users.update');
    // Admin.products
Route::get('admin/products', [AdminProductPageController::class, 'index'])->name('admin.products');
Route::post('admin/products/store', [AdminProductPageController::class, 'store'])->name('admin.products.store');
Route::get('products/edit/{id}', [AdminProductPageController::class, 'edit'])->name('admin.products.edit');
Route::put('products/update/{id}', [AdminProductPageController::class, 'update'])->name('admin.products.update');
Route::delete('admin/products/delete/{id}', [AdminProductPageController::class, 'destroy'])->name('admin.products.delete');
    // Admin.orders
Route::get('admin/orders', [AdminOrderPageController::class, 'index'])->name('admin.orders');
Route::get('/orders/{id}/edit', [AdminOrderPageController::class, 'edit'])->name('admin.orders.edit');
Route::put('/orders/{id}', [AdminOrderPageController::class, 'update'])->name('admin.orders.update');
Route::delete('admin/orders/{id}', [AdminOrderPageController::class, 'destroy'])->name('admin.orders.delete');
    //Admin.feedbacks
Route::get('admin/feedbacks', [AdminFeedbackPageController::class, 'index'])->name('admin.feedbacks');
Route::delete('/feedbacks/{id}', [AdminFeedbackPageController::class, 'destroy'])->name('admin.destroy');

// Chatbot
Route::get('/chatbot', [ChatbotPageController::class, 'index']);
