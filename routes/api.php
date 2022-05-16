<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:members')->get('/user', function (Request $request) {
    /** @var \App\Models\Member */
    $member = $request->user();

    return $member->only([
        'id', 'username',
    ]) + [
        'website' => $member->website->only(['id', 'code']),
    ];
});
