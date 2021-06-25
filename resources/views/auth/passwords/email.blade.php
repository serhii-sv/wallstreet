@extends('layouts.form')
@section('title', __('Reset password'))
@section('content')

<body>
<div class="login-page">
    <div class="form">
        <a href="{{ route('customer.main') }}" class="modal-window__close" title="{{ __('Back') }}"></a>
        <form class="register-form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}
            <h4 class="form__title form__title--line">Reset<span>password</span></h4>
            <div style="color: red; align-content: center">@include('partials.inform')<br></div>
            <div class="input-row">
                <div class="input-row">
                    <label class="form__title"><span>{{ __('email') }}</span>
                    </label><input id="email" name="email" type="text" value="{{ old('email') }}" required autofocus />
                </div>
            </div>
            <div class="form__bottom">
                <button class="btn btn btn--accent-line" type="submit" value="Submit">{{ __('Send Password Reset Link') }}</button>
            </div>
        </form>
    </div>
</div>
</body>
@endsection
