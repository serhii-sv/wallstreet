<aside class="{{$configData['sidenavMain']}} @if(!empty($configData['activeMenuType'])) {{$configData['activeMenuType']}} @else {{$configData['activeMenuTypeClass']}}@endif @if(($configData['isMenuDark']) === true) {{'sidenav-dark'}} @elseif(($configData['isMenuDark']) === false){{'sidenav-light'}}  @else {{$configData['sidenavMainColor']}}@endif">
  <div class="brand-sidebar">
    <h1 class="logo-wrapper">
      <a class="brand-logo darken-1" href="{{asset('/')}}">
        @if(!empty($configData['mainLayoutType']) && isset($configData['mainLayoutType']))
          @if($configData['mainLayoutType']=== 'vertical-modern-menu')
            <img class="hide-on-med-and-down" src="{{asset($configData['largeScreenLogo'])}}" alt="materialize logo" />
            <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['smallScreenLogo'])}}"
                alt="materialize logo" />

          @elseif($configData['mainLayoutType']=== 'vertical-menu-nav-dark')
            <img src="{{asset($configData['smallScreenLogo'])}}" alt="materialize logo" />

          @elseif($configData['mainLayoutType']=== 'vertical-gradient-menu')
            <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['largeScreenLogo'])}}"
                alt="materialize logo" />
            <img class="hide-on-med-and-down" src="{{asset($configData['smallScreenLogo'])}}" alt="materialize logo" />

          @elseif($configData['mainLayoutType']=== 'vertical-dark-menu')
            <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['largeScreenLogo'])}}"
                alt="materialize logo" />
            <img class="hide-on-med-and-down" src="{{asset($configData['smallScreenLogo'])}}" alt="materialize logo" />
          @endif
        @endif
        <span class="logo-text hide-on-med-and-down">
          @if(!empty ($configData['templateTitle']) && isset($configData['templateTitle']))
            {{$configData['templateTitle']}}
          @else
            Wallstreet
          @endif
        </span>
      </a>
      <a class="navbar-toggler" href="javascript:void(0)"><i class="material-icons">radio_button_checked</i></a>
    </h1>
  </div>
  <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('home') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('home') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}"  href="{{ route('home') }}">
        <i class="material-icons">dashboard</i>
        <span class="menu-title" data-i18n="Дашборд">Дашборд</span>
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('users.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('users.index') }}">
        <i class="material-icons">people</i>
        <span class="menu-title" data-i18n="Пользователи">Пользователи</span>
        <span class="badge badge pill purple float-right mr-3">{{ $counts['users'] }}</span>
      </a>
    </li>


    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('withdrawals.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('withdrawals*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('withdrawals.index') }}">
        <i class="material-icons">monetization_on</i>
        <span class="menu-title" data-i18n="Выводы">Выводы</span>
        <span class="badge badge pill purple float-right mr-3">${{ $counts['withdrawals_amount'] }}</span>
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('replenishments.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('replenishments*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('replenishments.index') }}">
        <i class="material-icons">forward</i>
        <span class="menu-title" data-i18n="Пополнения">Пополнения</span>
        <span class="badge badge pill purple float-right mr-3">${{ $counts['replenishments_amount'] }}</span>
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('transactions.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('transactions*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('transactions.index') }}">
        <i class="material-icons">swap_calls</i>
        <span class="menu-title" data-i18n="Трпнзакции">Транзакции</span>
        <span class="badge badge pill purple float-right mr-3">${{ $counts['transactions_amount'] }}</span>
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('deposits.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('deposits*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('deposits.index') }}">
        <i class="material-icons">attach_money</i>
        <span class="menu-title" data-i18n="Трпнзакции">Депозиты</span>
        <span class="badge badge pill purple float-right mr-3">${{ $counts['deposits_active_amount'] }}</span>

        {{--                <span class="badge badge pill purple float-right mr-10">${{ number_format(ceil($counts['replenishments_amount']), 0, ',', ' ') }}</span>--}}
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('cloud_files.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('cloud_files*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('cloud_files.manager') }}">
        <i class="material-icons">cloud_download</i>
        <span class="menu-title" data-i18n="Менеджер файлов">Файлы</span>
        <span class="badge badge pill purple float-right mr-3">{{ $counts['files'] }}</span>
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('notifications.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('notifications*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('notifications.index') }}">
        <i class="material-icons">cloud_download</i>
        <span class="menu-title" data-i18n="Уведомления">Уведомления</span>
      </a>
    </li>
      <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('news.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('news*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('news.index') }}">
              <i class="material-icons">list</i>
              <span class="menu-title" data-i18n="Новости">Новости</span>
          </a>
      </li>
      <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('kanban.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('kanban*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('kanban.index') }}">
              <i class="material-icons">developer_board</i>
              <span class="menu-title" data-i18n="Задачи">Задачи</span>
          </a>
      </li>

      <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('rates.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('rates*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('rates.index') }}">
              <i class="material-icons">show_chart</i>
              <span class="menu-title" data-i18n="Тарифы">Тарифы</span>
          </a>
      </li>
    <li class="bold">
      <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
        <i class="material-icons">photo_filter</i>
        <span class="menu-title" data-i18n="">Доступы</span>
      </a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          <li>
            <a href="{{ route('roles.index') }}"><i class="material-icons">radio_button_unchecked</i>
              <span data-i18n="Second level">Роли</span>
            </a>
          </li>
          <li>
            <a href="{{ route('permissions.index') }}">
              <i class="material-icons">radio_button_unchecked</i>
              <span data-i18n="Second level child">Права</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    {{--   DROPDOWN     --}}
    {{--        <li class="active bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge pill orange float-right mr-10">3</span></a>--}}
    {{--            <div class="collapsible-body">--}}
    {{--                <ul class="collapsible collapsible-sub" data-collapsible="accordion">--}}
    {{--                    <li class="active"><a class="active" href="dashboard-modern.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">Modern</span></a>--}}
    {{--                    </li>--}}
    {{--                    <li><a href="dashboard-ecommerce.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="eCommerce">eCommerce</span></a>--}}
    {{--                    </li>--}}
    {{--                    <li><a href="dashboard-analytics.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Analytics</span></a>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--        </li>--}}

  </ul>
  <div class="navigation-background"></div>
  <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
      href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
