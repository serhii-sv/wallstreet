<header class="header header--white">
    <div class="main-line main-line--lk container"><a class="main-line__logo" href="{{ route('customer.main') }}"><img src="{{ asset('img/logo/logo.png') }}" alt=""></a>
        <p class="main-line__slogan">Energy of Cryptocurrency
        </p>
        <!-- <div class="main-line__call"><a class="main-line__phone" href="tel:+121232233456">+12 123 223-34-56 </a><a class="main-line__link" href="#call" data-fancybox="" data-modal="true">Обратный звонок</a>
        </div> -->
        @include('partials.language')
        <div class="main-line__links">
            {{--<a class="main-line__link" href="#">{{ __('Admin panel') }}</a>--}}
            {{--<a class="main-line__link" href="#">{{ __('Account') }}</a>--}}
        </div>
        @if(Auth::user()->isImpersonated())
            <a class="btn btn--accent2 main-line__btn" href="{{ route('admin.impersonate.leave') }}">{{ __('Return to my account') }}</a>
        @else
            <a class="btn btn--accent2 main-line__btn" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
        @endif
    </div>
</header>
