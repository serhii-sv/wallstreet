@extends('layouts.customer')
@section('title', __('For representative'))
@section('content')
    <main role="main" style="background: white">
        <div class="page">
            <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
                <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
            </svg>
            @include('partials.breadcrumbs')
            <div class="container">
                <h2 class="page-title page-title--line">{{ __('Be successful with') }} <span>{{ __('our representative program') }}</span>
                </h2>
                <div class="text">
                    <p><strong>{{ __("The professionals of our company have not only implemented a system for the development of an investment fund with various ways of monetization for investors with completely different financial capabilities, but also opened up opportunities for promising cooperation, both for people with competence in the development of advertising strategies and advertisers of different types and sizes. The five-step representative referral program allows you to earn millions together with Luminex.") }}</strong></p>
                </div>
            </div>
            <section class="levels-list-section">
                <div class="container">
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
                </div>
            </section>
            <section class="image-text-representative">
                <div class="container">
                    <div class="image-text-representative__col">
                        <div class="image-text-representative__image"><img class="layer1" src="/img/representative1.svg" alt=""><img class="layer2" src="/img/representative2.svg" alt=""><img class="layer3" src="/img/representative3.svg" alt="">
                        </div>
                        <h3 class="image-text-representative__image-title"><span>{{ __('Gain success with') }} </span>Luminex Technology
                        </h3>
                    </div>
                    <div class="image-text-representative__col">
                        <div class="text">
                            <h1>{{ __('Representative program') }}</h1>
                            <p><strong>{{ __("We are interested in unlimited investments, so we have created a system in which each and every person can receive passive income, despite their physical location. We are aiming at saving the precious time and benefiting from attracting new investors. The most important thing is that you don’t need to know anything about trading, cryptocurrencies, or to understand the complex modern technological innovations. Just join us and you will understand how easy it is to have a stable passive income.") }}</strong></p>
                            <p>{{ __("You can become part of our special referral program for partners. The program contains two ways of development, and the principle of both is based in attracting neither one nor a couple of fellow investors, but a large audience at once. If you have a social network or the ability to connect with your own audience, you can use this to generate additional income. Also, without having a developed account at the moment, you still can create and run your own advertising campaign. Thus, you can receive a lifetime income from the withdrawals of investors who work with us by registering via your link, while you may be completely unfamiliar with them. This means the number of such investors can be unlimited, and the profits from them can be much greater.") }}</p>
                        </div>
                    </div>
                    <div class="image-text-representative__bottom"><a class="btn btn btn--accent-line" href="{{ route('customer.contact') }}">{{ __('Contact us') }}</a>
                    </div>
                    <div style="margin-top:100px;width:100%;">
                        <h2 class="page-title page-title--line">Our representatives</h2>
                        <style>
                            .tttable {
                                width:100% !important;
                            }
                            .tttable td {
                                font-weight: bold;
                                padding:10px;
                                border:1px solid rgb(220,220,220);
                            }
                        </style>
                        <table class="tttable">
                            <tr>
                                <td style="color:grey;background: rgb(250,250,250);">Username</td>
                                <td style="color:grey;background: rgb(250,250,250);">Country</td>
                                <td style="color:grey;background: rgb(250,250,250);">Languages</td>
                                <td style="color:grey;background: rgb(250,250,250);">E-mail</td>
                            </tr>
                            <tr>
                                <td>Hyipowner</td>
                                <td>Bangladesh</td>
                                <td>English</td>
                                <td><a href="mailto:admin@hyipowner.com">admin@hyipowner.com</a></td>
                            </tr>
                            <tr>
                                <td>GenInvNews</td>
                                <td>Indonesia</td>
                                <td>English,Bahasa</td>
                                <td><a href="mailto:rohmannssz@gmail.com">rohmannssz@gmail.com</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </main>

<script>document.getElementById("representativePageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection
