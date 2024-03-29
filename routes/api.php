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

    Route::post('password/forget', [\App\Http\Controllers\Api\v1\Auth\ForgotPasswordController::class, 'forget']);
    Route::post('password/reset', [\App\Http\Controllers\Api\v1\Auth\ResetPasswordController::class, 'reset']);

    Route::middleware('auth:api')->group(function() {
        Route::post('password-change', [\App\Http\Controllers\Api\v1\Auth\ChangePasswordController::class, 'changePassword']);

        Route::get('transactions', [\App\Http\Controllers\Api\v1\TransactionController::class, 'index']);
        Route::get('transaction-types', [\App\Http\Controllers\Api\v1\TransactionTypeController::class, 'index']);

        Route::post('/support-tasks', [\App\Http\Controllers\Api\v1\SupportTaskController::class, 'store']);

        Route::get('/user', [\App\Http\Controllers\Api\v1\UserController::class, 'user']);
        Route::put('/user', [\App\Http\Controllers\Api\v1\UserController::class, 'update']);
        Route::delete('/user', [\App\Http\Controllers\Api\v1\UserController::class, 'destroy']);
        Route::get('/user/statistic', [\App\Http\Controllers\Api\v1\UserController::class, 'stats']);
//        Route::get('/users', [\App\Http\Controllers\Api\v1\UserController::class, 'users']);

        Route::get('deposits', [\App\Http\Controllers\Api\v1\DepositController::class, 'index']);

        Route::get('wallets', [\App\Http\Controllers\Api\v1\WalletController::class, 'index']);
        Route::put('wallets/{wallet_id}', [\App\Http\Controllers\Api\v1\WalletController::class, 'update']);
        Route::get('wallets/{wallet_id}/currency-rates', [\App\Http\Controllers\Api\v1\WalletController::class, 'currencyRate']);

        Route::get('graphs/sprint-token', [\App\Http\Controllers\Api\v1\GraphController::class, 'sprintToken']);
        Route::get('graphs/transactions', [\App\Http\Controllers\Api\v1\GraphController::class, 'transactions']);

        Route::get('news', [\App\Http\Controllers\Api\v1\NewsController::class, 'index']);
        Route::get('news/{id}', [\App\Http\Controllers\NewsController::class, 'show']);

        Route::get('ref-link', [\App\Http\Controllers\Api\v1\ReferralController::class, 'makeLink']);
        Route::get('referrals/referrals-list', [\App\Http\Controllers\Api\v1\ReferralController::class, 'referralsList']);
    });
});
