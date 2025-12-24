<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('home');
});

Route::get('/news', [NewsController::class, 'index'])->name('news.index');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

// Profile Routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
