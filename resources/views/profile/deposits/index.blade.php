@extends('layouts.app')
@section('title', __('Deposits'))
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
            <h3 class="title">{{ __("Deposits") }}</h3>
            <ul class="breadcrumb">
              <li>
                <a href="{{ route('profile.profile') }}">{{ __("Dashboard") }}</a>
              </li>
              <li>
                {{ __("Deposits") }}
              </li>
            </ul>
          </div>
        </div>
        <div class="container-fluid">
          
          @include('profile.components.balance-block')
          
          <div class="deposit">
            <h3 class="main-title">Make Deposits</h3>
            <h4 class="main-subtitle">01. Select the Plan</h4>
            <div class="deposit-wrapper">
              <div class="deposit-item">
                <div class="deposit-inner">
                  <div class="deposit-header">
                    <h3 class="title">120%</h3>
                    <span><b>every day</b></span>
                  </div>
                  <div class="deposit-body">
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer1.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Deposit</h5>
                        <h5 class="subtitle"><span class="min">$10</span><span class="to">to</span><span class="max">$3500</span></h5>
                      </div>
                    </div>
                    <span class="bal-shape"></span>
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer2.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Terms</h5>
                        <h5 class="subtitle">10 days</h5>
                      </div>
                    </div>
                  </div>
                  <a href="#0" class="select-plan"><i class="fas fa-plus"></i></a>
                </div>
              </div>
              <div class="deposit-item">
                <div class="deposit-inner active">
                  <div class="deposit-header">
                    <h3 class="title">120%</h3>
                    <span><b>every day</b></span>
                  </div>
                  <div class="deposit-body">
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer1.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Deposit</h5>
                        <h5 class="subtitle"><span class="min">$10</span><span class="to">to</span><span class="max">$3500</span></h5>
                      </div>
                    </div>
                    <span class="bal-shape"></span>
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer2.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Terms</h5>
                        <h5 class="subtitle">10 days</h5>
                      </div>
                    </div>
                  </div>
                  <a href="#0" class="select-plan"><i class="fas fa-plus"></i></a>
                </div>
              </div>
              <div class="deposit-item">
                <div class="deposit-inner">
                  <div class="deposit-header">
                    <h3 class="title">120%</h3>
                    <span><b>every day</b></span>
                  </div>
                  <div class="deposit-body">
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer1.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Deposit</h5>
                        <h5 class="subtitle"><span class="min">$10</span><span class="to">to</span><span class="max">$3500</span></h5>
                      </div>
                    </div>
                    <span class="bal-shape"></span>
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer2.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Terms</h5>
                        <h5 class="subtitle">10 days</h5>
                      </div>
                    </div>
                  </div>
                  <a href="#0" class="select-plan"><i class="fas fa-plus"></i></a>
                </div>
              </div>
              <div class="deposit-item">
                <div class="deposit-inner">
                  <div class="deposit-header">
                    <h3 class="title">120%</h3>
                    <span><b>every day</b></span>
                  </div>
                  <div class="deposit-body">
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer1.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Deposit</h5>
                        <h5 class="subtitle"><span class="min">$10</span><span class="to">to</span><span class="max">$3500</span></h5>
                      </div>
                    </div>
                    <span class="bal-shape"></span>
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer2.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Terms</h5>
                        <h5 class="subtitle">10 days</h5>
                      </div>
                    </div>
                  </div>
                  <a href="#0" class="select-plan"><i class="fas fa-plus"></i></a>
                </div>
              </div>
              <div class="deposit-item">
                <div class="deposit-inner">
                  <div class="deposit-header">
                    <h3 class="title">120%</h3>
                    <span><b>every day</b></span>
                  </div>
                  <div class="deposit-body">
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer1.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Deposit</h5>
                        <h5 class="subtitle"><span class="min">$10</span><span class="to">to</span><span class="max">$3500</span></h5>
                      </div>
                    </div>
                    <span class="bal-shape"></span>
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer2.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Terms</h5>
                        <h5 class="subtitle">10 days</h5>
                      </div>
                    </div>
                  </div>
                  <a href="#0" class="select-plan"><i class="fas fa-plus"></i></a>
                </div>
              </div>
              <div class="deposit-item">
                <div class="deposit-inner">
                  <div class="deposit-header">
                    <h3 class="title">120%</h3>
                    <span><b>every day</b></span>
                  </div>
                  <div class="deposit-body">
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer1.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Deposit</h5>
                        <h5 class="subtitle"><span class="min">$10</span><span class="to">to</span><span class="max">$3500</span></h5>
                      </div>
                    </div>
                    <span class="bal-shape"></span>
                    <div class="item">
                      <div class="item-thumb">
                        <img src="{{ asset('images/offer/offer2.png') }}" alt="offer">
                      </div>
                      <div class="item-content">
                        <h5 class="title">Terms</h5>
                        <h5 class="subtitle">10 days</h5>
                      </div>
                    </div>
                  </div>
                  <a href="#0" class="select-plan"><i class="fas fa-plus"></i></a>
                </div>
              </div>
            </div>
            
            <div class="deposit-system">
              <h4 class="main-subtitle">02. Choose Payment  System</h4>
              @include('profile.components.choose-payment')
            </div>
            
            <div class="deposit-system">
              <h4 class="main-subtitle">03. Enter the amount of Deposit:</h4>
              <form class="make-deposit">
                <div class="form-group">
                  <input type="text" placeholder="Enter your amount" class="make-amount">
                </div>
                <div class="form-group">
                  <label for="total-profit">Total Profit</label>
                  <input type="text" readonly value="$180.00" class="readonly">
                </div>
                <div class="form-group">
                  <button type="submit" class="custom-button border-0">Make Deposit</button>
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

