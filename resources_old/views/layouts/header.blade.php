<header class="header">
  <a href="https://t.me/luminex_asia" class="btn_tlg">TELEGRAM SUPPORT</a>
    <div class="main-line container">
        <a class="main-line__logo" href="{{ route('customer.main') }}"><img src="{{ asset('img/logo/logo.png') }}" alt=""></a>
        <p class="main-line__slogan">Energy of Cryptocurrency</p>
        <!-- <div class="main-line__call">
            <a class="main-line__phone" href="tel:+121232233456">+12 123 223-34-56 </a>
            <a class="main-line__link" href="#call" data-fancybox="" data-modal="true">Обратный звонок</a>
        </div> -->
      @if(isUserAuthorized())
        <div class="main-line__buttons">
          <a class="btn btn--white main-line__btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="/profile">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Profile' contenteditable="true">{{ __('Profile') }}</editor_block>
            @else
              {{ __('Profile') }}
            @endif</a>
          @if(Auth::user()->isImpersonated())
            <a class="btn btn--accent2 main-line__btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('admin.impersonate.leave') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Return to my account' contenteditable="true">{{ __('Return to my account') }}</editor_block>
              @else
                {{ __('Return to my account') }}
              @endif</a>
          @else
            <a class="btn btn--accent2 main-line__btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @else onclick="event.preventDefault(); document.getElementById('logout-form').submit();" @endif href="{{ route('logout') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Log out' contenteditable="true">{{ __('Log out') }}</editor_block>
              @else
                {{ __('Log out') }}
              @endif</a>
          @endif
        </div>
      @else
        <div class="main-line__buttons">
          <a class="btn btn--white main-line__btn"  @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('login') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Log in' contenteditable="true">{{ __('Log in') }}</editor_block>
            @else
              {{ __('Log in') }}
            @endif</a>
          <a class="btn btn--accent2 main-line__btn"  @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('register') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Registration' contenteditable="true">{{ __('Registration') }}</editor_block>
            @else
              {{ __('Registration') }}
            @endif</a>
        </div>
        @endif
    </div>
</header>