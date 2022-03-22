<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\Website\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('landing');

include __DIR__.'/web-vuexy.php';

Auth::routes();

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
