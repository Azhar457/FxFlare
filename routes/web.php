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

// Global Search
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');

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
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');
    Route::resource('users', UserController::class);
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});

// Authorized Helper Routes
Route::middleware(['auth'])->group(function() {
    Route::post('/posts/{post:slug}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post:slug}/like', [App\Http\Controllers\LikeController::class, 'toggle'])->name('likes.toggle');
});



// Profile Routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Watchlist Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/watchlist', [App\Http\Controllers\WatchlistController::class, 'index'])->name('watchlist.index');
    Route::post('/watchlist', [App\Http\Controllers\WatchlistController::class, 'store'])->name('watchlist.store');
    Route::delete('/watchlist/{asset}', [App\Http\Controllers\WatchlistController::class, 'destroy'])->name('watchlist.destroy');
    
    // Asset Details
    Route::get('/assets/{asset:symbol}', [App\Http\Controllers\AssetController::class, 'show'])->name('assets.show');
    
    // Price Alerts
    Route::post('/price-alerts', [App\Http\Controllers\PriceAlertController::class, 'store'])->name('price-alerts.store');
    Route::delete('/price-alerts/{priceAlert}', [App\Http\Controllers\PriceAlertController::class, 'destroy'])->name('price-alerts.destroy');
});

// Market Report & PDF
Route::get('/market-report', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
Route::get('/market-report/pdf', [App\Http\Controllers\ReportController::class, 'generatePdf'])->name('reports.pdf');
