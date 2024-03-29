{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','User Lock Screen')

{{-- page style --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/lock.css')}}">
  <style>
      #myVideo {
          position: fixed;
          right: 0;
          bottom: 0;
          min-width: 100%;
          min-height: 100%;
      }

      .forgot-card {
          z-index: 1;
      }
  </style>
@endsection

{{-- page content --}}
@section('content')
    <video autoplay muted id="myVideo">
        <source src="{{ asset('intro.mp4') }}" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>
  <div id="lock-screen" class="row">
    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 forgot-card bg-opacity-8">
      <div class="mt-3">
        @include('panels.inform')
      </div>
      <form class="login-form" method="post" action="{{ route('user.unlock') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id ?? '' }}">
        <div class="row">
          <div class="input-field col s12 center-align mt-10">
            <img class="z-depth-4 circle responsive-img" width="100" src="{{asset('images/avatar/user.svg')}}" alt="">
            <h5>{{ Auth::user()->login ?? "Пользователь" }}</h5>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix pt-2">lock_outline</i>
            <input id="password" type="password" name="password">
            <label for="password">Password</label>

          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Войти</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
