@extends('layouts.app')
@section('title', __('Withdraw'))
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
            <h3 class="title">{{ __('Withdraw') }}</h3>
            <ul class="breadcrumb">
              <li>
                <a href="{{ route('profile.profile') }}">{{ __('Dashboard') }}</a>
              </li>
              <li>
                {{ __('Withdraw') }}
              </li>
            </ul>
          </div>
        </div>
        <div class="container-fluid">
          @include('profile.components.balance-block')
          
          <div class="deposit">
            <h3 class="main-title">Transfer Funds</h3>
            <div class="available-balance">
              <h5 class="title">Available Balance</h5>
              <div class="amount">
                <sup>$</sup>
                185.00
              </div>
            </div>
            <div class="deposit-system pt-0">
              <h4 class="main-subtitle">01. Choose Payment System</h4>
              @include('profile.components.choose-payment')
            </div>
            <div class="deposit-system">
              <h4 class="main-subtitle">02.Enter the amount of Transfer:</h4>
              <form class="make-deposit">
                <div class="form-group">
                  <input type="text" placeholder="$180.00" class="make-amount">
                </div>
                <div class="form-group">
                  <label for="total-profit">Will be Displayed</label>
                  <input type="text" readonly value="$180.00" class="readonly">
                </div>
                <div class="form-group">
                  <button type="submit" class="custom-button border-0">Transfer Funds</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @include('profile.layouts.footer')
      </div>
    </section>
    <!--=======SideHeader-Section Ends Here=======-->
  
  
  </div>

@endsection
