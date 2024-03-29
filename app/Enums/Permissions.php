<?php

namespace App\Enums;

final class Permissions extends Enum
{
    const APP_INIT              = 'app.init';
    const HOME                  = 'home';
    const TRANSLATE             = 'translate';
    const DASHBOARD_ADD_BONUS   = 'dashboard.add_bonus';

    const USERS_INDEX                     = 'users.index';
    const USERS_SHOW                      = 'users.show';
    const USERS_EDIT                      = 'users.edit';
    const USERS_UPDATE                    = 'users.update';
    const USERS_DESTROY                   = 'users.destroy';
    const USERS_UPDATE_STAT               = 'users.update_stat';
    const USERS_BONUS                     = 'users.bonus';
    const USERS_PENALTY                   = 'users.penalty';
    const USERS_REFTREE                   = 'users.reftree';
    const USERS_REFERRALS_REDISTRIBUTION  = 'users.referrals-redistribution';
    const USERS_ADD_REFERRAL              = 'users.add-referral';
    const USERS_USER_TRANSACTIONS         = 'users.user-transactions';
    const USERS_USER_TRANSACTIONS_DESTROY = 'users.user-transactions.destroy';

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

    const BONUSES_INDEX = 'bonuses.index';
    const BONUSES_ADD_BONUS = 'bonuses.add_bonus';

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
    const WITHDRAWALS_DESTROY          = 'withdrawals.destroy';

    const REPLENISHMENTS_INDEX            = 'replenishments.index';
    const REPLENISHMENTS_SHOW             = 'replenishments.show';
    const REPLENISHMENTS_APPROVE_MANUALLY = 'replenishments.approveManually';
    const REPLENISHMENTS_DESTROY          = 'replenishments.destroy';

    const TRANSACTIONS_INDEX   = 'transactions.index';
    const TRANSACTIONS_SHOW    = 'transactions.show';
    const TRANSACTIONS_DESTROY = 'transactions.destroy';

    const CLOUD_FILES                = 'cloud_files.manager';
    const CLOUD_FILES_UPLOAD         = 'cloud_files.upload';
    const CLOUD_FILES_DESTROY        = 'cloud_files.destroy';
    const CLOUD_FILES_OPEN           = 'cloud_files.open';
    const CLOUD_FILES_FOLDER_CREATE  = 'cloud_files.folder.create';
    const CLOUD_FILES_FOLDER_DESTROY = 'cloud_files.folder.destroy';

    const KANBAN_INDEX                   = 'kanban.index';
    const KANBAN_BOARD_STORE             = 'kanban.board.store';
    const KANBAN_BOARD_TASK_STORE        = 'kanban.board.task.store';
    const KANBAN_BOARD_TASK_CHANGE_BOARD = 'kanban.board.task.change-board';
    const KANBAN_BOARD_SORT_BOARDS       = 'kanban.board.sort-boards';
    const KANBAN_BOARD_UPDATE            = 'kanban.board.update';
    const KANBAN_BOARD_DESTROY           = 'kanban.board.destroy';

    const RATES_INDEX   = 'rates.index';
    const RATES_STORE   = 'rates.store';
    const RATES_UPDATE  = 'rates.update';
    const RATES_DESTROY = 'rates.destroy';

    const RATE_GROUPS_INDEX  = 'rate.groups.index';
    const RATE_GROUPS_UPDATE = 'rate.groups.update';

    const VERIFICATION_REQUESTS_INDEX  = 'verification-requests.index';
    const VERIFICATION_REQUESTS_SHOW   = 'verification-requests.show';
    const VERIFICATION_REQUESTS_UPDATE = 'verification-requests.update';

    const SUPPORT_TASKS_INDEX          = 'support-tasks.index';
    const SUPPORT_TASKS_SHOW           = 'support-tasks.show';
    const SUPPORT_TASKS_CLOSE          = 'support-tasks.close';
    const SUPPORT_TASKS_MESSAGES_STORE = 'support-tasks.messages.store';

    const REFERRALS_BANNERS_INDEX = 'referrals-and-banners.index';

    const REFERRALS_STORE   = 'referrals.store';
    const REFERRALS_DESTROY = 'referrals.destroy';
    const REFERRALS_UPDATE  = 'referrals.update';

