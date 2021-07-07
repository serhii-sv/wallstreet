<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

//use Illuminate\Routing\Route;
use App\Http\Controllers\NewController;
use \Illuminate\Support\Facades\Route;

Route::post('/telegram_webhook/{token}', 'Telegram\TelegramWebhookController@index')->name('telegram.webhook');

Route::group(['middleware' => ['web']], function () {
    Auth::routes();
    
    // oAuth
    //    Route::get('login/callback/vk/{telegramUserId}', 'controller')->name('vk.redirect_url');
    
    //    Route::get('login/redirect/google/{telegramUserId}', 'controller')->name('google.redirect_url');
    //    Route::get('login/callback/google', 'controller');
    
    // social event catcher
    Route::get('youtube/watch/{taskAction}/{userId}', 'Technical\Youtube\YoutubeWatchCatchController@index')->name('youtube.watch');
    Route::any('youtube/watch/save/{taskAction}/{userId}', 'Technical\Youtube\YoutubeWatchCatchController@catchEvent')->name('youtube.watch.save');
    
    Route::get('/confirm_email/{hash}', 'Customer\ConfirmEmailController@index')->name('email.confirm');
    
    Route::group(['middleware' => ['site.status']], function () {
        // Confirm email
        Route::get('/resend', 'Customer\MainController@index')->name('resend');
        
        /*
         * Временно
         */
        Route::get('/new', 'NewController@index');
        
        // Not authorized
        Route::get('/', 'Customer\MainController@index')->name('customer.main');
        Route::get('/aboutus', 'Customer\AboutUsController@index')->name('customer.aboutus');
        Route::get('/documents', 'Customer\DocumentsController@index')->name('customer.documents');
        Route::get('/investors', 'Customer\InvestorsController@index')->name('customer.investors');
        Route::get('/partners', 'Customer\PartnersController@index')->name('customer.partners');
        Route::get('/contact', 'Customer\ContactController@index')->name('customer.contact');
        Route::get('/payout', 'Customer\PayoutController@index')->name('customer.payout');
        
        Route::get('/support', 'Customer\SupportController@index')->name('customer.support');
        Route::post('/support', 'Customer\SupportController@send')->name('customer.support');
        
        Route::get('/faq', 'Customer\FaqController@index')->name('customer.faq');
        Route::get('/reviews', 'Customer\ReviewsController@index')->name('customer.reviews');
        Route::get('/agreement', 'Customer\AgreementController@index')->name('customer.agreement');
        
        // Technical
        Route::get('/partner/{partner_id}', 'SetPartnerController@index')->name('partner');
        Route::get('/lang/{locale}', 'LanguageController@index')->name('set.lang');
        
        // IPN
        Route::post('/advcash/status', 'Payment\AdvcashController@status')->name('advcash.status');
        Route::post('/perfectmoney/status', 'Payment\PerfectMoneyController@status')->name('perfectmoney.status');
        Route::post('/payeer/status', 'Payment\PayeerController@status')->name('payeer.status');
        Route::post('/blockio/status', 'Payment\BlockioController@status')->name('blockio.status');
        Route::post('/coinpayments/status', 'Payment\CoinpaymentsController@status')->name('coinpayments.status');
        Route::post('/enpay/status', 'Payment\EnpayController@status')->name('enpay.status');
        Route::post('/nixmoney/status', 'Payment\NixmoneyController@status')->name('nixmoney.status');
    });
    
    Route::group(['middleware' => ['auth']], function () {
        Route::group(['middleware' => ['site.status']], function () {
            Route::get('/impersonate/leave', 'Admin\ImpersonateController@leave')->name('admin.impersonate.leave');
            
            Route::get('/reftree', 'Technical\ReftreeController@show')->name('users.reftree');
            
            Route::get('/profile', 'Profile\ProfileController@index')->name('profile.profile');
            
            Route::get('/operations', 'Profile\OperationsController@index')->name('profile.operations.index');
            Route::get('/operations_dataTable/{type?}', 'Profile\OperationsController@datatable')->name('profile.operations.dataTable');
            
            Route::get('/affiliate', 'Profile\AffiliateController@index')->name('profile.affiliate');
            Route::get('/promo', 'Profile\PromoController@index')->name('profile.promo');
            
            Route::get('/settings', 'Profile\SettingsController@index')->name('profile.settings');
            Route::post('/settings', 'Profile\SettingsController@handle')->name('profile.settings');
            
            Route::get('/withdraw', 'Profile\WithdrawController@index')->name('profile.withdraw');
            Route::post('/withdraw', 'Profile\WithdrawController@handle')->name('profile.withdraw');
            
            Route::get('/topup', 'Profile\TopupController@index')->name('profile.topup');
            Route::post('/topup', 'Profile\TopupController@handle')->name('profile.topup');
            
            Route::get('/topup/advcash', 'Payment\AdvcashController@topUp')->name('profile.topup.advcash');
            Route::get('/topup/perfectmoney', 'Payment\PerfectMoneyController@topUp')->name('profile.topup.perfectmoney');
            Route::get('/topup/payeer', 'Payment\PayeerController@topUp')->name('profile.topup.payeer');
            Route::get('/topup/blockio', 'Payment\BlockioController@topUp')->name('profile.topup.blockio');
            Route::get('/topup/coinpayments', 'Payment\CoinpaymentsController@topUp')->name('profile.topup.coinpayments');
            Route::get('/topup/enpay', 'Payment\EnpayController@topUp')->name('profile.topup.enpay');
            Route::get('/topup/nixmoney', 'Payment\NixmoneyController@topUp')->name('profile.topup.nixmoney');
            
            Route::any('/topup/payment_message', 'Profile\TopupController@paymentMessage')->name('profile.topup.payment_message');
            
            Route::resource('/deposits', 'Profile\DepositsController', [
                'names' => [
                    'index' => 'profile.deposits',
                    'create' => 'profile.deposits.create',
                    'store' => 'profile.deposits.store',
                ],
            ]);
            Route::get('/deposits_datatable/{active?}', 'Profile\DepositsController@dataTable')->name('profile.deposits.dataTable');
        });
        Route::group(['middleware' => ['tfa']], function () {
            Route::prefix('wallstreet')->namespace('Admin')->group(function () {
                // Controllers Within The "App\Http\Controllers\Admin" Namespace
                Route::group(['middleware' => ['role:root|admin']], function () {
                    Route::get('/', 'DashboardController@index')->name('admin');
                    
                    Route::get('/impersonate/{id}', 'ImpersonateController@impersonate')->name('admin.impersonate');
                    
                    Route::get('auth/2fa', 'Admin\TwoFactAuthController@authForm')->name('auth.form.token');
                    Route::post('auth/2fa', 'Admin\TwoFactAuthController@enterToken')->name('auth.enter.token');
                    Route::post('auth/2fa/send', 'Admin\TwoFactAuthController@sendToken')->name('auth.send.token');
                    Route::get('auth/2fa/status', 'Admin\TwoFactAuthController@statusForm')->name('auth.tfa.form');
                    Route::post('auth/2fa/status', 'Admin\TwoFactAuthController@statusUpdate')->name('auth.tfa.update');
                    
                    Route::get('/statistic', 'StatisticController@index')->name('admin.statistic');
                    
                    Route::get('/settings', 'SettingsController@index')->name('admin.settings.index');
                    Route::get('/settings/switch_site_status', 'SettingsController@switchSiteStatus')->name('admin.settings.switchSiteStatus');
                    Route::post('/settings/change-many', 'SettingsController@changeMany')->name('admin.settings.change-many');
                    
                    Route::get('/deposits/block/{deposit}', 'DepositController@block')->name('admin.deposits.block');
                    Route::get('/deposits/unblock/{deposit}', 'DepositController@unblock')->name('admin.deposits.unblock');
                    Route::get('/deposits/dtdata', 'DepositController@dataTable')->name('admin.deposits.dtdata');
                    Route::resource('/deposits', 'DepositController', [
                        'names' => [
                            'index' => 'admin.deposits.index',
                            'show' => 'admin.deposits.show',
                        ],
                    ]);
                    Route::post('/deposits', 'DepositController@filter')->name('admin.deposits.filter');
                    
                    Route::get('/requests/approve/{id}', 'WithdrawalRequestsController@approve')->name('admin.requests.approve');
                    Route::post('/requests/approve-many', 'WithdrawalRequestsController@approveMany')->name('admin.requests.approve-many');
                    Route::get('/requests/reject/{id}', 'WithdrawalRequestsController@reject')->name('admin.requests.reject');
                    Route::get('/requests/approveManually/{id}', 'WithdrawalRequestsController@approveManually')->name('admin.requests.approveManually');
                    Route::get('/requests/dtdata', 'WithdrawalRequestsController@dataTable')->name('admin.requests.dtdata');
                    Route::resource('/requests', 'WithdrawalRequestsController', [
                        'names' => [
                            'index' => 'admin.requests.index',
                            'show' => 'admin.requests.show',
                            'edit' => 'admin.requests.edit',
                            'update' => 'admin.requests.update',
                        ],
                    ]);
                    
                    Route::get('/transactions/dtdata', 'TransactionsController@dataTable')->name('admin.transactions.dtdata');
                    Route::resource('/transactions', 'TransactionsController', [
                        'names' => [
                            'index' => 'admin.transactions.index',
                            'show' => 'admin.transactions.show',
                        ],
                    ]);
                    
                    Route::resource('/langs', 'LanguagesController', [
                        'names' => [
                            'index' => 'admin.langs.index',
                            'create' => 'admin.langs.create',
                            'store' => 'admin.langs.store',
                            'edit' => 'admin.langs.edit',
                            'update' => 'admin.langs.update',
                        ],
                    ]);
                    Route::get('/langs/destroy/{id}', 'LanguagesController@destroy')->name('admin.langs.destroy');
                    
                    Route::resource('/translations', 'TplTranslationsController', [
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
                    
                    Route::resource('/currencies', 'CurrenciesController', [
                        'names' => [
                            'index' => 'admin.currencies.index',
                            'edit' => 'admin.currencies.edit',
                            'update' => 'admin.currencies.update',
                        ],
                    ]);
                    Route::resource('/payment-systems', 'PaymentSystemsController', [
                        'names' => [
                            'index' => 'admin.payment-systems.index',
                            'edit' => 'admin.payment-systems.edit',
                            'update' => 'admin.payment-systems.update',
                        ],
                    ]);
                    
                    Route::resource('/news', 'NewsController', [
                        'names' => [
                            'index' => 'admin.news.index',
                            'create' => 'admin.news.create',
                            'store' => 'admin.news.store',
                            'edit' => 'admin.news.edit',
                            'update' => 'admin.news.update',
                            'destroy' => 'admin.news.destroy',
                        ],
                    ]);
                    
                    Route::resource('/reviews', 'ReviewsController', [
                        'names' => [
                            'index' => 'admin.reviews.index',
                            'create' => 'admin.reviews.create',
                            'store' => 'admin.reviews.store',
                            'edit' => 'admin.reviews.edit',
                            'update' => 'admin.reviews.update',
                            'destroy' => 'admin.reviews.destroy',
                        ],
                    ]);
                    Route::resource('/faqs', 'FaqsController', [
                        'names' => [
                            'index' => 'admin.faqs.index',
                            'create' => 'admin.faqs.create',
                            'store' => 'admin.faqs.store',
                            'edit' => 'admin.faqs.edit',
                            'update' => 'admin.faqs.update',
                            'destroy' => 'admin.faqs.destroy',
                        ],
                    ]);
                    
                    Route::resource('/mail', 'MailController', [
                        'names' => [
                            'index' => 'admin.mail.index',
                            'show' => 'admin.mail.show',
                            'create' => 'admin.mail.create',
                            'store' => 'admin.mail.store',
                            'edit' => 'admin.mail.edit',
                            'update' => 'admin.mail.update',
                            'destroy' => 'admin.mail.destroy',
                        
                        ],
                    ]);
                    Route::get('/mail/{mail}/send', 'MailController@send')->name('admin.mail.send');
                    
                    Route::resource('/referral', 'ReferralController', [
                        'names' => [
                            'index' => 'admin.referral.index',
                            'create' => 'admin.referral.create',
                            'store' => 'admin.referral.store',
                            'edit' => 'admin.referral.edit',
                            'update' => 'admin.referral.update',
                        ],
                    ]);
                    Route::get('/referral/destroy/{id}', 'ReferralController@destroy')->name('admin.referral.destroy');
                    
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
                    Route::get('/rates/destroy/{id}', 'RateController@destroy')->name('admin.rates.destroy');
                    
                    Route::get('/users/reftree/{id}', 'Technical\ReftreeController@show')->name('admin.users.reftree');
                    Route::get('/users/dtdata', 'UsersController@dataTable')->name('admin.users.dtdata');
                    Route::get('/users/dt-transactions/{user_id}', 'UsersController@dataTableTransactions')->name('admin.users.dt-transactions');
                    Route::get('/users/dt-deposits/{user_id}', 'UsersController@dataTableDeposits')->name('admin.users.dt-deposits');
                    Route::get('/users/dt-wrs/{user_id}', 'UsersController@dataTableWrs')->name('admin.users.dt-wrs');
                    Route::get('/users/dt-pvs/{user_id}', 'UsersController@dataTablePageViews')->name('admin.users.dt-pvs');
                    Route::resource('/users', 'UsersController', [
                        'names' => [
                            'index' => 'admin.users.index',
                            'show' => 'admin.users.show',
                            'show/{level?}{plevel?}' => 'admin.users.show',
                            'edit' => 'admin.users.edit',
                            'update' => 'admin.users.update',
                            'destroy' => 'admin.users.destroy',
                        ],
                    ]);
                    Route::post('/users/bonus', 'UsersController@bonus')->name('admin.users.bonus');
                    Route::post('/users/penalty', 'UsersController@penalty')->name('admin.users.penalty');
                    Route::post('/users', 'UsersController@filter')->name('admin.users.filter');
                    
                    Route::get('/social_meta', 'SocialMetaController@index')->name('admin.social_meta.index');
                    Route::get('/social_meta/dtdata', 'SocialMetaController@dataTable')->name('admin.social_meta.dtdata');
                    
                    /*
                     * Telegram
                     */
                    Route::resource('/telegram/bots', 'Telegram\BotsController', [
                        'names' => [
                            'index' => 'admin.telegram.bots.index',
                            'create' => 'admin.telegram.bots.create',
                            'store' => 'admin.telegram.bots.store',
                            'edit' => 'admin.telegram.bots.edit',
                            'update' => 'admin.telegram.bots.update',
                        ],
                    ]);
                    Route::get('/telegram/datatable/bots/{id}/destroy', 'Telegram\BotsController@destroy')->name('admin.telegram.bots.destroy');
                    Route::get('/telegram/datatable/bots', 'Telegram\BotsController@datatable')->name('admin.telegram.bots.datatable');
                    
                    Route::get('/telegram/events', 'Telegram\EventsController@index')->name('admin.telegram.events.list');
                    Route::get('/telegram/datatable/events', 'Telegram\EventsController@datatable')->name('admin.telegram.events.datatable');
                    
                    Route::get('/telegram/messages', 'Telegram\MessagesController@index')->name('admin.telegram.messages.list');
                    Route::get('/telegram/datatable/messages', 'Telegram\MessagesController@datatable')->name('admin.telegram.messages.datatable');
                    
                    Route::get('/telegram/users', 'Telegram\UsersController@index')->name('admin.telegram.users.list');
                    Route::get('/telegram/datatable/users', 'Telegram\UsersController@datatable')->name('admin.telegram.users.datatable');
                    
                    Route::get('/telegram/webhooks', 'Telegram\WebhooksController@index')->name('admin.telegram.webhooks.list');
                    Route::get('/telegram/datatable/webhooks', 'Telegram\WebhooksController@datatable')->name('admin.telegram.webhooks.datatable');
                    
                    Route::get('/telegram/webhooks_info', 'Telegram\WebhooksInfoController@index')->name('admin.telegram.webhooks_info.list');
                    Route::get('/telegram/datatable/webhooks_info', 'Telegram\WebhooksInfoController@datatable')->name('admin.telegram.webhooks_info.datatable');
                    
                    /*
                     * User tasks
                     */
                    Route::resource('/user-tasks/tasks', 'UserTasks\TasksController', [
                        'names' => [
                            'index' => 'admin.user-tasks.tasks.index',
                            'create' => 'admin.user-tasks.tasks.create',
                            'store' => 'admin.user-tasks.tasks.store',
                            'edit' => 'admin.user-tasks.tasks.edit',
                            'update' => 'admin.user-tasks.tasks.update',
                        ],
                    ]);
                    Route::get('/user-tasks/datatable/tasks/{id}/destroy', 'UserTasks\TasksController@destroy')->name('admin.user-tasks.tasks.destroy');
                    Route::get('/user-tasks/datatable/tasks', 'UserTasks\TasksController@datatable')->name('admin.user-tasks.tasks.datatable');
                    
                    Route::get('/user-tasks/accepted_tasks', 'UserTasks\AcceptedTasksController@index')->name('admin.user-tasks.accepted_tasks.list');
                    Route::get('/user-tasks/datatable/accepted_tasks', 'UserTasks\AcceptedTasksController@datatable')->name('admin.user-tasks.accepted_tasks.datatable');
                    
                    Route::get('/user-tasks/available_elements', 'UserTasks\AvailableElementsController@index')->name('admin.user-tasks.available_elements.list');
                    Route::get('/user-tasks/datatable/available_elements', 'UserTasks\AvailableElementsController@datatable')->name('admin.user-tasks.available_elements.datatable');
                    
                    Route::get('/user-tasks/tasks_elements', 'UserTasks\TasksElementsController@index')->name('admin.user-tasks.tasks_elements.list');
                    Route::get('/user-tasks/datatable/tasks_elements', 'UserTasks\TasksElementsController@datatable')->name('admin.user-tasks.tasks_elements.datatable');
                    
                    Route::get('/user-tasks/user_task_elements', 'UserTasks\UserTaskElementsController@index')->name('admin.user-tasks.user_task_elements.list');
                    Route::get('/user-tasks/datatable/user_task_elements', 'UserTasks\UserTaskElementsController@datatable')->name('admin.user-tasks.user_task_elements.datatable');
                });
                
                Route::group(['middleware' => ['role:root']], function () {
                    Route::get('/backup', 'BackupController@index')->name('admin.backup.index');
                    Route::get('/backup/backupDB', 'BackupController@backupDB')->name('admin.backup.backupDB');
                    Route::get('/backup/backupFiles', 'BackupController@backupFiles')->name('admin.backup.backupFiles');
                    Route::get('/backup/backupAll', 'BackupController@backupAll')->name('admin.backup.backupAll');
                    Route::get('/backup/destroy/{file}', 'BackupController@destroy')->where('file', '(.*(?:%2F:)?.*)')->name('admin.backup.destroy');
                    Route::post('/backup/download', 'BackupController@download')->name('admin.backup.download');
                    
                    Route::get('/failedjobs', 'FailedJobsController@index')->name('admin.failedjobs.index');
                    Route::get('/failedjobs/datatable', 'FailedJobsController@dataTable')->name('admin.failedjobs.datatable');
                    
                    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');
                    Route::get('see_integration_example/{functionName}', 'SeeIntegrationExample@index')->name('integration-docs');
                    
                    Route::get('/sys_load', 'SysLoadController@index')->name('admin.sys_load');
                });
            });
        });
    });
});
