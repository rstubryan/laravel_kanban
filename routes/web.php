<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware('guest')->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', [AuthController::class, 'index'])->name('login');
        Route::post('/', [AuthController::class, 'login'])->name('login.store');
    });

    Route::prefix('register')->group(function () {
        Route::get('/', [AuthController::class, 'index'])->name('register');
        Route::post('/', [AuthController::class, 'register'])->name('register.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::delete('/auth/logout', [AuthController::class, 'destroy'])->name('auth.logout');
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });
});