    const BANNERS_STORE   = 'banners.store';
    const BANNERS_DESTROY = 'banners.destroy';
    const BANNERS_UPDATE  = 'banners.update';

    const NEWS_INDEX = 'news.index';
    const NEWS_DESTROY = 'news.destroy';
    const NEWS_STORE   = 'news.store';
    const NEWS_UPDATE  = 'news.update';

    const PRODUCTS_INDEX   = 'products.index';
    const PRODUCTS_STORE   = 'products.store';
    const PRODUCTS_DESTROY = 'products.destroy';
    const PRODUCTS_UPDATE  = 'products.update';

    const CURRENCY_RATES_UPDATE = 'currency-rates.update';
    const CURRENCY_RATES_INDEX  = 'currency-rates.index';

    const PAYMENT_SYSTEMS_INDEX  = 'payment_systems.index';

    const CURRENCY_EXCHANGE_INDEX = 'currency-exchange.index';

    const CHAT_INDEX               = 'chat';
    const CHAT_SEND_MESSAGE        = 'chat.send.message';
    const CHAT_COMMON_SEND_MESSAGE = 'chat.common.send.message';


    const CLIENT_LOGS = 'accountPanel.logs';

    const BACKUPS_INDEX    = 'backup.index';
    const BACKUPS_STORE    = 'backup.backupDB';
    const BACKUPS_DESTROY  = 'backup.destroy';
    const BACKUPS_DOWNLOAD = 'backup.download';

    const IMPERSONATE = 'impersonate';

    const DEPOSIT_BONUSES   = 'deposit.bonuses';
    const DEPOSIT_BONUS_SET = 'deposit.bonus.set';


    const FAQ_INDEX  = 'faq.index';
    const FAQ_ADD    = 'faq.add';
    const FAQ_UPDATE = 'faq.update';
    const FAQ_DELETE = 'faq.delete';


    const VIDEO_INDEX   = 'video.index';
    const VIDEO_CONFIRM = 'video.confirm';
    const VIDEO_CANCEL  = 'video.cancel';
    const VIDEO_DELETE  = 'video.delete';
    const VIDEO_SAVE    = 'video.save';


