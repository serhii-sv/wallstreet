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

Route::group([
    'prefix' => 'v1',
    'as' => 'api.',
    'namespace' => 'Api\v1',
], function () {
    Route::post('login', [\App\Http\Controllers\Api\v1\Auth\LoginController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\Api\v1\Auth\RegisterController::class, 'register']);

    Route::middleware('auth:api')->group(function() {

    });
});
