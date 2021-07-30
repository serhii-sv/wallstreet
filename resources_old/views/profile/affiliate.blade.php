@extends('layouts.app')
@section('title', __('Partners'))
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
            <h3 class="title">{{ __('Partners') }}</h3>
            <ul class="breadcrumb">
              <li>
                <a href="{{ route('profile.profile') }}">{{ __('Dashboard') }}</a>
              </li>
              <li>
                {{ __('Partners') }}
              </li>
            </ul>
          </div>
        </div>
        <div class="container-fluid">
          @include('profile.components.balance-block')
          <div class="partners">
            <h3 class="main-title">{{ __('Partners') }}</h3>
            <div class="referral-group">
              <div class="refers">
                <div class="referral-links">
                  <div class="oh">
                    <div class="referral-left">
                                            <span class="left-icon">
                                                <i class="fas fa-link"></i>
                                            </span>
                      <h6>Referral Link:</h6>
                      <div class="copy-button">
                        <a href="#0" class="custom-button" id="copy">Copy Link</a>
                      </div>
                      <input type="text" id="copyLinks" readonly value="https://hyipland.com/?ref=jhondoe24">
                    </div>
                  </div>
                </div>
              </div>
              <div class="promotional">
                <a href="" class="button-2">Promotional Materials</a>
              </div>
            </div>
            <div class="row mb-30-none">
              <div class="col-lg-6">
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
              <div class="col-lg-6">
                <div class="earn-item mb-30">
                  <div class="earn-thumb">
                    <img src="{{ asset('images/dashboard/earn/04.png') }}" alt="dashboard-earn">
                  </div>
                  <div class="earn-content">
                    <h6 class="title">Structure of Turnover</h6>
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
                    <img src="{{ asset('images/dashboard/earn/08.png') }}" alt="dashboard-earn">
                  </div>
                  <div class="earn-content">
                    <h6 class="title">Number of clicks on the referral link</h6>
                    <div class="click-number">
                      10
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="partners">
            <h3 class="main-title">Your Partners:</h3>
            <div class="table-wrapper">
              <table class="transaction-table">
                <thead>
                  <tr>
                    <th>DATE AND TIME</th>
                    <th>Level</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>payment method</th>
                    <th>Invested</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <i class="far fa-calendar"></i> Feb 14, 2020 20:53
                    </td>
                    <td>
                      Level1
                    </td>
                    <td>
                      Austin 984
                    </td>
                    <td>
                      <a href="">Austin 984@gmail.com</a>
                    </td>
                    <td>
                      <img src="{{ asset('images/dashboard/earn/btc2.png') }}" alt="dashboard-earn"> BTC
                    </td>
                    <td>
                      0.000591
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="far fa-calendar"></i> Feb 14, 2020 20:53
                    </td>
                    <td>
                      Level2
                    </td>
                    <td>
                      Austin 984
                    </td>
                    <td>
                      <a href="">Austin 984@gmail.com</a>
                    </td>
                    <td>
                      <img src="{{ asset('images/dashboard/earn/dash2.png') }}" alt="dashboard-earn"> BTC
                    </td>
                    <td>
                      0.000591
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="far fa-calendar"></i> Feb 14, 2020 20:53
                    </td>
                    <td>
                      Level3
                    </td>
                    <td>
                      Austin 984
                    </td>
                    <td>
                      <a href="">Austin 984@gmail.com</a>
                    </td>
                    <td>
                      <img src="{{ asset('images/dashboard/earn/eth3.png') }}" alt="dashboard-earn"> BTC
                    </td>
                    <td>
                      0.000591
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="far fa-calendar"></i> Feb 14, 2020 20:53
                    </td>
                    <td>
                      Level4
                    </td>
                    <td>
                      Austin 984
                    </td>
                    <td>
                      <a href="">Austin 984@gmail.com</a>
                    </td>
                    <td>
                      <img src="./assets/images/dashboard/earn/eth2.png" alt="dashboard-earn"> BTC
                    </td>
                    <td>
                      0.000591
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="far fa-calendar"></i> Feb 14, 2020 20:53
                    </td>
                    <td>
                      Level5
                    </td>
                    <td>
                      Austin 984
                    </td>
                    <td>
                      <a href="Mailto:dfdfdsafasdfasd@gmail.com">Austin 984@gmail.com</a>
                    </td>
                    <td>
                      <img src="./assets/images/dashboard/earn/btc2.png" alt="dashboard-earn"> BTC
                    </td>
                    <td>
                      0.000591
                    </td>
                  </tr>
                </tbody>
              </table>
            
            </div>
            <div class="pagination-area d-flex flex-wrap justify-content-between align-items-center">
              <div class="pagination-cont">
                Showing 1 to 5 of 22 entries
              </div>
              <ul class="pagination">
                <li>
                  <a href="#0"><i class="fas fa-angle-left"></i></a>
                </li>
                <li>
                  <a href="#0">01</a>
                </li>
                <li>
                  <a href="#0" class="active">02</a>
                </li>
                <li>
                  <a href="#0">03</a>
                </li>
                <li>
                  <a href="#0"><i class="fas fa-angle-right"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        
        
        @include('profile.layouts.footer')
      </div>
    </section>
  </div>

@endsection
