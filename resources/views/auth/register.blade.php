@extends('layouts.app')
@section('title', __('Registration'))
@section('content')
  
  <!--========== Preloader ==========-->
  @include('layouts.app-preloader')
  <!--========== Preloader ==========-->
  
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
        <div class="account-header">
          <h4 class="title">Let's get started</h4>
          <a href="#0" class="sign-in-with"><img src="{{ asset('images/icon/google.png') }}" alt="icon">
            <span>Sign Up with Google</span>
          </a>
        </div>
        <div class="or">
          <span>OR</span>
        </div>
        <div class="account-body">
          <span class="d-block mb-20">{{ __('Registration') }}</span>
          <form class="account-form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="form__title">
                <span>{{ __('Name') }} *</span>
              </label>
              <input id="name" type="text" name="name"
                  value="{{ old('name') }}" required autofocus>
              @if ($errors->has('name'))
                <span class="help-block">
                                    <span class="alert">{{ $errors->first('name') }}</span>
                                </span>
              @endif
            </div>
            
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="form__title">
                <span>{{ __('E-Mail Address') }} *</span>
              </label>
              
              <input id="email" type="email" name="email"
                  value="{{ old('email') }}" required>
              
              @if ($errors->has('email'))
                <span class="help-block">
                                    <span class="alert">{{ $errors->first('email') }}</span>
                                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
              <label for="login" class="form__title">
                <span>{{ __('Login name') }}</span>
              </label>
              
              <input id="login" type="text" name="login"
                  value="{{ old('login') }}">
              
              @if ($errors->has('login'))
                <span class="help-block">
                                    <span class="alert">{{ $errors->first('login') }}</span>
                                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="phone" class="form__title">
                <span>{{ __('Phone number') }}</span>
              </label>
              
              <input id="phone" type="text" name="phone"
                  value="{{ old('phone') }}">
              
              @if ($errors->has('phone'))
                <span class="help-block">
                                    <span class="alert">{{ $errors->first('phone') }}</span>
                                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('partner_id') ? ' has-error' : '' }}">
              <label for="partner_id" class="form__title">
                <span>{{ __('Partner ID') }}:</span>
              </label>
              <input id="partner_id" type="text"
                  value="{{ !empty(getPartnerInfoFromCookies()) ? getPartnerInfoFromCookies()['login'].' ('.getPartnerInfoFromCookies()['email'].')' : '' }}"
                  disabled>
            
            </div>
            
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="form__title">
                <span>{{ __('Password') }} *</span>
              </label>
              <input id="password" type="password" name="password" required>
            
            </div>
            
            <div class="form-group">
              <label for="password-confirm"
                  class="form__title">
                <span>{{ __('Confirm Password') }} *</span>
              </label>
              <input id="password-confirm" type="password"
                  name="password_confirmation" required>
              @if ($errors->has('password'))
                <span class="help-block">
                                    <span class="alert">{{ $errors->first('password') }}</span>
                                </span>
              @endif
            </div>
            
            {{--            <div class="form-group">--}}
            {{--              <label for="sign-up">Your Email </label>--}}
            {{--              <input type="text" placeholder="Enter Your Email " id="sign-up">--}}
            {{--            </div>--}}
            <div class="form-group " style="margin-left:15px; margin-top: 15px">
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
            
            <div class="form-group text-center">
              <button type="submit">Try It Now</button>
              <span class="d-block mt-15">Already have an account? <a href="">Sign In</a></span>
            </div>
          </form>
        </div>
      </div>
      <div class="sponsor-slider-wrapper cl-white text-center mt-40">
        <h5 class="slider-heading mb-3">Used by over 1,000,000 people worldwide</h5>
        <div class="sponsor-slider-4 owl-theme owl-carousel">
        <!--          <div class="sponsor-thumb">
            <img src="{{ asset('images/sponsor/sponsor1.png') }}" alt="sponsor">
          </div>
          <div class="sponsor-thumb">
            <img src="{{ asset('images/sponsor/sponsor2.png') }}" alt="sponsor">
          </div>
          <div class="sponsor-thumb">
            <img src="{{ asset('images/sponsor/sponsor3.png') }}" alt="sponsor">
          </div>
          <div class="sponsor-thumb">
            <img src="{{ asset('images/sponsor/sponsor4.png') }}" alt="sponsor">
          </div>
          <div class="sponsor-thumb">
            <img src="{{ asset('images/sponsor/sponsor5.png') }}" alt="sponsor">
          </div>
          <div class="sponsor-thumb">
            <img src="{{ asset('images/sponsor/sponsor6.png') }}" alt="sponsor">
          </div>
          <div class="sponsor-thumb">
            <img src="{{ asset('images/sponsor/sponsor7.png') }}" alt="sponsor">
          </div>-->
        </div>
      </div>
    </div>
  </div>
  <!--============= Sign In Section Ends Here =============-->

@endsection