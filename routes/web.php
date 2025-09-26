<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::prefix('login')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('Auth/Login/Index');
    Route::post('/', [AuthController::class, 'store'])->name('Auth/Login/Store');
});
