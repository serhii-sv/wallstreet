@extends('layouts.form')
@section('title', __('Login'))
@section('content')

<body>
<div class="login-page">
    <div class="form">
        <a href="{{ route('customer.main') }}" class="modal-window__close" title="{{ __('Back') }}"></a>
    <form class="register-form" action="{{ route('login') }}" method="POST">
        {{ csrf_field() }}
        <h4 class="form__title form__title--line">{{__('Log in')}}<span> {{__('to your account')}}</span></h4>
        <div style="color: red; align-content: center">@include('partials.inform')<br></div>
        <div class="input-row">
            <div class="input-row">
                <label class="form__title"><span>{{ __('E-Mail Address or login') }}</span>
                </label><input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus />
            </div>
        </div>
        <div class="input-row">
            <label class="form__title"><span>{{ __('Password') }}</span>
            </label><input id="password" name="password" type="password" required />
        </div>
        <div>
            <label class="form__title"><input id="remember" type="checkbox" style="display: inline-block"/><span>{{ __('Remember Me') }}</span></label>
        </div>
        <div class="form__bottom">
            <button class="btn btn btn--accent-line" type="submit" value="Submit">{{__('Log in')}}</button>
        </div>
        <div class="form__bottom-links">
            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
        <div class="form__bottom">
            @if(loginCaptchaCanBeShown())
                <div class="form-group">
                    <div class="col-lg-4">
                        <input type="text" name="captcha" id="captcha" style="width: 50%;">
                    </div>
                    <label class="col-md-4 control-label"
                           for="captcha">{{ __('Enter captcha code') }}</label>
                    <div class="col-lg-4">
                        <?= captcha_img() ?>
                    </div>
                </div>
            @endif
        </div>
    </form>
    </div>
</div>
</body>

@endsection
