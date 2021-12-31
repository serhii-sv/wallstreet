Wallstreet

How to install:

- git clone git@bitbucket.org:serhii-v/wallstreet.git
- cd wallstreet
- If you would like to use Docker (installing may take some while, first time installing 30-60 min depends on your perfomance):
    - git clone https://github.com/Laradock/laradock.git laradock-wallstreet
    - cd laradock-wallstreet
    - cp .env.example .env
    - Change prefix in .env
    - docker-compose up -d nginx mariadb php-fpm phpmyadmin workspace redis mailhog memcached
    - docker-compose exec workspace bash
- composer install
- cp .env.example .env
- php artisan install

##Установка и настройка чат бота для телеграм

Первый шаг это создание нового бота через встроенный менеджер ботов BotFather https://t.me/BotFather

- Для сохдания новго бота нужно использовать команду /newbot

После этого BotFather предложит вам назвать своего бота:

> <b>Alright, a new bot. How are we going to call it? Please choose a name for your bot.

В полее ввода сообщений вводите название бота. Например: WallstreetBot

- После этого BotFather предложит ввести никнейм для нового бота:

> <b>Good. Now let's choose a username for your bot. It must end in `bot`. Like this, for example: TetrisBot or tetris_bot.

Никнейм бота в обязательном порядке должен заканчиваться на слово `bot` не зависимо от регистра

- Если все введено правильно, то BotFather попреветствует вас с удачным созданием бота следующим текстом:

> <b>Done! Congratulations on your new bot. You will find it at t.me/WallstreetBot. You can now add a description, about section and profile picture for your bot, see /help for a list of commands. By the way, when you've finished creating your cool bot, ping our Bot Support if you want a better username for it. Just make sure the bot is fully operational before you do this.
>
> Use this token to access the HTTP API:
132487:DFSdgfsfgdfG-DFgdfgdfgd
Keep your token secure and store it safely, it can be used by anyone to control your bot.
>
> For a description of the Bot API, see this page: https://core.telegram.org/bots/api

- Здесь нам понадобится токен бота для последующей работы с ботом

<b>Use this token to access the HTTP API:
132487:DFSdgfsfgdfG-DFgdfgdfgd

##Настройка работы бота на сайте (для разоаботчиков)

Токен бота нужно добавить в .env 

> <b>TELEGRAM_BOT_TOKEN=132487:DFSdgfsfgdfG-DFgdfgdfgd

После этого нужно установить Webhook для бота чтоб комманды с бота обрабатывались сайтом

Для установки Webhook нужно запустит консольную комманду внутри проекта:

> <b>php artisan telegram:set-webhook

После этого будет настроен Webhook для адресса указанного в .env по ключу `APP_URL`

> <b>APP_URL=https://your-domain-name.com

Именно на этот домен будут приходить Webhook от телеграм бота

> Обязательным условием является то, что домен обязательно должен работать по протоколу `https`

