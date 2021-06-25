@extends('layouts.customer')
@section('title', __('Home'))
@section('content')
    @include('partials.loader')
    <main role="main">
        <section class="intro">
            <div class="container">
                <div class="intro__content">
                    <h1 class="intro__title">
                      {{ __('Investments in') }}<span> {{ __('cryptocurrency') }} <br>{{ __('and forex') }}</span>
                    </h1>
                    <p class="intro__description">{{ __('Energy of cryptocurrency') }}
                    </p><a class="btn intro__btn" href="{{ route('register') }}">{{ __('Start now!') }}</a>
                </div>
                <div class="intro__image"><img src="/img/header-img.png" alt=""/>
                </div>
            </div>
        </section>
        <!-- <section class="counts">
            <div class="container">
                <ul class="counts__list">
                    <li class="counts__item counts__item--icon">
                        <div class="counts__icon"><img src="/img/six.png" alt="">
                        </div>
                        <div class="counts__description-block">
                            <p class="counts__title">{{ __('actual information') }}
                            </p>
                            <p class="counts__description">{{ __('in business') }}
                            </p>
                        </div>
                    </li>
                    <li class="counts__item">
                        <div class="counts__block">
                            <p class="number">{{ getRunningDays() }}
                            </p><img src="/img/icons/map-icon.svg" alt="">
                        </div>
                        <div class="counts__description-block">
                            <p class="counts__title">{{ getRunningDays() }} {{ __('days') }}
                            </p>
                            <p class="counts__description">{{ __('in business') }}
                            </p>
                        </div>
                    </li>
                    <li class="counts__item">
                        <div class="counts__block">
                            <p class="number">{{ getTotalAccounts() }}
                            </p><img src="/img/icons/peoples-icon.svg" alt="">
                        </div>
                        <div class="counts__description-block">
                            <p class="counts__title">{{ getTotalAccounts() }} {{ __('investors') }}
                            </p>
                            <p class="counts__description">{{ __('are using Luminex') }}
                            </p>
                        </div>
                    </li>
                    <li class="counts__item">
                        <div class="counts__block">
                            <p class="number"><span>$</span> {{ getTotalDeposited()['USD'] }}
                            </p><img src="/img/icons/money-icon.svg" alt="">
                        </div>
                        <div class="counts__description-block">
                            <p class="counts__title">$ {{ getTotalDeposited()['USD'] }} {{ __('invested') }}
                            </p>
                            <p class="counts__description">{{ __('by our investors') }}
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </section> -->
        <section class="intro-text">
            <div class="container">
                <h2 class="page-title">{{ __('Let money work for you') }} <span>{{ __('while you are relaxing') }}</span>
                </h2>
                <div class="intro-text__description">
                    <p>{{ __('Technologies are developing at an enormous pace, human physical work is being used less and less with every passing year. Our future is fully automated technologies. This also applies to the cryptocurrency trade. Our company is an affordable, transparent and secure tool for automated trading in highly stable cryptocurrency markets, with the purpose to improve the well-being of each participant without need them to have in-depth knowledge of cryptocurrency, blockchain and neural networks.') }}</p>
                </div><a class="btn btn--yellow-line" href="{{ route('customer.aboutus') }}">{{ __('Find out more') }}</a>
            </div>
        </section>
        <section class="mosaic">
            <div class="container">
                <div class="mosaic__row mosaic__row--profit">
                    <div class="mosaic__image">
                        <div class="mosaic__image-block"><img src="/img/mosaic/profit.png" alt="">
                        </div>
                    </div>
                    <div class="mosaic__text">
                        <h3 class="mosaic__title">{{ __('Profit 1.5% per day') }}<br> {{ __('for 180 days') }}
                        </h3>
                        <div class="mosaic__description">
                            <p>{{ __('The best part about investing is that you don’t have to do anything to make money appear in your account. You are able to get more free time while increasing your income daily!') }}</p>
                        </div><a class="btn btn--yellow-line" href="{{ route('customer.investors') }}">{{ __('Find out more') }}</a>
                    </div>
                </div>
                <div class="mosaic__row mosaic__row--deposit reverse">
                    <div class="mosaic__text">
                        <h3 class="mosaic__title">{{ __('Minimum deposit') }} 0.002 BTC
                        </h3>
                        <div class="mosaic__description">
                            <p>{{ __('The most accessible investment method available for the general public today. Even without having millions in your wallet, you have the opportunity to get a decent passive income.') }}</p>
                        </div><a class="btn btn--yellow-line" href="{{ route('customer.investors') }}">{{ __('Find out more') }}</a>
                    </div>
                    <div class="mosaic__image">
                        <div class="mosaic__image-block"><img src="/img/mosaic/deposit.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="mosaic__row mosaic__row--withdrawl">
                    <div class="mosaic__image">
                        <div class="mosaic__image-block"><img src="/img/mosaic/widthdrawal.png" alt="">
                        </div>
                    </div>
                    <div class="mosaic__text">
                        <h3 class="mosaic__title">{{ __('Minimum withdrawal') }} 0.0008 BTC
                        </h3>
                        <div class="mosaic__description">
                            <p>{{ __('An investor is usually a person who, in exchange for the opportunity of increasing profits, assumes the risk of losing his or her funds. But Luminex proves on a daily basis that this approach is outdated. Our investors are not only taking no risks, but can withdraw money at any time.') }}</p>
                        </div><a class="btn btn--yellow-line" href="{{ route('customer.investors') }}">{{ __('Find out more') }}</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="calculate">
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
                                <p><strong>{{ __('If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.2%.') }} <br>{{ __('1.7% - your new interest rate!') }}</strong></p>
                            </div>
                        </div>
                        <svg viewBox="0 0 1151 50">
                            <path d="M940.9125 49.836L748.5 49.672l-47.5-.7468-47.5-.7467-50-1.1203-50-1.1203-33-.9432-33-.9432-37.5-1.052-37.5-1.052-38-1.496-38-1.4959-52.5-2.451-52.5-2.4512-12.5-.5853-12.5-.5853-25-1.4713-25-1.4712-46-2.9513-46-2.9513L42 22.4069l-22.5-1.6308-4.6972-2.9584-4.6972-2.9584-3.4962-3.87L3.113 7.1196 1.5566 4.1094 0 1.0994V0h1151v32.6744l-3.9637 5.5353-3.9637 5.5352-4.8739 3.1276L1133.3249 50z" fill="#5d639d"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <section class="guarantees">
            <div class="container">
                <h3 class="guarantees__title">{{ __('We provide guarantees') }}<span> {{ __('It’s safe with us') }}</span>
                </h3>
                <div class="guarantees__row">
                    <div class="guarantees__content">
                        <p><strong>{{ __('By accepting the agreement, you enter into an agreement with our company.') }}</strong></p>
                        <p>{{ __('Our company offers its clients an opportunity to get rid of the existing risks in the cryptocurrency market by assuming full responsibility for trading on the exchanges. The investor (in this case, the Client) provides the funds to be securely managed by our company. Just like if the funds were borrowed by the company. In return, our company provides interest from the profits from these funds. Regardless of the trading results, the investor makes a profit depending on the size of the deposit, without taking the bonus rates into account and at any possible outcome of the trades. The client will not lose funds in case of unsuccessful trading, but also his profit will not increase if they are very successful. At the same time, we offer a 100% guarantee of daily profit for the whole lifetime of the deposit or until you yourself decide to stop our cooperation.') }}</p><a class="btn btn--white-line" href="#regisration" data-fancybox="" data-modal="true">{{ __('Start earning!') }}</a>
                    </div>
                    <div class="guarantees__list-wrap">
                        <ul class="guarantees__list">
                            <li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/guarant.png" data-fancybox="guarantees"><img src="/img/guarantees/guarant.png" alt=""></a>
                            </li>
                            {{--<li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/guarant2.png" data-fancybox="guarantees"><img src="/img/guarantees/guarant2.png" alt=""></a>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>
                <div class="guarantees__bottom">
                    <h4 class="guarantees__bottom-title">{{ __('Do you have any questions?') }}
                    </h4><a class="btn btn--accent-line" href="{{ route('customer.contact') }}">{{ __('Contact us') }}</a>
                </div>
            </div>
        </section>
        <section class="referral">
            <div class="container">
                <div class="referral__image"><img src="/img/refferal.png" alt="">
                </div>
                <div class="referral__content">
                    <h3 class="referral__title"><span>{{ __('4 level') }}</span> {{ __('referral program') }}
                    </h3>
                    <div class="referral__desription">
                        <p><strong>{{ __('If you’re not used to just sitting and waiting, be sure to use our referral program!') }}</strong></p>
                        <p>{{ __('How to increase profits and how to make it easier? With the help of our referral program, you can receive additional profit from each new investor invited with your personal link, provided that he or she open a deposit within our program. We pay interest for each invited participant. Thus, even without making a deposit of your own, you can still multiply your profit!') }}</p>
                    </div><a class="btn btn--yellow-line" href="{{ route('customer.partners') }}">{{ __('Find out more') }}</a>
                </div>
            </div>
        </section>
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
        <section class="representative">
            <div class="container">
                <div class="representative__content">
                    <h3 class="representative__title"><span>{{ __('Representative') }}</span> {{ __('referral program') }}
                    </h3>
                    <ul class="levels-list">
                        <li class="levels-list__item">
                            <p class="levels-list__count">7<sup>%</sup>
                            </p>
                            <p class="levels-list__desc">1<sup>{{ __('st') }}</sup> {{ __('level') }}
                            </p>
                        </li>
                        <li class="levels-list__item">
                            <p class="levels-list__count">5<sup>%</sup>
                            </p>
                            <p class="levels-list__desc">2<sup>{{ __('nd') }}</sup> {{ __('level') }}
                            </p>
                        </li>
                        <li class="levels-list__item">
                            <p class="levels-list__count">3<sup>%</sup>
                            </p>
                            <p class="levels-list__desc">3<sup>{{ __('rd') }}</sup> {{ __('level') }}
                            </p>
                        </li>
                        <li class="levels-list__item">
                            <p class="levels-list__count">1<sup>%</sup>
                            </p>
                            <p class="levels-list__desc">4<sup>{{ __('th') }}</sup> {{ __('level') }}
                            </p>
                        </li>
                        <li class="levels-list__item">
                            <p class="levels-list__count">1<sup>%</sup>
                            </p>
                            <p class="levels-list__desc">5<sup>{{ __('th') }}</sup> {{ __('level') }}
                            </p>
                        </li>
                    </ul>
                    <div class="representative__description">
                        <p>{{ __('We offer a special referral program for major partners of our company. You can become our official representative and use your own audience or advertising company to receive profit from us.') }}</p>
                    </div>
                </div>
                <div class="representative__right"><img class="representative__image-main" src="/img/representative.png" alt="" role="presentation"/>
                    <div class="representative__text">
                        <!-- <p>хз, что тут писать</p> -->
                    </div>
                </div>
                <div class="representative__bottom"><a class="btn btn--yellow-line" href="{{ route('customer.partners') }}">{{ __('Find out more') }}</a>
                </div>
            </div>
        </section>
        <section class="partners">
            @include('layouts.partnerlist')
        </section>
        <section class="faq">
            <div class="container">
                <div class="faq__top">
                    <h3 class="faq__subtitle">{{ __('Got questions?') }}
                    </h3>
                    <h3 class="faq__title"><span>FAQ</span>
                    </h3>
                </div>
                <div class="faq__content">
                    <div class="faq-block accordion">
                        <h3 class="faq-block__title">{{ __("What is Luminex?") }}
                        </h3>
                        <div class="faq-block__content">{{ __("This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities.") }}
                        </div>
                        <h3 class="faq-block__title">{{ __("What is Luminex Technology?") }}
                        </h3>
                        <div class="faq-block__content">{{ __("Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount.") }}
                        </div>
                        <h3 class="faq-block__title">{{ __("Is Luminex an officially registered company?") }}
                        </h3>
                        <div class="faq-block__content">{{ __("Our company is officially registered, and works legally. All documents are presented on the company's website. By starting your work with this service, you enter into an agreement with us.") }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<script>document.getElementById("homePageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection

@push('scripts')
@if(isset($errors) && !empty($errors->first()))
<script>
    alert("{{ $errors->first() }}");
</script>
@endif
@endpush
