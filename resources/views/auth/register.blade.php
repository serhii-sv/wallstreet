@extends('layouts.form')
@section('title', __('Registration'))
@section('content')
  
  <body>
    <div class="regiser-page">
      <div class="form">
        <a href="{{ route('customer.main') }}" class="modal-window__close" title="{{ __('Back') }}"></a>
        <div class="col-lg-4"></div>
        <div class="col-md-8">
          <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <h4 class="form__title form__title--line">
              <span>{{ __('Registration') }}</span>
            </h4>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="form__title">
                <span>{{ __('Name') }} *</span>
              </label>
              
              <div class="col-md-6">
                <input id="name" type="text" name="name"
                    value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                  <span class="help-block">
                                    <span class="alert">{{ $errors->first('name') }}</span>
                                </span>
                @endif
              </div>
            </div>
            
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="form__title">
                <span>{{ __('E-Mail Address') }} *</span>
              </label>
              
              <div class="col-md-6">
                <input id="email" type="email" name="email"
                    value="{{ old('email') }}" required>
                
                @if ($errors->has('email'))
                  <span class="help-block">
                                    <span class="alert">{{ $errors->first('email') }}</span>
                                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
              <label for="login" class="form__title">
                <span>{{ __('Login name') }}</span>
              </label>
              
              <div class="col-md-6">
                <input id="login" type="text" name="login"
                    value="{{ old('login') }}">
                
                @if ($errors->has('login'))
                  <span class="help-block">
                                    <span class="alert">{{ $errors->first('login') }}</span>
                                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="phone" class="form__title">
                <span>{{ __('Phone number') }}</span>
              </label>
              
              <div class="col-md-6">
                <input id="phone" type="text" name="phone"
                    value="{{ old('phone') }}">
                
                @if ($errors->has('phone'))
                  <span class="help-block">
                                    <span class="alert">{{ $errors->first('phone') }}</span>
                                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('partner_id') ? ' has-error' : '' }}">
              <label for="partner_id" class="form__title">
                <span>{{ __('Partner ID') }}:</span>
              </label>
              <div class="col-md-6">
                <input id="partner_id" type="text"
                    value="{{ !empty(getPartnerInfoFromCookies()) ? getPartnerInfoFromCookies()['login'].' ('.getPartnerInfoFromCookies()['email'].')' : '' }}"
                    disabled>
              </div>
            </div>
            
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="form__title">
                <span>{{ __('Password') }} *</span>
              </label>
              
              <div class="col-md-6">
                <input id="password" type="password" name="password" required>
              </div>
            </div>
            
            <div class="form-group">
              <label for="password-confirm"
                  class="form__title">
                <span>{{ __('Confirm Password') }} *</span>
              </label>
              
              <div class="col-md-6">
                <input id="password-confirm" type="password"
                    name="password_confirmation" required>
              </div>
              @if ($errors->has('password'))
                <span class="help-block">
                                    <span class="alert">{{ $errors->first('password') }}</span>
                                </span>
              @endif
            </div>
            
            <div class="form-group" style="margin-left:15px; margin-top: 15px">
              <input type="checkbox" id="agreement" name="agreement" value="1" checked>
              <label for="agreement" style="margin-left:10px; margin-top: 15px">{{ __('I agree with') }}
                <a
                    href="/agreement">{{ __('User agreement') }}</a>
                *</label>
              
              @if ($errors->has('agreement'))
                <div class="row">
                            <span class="help-block">
                                <span class="alert">{{ $errors->first('agreement') }}</span>
                            </span>
                </div>
              @endif
            </div>
            
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Registration') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>

@endsection
