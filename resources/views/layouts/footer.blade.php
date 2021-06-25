<footer class="footer">
    <div class="container">
        <section class="top">
            <div class="container">
                @include('layouts.navigation')
            </div>
        </section>
        <div class="main-line container">
            <a class="main-line__logo" href="index.html"><img src="{{ asset('img/logo/logo.png') }}" alt=""></a>
            <p class="main-line__slogan">Energy of Cryptocurrency
            </p>
            <!-- <div class="main-line__call"><a class="main-line__phone" href="tel:+121232233456">+12 123 223-34-56 </a>
                <a class="main-line__link" href="#call" data-fancybox="" data-modal="true">Обратный звонок</a>
            </div> -->
            @if(isUserAuthorized())
                <div class="main-line__buttons">
                    <a class="btn btn--white main-line__btn" href="/profile">{{ __('Profile') }} {{auth()->user()->name}}</a>
                    @if(Auth::user()->isImpersonated())
                        <a class="btn btn--accent2 main-line__btn" href="{{ route('admin.impersonate.leave') }}">{{ __('Return to my account') }}</a>
                    @else
                        <a class="btn btn--accent2 main-line__btn" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                    @endif
                </div>
            @else
                <div class="main-line__buttons">
                    <a class="btn btn--white main-line__btn" href="{{ route('login') }}">{{ __('Log in') }}</a>
                    <a class="btn btn--accent2 main-line__btn" href="{{ route('register') }}">{{ __('Registration') }}</a>
                </div>
            @endif
        </div>
    </div>
</footer>
