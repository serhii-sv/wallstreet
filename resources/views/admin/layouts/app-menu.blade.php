<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
  <div class="brand-sidebar">
    <h1 class="logo-wrapper">
      <a class="brand-logo darken-1" href="{{ route('admin') }}">
        <img class="hide-on-med-and-down" src="{{ asset('admin/images/logo/materialize-logo-color.png') }}" alt="materialize logo" />
        <img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('admin/images/logo/materialize-logo.png') }}" alt="materialize logo" />
        <span class="logo-text hide-on-med-and-down">Wallstreet</span>
      </a>
      <a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a>
    </h1>
  </div>
  <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

    <li class="navigation-header">
      <a class="navigation-header-text">Основные</a>
      <i class="navigation-header-icon material-icons">more_horiz</i>
    </li>
    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('admin.new') ? 'active' : '') }}" href="{{ route('admin') }}">
        <i class="fa fa-dashboard"></i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Dashboard') }}</span>
      </a>
    </li>
    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('admin.users.*') ? 'active' : '') }}" href="{{ route('admin.users.index') }}">
        <i class="fa fa-users"></i>
        <span class="menu-title" data-i18n="Members">{{ __('Members') }}</span>
        @if(getTotalAccounts() > 0)
          <span class="badge badge pill purple float-right mr-2">{{ getTotalAccounts() }}</span>
        @endif
      </a>
    </li>
    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('admin.deposits.*') ? 'active' : '') }}" href="{{ route('admin.deposits.index') }}">
        <i class="fa fa-suitcase"></i>
        <span class="menu-title" data-i18n="Deposits">{{ __('Deposits') }}</span>
        @if(getClosedDepositsCount() > 0 && strlen(getClosedDepositsCount() <= 4 && strlen(getActiveDepositsCount()) <= 4))
          <span class="badge badge pill pink accent-2 float-right mr-10">{{ getClosedDepositsCount() }}</span>
        @endif
        @if(getActiveDepositsCount() > 0)
          <span class="badge badge pill purple float-right mr-2">{{ getActiveDepositsCount() }}</span>
        @endif
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('admin.requests.*') ? 'active' : '') }}" href="{{ route('admin.requests.index') }}">
        <i class="fa fa-mail-forward"></i>
        <span class="menu-title" data-i18n="Withdrawal requests">{{ __('Withdrawal requests') }}</span>
        @if(getAdminWithdrawRequestsCount() > 0)
          <span class="badge badge pill purple float-right mr-2">{{ getAdminWithdrawRequestsCount() }}</span>
        @endif
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('admin.transactions.*') ? 'active' : '') }}" href="{{ route('admin.transactions.index') }}">
        <i class="fa fa-cubes"></i>
        <span class="menu-title" data-i18n="Transactions">{{ __('Transactions') }}</span>
        @if(getAdminWithdrawRequestsCount() > 0)
          <span class="badge badge pill purple float-right mr-2">{{ getAdminWithdrawRequestsCount() }}</span>
        @endif
      </a>
    </li>

    <li class="bold {{ (Route::is('admin.news.*') ? 'active' : '') }} {{ (Route::is('admin.reviews.*') ? 'active' : '') }} {{ (Route::is('admin.faqs.*') ? 'active' : '') }}">
      <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
        <i class="fa fa-bullhorn"></i>
        <span class="menu-title" data-i18n="Content">{{ __('Content') }}</span>
      </a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          <li>
            <a class="{{ (Route::is('admin.news.*') ? 'active' : '') }}" href="{{ route('admin.news.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="News">
              {{ __('News') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.reviews.*') ? 'active' : '') }}" href="{{ route('admin.reviews.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Client reviews">{{ __('Client reviews') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.faqs.*') ? 'active' : '') }}" href="{{ route('admin.faqs.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="FAQs">{{ __('FAQs') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

    <li class="bold {{ (Route::is('admin.settings.*') ? 'active' : '') }} {{ (Route::is('admin.langs.*') ? 'active' : '') }} {{ (Route::is('admin.tpl_texts.*') ? 'active' : '') }} {{ (Route::is('admin.currencies.*') ? 'active' : '') }} {{ (Route::is('admin.payment-systems.*') ? 'active' : '') }}">
      <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
        <i class="fa fa-wrench"></i>
        <span class="menu-title" data-i18n="Settings">{{ __('Settings') }}</span>
      </a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          <li>
            <a class="{{ (Route::is('admin.settings.*') ? 'active' : '') }}" href="{{ route('admin.settings.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Base settings">{{ __('Base settings') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.langs.*') ? 'active' : '') }}" href="{{ route('admin.langs.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Blog">{{ __('Languages') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.tpl_texts.*') ? 'active' : '') }}" href="{{ route('admin.tpl_texts.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Template translations">{{ __('Template translations') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.currencies.*') ? 'active' : '') }}" href="{{ route('admin.currencies.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Currencies">{{ __('Currencies') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('payment-systems.*') ? 'active' : '') }}" href="{{ route('admin.payment-systems.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Payment systems">{{ __('Payment systems') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('admin.rates.*') ? 'active' : '') }}" href="{{ route('admin.rates.index') }}">
        <i class="fa fa-book"></i>
        <span class="menu-title" data-i18n="Tariff plans">{{ __('Tariff plans') }}</span>
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('admin.referral.*') ? 'active' : '') }}" href="{{ route('admin.referral.index') }}">
        <i class="fa fa-sitemap"></i>
        <span class="menu-title" data-i18n="Affiliate plans">{{ __('Affiliate plans') }}</span>
      </a>
    </li>


    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('admin.backup.*') ? 'active' : '') }}" href="{{ route('admin.backup.index') }}">
        <i class="fa fa-sitemap"></i>
        <span class="menu-title" data-i18n="Backups">{{ __('Backups') }}</span>
      </a>
    </li>

    <li class="navigation-header">
      <a class="navigation-header-text">Дополнительные</a>
      <i class="navigation-header-icon material-icons">more_horiz</i>
    </li>

    <li class="bold site-status">
      <div class="site-status-wrapper">
        <label class=" control-label">{{ __('Site status') }}</label>
        <div class=" control-label">
          <div class="onoffswitch greensea">
            <input type="checkbox" name="site-on" class="onoffswitch-checkbox"
                id="switch-on" {{ \App\Models\Setting::getValue('site-on') == 'on' ? 'checked' : '' }}>

            <label class="onoffswitch-label" for="switch-on"
                onclick="location.href='{{route('admin.settings.switchSiteStatus')}}';">
              <span class="onoffswitch-inner"></span>
              <span class="onoffswitch-switch"></span>
            </label>

          </div>

        </div>
      </div>
    </li>
  </ul>

  <div class="navigation-background"></div>
  <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out">
    <i class="material-icons">menu</i></a>
</aside>
