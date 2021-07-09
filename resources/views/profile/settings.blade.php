@extends('layouts.app')
@section('title', __('Settings'))
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
            <h3 class="title">{{ __('Settings') }}</h3>
            <ul class="breadcrumb">
              <li>
                <a href="{{ route('profile.profile') }}">{{ __('Dashboard') }}</a>
              </li>
              <li>
                {{ __('Settings') }}
              </li>
            </ul>
          </div>
        </div>
        <div class="container-fluid">
          @include('profile.components.balance-block')
          <div class="partners">
            <h3 class="main-title">Settings</h3>
            <div class="row mb-30-none">
              <div class="col-lg-6 mb-30">
                <div class="create_wrapper mw-100">
                  <h5 class="subtitle">Personal Info</h5>
                  <div class="d-flex align-items-center mb-30">
                    <div class="update_user">
                      <img src="{{ asset('images/dashboard/user.png') }}" alt="dashboard">
                    </div>
                    <div class="pl-3">
                      <span class="sub_subtitle cl-title fz-sm d-block">JPEG Or PNG 500 x 500px</span>
                      <label for="update_profile" class="custom-button m-0 mt-2 lh-40 h-40">Browse Image</label>
                      <input type="file" id="update_profile" class="profile_update_input">
                    </div>
                  </div>
                  <form class="create_ticket_form row mb-30-none">
                    <div class="create_form_group col-sm-12">
                      <label for="account_name">Account Name:</label>
                      <input type="text" id="account_name" placeholder="Account Name">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="full_name">Full Name:</label>
                      <input type="text" id="full_name" placeholder="Full Name">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="account_email">Your Email Address:</label>
                      <input type="text" id="account_email" placeholder="Enter your Email">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="account_mobile">Mobile No:</label>
                      <input type="text" id="account_mobile" placeholder="Enter your Mobile No">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="account_address">Address:</label>
                      <input type="text" id="account_address" placeholder="Enter Address">
                    </div>
                    <div class="create_form_group col-sm-6">
                      <label for="account_city">City:</label>
                      <input type="text" id="account_city" placeholder="Enter your City">
                    </div>
                    <div class="create_form_group col-sm-6">
                      <label for="account_state">State</label>
                      <input type="text" id="account_state" placeholder="Enter your State">
                    </div>
                    <div class="create_form_group col-sm-6">
                      <label for="country_name">Country:</label>
                      <input type="text" id="country_name" placeholder="Enter your Country">
                    </div>
                    <div class="create_form_group col-sm-6 align-self-end">
                      <button type="submit" class="custom-button border-0">Save</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-6 mb-30">
                <div class="create_wrapper mw-100">
                  <h5 class="subtitle">payment system</h5>
                  <form class="create_ticket_form row mb-30-none">
                    <div class="create_form_group col-sm-12">
                      <label for="perfect_money">Perfect Money:</label>
                      <input type="text" id="perfect_money" value="U12\34567">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="payer_account">Your Payeer acc no:</label>
                      <input type="text" id="payer_account" value="P1234567">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="payment_gateway">Paypal:</label>
                      <input type="text" id="payment_gateway" value="Johndoe@gmail.com">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="bitcoin_account_no">Your Bitcoin acc no:</label>
                      <input type="text" id="bitcoin_account_no" value="55550002220022">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="litecoin_account">Your Litecoin acc no:</label>
                      <input type="text" id="litecoin_account" value="55550002220022">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="dogecoin_account">Your Dogecoin acc no:</label>
                      <input type="text" id="dogecoin_account" value="55550002220022">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="ethereum_account">Your Ethereum acc no:</label>
                      <input type="text" id="ethereum_account" value="55550002220022">
                    </div>
                    <div class="create_form_group col-sm-6 align-self-end">
                      <button type="submit" class="custom-button border-0">Save</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-6 mb-30">
                <div class="create_wrapper mw-100">
                  <h5 class="subtitle">Other settings</h5>
                  <form class="create_ticket_form mb-30-none">
                    <div class="create_form_group">
                      <label for="old_pass">Your time zone:</label>
                      <div class="select-item mb-3">
                        <select class="select-bar">
                          <option value="time_zone_1">+00.00</option>
                          <option value="time_zone_2">+02.00</option>
                          <option value="time_zone_3">+03.00</option>
                          <option value="time_zone_4">+04.00</option>
                          <option value="time_zone_5">+05.00</option>
                          <option value="time_zone_6">+06.00</option>
                          <option value="time_zone_7">+07.00</option>
                          <option value="time_zone_8">+08.00</option>
                          <option value="time_zone_9">+09.00</option>
                        </select>
                      </div>
                      <div class="check_box_group">
                        <input type="checkbox" name="time-zone" class="fz-sm" id="time_zone" checked>
                        <label for="time_zone">Not to get alerts by E-mail</label>
                      </div>
                    </div>
                    <div class="create_form_group">
                      <label for="old_pass">Control of IP address changes:</label>
                      <div class="select-item mb-3">
                        <select class="select-bar">
                          <option value="ip_control_1">+00.00</option>
                          <option value="ip_control_2">+02.00</option>
                          <option value="ip_control_3">+03.00</option>
                          <option value="ip_control_4">+04.00</option>
                          <option value="ip_control_5">+05.00</option>
                          <option value="ip_control_6">+06.00</option>
                          <option value="ip_control_7">+07.00</option>
                          <option value="ip_control_8">+08.00</option>
                          <option value="ip_control_9">+09.00</option>
                        </select>
                      </div>
                      <div class="check_box_group">
                        <input type="checkbox" name="time-zone" class="fz-sm" id="ip_control_3">
                        <label for="ip_control_3">Bind session to IP address</label>
                      </div>
                      <div class="check_box_group">
                        <input type="checkbox" name="time-zone" class="fz-sm" id="ip_control_2">
                        <label for="ip_control_2">To prevent concurrent sessions</label>
                      </div>
                    </div>
                    <div class="create_form_group align-self-end">
                      <button type="submit" class="custom-button border-0">Save</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-6 mb-30">
                <div class="create_wrapper mw-100">
                  <h5 class="subtitle">Change Passowrd</h5>
                  <form class="create_ticket_form row mb-30-none">
                    <div class="create_form_group col-sm-12">
                      <label for="old_pass">Old Passowrd:</label>
                      <input type="password" id="old_pass" placeholder="Enter your Old Password">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="new_pass">New password::</label>
                      <input type="password" id="new_pass" placeholder="Enter your new password:">
                    </div>
                    <div class="create_form_group col-sm-12">
                      <label for="repeat_pass">Repeat the new password::</label>
                      <input type="password" id="repeat_pass" placeholder="Repeat your new password:">
                    </div>
                    <div class="create_form_group col-sm-6 align-self-end">
                      <button type="submit" class="custom-button border-0">Save</button>
                    </div>
                  </form>
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
