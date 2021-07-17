<div class="side-header oh">
  <div class="cross-header-bar d-xl-none">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <div class="site-header-container">
    <div class="side-logo">
      <a href="{{ route('profile.profile') }}">
        <img src="{{ asset('images/logo/logo.png') }}" alt="logo">
      </a>
    </div>
<<<<<<< HEAD
    <ul class="dashboard-menu">
      <li>
        <a href="{{ route('profile.profile') }}" @if(Route::currentRouteName() == 'profile.profile') class="active" @endif><i class="flaticon-man"></i>
          {{ __("Dashboard") }}
        </a>
      </li>
      <li>
        <a href="{{ route('profile.operations.index') }}" @if(Route::currentRouteName() == 'profile.operations.index') class="active" @endif><i class="flaticon-coin"></i>{{ __("Operations") }}</a>
      </li>
      <li>
        <a href="{{ route('profile.deposits') }}" @if(Route::currentRouteName() == 'profile.deposits') class="active" @endif><i class="flaticon-interest"></i>{{ __("Deposits") }}</a>
      </li>
      <li>
        <a href="{{ route('profile.withdraw') }}" @if(Route::currentRouteName() == 'profile.withdraw') class="active" @endif><i class="flaticon-atm"></i>
        {{ __("Withdraw") }}</a>
      </li>
      
      <li>
        <a href="partners.html"><i class="flaticon-deal"></i>Partners</a>
      </li>
      
      <li>
        <a href="{{ route('profile.settings') }}" @if(Route::currentRouteName() == 'profile.settings') class="active" @endif><i class="flaticon-gears"></i>
        {{ __("Settings") }}</a>
      </li>
      
      <li>
        <a href="notification.html"><i class="flaticon-bell"></i>Notifications</a>
      </li>
      <li>
        <a href="ticket.html"><i class="flaticon-sms"></i>Tickets</a>
      </li>
      <li>
        <a href="{{ route('profile.promo') }}"><i class="flaticon-deal"></i>{{ __("Promo") }}</a>
      </li>
      
      <li>
        <a href="{{ route('logout') }}"><i class="flaticon-right-arrow"></i>{{ __("Logout") }}</a>
      </li>
    </ul>
  </div>
</div>
=======
</header>

<a href="https://t.me/luminex_asia" class="btn_tlg" style="left:inherit; right:2%; bottom:2%;">TELEGRAM SUPPORT</a>
>>>>>>> translation
