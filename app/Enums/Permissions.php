<?php

namespace App\Enums;

final class Permissions extends Enum
{
    const APP_INIT            = 'app.init';
    const DASHBOARD_ADD_BONUS = 'dashboard.add_bonus';
    
    const USERS_INDEX                    = 'users.index';
    const USERS_SHOW                     = 'users.show';
    const USERS_EDIT                     = 'users.edit';
    const USERS_UPDATE                   = 'users.update';
    const USERS_DESTROY                  = 'users.destroy';
    const USERS_UPDATE_STAT              = 'users.update_stat';
    const USERS_BONUS                    = 'users.bonus';
    const USERS_PENALTY                  = 'users.penalty';
    const USERS_REFTREE                  = 'users.reftree';
    const USERS_REFERRALS_REDISTRIBUTION = 'users.referrals-redistribution';
    const USERS_ADD_REFERRAL             = 'users.add-referral';
    
    // const AUTH_LOGOUT = 'auth.logout';
    
    const ROLES_INDEX  = 'roles.index';
    const ROLES_STORE  = 'roles.store';
    const ROLES_UPDATE = 'roles.update';
    const ROLES_DELETE = 'roles.delete';
    
    const PERMISSIONS_INDEX  = 'permissions.index';
    const PERMISSIONS_STORE  = 'permissions.store';
    const PERMISSIONS_UPDATE = 'permissions.update';
    const PERMISSIONS_DELETE = 'permissions.delete';
    
    const SETTINGS                    = 'settings.index';
    const SETTINGS_SWITCH_SITE_STATUS = 'settings.switchSiteStatus';
    const SETTINGS_CHANGE_MANY        = 'settings.change-many';
    
    const DEPOSITS      = 'deposits.index';
    const DEPOSITS_SHOW = 'deposits.show';
    
    const NOTIFICATIONS_INDEX        = 'notifications.index';
    const NOTIFICATIONS_CREATE       = 'notifications.create';
    const NOTIFICATIONS_STORE        = 'notifications.store';
    const NOTIFICATIONS_SHOW_PREVIEW = 'notifications.showPreview';
    
    const WITHDRAWALS_INDEX            = 'withdrawals.index';
    const WITHDRAWALS_SHOW             = 'withdrawals.show';
    const WITHDRAWALS_APPROVE          = 'withdrawals.approve';
    const WITHDRAWALS_APPROVE_MANY     = 'withdrawals.approve-many';
    const WITHDRAWALS_REJECT           = 'withdrawals.reject';
    const WITHDRAWALS_APPROVE_MANUALLY = 'withdrawals.approveManually';
    
    const REPLENISHMENTS_INDEX            = 'replenishments.index';
    const REPLENISHMENTS_SHOW             = 'replenishments.show';
    const REPLENISHMENTS_APPROVE_MANUALLY = 'replenishments.approveManually';
    
    const TRANSACTIONS_INDEX   = 'transactions.index';
    const TRANSACTIONS_SHOW    = 'transactions.show';
    const TRANSACTIONS_DESTROY = 'transactions.destroy';
    
    
    protected static $data = [
        self::APP_INIT => 'App init',
        self::DASHBOARD_ADD_BONUS => 'Начислить бонус на главной',
        
        self::USERS_INDEX => 'Список пользователей',
        self::USERS_SHOW => 'Страница данных пользователя',
        self::USERS_EDIT => 'Страница редактирования данных пользователя',
        self::USERS_UPDATE => 'Изменение данных пользователя',
        self::USERS_DESTROY => 'Удаление пользователя',
        self::USERS_UPDATE_STAT => 'Обновить статистику',
        self::USERS_BONUS => 'Начислить бонусы пользователю',
        self::USERS_PENALTY => 'Оштрафовать пользователя',
        self::USERS_REFTREE => 'Посмотреть реферальное дерево',
        self::USERS_REFERRALS_REDISTRIBUTION => 'Перераспределение обращений пользователей',
        self::USERS_ADD_REFERRAL => 'Добавление реферала',
        
        self::ROLES_INDEX => 'Список ролей',
        self::ROLES_STORE => 'Добавление роли',
        self::ROLES_UPDATE => 'Изменение роли',
        self::ROLES_DELETE => 'Удаление роли',
        
        //self::AUTH_LOGOUT => 'Auth logout',
        
        self::PERMISSIONS_INDEX => 'Список прав',
        self::PERMISSIONS_STORE => 'Добавление права',
        self::PERMISSIONS_UPDATE => 'Изменение права',
        self::PERMISSIONS_DELETE => 'Удаление права',
        
        self::SETTINGS => 'Доступ к странице настроек',
        self::SETTINGS_SWITCH_SITE_STATUS => 'Изменение статуса сайта (Работает/не работает)',
        self::SETTINGS_CHANGE_MANY => 'Изменение настроек',
        
        self::DEPOSITS => 'Список депозитов',
        self::DEPOSITS_SHOW => 'Просмотр данных депозита',
        
        self::NOTIFICATIONS_INDEX => 'Список уведомлений',
        self::NOTIFICATIONS_CREATE => 'Страница создания уведомления',
        self::NOTIFICATIONS_STORE => 'Создание уведомления',
        self::NOTIFICATIONS_SHOW_PREVIEW => 'Превью шаблона письма',
        
        self::WITHDRAWALS_INDEX => 'Список выводов',
        self::WITHDRAWALS_SHOW => 'Просмотр операции на вывод',
        self::WITHDRAWALS_APPROVE => 'Подтвердить операцию на вывод',
        self::WITHDRAWALS_APPROVE_MANY => 'Подтвердить несколько операций на вывод',
        self::WITHDRAWALS_REJECT => 'Отклонить операцию на вывод',
        self::WITHDRAWALS_APPROVE_MANUALLY => 'Вручную подтвердить операцию на вывод',
        
        self::REPLENISHMENTS_INDEX => 'Список пополнений',
        self::REPLENISHMENTS_SHOW => 'Просмотр операции пополнения',
        self::REPLENISHMENTS_APPROVE_MANUALLY => 'Вручную подтвердить операцию на пополнение',
        
        self::TRANSACTIONS_INDEX => 'Список транзакции',
        self::TRANSACTIONS_SHOW => 'Просмотр данных транзакции',
        self::TRANSACTIONS_DESTROY => 'Удаление транзакции',
    ];
}
