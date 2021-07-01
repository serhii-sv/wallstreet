@extends('layouts.customer')
@section('title', __('For investors'))
@section('content')
    <main role="main" style="background: white">
        <div class="page">
            <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
                <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
            </svg>
            @include('partials.breadcrumbs')
            <div class="container">
                <h2 class="page-title">{{ __('Take the path') }} <span>{{ __('of earning') }}</span>
                </h2>
                <section class="plan">
                    <div class="plan-item">
                        <div class="plan-item__left">
                            <p class="plan-item__name">{{ __('from 1.5% per day') }}
                            </p><a class="btn btn--accent2" href="#">{{ __('Invest now') }}</a>
                        </div>
                        <div class="plan-item__content">
                            <p><strong>{{ __('Increase your capital with a team of professional traders.') }}</strong></p>
                            <ul class="information-icons">
                                <li class="information-icons__item">
                                    <div class="information-icons__icon"><img src="/img/icons/icon-calendar.svg" alt="">
                                    </div>
                                    <div class="information-icons__content">
                                        <p class="information-icons__title">{{ __('Period') }}
                                        </p>
                                        <p class="information-icons__name">{{ __('180 days') }}
                                        </p>
                                    </div>
                                </li>
                                <li class="information-icons__item">
                                    <div class="information-icons__icon"><img src="/img/icons/icon-cash.svg" alt="">
                                    </div>
                                    <div class="information-icons__content">
                                        <p class="information-icons__title">{{ __('Profit') }}
                                        </p>
                                        <p class="information-icons__name">{{ __('from 270%') }}
                                        </p>
                                    </div>
                                </li>
                                <li class="information-icons__item">
                                    <div class="information-icons__icon"><img src="/img/icons/icon-monets.svg" alt="">
                                    </div>
                                    <div class="information-icons__content">
                                        <p class="information-icons__title">{{ __('Minimum') }}
                                        </p>
                                        <p class="information-icons__name">0.002 BTC
                                        </p>
                                    </div>
                                </li>
                                <!-- <li class="information-icons__item">
                                    <div class="information-icons__icon"><img src="/img/icons/icon-money.svg" alt="">
                                    </div>
                                    <div class="information-icons__content">
                                        <p class="information-icons__title">Total earn
                                        </p>
                                        <p class="information-icons__name">$432
                                        </p>
                                    </div>
                                </li> -->
                            </ul>
                            <p>{{ __("If you are looking for a time-proven scheme for effective investment, then our company is just what you need. We will not only serve as a reliable keeper of your invested funds, but also provide a decent income from the use of the funds by our company. Luminex is a kind of universal tool that uses an efficient source for making money at a professional level. And now it provides everyone with the opportunity to participate in this process and receive 1.5% daily, for 180 days.") }}</p>
                        </div>
                    </div>
                </section>
                <section class="calculate calculate--smallPadding">
                    <div class="container">
                        <div class="calculate-block">
                            <div class="calculate-block__top">
                                <svg id="svg7819" viewBox="0 0 1153 68">
                                    <path id="path7829" style="fill:#ffffff" d="M 576.5,69.27947 H 0 v -4.88605 -4.88605 l 4.003163,-5.99478 4.003162,-5.99478 5.454519,-4.20814 5.45452,-4.20813 L 46.207682,35.16108 73.5,31.22062 l 38,-4.51337 38,-4.51337 32,-2.91771 32,-2.91772 24,-2.02385 24,-2.02384 41,-2.48712 41,-2.48711 30,-1.50162 30,-1.50162 L 430,3.32771 456.5,2.32212 519,1.16106 581.5,0 l 73,0.63135 73,0.63135 36.5,1.00502 36.5,1.00502 33.5,1.5363 33.5,1.53631 50,2.99393 50,2.99392 18.00003,1.50443 17.99997,1.50444 33.5,2.98832 33.5,2.98832 31,3.55713 31,3.55712 3.7916,2.46497 3.7916,2.46496 3.8969,4.01551 3.8969,4.01552 2.5615,4.37084 2.5615,4.37085 v 9.57193 9.57193 z"></path>
                                </svg>
                                <div class="calculate-block__top-content">
                                    <div class="calculate-block__bonus">
                                        <p>{{ __('Bonus') }} <strong>+0.2%</strong></p>
                                    </div>
                                    <div class="calculate-block__content">
                                        <h3 class="calculate-block__title"> <span>{{ __('Calculate your profit') }} </span>{{ __('and get up to 51% of income per month') }}
                                        </h3>
                                        <p>{{ __('Register and open a deposit, and your funds will be handed over to the professional traders, you will receive 1.5% profit every day based on the amount of your deposit. You get a fixed profit, regardless of the results of the trades.') }}</p>
                                        <p><strong>{{ __('Withdraw your funds and reinvest. Thus, you can easily increase the percentage of your income from the initial deposit.') }}</strong></p><a class="btn btn--yellow-line" href="{{ route('register') }}">{{ __('Start now!') }}</a>
                                    </div>
                                    <div class="calculate-block__right">
                                        <div class="calc">
                                            <div class="calc__top">
                                                <div class="calc__row">
                                                    <label class="label">{{ __('Choose a period') }}<span> ({{ __('days') }})</span>
                                                    </label>
                                                    <div class="js-slider">
                                                    </div><input type="hidden" class="calculatorDuration" value="180"/>
                                                </div>
                                                <div class="calc__row">
                                                    <label class="label">{{ __('Choose a budget') }}
                                                    </label>
                                                    <div class="calc__input-row"><input value="0.15" type="text" id="calculatorAmount"/>
                                                        <select id="calculatorCurrency">
                                                            <option>BTC</option>
                                                            <option>ETH</option>
                                                            <option>USD</option>
                                                        </select>
                                                        {{--<p class="subtext" class="calculatorBonus">+ <span class="calculatorBonusCurrency">BTC</span> 0.01 <span>бонус!</span>--}}
                                                        {{--</p>--}}
                                                    </div>
                                                </div>
                                                <div class="calc__row">
                                                    <!-- <label class="label">Выберите план
                                                    </label>
                                                    <select class="select">
                                                        <option>Plan name here</option>
                                                        <option>Plan name here</option>
                                                        <option>Plan name here</option>
                                                    </select> -->
                                                </div>
                                            </div>
                                            <div class="calc__bottom">
                                                <ul class="calc-results">
                                                    <li class="calc-results__item">
                                                        <p class="calc-results__title">{{ __('Profit') }}
                                                        </p>
                                                    </li>
                                                    <li class="calc-results__item">
                                                        <p class="calc-results__count day" style="font-size:16px;">7.50
                                                        </p>
                                                        <p class="calc-results__currency">BTC
                                                        </p>
                                                        <p class="calc-results__description day">{{ __('per day') }}
                                                        </p>
                                                    </li>
                                                    <li class="calc-results__item">
                                                        <p class="calc-results__count alltime" style="font-size:16px;">675.00
                                                        </p>
                                                        <p class="calc-results__currency">BTC
                                                        </p>
                                                        <p class="calc-results__description alltime">{{ __('for the entire period') }}
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="calculate-block__bottom">
                                <div class="calculate-block__bottom-content">
                                    <div class="calculate-block__bottom-text">
                                        <p><strong>{{ __('If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.2%.') }} <br>{{ __('1.28% - your new interest rate!') }}</strong></p>
                                    </div>
                                </div>
                                <svg viewBox="0 0 1151 50">
                                    <path d="M940.9125 49.836L748.5 49.672l-47.5-.7468-47.5-.7467-50-1.1203-50-1.1203-33-.9432-33-.9432-37.5-1.052-37.5-1.052-38-1.496-38-1.4959-52.5-2.451-52.5-2.4512-12.5-.5853-12.5-.5853-25-1.4713-25-1.4712-46-2.9513-46-2.9513L42 22.4069l-22.5-1.6308-4.6972-2.9584-4.6972-2.9584-3.4962-3.87L3.113 7.1196 1.5566 4.1094 0 1.0994V0h1151v32.6744l-3.9637 5.5353-3.9637 5.5352-4.8739 3.1276L1133.3249 50z" fill="#5d639d"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <section class="questions">
                <svg width="1950" height="150" viewBox="0 0 1950 70">
                    <path style="stroke-width:1.33333337" d="M 975.00003,112.90273 H 0 v -8.67285 -8.67286 l 22.25,1.110179 22.25,1.110192 44.50001,1.69344 44.49999,1.693449 51.5,1.78979 51.50001,1.78975 194.53072,0.91253 194.53073,0.9125 84.96928,-1.92862 84.96928,-1.92863 46.50001,-1.62498 46.5,-1.624977 40.9999,-1.746116 41.0001,-1.746092 49.49997,-2.503597 49.5,-2.503597 42,-2.533146 42,-2.533145 48.5,-3.357547 48.5,-3.357533 43,-3.393086 43,-3.393085 38.4999,-3.377465 38.5001,-3.377451 43.5,-4.189619 43.5,-4.189606 47.5,-5.076983 47.5,-5.076983 36,-4.206137 36,-4.206124 13,-1.637604 13,-1.637616 39.9999,-5.121585 40.0001,-5.121596 48,-6.719744 48.0001,-6.719756 38.4367,-5.8682086 L 1946.3736,0 h 1.8132 1.8132 v 56.451362 56.451368 z"></path>
                </svg>
                <div class="container">
                    <div class="questions__image"><img src="/img/quations.png" alt="">
                    </div>
                    <div class="questions__content">
                        <h3 class="questions__title">{{ __('Do you have any questions?') }}
                        </h3>
                        <div class="questions__text">
                            <p>{{ __("If you have any questions about working with us, and you did not find the answers in the FAQ section, be sure to contact our support team. We try to take care of our investors and always answer if you need our help. All the necessary information about our company can also be found on our website.") }}</p>
                        </div><a class="btn btn btn--accent-line" href="{{ route('customer.contact') }}">{{ __('Contact us') }}</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

<script>document.getElementById("investorsPageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection
