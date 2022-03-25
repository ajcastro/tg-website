<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Website\DepositController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\WithdrawController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('landing');

Route::post('/deposit', [DepositController::class, 'deposit'])->name('deposit');
Route::post('/withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw');
Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile.get');
Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

Auth::routes();

Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
