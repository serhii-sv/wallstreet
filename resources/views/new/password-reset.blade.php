@extends('layouts.app')
@section('title', __('Login'))
@section('content')
  
  <div class="main--body">
  
  @include('layouts.app-preloader')
  
  {{--    <div class="preloader">--}}
  {{--      <div class="preloader-inner">--}}
  {{--        <div class="preloader-icon">--}}
  {{--          <span></span>--}}
  {{--          <span></span>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  
  <!--============= Sign In Section Starts Here =============-->
    <div class="account-section bg_img" data-background="{{ asset('images/account-bg.jpg') }}">
      <div class="container">
        <div class="account-title text-center">
          <a href="" class="back-home"><i class="fas fa-angle-left"></i>
            <span>Back <span class="d-none d-sm-inline-block">To Hyipland</span></span>
          </a>
          <a href="#0" class="logo">
            <img src="{{ asset('images/logo/footer-logo.png') }}" alt="logo">
          </a>
        </div>
        <div class="account-wrapper">
          <div class="account-body">
            <h4 class="title mb-20">Reset <span>password</span></h4>
            <form class="account-form" method="POST" action="{{ route('password.request') }}">
              {{ csrf_field() }}
              <input type="hidden" name="token" value="{{ $token }}">
              
              <div style="color: red; align-content: center">@include('partials.inform')<br></div>
              
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email"
                    class="col-md-8 control-label">{{ __('E-Mail Address') }}</label>
    
                  <input id="email" type="email" class="form-control" name="email"
                      value="{{ $email or old('email') }}" required autofocus>
      
                  @if ($errors->has('email'))
                    <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                  @endif
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password"
                    class="col-md-8 control-label">{{ __('Password') }}</label>
    
                  <input id="password" type="password" class="form-control" name="password"
                      required>
      
                  @if ($errors->has('password'))
                    <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                  @endif
              </div>
  
              <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm"
                    class="col-md-8 control-label">{{ __('Confirm Password') }}</label>
                  <input id="password-confirm" type="password" class="form-control"
                      name="password_confirmation" required>
      
                  @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                  @endif
              </div>
              
              
              <div class="form-group text-center">
                <button type="submit" class="mt-2 mb-2">{{ __('Reset Password') }}</button>
              </div>
            </form>
          </div>
        
        </div>
      </div>
    </div>
    <!--============= Sign In Section Ends Here =============-->
@endsection