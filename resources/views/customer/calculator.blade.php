@extends('layouts.customer')
@section('title', __('Calculator'))
@section('content')
    <main role="main" style="background: white">
        <div class="page">
            <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
                <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
            </svg>
            @include('partials.breadcrumbs')
            <div class="container">
                <h2 class="page-title page-title--line">{{ __('Let the money work for you') }} <span>{{ __('and not vice versa') }}</span>
                </h2>
                <div class="text">
                    <p><strong>{{ __("It’s certainly nice to be an expert and be in the position of an employee in a company. You get engaged in a business in which you have a certain expertise, receive regular wages and have good conditions, provided that you have chosen the right working place for yourself. Being the boss is much more difficult - you don’t have a stable schedule. You have to get up even at three o’clock in the morning and come to the office in case something goes wrong. You don’t have a stable salary, and you may not have it at all, because you have to pay your employees every month, and if the company experiences losses, you have to pay out of your own pocket.") }}</strong></p>
                    <p>{{ __("At this point you need to understand that whatever position you are in - you always need to competently manage your funds. If you waste your entire salary thoughtlessly, living for today, or stack your money under your pillow, you risk living a life in poverty. Invest your money with us and get passive monthly income.") }}</p>
                </div>
            </div>

            <div class="calculate-button container"><a class="btn btn btn--yellow-line-big" href="{{ route('register') }}">{{ __('Start earning!') }}</a>
            </div>
            <section class="image-text-calculate">
                <div class="container">
                    <div class="image-text-calculate__image"><img src="/img/calculate.png" alt="">
                    </div>
                    <div class="image-text-calculate__content">
                        <div class="text">
                            <p>{{ __("If the earned money were always proportional to the efforts of a person, then everyone would be millionaires. Or maybe everyone would be poor. After all, tiring and exhausting everyday work doesn’t always turn into millions of dollars. Why? Elaborated actions, certain levers that drive the mechanism of generating money into action are important. Businessmen and investors know this. That is why these people, who take on a lot of responsibility and risks, possess millions without putting enormous efforts into this. A real businessman is committed to automating the work of his company, so that he can enjoy those precious moments of life that he has been granted, getting back to the process control from time to time, just in order to make a number of decisions that will raise his company (or companies) to the next level.") }}</p>
                            <p>{{ __("An investor is a person who, first of all, appreciates his main resource. Time is a non-renewable resource, and an investor understands this, and therefore takes on the risks of investing in the development of a project or business. With Luminex, you can become an investor without risking losing your funds. We are an operating company, and our technology is the most demanded product in the cryptocurrency market.") }}</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

<script>document.getElementById("calculatorPageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection
