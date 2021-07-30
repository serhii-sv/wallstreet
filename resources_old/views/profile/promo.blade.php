@extends('layouts.app')
@section('title', __('Promo'))
@section('content')
  
  
  <div class="main--body dashboard-bg">
    <!--========== Preloader ==========-->
  @include('layouts.app-preloader')
  <!--========== Preloader ==========-->
    
    
    <!--=======SideHeader-Section Starts Here=======-->
    <div class="notify-overlay"></div>
    <section class="dashboard-section">
      @include('profile.layouts.header')
      <div class="dasboard-body">
        <div class="dashboard-hero">
          @include('profile.layouts.header-top')
          <div class="dashboard-hero-content text-white">
            <h3 class="title">{{ __('Promo') }}</h3>
            <ul class="breadcrumb">
              <li>
                <a href="{{ route('profile.profile') }}">{{ __('Dashboard') }}</a>
              </li>
              <li>
                <a href="{{ route('profile.affiliate') }}">{{ __('Partners') }}</a>
              </li>
              <li>
                {{ __('Promo') }}
              </li>
            </ul>
          </div>
        </div>
        <div class="container-fluid">
          @include('profile.components.balance-block')
          
          <div class="partners">
            <h3 class="main-title">Promotional Materials</h3>
            <div class="promo-item">
              <div class="thumb">
                <img src="{{ asset('img/banners/banner125.gif') }}" alt="dashboard-promotional">
              </div>
              <div class="promo-link">
                <a href="#0">Demo Link Here</a>
              </div>
            </div>
            <div class="promo-item">
              <div class="thumb">
                <img src="{{ asset('img/banners/banner468.gif') }}" alt="dashboard-promotional">
              </div>
              <div class="promo-link">
                <a href="#0">Demo Link Here</a>
              </div>
            </div>
            <div class="promo-item">
              <div class="thumb">
                <img src="{{ asset('img/banners/banner768.gif') }}" alt="dashboard-promotional">
              </div>
              <div class="promo-link">
                <a href="#0">Demo Link Here</a>
              </div>
            </div>
          </div>
        </div>
        @include('profile.layouts.footer')
      </div>
    </section>
    <!--=======SideHeader-Section Ends Here=======-->
  </div>
  
  

@endsection
