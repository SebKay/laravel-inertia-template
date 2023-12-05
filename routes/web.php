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

Route::post('logout', App\Http\Controllers\LogoutController::class)
    ->middleware(['auth'])
    ->name('logout');

Route::controller(App\Http\Controllers\HomeController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('home');
    });

Route::controller(App\Http\Controllers\AccountController::class)
    ->prefix('account')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', 'edit')->name('account.edit');
        Route::patch('', 'update')->name('account.update');
    });

Route::controller(App\Http\Controllers\EmailVerificationController::class)
    ->prefix('account')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('verify', 'show')->name('verification.notice');
    });

Route::controller(App\Http\Controllers\OrganisationController::class)
    ->prefix('organisation')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', 'edit')->name('organisation.edit');
        Route::patch('', 'update')->name('organisation.update');
    });
