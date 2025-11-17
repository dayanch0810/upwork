<?php

use App\Http\Controllers\Web\Freelancer\AuthController;
use App\Http\Controllers\Web\Freelancer\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->middleware('guest:freelancer_web')
    ->prefix('freelancer')
    ->name('freelancer.')
    ->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('verify', 'verify')->name('verify');
        Route::post('confirm', 'confirm')->name('confirm');
        Route::post('login', 'store');
    });
Route::middleware('auth:freelancer_web')
    ->prefix('freelancer')
    ->name('freelancer.')
    ->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('home', [HomeController::class, 'index'])->name('home');
    });
