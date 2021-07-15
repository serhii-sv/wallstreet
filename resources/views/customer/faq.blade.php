@extends('layouts.customer')
@section('title', __('FAQ'))
@section('content')
    <main role="main" style="background: white">
        <div class="page">
            <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
                <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
            </svg>
            @include('partials.breadcrumbs')
            <div class="container">
                <h2 class="page-title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='We have the answers to your questions' contenteditable="true">{{ __('We have the answers to your questions') }}</editor_block>
                  @else
                    {{ __('We have the answers to your questions') }}
                  @endif<span>FAQ</span>
                </h2>
            </div>
            <section class="faq faq--offPadding">
                <div class="container">
                    <div class="faq__content">
                        <div class="faq-block accordion">
                            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='What is Luminex?' contenteditable="true">{{ __('What is Luminex?') }}</editor_block>
                              @else
                                {{ __("What is Luminex?") }}
                              @endif
                            </h3>
                            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities.' contenteditable="true">{{ __('This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities.') }}</editor_block>
                              @else
                                {{ __("This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities.") }}
                              @endif
                            </div>
                            <h3 class="faq-block__title">
                              @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='What is Luminex Technology?' contenteditable="true">{{ __('What is Luminex Technology?') }}</editor_block>
                              @else
                                {{ __("What is Luminex Technology?") }}
                              @endif
                            </h3>
                            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount.' contenteditable="true">{{ __('Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount.') }}</editor_block>
                              @else
                                {{ __("Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount.") }}
                              @endif
                            </div>
                            <h3 class="faq-block__title">
                              @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Is Luminex an officially registered company?' contenteditable="true">{{ __('Is Luminex an officially registered company?') }}</editor_block>
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
                            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Can I lose my money or get no profits?' contenteditable="true">{{ __('Can I lose my money or get no profits?') }}</editor_block>
                              @else
                                {{ __("Can I lose my money or get no profits?") }}
                              @endif
                            </h3>
                            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Of course not. Our project is not a win-win lottery. In the real business world, there is always a certain risk involved, but the point is that this risk is not only justified, but reduced to None for our investors. The company undertakes all the risks. Payouts are made exactly according to the presented investment plans.' contenteditable="true">{{ __('Of course not. Our project is not a win-win lottery. In the real business world, there is always a certain risk involved, but the point is that this risk is not only justified, but reduced to None for our investors. The company undertakes all the risks. Payouts are made exactly according to the presented investment plans.') }}</editor_block>
                              @else
                                {{ __("Of course not. Our project is not a win-win lottery. In the real business world, there is always a certain risk involved, but the point is that this risk is not only justified, but reduced to None for our investors. The company undertakes all the risks. Payouts are made exactly according to the presented investment plans.") }}
                              @endif
                            </div>
                            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='How do I replenish the account?' contenteditable="true">{{ __('How do I replenish the account?') }}</editor_block>
                              @else
                                {{ __("How do I replenish the account?") }}
                              @endif
                            </h3>
                            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='You can do it via your personal account using the following payment systems: Bitcoin, Etherium, Perfect Money, Payeer.' contenteditable="true">{{ __('You can do it via your personal account using the following payment systems: Bitcoin, Etherium, Perfect Money, Payeer.') }}</editor_block>
                              @else
                                {{ __("You can do it via your personal account using the following payment systems: Bitcoin, Etherium, Perfect Money, Payeer.") }}
                              @endif
                            </div>
                            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Am I allowed to open several deposits?' contenteditable="true">{{ __('Am I allowed to open several deposits?') }}</editor_block>
                              @else
                                {{ __("Am I allowed to open several deposits?") }}
                              @endif
                            </h3>
                            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Yes, you are. When adding funds to your deposit, the amount in your account will automatically be updated. If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.2%.' contenteditable="true">{{ __('Yes, you are. When adding funds to your deposit, the amount in your account will automatically be updated. If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.2%.') }}</editor_block>
                              @else
                                {{ __("Yes, you are. When adding funds to your deposit, the amount in your account will automatically be updated. If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.2%.") }}
                              @endif
                            </div>
                            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name="I couldn't find an answer to my question" contenteditable="true">{{ __("I couldn't find an answer to my question") }}</editor_block>
                              @else
                                {{ __("I couldn't find an answer to my question") }}
                              @endif
                            </h3>
                            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='If you did not find the answer, please contact our support team. Use the contact information provided on our website.' contenteditable="true">{{ __('If you did not find the answer, please contact our support team. Use the contact information provided on our website.') }}</editor_block>
                              @else
                                {{ __("If you did not find the answer, please contact our support team. Use the contact information provided on our website.") }}
                              @endif
                            </div>

                            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='HOW CAN I MAKE A DEPOSIT' contenteditable="true">{{ __('HOW CAN I MAKE A DEPOSIT') }}</editor_block>
                              @else
                                {{ __("HOW CAN I MAKE A DEPOSIT") }}
                              @endif
                            </h3>
                            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='If you want to make a deposit you need to click  the \"Balance\" and select the currency to funds the Balance, after Money available at Balance. Next click the "Deposit", enter the amount available at Balance.While depositing funds in USD the site of the payment system will be opened and you will need to make a payment. If you want to make a deposit in crypto currency the wallet will be generated for making a deposit in crypto currency.Please note that deposits in the crypto currency are credited after 3 confirmations in the network. We can’t influence the speed of confirmation. For each new deposit you need to generate a new wallet.' contenteditable="true">{{ __('If you want to make a deposit you need to click  the \"Balance\" and select the currency to funds the Balance, after Money available at Balance. Next click the "Deposit", enter the amount available at Balance.While depositing funds in USD the site of the payment system will be opened and you will need to make a payment. If you want to make a deposit in crypto currency the wallet will be generated for making a deposit in crypto currency.Please note that deposits in the crypto currency are credited after 3 confirmations in the network. We can’t influence the speed of confirmation. For each new deposit you need to generate a new wallet.') }}</editor_block>
                              @else
                                {{ __('If you want to make a deposit you need to click  the \"Balance\" and select the currency to funds the Balance, after Money available at Balance. Next click the "Deposit", enter the amount available at Balance.While depositing funds in USD the site of the payment system will be opened and you will need to make a payment. If you want to make a deposit in crypto currency the wallet will be generated for making a deposit in crypto currency.Please note that deposits in the crypto currency are credited after 3 confirmations in the network. We can’t influence the speed of confirmation. For each new deposit you need to generate a new wallet.') }}
                              @endif
                            </div>

                            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='AFTER I MAKE A WITHDRAWAL REQUEST, WHEN WILL THE FUNDS BE AVAILABLE ON MY WALLET?' contenteditable="true">{{ __('AFTER I MAKE A WITHDRAWAL REQUEST, WHEN WILL THE FUNDS BE AVAILABLE ON MY WALLET?') }}</editor_block>
                              @else
                                {{ __("AFTER I MAKE A WITHDRAWAL REQUEST, WHEN WILL THE FUNDS BE AVAILABLE ON MY WALLET?") }}
                              @endif
                            </h3>
                            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='As a rule, we are trying to process withdrawals as fast as possible. Your funds will be available in a few hours. Maximum processing time is 24 hours.' contenteditable="true">{{ __('As a rule, we are trying to process withdrawals as fast as possible. Your funds will be available in a few hours. Maximum processing time is 24 hours.') }}</editor_block>
                              @else
                                {{ __("As a rule, we are trying to process withdrawals as fast as possible. Your funds will be available in a few hours. Maximum processing time is 24 hours.") }}
                              @endif
                            </div>

                            <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='BE ONE OF OUR REPRESENTATIVES' contenteditable="true">{{ __('BE ONE OF OUR REPRESENTATIVES') }}</editor_block>
                              @else
                                {{ __("BE ONE OF OUR REPRESENTATIVES") }}
                              @endif
                            </h3>
                            <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='You can become an official representative and awarded with a higher reward, get in touch with support center 24 hours a day, attract more investors from your region by being listed in our partners page and many more advantages which can be discussed individually with administrative department. Your active deposit amount should be not less than $500, you will receive representative status and  5 levels rewards will be added to your standard referral fee.' contenteditable="true">{{ __('You can become an official representative and awarded with a higher reward, get in touch with support center 24 hours a day, attract more investors from your region by being listed in our partners page and many more advantages which can be discussed individually with administrative department. Your active deposit amount should be not less than $500, you will receive representative status and  5 levels rewards will be added to your standard referral fee.') }}</editor_block>
                              @else
                                {{ __("You can become an official representative and awarded with a higher reward, get in touch with support center 24 hours a day, attract more investors from your region by being listed in our partners page and many more advantages which can be discussed individually with administrative department. Your active deposit amount should be not less than $500, you will receive representative status and  5 levels rewards will be added to your standard referral fee.") }}
                              @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{--<section class="questions-form">--}}
                {{--<svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">--}}
                    {{--<path d="m 975,65.242324 h 975 V 35.889669 6.53701 L 1928.75,5.88359 1907.5,5.23016 1862,4.21053 1816.5,3.19089 1766,2.14419 1715.5,1.09749 1519.5,0.54874 1323.5,0 l -85,1.14503 -85,1.14503 -46.5,0.96431 -46.5,0.96431 -41,1.0362 -41,1.0362 -49.5,1.48571 -49.5,1.48571 -42,1.50324 -42,1.50325 -48.5,1.99247 -48.5,1.99247 -43,2.013562 -43,2.013565 -38.5,2.004288 -38.5,2.004288 -43.5,2.486247 -43.5,2.486246 -47.5,3.01284 -47.5,3.01284 -36,2.496047 -36,2.496046 -13,0.97181 -13,0.97181 -40,3.03931 -40,3.039311 -48,3.987707 -48,3.987708 -38.4368,3.482384 -38.4368,3.482385 H 1.3132 0 v 1 1 z"></path>--}}
                {{--</svg>--}}
                {{--<div class="container">--}}
                    {{--<h3 class="page-title">{{ __('Do you have any questions?') }}--}}
                    {{--</h3>--}}
                    {{--<div class="form">--}}
                        {{--<form>--}}
                            {{--<h4 class="form__title">{{ __('Ask your question') }}--}}
                            {{--</h4>--}}
                            {{--<div class="input-row">--}}
                                {{--<label class="input-row__label">{{ __('Name') }}--}}
                                {{--</label><input class="input-row__input" type="text"/>--}}
                            {{--</div>--}}
                            {{--<div class="input-row">--}}
                                {{--<label class="input-row__label">{{ __('Phone') }}--}}
                                {{--</label><input class="input-row__input" type="text"/>--}}
                            {{--</div>--}}
                            {{--<div class="input-row">--}}
                                {{--<label class="input-row__label">E-mail--}}
                                {{--</label><input class="input-row__input" type="text"/>--}}
                            {{--</div>--}}
                            {{--<div class="input-row">--}}
                                {{--<label class="input-row__label">{{ __('Question') }}--}}
                                {{--</label><textarea class="input-row__textarea"></textarea>--}}
                            {{--</div>--}}
                            {{--<div class="form__bottom"><a class="btn btn btn--accent-line" href="#">{{ __('Ask us') }}</a>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</section>--}}
        </div>
    </main>

<script>document.getElementById("faqPageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection
