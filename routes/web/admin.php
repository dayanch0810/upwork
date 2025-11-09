<?php

use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Admin\AuthAttemptController;
use App\Http\Controllers\Web\Admin\AuthController;
use App\Http\Controllers\Web\Admin\ClientController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\FreelancerController;
use App\Http\Controllers\Web\Admin\IpAddressController;
use App\Http\Controllers\Web\Admin\LocationController;
use App\Http\Controllers\Web\Admin\ProfileController;
use App\Http\Controllers\Web\Admin\ProposalController;
use App\Http\Controllers\Web\Admin\ReviewController;
use App\Http\Controllers\Web\Admin\SkillController;
use App\Http\Controllers\Web\Admin\UserAgentController;
use App\Http\Controllers\Web\Admin\VerificationController;
use App\Http\Controllers\Web\Admin\VisitorController;
use App\Http\Controllers\Web\Admin\WorkController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->middleware('guest')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store');
        Route::post('logout', 'destroy')->name('logout')->middleware('auth');
    });

Route::middleware('auth')
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::controller(AdminController::class)
            ->prefix('admins')
            ->name('admins.')
            ->group(function () {
                Route::get('', 'index')->name('index');
            });

        Route::controller(ClientController::class)
            ->prefix('clients')
            ->name('clients.')
            ->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('{id}', 'show')->name('show')->where(['id' => '[0-9]+']);
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{id}/edit', 'edit')->name('edit')->where(['id' => '[0-9]+']);
                Route::put('{id}', 'update')->name('update')->where(['id' => '[0-9]+']);
                Route::delete('{id}', 'destroy')->name('destroy')->where(['id' => '[0-9]+']);
            });

        Route::controller(FreelancerController::class)
            ->prefix('freelancers')
            ->name('freelancers.')
            ->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('{id}', 'show')->name('show')->where(['id' => '[0-9]+']);
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{id}/edit', 'edit')->name('edit')->where(['id' => '[0-9]+']);
                Route::put('{id}', 'update')->name('update')->where(['id' => '[0-9]+']);
                Route::delete('{id}', 'destroy')->name('destroy')->where(['id' => '[0-9]+']);
            });

        Route::controller(ProfileController::class)
            ->prefix('profiles')
            ->name('profiles.')
            ->group(function () {
                Route::get('create/{freelancer_id}', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{id}/edit/{freelancer_id}', 'edit')->name('edit')->where(['id' => '[0-9]+']);
                Route::put('{id}', 'update')->name('update')->where(['id' => '[0-9]+']);
                Route::delete('{id}', 'destroy')->name('destroy')->where(['id' => '[0-9]+']);
            });

        Route::controller(IpAddressController::class)
            ->prefix('ipAddress')
            ->name('ipAddress.')
            ->group(function () {
                Route::get('', 'index')->name('index');
            });

        Route::controller(UserAgentController::class)
            ->prefix('userAgents')
            ->name('userAgents.')
            ->group(function () {
                Route::get('', 'index')->name('index');
            });

        Route::controller(AuthAttemptController::class)
            ->prefix('authAttempts')
            ->name('authAttempts.')
            ->group(function () {
                Route::get('', 'index')->name('index');
            });

        Route::controller(VisitorController::class)
            ->prefix('visitors')
            ->name('visitors.')
            ->group(function () {
                Route::get('', 'index')->name('index');
            });

        Route::controller(SkillController::class)
            ->prefix('skills')
            ->name('skills.')
            ->group(function () {
                Route::get('', 'index')->name('index');
            });

        Route::controller(LocationController::class)
            ->prefix('locations')
            ->name('locations.')
            ->group(function () {
                Route::get('', 'index')->name('index');
            });

        Route::controller(VerificationController::class)
            ->prefix('verifications')
            ->name('verifications.')
            ->group(function () {
                Route::get('', 'index')->name('index');
            });

        Route::controller(ReviewController::class)
            ->prefix('reviews')
            ->name('reviews.')
            ->group(function () {
                Route::get('', 'index')->name('index');
            });

        Route::controller(WorkController::class)
            ->prefix('works')
            ->name('works.')
            ->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('{id}', 'show')->name('show')->where(['id' => '[0-9]+']);
                Route::get('{id}/edit', 'edit')->name('edit')->where(['id' => '[0-9]+']);
                Route::put('{id}', 'update')->name('update')->where(['id' => '[0-9]+']);
                Route::delete('{id}', 'destroy')->name('destroy')->where(['id' => '[0-9]+']);
            });
    });
