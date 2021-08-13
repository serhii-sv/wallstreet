<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

//use Illuminate\Routing\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web']], function () {
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,30');

    Route::post('/user-unlock', [UsersController::class, 'unlockUser'])->name('user.unlock');
    Route::get('/locked', [UsersController::class, 'lockedUser'])->name('user.locked');
    Route::get('/user-lock', [UsersController::class, 'lockUser'])->name('user.lock');

    Route::group(['middleware' => ['auth', 'locked.user', 'permission.check']], function () {
        Route::group(['middleware' => ['activity-log']], function () {
            Route::post('/ajax/notification/status/read', [\App\Http\Controllers\NotificationsController::class, 'setReadStatus'])->name('ajax.notification.status.read');
            Route::post('/ajax/search-users', [\App\Http\Controllers\Ajax\SearchUserController::class, 'search'])->name('ajax.search.users');
            Route::post('/ajax/get-user-email', [\App\Http\Controllers\Ajax\SearchUserController::class, 'getUserEmailByAny'])->name('ajax.get.user.email');
            Route::post('/ajax/set-user/geoip-table', [\App\Http\Controllers\Ajax\UserLocationController::class, 'setUserGeoipInfo'])->name('ajax.set.user.geoip.table');
            Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('home');

            Route::post('/dashboard/user/bonus', [\App\Http\Controllers\DashboardController::class, 'addUserBonus'])->name('dashboard.add_bonus');
            Route::get('/impersonate/{id}', [\App\Http\Controllers\ImpersonateController::class, 'impersonate'])->name('impersonate');

            Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
            Route::get('/settings/switch_site_status', [\App\Http\Controllers\SettingsController::class, 'switchSiteStatus'])->name('settings.switchSiteStatus');
            Route::post('/settings/change-many', [\App\Http\Controllers\SettingsController::class, 'changeMany'])->name('settings.change-many');

//            Route::get('/deposits/block/{deposit}', [\App\Http\Controllers\DepositController::class, 'block'])->name('deposits.block');
//            Route::get('/deposits/unblock/{deposit}', [\App\Http\Controllers\DepositController::class, 'unblock'])->name('deposits.unblock');
//            Route::get('/deposits/dtdata', [\App\Http\Controllers\DepositController::class, 'dataTable'])->name('deposits.dtdata');
            Route::resource('/deposits', \App\Http\Controllers\DepositController::class);

            Route::get('/roles/{id}/delete', [\App\Http\Controllers\RolesController::class, 'delete'])->name('roles.delete');
            Route::resource('/roles', \App\Http\Controllers\RolesController::class)->except(['create', 'show', 'edit','destroy']);;

            Route::get('/permissions/{id}/delete', [\App\Http\Controllers\PermissionsController::class, 'delete'])->name('permissions.delete');
            Route::resource('/permissions', \App\Http\Controllers\PermissionsController::class)->except(['create', 'show', 'edit','destroy']);;

            Route::resource('/notifications', NotificationsController::class);
            Route::post('/notifications/preview', [NotificationsController::class, 'showPreview'])->name('notifications.preview');

            Route::get('/withdrawals/approve/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approve'])->name('withdrawals.approve');
            Route::post('/withdrawals/approve-many', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approveMany'])->name('withdrawals.approve-many');
            Route::get('/withdrawals/reject/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'reject'])->name('withdrawals.reject');
            Route::get('/withdrawals/approveManually/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approveManually'])->name('withdrawals.approveManually');
            Route::get('/withdrawals/dtdata', [\App\Http\Controllers\WithdrawalRequestsController::class, 'dataTable'])->name('withdrawals.dtdata');
            Route::resource('/withdrawals', \App\Http\Controllers\WithdrawalRequestsController::class);

            Route::get('/replenishments/approveManually/{id}', [\App\Http\Controllers\ReplenishmentController::class, 'approveManually'])->name('replenishments.approveManually');

            Route::resource('/replenishments', \App\Http\Controllers\ReplenishmentController::class);

            Route::get('/transactions/dtdata', [\App\Http\Controllers\TransactionsController::class, 'dataTable'])->name('transactions.dtdata');
            Route::resource('/transactions', \App\Http\Controllers\TransactionsController::class);

            Route::resource('/langs', \App\Http\Controllers\LanguagesController::class);
            Route::get('/langs/destroy/{id}', [\App\Http\Controllers\LanguagesController::class, 'destroy'])->name('langs.destroy');

            Route::resource('/translations', \App\Http\Controllers\TplTranslationsController::class, [
                'names' => [
                    'index' => 'tpl_texts.index',
                    'index/{category?}' => 'tpl_texts.index',
                    'create' => 'tpl_texts.create',
                    'store' => 'tpl_texts.store',
                    'edit' => 'tpl_texts.edit',
                    'update' => 'tpl_texts.update',
                    'destroy' => 'tpl_texts.destroy',
                ],
            ]);

//            Route::resource('/currencies', \App\Http\Controllers\CurrenciesController::class);
//            Route::resource('/payment-systems', \App\Http\Controllers\PaymentSystemsController::class);
//            Route::resource('/news', \App\Http\Controllers\NewsController::class);
//            Route::resource('/reviews', \App\Http\Controllers\ReviewsController::class);
//            Route::resource('/faqs', \App\Http\Controllers\FaqsController::class);
//            Route::resource('/referral', \App\Http\Controllers\ReferralController::class);
//            Route::get('/referral/destroy/{id}', [\App\Http\Controllers\ReferralController::class, 'destroy'])->name('referral.destroy');

            Route::prefix('rates')->as('rates.')->group(function () {
                Route::get('/', [App\Http\Controllers\RateController::class, 'index'])->name('index');

                Route::get('/edit/{id}', [App\Http\Controllers\RateController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [App\Http\Controllers\RateController::class, 'update'])->name('update');

                Route::get('/create', [App\Http\Controllers\RateController::class, 'create'])->name('create');
                Route::post('/store', [App\Http\Controllers\RateController::class, 'store'])->name('store');
                Route::get('/destroy/{id}', [\App\Http\Controllers\RateController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('user-transactions')->as('user-transactions.')->group(function () {
                Route::get('/{transaction_id}', [App\Http\Controllers\UserTransactionController::class, 'index'])->name('index');
                Route::get('/{user_id}/destroy/{transaction_id}', [\App\Http\Controllers\UserTransactionController::class, 'destroy'])->name('destroy');
            });

            Route::get('/users/reftree/{id}', [\App\Http\Controllers\Technical\ReftreeController::class, 'show'])->name('users.reftree');

            Route::post('/users/referrals-redistribution/{id}', [\App\Http\Controllers\Technical\ReftreeController::class, 'referralsRedistribution'])->name('users.referrals-redistribution');
            Route::post('/users/add-referral/{id}', [\App\Http\Controllers\Technical\ReftreeController::class, 'addReferral'])->name('users.add-referral');

            Route::get('/users/dtdata', [\App\Http\Controllers\UsersController::class, 'dataTable'])->name('users.dtdata');
            Route::get('/users/activity-by-date', [\App\Http\Controllers\UsersController::class, 'activityByDate'])->name('users.activity-by-date');
            Route::get('/users/dt-transactions/{user_id}', [\App\Http\Controllers\UsersController::class, 'dataTableTransactions'])->name('users.dt-transactions');
            Route::get('/users/dt-deposits/{user_id}', [\App\Http\Controllers\UsersController::class, 'dataTableDeposits'])->name('users.dt-deposits');
            Route::get('/users/dt-wrs/{user_id}', [\App\Http\Controllers\UsersController::class, 'dataTableDeposits'])->name('users.dt-wrs');


            Route::resource('/users', \App\Http\Controllers\UsersController::class, ['names' => [
                'show/{level?}{plevel?}' => 'users.show',
            ]]);

            Route::post('/users/{id}/update_stat', [\App\Http\Controllers\UsersController::class, 'updateStat'])->name('users.update_stat');

            Route::post('/users/bonus', [\App\Http\Controllers\UsersController::class, 'bonus'])->name('users.bonus');
            Route::post('/users/penalty', [\App\Http\Controllers\UsersController::class, 'penalty'])->name('users.penalty');


            Route::get('/cloud_files', [\App\Http\Controllers\CloudFilesController::class, 'manager'])->name('cloud_files.manager');
            Route::post('/cloud_files', [\App\Http\Controllers\CloudFilesController::class, 'upload'])->name('cloud_files.upload');
            Route::get('/cloud_files/{id}/destroy', [\App\Http\Controllers\CloudFilesController::class, 'destroy'])->name('cloud_files.destroy');
            Route::get('/cloud_files/{id}', [\App\Http\Controllers\CloudFilesController::class, 'open'])->name('cloud_files.open');

            Route::post('/cloud_files/folder/create', [\App\Http\Controllers\CloudFilesController::class, 'folderCreate'])->name('cloud_files.folder.create');
            Route::get('/cloud_files/folder/{id}/destroy', [\App\Http\Controllers\CloudFilesController::class, 'folderDestroy'])->name('cloud_files.folder.destroy');

            Route::get('kanban', [\App\Http\Controllers\KanbanController::class, 'index'])->name('kanban.index');
            Route::post('kanban/board/store', [\App\Http\Controllers\KanbanController::class, 'boardStore'])->name('kanban.board.store');
            Route::post('kanban/board/{id}/task/store', [\App\Http\Controllers\KanbanController::class, 'taskStore'])->name('kanban.board.task.store');
            Route::post('kanban/board/{id}/task/change-board', [\App\Http\Controllers\KanbanController::class, 'changeBoard'])->name('kanban.board.task.change-board');
            Route::post('kanban/board/sort', [\App\Http\Controllers\KanbanController::class, 'sortBoards'])->name('kanban.board.sort-boards');
            Route::post('kanban/board/{id}/update', [\App\Http\Controllers\KanbanController::class, 'updateBoard'])->name('kanban.board.update');
            Route::get('kanban/board/{id}/destroy', [\App\Http\Controllers\KanbanController::class, 'destroyBoard'])->name('kanban.board.destroy');
        });

        Route::group(['middleware' => ['activity-log']], function () {
            Route::get('/backup', [\App\Http\Controllers\BackupController::class, 'index'])->name('backup.index');
            Route::get('/backup/backupDB', [\App\Http\Controllers\BackupController::class, 'backupDB'])->name('backup.backupDB');
            Route::get('/backup/backupFiles', [\App\Http\Controllers\BackupController::class, 'backupFiles'])->name('backup.backupFiles');
            Route::get('/backup/backupAll', [\App\Http\Controllers\BackupController::class, 'backupAll'])->name('backup.backupAll');
            Route::get('/backup/destroy/{file}', [\App\Http\Controllers\BackupController::class, 'destroy'])->where('file', '(.*(?:%2F:)?.*)')->name('backup.destroy');
            Route::post('/backup/download', [\App\Http\Controllers\BackupController::class, 'download'])->name('backup.download');

            Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
        });
    });
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
