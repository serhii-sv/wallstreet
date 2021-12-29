<style>
    aside.white .logo-text, aside.white .brand-sidebar i.material-icons, aside.white ul.sidenav li a:not(.active) {
        color: rgba(0, 0, 0, .87) !important
    }

    aside.white ul.sidenav li a:not(.active) i.material-icons {
        color: rgba(0, 0, 0, .54);
    }

    aside.white .brand-sidebar {
        box-shadow: 0 4px 7px 0 rgb(0 0 0 / 20%)
    }
    .brand-logo {
        margin-top: 10px !important;
    }
</style>
<aside style="margin-bottom: 20px;" class="{{$configData['sidenavMain']}} @if(!empty($configData['activeMenuType'])) {{$configData['activeMenuType']}} @else {{$configData['activeMenuTypeClass']}}@endif @if(($configData['isMenuDark']) === true) {{'sidenav-dark'}} @elseif(($configData['isMenuDark']) === false){{'sidenav-light'}}  @else {{$configData['sidenavMainColor']}}@endif {{ $configData['menuBgColor'] }}">
  <div class="brand-sidebar">
    <h1 class="logo-wrapper">
      <a class="brand-logo darken-1" href="{{asset('/')}}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
        @if(!empty($configData['mainLayoutType']) && isset($configData['mainLayoutType']))
          @if($configData['mainLayoutType']=== 'vertical-modern-menu')
            {{--  <img class="hide-on-med-and-down" src="{{asset($configData['largeScreenLogo'])}}" alt="materialize logo" />
              <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['smallScreenLogo'])}}"
                  alt="materialize logo" />--}}

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
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Wallstreet' contenteditable="true">{{ __('Wallstreet') }}</editor_block>
            @else
              {{ __('Wallstreet') }}
            @endif
          @endif
        </span>
      </a>
      <a class="navbar-toggler" href="javascript:void(0)"><i class="material-icons">radio_button_checked</i></a>
    </h1>
  </div>
  <ul class="mt-1 sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

    <li class="bold ">
      <a class="waves-effect waves-cyan {{ (Route::is('home') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('home') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('home') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
        <i class="material-icons">dashboard</i>
        <span class="menu-title">@if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name='Dashboard' contenteditable="true">{{ __('Dashboard') }}</editor_block>
          @else
            {{ __('Dashboard') }}
          @endif</span>
      </a>
    </li>

    @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NOTIFICATIONS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CHAT_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::USERS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::VERIFICATION_REQUESTS_INDEX]))
      <li class="bold @if(Route::is('notifications.*') || Route::is('referral.tree.*') || Route::is('chat') || Route::is('users.*') || Route::is('verification-requests.*')) active @endif">
        <a class="collapsible-header waves-effect waves-cyan " style="{!! Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="JavaScript:void(0)">
          <i class="material-icons">assignment_ind</i>
          <span class="menu-title">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Users' contenteditable="true">{{ __('Users') }}</editor_block>
            @else
              {{ __('Users') }}
            @endif
          </span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::USERS_INDEX]))
              <li>
                <a href="{{ route('users.index') }}" class="@if(Route::is('users.*')) active @endif" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">people</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='All clients' contenteditable="true">{{ __('All clients') }}</editor_block>
                    @else
                      {{ __('All clients') }}
                    @endif
                  </span>
                  @if($counts['users'])
                    <span class="badge badge pill green float-right mr-3">{{ $counts['users'] }}</span>@endif
                </a>
              </li>
            @endif

            {{--            <li>--}}
            {{--              <a href="{{ route('referrals.tree.index') }}" class="@if(Route::is('referrals.tree.*')) active @endif">--}}
            {{--                <i class="material-icons">device_hub</i>--}}
            {{--                <span class="menu-title" data-i18n="Пользователи">Дерево рефералов</span>--}}
            {{--              </a>--}}
            {{--            </li>--}}

            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::VERIFICATION_REQUESTS_INDEX]))
              <li>
                <a class="waves-effect waves-cyan {{ (Route::is('verification-requests.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('verification-requests*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('verification-requests.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">verified_user</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='ID confirmation' contenteditable="true">{{ __('ID confirmation') }}</editor_block>
                    @else
                      {{ __('ID confirmation') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NOTIFICATIONS_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('notifications.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('notifications*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('notifications.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">notifications</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Notifications' contenteditable="true">{{ __('Notifications') }}</editor_block>
                    @else
                      {{ __('Notifications') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CHAT_INDEX]))
              <li>
                <a class="waves-effect waves-cyan {{ (Route::is('chat') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('chat') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">chat</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Chat rooms' contenteditable="true">{{ __('Chat rooms') }}</editor_block>
                    @else
                      {{ __('Chat rooms') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif
          </ul>
        </div>
      </li>
    @endif

    @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REPLENISHMENTS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSITS]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::WITHDRAWALS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::TRANSACTIONS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_EXCHANGE_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_RATES_INDEX]) )
      <li class="bold @if(Route::is('replenishments.*') || Route::is('deposits.*') || Route::is('withdrawals.*') ||  Route::is('transactions.*') || Route::is('currency-exchange.*') || Route::is('currency-rates.*') || Route::is('bonuses.*') || Route::is('currency-exchange') || Route::is('payment_systems.*')  ) active @endif">
        <a class="collapsible-header waves-effect waves-cyan " style="{!! Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="JavaScript:void(0)">
          <i class="material-icons">account_balance</i>
          <span class="menu-title">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Finance' contenteditable="true">{{ __('Finance') }}</editor_block>
            @else
              {{ __('Finance') }}
            @endif</span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REPLENISHMENTS_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('replenishments.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('replenishments*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('replenishments.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">forward</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Replenishment' contenteditable="true">{{ __('Replenishment') }}</editor_block>
                    @else
                      {{ __('Replenishment') }}
                    @endif
                  </span>
                  @if($counts['replenishments_amount'])
                    <span class="badge badge pill green float-right mr-3">${{ $counts['replenishments_amount'] }}</span>@endif
                </a>
              </li>
            @endif
                @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSITS]))
                    <li class="bold">
                        <a class="waves-effect waves-cyan {{ (Route::is('deposits.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('deposits*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('deposits.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                            <i class="material-icons">attach_money</i>
                            <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Deposits' contenteditable="true">{{ __('Deposits') }}</editor_block>
                                @else
                                    {{ __('Deposits') }}
                                @endif
                  </span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::BONUSES_INDEX]))
                    <li class="bold">
                        <a class="waves-effect waves-cyan {{ (Route::is('bonuses.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('deposits*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('bonuses.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                            <i class="material-icons">blur_linear</i>
                            <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Bonuses index' contenteditable="true">{{ __('Bonuses index') }}</editor_block>
                                @else
                                    {{ __('Bonuses index') }}
                                @endif
                  </span>
                        </a>
                    </li>
                @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::WITHDRAWALS_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('withdrawals.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('withdrawals*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('withdrawals.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">monetization_on</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Withdrawals' contenteditable="true">{{ __('Withdrawals') }}</editor_block>
                    @else
                      {{ __('Withdrawals') }}
                    @endif
                  </span>
                  @if($counts['withdrawals_amount'])
                    <span class="badge badge pill red float-right mr-3">${{ $counts['withdrawals_amount'] }}</span>
                    @endif
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::TRANSACTIONS_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('transactions.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('transactions*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('transactions.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">swap_calls</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Transaction' contenteditable="true">{{ __('Transaction') }}</editor_block>
                    @else
                      {{ __('Transaction') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_EXCHANGE_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('currency-exchange') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('deposits*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('currency-exchange') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">autorenew</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Currency exchange' contenteditable="true">{{ __('Currency exchange') }}</editor_block>
                    @else
                      {{ __('Currency exchange') }}
                    @endif
                    </span>
{{--                  @if($counts['currency_exchange_count'])--}}
{{--                    <span class="badge badge pill purple float-right mr-3">{{ $counts['currency_exchange_count'] }}</span>@endif--}}
                </a>
              </li>
            @endif
                @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_RATES_INDEX]))
                    <li class="bold">
                        <a class="waves-effect waves-cyan {{ (Route::is('currency-rates.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('currency-rates*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('currency-rates.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                            <i class="material-icons">compare_arrows</i>
                            <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Exchange Rates' contenteditable="true">{{ __('Exchange Rates') }}</editor_block>
                                @else
                                    {{ __('Exchange Rates') }}
                                @endif
                  </span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::PAYMENT_SYSTEMS_INDEX]))
                    <li class="bold">
                        <a class="waves-effect waves-cyan {{ (Route::is('payment_systems.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('payment_systems*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('payment_systems.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                            <i class="material-icons">monetization_on</i>
                            <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Payment systems' contenteditable="true">{{ __('Payment systems') }}</editor_block>
                                @else
                                    {{ __('Payment systems') }}
                                @endif
                  </span>
                        </a>
                    </li>
                @endif
          </ul>
        </div>
      </li>
    @endif

    @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NOTIFICATIONS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSIT_BONUSES]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REFERRALS_BANNERS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::RATES_INDEX]))
      <li class="bold @if(Route::is('notifications.*') || Route::is('deposit.bonuses')  || Route::is('referrals.*') || Route::is('rates.*') || Route::is('user.phone.verification') || Route::is('referrals-and-banners.referrals')) active @endif">
        <a class="collapsible-header waves-effect waves-cyan " style="{!! Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="JavaScript:void(0)">
          <i class="material-icons">trending_up</i>
          <span class="menu-title">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Marketing' contenteditable="true">{{ __('Marketing') }}</editor_block>
            @else
              {{ __('Marketing') }}
            @endif
          </span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REFERRALS_BANNERS_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('referrals-and-banners.referrals') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!!(Route::is('referrals-and-banners.*') || Route::is('banners.*') || Route::is('referrals.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('referrals-and-banners.referrals') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">blur_linear</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Referral levels' contenteditable="true">{{ __('Referral levels') }}</editor_block>
                    @else
                      {{ __('Referral levels') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif

            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSIT_BONUSES]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('deposit.bonuses') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!!(Route::is('deposit-bonuses.*') || Route::is('deposit.bonuses.*') || Route::is('deposit.bonuses.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('deposit.bonuses') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">new_releases</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Deposit turnover bonuses' contenteditable="true">{{ __('Deposit turnover bonuses') }}</editor_block>
                    @else
                      {{ __('Deposit turnover bonuses') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::RATES_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('rates.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('rates*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('rates.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">show_chart</i>
                  <span class="menu-title">
                      @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Tariffs' contenteditable="true">{{ __('Tariffs') }}</editor_block>
                    @else
                      {{ __('Tariffs') }}
                    @endif
                    </span>
                </a>
              </li>
            @endif
          </ul>
        </div>
      </li>
    @endif

    @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::KANBAN_INDEX]))
      <li class="bold">
        <a class="waves-effect waves-cyan {{ (Route::is('kanban.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('kanban*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('kanban.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
          <i class="material-icons">developer_board</i>
          <span class="menu-title">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Tasks' contenteditable="true">{{ __('Tasks') }}</editor_block>
            @else
              {{ __('Tasks') }}
            @endif
          </span>
          @if($counts['tasks'])
            <span class="badge badge pill orange float-right mr-3">{{ $counts['tasks'] }}</span>@endif
        </a>
      </li>
    @endif

    @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CLOUD_FILES]))
      <li class="bold">
        <a class="waves-effect waves-cyan {{ (Route::is('cloud_files.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('cloud_files*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('cloud_files.manager') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
          <i class="material-icons">cloud_download</i>
          <span class="menu-title">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Instruments' contenteditable="true">{{ __('Instruments') }}</editor_block>
            @else
              {{ __('Instruments') }}
            @endif
          </span>
          {{--        <span class="badge badge pill purple float-right mr-3">{{ $counts['files'] }}</span>--}}
        </a>
      </li>
    @endif
      <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('user.phone.verification') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('user.phone.verification') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}"
             href="{{ route('user.phone.verification') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i class="material-icons">sms</i>
              <span class="menu-title">
                      @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Sms' contenteditable="true">{{ __('Sms') }}</editor_block>
                  @else
                      {{ __('Sms') }}
                  @endif
                    </span>
          </a>
      </li>
    <li class="bold">
      <a class="waves-effect waves-cyan " target="_blank" style="{!! isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="https://quasar.sprint-bank.com" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
        <i class="material-icons">devices</i>
        <span class="menu-title">
          @if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name='Mobile app' contenteditable="true">{{ __('Mobile app') }}</editor_block>
          @else
            {{ __('Mobile app') }}
          @endif
        </span>
      </a>
    </li>
    @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NEWS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::PRODUCTS_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::FAQ_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::VIDEO_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REFERRALS_BANNERS_INDEX]))
      <li class="bold @if(Route::is('news.*') || Route::is('news.*') || Route::is('banners.*') || Route::is('video.*') || Route::is('products.*') || Route::is('banners.*') || Route::is('referrals.*') || Route::is('faq.*') || Route::is('referrals-and-banners.banners.all')) active @endif">
        <a class="collapsible-header waves-effect waves-cyan " style="{!! Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="JavaScript:void(0)">
          <i class="material-icons">web</i>
          <span class="menu-title">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Content' contenteditable="true">{{ __('Content') }}</editor_block>
            @else
              {{ __('Content') }}
            @endif
          </span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NEWS_INDEX]))
                  <li class="bold">
                      <a class="waves-effect waves-cyan {{ (Route::is('news*') || Route::is('news.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! (Route::is('news.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('news.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                          <i class="material-icons">list</i>
                          <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Новости' contenteditable="true">{{ __('Новости') }}</editor_block>
                              @else
                                  {{ __('Новости') }}
                              @endif
                  </span>
                      </a>
                  </li>
              @endif
                  @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::PRODUCTS_INDEX]))
                      <li class="bold">
                          <a class="waves-effect waves-cyan {{ (Route::is('products.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! (Route::is('products.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('products.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                              <i class="material-icons">list</i>
                              <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Продукты' contenteditable="true">{{ __('Продукты') }}</editor_block>
                                  @else
                                      {{ __('Продукты') }}
                                  @endif
                  </span>
                          </a>
                      </li>
                  @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::FAQ_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('faq.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('faq*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('faq.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">info</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Question - answer' contenteditable="true">{{ __('Question - answer') }}</editor_block>
                    @else
                      {{ __('Question - answer') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REFERRALS_BANNERS_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('referrals-and-banners.banners.all') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!!(Route::is('referrals-and-banners.*') || Route::is('banners.*') || Route::is('referrals.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('referrals-and-banners.banners.all') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">blur_linear</i>
                  <span class="menu-title">
                      @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Promo (Banners)' contenteditable="true">{{ __('Promo (Banners)') }}</editor_block>
                    @else
                      {{ __('Promo (Banners)') }}
                    @endif
                    </span>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::VIDEO_INDEX]))
              <li class="bold">
                <a class="waves-effect waves-cyan {{ (Route::is('video.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('video*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('video.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">info</i>
                  <span class="menu-title">
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Videos' contenteditable="true">{{ __('Videos') }}</editor_block>
                    @else
                      {{ __('Videos') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif

          </ul>
        </div>
      </li>
    @endif
    {{--  @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::RATE_GROUPS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('rate.groups.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('rate.groups*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('rate.groups.index') }}">
            <i class="material-icons">show_chart</i>
            <span class="menu-title" data-i18n="Тарифы">Группы тарифов</span>
          </a>
        </li>
      @endif--}}
    {{-- <li class="bold">
       <a class="waves-effect waves-cyan {{ (Route::is('bin-check.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('bin-check*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('bin-check.index') }}">
         <i class="material-icons">credit_card</i>
         <span class="menu-title" data-i18n="Проверка платежных карт">Анализ платежных карт</span>
       </a>
     </li>--}}
    {{--   @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::SUPPORT_TASKS_INDEX]))
         <li class="bold">
           <a class="waves-effect waves-cyan {{ (Route::is('support-tasks.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('support-tasks*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('support-tasks.index') }}">
             <i class="material-icons">question_answer</i>
             <span class="menu-title" data-i18n="Тех поддержка">Тех поддержка</span>
           </a>
         </li>
       @endif--}}
    @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::ROLES_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::PERMISSIONS_INDEX]))
      <li class="bold @if(Route::is('roles.*') || Route::is('permissions.*')) active @endif">
        <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
          <i class="material-icons">lock</i>
          <span class="menu-title">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Access' contenteditable="true">{{ __('Access') }}</editor_block>
            @else
              {{ __('Access') }}
            @endif
          </span>
        </a>
        <div class="collapsible-body">
          <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::ROLES_INDEX]))
              <li>
                <a href="{{ route('roles.index') }}" class="{{ (Route::is('roles.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">transfer_within_a_station</i>
                  <span>
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Roles' contenteditable="true">{{ __('Roles') }}</editor_block>
                    @else
                      {{ __('Roles') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::PERMISSIONS_INDEX]))
              <li>
                <a href="{{ route('permissions.index') }}" class="{{ (Route::is('permissions.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">lock_open</i>
                  <span>
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Rights' contenteditable="true">{{ __('Rights') }}</editor_block>
                    @else
                      {{ __('Rights') }}
                    @endif
                  </span>
                </a>
              </li>
            @endif
          </ul>
        </div>
      </li>
    @endif
    @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::BACKUPS_INDEX]))
      <li class="bold">
        <a class="waves-effect waves-cyan {{ (Route::is('backup.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('backup*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('backup.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
          <i class="material-icons">backup</i>
          <span class="menu-title">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Backups' contenteditable="true">{{ __('Backups') }}</editor_block>
            @else
              {{ __('Backups') }}
            @endif
          </span>
        </a>
      </li>
    @endif
    @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::SETTINGS_SWITCH_SITE_STATUS]))
      <li class="bold">
        <label class="ml-10" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
          <input type="checkbox" name="disable_client_site" {{ \App\Models\Setting::getValue('disable_client_site', '', true) == 'true' ? 'checked' : '' }}/>
          <span>
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Disable site' contenteditable="true">{{ __('Disable site') }}</editor_block>
            @else
              {{ __('Disable site') }}
            @endif
          </span>
        </label>
      </li>
          <li class="bold" style="margin-bottom: 30px">
              <label class="ml-10" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <input type="checkbox" name="enable_snow" {{ \App\Models\Setting::getValue('enable_snow', '', true) == 'true' ? 'checked' : '' }}/>
                  <span>
            @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Снег на сайте' contenteditable="true">{{ __('Снег на сайте') }}</editor_block>
                      @else
                          {{ __('Снег на сайте') }}
                      @endif
          </span>
              </label>
          </li>
    @endif
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
  {{--  <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

      <li class="bold">
        <a class="waves-effect waves-cyan {{ (Route::is('home') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('home') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <span class="menu-title" data-i18n="Дашборд">Дашборд</span>
        </a>
      </li>
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CHAT_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('chat') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('chat') }}">
            <i class="material-icons">chat</i>
            <span class="menu-title" data-i18n="Пользователи">Чат</span>
            --}}{{--        <span class="badge badge pill green float-right mr-3"></span>--}}{{--
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::USERS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('users.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('users*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('users.index') }}">
            <i class="material-icons">people</i>
            <span class="menu-title" data-i18n="Пользователи">Пользователи</span>
            <span class="badge badge pill green float-right mr-3">{{ $counts['users'] }}</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::WITHDRAWALS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('withdrawals.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('withdrawals*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('withdrawals.index') }}">
            <i class="material-icons">monetization_on</i>
            <span class="menu-title" data-i18n="Выводы">Выводы</span>
            <span class="badge badge pill red float-right mr-3">${{ $counts['withdrawals_amount'] }}</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REPLENISHMENTS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('replenishments.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('replenishments*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('replenishments.index') }}">
            <i class="material-icons">forward</i>
            <span class="menu-title" data-i18n="Пополнения">Пополнения</span>
            <span class="badge badge pill green float-right mr-3">${{ $counts['replenishments_amount'] }}</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::TRANSACTIONS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('transactions.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('transactions*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('transactions.index') }}">
            <i class="material-icons">swap_calls</i>
            <span class="menu-title" data-i18n="Трпнзакции">Транзакции</span>
            --}}{{--        <span class="badge badge pill purple float-right mr-3">${{ $counts['transactions_amount'] }}</span>--}}{{--
          </a>
        </li>
      @endif

      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSITS]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('deposits.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('deposits*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('deposits.index') }}">
            <i class="material-icons">attach_money</i>
            <span class="menu-title" data-i18n="Трпнзакции">Депозиты</span>
            --}}{{--        <span class="badge badge pill purple float-right mr-3">${{ $counts['deposits_active_amount'] }}</span>--}}{{--

            --}}{{--                <span class="badge badge pill purple float-right mr-10">${{ number_format(ceil($counts['replenishments_amount']), 0, ',', ' ') }}</span>--}}{{--
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::DEPOSIT_BONUSES]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('deposit.bonuses.*') || Route::is('deposit-bonuses.*') || Route::is('deposit-bonuses.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!!(Route::is('deposit-bonuses.*') || Route::is('deposit.bonuses.*') || Route::is('deposit.bonuses.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('deposit.bonuses') }}">
            <i class="material-icons">blur_linear</i>
            <span class="menu-title" data-i18n="">Бонусы за оборот депозитов</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_EXCHANGE_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('currency-exchange.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('deposits*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('currency-exchange') }}">
            <i class="material-icons">autorenew</i>
            <span class="menu-title" data-i18n="Обмен валют">Обмен валют</span>
            <span class="badge badge pill purple float-right mr-3">{{ $counts['currency_exchange_count'] }}</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CURRENCY_RATES_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('currency-rates.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('currency-rates*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('currency-rates.index') }}">
            <i class="material-icons">compare_arrows</i>
            <span class="menu-title" data-i18n="Курс валют">Курс валют</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::CLOUD_FILES]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('cloud_files.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('cloud_files*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('cloud_files.manager') }}">
            <i class="material-icons">cloud_download</i>
            <span class="menu-title" data-i18n="Менеджер файлов">Файлы</span>
            --}}{{--        <span class="badge badge pill purple float-right mr-3">{{ $counts['files'] }}</span>--}}{{--
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NOTIFICATIONS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('notifications.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('notifications*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('notifications.index') }}">
            <i class="material-icons">notifications</i>
            <span class="menu-title" data-i18n="Уведомления">Уведомления</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::NEWS_PRODUCTS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('news*') || Route::is('news.*') || Route::is('products.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! (Route::is('news-and-products*') || Route::is('news.*') || Route::is('products.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('news-and-products.index') }}">
            <i class="material-icons">list</i>
            <span class="menu-title" data-i18n="Новости">Новости/Продукты</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::REFERRALS_BANNERS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('referrals-and-banners.*') || Route::is('banners.*') || Route::is('referrals.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!!(Route::is('referrals-and-banners.*') || Route::is('banners.*') || Route::is('referrals.*')) && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('referrals-and-banners.index') }}">
            <i class="material-icons">blur_linear</i>
            <span class="menu-title" data-i18n="Реферальные уровни/Баннеры">Реф уровни/Баннеры</span>
          </a>
        </li>
      @endif

      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::KANBAN_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('kanban.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('kanban*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('kanban.index') }}">
            <i class="material-icons">developer_board</i>
            <span class="menu-title" data-i18n="Задачи">Задачи</span>
            <span class="badge badge pill orange float-right mr-3">{{ $counts['tasks'] }}</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::RATE_GROUPS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('rate.groups.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('rate.groups*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('rate.groups.index') }}">
            <i class="material-icons">show_chart</i>
            <span class="menu-title" data-i18n="Тарифы">Группы тарифов</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::RATES_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('rates.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('rates*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('rates.index') }}">
            <i class="material-icons">show_chart</i>
            <span class="menu-title" data-i18n="Тарифы">Тарифы</span>
          </a>
        </li>
      @endif
      <li class="bold">
        <a class="waves-effect waves-cyan {{ (Route::is('bin-check.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('bin-check*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('bin-check.index') }}">
          <i class="material-icons">credit_card</i>
          <span class="menu-title" data-i18n="Проверка платежных карт">Анализ платежных карт</span>
        </a>
      </li>
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::VERIFICATION_REQUESTS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('verification-requests.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('verification-requests*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('verification-requests.index') }}">
            <i class="material-icons">verified_user</i>
            <span class="menu-title" data-i18n="Подтверждение личности">Подтверждение личности</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::FAQ_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('faq.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('faq*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('faq.index') }}">
            <i class="material-icons">info</i>
            <span class="menu-title" data-i18n="Тех поддержка">Вопрос - ответ</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::SUPPORT_TASKS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('support-tasks.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('support-tasks*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('support-tasks.index') }}">
            <i class="material-icons">question_answer</i>
            <span class="menu-title" data-i18n="Тех поддержка">Тех поддержка</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::ROLES_INDEX]) || auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::PERMISSIONS_INDEX]))
        <li class="bold">
          <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
            <i class="material-icons">photo_filter</i>
            <span class="menu-title" data-i18n="">Доступы</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::ROLES_INDEX]))
                <li>
                  <a href="{{ route('roles.index') }}"><i class="material-icons">radio_button_unchecked</i>
                    <span data-i18n="Second level">Роли</span>
                  </a>
                </li>
              @endif
              @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::PERMISSIONS_INDEX]))
                <li>
                  <a href="{{ route('permissions.index') }}">
                    <i class="material-icons">radio_button_unchecked</i>
                    <span data-i18n="Second level child">Права</span>
                  </a>
                </li>
              @endif
            </ul>
          </div>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::BACKUPS_INDEX]))
        <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('backup.*') ? 'active ' .  (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : '') : '') }}" style="{!! Route::is('backup*') && isset($themeSettings['menu-color']) ? 'background:none;box-shadow:none' : '' !!}" href="{{ route('backup.index') }}">
            <i class="material-icons">backup</i>
            <span class="menu-title" data-i18n="Резервные копии">Резервные копии</span>
          </a>
        </li>
      @endif
      @if(auth()->user()->hasPermissionTo(\App\Enums\Permissions::$data[\App\Enums\Permissions::SETTINGS_SWITCH_SITE_STATUS]))
        <li class="bold" style="margin-bottom: 30px">
          <label class="ml-10">
            <input type="checkbox" name="disable_client_site" {{ \App\Models\Setting::getValue('disable_client_site') == 'true' ? 'checked' : '' }}/>
            <span>Отключить сайт</span>
          </label>
        </li>
      @endif
      --}}{{--   DROPDOWN     --}}{{--
      --}}{{--        <li class="active bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge pill orange float-right mr-10">3</span></a>--}}{{--
      --}}{{--            <div class="collapsible-body">--}}{{--
      --}}{{--                <ul class="collapsible collapsible-sub" data-collapsible="accordion">--}}{{--
      --}}{{--                    <li class="active"><a class="active" href="dashboard-modern.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">Modern</span></a>--}}{{--
      --}}{{--                    </li>--}}{{--
      --}}{{--                    <li><a href="dashboard-ecommerce.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="eCommerce">eCommerce</span></a>--}}{{--
      --}}{{--                    </li>--}}{{--
      --}}{{--                    <li><a href="dashboard-analytics.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Analytics</span></a>--}}{{--
      --}}{{--                    </li>--}}{{--
      --}}{{--                </ul>--}}{{--
      --}}{{--            </div>--}}{{--
      --}}{{--        </li>--}}{{--

    </ul>--}}
  <div class="navigation-background"></div>
  <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
      href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
