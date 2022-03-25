<?php

use App\Http\Controllers\Website\DepositController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\Website\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('landing');

Route::post('/deposit', [DepositController::class, 'deposit'])->name('deposit');

Auth::routes();

Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
