<footer class="footer footer--lk">
    <div class="container">
        <div class="main-line"><a class="main-line__logo" href="{{ route('customer.main') }}"><img src="{{ asset('img/logo/footer-logo-lk.png') }}" alt=""></a>
            <p class="main-line__slogan">Energy of Cryptocurrency
            </p>
            <!-- <div class="main-line__call">
                <a class="main-line__phone" href="tel:+121232233456">+12 123 223-34-56 </a>
                <a class="main-line__link" href="#call" data-fancybox="" data-modal="true">Обратный звонок</a>
            </div> -->
            <div class="main-line__buttons">
                <a class="btn btn--white main-line__btn" href="{{ route('customer.main') }}/agreement">{{ __('User agreement') }}</a>
                @if(Auth::user()->isImpersonated())
                    <a class="btn btn--accent2 main-line__btn" href="{{ route('admin.impersonate.leave') }}">{{ __('Return to my account') }}</a>
                @else
                    <a class="btn btn--accent2 main-line__btn" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                @endif
            </div>
        </div>
    </div>
</footer>
