<?php

use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\RegisterController::class)
    ->middleware(['guest'])
    ->group(function () {
        Route::get('register', 'show')->name('register');
        Route::post('register', 'store')->name('register.store');
    });

Route::controller(App\Http\Controllers\LoginController::class)
    ->middleware(['guest'])
    ->group(function () {
        Route::get('login', 'show')->name('login');
        Route::post('login', 'store')->name('login.store');
    });

Route::controller(App\Http\Controllers\LoginController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::post('logout', 'destroy')->name('logout');
    });

Route::controller(App\Http\Controllers\HomeController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')->name('home');
    });

Route::controller(App\Http\Controllers\AccountController::class)
    ->prefix('account')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('', 'edit')->name('account.edit');
        Route::patch('', 'update')->name('account.update');
    });
