<?php

use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\Website\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('landing');
