@extends('layouts.customer')
@section('title', __('For partners'))
@section('content')
    <main role="main" style="background: white">
        <div class="page">
            <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
                <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
            </svg>
            @include('partials.breadcrumbs')
            <div class="container">
                <h2 class="page-title page-title--line">{{ __('The best way to get rich is') }} <span>{{ __('our referral program') }}</span>
                </h2>
                <div class="text">
                    <p><strong>{{ __("Referral program is a convenient system of cooperation for investors within our company. By inviting your friends and acquaintances to earn with you, you make your own earnings even more profitable.") }}</strong></p>
                    <p>{{ __("Payments of interest on your deposit are not all that we can offer you. Noone wants to wait until the interest is paid, because you have so much free time when you are a Luminex investor. So that you don’t waste your time in vain, replying to annoying questions from your friends about where you get your money from, our company has created a referral program for you. You can get interest from each payment made by investors attracted by you. The more investors you invite and the higher their deposit are, the greater your passive income is.") }}</p>
                </div>
            </div>
            <section class="levels">
                <div class="container">
                    <ul class="levels__list">
                        <li class="levels__item">
                            <div class="levels__icon js-tilt"><img src="/img/levels/level1.png" alt="">
                            </div>
                            <p class="levels__title">1<sup>{{ __('st') }}</sup> {{ __('level') }}
                            </p>
                            <!-- <p class="levels__description">хз, что тут писать
                            </p> -->
                        </li>
                        <li class="levels__item">
                            <div class="levels__icon js-tilt"><img src="/img/levels/level2.png" alt="">
                            </div>
                            <p class="levels__title">2<sup>{{ __('nd') }}</sup> {{ __('level') }}
                            </p>
                            <!-- <p class="levels__description">хз, что тут писать
                            </p> -->
                        </li>
                        <li class="levels__item">
                            <div class="levels__icon js-tilt"><img src="/img/levels/level3.png" alt="">
                            </div>
                            <p class="levels__title">3<sup>{{ __('rd') }}</sup> {{ __('level') }}
                            </p>
                            <!-- <p class="levels__description">хз, что тут писать
                            </p> -->
                        </li>
                        <li class="levels__item">
                            <div class="levels__icon js-tilt"><img src="/img/levels/level4.png" alt="">
                            </div>
                            <p class="levels__title">4<sup>{{ __('th') }}</sup> {{ __('level') }}
                            </p>
                            <!-- <p class="levels__description">хз, что тут писать
                            </p> -->
                        </li>
                    </ul>
                </div>
            </section>
            <section class="image-text-referal">
                <div class="container">
                    <div class="image-text-referal__col">
                        <div class="image-text-referal__image"><img src="/img/refferal.png" alt="">
                        </div>
                    </div>
                    <div class="image-text-referal__col">
                        <div class="text">
                            <p><strong>{{ __("Most people are economically illiterate. They are misusing their funds a priori and wasting most of their lives in order to provide themselves with little momentary pleasures, relaxing only when watching TV, YouTube or surfing the Internet. A person works day by day, gets a good salary, knows how to save money and leases a reliable car... At what point is he spending the money wrong?") }}</strong></p>
                            <p>{{ __("The crucial point is that all money and property are divided into two types: assets and liabilities. And there is also active income and passive income, but these are completely different things. Assets are what we don’t spend on ourselves, but accumulate properly for the sake of further benefits. The oldest and unprofitable way is to put money in a bank at interest. Or buy an apartment in a house that is still under construction, hoping to sell it afterwards at exorbitant prices. This is the money that works for you in terms of your investment and time. And liabilities are the money you spend on momentary pleasures. One such example is buying a car. It may seem like a useful thing. You use it for comfort and time saving. But as soon as you take the car from the dealer - it instantly drops in price. And at the same time, you spend lots of money on the insurance, the annual property tax, driver’s licence, fines and gasoline.") }}</p>
                            <p>{{ __("Of course, one cannot do without such pleasures. But you need to maintain a steady balance between the funds that work for you and the funds you spend at a loss of your future wealth.") }}</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

<script>document.getElementById("partnersPageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection
