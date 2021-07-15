@extends('layouts.customer')
@section('title', __('Home'))
@section('content')
  @include('partials.loader')
  <main role="main">
    <section class="intro">
      <div class="container">
        <div class="intro__content">
          <h1 class="intro__title">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name="Luminex" contenteditable="true">{{ __('Luminex') }}</editor_block>
            @else
              {{ __('Luminex') }}
            @endif
            <span>
            @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="for Finance" contenteditable="true">{{ __('for Finance') }}</editor_block>
              @else
                {{ __('for Finance')  }}
              @endif
            </span>
          </h1>
          <p class="intro__description">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name="It is an online ecosystem based on financial services around the world. We have collected the best high-yield instruments in a single system." contenteditable="true">
                {{ __('It is an online ecosystem based on financial services around the world. We have collected the best high-yield instruments in a single system.') }}
              </editor_block>
            @else
              {{ __('It is an online ecosystem based on financial services around the world. We have collected the best high-yield instruments in a single system.') }}
            @endif
          </p>
          <a class="btn intro__btn" href="{{ route('register') }}"
              @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif
          >
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name="Start now!" contenteditable="true">{{ __('Start now!') }}</editor_block>
            @else
              {{ __('Start now!') }}
            @endif
          </a>
        </div>
        <div class="intro__image"><img src="/img/header-img.png" alt="" />
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
        <h2 class="page-title">
          @if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name="About the company" contenteditable="true">{{ __('About the company') }}</editor_block>
            @else
            {{ __('About the company') }}
            @endif
            </span>
        </h2>
        <div class="intro-text__description">
          <p>@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name="Luminex is an online ecosystem that provides financial services to businesses and individuals around the globe. We have selected the best high-yield tools for our ecosystem and made them as accessible as possible. A wide range of services for different customer needs." contenteditable="true">{{ __('Luminex is an online ecosystem that provides financial services to businesses and individuals around the globe. We have selected the best high-yield tools for our ecosystem and made them as accessible as possible. A wide range of services for different customer needs.') }}</editor_block>
            @else
              {{ __('Luminex is an online ecosystem that provides financial services to businesses and individuals around the globe. We have selected the best high-yield tools for our ecosystem and made them as accessible as possible. A wide range of services for different customer needs.') }}
            @endif
          </p>
        </div>
        <a class="btn btn--yellow-line" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault();" @endif href="{{ route('customer.aboutus') }}">@if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name="Find out more" contenteditable="true">{{ __('Find out more') }}</editor_block>
          @else
            {{ __('Find out more') }}
          @endif</a>
      </div>
    </section>
    <section class="mosaic">
      <div class="container">
        <div class="mosaic__row mosaic__row--profit">
          <div class="mosaic__image" style="margin-top:100px;">
            <div class="mosaic__image-block">
              <img src="/images/c1.png" alt="" style="max-width:290px;margin-left:120px;">
            </div>
          </div>
          <div class="mosaic__text">
            <h3 class="mosaic__title">
              @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="Profit 0.77% per day" contenteditable="true">{{ __('Profit 0.77% per day') }}</editor_block>
              @else
                {{ __('Profit 0.77% per day') }}
              @endif
            </h3>
            <div class="mosaic__description">
              <p>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Our main task is to promote our business using our author strategies and trading techniques by increasing our capital raised by the trust management system to increase our profitability. To do this, we have entered the market for online investments, opened &quot;trust management&quot; and began cooperation on mutually beneficial terms with private investors. Our goal is to increase company`s assets and also to make the world of cryptocurrency trading accessible to everyone, regardless of their status, income or country of residence.' contenteditable="true">{{ __('Our main task is to promote our business using our author strategies and trading techniques by increasing our capital raised by the trust management system to increase our profitability. To do this, we have entered the market for online investments, opened "trust management" and began cooperation on mutually beneficial terms with private investors. Our goal is to increase company`s assets and also to make the world of cryptocurrency trading accessible to everyone, regardless of their status, income or country of residence.') }}</editor_block>
                @else{{ __('Our main task is to promote our business using our author strategies and trading techniques by increasing our capital raised by the trust management system to increase our profitability. To do this, we have entered the market for online investments, opened "trust management" and began cooperation on mutually beneficial terms with private investors. Our goal is to increase company`s assets and also to make the world of cryptocurrency trading accessible to everyone, regardless of their status, income or country of residence.') }}@endif
              </p>
            </div>
            <a class="btn btn--yellow-line" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault();" @endif href="{{ route('customer.investors') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="Find out more" contenteditable="true">{{ __('Find out more') }}</editor_block>
              @else{{ __('Find out more') }}@endif</a>
          </div>
        </div>
        <div class="mosaic__row mosaic__row--deposit reverse" style="margin-top:100px;">
          <div class="mosaic__text">
            <h3 class="mosaic__title">
              @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="Minimum deposit" contenteditable="true">{{ __('Minimum deposit') }}</editor_block>
              @else
                {{ __('Minimum deposit') }}
              @endif
              USD 10$
            </h3>
            <div class="mosaic__description">
              <p>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name="The most accessible investment method available for the general public today. Even without having millions in your wallet, you have the opportunity to get a decent passive income." contenteditable="true">{{ __('The most accessible investment method available for the general public today. Even without having millions in your wallet, you have the opportunity to get a decent passive income.') }}</editor_block>
                @else
                  {{ __('The most accessible investment method available for the general public today. Even without having millions in your wallet, you have the opportunity to get a decent passive income.') }}
                @endif</p>
            </div>
            <a class="btn btn--yellow-line" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.investors') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="Find out more" contenteditable="true">{{ __('Find out more') }}</editor_block>
              @else
                {{ __('Find out more') }}
              @endif</a>
          </div>
          <div class="mosaic__image">
            <div class="mosaic__image-block"><img src="/images/c2.png" alt="" style="margin-right:200px;">
            </div>
          </div>
        </div>
        {{--                <div class="mosaic__row mosaic__row--withdrawl">--}}
        {{--                    <div class="mosaic__image">--}}
        {{--                        <div class="mosaic__image-block"><img src="/img/mosaic/widthdrawal.png" alt="">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="mosaic__text">--}}
        {{--                        <h3 class="mosaic__title">{{ __('Minimum withdrawal') }} 0.0008 BTC--}}
        {{--                        </h3>--}}
        {{--                        <div class="mosaic__description">--}}
        {{--                            <p>{{ __('An investor is usually a person who, in exchange for the opportunity of increasing profits, assumes the risk of losing his or her funds. But Luminex proves on a daily basis that this approach is outdated. Our investors are not only taking no risks, but can withdraw money at any time.') }}</p>--}}
        {{--                        </div><a class="btn btn--yellow-line" href="{{ route('customer.investors') }}">{{ __('Find out more') }}</a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
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
                <p style="margin-left:30px;margin-top:-15px;">
                  <strong>+0.51%</strong>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name="to daily earnings" contenteditable="true">{{ __('to daily earnings') }}</editor_block>
                  @else
                    {{ __('to daily earnings') }}
                  @endif</p>
              </div>
              <div class="calculate-block__content">
                <h3 class="calculate-block__title">
                  <span>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name="Calculate your profit" contenteditable="true">{{ __('Calculate your profit') }}</editor_block>
                    @else
                      {{ __('Calculate your profit') }}
                    @endif </span>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name="and get up to 38.4% of income per month" contenteditable="true">{{ __('and get up to 38.4% of income per month') }}</editor_block>
                  @else
                    {{ __('and get up to 38.4% of income per month') }}
                  @endif
                </h3>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name="Three ready-to-use investment proposals and the configurator of investment packages were developed for achieving these goals. Thanks to it every investor can create such an investment package, which is more appropriate for him." contenteditable="true">{{ __('Three ready-to-use investment proposals and the configurator of investment packages were developed for achieving these goals. Thanks to it every investor can create such an investment package, which is more appropriate for him.') }}</editor_block>
                  @else
                    {{ __('Three ready-to-use investment proposals and the configurator of investment packages were developed for achieving these goals. Thanks to it every investor can create such an investment package, which is more appropriate for him.') }}
                  @endif</p>
              </div>
              <div class="calculate-block__right">
                <div class="calc">
                  <div class="calc__top">
                    <div class="calc__row">
                      <label class="label">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name="Choose a period" contenteditable="true">{{ __('Choose a period') }}</editor_block>
                        @else
                          {{ __('Choose a period') }}
                        @endif
                        <span>@if(canEditLang() && checkRequestOnEdit())
                            (
                            <editor_block data-name="days" contenteditable="true">{{ __('days') }}</editor_block>)
                          @else
                            ({{ __('days') }})
                          @endif</span>
                      </label>
                      <div class="js-slider">
                      </div>
                      <input type="hidden" class="calculatorDuration" value="180" />
                    </div>
                    <div class="calc__row">
                      <label class="label">{{ __('Choose a budget') }}
                      </label>
                      <div class="calc__input-row"><input value="0.15" type="text" id="calculatorAmount" />
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
                        <p class="calc-results__title">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name="Profit" contenteditable="true">{{ __('Profit') }}</editor_block>
                          @else
                            {{ __('Profit') }}
                          @endif
                        </p>
                      </li>
                      <li class="calc-results__item">
                        <p class="calc-results__count day" style="font-size:16px;">7.50
                        </p>
                        <p class="calc-results__currency">BTC
                        </p>
                        <p class="calc-results__description day">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name="per day" contenteditable="true">{{ __('per day') }}</editor_block>
                          @else
                            {{ __('per day') }}
                          @endif
                        </p>
                      </li>
                      <li class="calc-results__item">
                        <p class="calc-results__count alltime" style="font-size:16px;">675.00
                        </p>
                        <p class="calc-results__currency">BTC
                        </p>
                        <p class="calc-results__description alltime">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name="for the entire period" contenteditable="true">{{ __('for the entire period') }}</editor_block>
                          @else
                            {{ __('for the entire period') }}
                          @endif
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
                <p>
                  <strong>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name="If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.51%." contenteditable="true">{{ __('If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.51%.') }}</editor_block>
                    @else
                      {{ __('If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.51%.') }}
                    @endif
                    <br>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name="1.28% - your new interest rate!" contenteditable="true">{{ __('1.28% - your new interest rate!') }}</editor_block>
                    @else
                      {{ __('1.28% - your new interest rate!') }}
                    @endif</strong></p>
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
        <h3 class="guarantees__title">@if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name="We provide guarantees" contenteditable="true">{{ __('We provide guarantees') }}</editor_block>
          @else
            {{ __('We provide guarantees') }}
          @endif
          <span> @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name="It’s safe with us" contenteditable="true">{{ __('It’s safe with us') }}</editor_block>
            @else
              {{ __('It’s safe with us') }}
            @endif</span>
        </h3>
        <div style="clear:both; margin-top:50px;"></div>
        <div class="guarantees__row" style="width:40%; margin-right: 60px; float:left; padding:0;">
          <div style="line-height: 140%;">
            <p style="margin-bottom: 30px;">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Luminex is an online ecosystem that provides financial services to businesses and individuals around the globe. We have selected the best high-yield tools for our ecosystem and made them as accessible as possible. A wide range of services for different customer needs.' contenteditable="true">{{ __('Luminex is an online ecosystem that provides financial services to businesses and individuals around the globe. We have selected the best high-yield tools for our ecosystem and made them as accessible as possible. A wide range of services for different customer needs.') }}</editor_block>
              @else
                {{ __('Luminex is an online ecosystem that provides financial services to businesses and individuals around the globe. We have selected the best high-yield tools for our ecosystem and made them as accessible as possible. A wide range of services for different customer needs.') }}
              @endif</p>
            {{--                        <div style="text-align: center;">--}}
            {{--                            <a class="btn btn--white-line" href="{{ route('register') }}">{{ __('Start earning!') }}</a>--}}
            {{--                        </div>--}}
          </div>
        </div>
        <iframe style="float:right;" width="50%" height="315" src="https://www.youtube.com/embed/j4lAr7EsnBg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div style="clear:both; margin-top:450px;"></div>
        <table style="width:100%; clear:both;">
          <tr>
            <td>
              <div style="width:33%; min-width:350px; float:left; height:380px; text-align: left;">
                <h3 style="font-weight:bold; font-size:19px;">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Certificate of Registration of a Legal Entity' contenteditable="true">{{ __('Certificate of Registration of a Legal Entity') }}</editor_block>
                  @else
                    {{ __('Certificate of Registration of a Legal Entity') }}
                  @endif</h3>
                <div style="margin-top:30px;">
                  <div class="guarantees__list-wrap" style="width:100%;">
                    <ul class="guarantees__list">
                      <li class="guarantees__item">
                        <a class="guarantees__link" href="/img/guarantees/doc1.jpg" data-fancybox="guarantees" style="box-shadow: none; border:none;">
                          <img src="/img/guarantees/doc1.jpg" alt="" style="width:200px;"></a>
                      </li>
                      {{--<li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/guarant2.png" data-fancybox="guarantees"><img src="/img/guarantees/guarant2.png" alt=""></a>--}}
                      {{--</li>--}}
                    </ul>
                  </div>
                </div>
              </div>
              <div style="width:33%; min-width:350px; float:left; height:280px; text-align: center;">
                <h3 style="font-weight:bold; font-size:19px;">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Investment License' contenteditable="true">{{ __('Investment License') }}</editor_block>
                  @else
                    {{ __('Investment License') }}
                  @endif</h3>
                <div style="margin-top:30px;">
                  <div class="guarantees__list-wrap" style="width:100%;">
                    <ul class="guarantees__list" style="margin-left: 50px;">
                      <li class="guarantees__item">
                        <a class="guarantees__link" href="/img/guarantees/doc3.jpg" data-fancybox="guarantees" style="box-shadow: none; border:none;">
                          <img src="/img/guarantees/doc3.jpg" alt="" style="width:250px; background:none;"></a>
                      </li>
                      {{--<li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/guarant2.png" data-fancybox="guarantees"><img src="/img/guarantees/guarant2.png" alt=""></a>--}}
                      {{--</li>--}}
                    </ul>
                  </div>
                </div>
              </div>
              <div style="width:33%; min-width:350px; float:left; height:380px; text-align: right;">
                <h3 style="font-weight:bold; font-size:19px;text-align:right;">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='License to Do Business on the Internet' contenteditable="true">{{ __('License to Do Business on the Internet') }}</editor_block>
                  @else
                    {{ __('License to Do Business on the Internet') }}
                  @endif</h3>
                <div style="margin-top:30px;">
                  <div class="guarantees__list-wrap" style="width:100%; float:right;">
                    <ul class="guarantees__list" style="margin-left:60px;">
                      <li class="guarantees__item">
                        <a class="guarantees__link" href="/img/guarantees/doc2.jpg" data-fancybox="guarantees" style="box-shadow: none; border:none;">
                          <img src="/img/guarantees/doc2.jpg" alt="" style="width:200px;"></a>
                      </li>
                      {{--<li class="guarantees__item"><a class="guarantees__link" href="/img/guarantees/guarant2.png" data-fancybox="guarantees"><img src="/img/guarantees/guarant2.png" alt=""></a>--}}
                      {{--</li>--}}
                    </ul>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </table>
        <div style="clear:both;"></div>
        <div class="guarantees__bottom">
          <h4 class="guarantees__bottom-title">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Do you have any questions?' contenteditable="true">{{ __('Do you have any questions?') }}</editor_block>
            @else
              {{ __('Do you have any questions?') }}
            @endif
          </h4>
          <a class="btn btn--accent-line" href="{{ route('customer.contact') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Contact us' contenteditable="true">{{ __('Contact us') }}</editor_block>
            @else
              {{ __('Contact us') }}
            @endif</a>
        </div>
      </div>
    </section>
    <section class="referral">
      <div class="container">
        <div class="referral__image"><img src="/img/refferal.png" alt="">
        </div>
        <div class="referral__content">
          <h3 class="referral__title">
            <span>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='4 level' contenteditable="true">{{ __('4 level') }}</editor_block>
              @else
                {{ __('4 level') }}
              @endif</span> @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='referral program' contenteditable="true">{{ __('referral program') }}</editor_block>
            @else
              {{ __('referral program') }}
            @endif
          </h3>
          <div class="referral__desription">
            <p>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='We have developed a whole loyalty system for the leaders of our company. Grow your business on the promotion of Luminex, attracting new customers. You can expect generous rewards, a dedicated dashboard for attracted customers.' contenteditable="true">{{ __('We have developed a whole loyalty system for the leaders of our company. Grow your business on the promotion of Luminex, attracting new customers. You can expect generous rewards, a dedicated dashboard for attracted customers.') }}</editor_block>
              @else
                {{ __('We have developed a whole loyalty system for the leaders of our company. Grow your business on the promotion of Luminex, attracting new customers. You can expect generous rewards, a dedicated dashboard for attracted customers.') }}
              @endif</p>
          </div>
          <a class="btn btn--yellow-line" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.partners') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Find out more' contenteditable="true">{{ __('Find out more') }}</editor_block>
            @else
              {{ __('Find out more') }}
            @endif</a>
        </div>
      </div>
    </section>
    <section class="levels">
      <div class="container">
        <ul class="levels__list">
          <li class="levels__item">
            <div class="levels__icon js-tilt"><img src="/img/levels/level1.png" alt="">
            </div>
            <p class="levels__title">1<sup>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='st' contenteditable="true">{{ __('st') }}</editor_block>
                @else
                  {{ __('st') }}
                @endif</sup> @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='level' contenteditable="true">{{ __('level') }}</editor_block>
              @else
                {{ __('level') }}
              @endif
            </p>
            <!-- <p class="levels__description">хз, что тут писать
            </p> -->
          </li>
          <li class="levels__item">
            <div class="levels__icon js-tilt"><img src="/img/levels/level2.png" alt="">
            </div>
            <p class="levels__title">2<sup>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='nd' contenteditable="true">{{ __('nd') }}</editor_block>
                @else
                  {{ __('nd') }}
                @endif</sup> @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='level' contenteditable="true">{{ __('level') }}</editor_block>
              @else
                {{ __('level') }}
              @endif
            </p>
            <!-- <p class="levels__description">хз, что тут писать
            </p> -->
          </li>
          <li class="levels__item">
            <div class="levels__icon js-tilt"><img src="/img/levels/level3.png" alt="">
            </div>
            <p class="levels__title">3<sup>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='rd' contenteditable="true">{{ __('rd') }}</editor_block>
              @else
                  {{ __('rd') }}
              @endif</sup> @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='level' contenteditable="true">{{ __('level') }}</editor_block>
              @else
                {{ __('level') }}
              @endif
            </p>
            <!-- <p class="levels__description">хз, что тут писать
            </p> -->
          </li>
          <li class="levels__item">
            <div class="levels__icon js-tilt"><img src="/img/levels/level4.png" alt="">
            </div>
            <p class="levels__title">4<sup>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='th' contenteditable="true">{{ __('th') }}</editor_block>
              @else
                  {{ __('th') }}
              @endif</sup> @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='level' contenteditable="true">{{ __('level') }}</editor_block>
              @else
                {{ __('level') }}
              @endif
            </p>
            <!-- <p class="levels__description">хз, что тут писать
            </p> -->
          </li>
        </ul>
      </div>
    </section>
    {{--        <section class="representative">--}}
    {{--            <div class="container">--}}
    {{--                <div class="representative__content">--}}
    {{--                    <h3 class="representative__title"><span>{{ __('Representative') }}</span> {{ __('referral program') }}--}}
    {{--                    </h3>--}}
    {{--                    <ul class="levels-list">--}}
    {{--                        <li class="levels-list__item">--}}
    {{--                            <p class="levels-list__count">7<sup>%</sup>--}}
    {{--                            </p>--}}
    {{--                            <p class="levels-list__desc">1<sup>{{ __('st') }}</sup> {{ __('level') }}--}}
    {{--                            </p>--}}
    {{--                        </li>--}}
    {{--                        <li class="levels-list__item">--}}
    {{--                            <p class="levels-list__count">5<sup>%</sup>--}}
    {{--                            </p>--}}
    {{--                            <p class="levels-list__desc">2<sup>{{ __('nd') }}</sup> {{ __('level') }}--}}
    {{--                            </p>--}}
    {{--                        </li>--}}
    {{--                        <li class="levels-list__item">--}}
    {{--                            <p class="levels-list__count">3<sup>%</sup>--}}
    {{--                            </p>--}}
    {{--                            <p class="levels-list__desc">3<sup>{{ __('rd') }}</sup> {{ __('level') }}--}}
    {{--                            </p>--}}
    {{--                        </li>--}}
    {{--                        <li class="levels-list__item">--}}
    {{--                            <p class="levels-list__count">1<sup>%</sup>--}}
    {{--                            </p>--}}
    {{--                            <p class="levels-list__desc">4<sup>{{ __('th') }}</sup> {{ __('level') }}--}}
    {{--                            </p>--}}
    {{--                        </li>--}}
    {{--                        <li class="levels-list__item">--}}
    {{--                            <p class="levels-list__count">1<sup>%</sup>--}}
    {{--                            </p>--}}
    {{--                            <p class="levels-list__desc">5<sup>{{ __('th') }}</sup> {{ __('level') }}--}}
    {{--                            </p>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                    <div class="representative__description">--}}
    {{--                        <p>{{ __('We offer a special referral program for major partners of our company. You can become our official representative and use your own audience or advertising company to receive profit from us.') }}</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="representative__right"><img class="representative__image-main" src="/img/representative.png" alt="" role="presentation"/>--}}
    {{--                    <div class="representative__text">--}}
    {{--                        <!-- <p>хз, что тут писать</p> -->--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="representative__bottom"><a class="btn btn--yellow-line" href="{{ route('customer.partners') }}">{{ __('Find out more') }}</a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    <section class="partners">
      @include('layouts.partnerlist')
    </section>
    <section class="faq">
      <div class="container">
        <div class="faq__top">
          <h3 class="faq__subtitle">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Got questions?' contenteditable="true">{{ __('Got questions?') }}</editor_block>
            @else
              {{ __('Got questions?') }}
            @endif
          </h3>
          <h3 class="faq__title">
            <span>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='FAQ' contenteditable="true">{{ __('FAQ') }}</editor_block>
              @else
                {{ __('FAQ') }}
              @endif</span>
          </h3>
        </div>
        <div class="faq__content">
          <div class="faq-block accordion">
            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='What is Luminex?' contenteditable="true">{{ __('What is Luminex?') }}</editor_block>
              @else
                {{ __("What is Luminex?") }}
              @endif
            </h3>
            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities." contenteditable="true">{{ __("This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities.") }}</editor_block>
              @else
                {{ __("This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities.") }}
              @endif
            </div>
            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="What is Luminex Technology?" contenteditable="true">{{ __("What is Luminex Technology?") }}</editor_block>
              @else
                {{ __("What is Luminex Technology?") }}
              @endif
            </h3>
            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount." contenteditable="true">{{ __("Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount.") }}</editor_block>
              @else
                {{ __("Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount.") }}
              @endif
            </div>
            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="Is Luminex an officially registered company?" contenteditable="true">{{ __("Is Luminex an officially registered company?") }}</editor_block>
              @else
                {{ __("Is Luminex an officially registered company?") }}
              @endif
            </h3>
            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name="Our company is officially registered, and works legally. All documents are presented on the company's website. By starting your work with this service, you enter into an agreement with us." contenteditable="true">{{ __("Our company is officially registered, and works legally. All documents are presented on the company's website. By starting your work with this service, you enter into an agreement with us.") }}</editor_block>
              @else
                {{ __("Our company is officially registered, and works legally. All documents are presented on the company's website. By starting your work with this service, you enter into an agreement with us.") }}
              @endif
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
