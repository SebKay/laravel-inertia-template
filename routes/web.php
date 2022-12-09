<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    /**
     * Register
     */
    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'show')->name('register');
        Route::post('register', 'store')->name('register.store');
    });
});

Route::middleware('guest')->group(function () {
    /**
     * Login
     */
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'show')->name('login');
        Route::post('login', 'store')->name('login.store');
    });
});

Route::middleware(['auth'])->group(function () {
    /**
     * Logout
     */
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});


Route::middleware('auth')->group(function () {
    /**
     * Home
     */
    Route::get('/', [HomeController::class, 'index'])->name('home');
});


Route::middleware('auth')->group(function () {
    /**
     * Account
     */
    Route::prefix('account')->group(function () {
        Route::controller(AccountController::class)->group(function () {
            Route::get('', 'edit')->name('account.edit');
            Route::patch('', 'update')->name('account.update');
        });
    });
});
