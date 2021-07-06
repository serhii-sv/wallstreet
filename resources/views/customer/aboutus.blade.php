@extends('layouts.customer')
@section('title', __('About us'))
@section('content')
    <main role="main" style="background: white">
        <div class="page">
            <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
                <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
            </svg>
            @include('partials.breadcrumbs')
            <div class="container">
                <h2 class="page-title page-title--line">{{ __('What can we do for you?') }} <span>{{ __('About our company') }}</span>
                </h2>
                <div class="text">
                    <p>{{ __('The Company has all the legal documents, permits and certificates for conducting trading and investment activities.') }}</p>
                    <p>{{ __('The company’s major source of income is trading on cryptocurrency exchanges. Currently, cryptocurrency trading is the most profitable and the most large-scale in earnings. The volatility of digital currencies is a direct source of income in the digital market. We use short-term and long-term positions, depending on the current market position. Our experienced specialists conduct a qualified market analysis and ensure top results in obtaining good profits. Our team is an active participant in the digital market: hundreds, thousands of transactions are conducted daily.') }}</p>
                </div>
            </div>
            <!-- <section class="counts">
                <div class="container">
                    <ul class="counts__list">
                        <li class="counts__item counts__item--icon">
                            <div class="counts__icon"><img src="/img/six.png" alt="">
                            </div>
                            <div class="counts__description-block">
                                <p class="counts__title">{{ __('6 years') }}
                                </p>
                                <p class="counts__description">{{ __('in business') }}
                                </p>
                            </div>
                        </li>
                        <li class="counts__item">
                            <div class="counts__block">
                                <p class="number">43
                                </p><img src="/img/icons/map-icon.svg" alt="">
                            </div>
                            <div class="counts__description-block">
                                <p class="counts__title">{{ __('43 countries') }}
                                </p>
                                <p class="counts__description">{{ __('in which we work') }}
                                </p>
                            </div>
                        </li>
                        <li class="counts__item">
                            <div class="counts__block">
                                <p class="number">5K
                                </p><img src="/img/icons/peoples-icon.svg" alt="">
                            </div>
                            <div class="counts__description-block">
                                <p class="counts__title">{{ __('More than 5000') }}
                                </p>
                                <p class="counts__description">{{ __('investors are using Luminex') }}
                                </p>
                            </div>
                        </li>
                        <li class="counts__item">
                            <div class="counts__block">
                                <p class="number"><span>$</span>50M
                                </p><img src="/img/icons/money-icon.svg" alt="">
                            </div>
                            <div class="counts__description-block">
                                <p class="counts__title">{{ __('$50.2 million') }}
                                </p>
                                <p class="counts__description">{{ __('total profit of our investors') }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </section> -->
            <div class="container">
                <div class="text">
                    <p>{{ __('Our main task is to promote our business using our author strategies and trading techniques by increasing our capital raised by the trust management system to increase our profitability. To do this, we have entered the market for online investments, opened "trust management" and began cooperation on mutually beneficial terms with private investors. Our goal is to increase company`s assets and also to make the world of cryptocurrency trading accessible to everyone, regardless of their status, income or country of residence.') }}</p>
                </div>
            </div>
            <section class="up-to">
                <div class="container">
                    <div class="up-to__content">
                        <h3 class="up-to__title">{{ __('up to 38.4%') }}<span> {{ __('per month') }}</span>
                        </h3>
                        <p class="up-to__description">{{ __('We care about you') }}
                        </p>
                    </div>
                    <div class="up-to__image"><img src="/img/up-to.png" alt="">
                    </div>
                </div>
            </section>
            <section class="guarantees">
                <div class="container">
                    <h3 class="guarantees__title">{{ __('We provide guarantees') }}<span> {{ __('It’s safe with us') }}</span>
                    </h3>
                    <div class="guarantees__row">
                        <div style="line-height: 140%;">
                            <p style="margin-bottom: 30px;">{{ __('Luminex is an online ecosystem that provides financial services to businesses and individuals around the globe. We have selected the best high-yield tools for our ecosystem and made them as accessible as possible. A wide range of services for different customer needs.') }}</p>
                            <a class="btn btn--white-line" href="{{ route('register') }}">{{ __('Start earning!') }}</a>
                        </div>
                    </div>
                    <div>
                        <div style="width:33%; float:left; height:300px; text-align: left;">
                            <h3 style="font-weight:bold; font-size:19px;">{{ __('Certificate of Registration of a Legal Entity') }}</h3>
                            <div style="margin-top:30px;">
                                <div class="guarantees__list-wrap" style="width:100%;">
                                    <ul class="guarantees__list">
                                        <li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/doc1.jpg" data-fancybox="guarantees" style="box-shadow: none; border:none;"><img src="/img/guarantees/doc1.jpg" alt="" style="width:200px;"></a>
                                        </li>
                                        {{--<li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/guarant2.png" data-fancybox="guarantees"><img src="/img/guarantees/guarant2.png" alt=""></a>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div style="width:33%; float:left; height:300px; text-align: center;">
                            <h3 style="font-weight:bold; font-size:19px;">{{ __('Investment License') }}</h3>
                            <div style="margin-top:30px;">
                                <div class="guarantees__list-wrap" style="width:100%;">
                                    <ul class="guarantees__list" style="margin-left: 50px;">
                                        <li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/doc3.jpg" data-fancybox="guarantees" style="box-shadow: none; border:none;"><img src="/img/guarantees/doc3.jpg" alt="" style="width:250px; background:none;"></a>
                                        </li>
                                        {{--<li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/guarant2.png" data-fancybox="guarantees"><img src="/img/guarantees/guarant2.png" alt=""></a>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div style="width:33%; float:left; height:300px; text-align: right;">
                            <h3 style="font-weight:bold; font-size:19px;text-align:right;">{{ __('License to Do Business on the Internet') }}</h3>
                            <div style="margin-top:30px;">
                                <div class="guarantees__list-wrap" style="width:100%; float:right;">
                                    <ul class="guarantees__list" style="margin-left:60px;">
                                        <li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/doc2.jpg" data-fancybox="guarantees" style="box-shadow: none; border:none;"><img src="/img/guarantees/doc2.jpg" alt="" style="width:200px;"></a>
                                        </li>
                                        {{--<li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/guarant2.png" data-fancybox="guarantees"><img src="/img/guarantees/guarant2.png" alt=""></a>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="clear:both; margin-top:400px;"></div>
                    <div class="guarantees__bottom">
                        <h4 class="guarantees__bottom-title">{{ __('Do you have any questions?') }}
                        </h4><a class="btn btn--accent-line" href="{{ route('customer.contact') }}">{{ __('Contact us') }}</a>
                    </div>
                </div>
            </section>
            <div class="section about-text">
                <div class="container">
                    <div class="text">
                        <table style="width:100%;">
                            <tr>
                                <td style="width: 50%; vertical-align: top;">
                                    <p>{{ __('Three ready-to-use investment proposals and the configurator of investment packages were developed for achieving these goals. Thanks to it every investor can create such an investment package, which is more appropriate for him.') }}</p>
                                    <p>
                                        <strong>{{ __('No trading experience or knowledge required.') }}</strong>
                                    </p>
                                    <p>{{ __('A team of professional traders from Luminex works for you. Carefully selected methods of money management and the best trading strategies have allowed us to create a safe and effective source of passive income.') }}</p>
                                </td>
                                <td>
                                    <img src="/img/quote.png" alt="">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <section class="image-text-about">
                <svg width="1950" height="150" viewBox="0 0 1950 70">
                    <path style="stroke-width:1.33333337" d="M 975.00003,112.90273 H 0 v -8.67285 -8.67286 l 22.25,1.110179 22.25,1.110192 44.50001,1.69344 44.49999,1.693449 51.5,1.78979 51.50001,1.78975 194.53072,0.91253 194.53073,0.9125 84.96928,-1.92862 84.96928,-1.92863 46.50001,-1.62498 46.5,-1.624977 40.9999,-1.746116 41.0001,-1.746092 49.49997,-2.503597 49.5,-2.503597 42,-2.533146 42,-2.533145 48.5,-3.357547 48.5,-3.357533 43,-3.393086 43,-3.393085 38.4999,-3.377465 38.5001,-3.377451 43.5,-4.189619 43.5,-4.189606 47.5,-5.076983 47.5,-5.076983 36,-4.206137 36,-4.206124 13,-1.637604 13,-1.637616 39.9999,-5.121585 40.0001,-5.121596 48,-6.719744 48.0001,-6.719756 38.4367,-5.8682086 L 1946.3736,0 h 1.8132 1.8132 v 56.451362 56.451368 z"></path>
                </svg>
                <div class="container">
                    <div class="image-text-about__image"><img src="/img/graph.png" alt="">
                    </div>
                    <div class="image-text-about__col">
                        <div class="text">
                            <p><strong>{{ __('Professional investments') }}</strong></p>
                            <p>{{ __('Creating an investment package on individual terms. You can choose the amount of the deposit, set the term of the deposit and choose the type of accrual of payments on the deposit, depending on your requirements.') }}</p>
                        </div>
                        <div class="text">
                            <p><strong>{{ __('Profitable investment') }}</strong></p>
                            <p>{{ __('The daily return on the deposit strictly depends on the type of accrual of payments on the deposit. The longer the funds remain on the trading platform, the greater their liquidity.') }}</p>
                        </div>
                        <div class="text">
                            <p><strong>{{ __('Full control') }}</strong></p>
                            <p>{{ __('If you need money before the end of the deposit, you can always get it by selling your investment package.') }}</p>
                        </div>
                    </div>
                    <div class="image-text-about__bottom">
                        <h4 class="image-text-about__bottom-title">{{ __('Have you joined Luminex yet?') }}
                        </h4><a class="btn btn--accent-line" href="{{ route('register') }}">{{ __('Join us') }}</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

<script>document.getElementById("aboutUsPageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection
