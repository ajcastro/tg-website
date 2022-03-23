<?php

use App\Http\Controllers\Website\DepositController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\Website\BanksController;
use App\Http\Controllers\Website\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('landing');

Route::get('/deposit', [DepositController::class, 'index'])->name('deposit');
Route::get('/banks', [BanksController::class, 'index'])->name('banks');

include __DIR__.'/web-vuexy.php';

Auth::routes();

Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
