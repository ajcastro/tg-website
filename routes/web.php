<?php

use App\Http\Controllers\Website\DepositController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\Website\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('landing');

Route::get('/deposit', [DepositController::class, 'index'])->name('deposit');
