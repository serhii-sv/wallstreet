{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','User Login')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/login.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="login-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">

    <form class="login-form" method="POST" action="{{ route('login') }}">
      @error('g-recaptcha-response')
      <small class="red-text ml-7" >
        {{ $message }}
      </small>
      @enderror
      @csrf
      <input type="hidden" name="g-recaptcha-response" id="recaptcha">
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Авторизация</h5>
        </div>
      </div>
      <div class="row margin">
        <div class="mb-3">@include('panels.inform')</div>
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="email" type="text" class=" @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}"  autocomplete="email" autofocus>
          <label for="email" class="center-align">Email</label>
          @error('email')
          <small class="red-text ml-7" >
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password"  autocomplete="current-password">
          <label for="password">Пароль</label>
          @error('password')
          <small class="red-text ml-7" >
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12 ml-2 mt-1">
          <p>
            <label>
              <input type="checkbox" name="remember" id="remember" checked="checked">
              <span>Запомнить меня</span>
            </label>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
            Войти
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@section('page-script')
  <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptchav3.sitekey') }}"></script>
  <script>
    grecaptcha.ready(function() {
      grecaptcha.execute('{{ config('recaptchav3.sitekey') }}', {action: 'login'}).then(function(token) {
        if (token) {
          document.getElementById('recaptcha').value = token;
        }
      });
    });
  </script>
@endsection
