<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Auth::routes();
Route::get('/', [LoginController::class, 'redirect'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

require __DIR__ . '/sales.php';

require __DIR__ . '/sales_manager.php';
