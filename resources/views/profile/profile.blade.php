@extends('layouts.app')
@section('title', __('Dashboard'))
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
            <h3 class="title">
              {{ __('Dashboard') }}
            </h3>
            <ul class="breadcrumb">
              <li>
                <a href="{{ route('profile.profile') }}">Home</a>
              </li>
              <li>
                {{ __('Dashboard') }}
              </li>
            </ul>
          </div>
        </div>
        <div class="container-fluid">
          @include('profile.components.balance-block')
          
          <div class="row pb-30">
            <div class="col-lg-6">
              <div class="total-earning-item">
                <div class="total-earning-heading">
                  <h5 class="title">Total earning </h5>
                  <h4 class="amount cl-1">$103 458</h4>
                </div>
                <div class="d-flex flex-wrap justify-content-between">
                  <div class="item">
                    <div class="cont">
                      <h4 class="cl-theme">+.3%</h4>
                      <span class="month">August  Profit</span>
                    </div>
                    <div class="thumb">
                      <img src="{{ asset('images/dashboard/graph1.png') }}" alt="dashboard">
                    </div>
                  </div>
                  <div class="item">
                    <div class="cont">
                      <h4 class="cl-1">+.12%</h4>
                      <span class="month">Year Profit</span>
                    </div>
                    <div class="thumb">
                      <img src="{{ asset('images/dashboard/graph2.png') }}" alt="dashboard">
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <a href="" class="normal-button">Explore <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="progress-wrapper mb-30">
                <h5 class="title cl-white">Progress</h5>
                <div class="d-flex flex-wrap m-0-15-20-none">
                  <div class="circle-item">
                    <span class="level">Level(1)</span>
                    <div class="progress1 circle">
                      <strong></strong>
                    </div>
                  </div>
                  <div class="circle-item">
                    <span class="level">ROI Speed</span>
                    <div class="progress2 circle">
                      <strong></strong>
                    </div>
                  </div>
                  <div class="circle-item">
                    <span class="level">ROI Redeemed</span>
                    <div class="progress3 circle">
                      <strong></strong>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="earn-item mb-30">
                <div class="earn-thumb">
                  <img src="{{ asset('images/dashboard/earn/01.png') }}" alt="dashboard-earn">
                </div>
                <div class="earn-content">
                  <h6 class="title">Active deposits in the amount of</h6>
                  <ul class="mb--5">
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/usd.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.00</span>
                        <span class="cl-4">USD</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/btc.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">BTC</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/xrp.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">XRP</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/eth.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">ETH</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="earn-item mb-30">
                <div class="earn-thumb">
                  <img src="{{ asset('images/dashboard/earn/02.png') }}" alt="dashboard-earn">
                </div>
                <div class="earn-content partner-content d-flex flex-wrap align-items-start justify-content-between">
                  <h6 class="title w-100">All partners</h6>
                  <ul class="mb--5">
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/active.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-4">Active :</span>
                        <span class="cl-1">40</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/inactive.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-4">Inactive :</span>
                        <span class="cl-1">05</span>
                      </div>
                    </li>
                  </ul>
                  <div class="total-partner">
                    <span class="total-title">45</span>
                    <span>Total</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-xl-4">
              <div class="earn-item mb-30">
                <div class="earn-thumb">
                  <img src="{{ asset('images/dashboard/earn/03.png') }}" alt="dashboard-earn">
                </div>
                <div class="earn-content">
                  <h6 class="title">Earned Referral</h6>
                  <ul class="mb--5">
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/usd.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.00</span>
                        <span class="cl-4">USD</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/btc.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">BTC</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/xrp.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">XRP</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/eth.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">ETH</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-xl-4">
              <div class="earn-item mb-30">
                <div class="earn-thumb">
                  <img src="{{ asset('images/dashboard/earn/04.png') }}" alt="dashboard-earn">
                </div>
                <div class="earn-content">
                  <h6 class="title">Earned Deposits</h6>
                  <ul class="mb--5">
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/usd.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.00</span>
                        <span class="cl-4">USD</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/btc.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">BTC</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/xrp.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">XRP</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/eth.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">ETH</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-xl-4">
              <div class="earn-item mb-30">
                <div class="earn-thumb">
                  <img src="{{ asset('images/dashboard/earn/05.png') }}" alt="dashboard-earn">
                </div>
                <div class="earn-content">
                  <h6 class="title">Payout</h6>
                  <ul class="mb--5">
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/usd.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.00</span>
                        <span class="cl-4">USD</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/btc.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">BTC</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/xrp.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">XRP</span>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/eth.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.000000</span>
                        <span class="cl-4">ETH</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="earn-item small-thumbs mb-30">
                <div class="earn-thumb">
                  <img src="{{ asset('images/dashboard/earn/06.png') }}" alt="dashboard-earn">
                </div>
                <div class="earn-content">
                  <h6 class="title">Latest Registered Partner</h6>
                  <ul class="mb--5">
                    <li>
                      <div class="cont w-100 p-0">
                        <span class="cl-1">Adrian54</span>
                        <a href="" class="cl-4">Email: demo@mail.com</a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="earn-item small-thumbs mb-30">
                <div class="earn-thumb">
                  <img src="{{ asset('images/dashboard/earn/07.png') }}" alt="dashboard-earn">
                </div>
                <div class="earn-content">
                  <h6 class="title">The last Referral Calculation</h6>
                  <ul class="mb--5">
                    <li>
                      <div class="icon">
                        <img src="{{ asset('images/dashboard/earn/usd.png') }}" alt="dashboard-earn">
                      </div>
                      <div class="cont">
                        <span class="cl-1">0.00</span>
                        <span class="cl-4">USD</span>
                      </div>
                    </li>
                  </ul>
                </div>
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

@push('js')
  <script>
    $('.progress1.circle').circleProgress({
      value: .75,
      fill: {
        gradient: ['#00cca2', '#00cca2']
      },
    }).on('circle-animation-progress', function(event, progress) {
      $(this).find('strong').html(Math.round(75 * progress) + '<i>%</i>');
    });
    $('.progress2.circle').circleProgress({
      value: .90,
      fill: {
        gradient: ['#8d16e8', '#8d16e8']
      },
    }).on('circle-animation-progress', function(event, progress) {
      $(this).find('strong').html(Math.round(90 * progress) + '<i>%</i>');
    });
    $('.progress3.circle').circleProgress({
      value: .85,
      fill: {
        gradient: ['#ef764c', '#ef764c']
      },
    }).on('circle-animation-progress', function(event, progress) {
      $(this).find('strong').html(Math.round(85 * progress) + '<i>%</i>');
    });
  </script>
@endpush
