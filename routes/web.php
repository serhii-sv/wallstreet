<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

//use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    Auth::routes();

    Route::group(['middleware' => ['auth']], function () {
        Route::group(['middleware' => ['role:root|admin']], function () {
            Route::post('/ajax/search-users', [\App\Http\Controllers\Admin\Ajax\SearchUserController::class, 'search'])->name('ajax.search.users');

            Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');
            Route::post('/dashboard/user/bonus', [\App\Http\Controllers\Admin\DashboardController::class, 'addUserBonus'])->name('admin.dashboard.add.bonus');

            Route::get('/impersonate/{id}', [\App\Http\Controllers\Admin\ImpersonateController::class, 'impersonate'])->name('admin.impersonate');

            Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings.index');
            Route::get('/settings/switch_site_status', [\App\Http\Controllers\Admin\SettingsController::class, 'switchSiteStatus'])->name('admin.settings.switchSiteStatus');
            Route::post('/settings/change-many', [\App\Http\Controllers\Admin\SettingsController::class, 'changeMany'])->name('admin.settings.change-many');

            Route::get('/deposits/block/{deposit}', [\App\Http\Controllers\Admin\DepositController::class, 'block'])->name('admin.deposits.block');
            Route::get('/deposits/unblock/{deposit}', [\App\Http\Controllers\Admin\DepositController::class, 'unblock'])->name('admin.deposits.unblock');
            Route::get('/deposits/dtdata', [\App\Http\Controllers\Admin\DepositController::class, 'dataTable'])->name('admin.deposits.dtdata');
            Route::resource('/deposits', \App\Http\Controllers\Admin\DepositController::class, [
                'names' => [
                    'index' => 'admin.deposits.index',
                    'show' => 'admin.deposits.show',
                ],
            ]);

            Route::get('/requests/approve/{id}', [\App\Http\Controllers\Admin\WithdrawalRequestsController::class, 'approve'])->name('admin.requests.approve');
            Route::post('/requests/approve-many', [\App\Http\Controllers\Admin\WithdrawalRequestsController::class, 'approveMany'])->name('admin.requests.approve-many');
            Route::get('/requests/reject/{id}', [\App\Http\Controllers\Admin\WithdrawalRequestsController::class, 'reject'])->name('admin.requests.reject');
            Route::get('/requests/approveManually/{id}', [\App\Http\Controllers\Admin\WithdrawalRequestsController::class, 'approveManually'])->name('admin.requests.approveManually');
            Route::get('/requests/dtdata', [\App\Http\Controllers\Admin\WithdrawalRequestsController::class, 'dataTable'])->name('admin.requests.dtdata');
            Route::resource('/requests', \App\Http\Controllers\Admin\WithdrawalRequestsController::class, [
                'names' => [
                    'index' => 'admin.requests.index',
                    'show' => 'admin.requests.show',
                    'edit' => 'admin.requests.edit',
                    'update' => 'admin.requests.update',
                ],
            ]);

            Route::get('/transactions/dtdata', [\App\Http\Controllers\Admin\TransactionsController::class, 'dataTable'])->name('admin.transactions.dtdata');
            Route::resource('/transactions', \App\Http\Controllers\Admin\TransactionsController::class, [
                'names' => [
                    'index' => 'admin.transactions.index',
                    'show' => 'admin.transactions.show',
                ],
            ]);

            Route::resource('/langs', \App\Http\Controllers\Admin\LanguagesController::class, [
                'names' => [
                    'index' => 'admin.langs.index',
                    'create' => 'admin.langs.create',
                    'store' => 'admin.langs.store',
                    'edit' => 'admin.langs.edit',
                    'update' => 'admin.langs.update',
                ],
            ]);
            Route::get('/langs/destroy/{id}', [\App\Http\Controllers\Admin\LanguagesController::class, 'destroy'])->name('admin.langs.destroy');

            Route::resource('/translations', \App\Http\Controllers\Admin\TplTranslationsController::class, [
                'names' => [
                    'index' => 'admin.tpl_texts.index',
                    'index/{category?}' => 'admin.tpl_texts.index',
                    'create' => 'admin.tpl_texts.create',
                    'store' => 'admin.tpl_texts.store',
                    'edit' => 'admin.tpl_texts.edit',
                    'update' => 'admin.tpl_texts.update',
                    'destroy' => 'admin.tpl_texts.destroy',
                ],
            ]);

            Route::resource('/currencies', \App\Http\Controllers\Admin\CurrenciesController::class, [
                'names' => [
                    'index' => 'admin.currencies.index',
                    'edit' => 'admin.currencies.edit',
                    'update' => 'admin.currencies.update',
                ],
            ]);
            Route::resource('/payment-systems', \App\Http\Controllers\Admin\PaymentSystemsController::class, [
                'names' => [
                    'index' => 'admin.payment-systems.index',
                    'edit' => 'admin.payment-systems.edit',
                    'update' => 'admin.payment-systems.update',
                ],
            ]);

            Route::resource('/news', \App\Http\Controllers\Admin\NewsController::class, [
                'names' => [
                    'index' => 'admin.news.index',
                    'create' => 'admin.news.create',
                    'store' => 'admin.news.store',
                    'edit' => 'admin.news.edit',
                    'update' => 'admin.news.update',
                    'destroy' => 'admin.news.destroy',
                ],
            ]);

            Route::resource('/reviews', \App\Http\Controllers\Admin\ReviewsController::class, [
                'names' => [
                    'index' => 'admin.reviews.index',
                    'create' => 'admin.reviews.create',
                    'store' => 'admin.reviews.store',
                    'edit' => 'admin.reviews.edit',
                    'update' => 'admin.reviews.update',
                    'destroy' => 'admin.reviews.destroy',
                ],
            ]);
            Route::resource('/faqs', \App\Http\Controllers\Admin\FaqsController::class, [
                'names' => [
                    'index' => 'admin.faqs.index',
                    'create' => 'admin.faqs.create',
                    'store' => 'admin.faqs.store',
                    'edit' => 'admin.faqs.edit',
                    'update' => 'admin.faqs.update',
                    'destroy' => 'admin.faqs.destroy',
                ],
            ]);

            Route::resource('/referral', \App\Http\Controllers\Admin\ReferralController::class, [
                'names' => [
                    'index' => 'admin.referral.index',
                    'create' => 'admin.referral.create',
                    'store' => 'admin.referral.store',
                    'edit' => 'admin.referral.edit',
                    'update' => 'admin.referral.update',
                ],
            ]);
            Route::get('/referral/destroy/{id}', [\App\Http\Controllers\Admin\ReferralController::class, 'destroy'])->name('admin.referral.destroy');

            Route::resource('/rates', 'RateController', [
                'names' => [
                    'index' => 'admin.rates.index',
                    'show' => 'admin.rates.show',
                    'create' => 'admin.rates.create',
                    'store' => 'admin.rates.store',
                    'edit' => 'admin.rates.edit',
                    'update' => 'admin.rates.update',
                ],
            ]);
            Route::get('/rates/destroy/{id}', [\App\Http\Controllers\Admin\RateController::class, 'destroy'])->name('admin.rates.destroy');

            Route::get('/users/reftree/{id}', [\App\Http\Controllers\Technical\ReftreeController::class, 'show'])->name('admin.users.reftree');
            Route::get('/users/dtdata', [\App\Http\Controllers\Admin\UsersController::class, 'dataTable'])->name('admin.users.dtdata');
            Route::get('/users/dt-transactions/{user_id}', [\App\Http\Controllers\Admin\UsersController::class, 'dataTableTransactions'])->name('admin.users.dt-transactions');
            Route::get('/users/dt-deposits/{user_id}', [\App\Http\Controllers\Admin\UsersController::class, 'dataTableDeposits'])->name('admin.users.dt-deposits');
            Route::get('/users/dt-wrs/{user_id}', [\App\Http\Controllers\Admin\UsersController::class, 'dataTableDeposits'])->name('admin.users.dt-wrs');

            Route::resource('/users', \App\Http\Controllers\Admin\UsersController::class, ['names' => [
                'index' => 'admin.users.index',
                'show' => 'admin.users.show',
                'show/{level?}{plevel?}' => 'admin.users.show',
                'edit' => 'admin.users.edit',
                'update' => 'admin.users.update',
                'destroy' => 'admin.users.destroy',
            ]]);
            Route::post('/users/{id}/update_stat', [\App\Http\Controllers\Admin\UsersController::class, 'updateStat'])->name('admin.users.update_stat');

            Route::post('/users/bonus', [\App\Http\Controllers\Admin\UsersController::class, 'bonus'])->name('admin.users.bonus');
            Route::post('/users/penalty', [\App\Http\Controllers\Admin\UsersController::class, 'penalty'])->name('admin.users.penalty');
        });

        Route::group(['middleware' => ['role:root']], function () {
            Route::get('/backup', [\App\Http\Controllers\Admin\BackupController::class, 'index'])->name('admin.backup.index');
            Route::get('/backup/backupDB', [\App\Http\Controllers\Admin\BackupController::class, 'backupDB'])->name('admin.backup.backupDB');
            Route::get('/backup/backupFiles', [\App\Http\Controllers\Admin\BackupController::class, 'backupFiles'])->name('admin.backup.backupFiles');
            Route::get('/backup/backupAll', [\App\Http\Controllers\Admin\BackupController::class, 'backupAll'])->name('admin.backup.backupAll');
            Route::get('/backup/destroy/{file}', [\App\Http\Controllers\Admin\BackupController::class, 'destroy'])->where('file', '(.*(?:%2F:)?.*)')->name('admin.backup.destroy');
            Route::post('/backup/download', [\App\Http\Controllers\Admin\BackupController::class, 'download'])->name('admin.backup.download');

            Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
        });
    });
});
