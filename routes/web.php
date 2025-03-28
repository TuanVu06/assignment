<?php

use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// Route cho dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth')->name('dashboard');
