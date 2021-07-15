@extends('layouts.customer')
@section('title', __('Contacts'))
@section('content')
    <main role="main" style="background: white">
        <div class="page">
            <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
                <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
            </svg>
            @include('partials.breadcrumbs')
            <div class="container">
                <h2 class="page-title page-title--line">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='We are always glad to see you' contenteditable="true">{{ __('We are always glad to see you') }}</editor_block>
                  @else
                    {{ __('We are always glad to see you') }}
                  @endif <span>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Write to us' contenteditable="true">{{ __('Write to us') }}</editor_block>
                    @else
                      {{ __('Write to us') }}
                    @endif</span>
                </h2>
            </div>
            <section class="map">
                <div class="container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3057.267277897746!2d116.36390971546201!3d39.980131990000096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35f0547c077c114d%3A0xc5a587b872450a4a!2sSyncept%20Business%20Center!5e0!3m2!1sid!2sid!4v1624950034869!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </section>
            <div class="text-and-form">
                <div class="container">
                    <div class="text-and-form__content">
                        <div class="text">
                            <p><strong>@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Data protection and client privacy are important to us.' contenteditable="true">{{ __('Data protection and client privacy are important to us.') }}</editor_block>
                                @else
                                  {{ __("Data protection and client privacy are important to us.") }}
                                @endif</strong></p>
                            <p>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='All personal user data being transferred to the company is stored strictly in absolute confidentiality and protected by the Law on the protection of personal data. Without any exception, all data provided to the company can be used exclusively for the purpose of optimizing the investment process within the Luminex project, as well as to improve the quality of services provided.' contenteditable="true">{{ __('All personal user data being transferred to the company is stored strictly in absolute confidentiality and protected by the Law on the protection of personal data. Without any exception, all data provided to the company can be used exclusively for the purpose of optimizing the investment process within the Luminex project, as well as to improve the quality of services provided.') }}</editor_block>
                              @else
                                {{ __("All personal user data being transferred to the company is stored strictly in absolute confidentiality and protected by the Law on the protection of personal data. Without any exception, all data provided to the company can be used exclusively for the purpose of optimizing the investment process within the Luminex project, as well as to improve the quality of services provided.") }}
                              @endif</p>
                            <p>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Reliable protection of service data from distributed denial of service attacks is ensured by the industry standard encryption solutions.' contenteditable="true">{{ __('Reliable protection of service data from distributed denial of service attacks is ensured by the industry standard encryption solutions.') }}</editor_block>
                              @else
                                {{ __("Reliable protection of service data from distributed denial of service attacks is ensured by the industry standard encryption solutions.") }}
                              @endif</p>
                        </div>
                    </div>
                    <div class="text-and-form__right">
                        <div class="form">
                            <form method="POST" target="_top" action="{{ route('customer.support') }}">
                                {{ csrf_field() }}

                                <h4 class="form__title">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Contact us' contenteditable="true">{{ __('Contact us') }}</editor_block>
                                  @else
                                    {{ __('Contact us') }}
                                  @endif
                                </h4>
                                <div class="input-row">
                                    @include('partials.inform')
                                </div>
                                <div class="input-row">
                                    <label class="input-row__label">E-mail
                                    </label><input class="input-row__input" type="email" name="email"/>
                                </div>
                                <div class="input-row">
                                    <label class="input-row__label">@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Question' contenteditable="true">{{ __('Question') }}</editor_block>
                                      @else
                                        {{ __('Question') }}
                                      @endif
                                    </label><textarea class="input-row__textarea" name="text"></textarea>
                                </div>
                                <div class="input-row">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <?= captcha_img() ?>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" name="captcha" class="form-control" placeholder="Captcha">
                                        </div>
                                    </div>
                                </div>
                                <div class="form__bottom">
                                  @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block class="btn btn superFormButton" data-name='Registration' contenteditable="true">{{ __('Contact us') }}</editor_block>
                                  @else
                                    <input type="submit" value="{{ __('Contact us') }}" class="btn btn superFormButton">
                                  @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script>document.getElementById("contactPageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection
