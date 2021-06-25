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
