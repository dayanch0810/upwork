<?php

require 'web/admin.php';
require 'web/client.php';
require 'web/freelancer.php';

use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest.redirect')
    ->name('home')
    ->get('/', [HomeController::class, 'index']);

Route::get('/login/select', function () {
    return view('login_select');
})->name('login.select');
