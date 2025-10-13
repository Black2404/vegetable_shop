<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FeedBackController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AdminFeedbackController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\AdminProductController;
use App\Http\Controllers\Api\AdminOrderController;
use App\Http\Controllers\Api\ChatbotController;

// Feedback
Route::post('/feedback', [FeedBackController::class, 'store']);

// List product
Route::get('/products', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/home', [AuthController::class, 'home']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// List review product
Route::get('/products/{product}/reviews', [ReviewController::class, 'index']);

//User
Route::middleware('auth:sanctum')->group(function () {
    // Authen
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //Cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::put('/cart/update/{id}', [CartController::class, 'updateItem']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);

    //Reviews
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);

    //Order
    Route::post('/cart/checkout', [CartController::class, 'checkout']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);

    //Profile
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::post('/profile/update', [ProfileController::class, 'updateProfile']);
});

// Admin
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    // Quản lý người dùng
    Route::get('users', [AdminUserController::class, 'index']);
        // Danh sách
    Route::post('users', [AdminUserController::class, 'store']);
        // Xóa
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy']);
        // Lấy thông tin 1 người dùng (cho trang edit)
    Route::get('/users/{id}', [AdminUserController::class, 'show']);
        // Cập nhật người dùng
    Route::put('/users/{id}', [AdminUserController::class, 'update']);


    // Quản lý sản phẩm
    Route::get('/products', [AdminProductController::class, 'index']);
    Route::post('/products', [AdminProductController::class, 'store']);
    Route::get('/products/{id}', [AdminProductController::class, 'show']);
    Route::put('/products/{id}', [AdminProductController::class, 'update']);
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy']);

    // // Quản lý đơn hàng
    Route::get('/orders', [AdminOrderController::class, 'index']);
    Route::get('/orders/{id}', [AdminOrderController::class, 'show']);
    Route::put('/orders/{id}', [AdminOrderController::class, 'update']);
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy']);

    // // Quản lý phản hồi
    Route::get('/feedbacks', [FeedbackController::class, 'apiIndex']);
    Route::delete('/feedbacks/{id}', [FeedbackController::class, 'apiDestroy']);
});

// Chatbot
Route::post('/chat', [ChatbotController::class, 'chat']);

