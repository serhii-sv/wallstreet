<aside
  class="{{$configData['sidenavMain']}} @if(!empty($configData['activeMenuType'])) {{$configData['activeMenuType']}} @else {{$configData['activeMenuTypeClass']}}@endif @if(($configData['isMenuDark']) === true) {{'sidenav-dark'}} @elseif(($configData['isMenuDark']) === false){{'sidenav-light'}}  @else {{$configData['sidenavMainColor']}}@endif">
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
      <a class="navbar-toggler" href="javascript:void(0)"><i class="material-icons">radio_button_checked</i></a></h1>
  </div>
  <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
    data-menu="menu-navigation" data-collapsible="menu-accordion">
    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('home') ? 'active' : '') }}" href="{{ route('home') }}">
        <i class="fa fa-dashboard"></i>
        <span class="menu-title" data-i18n="Dashboard">Главная</span>
      </a>
    </li>
    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('users.*') ? 'active' : '') }}" href="{{ route('users.index') }}">
        <i class="fa fa-users"></i>
        <span class="menu-title" data-i18n="Members">Пользователи</span>
        <span class="badge badge pill purple float-right mr-2">0</span>
      </a>
    </li>

      <li class="bold">
          <a class="waves-effect waves-cyan {{ (Route::is('cloud_files.*') ? 'active' : '') }}" href="{{ route('cloud_files.manager') }}">
              <i class="fa fa-sitemap"></i>
              <span class="menu-title" data-i18n="Backups">Менеджер файлов</span>
          </a>
      </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('deposits.*') ? 'active' : '') }}" href="{{ route('deposits.index') }}">
        <i class="fa fa-suitcase"></i>
        <span class="menu-title" data-i18n="Deposits">{{ __('Deposits') }}</span>

          <span class="badge badge pill pink accent-2 float-right mr-10">0</span>


          <span class="badge badge pill purple float-right mr-2">9</span>

      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('requests.*') ? 'active' : '') }}" href="{{ route('requests.index') }}">
        <i class="fa fa-mail-forward"></i>
        <span class="menu-title" data-i18n="Withdrawal requests">{{ __('Withdrawal requests') }}</span>

          <span class="badge badge pill purple float-right mr-2">9</span>

      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('transactions.*') ? 'active' : '') }}" href="{{ route('transactions.index') }}">
        <i class="fa fa-cubes"></i>
        <span class="menu-title" data-i18n="Transactions">{{ __('Transactions') }}</span>

          <span class="badge badge pill purple float-right mr-2">88</span>

      </a>
    </li>

    <li class="bold {{ (Route::is('news.*') ? 'active' : '') }} {{ (Route::is('reviews.*') ? 'active' : '') }} {{ (Route::is('faqs.*') ? 'active' : '') }}">
      <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
        <i class="fa fa-bullhorn"></i>
        <span class="menu-title" data-i18n="Content">{{ __('Content') }}</span>
      </a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          <li>
            <a class="{{ (Route::is('news.*') ? 'active' : '') }}" href="{{ route('news.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="News">
              {{ __('News') }}
              </span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('reviews.*') ? 'active' : '') }}" href="{{ route('reviews.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Client reviews">{{ __('Client reviews') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('faqs.*') ? 'active' : '') }}" href="{{ route('faqs.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="FAQs">{{ __('FAQs') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

    <li class="bold {{ (Route::is('settings.*') ? 'active' : '') }} {{ (Route::is('langs.*') ? 'active' : '') }} {{ (Route::is('tpl_texts.*') ? 'active' : '') }} {{ (Route::is('currencies.*') ? 'active' : '') }} {{ (Route::is('payment-systems.*') ? 'active' : '') }}">
      <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
        <i class="fa fa-wrench"></i>
        <span class="menu-title" data-i18n="Settings">{{ __('Settings') }}</span>
      </a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          <li>
            <a class="{{ (Route::is('admin.settings.*') ? 'active' : '') }}" href="{{ route('settings.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Base settings">{{ __('Base settings') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.langs.*') ? 'active' : '') }}" href="{{ route('langs.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Blog">{{ __('Languages') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.tpl_texts.*') ? 'active' : '') }}" href="{{ route('tpl_texts.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Template translations">{{ __('Template translations') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('admin.currencies.*') ? 'active' : '') }}" href="{{ route('currencies.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Currencies">{{ __('Currencies') }}</span>
            </a>
          </li>
          <li>
            <a class="{{ (Route::is('payment-systems.*') ? 'active' : '') }}" href="{{ route('payment-systems.index') }}">
              <i class="fa fa-caret-right"></i>
              <span data-i18n="Payment systems">{{ __('Payment systems') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('referral.*') ? 'active' : '') }}" href="{{ route('referral.index') }}">
        <i class="fa fa-sitemap"></i>
        <span class="menu-title" data-i18n="Affiliate plans">{{ __('Affiliate plans') }}</span>
      </a>
    </li>

    <li class="bold">
      <a class="waves-effect waves-cyan {{ (Route::is('backup.*') ? 'active' : '') }}" href="{{ route('backup.index') }}">
        <i class="fa fa-sitemap"></i>
        <span class="menu-title" data-i18n="Backups">{{ __('Backups') }}</span>
      </a>
    </li>


    {{-- Foreach menu item starts --}}
{{--    @if(!empty($menuData[0]) && isset($menuData[0]))--}}
{{--      @foreach ($menuData[0]->menu as $menu)--}}
{{--        @if(isset($menu->navheader))--}}
{{--        <li class="navigation-header">--}}
{{--          <a class="navigation-header-text">{{ $menu->navheader }}</a>--}}
{{--          <i class="navigation-header-icon material-icons">{{$menu->icon }}</i>--}}
{{--        </li>--}}
{{--        @else--}}
{{--        @php--}}
{{--          $custom_classes="";--}}
{{--          if(isset($menu->class))--}}
{{--          {--}}
{{--          $custom_classes = $menu->class;--}}
{{--          }--}}
{{--        @endphp--}}
{{--      <li class="bold {{(request()->is($menu->url.'*')) ? 'active' : '' }}">--}}
{{--        <a class="{{$custom_classes}} {{ (request()->is($menu->url.'*')) ? 'active '.$configData['activeMenuColor'] : ''}}"--}}
{{--          @if(!empty($configData['activeMenuColor'])) {{'style=background:none;box-shadow:none;'}} @endif--}}
{{--          href="@if(($menu->url)==='javascript:void(0)'){{$menu->url}} @else{{url($menu->url)}} @endif"--}}
{{--          {{isset($menu->newTab) ? 'target="_blank"':''}}>--}}
{{--          <i class="material-icons">{{$menu->icon}}</i>--}}
{{--          <span class="menu-title">{{ __('locale.'.$menu->name)}}</span>--}}
{{--          @if(isset($menu->tag))--}}
{{--          <span class="{{$menu->tagcustom}}">{{$menu->tag}}</span>--}}
{{--          @endif--}}
{{--        </a>--}}
{{--          @if(isset($menu->submenu))--}}
{{--          @include('panels.submenu', ['menu' => $menu->submenu])--}}
{{--          @endif--}}
{{--        </li>--}}
{{--        @endif--}}
{{--      @endforeach--}}
{{--    @endif--}}
  </ul>
  <div class="navigation-background"></div>
  <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
    href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
