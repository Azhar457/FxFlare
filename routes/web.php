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
Route::get('/news/{post:slug}', [NewsController::class, 'show'])->name('news.show');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', \App\Http\Controllers\PostController::class);
});

Route::get('/home', function () {
    return view('home');
})->name('home');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

// Profile Routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Market Report & PDF
Route::get('/market-report', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
Route::get('/market-report/pdf', [App\Http\Controllers\ReportController::class, 'generatePdf'])->name('reports.pdf');
