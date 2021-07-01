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
                    <p><strong>{{ __('Luminex Technology is an innovative company that uses the latest technologies of artificial intelligence, which is able to self-learn using the history, analytics and experience of our traders, who improve their trading skills day by day. The mission of our company is to completely change the perception of ​​trading on exchanges and the use of machine technology. For the sake of the active development of our future, we have created an opportunity to attract a huge number of investors at once, who will be able to stand in the forefront of the emergence of a new era of technology. We give our investors a great opportunity to be the first to “change the game” of modern earnings.') }}</strong></p>
                    <p>{{ __('Our traders are not engaged directly in trading on the cryptocurrency exchange, they work as controllers and make sure that there are no problems in the trading process. AI is the real future of mankind. Artificial intelligence does not get tired and does not make the same mistakes twice. Therefore, we have entrusted all the basic work to the self-learning technologies. The activities of our company are designed for the long term perspective, so we are interested in making it profitable for investors to cooperate with us. And also we are interested in regularly attracting new partners: pay attention to our referral program.') }}</p>
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
                    <p>{{ __('Our company is an affordable, transparent and secure tool for automated trading in highly stable cryptocurrency markets, with the purpose to improve the well-being of each participant without need them to have in-depth knowledge of cryptocurrency, blockchain and neural networks.') }}</p>
                </div>
            </div>
            <section class="up-to">
                <div class="container">
                    <div class="up-to__content">
                        <h3 class="up-to__title">{{ __('up to 51%') }}<span> {{ __('per month') }}</span>
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
                            <p><strong>{{ __('By accepting the agreement, you enter into an agreement with our company.') }}</strong></p>
                            <p style="margin-bottom: 30px;">{{ __('Our company offers its clients an opportunity to get rid of the existing risks in the cryptocurrency market by assuming full responsibility for trading on the exchanges. The investor (in this case, the Client) provides the funds to be securely managed by our company. Just like if the funds were borrowed by the company. In return, our company provides interest from the profits from these funds. We offer a 100% guarantee of daily profit for the whole lifetime of the deposit or until you yourself decide to cease our cooperation.') }}</p><a class="btn btn--white-line" href="{{ route('register') }}">{{ __('Start earning!') }}</a>
                        </div>
                    </div>
                    <div>
                        <div style="width:33%; float:left; height:300px; text-align: left;">
                            <h3 style="font-weight:bold; font-size:19px;">Certificate of Registration of a Legal Entity</h3>
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
                            <h3 style="font-weight:bold; font-size:19px;">Investment License</h3>
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
                            <h3 style="font-weight:bold; font-size:19px;text-align:right;">License to Do Business on the Internet</h3>
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
                        <p><strong>{{ __('The activity of our company is based on the exchange trading in cryptocurrencies. Previously, we constantly conducted analytical studies and developed strategies based on the volatility of the currency exchange rates. With the help of a large team of professional traders and analysts, our company has been successfully operating for more than six years. The founder of the company is the famous trader Danny Ivrin, who made his fortune long before the appearance of cryptocurrencies.') }}</strong></p>
                        <p>{{ __("He has timely noticed the rapid development of cryptomarketing and decided to open his own platform that works on its own principles. He gathered a team of experienced professionals with whom he worked over the years. At some point, most of the company's income was channeled into the development of new technologies - investing in the creation of artificial intelligence, which the company is currently actively using to trade on cryptocurrency exchanges, analyzing dynamics and working with investors. Due to this, our company has changed dramatically - the number of employees in the company has diminished to less that a third, all inexperienced traders were taken away by competitors, we hired a large number of marketers, removed standard furniture from our office and arranged a comfortable, pleasant place for efficient and enjoyable work surrounded by technology. And all of this is a big leap forward.") }}</p>
                        <p class="col-50">{{ __('After completing the work on AI for our company and its training using the experience of employees and our well-chosen database, the investment in this technology paid off in a matter of weeks. Costs have decreased, and wages have increased. Such success is associated with the quality of the original product introduced by the company. The neural network has reduced the number of cryptocurrency trading errors to a minimum.') }}</p>
                        <div class="quote">
                            <div class="quote__left">
                                <p class="quote__text">{{ __('«Machines have to replace people, it is inevitable and right for the development of mankind»') }}
                                </p>
                                <p class="quote__author">{{ __('Danny Ivrin, CEO') }}
                                </p>
                            </div>
                            <div class="quote__right"><img src="/img/quote.png" alt="">
                            </div>
                        </div>
                        <p>{{ __('How is it possible to earn big money on cryptocurrencies? This is a completely unstable market, subject to multiple risks, dumping at large currency allocations, which can be organized only by a large company or a mass media (like ours, for example). If the economy seems a difficult science to you, and you perceive traders as the unique minds of humanity, you can forget about understanding of the working system of cryptocurrencies at its whole. But our technology has absorbed all the possible information that simply could not physically fit within the head of a living person. The neural network is the brain, which is free from any mistakes of nature, the brain, which is not aware of the concept of "feeling sick" or the need for anything (sleep, food, etc.), it has no self-serving motives - it just absorbs information based on the task and performs it perfectly.') }}</p>
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
                            <p><strong>{{ __('Making money with Luminex Trading is easy. We are interested in unlimited investments, so we have created a system in which each and every person can receive passive income, despite their physical location. We are aiming at saving the precious time and benefiting from attracting new investors. The most important thing is that you don’t need to know anything about trading, cryptocurrencies, or to understand the complex modern technological innovations. Just join us and you will understand how easy it is to have a stable passive income.') }}</strong></p>
                            <p>{{ __('In order to get started with us, you don’t need to dive into any new schemes or reinvent the wheel, everything has already been invented and simplified especially for you.') }}</p>
                            <p>{{ __('1) Complete a simple registration and login into the system. Keep in mind that creating multi-accounts is a violation of our community rules. One individual has the right to register only one account.') }}</p>
                            <p>{{ __('2) Open a deposit, i.e. replenish the balance in any convenient way. We cooperate with most well-known payment systems: Bitcoin, Etherium, Perfect Money, Payeer.') }}</p>
                            <p>{{ __('Your work ends here :) You just have to wait for the payouts according to your investment  plan, but if you want to increase your profit rate, feel free to use our referral system and receive money from each invited participant. For many investors, our referral program is a real business, because they are professionally engaged in attracting investors to our project and receive professional interest on payments.') }}</p>
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
