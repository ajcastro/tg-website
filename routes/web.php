<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Website\ChangePasswordController;
use App\Http\Controllers\Website\DepositController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\MemberBankController;
use App\Http\Controllers\Website\PageContentController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\TransactionController;
use App\Http\Controllers\Website\WithdrawController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('landing');

Route::middleware(['auth'])->group(function () {
    Route::post('/deposit', [DepositController::class, 'deposit'])->name('deposit');
    Route::post('/withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw');
    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile.get');
    Route::get('/balance', [ProfileController::class, 'getCurrentBalance'])->name('profile.current_balance');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::get('/transactions', [TransactionController::class, 'listTransactions'])->name('transactions.list');
    Route::post('/change_password', [ChangePasswordController::class, 'changePassword'])->name('change_password');
    Route::get('/member_banks', [MemberBankController::class, 'index'])->name('member_banks.index');
    Route::post('/member_banks', [MemberBankController::class, 'store'])->name('member_banks.store');
});

Auth::routes();
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');

Route::get('/{any}', [PageContentController::class, 'renderPage'])->where('any', '.*');
