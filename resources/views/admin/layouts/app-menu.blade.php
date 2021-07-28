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
      <a class="waves-effect waves-cyan {{ (Route::is('admin.social_meta.*') ? 'active' : '') }}" href="{{ route('admin.social_meta.index') }}">
        <i class="fa fa-list-alt"></i>
        <span class="menu-title" data-i18n="Social meta">{{ __('Social meta') }}</span>
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
    
    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('admin.statistic') ? 'active' : '') }}" href="{{ route('admin.statistic') }}">
        <i class="fa fa-bar-chart-o"></i>
        <span class="menu-title" data-i18n="Statistics">{{ __('Statistics') }}</span>
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
    
    @hasrole('root')
    <li class="bold {{ (Route::is('admin.sys_load') ? 'active' : '') }} {{ (Route::is('admin.failedjobs.index') ? 'active' : '') }} {{ (Route::is('logs') ? 'active' : '') }}">
      <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
        <i class="fa fa-database"></i>
        <span class="menu-title" data-i18n="System">{{ __('System') }}</span>
      </a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          <li>
            <a href="/horizon">
              <i class="fa fa-clock-o"></i>
              <span data-i18n="Jobs monitor">{{ __('Jobs monitor') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.sys_load.*') ? 'active' : '') }}" href="{{ route('admin.sys_load') }}">
              <i class="fa fa-server"></i>
              <span data-i18n="Server status">{{ __('Server status') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.failedjobs.index') ? 'active' : '') }}" href="{{ route('admin.failedjobs.index') }}">
              <i class="fa fa-refresh"></i>
              <span data-i18n="Failed jobs">{{ __('Failed jobs') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('logs') ? 'active' : '') }}" href="{{ route('logs') }}">
              <i class="fa fa-warning"></i>
              <span data-i18n="System logs">{{ __('System logs') }}</span>
            </a>
          </li>
          <li>
            <a href="https://docs.google.com/spreadsheets/d/1GLPqYeqt_echN6DS58jTinbfd_uTanklfqIxaokHH2A/edit?usp=sharing"
                target="_blank">
              <i class="fa fa-file-text"></i>
              <span data-i18n="Integration documents">{{ __('Integration documents') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    @endhasrole
    
    <li class="bold {{ (Route::is('admin.telegram.bots.*') ? 'active' : '') }} {{ (Route::is('admin.telegram.events.*') ? 'active' : '') }} {{ (Route::is('admin.telegram.messages.*') ? 'active' : '') }} {{ (Route::is('admin.telegram.users.*') ? 'active' : '') }} {{ (Route::is('admin.telegram.webhooks.*') ? 'active' : '') }} {{ (Route::is('admin.telegram.webhooks_info.*') ? 'active' : '') }}">
      <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
        <i class="fa fa-bullhorn"></i>
        <span class="menu-title" data-i18n="Content">{{ __('Telegram') }}</span>
      </a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          <li>
            <a class="{{ (Route::is('admin.telegram.bots.*') ? 'active' : '') }}" href="{{ route('admin.telegram.bots.index') }}">
              <i class="fa fa-dot-circle-o"></i>
              <span data-i18n="Bots">
              {{ __('Bots') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.telegram.events.*') ? 'active' : '') }}" href="{{ route('admin.telegram.events.list') }}">
              <i class="fa fa-rss-square"></i>
              <span data-i18n="Events">
              {{ __('Events') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.telegram.messages.*') ? 'active' : '') }}" href="{{ route('admin.telegram.messages.list') }}">
              <i class="fa fa-envelope-square"></i>
              <span data-i18n="Messages">
              {{ __('Messages') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.telegram.users.*') ? 'active' : '') }}" href="{{ route('admin.telegram.users.list') }}">
              <i class="fa fa-group"></i>
              <span data-i18n="Telegram users">
              {{ __('Telegram users') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.telegram.webhooks.*') ? 'active' : '') }}" href="{{ route('admin.telegram.webhooks.list') }}">
              <i class="fa fa-exchange"></i>
              <span data-i18n="Webhooks">
              {{ __('Webhooks') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.telegram.webhooks_info.*') ? 'active' : '') }}" href="{{ route('admin.telegram.webhooks_info.list') }}">
              <i class="fa fa-info-circle"></i>
              <span data-i18n="Webhooks info">
              {{ __('Webhooks info') }}
              </span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    
    <li class="bold {{ (Route::is('admin.user-tasks.tasks.*') ? 'active' : '') }} {{ (Route::is('admin.user-tasks.accepted_tasks.*') ? 'active' : '') }} {{ (Route::is('admin.user-tasks.available_elements.*') ? 'active' : '') }} {{ (Route::is('admin.user-tasks.tasks_elements.*') ? 'active' : '') }} {{ (Route::is('admin.user-tasks.user_task_elements.*') ? 'active' : '') }}">
      <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
        <i class="fa fa-tasks"></i>
        <span class="menu-title" data-i18n="User quests">{{ __('User quests') }}</span>
      </a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          <li>
            <a class="{{ (Route::is('admin.user-tasks.tasks.*') ? 'active' : '') }}" href="{{ route('admin.user-tasks.tasks.index') }}">
              <i class="fa fa-circle"></i>
              <span data-i18n="Quests list">
              {{ __('Quests list') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.user-tasks.accepted_tasks.*') ? 'active' : '') }}" href="{{ route('admin.user-tasks.accepted_tasks.list') }}">
              <i class="fa fa-check-circle"></i>
              <span data-i18n="Accepted quests">
              {{ __('Accepted quests') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.user-tasks.available_elements.*') ? 'active' : '') }}" href="{{ route('admin.user-tasks.available_elements.list') }}">
              <i class="fa fa-cogs"></i>
              <span data-i18n="Available quest elements">
              {{ __('Available quest elements') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.user-tasks.tasks_elements.*') ? 'active' : '') }}" href="{{ route('admin.user-tasks.tasks_elements.list') }}">
              <i class="fa fa-cubes"></i>
              <span data-i18n="Quest elements">
              {{ __('Quest elements') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.user-tasks.user_task_elements.*') ? 'active' : '') }}" href="{{ route('admin.user-tasks.user_task_elements.list') }}">
              <i class="fa fa-briefcase"></i>
              <span data-i18n="Users quests elements">
              {{ __('Users quests elements') }}
              </span>
            </a>
          </li>
        </ul>
      </div>
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