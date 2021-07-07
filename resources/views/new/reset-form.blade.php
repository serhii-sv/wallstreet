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
            <form class="account-form"  method="POST" action="{{ route('password.email') }}">
              {{ csrf_field() }}
              <div style="color: red; align-content: center">@include('partials.inform')<br></div>
              <div class="form-group">
                <label for="sign-up">{{ __('E-Mail Address or login') }}</label>
                <input id="email" name="email" type="text" value="{{ old('email') }}" required autofocus />
              </div>
              
              <div class="form-group text-center">
                <button type="submit" class="mt-2 mb-2">{{ __('Send Password Reset Link') }}</button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <!--============= Sign In Section Ends Here =============-->
@endsection