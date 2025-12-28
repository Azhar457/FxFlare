<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Dashboard\PostController;
use App\Http\Controllers\Api\Dashboard\CategoryController;
use App\Http\Controllers\Api\Dashboard\TagController;

Route::middleware(['web', 'auth', 'admin'])
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/posts/{post}', [PostController::class, 'show']);
    });

Route::middleware(['web', 'auth', 'admin'])->prefix('dashboard')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
});

Route::middleware(['web', 'auth', 'admin'])->prefix('dashboard')->group(function () {
    Route::get('/tags', [TagController::class, 'index']);
});

Route::middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

