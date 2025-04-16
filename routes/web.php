<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PasswordResetCodeController;
use App\Http\Controllers\PostController;

// Home
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/category/{type}', [PostController::class, 'getByType'])->name('category.show');


// Route::get('/news', [PostController::class, 'index'])->name('home');

// Routes cho đăng nhập và đăng ký
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Quên mật khẩu
Route::get('/forgot-password', [PasswordResetCodeController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetCodeController::class, 'sendResetCode'])->name('password.code.send');
Route::get('/enter-code', [PasswordResetCodeController::class, 'showCodeForm'])->name('password.code.form');
Route::post('/enter-code', [PasswordResetCodeController::class, 'verifyCode'])->name('password.code.verify');
Route::get('/new-password', [PasswordResetCodeController::class, 'showNewPasswordForm'])->name('password.new.form');
Route::post('/new-password', [PasswordResetCodeController::class, 'resetPassword'])->name('password.new.reset');

// Feedback
Route::post('/send-feedback', [FeedbackController::class, 'sendFeedback'])->name('send.feedback');

// --- Admin ---
Route::prefix('/admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Main
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes cho CategoryController
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Routes cho PostController
    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [AdminPostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [AdminPostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
    Route::get('posts/trashed', [AdminPostController::class, 'trashed'])->name('posts.trashed');
    Route::post('posts/{id}/restore', [AdminPostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/{id}/force-delete', [AdminPostController::class, 'forceDelete'])->name('posts.forceDelete');

});
