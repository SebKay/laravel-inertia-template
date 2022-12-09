<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/**
 * Register
 */
Route::middleware('guest')->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'show')->name('register');
        Route::post('register', 'store')->name('register.store');
    });
});

/**
 * Login
 */
Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'show')->name('login');
        Route::post('login', 'store')->name('login.store');
    });
});

/**
 * Logout
 */
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

/**
 * Home
 */
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

/**
 * Account
 */
Route::middleware('auth')->group(function () {
    Route::prefix('account')->group(function () {
        Route::controller(AccountController::class)->group(function () {
            Route::get('', 'edit')->name('account.edit');
            Route::patch('', 'update')->name('account.update');
        });
    });
});
