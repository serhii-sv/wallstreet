<nav class="navigation">
    <ul class="navigation__list">
        <li id="homePageMenuItem" class="navigation__item"><a class="navigation__link" href="{{ route('customer.main') }}">{{ __('Home') }}</a>
        </li>
        <li id="aboutUsPageMenuItem" class="navigation__item"><a class="navigation__link" href="{{ route('customer.aboutus') }}">{{ __('About us') }}</a>
        </li>
        <li id="calculatorPageMenuItem" class="navigation__item"><a class="navigation__link" href="{{ route('customer.calculator') }}">{{ __('Calculator') }}</a>
        </li>
        <li id="investorsPageMenuItem" class="navigation__item"><a class="navigation__link" href="{{ route('customer.investors') }}">{{ __('For investors') }}</a>
        </li>
        <li id="partnersPageMenuItem" class="navigation__item"><a class="navigation__link" href="{{ route('customer.partners') }}">{{ __('For partners') }}</a>
        </li>
        <li id="contactPageMenuItem" class="navigation__item"><a class="navigation__link" href="{{ route('customer.contact') }}">{{ __('Contacts') }}</a>
        </li>
        <li id="faqPageMenuItem" class="navigation__item"><a class="navigation__link" href="{{ route('customer.faq') }}">{{ __('FAQ') }}</a>
        </li>
        <!-- <li id="payoutPageMenuItem" class="navigation__item"><a class="navigation__link" href="{{ route('customer.payout') }}">{{ __('Выплаты') }}</a>
        </li> -->
    </ul>
</nav>
