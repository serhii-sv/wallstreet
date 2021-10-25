<div class="navbar @if(($configData['isNavbarFixed'])=== true){{'navbar-fixed'}} @endif">
  <nav
      class="{{$configData['navbarMainClass']}} @if($configData['isNavbarDark']=== true) {{'navbar-dark'}} @elseif($configData['isNavbarDark']=== false) {{'navbar-light'}} @elseif(!empty($configData['navbarBgColor'])) {{$configData['navbarBgColor']}} @else {{$configData['navbarMainColor']}} @endif">
    <div class="nav-wrapper">
      <div class="header-search-wrapper hide-on-med-and-down" style="{{ $configData['isMenuCollapsed'] ? 'width:calc(100% - 450px)' : '' }}">
        <i class="material-icons">search</i>
        <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Login/Email/Name"
            data-search="template-list">
        <ul class="search-list collection display-none"></ul>
      </div>
      <ul class="navbar-list right">
        <li class="hide-on-med-and-down">
          <span class="badge time">{{ now()->format('d M H:i') }}</span>
        </li>
        <li class="dropdown-language">
          <a class="waves-effect waves-block waves-light translation-button" href="#"
              data-target="translation-dropdown">
            <span class="flag-icon flag-icon-{{ session()->get('lang') == 'en' ? 'gb' : session()->get('lang') }}"></span>
          </a>
        </li>
        <li class="hide-on-med-and-down">
          <a class="waves-effect waves-block waves-light toggle-fullscreen" href="">
            <i class="material-icons">settings_overscan</i>
          </a>
        </li>
        <li class="hide-on-large-only search-input-wrapper">
          <a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);">
            <i class="material-icons">search</i>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);"
              data-target="notifications-dropdown">
            <i class="material-icons">notifications_none @if($counts['notifications'] > 0)
                <small class="notification-badge">{{ $counts['notifications'] ?? 0 }}</small>@endif</i>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" style="height: 64px;display: flex;align-items: center; justify-content: center;" data-target="profile-dropdown">
            <span class="avatar-status avatar-online" style="width: 28px;height: 28px;">
              <img src="{{asset('images/avatar/IMG_3735.JPG')}}" alt="avatar"><i></i>
            </span>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out-right">
            <i class="material-icons">format_indent_increase</i>
          </a>
        </li>
      </ul>
      <!-- translation-button-->
      <ul class="dropdown-content" id="translation-dropdown">
        @foreach($navbar_languages as $lang)
          <li class="dropdown-item">
            <a class="grey-text text-darken-1" href="{{ route('set.lang', $lang->code) }}" >
              @if($lang->code == 'en')
              <i class="flag-icon flag-icon-gb"></i>
              @else
                <i class="flag-icon flag-icon-{{ $lang->code }}"></i>
              @endif
              {{ $lang->name }}
            </a>
          </li>
        @endforeach
      </ul>
      <!-- notifications-dropdown-->
      <ul class="dropdown-content" id="notifications-dropdown">
        <li>
          <h6>@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='NOTIFICATIONS' contenteditable="true">{{ __('NOTIFICATIONS') }}</editor_block>
            @else
              {{ __('NOTIFICATIONS') }}
            @endif @if($counts['notifications'] > 0)
              <span class="new badge">{{ $counts['notifications'] ?? 0 }}</span> @endif</h6>
        </li>
        <li class="divider"></li>
        @forelse($navbar_notifications as $item)
          <li class="notification" data-id="{{ $item->id }}" data-count="{{ $counts['notifications'] ?? 0 }}">
            <a class="black-text" href="" style="display: flex; align-items: flex-start">
              <span class="material-icons icon-bg-circle red small " style="display: block;">notifications</span>
              <small style="font-size: 14px; display: block;">
                {{ $item->notification->text }}
              </small>
            </a>
            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00" style="margin-left: 30px;top: 0;">
              @if($item->notification->created_at){{ $item->notification->created_at->diffForHumans() }}@endif
            </time>
          </li>
        @empty
          <li>
            <a class="black-text" href="" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <span class="material-icons icon-bg-circle red small">notifications_none</span>
              @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='No notifications!' contenteditable="true">{{ __('No notifications!') }}</editor_block>
              @else
                {{ __('No notifications!') }}
              @endif
            </a>
          </li>
        @endforelse
      </ul>
      <!-- profile-dropdown-->
      <style>
          .dropdown-content {
              width: 290px !important;
          }

          .navbar-list li:first-child {
              margin-right: 0;
          }
      </style>
      <ul class="dropdown-content" id="profile-dropdown">
        <li class="divider"></li>
        <li>
          <a class="grey-text text-darken-1" href="{{ route('user.lock', Auth::user()) }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
            <i class="material-icons">lock_outline</i>
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Block' contenteditable="true">{{ __('Block') }}</editor_block>
            @else
              {{ __('Block') }}
            @endif
          </a>
        </li>
        @if(canEditLang() && checkRequestOnEdit())
          <li>
            <a class="grey-text text-darken-1" href="{{ url()->current() }}" >
              <i class="material-icons ">create</i>
              <span>{{ __('Default mode') }}</span>
            </a>
          </li>
        @elseif(canEditLang())
          <li>
            <a class="grey-text text-darken-1" href="{{ url()->current() . '?edit=true' }}">
              <i class="material-icons ">create</i>
              <span>{{ __('Edit text') }}</span>
            </a>
          </li>
        @endif
        <li>
          <a class="grey-text text-darken-1" href="{{ route('logout') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
            <i class="material-icons">keyboard_tab</i>
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Logout' contenteditable="true">{{ __('Logout') }}</editor_block>
            @else
              {{ __('Logout') }}
            @endif
          </a>
        </li>
      </ul>
    </div>
    <nav class="display-none search-sm">
      <div class="nav-wrapper">
        <form id="navbarForm">
          <div class="input-field search-input-sm">
            <input class="search-box-sm mb-0" type="search" required="" placeholder='Login/Email/Name' id="search"
                data-search="template-list">
            <label class="label-icon" for="search">
              <i class="material-icons search-sm-icon">search</i>
            </label>
            <i class="material-icons search-sm-close">close</i>
            <ul class="search-list collection search-list-sm display-none"></ul>
          </div>
        </form>
      </div>
    </nav>
  </nav>
</div>

<ul class="display-none" id="default-search-main">
  <li class="auto-suggestion-title">
    <a class="collection-item" href="#" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
      <h6 class="search-title">
        @if(canEditLang() && checkRequestOnEdit())
          <editor_block data-name='Users' contenteditable="true">{{ __('Users') }}</editor_block>
        @else
          {{ __('Users') }}
        @endif
      </h6>
    </a>
  </li>
</ul>
{{--<ul class="display-none" id="page-search-title">--}}
{{--  <li class="auto-suggestion-title">--}}
{{--    <a class="collection-item" href="#">--}}
{{--      <h6 class="search-title">PAGES</h6></a>--}}
{{--  </li>--}}
{{--</ul>--}}
<ul class="display-none" id="search-not-found">
  <li class="auto-suggestion">
    <a class="collection-item display-flex align-items-center" href="#">
      <span class="material-icons">error_outline</span>
      <span class="member-info">
        @if(canEditLang() && checkRequestOnEdit())
          <editor_block data-name='No results found.' contenteditable="true">{{ __('No results found.') }}</editor_block>
        @else
          {{ __('No results found.') }}
        @endif
      </span>
    </a>
  </li>
</ul>
