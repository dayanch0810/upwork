<?php

use App\Http\Controllers\Web\Client\AuthController;
use App\Http\Controllers\Web\Client\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->middleware('guest:client_web')
    ->prefix('client')
    ->name('client.')
    ->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('verify', [AuthController::class, 'verify'])->name('verify');
        Route::post('confirm', [AuthController::class, 'confirm'])->name('confirm');
        Route::post('login', [AuthController::class, 'store']);
    });

Route::middleware('auth:client_web')
    ->prefix('client')
    ->name('client.')
    ->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('home', [HomeController::class, 'index'])->name('home');
    });
