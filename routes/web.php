<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

//use Illuminate\Routing\Route;

use App\Http\Controllers\AccountPanel\ProfileController;
use App\Http\Controllers\AccountPanel\ReferralsController;
use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CurrencyExchangesController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\RateGroupsController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\UserPhoneVerificationController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web', 'activity-log']], function () {
    Route::post('/telegram', [\App\Http\Controllers\TelegramController::class, 'index'])->name('telegram');
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,5');
    Route::get('/banner/{id}', [BannerController::class, 'getBanner'])->name('get.banner');
    Route::get('/lang/{locale}', [\App\Http\Controllers\LanguageController::class, 'index'])->name('set.lang');


    Route::group(['middleware' => ['auth', 'locked.user', ]], function () {
        Route::get('/impersonate/leave', [\App\Http\Controllers\ImpersonateController::class, 'leave'])->name('impersonate.leave');
        Route::post('ajax/bin-check', [\App\Http\Controllers\BinCheckController::class, 'ajaxCheck'])->name('ajax.bin.check');
        Route::post('/ajax/change-lang', [\App\Http\Controllers\Ajax\TranslationController::class, 'changeLang'])->name('ajax.change.lang');

        Route::group(['middleware' => ['permission.check']], function () {
            Route::post('/ajax/notification/status/read', [\App\Http\Controllers\NotificationsController::class, 'setReadStatus'])->name('ajax.notification.status.read');
            Route::post('/ajax/change-lang', [\App\Http\Controllers\Ajax\TranslationController::class, 'changeLang'])->name('ajax.change.lang');
            Route::post('/ajax/search-users', [\App\Http\Controllers\Ajax\SearchUserController::class, 'search'])->name('ajax.search.users');
            Route::post('/ajax/get-user-email', [\App\Http\Controllers\Ajax\SearchUserController::class, 'getUserEmailByAny'])->name('ajax.get.user.email');
            Route::post('/ajax/set-user/geoip-table', [\App\Http\Controllers\Ajax\UserLocationController::class, 'setUserGeoipInfo'])->name('ajax.set.user.geoip.table');
            Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('home');

/*            Route::get('/chat/{id?}', [AdminChatController::class, 'index'])->name('chat');
            Route::post('/chat/common/send-message', [AdminChatController::class, 'sendCommonMessage'])->name('chat.common.send.message');
            Route::post('/chat/common/read-message', [AdminChatController::class, 'readCommonChatMessage'])->name('chat.common.read.message');
            Route::post('/chat/common/delete-message', [AdminChatController::class, 'deleteCommonMessage'])->name('chat.common.delete.message');
            Route::post('/chat/send-message', [AdminChatController::class, 'sendMessage'])->name('chat.send.message');
            Route::post('/chat/read-message', [AdminChatController::class, 'readMessage'])->name('chat.read.message');
            Route::post('/chat/delete-message', [AdminChatController::class, 'deleteMessage'])->name('chat.delete.message');*/
            Route::get('/user/avatar/{id}', [UsersController::class, 'getAvatar'])->name('user.get.avatar');

            Route::get('/chat/create/{id}', [AdminChatController::class, 'crateChat'])->name('chat.crate');
            Route::get('/chat/{id?}', [AdminChatController::class, 'chatList'])->name('chat');

          //  Route::get('/impersonate/{id}', [\App\Http\Controllers\ImpersonateController::class, 'impersonate'])->name('impersonate');
            Route::get('/impersonate/{id}', [\App\Http\Controllers\ImpersonateController::class, 'impersonate'])->name('impersonate');



            Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
            Route::get('/settings/switch_site_status', [\App\Http\Controllers\SettingsController::class, 'switchSiteStatus'])->name('settings.switchSiteStatus');
            Route::post('/settings/change-many', [\App\Http\Controllers\SettingsController::class, 'changeMany'])->name('settings.change-many');
            Route::post('/settings/change-client-site-status', [\App\Http\Controllers\SettingsController::class, 'clientSite'])->name('settings.change-client-site-status');
            Route::post('/settings/enable-snow', [\App\Http\Controllers\SettingsController::class, 'enableSnow'])->name('settings.enable-snow');

            Route::resource('/deposits', \App\Http\Controllers\DepositController::class);
            Route::resource('/transactions', \App\Http\Controllers\TransactionsController::class);

            Route::get('/bonuses', [\App\Http\Controllers\BonusesController::class, 'index'])->name('bonuses.index');
            Route::post('/bonuses/add_bonus', [\App\Http\Controllers\BonusesController::class, 'addUserBonus'])->name('bonuses.add_bonus');
            Route::post('/bonuses/add_bonus', [\App\Http\Controllers\BonusesController::class, 'addUserBonus'])->name('bonuses.add_bonus');
            Route::post('/bonuses/add_bonuss', [\App\Http\Controllers\BonusesController::class, 'addUserBonus'])->name('dashboard.add_bonus');

            Route::get('/deposit-bonuses', [\App\Http\Controllers\DepositController::class, 'showBonuses'])->name('deposit.bonuses');
            Route::post('/deposit-bonus/set', [\App\Http\Controllers\DepositController::class, 'setBonus'])->name('deposit.bonus.set');
            Route::post('/deposit-bonus/add', [\App\Http\Controllers\DepositController::class, 'addBonus'])->name('deposit.bonus.add');
            Route::post('/deposit-bonus/delete', [\App\Http\Controllers\DepositController::class, 'deleteBonus'])->name('deposit.bonus.delete');

            Route::get('/roles/{id}/delete', [\App\Http\Controllers\RolesController::class, 'delete'])->name('roles.delete');
            Route::resource('/roles', \App\Http\Controllers\RolesController::class)->except(['create', 'show', 'edit','destroy']);;

            Route::get('/permissions/{id}/delete', [\App\Http\Controllers\PermissionsController::class, 'delete'])->name('permissions.delete');
            Route::resource('/permissions', \App\Http\Controllers\PermissionsController::class)->except(['create', 'show', 'edit','destroy']);;

            Route::get('/currency-exchange', [CurrencyExchangesController::class, 'index'])->name('currency-exchange');

            Route::resource('/notifications', NotificationsController::class);
            Route::post('/notifications/preview', [NotificationsController::class, 'showPreview'])->name('notifications.preview');

            Route::post('/replenishments/approve-many', [\App\Http\Controllers\ReplenishmentController::class, 'approveMany'])->name('withdrawals.approve-many');
            Route::get('/replenishments/approveManually/{id}', [\App\Http\Controllers\ReplenishmentController::class, 'approveManually'])->name('replenishments.approveManually');
            Route::any('/replenishments/destroy/{id}', [\App\Http\Controllers\ReplenishmentController::class, 'destroy'])->name('replenishments.destroy');
            Route::resource('/replenishments', \App\Http\Controllers\ReplenishmentController::class)->except('destroy');

            Route::resource('/withdrawals', \App\Http\Controllers\WithdrawalRequestsController::class)->except('destroy');
            Route::get('/withdrawals/approve/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approve'])->name('withdrawals.approve');
            Route::post('/withdrawals/approve-many', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approveMany'])->name('withdrawals.approve-many');
            Route::get('/withdrawals/reject/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'reject'])->name('withdrawals.reject');
            Route::get('/withdrawals/approveManually/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approveManually'])->name('withdrawals.approveManually');
            Route::get('/withdrawals/approveFake/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approveFake'])->name('withdrawals.approveFake');
            Route::any('/withdrawals/destroy/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'destroy'])->name('withdrawals.destroy');

            Route::resource('/langs', \App\Http\Controllers\LanguagesController::class);
            Route::get('/langs/destroy/{id}', [\App\Http\Controllers\LanguagesController::class, 'destroy'])->name('langs.destroy');

            Route::get('/translations/download', [\App\Http\Controllers\TplTranslationsController::class, 'download'])->name('translations.download');
            Route::get('/translations/translate-all', [\App\Http\Controllers\TplTranslationsController::class, 'translateAll'])->name('translations.translate-all');

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

            Route::prefix('support-tasks')->as('support-tasks.')->group(function () {
                Route::get('/', [\App\Http\Controllers\SupportTaskController::class, 'index'])->name('index');
                Route::get('/show/{id}', [\App\Http\Controllers\SupportTaskController::class, 'show'])->name('show');
                Route::get('/close/{id}', [\App\Http\Controllers\SupportTaskController::class, 'close'])->name('close');

                Route::prefix('messages')->as('messages.')->group(function () {
                    Route::post('{id}/store', [\App\Http\Controllers\SupportTaskMessageController::class, 'store'])->name('store');
                });
            });

            Route::get('news', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
            Route::get('products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

            Route::get('/news/{id}/destroy', [\App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');
            Route::resource('/news', \App\Http\Controllers\NewsController::class)->except('destroy', 'index');

            Route::get('/videos/{id?}', [\App\Http\Controllers\UserVideoController::class, 'index'])->name('video.index');
            Route::get('/video/confirm/{id}', [\App\Http\Controllers\UserVideoController::class, 'confirm'])->name('video.confirm');
            Route::get('/video/cancel/{id}', [\App\Http\Controllers\UserVideoController::class, 'cancel'])->name('video.cancel');
            Route::get('/video/delete/{id}', [\App\Http\Controllers\UserVideoController::class, 'delete'])->name('video.delete');
            Route::post('/video/save/{id}', [\App\Http\Controllers\UserVideoController::class, 'save'])->name('video.save');

            Route::prefix('products')->as('products.')->group(function () {
                Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');

                Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
                Route::post('/store', [App\Http\Controllers\ProductController::class, 'store'])->name('store');
                Route::get('/destroy/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');
            });

            Route::get('/referrals-and-banners', [App\Http\Controllers\BannersAndReferralsController::class, 'referrals'])->name('referrals-and-banners.referrals');
            Route::get('/banners-all', [App\Http\Controllers\BannersAndReferralsController::class, 'banners'])->name('referrals-and-banners.banners.all');

            Route::prefix('banners')->as('banners.')->group(function () {
                Route::get('/', [App\Http\Controllers\BannerController::class, 'index'])->name('index');

                Route::get('/edit/{id}', [App\Http\Controllers\BannerController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [App\Http\Controllers\BannerController::class, 'update'])->name('update');

                Route::get('/create', [App\Http\Controllers\BannerController::class, 'create'])->name('create');
                Route::post('/store', [App\Http\Controllers\BannerController::class, 'store'])->name('store');
                Route::get('/destroy/{id}', [\App\Http\Controllers\BannerController::class, 'destroy'])->name('destroy');
            });

            Route::get('/referrals/destroy/{id}', [\App\Http\Controllers\ReferralController::class, 'destroy'])->name('referrals.destroy');
            Route::get('referrals/top-referrals', [\App\Http\Controllers\ReferralController::class, 'getTopReferrals'])->name('referrals.top-referrals');
            Route::resource('/referrals', \App\Http\Controllers\ReferralController::class)->except('destroy');

            Route::post('/theme-settings', [\App\Http\Controllers\UserThemeSettingController::class, 'store'])->name('theme-settings');

            Route::prefix('currency-rates')->as('currency-rates.')->group(function () {
                Route::get('/', [App\Http\Controllers\CurrencyRateController::class, 'index'])->name('index');

                Route::get('/edit/{id}', [App\Http\Controllers\CurrencyRateController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [App\Http\Controllers\CurrencyRateController::class, 'update'])->name('update');
            });

            Route::prefix('rates')->as('rates.')->group(function () {
                Route::get('/', [App\Http\Controllers\RateController::class, 'index'])->name('index');

                Route::get('/edit/{id}', [App\Http\Controllers\RateController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [App\Http\Controllers\RateController::class, 'update'])->name('update');

                Route::get('/create', [App\Http\Controllers\RateController::class, 'create'])->name('create');
                Route::post('/store', [App\Http\Controllers\RateController::class, 'store'])->name('store');
                Route::get('/destroy/{id}', [\App\Http\Controllers\RateController::class, 'destroy'])->name('destroy');
            });

            Route::get('/user-phone-verification', [UserPhoneVerificationController::class, 'index'])->name('user.phone.verification');
            Route::post('/user-phone-verification', [UserPhoneVerificationController::class, 'save'])->name('user.phone.verification');

            Route::get('/rate-groups', [RateGroupsController::class, 'index'])->name('rate.groups.index');
            Route::post('/rate-groups/update', [RateGroupsController::class, 'update'])->name('rate.groups.update');

            Route::get('/payment-systems', [\App\Http\Controllers\PaymentSystems::class, 'index'])->name('payment_systems.index');

            Route::prefix('verification-requests')->as('verification-requests.')->group(function () {
                Route::get('/', [App\Http\Controllers\UserVerificationRequestController::class, 'index'])->name('index');

                Route::get('/show/{id}', [App\Http\Controllers\UserVerificationRequestController::class, 'show'])->name('show');
                Route::get('/update/{id}', [App\Http\Controllers\UserVerificationRequestController::class, 'update'])->name('update');
                Route::get('/reject/{id}', [App\Http\Controllers\UserVerificationRequestController::class, 'reject'])->name('reject');
                Route::get('/updateTimerStatus', [App\Http\Controllers\UserVerificationRequestController::class, 'updateTimerStatus'])->name('updateTimerStatus');
                Route::get('/updateAutoAccept/{id}', [App\Http\Controllers\UserVerificationRequestController::class, 'updateAutoAccept'])->name('updateAutoAccept');
                Route::post('/updateTimerHours', [App\Http\Controllers\UserVerificationRequestController::class, 'updateTimerHours'])->name('updateTimerHours');
            });

            Route::prefix('tasks')->as('tasks.')->group(function () {
                Route::post('/store', [App\Http\Controllers\TaskController::class, 'store'])->name('store');
                Route::post('/update/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('user-transactions')->as('user-transactions.')->group(function () {
                Route::get('/{transaction_id}', [App\Http\Controllers\UserTransactionController::class, 'index'])->name('index');
                Route::get('/{user_id}/destroy/{transaction_id}', [\App\Http\Controllers\UserTransactionController::class, 'destroy'])->name('destroy');
            });

            Route::get('/users/2fa/{id}', [UsersController::class, 'disable2fa'])->name('users.2fa');

            Route::get('/users/reftree/{id}', [\App\Http\Controllers\Technical\ReftreeController::class, 'show'])->name('users.reftree');
            Route::get('/users/referral-list/{id}', [UsersController::class, 'userReferralList'])->name('users.referral.list');


            Route::post('/users/referrals-redistribution/{id}', [\App\Http\Controllers\Technical\ReftreeController::class, 'referralsRedistribution'])->name('users.referrals-redistribution');
            Route::post('/users/add-referral/{id}', [\App\Http\Controllers\Technical\ReftreeController::class, 'addReferral'])->name('users.add-referral');

            Route::post('/users/mass-role-change', [UsersController::class, 'massRoleChange'])->name('users.mass-role-change');
            Route::get('/users/activity-by-date', [UsersController::class, 'activityByDate'])->name('users.activity-by-date');
            Route::post('users/roles/{id}', [\App\Http\Controllers\UsersController::class, 'updateRoleColor'])->name('users.roles.updateColor');
            Route::resource('/users', UsersController::class, ['names' => [
                'show/{level?}{plevel?}' => 'users.show',
            ]]);
            Route::post('/user/wallet/charge/{id}', [UsersController::class, 'userWalletCharge'])->name('user.wallet.charge');

            Route::post('/user/requisites/update', [UsersController::class, 'requisitesUpdate'])->name('user.requisites.update');

            Route::get('/show/reftree/{id}', [ReferralController::class, 'showUserReferralTree'])->name('user.reftree');
            Route::get('/user/reftree/{id}', [ReferralController::class, 'userReftree'])->name('user.tree.reftree');
           // Route::get('/referrals-tree', [ReferralController::class, 'show_referral_tree'])->name('referrals.tree.index');
        //    Route::get('/referrals-tree/reftree', [ReferralController::class, 'reftree'])->name('referrals.reftree');

            Route::post('/users/{id}/update_stat', [\App\Http\Controllers\UsersController::class, 'updateStat'])->name('users.update_stat');

            Route::post('/users/bonus', [\App\Http\Controllers\UsersController::class, 'bonus'])->name('users.bonus');
            Route::post('/users/penalty', [\App\Http\Controllers\UsersController::class, 'penalty'])->name('users.penalty');


            Route::get('/cloud_files', [\App\Http\Controllers\CloudFilesController::class, 'manager'])->name('cloud_files.manager');
            Route::post('/cloud_files', [\App\Http\Controllers\CloudFilesController::class, 'upload'])->name('cloud_files.upload');
            Route::get('/cloud_files/{id}/destroy', [\App\Http\Controllers\CloudFilesController::class, 'destroy'])->name('cloud_files.destroy');
            Route::get('/cloud_files/{id}', [\App\Http\Controllers\CloudFilesController::class, 'open'])->name('cloud_files.open');

            Route::post('/cloud_files/folder/create', [\App\Http\Controllers\CloudFilesController::class, 'folderCreate'])->name('cloud_files.folder.create');
            Route::get('/cloud_files/folder/{id}/destroy', [\App\Http\Controllers\CloudFilesController::class, 'folderDestroy'])->name('cloud_files.folder.destroy');

            Route::get('/perfectmoney/page', [\App\Http\Controllers\CloudFilesController::class, 'perfectmoneyPage'])->name('perfectmoney.page');
            Route::get('/payeer/page', [\App\Http\Controllers\CloudFilesController::class, 'payeerPage'])->name('payeer.page');
            Route::get('/binance/page', [\App\Http\Controllers\CloudFilesController::class, 'binancePage'])->name('binance.page');
            Route::get('/advcash/page', [\App\Http\Controllers\CloudFilesController::class, 'advcashPage'])->name('advcash.page');
            Route::get('/coinbase/page', [\App\Http\Controllers\CloudFilesController::class, 'coinbasePage'])->name('coinbase.page');

            Route::get('kanban', [\App\Http\Controllers\KanbanController::class, 'index'])->name('kanban.index');
            Route::post('kanban/board/store', [\App\Http\Controllers\KanbanController::class, 'boardStore'])->name('kanban.board.store');
            Route::post('kanban/board/{id}/task/store', [\App\Http\Controllers\KanbanController::class, 'taskStore'])->name('kanban.board.task.store');
            Route::post('kanban/board/{id}/task/change-board', [\App\Http\Controllers\KanbanController::class, 'changeBoard'])->name('kanban.board.task.change-board');
            Route::post('kanban/board/sort', [\App\Http\Controllers\KanbanController::class, 'sortBoards'])->name('kanban.board.sort-boards');
            Route::post('kanban/board/{id}/update', [\App\Http\Controllers\KanbanController::class, 'updateBoard'])->name('kanban.board.update');
            Route::get('kanban/board/{id}/destroy', [\App\Http\Controllers\KanbanController::class, 'destroyBoard'])->name('kanban.board.destroy');
            Route::get('kanban/board/{id}/destroy/{item_id}', [\App\Http\Controllers\KanbanController::class, 'destroyTask'])->name('kanban.board.destroyTask');

            Route::get('bin-check', [\App\Http\Controllers\BinCheckController::class, 'index'])->name('bin-check.index');

            Route::get('/faqs', [FaqsController::class, 'index'])->name('faq.index');
            Route::post('/faqs/add', [FaqsController::class, 'store'])->name('faq.add');
            Route::post('/faqs/update', [FaqsController::class, 'update'])->name('faq.update');
            Route::get('/faqs/delete/{id}', [FaqsController::class, 'delete'])->name('faq.delete');
        });

        Route::group(['middleware' => ['activity-log', 'permission.check']], function () {
            Route::get('/backup', [\App\Http\Controllers\BackupController::class, 'index'])->name('backup.index');
            Route::get('/backup/backupDB', [\App\Http\Controllers\BackupController::class, 'backupDB'])->name('backup.backupDB');
            Route::get('/backup/destroy/{id}', [\App\Http\Controllers\BackupController::class, 'destroy'])->name('backup.destroy');
            Route::get('/backup/download/{id}', [\App\Http\Controllers\BackupController::class, 'download'])->name('backup.download');

            Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
        });
    });
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::post('/user-unlock', [UsersController::class, 'unlockUser'])->name('user.unlock');
    Route::get('/locked', [UsersController::class, 'lockedUser'])->name('user.locked');
    Route::get('/user-lock', [UsersController::class, 'lockUser'])->name('user.lock');
});
