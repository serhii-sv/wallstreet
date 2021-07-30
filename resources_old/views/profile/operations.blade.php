@extends('layouts.app')
@section('title', __('Operations'))
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
            <h3 class="title">{{ __('Operations') }}</h3>
            <ul class="breadcrumb">
              <li>
                <a href="{{ route('profile.profile') }}">{{ __('Dashboard') }}</a>
              </li>
              <li>
                {{ __('Operations') }}
              </li>
            </ul>
          </div>
        </div>
        <div class="container-fluid">
          @include('profile.components.balance-block')
          
          <div class="operations">
            <h3 class="main-title">Operations</h3>
            <form class="operation-filter">
              <div class="filter-item">
                <label for="date">Date from:</label>
                <input type="date" placeholder="Date from">
              </div>
              <div class="filter-item">
                <label for="date">Date To:</label>
                <input type="date" placeholder="Date from">
              </div>
              <div class="filter-item">
                <label>Operation:</label>
                <div class="select-item">
                  <select class="select-bar">
                    <option value="o1">Add funds</option>
                    <option value="o2">Withdraw funds</option>
                    <option value="o4">Deposit funds</option>
                    <option value="o3">Transfer funds</option>
                  </select>
                </div>
              </div>
              <div class="filter-item">
                <label>Status:</label>
                <div class="select-item">
                  <select class="select-bar">
                    <option value="p1">Prepared</option>
                    <option value="p2">Prepared</option>
                    <option value="p3">Prepared</option>
                    <option value="p4">Prepared</option>
                    <option value="p5">Prepared</option>
                    <option value="p6">Prepared</option>
                  </select>
                </div>
              </div>
              <div class="filter-item">
                <button type="submit" class="custom-button">Filter</button>
              </div>
            </form>
            <div class="table-wrapper">
              <table class="transaction-table">
                <thead>
                  <tr>
                    <th>DATE AND TIME</th>
                    <th>OPERATION</th>
                    <th>payment method</th>
                    <th>Amount</th>
                    <th>STATUS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <i class="far fa-calendar"></i> Feb 14, 2020 20:53
                    </td>
                    <td>
                      Add funds
                    </td>
                    <td>
                      <img src="{{ asset('images/dashboard/earn/btc2.png') }}" alt="dashboard-earn"> BTC
                    </td>
                    <td>
                      0.000591
                    </td>
                    <td>
                      Prepeared
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="far fa-calendar"></i> Feb 14, 2020 20:53
                    </td>
                    <td>
                      Add funds
                    </td>
                    <td>
                      <img src="{{ asset('images/dashboard/earn/btc2.png') }}" alt="dashboard-earn"> BTC
                    </td>
                    <td>
                      0.000591
                    </td>
                    <td>
                      Prepeared
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @include('profile.layouts.footer')
      </div>
    </section>
    <!--=======SideHeader-Section Ends Here=======-->
  </div>
  
@endsection

