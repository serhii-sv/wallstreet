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
            <h4 class="title mb-20">{{__('Log in')}}<span> {{__('to your account')}}</h4>
            <form class="account-form" action="{{ route('login') }}" method="POST">
              {{ csrf_field() }}
              <div style="color: red; align-content: center">@include('partials.inform')<br></div>
              <div class="form-group">
                <label for="sign-up">{{ __('E-Mail Address or login') }}</label>
                <input type="text" placeholder="Enter Your Email "  id="sign-up" name="login">
              </div>
              <div class="form-group">
                <label for="pass">{{ __('Password') }}</label>
                <input type="password" placeholder="Enter Your Password" id="pass" name="password">
                <span class="sign-in-recovery">Forgot your password? <a href="#0">recover password</a></span>
              </div>
     
              <div class="form-group text-center">
                <button type="submit" class="mt-2 mb-2">{{__('Log in')}}</button>
              </div>
            </form>
          </div>
          <div class="or">
            <span>OR</span>
          </div>
          <div class="account-header pb-0">
            <span class="d-block mb-30 mt-2">Sign up with your work email</span>
            <a href="#0" class="sign-in-with"><img src="{{ asset('images/icon/google.png') }}" alt="icon">
              <span>Sign Up with Google</span>
            </a>
            <span class="d-block mt-15">Don't have an account? <a href="">Sign Up Here</a></span>
          </div>
        </div>
      </div>
    </div>
    <!--============= Sign In Section Ends Here =============-->
@endsection