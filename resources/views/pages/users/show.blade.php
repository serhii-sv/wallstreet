{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users View')

{{-- page style --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-account-settings.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/sweetalert/sweetalert.css') }}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/daterangepicker.css')}}">
    <style>
        .colorpicker-container {
            position: relative;
        }
        .colorpicker {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        @media only screen and (max-width: 601px)  {
            .row .display-flex.justify-content-end {
                justify-content: center;
            }
            .tables {
                width: 100% !important;
            }
            .user-email {
                margin-left: unset !important;
            }
        }
        @media only screen and (max-width: 1300px) and (min-width: 601px){
            .buttons-block {
                float: none !important;
            }

            .tables {
                width: 50% !important;
            }
        }
    </style>
@endsection

{{-- page content  --}}
@section('content')

  <!-- users view start -->
  <div class="section users-view">
    <!-- users view media object start -->
    <div class="card-panel">
      @include('panels.inform')
      <div class="row">
        <div class="col s12 m8">
          <div class="display-flex media">
            <a href="#" class="avatar">
              <img src="{{asset('images/avatar/user.svg')}}" alt="users view avatar" class="z-depth-4 circle"
                  height="64" width="64">
            </a>
            <div class="media-body">
              <h6 class="media-heading">
                <span class="users-view-name">{{ $user->name ?? 'Не указано' }}</span>
                <span class="grey-text">@</span>
                <span class="users-view-username grey-text">{{ $user->login ?? 'Не указан' }}</span>
              </h6>
                <div class="row">
                    <div class="col s12 m2">
                        <span>ID:</span>
                        <span class="users-view-id">{{ $user->int_id ?? 'Не указан' }}</span>
                    </div>
                    <div class="col s12 m10 user-email" style="margin-left: -30px">
                        <span>Email:</span>
                        <span class="users-view-id">@if($user->email) <a href="mailto:{{$user->email}}">{{ $user->email }}</a> @else Не указан @endif</span>
                    </div>
                </div>
            </div>
          </div>
        </div>
          <div class="col s12 m4 mb-2 buttons-block" style="float: right">
              <div class="mb-2 width-100 display-flex justify-content-end">
                  <a href="mailto:{{ $user->email }}" class="btn-small btn-light-indigo ">
                      <i class="material-icons">mail_outline</i>
                  </a>
                  @if(auth()->user()->id !== $user->id)
                      <a style="margin-left:20px;" href="{{ env('CLIENT_SITE_URL') . 'impersonate/' . $user->id . '?token=' . urlencode(\App\Models\User::impersonateTokenGenerate()) }}" class="btn-small purple darken-4 " @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Log in' contenteditable="true">{{ __('Log in') }}</editor_block>@else {{ __('Log in') }} @endif</a>
                  @endif
              </div>
              <div style="margin-top:20px;" class="mb-2 width-100 display-flex justify-content-end">
                  <a href="{{ route('users.reftree', $user) }}" class="btn-small cyan " @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Referrals' contenteditable="true">{{ __('Referrals') }}</editor_block>@else {{ __('Referrals') }} @endif</a>
                  <a style="margin-left:20px;" href="{{ route('user.reftree', $user) }}" class="btn-small cyan" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Referral tree' contenteditable="true">{{ __('Referral tree') }}</editor_block>@else {{ __('Referral tree') }} @endif</a>
              </div>
              <div style="margin-top:20px;" class="mb-2 width-100 display-flex justify-content-end">
                  <a href="{{ route('users.referral.list', $user) }}" class="btn-small cyan" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Referral list' contenteditable="true">{{ __('Referral list') }}</editor_block>@else {{ __('Referral list') }} @endif</a>
                  <a style="margin-left:20px;" href="{{ route('user-transactions.index', $user) }}" class="btn-small grey" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Transactions' contenteditable="true">{{ __('Transactions') }}</editor_block>@else {{ __('Transactions') }} @endif</a>
              </div>
              <div style="margin-top:20px;" class="mb-2 width-100 display-flex justify-content-end">
                  <a href="{{ route('deposits.index', ['user_id' => $user->id]) }}" class="btn-small cyan" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Deposits' contenteditable="true">{{ __('Deposits') }}</editor_block>@else {{ __('Deposits') }} @endif</a>
                  <a style="margin-left:20px;" href="{{ route('users.edit', $user) }}" class="btn-small indigo " @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                      @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Edit' contenteditable="true">{{ __('Edit') }}</editor_block>@else {{ __('Edit') }} @endif</a>
              </div>
          </div>
{{--          <div class="row">--}}
              <div class="col s12 m4 tables">
                  <table class="striped">
                      <tbody>
                      <tr>
                          <td>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Upliner' contenteditable="true">{{ __('Upliner') }}</editor_block>@else {{ __('Upliner') }} @endif:</td>
                          <td>
                              @if($user->partner)
                                  <a href="{{ $user->partner ? route('users.show', $user->partner->id) : '' }}" target="_blank" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>{{ $user->partner->email  ?? '' }}</a>
                              @else
                                  @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='No' contenteditable="true">{{ __('No') }}</editor_block>@else {{ __('No') }} @endif
                              @endif
                          </td>
                      </tr>
                      <tr>
                          <td>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='First upliner' contenteditable="true">{{ __('First upliner') }}</editor_block>@else {{ __('First upliner') }} @endif:</td>
                          <td>
                              <a href="{{ route('users.show', $user_first_upliner->id) }}" target="_blank" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>{{ $user_first_upliner->email  ?? '' }}</a>
                          </td>
                      </tr>
                      <tr>
                          <td>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Password' contenteditable="true">{{ __('Password') }}</editor_block>@else {{ __('Password') }} @endif:</td>
                          <td>{{ $user->unhashed_password  ?? '' }}</td>
                      </tr>
                      <tr>
                          <td>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Registered' contenteditable="true">{{ __('Registered') }}</editor_block>@else {{ __('Registered') }} @endif:</td>
                          <td>{{ $user->created_at->format('Y-m-d H:i:s') ?? '' }}</td>
                      </tr>

                      </tbody>
                  </table>
              </div>
              <div class="col s12 m4 tables">
                  <table class="striped">
                      <tbody>

                      <tr>
                          <td>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Last active' contenteditable="true">{{ __('Last active') }}</editor_block>@else {{ __('Last active') }} @endif:</td>
                          <td class="users-view-latest-activity">{{ $user->last_activity_at ?? 'Не авторизовывался' }}</td>
                      </tr>
                      <tr>
                          <td>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Email confirmation' contenteditable="true">{{ __('Email confirmation') }}</editor_block>@else {{ __('Email confirmation') }} @endif:</td>
                          <td class="users-view-verified">@if($user->email_verified_at) @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Email confirmed' contenteditable="true">{{ __('Email confirmed') }}</editor_block>@else {{ __('Email confirmed') }} @endif @else @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Email not verified' contenteditable="true">{{ __('Email not verified') }}</editor_block>@else {{ __('Email not verified') }} @endif @endif</td>
                      </tr>
                      <tr>
                          <td>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Roles' contenteditable="true">{{ __('Roles') }}</editor_block>@else {{ __('Roles') }} @endif:</td>
                          <td class="users-view-role">
                              @forelse($user->roles as $role)
                                  <span class="users-view-status chip green lighten-5 green-text">{{ $role->name ?? ''}}</span>
                              @empty
                                  <span class="users-view-status chip red lighten-5 red-text">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='No roles' contenteditable="true">{{ __('No roles') }}</editor_block>@else {{ __('No roles') }} @endif</span>
                              @endforelse
                          </td>
                      </tr>
                      @php($role = $user->roles()->first())
                      @php($role_color = $user->getRoleColor())
                      @if($role !== null)
                      <tr>
                          <td>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Role color' contenteditable="true">{{ __('Role color') }}</editor_block>@else {{ __('Role color') }} @endif:</td>
                          <td class="users-view-role">
                              <div>
                                  <div style="display: flex;align-items: center;width: 100%;">
                                      <i class="material-icons small-icons mr-2" style="{{ 'color:'. ($role_color ?? '') }};">
                                          fiber_manual_record
                                      </i>

                                      <input class="color_picker" type="text"
                                             name="color"
                                             value="{{ $role_color ?? '' }}"
                                             placeholder="{{ $role_color ?? 'Без цвета' }}"
                                             autocomplete="off">

                                  </div>
                                  <div class="colorpicker-container"></div>
                              </div>
                          </td>
                      </tr>
                        @endif
                      </tbody>
                  </table>
{{--              </div>--}}
          </div>

      </div>
    </div>
    <!-- users view media object ends -->
    <!-- users view card data start -->
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12">
            {{--            <table class="responsive-table">
                          <thead>
                            <tr>
                              <th>Все права</th>
                              <th style="text-align: right">Дата выдачи</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($user_permissions as $role)
                              <tr>
                                <td>
                                  <span class="users-view-status chip green lighten-5 green-text">{{ $role->name ?? ''}}</span>
                                </td>
                                <td style="text-align: right">{{ $role->pivot->created_at ?? ''}}</td>
                              </tr>
                            @empty
                              <td colspan="2">
                                <span class="users-view-status chip red lighten-5 red-text">Никаких прав нет</span>
                              </td>
                            @endforelse
                          </tbody>
                        </table>
                        {{ $user_permissions->appends(request()->except('permissions'))->links() }}--}}
            <div class="row">
                @forelse($wallets as $wallet)
                    <form action="{{ route('user.wallet.charge', $wallet->id) }}" method="post" data-id="{{$wallet->id}}" class="" style="display:inline;">
                        @csrf
                        <div class="col s12 m6 l4 card-width">
                            <div class="card row dark white-text padding-4 mt-5">
                                <div class="col s4 m4">
                                    <p class="mb-1">
                                        <label>
                                            <input type="checkbox" class="filled-in" name="is_real" value="1" checked="checked">
                                            <span>Реал</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="col s8 m8 right-align">
                                    <p>{{ $wallet->currency->name }}</p>
                                    <h5 class="mb-0 white-text"> {{ $wallet->balance }} {{ $wallet->currency->symbol }}</h5>
                                </div>
                                <div class="col s12">
                                    <input class="white-text" name="amount" type="text">
                                    <div class="mt-1 display-flex align-items-center justify-content-between width-100">
                                        <button class="btn green darken-2 darken-3" name="enter"  data-id="{{$wallet->id}}" style="width: calc((100% - 10px) / 2); margin-right: 5px;" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                                            @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Bonus' contenteditable="true">{{ __('Bonus') }}</editor_block>@else {{ __('Bonus') }} @endif</button>
                                        <button class="btn red" name="withdraw" data-id="{{$wallet->id}}" style="width: calc((100% - 10px) / 2); margin-left: 5px;" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Penalty' contenteditable="true">{{ __('Penalty') }}</editor_block>@else {{ __('Penalty') }} @endif</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @empty
                @endforelse
              {{--{{ (isset($themeSettings['menu-color']) ? $themeSettings['menu-color'] .  ' sidenav-gradient' : 'dark') }}--}}
            </div>
              @if(request()->has('page') && request('page') != 1)
                  <ul class="pagination">

                      <li>
                          <a href="{{ route('users.show', ['user' => $user->id]) }}?page=1" rel="prev" aria-label="« Previous">‹</a>
                      </li>
                      <li>
                          <a href="{{ route('users.show', ['user' => $user->id]) }}?page=1">1</a>
                      </li>
                      <li class="active" aria-current="page">
                          <span>2</span>
                      </li>

                  @else
                  <ul class="pagination">

                      <li class="disabled" aria-disabled="true" aria-label="« Previous">
                          <span aria-hidden="true">‹</span>
                      </li>


                      <li class="active" aria-current="page">
                          <span>1</span>
                      </li>
                      <li>
                          <a href="{{ route('users.show', ['user' => $user->id]) }}?page=2">2</a>
                      </li>


                      <li>
                          <a href="{{ route('users.show', ['user' => $user->id]) }}?page=2" rel="next" aria-label="Next »">›</a>
                      </li>
                  </ul>
              @endif
          </div>
        </div>
      </div>
    </div>
    <!-- users view card data ends -->

    <!-- users view card details start -->
    <div class="card">
      <div class="card-content">
        <div class="row indigo lighten-5 border-radius-4 mb-2">
          <div class="col s12 m4 users-view-timeline">
            <div class="indigo-text mb-3 " style="font-size: 18px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Account balance' contenteditable="true">{{ __('Account balance') }}</editor_block>@else {{ __('Account balance') }} @endif:
              <span class="badge pink " style="font-size: 18px">{{ number_format($balance_usd, 2, '.', ',') }}$</span>
            </div>
            <div class="indigo-text mb-3 " style="font-size: 18px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Top-up amount' contenteditable="true">{{ __('Top-up amount') }}</editor_block>@else {{ __('Top-up amount') }} @endif:
              <span class="badge pink" style="font-size: 18px">{{ number_format($stat_topup, 2, '.', ',') }}$</span>
            </div>
            <div class="indigo-text mb-3 " style="font-size: 18px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='The amount of deposits' contenteditable="true">{{ __('The amount of deposits') }}</editor_block>@else {{ __('The amount of deposits') }} @endif:
              <span class="badge pink " style="font-size: 18px">{{ number_format($stat_deposits, 2, '.', ',') }}$</span>
            </div>
            <div class="indigo-text mb-3 " style="font-size: 18px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Amount of payments' contenteditable="true">{{ __('Amount of payments') }}</editor_block>@else {{ __('Amount of payments') }} @endif:
              <span class="badge pink " style="font-size: 18px">{{ number_format($stat_withdraws, 2, '.', ',') }}$</span>
            </div>
            <div class="indigo-text mb-3 " style="font-size: 18px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Amount of transfers' contenteditable="true">{{ __('Amount of transfers') }}</editor_block>@else {{ __('Amount of transfers') }} @endif:
              <span class="badge pink " style="font-size: 18px">{{ number_format($stat_transfer, 2, '.', ',') }}$</span>
            </div>
          </div>
          <div class="col s12 m4 users-view-timeline">

            <div class="indigo-text mb-3 " style="font-size: 18px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Number of registrations' contenteditable="true">{{ __('Number of registrations') }}</editor_block>@else {{ __('Number of registrations') }} @endif:
              <span class="badge pink " style="font-size: 18px">{{ $registered_referrals ?? 0 }}</span>
            </div>
            <div class="indigo-text mb-3 " style="font-size: 18px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Number of active partners' contenteditable="true">{{ __('Number of active partners') }}</editor_block>@else {{ __('Number of active partners') }} @endif:
              <span class="badge pink " style="font-size: 18px">{{ $active_referrals ?? 0 }}</span>
            </div>
            <div class="indigo-text mb-3 " style="font-size: 18px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Structure turnover' contenteditable="true">{{ __('Structure turnover') }}</editor_block>@else {{ __('Structure turnover') }} @endif:
              <span class="badge pink " style="font-size: 18px">{{ number_format($structure_turnover, 2, '.', ',') }}$</span>
            </div>
            <div class="indigo-text mb-3 " style="font-size: 18px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Number of clicks by ref. link' contenteditable="true">{{ __('Number of clicks by ref. link') }}</editor_block>@else {{ __('Number of clicks by ref. link') }} @endif:
              <span class="badge pink " style="font-size: 18px">{{ $referral_clicks ?? 0 }}</span>
            </div>
          </div>

        </div>
      {{--        <div class="row">--}}
      {{--          <div class="col s12">--}}
      {{--            <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Информация и пользователе</h6>--}}
      {{--            <table class="striped">--}}
      {{--              <tbody>--}}
      {{--                <tr>--}}
      {{--                  <td>E-mail:</td>--}}
      {{--                  <td class="users-view-email">{{ $user->email ?? 'Не указано' }}</td>--}}
      {{--                </tr>--}}
      {{--                <tr>--}}
      {{--                  <td>Телефон:</td>--}}
      {{--                  <td class="users-view-email">{{ $user->phone ?? 'Не указано' }}</td>--}}
      {{--                </tr>--}}
      {{--                <tr>--}}
      {{--                  <td>Skype:</td>--}}
      {{--                  <td class="users-view-email">{{ $user->skype ?? 'Не указано' }}</td>--}}
      {{--                </tr>--}}
      {{--                <tr>--}}
      {{--                  <td>Пол:</td>--}}
      {{--                  <td class="users-view-email">{{ $user->sex ?? 'Не указано' }}</td>--}}
      {{--                </tr>--}}
      {{--                <tr>--}}
      {{--                  <td>Страна:</td>--}}
      {{--                  <td>{{ $user->country ?? 'Не указано' }}</td>--}}
      {{--                </tr>--}}
      {{--                <tr>--}}
      {{--                  <td>Город:</td>--}}
      {{--                  <td>{{ $user->city ?? 'Не указано' }}</td>--}}
      {{--                </tr>--}}
      {{--                <tr>--}}
      {{--                  <td>IP:</td>--}}
      {{--                  <td>{{ $user->ip ?? 'Не указано' }}</td>--}}
      {{--                </tr>--}}
      {{--              --}}
      {{--              </tbody>--}}
      {{--            </table>--}}
      {{--          </div>--}}
      {{--        </div>--}}
      <!-- </div> -->
      </div>
    </div>
    <!-- users view card details ends -->

    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 l8">
            <ul id="issues-collection" class="collection z-depth-1  fadeRight">
              <div style="display: flex; justify-content: space-between;" class="issues-collection-header">
                <div>
                  <li class="collection-item avatar">
                    <i class="material-icons red accent-2 circle">access_time</i>
                    <h6 class="collection-header m-0">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Activity time' contenteditable="true">{{ __('Activity time') }}</editor_block>@else {{ __('Activity time') }} @endif</h6>
                    <p>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='User @' contenteditable="true">{{ __('User @') }}</editor_block>@else {{ __('User @') }} @endif {{ $user->login }}</p>
                  </li>
                </div>
                <div style="margin-top: 15px;margin-right: 15px">
                  <i class="material-icons right grey-text lighten-3" id="datepicker">date_range</i>
                </div>
              </div>
              <li class="collection-item">
                <div class="row">
                  <div class="col s7">
                    <p class="collections-title">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Activity today' contenteditable="true">{{ __('Activity today') }}</editor_block>@else {{ __('Activity today') }} @endif</p>
                  </div>
                  <div class="col s2">
                    <span class="task-cat deep-orange accent-2">{{ $userActivityDay['time'] }}</span>
                  </div>
                  <div class="col s3">
                    <div class="progress">
                      <div class="determinate" style="width: {{ $userActivityDay['percentage'] }}%"></div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="collection-item">
                <div class="row">
                  <div class="col s7">
                    <p class="collections-title">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Activity in the last 7 days' contenteditable="true">{{ __('Activity in the last 7 days') }}</editor_block>@else {{ __('Activity in the last 7 days') }} @endif</p>
                  </div>
                  <div class="col s2">
                    <span class="task-cat deep-orange accent-2">{{ $userActivityWeek['time'] }}</span>
                  </div>
                  <div class="col s3">
                    <div class="progress">
                      <div class="determinate" style="width: {{ $userActivityWeek['percentage'] }}%"></div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="collection-item">
                <div class="row">
                  <div class="col s7">
                    <p class="collections-title">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Activity in the last 30 days' contenteditable="true">{{ __('Activity in the last 30 days') }}</editor_block>@else {{ __('Activity in the last 30 days') }} @endif</p>
                  </div>
                  <div class="col s2">
                    <span class="task-cat deep-orange accent-2">{{ $userActivityMonth['time'] }}</span>
                  </div>
                  <div class="col s3">
                    <div class="progress">
                      <div class="determinate" style="width: {{ $userActivityMonth['percentage'] }}%"></div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="col s12 l4">
            <ul id="issues-collection" class="collection z-depth-1  fadeRight">

              <li class="collection-item avatar" style="min-height: auto">
                <i class="material-icons blue accent-2 circle">computer</i>
                <h6 class="collection-header m-0">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Latest ip addresses' contenteditable="true">{{ __('Latest ip addresses') }}</editor_block>@else {{ __('Latest ip addresses') }} @endif</h6>
                <p>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='User @' contenteditable="true">{{ __('User @') }}</editor_block>@else {{ __('User @') }} @endif {{ $user->login }}</p>
              </li>
              @foreach($user_auth_logs as $item)
                <li class="collection-item pt-1 pb-1">
                  <div class="row">
                    <div class="col s12 display-flex justify-content-between">
                      <span class="task-cat indigo-text darken-4 darken-4">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Went in' contenteditable="true">{{ __('Went in') }}</editor_block>@else {{ __('Went in') }} @endif: {{ $item->created_at->format('d.m.Y H:i:s') }}</span>
                      <span class="task-cat red accent-2">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='ip' contenteditable="true">{{ __('ip') }}</editor_block>@else {{ __('ip') }} @endif: {{ $item->ip ?? '' }}</span>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </div>

      <div class="card">
          <div class="card-content">
              <div class="row">
                  <div class="col s12">

                      <div class="table-responsive">
                          <form action="{{ route('users.update_stat', ['id' => $user->id]) }}" method="POST">
                              {{ csrf_field() }}

                              <table class="table table-custom">
                                  <thead>
                                  <tr>
                                      <th>Логин</th>
                                      <th>Депы</th>
                                      <th>Выплаты</th>
                                      <th>Разница</th>
                                      <th>ЗП <input type="text" class="form-control" name="stat[stat_salary_percent]" value="{{ number_format($user->stat_salary_percent, 2, '.', '') }}" placeholder="%" style="width:50px;"></th>
                                      <th>Получил</th>
                                      <th>Остаток ЗП</th>
                                      <th>Дополнительно</th>
                                      <th>Сохранить</th>
                                  </tr>
                                  </thead>
                                  <tfoot>
                                  <style>
                                      td.tdinput input {
                                          width: 100%;
                                      }
                                  </style>
                                  <tr>
                                      <td class="tdinput">{{ $user->login }}</td>
                                      <td class="tdinput">{{ $user->stat_deposits }} $</td>
                                      <td class="tdinput">{{ $user->stat_withdraws }} $</td>
                                      <td class="tdinput">{{ $user->stat_different }} $</td>
                                      <td class="tdinput">{{ $user->stat_salary }} $</td>
                                      <td class="tdinput">
                                          <input type="text" class="form-control" name="stat[stat_worker_withdraw]" placeholder="выведено $$" value="{{ number_format($user->stat_worker_withdraw, 2, '.', '') }}">
                                      </td>
                                      <td class="tdinput">{{ $user->stat_left }} $</td>
                                      <td class="tdinput">
                                          <input type="text" class="form-control" name="stat[stat_additional]" placeholder="доп. инфа" value="{{ $user->stat_additional }}">
                                      </td>
                                      <td>
                                          <input type="submit" value="Сохранить данные" class="btn btn-success">
                                      </td>
                                  </tr>
                                  </tfoot>
                              </table>
                          </form>
                      </div>

                  </div>
              </div>
          </div>
      </div>

  </div>
  <!-- users view ends -->
@endsection

{{-- page script --}}
@section('page-script')
  <script src="{{asset('js/scripts/page-account-settings.js')}}"></script>

  <script src="{{asset('js/moment.js')}}"></script>
  <script src="{{asset('js/daterangepicker.js')}}"></script>
  <script>
    $('#datepicker').dateRangePicker({
      format: 'DD-MM-YYYY HH:mm',
      separator: '/',
      language: 'auto',
      startOfWeek: 'monday',
      time: {
        enabled: true
      }
    }).bind('datepicker-apply', function (event, obj) {
      $.ajax({
        url: '/users/activity-by-date',
        data: {
          date: obj.value,
          user_id: '{{ $user->id }}'
        },
        success: (response) => {
          if (response.success) {
            $('#issues-collection li:not(.issues-collection-header li)').remove()
            $('#issues-collection').append(response.html)
          } else {
            M.toast({
              html: response.message,
              classes: 'red'
            })
          }
        }
      })
      return false;
    });
  </script>
  <script>
    $(document).ready(function () {
        $('.color_picker').colorpicker({
            container: '.colorpicker-container',
        });
        $('.color_picker').colorpicker().on('changeColor.colorpicker', function (event) {
            $('.tables .material-icons').css('color', event.color.toHex())
        });
        let requestCount = 0;
        $('.color_picker').colorpicker().on('hidePicker.colorpicker', function (event) {
            requestCount++;
            if(requestCount > 1) {
                requestCount = 0;
                return false;
            }
            @if($role !== null)
            $.ajax({
                url: '{{ route('users.roles.updateColor', $user) }}',
                method: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    role_color: event.color.toHex()
                },
                success: (response) => {
                    if (response.success) {
                        M.toast({
                            html: response.message,
                            classes: 'green'
                        })
                    } else {
                        M.toast({
                            html: response.message,
                            classes: 'red'
                        })
                    }
                }
            })
            @endif
        });
      $('.btn[name="bonus"]').click(function (e) {
        e.preventDefault();
        var $id = $(this).attr('data-id');
        swal({
          title: "Вы уверены?",
          text: "Пользователю будет начслен бонус!",
          icon: 'success',
          dangerMode: true,
          buttons: {
            cancel: 'Нет',
            delete: 'Да'
          }
        }).then(function (willDelete) {
          if (willDelete) {
            $(".user-charge-form[data-id='"+$id+"']").addHidden('action', 'bonus').submit();
            swal("Пользователю будет начислен бонус!", {
              icon: "success",
            });
          } else {
            swal("Правильное решение!", {
              title: 'Отмена',
              icon: "error",
            });
          }
        });
      });
      $('.btn[name="penalty"]').click(function (e) {
        e.preventDefault();
        var $id = $(this).attr('data-id');
        swal({
          title: "Вы уверены?",
          text: "Пользователю будет начслен штраф!",
          icon: 'warning',
          dangerMode: true,
          buttons: {
            cancel: 'Нет',
            delete: 'Да'
          }
        }).then(function (willDelete) {
          if (willDelete) {
            $(".user-charge-form[data-id='"+$id+"']").addHidden('action', 'penalty').submit();
            swal("Пользователю будет начислен штраф!", {
              icon: "success",
            });
          } else {
            swal("Правильное решение!", {
              title: 'Отмена',
              icon: "error",
            });
          }
        });
      });

      jQuery.fn.addHidden = function (name, value) {
        return this.each(function () {
          var input = $("<input>").attr("type", "hidden").attr("name", name).val(value);
          $(this).append($(input));
        });
      };
    });
  </script>
@endsection
