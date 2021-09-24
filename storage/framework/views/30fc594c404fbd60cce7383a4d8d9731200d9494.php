<aside style="margin-bottom: 20px" class="<?php echo e($configData['sidenavMain']); ?> <?php if(!empty($configData['activeMenuType'])): ?> <?php echo e($configData['activeMenuType']); ?> <?php else: ?> <?php echo e($configData['activeMenuTypeClass']); ?><?php endif; ?> <?php if(($configData['isMenuDark']) === true): ?> <?php echo e('sidenav-dark'); ?> <?php elseif(($configData['isMenuDark']) === false): ?><?php echo e('sidenav-light'); ?>  <?php else: ?> <?php echo e($configData['sidenavMainColor']); ?><?php endif; ?> <?php echo e($configData['menuBgColor']); ?>">
  <div class="brand-sidebar">
    <h1 class="logo-wrapper">
      <a class="brand-logo darken-1" href="<?php echo e(asset('/')); ?>">
        <?php if(!empty($configData['mainLayoutType']) && isset($configData['mainLayoutType'])): ?>
          <?php if($configData['mainLayoutType']=== 'vertical-modern-menu'): ?>
            <img class="hide-on-med-and-down" src="<?php echo e(asset($configData['largeScreenLogo'])); ?>" alt="materialize logo" />
            <img class="show-on-medium-and-down hide-on-med-and-up" src="<?php echo e(asset($configData['smallScreenLogo'])); ?>"
                alt="materialize logo" />
          
          <?php elseif($configData['mainLayoutType']=== 'vertical-menu-nav-dark'): ?>
            <img src="<?php echo e(asset($configData['smallScreenLogo'])); ?>" alt="materialize logo" />
          
          <?php elseif($configData['mainLayoutType']=== 'vertical-gradient-menu'): ?>
            <img class="show-on-medium-and-down hide-on-med-and-up" src="<?php echo e(asset($configData['largeScreenLogo'])); ?>"
                alt="materialize logo" />
            <img class="hide-on-med-and-down" src="<?php echo e(asset($configData['smallScreenLogo'])); ?>" alt="materialize logo" />
          
          <?php elseif($configData['mainLayoutType']=== 'vertical-dark-menu'): ?>
            <img class="show-on-medium-and-down hide-on-med-and-up" src="<?php echo e(asset($configData['largeScreenLogo'])); ?>"
                alt="materialize logo" />
            <img class="hide-on-med-and-down" src="<?php echo e(asset($configData['smallScreenLogo'])); ?>" alt="materialize logo" />
          <?php endif; ?>
        <?php endif; ?>
        <span class="logo-text hide-on-med-and-down">
          <?php if(!empty ($configData['templateTitle']) && isset($configData['templateTitle'])): ?>
            <?php echo e($configData['templateTitle']); ?>

          <?php else: ?>
            Wallstreet
          <?php endif; ?>
        </span>
      </a>
      <a class="navbar-toggler" href="javascript:void(0)"><i class="material-icons">radio_button_checked</i></a>
    </h1>
  </div>
  <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
    
    <li class="bold ">
      <a class="waves-effect waves-cyan <?php echo e((Route::is('home') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('home') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('home')); ?>">
        <i class="material-icons">dashboard</i>
        <span class="menu-title" data-i18n="Дашборд">Дашборд</span>
      </a>
    </li>
    
    <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NOTIFICATIONS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CHAT_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::USERS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::VERIFICATION_REQUESTS_INDEX])): ?>
      <li class="bold <?php if(Route::is('notifications.*') || Route::is('referral.tree.*') || Route::is('chat') || Route::is('users.*') || Route::is('verification-requests.*')): ?> active <?php endif; ?>">
        <a class="collapsible-header waves-effect waves-cyan " style="<?php echo Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="JavaScript:void(0)">
          <i class="material-icons">assignment_ind</i>
          <span class="menu-title" data-i18n="Пользователи">Пользователи</span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::USERS_INDEX])): ?>
              <li>
                <a href="<?php echo e(route('users.index')); ?>" class="<?php if(Route::is('users.*')): ?> active <?php endif; ?>">
                  <i class="material-icons">people</i>
                  <span class="menu-title" data-i18n="Пользователи">Все клиенты</span>
                  <?php if($counts['users']): ?><span class="badge badge pill green float-right mr-3"><?php echo e($counts['users']); ?></span><?php endif; ?>
                </a>
              </li>
            <?php endif; ?>
            






            
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::VERIFICATION_REQUESTS_INDEX])): ?>
              <li>
                <a class="waves-effect waves-cyan <?php echo e((Route::is('verification-requests.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('verification-requests*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('verification-requests.index')); ?>">
                  <i class="material-icons">verified_user</i>
                  <span class="menu-title" data-i18n="Подтверждение личности">Подтверждение личности</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NOTIFICATIONS_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('notifications.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('notifications*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('notifications.index')); ?>">
                  <i class="material-icons">notifications</i>
                  <span class="menu-title" data-i18n="Уведомления">Уведомления</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CHAT_INDEX])): ?>
              <li>
                <a class="waves-effect waves-cyan <?php echo e((Route::is('chat') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('chat')); ?>">
                  <i class="material-icons">chat</i>
                  <span class="menu-title" data-i18n="Пользователи">Чаты</span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </li>
    <?php endif; ?>
    
    <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REPLENISHMENTS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSITS]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::WITHDRAWALS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::TRANSACTIONS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_EXCHANGE_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_RATES_INDEX]) ): ?>
      <li class="bold <?php if(Route::is('replenishments.*') || Route::is('deposits.*') || Route::is('withdrawals.*') ||  Route::is('transactions.*') || Route::is('currency-exchange.*') || Route::is('currency-rates.*')  ): ?> active <?php endif; ?>">
        <a class="collapsible-header waves-effect waves-cyan " style="<?php echo Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="JavaScript:void(0)">
          <i class="material-icons">account_balance</i>
          <span class="menu-title" data-i18n="Пользователи">Финансы</span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REPLENISHMENTS_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('replenishments.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('replenishments*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('replenishments.index')); ?>">
                  <i class="material-icons">forward</i>
                  <span class="menu-title" data-i18n="Пополнения">Пополнения</span>
                  <?php if($counts['replenishments_amount']): ?><span class="badge badge pill green float-right mr-3">$<?php echo e($counts['replenishments_amount']); ?></span><?php endif; ?>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSITS])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('deposits.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('deposits*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('deposits.index')); ?>">
                  <i class="material-icons">attach_money</i>
                  <span class="menu-title" data-i18n="Трпнзакции">Депозиты</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::WITHDRAWALS_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('withdrawals.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('withdrawals*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('withdrawals.index')); ?>">
                  <i class="material-icons">monetization_on</i>
                  <span class="menu-title" data-i18n="Выводы">Выводы</span>
                  <?php if($counts['withdrawals_amount']): ?><span class="badge badge pill red float-right mr-3">$<?php echo e($counts['withdrawals_amount']); ?></span><?php endif; ?>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::TRANSACTIONS_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('transactions.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('transactions*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('transactions.index')); ?>">
                  <i class="material-icons">swap_calls</i>
                  <span class="menu-title" data-i18n="Трпнзакции">Транзакции</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_EXCHANGE_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('currency-exchange.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('deposits*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('currency-exchange')); ?>">
                  <i class="material-icons">autorenew</i>
                  <span class="menu-title" data-i18n="Обмен валют">Обмен валют</span>
                  <?php if($counts['currency_exchange_count']): ?><span class="badge badge pill purple float-right mr-3"><?php echo e($counts['currency_exchange_count']); ?></span><?php endif; ?>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_RATES_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('currency-rates.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('currency-rates*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('currency-rates.index')); ?>">
                  <i class="material-icons">compare_arrows</i>
                  <span class="menu-title" data-i18n="Курс валют">Курс валют</span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </li>
    <?php endif; ?>
    
    <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NOTIFICATIONS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSIT_BONUSES]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REFERRALS_BANNERS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::RATES_INDEX])): ?>
      <li class="bold <?php if(Route::is('notifications.*') || Route::is('deposit.bonuses') || Route::is('referrals-and-banners.*') || Route::is('banners.*') || Route::is('referrals.*') || Route::is('rates.*')): ?> active <?php endif; ?>">
        <a class="collapsible-header waves-effect waves-cyan " style="<?php echo Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="JavaScript:void(0)">
          <i class="material-icons">trending_up</i>
          <span class="menu-title" data-i18n="Пользователи">Маркетинг</span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REFERRALS_BANNERS_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('referrals-and-banners.referrals') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo (Route::is('referrals-and-banners.*') || Route::is('banners.*') || Route::is('referrals.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('referrals-and-banners.referrals')); ?>">
                  <i class="material-icons">blur_linear</i>
                  <span class="menu-title" data-i18n="Реферальные уровни/Баннеры">Реф уровни</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REFERRALS_BANNERS_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('referrals-and-banners.banners.all') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo (Route::is('referrals-and-banners.*') || Route::is('banners.*') || Route::is('referrals.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('referrals-and-banners.banners.all')); ?>">
                  <i class="material-icons">blur_linear</i>
                  <span class="menu-title" data-i18n="Реферальные уровни/Баннеры">Баннеры</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSIT_BONUSES])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('deposit.bonuses') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo (Route::is('deposit-bonuses.*') || Route::is('deposit.bonuses.*') || Route::is('deposit.bonuses.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('deposit.bonuses')); ?>">
                  <i class="material-icons">new_releases</i>
                  <span class="menu-title" data-i18n="">Бонусы за оборот депозитов</span>
                </a>
              </li>
            <?php endif; ?>
              <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::RATES_INDEX])): ?>
                <li class="bold">
                  <a class="waves-effect waves-cyan <?php echo e((Route::is('rates.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('rates*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('rates.index')); ?>">
                    <i class="material-icons">show_chart</i>
                    <span class="menu-title" data-i18n="Тарифы">Тарифы</span>
                  </a>
                </li>
              <?php endif; ?>
          </ul>
        </div>
      </li>
    <?php endif; ?>
    
    <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::KANBAN_INDEX])): ?>
      <li class="bold">
        <a class="waves-effect waves-cyan <?php echo e((Route::is('kanban.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('kanban*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('kanban.index')); ?>">
          <i class="material-icons">developer_board</i>
          <span class="menu-title" data-i18n="Задачи">Задачи</span>
          <?php if($counts['tasks']): ?><span class="badge badge pill orange float-right mr-3"><?php echo e($counts['tasks']); ?></span><?php endif; ?>
        </a>
      </li>
    <?php endif; ?>
    
    <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CLOUD_FILES])): ?>
      <li class="bold">
        <a class="waves-effect waves-cyan <?php echo e((Route::is('cloud_files.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('cloud_files*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('cloud_files.manager')); ?>">
          <i class="material-icons">cloud_download</i>
          <span class="menu-title" data-i18n="Менеджер файлов">Инструменты</span>
          
        </a>
      </li>
    <?php endif; ?>
    <li class="bold">
      <a class="waves-effect waves-cyan " target="_blank" style="<?php echo isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="https://quasar.sprintbank.us">
        <i class="material-icons">devices</i>
        <span class="menu-title" data-i18n="Новости">Моб. Приложение</span>
      </a>
    </li>
    <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NEWS_PRODUCTS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::FAQ_INDEX])): ?>
      <li class="bold <?php if(Route::is('news-and-products.*') || Route::is('news.*') || Route::is('products.*') || Route::is('banners.*') || Route::is('referrals.*') || Route::is('faq.*')): ?> active <?php endif; ?>">
        <a class="collapsible-header waves-effect waves-cyan " style="<?php echo Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="JavaScript:void(0)">
          <i class="material-icons">web</i>
          <span class="menu-title" data-i18n="Пользователи">Контент</span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NEWS_PRODUCTS_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('news-and-products*') || Route::is('news.*') || Route::is('products.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo (Route::is('news-and-products*') || Route::is('news.*') || Route::is('products.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('news-and-products.index')); ?>">
                  <i class="material-icons">list</i>
                  <span class="menu-title" data-i18n="Новости">Новости/Продукты</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::FAQ_INDEX])): ?>
              <li class="bold">
                <a class="waves-effect waves-cyan <?php echo e((Route::is('faq.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('faq*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('faq.index')); ?>">
                  <i class="material-icons">info</i>
                  <span class="menu-title" data-i18n="Тех поддержка">Вопрос - ответ</span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </li>
    <?php endif; ?>
    
    
    
    <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::ROLES_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::PERMISSIONS_INDEX])): ?>
      <li class="bold <?php if(Route::is('roles.*') || Route::is('permissions.*')): ?> active <?php endif; ?>">
        <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
          <i class="material-icons">lock</i>
          <span class="menu-title" data-i18n="">Доступы</span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::ROLES_INDEX])): ?>
              <li>
                <a href="<?php echo e(route('roles.index')); ?>" class="<?php echo e((Route::is('roles.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>">
                  <i class="material-icons">transfer_within_a_station</i>
                  <span data-i18n="Second level">Роли</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::PERMISSIONS_INDEX])): ?>
              <li>
                <a href="<?php echo e(route('permissions.index')); ?>" class="<?php echo e((Route::is('permissions.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>">
                  <i class="material-icons">lock_open</i>
                  <span data-i18n="Second level child">Права</span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </li>
    <?php endif; ?>
    <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::BACKUPS_INDEX])): ?>
      <li class="bold">
        <a class="waves-effect waves-cyan <?php echo e((Route::is('backup.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '')); ?>" style="<?php echo Route::is('backup*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : ''; ?>" href="<?php echo e(route('backup.index')); ?>">
          <i class="material-icons">backup</i>
          <span class="menu-title" data-i18n="Резервные копии">Резервные копии</span>
        </a>
      </li>
    <?php endif; ?>
    <?php if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::SETTINGS_SWITCH_SITE_STATUS])): ?>
      <li class="bold" style="margin-bottom: 30px">
        <label class="ml-10">
          <input type="checkbox" name="disable_client_site" <?php echo e(\App\Models\Setting::getValue('disable_client_site') == 'true' ? 'checked' : ''); ?>/>
          <span>Отключить сайт</span>
        </label>
      </li>
    <?php endif; ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
  
  </ul>
  
  <div class="navigation-background"></div>
  <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
      href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside><?php /**PATH /var/www/resources/views/panels/sidebar.blade.php ENDPATH**/ ?>