<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'show')->name('login');
        Route::post('login', 'store')->name('login.store');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'show')->name('register');
        Route::post('register', 'store')->name('register.store');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