    public static $data = [
        self::APP_INIT => 'App init',
        self::HOME => 'Главная',
        self::TRANSLATE => 'Переводить',
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
        self::USERS_USER_TRANSACTIONS => 'Транзакции пользователя',
        self::USERS_USER_TRANSACTIONS_DESTROY => 'Удаление транзакции пользователя',

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

        self::BONUSES_INDEX => 'Страница бонусов',
        self::BONUSES_ADD_BONUS => 'Выдача бонусов',

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
        self::WITHDRAWALS_DESTROY => 'Удаление операции вывода',

        self::REPLENISHMENTS_INDEX => 'Список пополнений',
        self::REPLENISHMENTS_SHOW => 'Просмотр операции пополнения',
        self::REPLENISHMENTS_APPROVE_MANUALLY => 'Вручную подтвердить операцию на пополнение',
        self::REPLENISHMENTS_DESTROY => 'Удаление операции попоплнения',

        self::TRANSACTIONS_INDEX => 'Список транзакции',
        self::TRANSACTIONS_SHOW => 'Просмотр данных транзакции',
        self::TRANSACTIONS_DESTROY => 'Удаление транзакции',

        self::CLOUD_FILES => 'Список файлов в облачном хранилище',
        self::CLOUD_FILES_UPLOAD => 'Загрузка файлов в облачное хранилище',
        self::CLOUD_FILES_DESTROY => 'Удаление файлов из облачного хранилища',
        self::CLOUD_FILES_OPEN => 'Просмотр файлов из облачного хранилища',
        self::CLOUD_FILES_FOLDER_CREATE => 'Создание папок для файлов в облачном хранилище',
        self::CLOUD_FILES_FOLDER_DESTROY => 'Удаление папок для файлов зи облачного хранилища',

        self::KANBAN_INDEX => 'Kanban панель',
        self::KANBAN_BOARD_STORE => 'Добавление доски на Kanban панели',
        self::KANBAN_BOARD_TASK_STORE => 'Добавление задачи в доске на Kanban панели',
        self::KANBAN_BOARD_TASK_CHANGE_BOARD => 'Перемещение задач между досками Kanban панели',
        self::KANBAN_BOARD_SORT_BOARDS => 'Мортировка досок Kanban панели',
        self::KANBAN_BOARD_UPDATE => 'Изменение доски Kanban панели',
        self::KANBAN_BOARD_DESTROY => 'Удаление доски из Kanban панели',

        self::RATES_INDEX => 'Список тарифов',
        self::RATES_STORE => 'Добавление тарифов',
        self::RATES_UPDATE => 'Изменение тарифов',
        self::RATES_DESTROY => 'Удаление тарифов',

        self::PAYMENT_SYSTEMS_INDEX => 'Список платежных систем',

        self::RATE_GROUPS_INDEX => 'Список групп тарифов',
        self::RATE_GROUPS_UPDATE => 'Изменение групп тарифов',

        self::VERIFICATION_REQUESTS_INDEX => 'Список заявок на подтверждение личности',
        self::VERIFICATION_REQUESTS_SHOW => 'Просмотр заявок на подтверждение личности',
        self::VERIFICATION_REQUESTS_UPDATE => 'Изменеие заявок на подтверждение личности',

        self::NEWS_INDEX => 'Раздел новостей',
        self::NEWS_DESTROY => 'Удаление новостей',
        self::NEWS_STORE => 'Добавление новостей',
        self::NEWS_UPDATE => 'Изменение новостей',

        self::PRODUCTS_INDEX => 'Раздел продуктов',
        self::PRODUCTS_STORE => 'Добавление продуктов',
        self::PRODUCTS_DESTROY => 'Удаление продуктов',
        self::PRODUCTS_UPDATE => 'Изменение продуктов',

        self::SUPPORT_TASKS_INDEX => 'Список топиков тех поддержки',
        self::SUPPORT_TASKS_SHOW => 'Просмотр топиков тех поддержки',
        self::SUPPORT_TASKS_CLOSE => 'Закрывание топиков тех поддержки',
        self::SUPPORT_TASKS_MESSAGES_STORE => 'Ответ на топик тех поддержки',

        self::REFERRALS_BANNERS_INDEX => 'Раздел уровней рефералов и промо',

        self::REFERRALS_STORE => 'Добавление уровней рефералов',
        self::REFERRALS_DESTROY => 'Удаление уровней рефералов',
        self::REFERRALS_UPDATE => 'Изменеие уровней рефералов',

        self::BANNERS_STORE => 'Добавление банеров',
        self::BANNERS_DESTROY => 'Удаление банеров',
        self::BANNERS_UPDATE => 'Изменеие банеров',

        self::CHAT_INDEX => 'Просмотр админ чата',
        self::CHAT_SEND_MESSAGE => 'Отправка личных сообщений админам',
        self::CHAT_COMMON_SEND_MESSAGE => 'Отправка сообщений в общий админ чат',

        self::CLIENT_LOGS => 'Просмотр логов в клиенте',

        self::CURRENCY_RATES_UPDATE => 'Изменения курса валют',
        self::CURRENCY_RATES_INDEX => 'Список курвсов валют',

        self::CURRENCY_EXCHANGE_INDEX => 'Список обменов валют',

        self::BACKUPS_INDEX => 'Список резервных копий',
        self::BACKUPS_STORE => 'Добавление резервной копии',
        self::BACKUPS_DESTROY => 'Удаление резервной копии',
        self::BACKUPS_DOWNLOAD => 'Скачивание резервной копии',

        self::IMPERSONATE => 'Авторизовываться под пользователями',

        self::DEPOSIT_BONUSES => 'Просмотр бонусов за оборот депозитов',
        self::DEPOSIT_BONUS_SET => 'Изменение бонусов',

        self::FAQ_INDEX => 'Просмотр всех вопрос-ответов',
        self::FAQ_ADD => 'Добавление вопрос-ответа',
        self::FAQ_UPDATE => 'Изменение вопрос-ответа',
        self::FAQ_DELETE => 'Удаление вопрос-ответа',

        self::VIDEO_INDEX => 'Просмотр всех видео',
        self::VIDEO_CONFIRM => 'Подтверждение видео',
        self::VIDEO_CANCEL => 'Отклонение видео',
        self::VIDEO_DELETE => 'Удаление видео',
        self::VIDEO_SAVE => 'Изменение видео',
    ];
}
