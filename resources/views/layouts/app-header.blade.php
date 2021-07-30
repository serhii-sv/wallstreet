<header class="header-section">
  <div class="header-top">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6">
          <ul class="support-area">
            <li>
              <a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                <i class="flaticon-support"></i>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Support' contenteditable="true">{{ __('Support') }}</editor_block>
                @else
                  {{ __('Support') }}
                @endif</a>
            </li>
            <li>
              <a href="Mailto:info@hyipland.com"><i class="flaticon-email"></i>info@hyipland.com</a>
            </li>
          </ul>
        </div>
        <style>
            .language {
                text-transform: uppercase;
                font-weight: 700;
                position: relative;
                display: block;
                font-size: 12px;
                letter-spacing: .5px
            }

            .language__name {
                margin-bottom: 0;
                height: 29px;
                border-radius: 15px;
                border: solid 2px #fbc800;
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -webkit-justify-content: center;
                -ms-flex-pack: center;
                justify-content: center;
                padding-right: 20px;
                padding-left: 13px;
                cursor: pointer;
                position: relative;
                -webkit-transition: all .2s ease;
                transition: all .2s ease
            }

            .language__name:after {
                content: '';
                width: 5px;
                display: block;
                height: 5px;
                border-left: solid 1px #000;
                border-bottom: solid 1px #000;
                -webkit-transform: rotate(-45deg);
                -ms-transform: rotate(-45deg);
                transform: rotate(-45deg);
                margin-left: 10px;
                position: absolute;
                top: 50%;
                margin-top: -5px;
                right: 8px
            }

            .language:hover .language__list {
                width: 100px;
                visibility: visible;
                opacity: 1;
                -webkit-transform: none;
                -ms-transform: none;
                transform: none
            }

            .language__list {
                list-style: none;
                position: absolute;
                background: #fff;
                border: solid 2px #fbc800;
                box-shadow: .5px .9px 62px 0 rgba(201, 201, 201, .6);
                border-radius: 15px;
                top: 100%;
                margin-top: -2px;
                left: 0;
                right: 0;
                z-index: 5;
                text-align: left;
                visibility: hidden;
                opacity: 0;
                -webkit-transform: translateY(10px);
                -ms-transform: translateY(10px);
                transform: translateY(10px);
                -webkit-transition: all .3s ease;
                transition: all .3s ease
            }

            .language__item, .language__item a {
                width: 100%;
                margin-left: 0 !important;
            }

            .language__item:last-child {
                border: none
            }

            .language__button {
                width: 100%;
                border: none;
                color: #000;
                text-transform: uppercase;
                font-weight: 700;
                padding: 3px;
                cursor: pointer;
                background: 0 0
            }

            .language__button:hover {
                color: #fbc800
            }
        </style>
        <div class="col-6">
          <ul class="cart-area">
            <li class="">
              <div class="language">
                <p class="language__name">
                  <span>{{ !empty(session('lang')) ? session('lang') : 'cn' }}</span>
                </p>
                <ul class="language__list">
                  <li class="language__item">
                    <a href="{{ route('set.lang', ['locale' => 'en']) }}">
                      <button class="language__button">English</button>
                    </a>
                  </li>
                  <li class="language__item">
                    <a href="{{ route('set.lang', ['locale' => 'ru']) }}">
                      <button class="language__button">Russian</button>
                    </a>
                  </li>
                  <li class="language__item">
                    <a href="{{ route('set.lang', ['locale' => 'cn']) }}">
                      <button class="language__button">Chinese</button>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a href="{{ route('login') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Sign In' contenteditable="true">{{ __('Sign In') }}</editor_block>
                @else
                  {{ __('Sign In') }}
                @endif</a>
            </li>
            <li>
              <a href="{{ route('register') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Sign Up' contenteditable="true">{{ __('Sign Up') }}</editor_block>
                @else
                  {{ __('Sign Up') }}
                @endif</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="header-bottom">
    <div class="container">
      <div class="header-area">
        <div class="logo">
          <a href="{{ route('customer.main') }}">
            <img src="{{ asset('images/logo/logo.png') }}" alt="logo">
          </a>
        </div>
        <ul class="menu">
          <li>
            <a href="{{ route('customer.main') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Home' contenteditable="true">{{ __('Home') }}</editor_block>
              @else
                {{ __('Home') }}
              @endif
            </a>
          </li>
          <li>
            <a href="{{ route('customer.aboutus') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='About' contenteditable="true">{{ __('About') }}</editor_block>
              @else
                {{ __('About') }}
                @endif</a>
          </li>
          <li>
            <a href="{{ route('customer.partners') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Affiliate' contenteditable="true">{{ __('Affiliate') }}</editor_block>
              @else
                {{ __('Affiliate') }}
                @endif</a>
          </li>
          <li>
            <a href="{{ route('customer.faq') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Faqs' contenteditable="true">{{ __('Faqs') }}</editor_block>
              @else
                {{ __('Faqs') }}
                @endif</a>
          </li>
          <li>
            <a href="{{ route('customer.contact') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Contact' contenteditable="true">{{ __('Contact') }}</editor_block>
              @else
                {{ __('Contact') }}
                @endif</a>
          </li>
          <li class="pr-0">
            <a href="{{ route('login') }}" class="custom-button"
                @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Join Us' contenteditable="true">{{ __('Join Us') }}</editor_block>
              @else
                {{ __('Join Us') }}
                @endif</a>
          </li>
        </ul>
        <div class="header-bar d-lg-none">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </div>
</header>