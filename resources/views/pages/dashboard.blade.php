{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Dashboard Modern')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/animate-css/animate.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/chartist-js/chartist.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/chartist-js/chartist-plugin-tooltip.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-modern.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/intro.css')}}">
  <style>
      .dashboard-operations-switch {
          margin-top: 30px;
          padding-right: 15px;
          position: relative;
          z-index: 5;
      }

      .dashboard-operations-wrapper {
          position: relative;
      }

      .subscription-table thead th {
          font-weight: 600;
      }

      button.badge {
          border: none;
      }
  </style>
  <style>

      :root {
          --white: #ffffff;
          --light: #f0eff3;
          --black: #000000;
          --dark-blue: #1f2029;
          --dark-light: #353746;
          --red: #da2c4d;
          --yellow: #f8ab37;
          --grey: #ecedf3;
      }

      .checkbox-tools:checked + label,
      .checkbox-tools:not(:checked) + label{
          position: relative;
          display: inline-block;
          padding: 10px 20px;
          /*width: 110px;*/
          font-size: 14px;
          line-height: 20px;
          letter-spacing: 1px;
          margin: 0 auto;
          text-align: center;
          border-radius: 4px;
          overflow: hidden;
          cursor: pointer;
          text-transform: uppercase;
          color: var(--white);
          -webkit-transition: all 300ms linear;
          transition: all 300ms linear;
      }
      .checkbox-tools:not(:checked) + label{
          background-color: var(--dark-light);
          box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
      }
      .checkbox-tools:checked + label{
          background-color: transparent;
          box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
      }
      .checkbox-tools:not(:checked) + label:hover{
          box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
      }
      .checkbox-tools:checked + label::before,
      .checkbox-tools:not(:checked) + label::before{
          position: absolute;
          content: '';
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          border-radius: 4px;
          background-image: linear-gradient(45deg, #303f9f, #1976D2);
          z-index: -1;
      }
      .checkbox-tools:checked + label .uil,
      .checkbox-tools:not(:checked) + label .uil{
          font-size: 24px;
          line-height: 24px;
          display: block;
          padding-bottom: 10px;
      }

      [type="checkbox"]:checked,
      [type="checkbox"]:not(:checked),
      [type="radio"]:checked,
      [type="radio"]:not(:checked){
          position: absolute;
          left: -9999px;
          width: 0;
          height: 0;
          visibility: hidden;
      }
      /*  .checkbox:checked + label,
        .checkbox:not(:checked) + label{
            position: relative;
            !*width: 70px;*!
            display: inline-block;
            padding: 0;
            margin: 0 auto;
            text-align: center;
            height: 6px;
            border-radius: 4px;
            !* background-image: linear-gradient(298deg, var(--red), var(--yellow));*!
            z-index: 100 !important;
        }
        .checkbox:checked + label:before,
        .checkbox:not(:checked) + label:before {
            display: block;
            position: absolute;
            font-family: 'unicons';
            cursor: pointer;
            top: -17px;
            z-index: 2;
            font-size: 20px;
            line-height: 40px;
            text-align: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            -webkit-transition: all 300ms linear;
            transition: all 300ms linear;
        }
        .checkbox:not(:checked) + label:before {
            content: '\eac1';
            left: 0;
            color: var(--grey);
            background-color: var(--dark-light);
            box-shadow: 0 4px 4px rgba(0,0,0,0.15), 0 0 0 1px rgba(26,53,71,0.07);
        }
        .checkbox:checked + label:before {
            content: '\eb8f';
            left: 30px;
            color: var(--yellow);
            background-color: var(--dark-blue);
            box-shadow: 0 4px 4px rgba(26,53,71,0.25), 0 0 0 1px rgba(26,53,71,0.07);
        }
    
        .checkbox:checked ~ .section .container .row .col-12 p{
            color: var(--dark-blue);
        }*/
      .dashboard-send-bonus-btn{
          /* background-image: linear-gradient(45deg, #303f9f, #1976D2);*/
      }
  </style>
@endsection

{{-- page content --}}
@section('content')
  <div class="section">

    <div id="chart-dashboard">
      
      <div id="card-stats" class="pt-0">
        <div class="row">
          <div class="col s12 m6 l6 xl3">
            <div class="card animate fadeLeft">
              <div class="card-content orange lighten-1 white-text">
                <p class="card-stats-title"><i class="material-icons">person_outline</i> @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='New accounts' contenteditable="true">{{ __('New accounts') }}</editor_block>
                  @else
                    {{ __('New accounts') }}
                  @endif</p>
                <h4 class="card-stats-number white-text">
                  <p class="no-margin" style="font-size: 14px">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='In 24 hours' contenteditable="true">{{ __('In 24 hours') }}</editor_block>
                    @else
                      {{ __('In 24 hours') }}
                    @endif:</p> {{ $users['today'] }}</h4>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Total' contenteditable="true">{{ __('Total') }}</editor_block>
                  @else
                    {{ __('Total acc') }}
                  @endif: {{ number_format($users['total'], 0, '.', ',') }}</p>
              </div>
              <div class="card-action orange">
                <div id="clients-bar" class="center-align"></div>
              </div>
            </div>
          
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card animate fadeLeft">
              <div class="card-content green lighten-1 white-text">
                <p class="card-stats-title"><i class="material-icons">attach_money</i>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Replenishment' contenteditable="true">{{ __('Replenishment') }}</editor_block>
                  @else
                    {{ __('Replenishment') }}
                  @endif</p>
                <h4 class="card-stats-number white-text">
                  <p class="no-margin" style="font-size: 14px">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='In 24 hours' contenteditable="true">{{ __('In 24 hours') }}</editor_block>
                    @else
                      {{ __('In 24 hours') }}
                    @endif:</p> ${{ number_format($enter_transactions_for_24h_sum, 0, '.', ',') }}
                </h4>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Total' contenteditable="true">{{ __('Total') }}</editor_block>
                  @else
                    {{ __('Total replenishment') }}
                  @endif: ${{ number_format($deposit_total_sum, 0, '.', ',') }}</p>
              </div>
              <div class="card-action green ">
                <div id="sales-compositebar" class="center-align"></div>
              </div>
            </div>
          
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card animate fadeRight">
              <div class="card-content red accent-2 white-text">
                <p class="card-stats-title"><i class="material-icons">attach_money</i> @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Withdrawals' contenteditable="true">{{ __('Withdrawals') }}</editor_block>
                  @else
                    {{ __('Withdrawals') }}
                  @endif</p>
                <h4 class="card-stats-number white-text">
                  <p class="no-margin" style="font-size: 14px">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='In 24 hours' contenteditable="true">{{ __('In 24 hours') }}</editor_block>
                    @else
                      {{ __('In 24 hours') }}
                    @endif:</p> {{ number_format($withdraw_transactions_for_24h_sum, 0, '.', ',') }}
                </h4>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Total' contenteditable="true">{{ __('Total') }}</editor_block>
                  @else
                    {{ __('Total withdrawals') }}
                  @endif: {{ number_format($deposit_total_withdraw, 0, '.', ',') }}</p>
              </div>
              <div class="card-action red">
                <div id="profit-tristate" class="center-align"></div>
              </div>
            </div>
          
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card animate fadeRight">
              <div class="card-content cyan  white-text">
                <p class="card-stats-title"><i class="material-icons">timeline</i> @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Profit' contenteditable="true">{{ __('Profit') }}</editor_block>
                  @else
                    {{ __('Profit') }}
                  @endif</p>
                <h4 class="card-stats-number white-text"><p class="no-margin" style="font-size: 14px">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='In 24 hours' contenteditable="true">{{ __('In 24 hours') }}</editor_block>
                    @else
                      {{ __('In 24 hours') }}
                    @endif:</p>
                  {{ $profit_transactions_for_24h_sum < 0 ? '-' : '' }}
                  ${{ number_format(abs($profit_transactions_for_24h_sum), 0, '.', ',') }}</h4>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Today' contenteditable="true">{{ __('Today') }}</editor_block>
                  @else
                    {{ __('Today') }}
                  @endif: {{$profit_transactions_for_today_sum < 0 ? '-' : ''}}
                  ${{number_format(abs($profit_transactions_for_today_sum), 0, '.', ',')}}</p>
              </div>
              <div class="card-action cyan darken-1">
                <div id="invoice-line" class="center-align"></div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    
      <div class="row mt-1">
        <div class="col s12 m8 l8">
          <div class="card animate fadeUp">
            <div class="card-move-up waves-effect waves-block waves-light">
              <div class="move-up cyan darken-1">
                <div>
                  <span class="chart-title white-text">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Statistics' contenteditable="true">{{ __('Statistics') }}</editor_block>
                    @else
                      {{ __('Statistics') }}
                    @endif</span>
                  <div class="chart-revenue cyan darken-2 white-text">
                    <p class="chart-revenue-total week">
                      ${{ $weeks_deposit_revenue  }}</p>
                    <p class="chart-revenue-total month display-none">
                      ${{ $month_deposit_revenue  }}</p>
                    <p class="chart-revenue-per week">
                      <i class="material-icons">@if($week_revenue_percent>=0) arrow_drop_up @else
                          arrow_drop_down @endif</i> {{ $week_revenue_percent ?? 0 }} %
                    </p>
                    <p class="chart-revenue-per month display-none">
                      <i class="material-icons">@if($month_revenue_percent>=0) arrow_drop_up @else
                          arrow_drop_down @endif</i> {{ $month_revenue_percent ?? 0 }} %
                    </p>
                  </div>
                  <div class="switch chart-revenue-switch right">
                    <label class="cyan-text text-lighten-5">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='A week' contenteditable="true">{{ __('A week') }}</editor_block>
                      @else
                        {{ __('A week') }}
                      @endif <input type="checkbox" class="chart-revenue-switch-input" />
                      <span class="lever"></span>
                        @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Month' contenteditable="true">{{ __('Month') }}</editor_block>
                        @else
                          {{ __('Month') }}
                        @endif
                    </label>
                  </div>
                </div>
                <div class="trending-line-chart-wrapper mt-3">
                  <canvas id="revenue-line-chart" height="61"></canvas>
                </div>
              </div>
            </div>
            <div class="card-content">
              <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                <i class="material-icons activator">filter_list</i>
              </a>
              <div class="col s12 m3 l3">
                <div id="doughnut-chart-wrapper">
                  <canvas id="doughnut-chart" height="200"></canvas>
                  <div class="doughnut-chart-status week">
                    <p class="center-align font-weight-600 mt-4">
                      ${{ $weeks_deposit_revenue ?? 0 }}</p>
                    <p class="ultra-small center-align">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Profit' contenteditable="true">{{ __('Profit') }}</editor_block>
                      @else
                        {{ __('Profit') }}
                      @endif</p>
                  </div>
                  <div class="doughnut-chart-status month display-none">
                    <p class="center-align font-weight-600 mt-4">
                      ${{ $month_deposit_revenue ?? 0 }}</p>
                    <p class="ultra-small center-align">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Profit' contenteditable="true">{{ __('Profit') }}</editor_block>
                      @else
                        {{ __('Profit') }}
                      @endif</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m2 l2">
                <ul class="doughnut-chart-legend">
                  <li class="kitchen ultra-small">
                    <span class="legend-color"></span>
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Replenished' contenteditable="true">{{ __('Replenished') }}</editor_block>
                    @else
                      {{ __('Replenished') }}
                    @endif
                  </li>
                  <li class="mobile ultra-small">
                    <span class="legend-color"></span>
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Withdrawn' contenteditable="true">{{ __('Withdrawn') }}</editor_block>
                    @else
                      {{ __('Withdrawn') }}
                    @endif
                  </li>
                </ul>
              </div>
              <div class="col s12 m5 l6">
                <div class="trending-bar-chart-wrapper">
                  <canvas id="trending-bar-chart" height="90"></canvas>
                </div>
              </div>
            </div>
            <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Monthly income' contenteditable="true">{{ __('Monthly income') }}</editor_block>
                    @else
                      {{ __('Monthly income') }}
                    @endif <i
                        class="material-icons right">close</i>
                  </span>
              <table class="responsive-table">
                <thead>
                  <tr>
                    <th data-field="">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='id' contenteditable="true">{{ __('id') }}</editor_block>
                      @else
                        {{ __('id') }}
                        @endif</th>
                    <th data-field="">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Date' contenteditable="true">{{ __('Date') }}</editor_block>
                      @else
                        {{ __('Date') }}
                      @endif</th>
                    <th data-field="">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Replenished' contenteditable="true">{{ __('Replenished') }}</editor_block>
                      @else
                        {{ __('Replenished') }}
                      @endif</th>
                    <th data-field="">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Withdrawn' contenteditable="true">{{ __('Withdrawn') }}</editor_block>
                      @else
                        {{ __('Withdrawn') }}
                      @endif</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($month_period as $key => $item)
                    <tr>
                      <td>{{ $loop->index }}</td>
                      <td>{{ $item['start']->format('d M') . '-' . $item['end']->format('d M') }}</td>
                      <td>
                        $ {{ number_format($month_period_enter_transactions[$item['start']->format('d M') . '-' . $item['end']->format('d M')], 2, ',', '.') ?? 0 }}</td>
                      <td>
                        $ {{ number_format($month_period_withdraw_transactions[$item['start']->format('d M') . '-' . $item['end']->format('d M')], 2, ',', '.') ?? 0 }}</td>
                    </tr>
                  @empty
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l4">
          <div class="card animate fadeUp">
            <div class="card-move-up teal accent-4 waves-effect waves-block waves-light">
              <div class="move-up">
                <p class="margin white-text">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Popularity by country' contenteditable="true">{{ __('Popularity by country') }}</editor_block>
                  @else
                    {{ __('Popularity by country') }}
                  @endif</p>
                <canvas id="trending-radar-chart" height="114"></canvas>
              </div>
            </div>
            <div class="card-content  teal">
              <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                <i class="material-icons activator">done</i>
              </a>
              <div class="line-chart-wrapper">
                <p class="margin white-text">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Popularity by city' contenteditable="true">{{ __('Popularity by city') }}</editor_block>
                  @else
                    {{ __('Popularity by city') }}
                  @endif</p>
                <canvas id="line-chart" height="113"></canvas>
              </div>
            </div>
            <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Popularity by country' contenteditable="true">{{ __('Popularity by country') }}</editor_block>
                    @else
                      {{ __('Popularity by country') }}
                    @endif <i class="material-icons right">close</i>
                  </span>
              <table class="responsive-table ">
                <thead>
                  <tr>
                    <th data-field="country-name">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Country' contenteditable="true">{{ __('Country') }}</editor_block>
                      @else
                        {{ __('Country') }}
                      @endif</th>
                    <th data-field="item-sold">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Number of users' contenteditable="true">{{ __('Number of users') }}</editor_block>
                      @else
                        {{ __('Number of users') }}
                      @endif</th>
                    <th data-field="total-profit">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Invested, $' contenteditable="true">{{ __('Invested, $') }}</editor_block>
                      @else
                        {{ __('Invested, $') }}
                      @endif</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($countries_stat as $item)
                    <tr>
                      <td>{{ $item->name ?? '' }}</td>
                      <td>{{ $item->count ?? '' }}</td>
                      <td>${{ $item->invested ?? '' }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="3" style="text-align: center">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Empty' contenteditable="true">{{ __('Empty') }}</editor_block>
                        @else
                          {{ __('Empty') }}
                        @endif</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
                  <span class="card-title grey-text text-darken-4 mt-3">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Popularity by Browser' contenteditable="true">{{ __('Popularity by Browser') }}</editor_block>
                    @else
                      {{ __('Popularity by Browser') }}
                    @endif</span>
              <table class="responsive-table ">
                <thead>
                  <tr>
                    <th data-field="country-name">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Browser' contenteditable="true">{{ __('Browser') }}</editor_block>
                      @else
                        {{ __('Browser') }}
                      @endif</th>
                    <th data-field="item-sold">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Number of users' contenteditable="true">{{ __('Number of users') }}</editor_block>
                      @else
                        {{ __('Number of users') }}
                      @endif</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($device_stat as $item)
                    <tr>
                      <td width="50%">{{ $item->browser ?? '' }}</td>
                      <td width="50%">{{ $item->count ?? '' }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="2" style="text-align: center">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Empty' contenteditable="true">{{ __('Empty') }}</editor_block>
                        @else
                          {{ __('Empty') }}
                        @endif</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  
   
    <div class="row">
      <div class="col s12 m12 l12">
        <div class="row">
          <div class="col-12">
            <div class="card-content">
              <h4 class="card-title mt-2 mb-1" style="text-align: center">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Accrue bonus' contenteditable="true">{{ __('Accrue bonus') }}</editor_block>
                @else
                  {{ __('Accrue bonus') }}
                @endif</h4>
              <form method="post" class="dashboard-send-bonus-form" action="{{ route('dashboard.add_bonus') }}">
                {{ csrf_field() }}
                
                <div class="row" style="text-align: center; margin-top:20px;">
                  <div class="col-12">
                    <input class="checkbox-tools" name="type" value="enter" type="radio" {{ old('type', 'enter') == 'enter' ? 'checked' : '' }} id="enter">
                    <label class="for-checkbox-tools" for="enter">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Depositing funds into the system' contenteditable="true">{{ __('Depositing funds into the system') }}</editor_block>
                      @else
                        {{ __('Depositing funds into the system') }}
                      @endif</label>
                    <input class="checkbox-tools" name="type" value="withdraw" type="radio"  id="withdraw" {{ old('type') == 'withdraw' ? 'checked' : '' }}>
                    <label class="for-checkbox-tools" for="withdraw">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Withdraw funds' contenteditable="true">{{ __('Withdraw funds') }}</editor_block>
                      @else
                        {{ __('Withdraw funds') }}
                      @endif</label>
                  </div>
                </div>
                
                <div class="row" style="text-align: center; margin-top:20px;">
                  <div class="col-12 ">
                    @foreach($currencies as $currency)
                      @if($loop->index % 7 == 0 && $loop->index > 1)
                        <br>
                      @endif
                        <input class="checkbox-tools" value="{{ $currency->id }}" type="radio" {{ old('currency', $currencies[0]->id ?? '') == $currency->id ? 'checked' : '' }}  name="currency" id="currency-{{ $currency->id }}">
                        <label class="for-checkbox-tools" for="currency-{{ $currency->id }}">
                          {{ $currency->code }}
                        </label>
                    @endforeach
                   
                  </div>
                </div>
 
                
                <div class="row" style="margin-top:20px; text-align: center;">
                  @foreach($payment_system as $ps)
                    <input class="checkbox-tools" name="payment_system" value="{{ $ps->id }}" type="radio" id="payment_system-{{ $ps->id }}" {{ old('payment_system', $payment_system[0]->id ?? '') == $ps->id ? 'checked' : '' }}>
                    <label class="for-checkbox-tools" for="payment_system-{{ $ps->id }}">
                      {{ $ps->name }}
                    </label>
                  @endforeach
                </div>
                
                
                <div class="row" style="margin-top:20px; text-align: center;">
                  <div class="col-12">
                  <input class="checkbox-tools" name="is_real" value="1" type="radio" id="is_real1" {{ old('is_real', '1') == '1' ? 'checked' : '' }}>
                  <label class="for-checkbox-tools" for="is_real1">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Real' contenteditable="true">{{ __('Real') }}</editor_block>
                    @else
                      {{ __('Real') }}
                    @endif</label>
                  <input class="checkbox-tools" name="is_real" value="0" type="radio" id="is_real0" {{ old('is_real') == '0' ? 'checked' : '' }} >
                  <label class="for-checkbox-tools" for="is_real0">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Fake' contenteditable="true">{{ __('Fake') }}</editor_block>
                    @else
                      {{ __('Fake') }}
                    @endif</label>
                  </div>
                </div>
  
                <div class="row" style=" text-align: center;">
                  <div class="input-field col s12 text-center">
                    <div >
                      <input id="login" type="text" name="login"
                          placeholder="{{ __('Login, email or id') }}" value="{{ old('login') }}"
                          style="font-weight: bold; text-align: center;width: 320px;">
                    </div>
                  </div>
                </div>
                <div class="row" style=" text-align: center;">
                  <div class="input-field col s12">
                    <div class="text-center">
                      <input id="amount" type="text" name="amount" placeholder="{{ __('Amount') }}" value="{{ old('amount') }}"
                          style="font-weight: 500; text-align: center; width: 320px;">
                    </div>
                  </div>
                </div>
                
                
                <div class="row" style="text-align: center;">
                  <div class="input-field col s12" style="text-align:center;">
                    <button class="btn red accent-2 shadow waves-effect waves-light dashboard-send-bonus-btn" type="submit" name="action" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Send bonus' contenteditable="true">{{ __('Send bonus') }}</editor_block>
                      @else
                        {{ __('Send bonus') }}
                      @endif<i class="material-icons right">attach_money</i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col s12 m12 l12 dashboard-operations-wrapper">
            <div class="switch dashboard-operations-switch right">
              <label class="grey-text darken-4">
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Statistics' contenteditable="true">{{ __('Statistics') }}</editor_block>
                @else
                  {{ __('Statistics') }}
                @endif <input type="checkbox" class="dashboard-operations-switch-input">
                <span class="lever"></span>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Recent transactions' contenteditable="true">{{ __('Recent transactions') }}</editor_block>
                  @else
                    {{ __('Recent transactions') }}
                  @endif
              </label>
            </div>
            
            <div id="stats-block" class="card card card-default animate fadeUp scrollspy ">
              <div class="card-content">
                <h4 class="card-title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Statistics' contenteditable="true">{{ __('Statistics') }}</editor_block>
                  @else
                    {{ __('Statistics') }}
                  @endif</h4>
                <p class="mb-2"></p>
                <div class="row">
                  <div class="col s12">
                  </div>
                  <div class="col s12">
                    <table class="striped">
                      <thead>
                        <tr>
                          <th data-field="name">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='System' contenteditable="true">{{ __('System') }}</editor_block>
                            @else
                              {{ __('System') }}
                            @endif</th>
                          <th data-field="plus">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Replenishment' contenteditable="true">{{ __('Replenishment') }}</editor_block>
                            @else
                              {{ __('Replenishment') }}
                            @endif</th>
                          <th data-field="minus">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Payouts' contenteditable="true">{{ __('Payouts') }}</editor_block>
                            @else
                              {{ __('Payouts') }}
                            @endif</th>
                          <th data-field="sum">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Sum' contenteditable="true">{{ __('Sum') }}</editor_block>
                            @else
                              {{ __('Sum') }}
                            @endif</th>
                          <th data-field="percent">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='In percents' contenteditable="true">{{ __('In percents') }}</editor_block>
                            @else
                              {{ __('In percents') }}
                            @endif</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($payment_system as $item)
                          <tr>
                            <td>{{ $item->name }}</td>
                            <td class="green-text">
                                                    <span
                                                        style="font-weight: 900;">$</span>{{ number_format(round($item->transaction_sum, 2), 2, '.',' ') ?? 0 }}
                            </td>
                            <td class="red-text">
                                                    <span
                                                        style="font-weight: 900;">$</span>{{ number_format(round($item->transaction_minus, 2), 2, '.',' ') ?? 0 }}
                            </td>
                            <td class="blue-grey-text">
                                                    <span
                                                        style="font-weight: 900;">$</span>{{ number_format(round($item->transaction_sum - $item->transaction_minus, 2), 2, '.',' ') ?? 0}}
                            </td>
                            <td>@if($item->transaction_sum)
                                {{ number_format(round( (($item->transaction_sum - $item->transaction_minus) / $item->transaction_sum) * 100, 2), 2, '.',' ')  ?? 0 }}
                              @else
                                0
                              @endif
                              %
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="3" style="text-align: center">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Empty' contenteditable="true">{{ __('Empty') }}</editor_block>
                              @else
                                {{ __('Empty') }}
                              @endif</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              {{--                    </div>--}}
            </div>
            <div id="last-operations-block" class="card subscriber-list-card animate fadeUp display-none">
              <div class="card-content pb-1">
                <h4 class="card-title mb-0">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Recent transactions' contenteditable="true">{{ __('Recent transactions') }}</editor_block>
                  @else
                    {{ __('Recent transactions') }}
                  @endif</h4>
              </div>
              <table class="subscription-table responsive-table highlight">
                <thead>
                  <tr>
                    <th>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='User' contenteditable="true">{{ __('User') }}</editor_block>
                      @else
                        {{ __('User') }}
                      @endif</th>
                    <th>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Type of' contenteditable="true">{{ __('Type of') }}</editor_block>
                      @else
                        {{ __('Type of') }}
                      @endif</th>
                    <th>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Sum' contenteditable="true">{{ __('Sum') }}</editor_block>
                      @else
                        {{ __('Sum') }}
                      @endif</th>
                    <th>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block>
                      @else
                        {{ __('Payment system') }}
                      @endif</th>
                    <th>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Date of operation' contenteditable="true">{{ __('Date of operation') }}</editor_block>
                      @else
                        {{ __('Date of operation') }}
                      @endif</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($last_operations) && !empty($last_operations))
                    @foreach($last_operations as $operation)
                      <tr>
                        <td>{{ Str::limit( $operation->user->name, 13) ?? 'Не указано' }}</td>
                        <td>{{ __('locale.' . $operation->type->name) ?? 'Не указано' }}</td>
                        <td>
                                        <span
                                            class="badge  green-text  lighten-5 text-accent-4">$ {{ number_format($operation->main_currency_amount, 2, '.', ',') ?? 0 }}</span>
                        </td>
                        <td>{{ $operation->paymentSystem->name ?? 'Не указано' }}</td>
                        <td>{{ $operation->created_at->format('d-m-Y H:i') }}</td>
                        <td class="center-align">
                          <a href="{{ route('transactions.show', $operation->id) }}">Open</a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="col s12 m12 l12">
            <div id="striped-table" class="card card card-default scrollspy">
              <div class="card-content">
                <h4 class="card-title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Admin Login History' contenteditable="true">{{ __('Admin Login History') }}</editor_block>
                  @else
                    {{ __('Admin Login History') }}
                  @endif</h4>
                <p class="mb-2"></p>
                <div class="row">
                  <div class="col s12">
                  </div>
                  <div class="col s12">
                    <table class="striped">
                      <thead>
                        <tr>
                          <th data-field="id">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='User' contenteditable="true">{{ __('User') }}</editor_block>
                            @else
                              {{ __('User') }}
                            @endif</th>
                          <th data-field="name">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='ip' contenteditable="true">{{ __('ip') }}</editor_block>
                            @else
                              {{ __('ip') }}
                            @endif</th>
                          <th data-field="price">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Date' contenteditable="true">{{ __('Date') }}</editor_block>
                            @else
                              {{ __('Date') }}
                            @endif</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($user_auth_logs as $item)
                          <tr>
                            <td><b>@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Name' contenteditable="true">{{ __('Name') }}</editor_block>
                                @else
                                  {{ __('Name') }}
                                @endif: </b>{{ $item->user->name ?? '' }}
                              <br><b>@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Login' contenteditable="true">{{ __('Login') }}</editor_block>
                                @else
                                  {{ __('Login') }}
                                @endif: </b>{{ $item->user->login ?? '' }}</td>
                            <td>{{ $item->ip ?? '' }}</td>
                            <td>{{ $item->created_at->format('d.m.Y H:i:s') ?? '' }}</td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="3" style="text-align: center">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Empty' contenteditable="true">{{ __('Empty') }}</editor_block>
                              @else
                                {{ __('Empty') }}
                              @endif</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              {{--                    </div>--}}
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="row">
      <div class="col s12 m12 l8">
      
      </div>
      <div class="col s12 m12 l12">
        <div class="row">
          <div class="col s12 m12">
            <div class="card">
              @if(session()->has('success'))
                <div class="card-alert card green mb-0">
                  <div class="card-content white-text">
                                  <span class="card-title white-text darken-1 mb-0">
                                    <i class="material-icons">notifications</i> @lang(session()->get('success'))</span>
                  </div>
                  <button type="button" class="close white-text" data-dismiss="alert"
                      aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              @endif
              @if(session()->has('error'))
                <div class="card-alert card red mb-0">
                  <div class="card-content white-text">
                                  <span class="card-title white-text darken-1 mb-0">
                                    <i class="material-icons">notifications</i> @lang(session()->get('error'))</span>
                  </div>
                  <button type="button" class="close white-text" data-dismiss="alert"
                      aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              @endif
              @if ($errors->any())
                <div class="card-alert card red lighten-2 mb-0">
                  <div class="card-content text-white">
                                     <span class="card-title white-text darken-1 mb-0">
                                    <i class="material-icons">notifications</i> {{ __("Error") }}</span>
                    @foreach ($errors->all() as $error)
                      <p class="white-text darken-5">{{ $error }}</p>
                    @endforeach
                  </div>
                  <button type="button" class="close white-text" data-dismiss="alert"
                      aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              @endif
            
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/sparkline/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('vendors/chartjs/chart.min.js')}}"></script>
  <script src="{{asset('vendors/chartist-js/chartist.min.js')}}"></script>
  <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
  <script src="{{asset('vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>
  <script src="{{asset('vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
  <script>
  
  </script>
  {{--  <script src="{{asset('js/scripts/dashboard-modern.js')}}"></script>--}}
  {{--  <script src="{{asset('js/scripts/intro.js')}}"></script>--}}
  <script src="{{ asset('js/scripts/ui-alerts.js') }}"></script>
  {{--  <script src="{{ asset('admin/js/scripts/dashboard-analytics.js') }}"></script>--}}
  <script>
    (function (window, document, $) {
      
      $("#task-card input:checkbox").change(function () {
        $.ajax({
          url: '/tasks/update/' + $(this).attr('id'),
          method: 'post',
          data: {
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success: (response) => {
            M.toast({
              html: response.message,
              classes: response.success ? 'green' : 'red'
            })
            if (response.success) {
              checkbox_check(this);
            }
          }
        })
      });
      
      // Check Uncheck function
      function checkbox_check(el) {
        if (!$(el).is(":checked")) {
          $(el)
          .next()
          .css("text-decoration", "none"); // or addClass
        } else {
          $(el)
          .next()
          .css("text-decoration", "line-through"); //or addClass
        }
      }
      
      $("#task-card input:checkbox").each(function () {
        checkbox_check(this);
      });
      
      var revenueLineChartCTX = $("#revenue-line-chart");
      var revenueLineChartOptions = {
        responsive: true,
        // maintainAspectRatio: false,
        legend: {
          display: false
        },
        hover: {
          mode: "label"
        },
        scales: {
          xAxes: [
            {
              display: true,
              gridLines: {
                display: false
              },
              ticks: {
                fontColor: "#fff"
              }
            }
          ],
          yAxes: [
            {
              display: true,
              fontColor: "#fff",
              gridLines: {
                display: true,
                color: "rgba(255,255,255,0.3)"
              },
              ticks: {
                beginAtZero: false,
                fontColor: "#fff",
                callback: function (value) {
                  if (value % 1 === 0 && value >= 0) {
                    return value;
                  }
                }
              }
            }
          ]
        }
      };
      
      var revenueLineChartDataWeek = {
        labels: [@foreach($weeks_period as $key => $item)"{{ $item['start']->format('d M') }}",@endforeach],
        datasets: [
          {
            label: "Deposit",
            data: [@foreach($weeks_period_enter_transactions as $key => $item){{ $item }},@endforeach],
            //data: [150, 50, 20, 40, 80, 50, 80],
            backgroundColor: "rgba(128, 222, 234, 0.6)",
            borderColor: "#d1faff",
            pointBorderColor: "#d1faff",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "#d1faff",
            pointHoverBackgroundColor: "#d1faff",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          },
          {
            label: "Withdraw",
            data: [@foreach($weeks_period_withdraw_transactions as $key => $item){{ $item }},@endforeach],
            borderDash: [15, 5],
            backgroundColor: "rgba(128, 222, 234, 0.2)",
            borderColor: "#80deea",
            pointBorderColor: "#80deea",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "#80deea",
            pointHoverBackgroundColor: "#80deea",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          }
        ]
      };
      var revenueLineChartDataMonth = {
        labels: [@foreach($month_period as $key => $item)"{{ $item['start']->format('d M') .'-'.$item['end']->format('d M') }}",@endforeach],
        datasets: [
          {
            label: "Deposit",
            data: [@foreach($month_period_enter_transactions as $key => $item){{ $item }},@endforeach],
            //data: [150, 50, 20, 40, 80, 50, 80],
            backgroundColor: "rgba(128, 222, 234, 0.6)",
            borderColor: "#d1faff",
            pointBorderColor: "#d1faff",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "#d1faff",
            pointHoverBackgroundColor: "#d1faff",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          },
          {
            label: "Withdraw",
            data: [@foreach($month_period_withdraw_transactions as $key => $item){{ $item }},@endforeach],
            borderDash: [15, 5],
            backgroundColor: "rgba(128, 222, 234, 0.2)",
            borderColor: "#80deea",
            pointBorderColor: "#80deea",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "#80deea",
            pointHoverBackgroundColor: "#80deea",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          }
        ]
      };
      
      var revenueLineChartConfigWeek = {
        type: "line",
        options: revenueLineChartOptions,
        data: revenueLineChartDataWeek
      };
      var revenueLineChartConfigMonth = {
        type: "line",
        options: revenueLineChartOptions,
        data: revenueLineChartDataMonth
      };
      
      /*
   Doughnut Chart Widget
   */
      
      var totalRevenueChartCTX = $("#doughnut-chart");
      var totalRevenueChartOptions = {
        cutoutPercentage: 70,
        legend: {
          display: false
        },
      };
      var totalRevenueChartDataWeek = {
        labels: ["Пополнено", "Выведено"],
        datasets: [
          {
            label: "Sales",
            data: [{{ $weeks_total_enter ?? 0 }}, {{ $weeks_total_withdraw ?? 0 }}],
            backgroundColor: ["#46BFBD", "#f7464a"]
          }
        ]
      };
      var totalRevenueChartDataMonth = {
        labels: ["Пополнено", "Выведено"],
        datasets: [
          {
            label: "Sales",
            data: [{{ $month_total_enter ?? 0 }}, {{ $month_total_withdraw ?? 0 }}],
            backgroundColor: ["#46BFBD", "#f7464a"]
          }
        ]
      };
      
      var totalRevenueChartConfigWeek = {
        type: "doughnut",
        options: totalRevenueChartOptions,
        data: totalRevenueChartDataWeek
      };
      var totalRevenueChartConfigMonth = {
        type: "doughnut",
        options: totalRevenueChartOptions,
        data: totalRevenueChartDataMonth
      };
      
      
      var monthlyRevenueChartCTX = $("#trending-bar-chart");
      var monthlyRevenueChartOptions = {
        responsive: true,
        // maintainAspectRatio: false,
        legend: {
          display: false
        },
        hover: {
          mode: "label"
        },
        scales: {
          xAxes: [
            {
              display: true,
              gridLines: {
                display: false
              }
            }
          ],
          yAxes: [
            {
              display: true,
              fontColor: "#fff",
              gridLines: {
                display: false
              },
              ticks: {
                beginAtZero: true,
                callback: function (value) {
                  if (value % 1 === 0 && value >= 0) {
                    return value;
                  }
                }
              }
            }
          ]
        },
        tooltips: {
          titleFontSize: 0,
          callbacks: {
            label: function (tooltipItem, data) {
              return tooltipItem.yLabel;
            }
          }
        }
      };
      var monthlyRevenueChartDataWeek = {
        labels: [@foreach($weeks_period as $key => $item)"{{ $item['start']->format('d M') }}",@endforeach],
        //labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept"],
        datasets: [
          {
            label: "Внесено",
            //data: [6, 9, 8, 4, 6, 7, 9, 4, 8],
            data: [@foreach($weeks_period_enter_transactions as $key => $item){{ $item }},@endforeach],
            backgroundColor: "#46BFBD",
            hoverBackgroundColor: "#009688"
          }
        ]
      };
      var monthlyRevenueChartDataMonth = {
        labels: [@foreach($month_period as $key => $item)"{{ $item['start']->format('d M') .'-'.$item['end']->format('d M') }}",@endforeach],
        //labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept"],
        datasets: [
          {
            label: "Внесено",
            data: [@foreach($month_period_enter_transactions as $key => $item){{ $item }},@endforeach],
            backgroundColor: "#46BFBD",
            hoverBackgroundColor: "#009688"
          }
        ]
      };
      
      var monthlyRevenueChartConfigWeek = {
        type: "bar",
        options: monthlyRevenueChartOptions,
        data: monthlyRevenueChartDataWeek
      };
      var monthlyRevenueChartConfigMonth = {
        type: "bar",
        options: monthlyRevenueChartOptions,
        data: monthlyRevenueChartDataMonth
      };
      
      
      var countryStatsChartCTX = $("#trending-radar-chart");
      var countryStatsChartOptions = {
        responsive: true,
        // maintainAspectRatio: false,
        legend: {
          display: false
        },
        hover: {
          mode: "label"
        },
        scale: {
          angleLines: {color: "rgba(255,255,255,0.4)"},
          gridLines: {color: "rgba(255,255,255,0.2)"},
          ticks: {
            display: false
          },
          pointLabels: {
            fontColor: "#fff"
          }
        }
      };
      var countryStatsChartData = {
        labels: [@forelse($countries_stat as $country)"{{ $country->name }}"@if(!$loop->last), @endif @empty "Пусто" @endforelse],
        datasets: [
          {
            label: "Count",
            data: [@forelse($countries_stat as $country)"{{ intval($country->count) }}"@if(!$loop->last), @endif @empty "Пусто" @endforelse],
            fill: true,
            fillColor: "rgba(255,255,255,0.2)",
            borderColor: "#fff",
            pointBorderColor: "#fff",
            pointBackgroundColor: "#00bfa5",
            pointHighlightFill: "#fff",
            pointHoverBackgroundColor: "#fff",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            
          }
        ]
      };
      var countryStatsChartConfig = {
        type: "radar",
        options: countryStatsChartOptions,
        data: countryStatsChartData
      };
      
      var cityStatsChartCTX = $("#line-chart");
      var cityStatsChartOption = {
        responsive: true,
        // maintainAspectRatio: false,
        legend: {
          display: false
        },
        hover: {
          mode: "label"
        },
        scales: {
          xAxes: [
            {
              display: true,
              gridLines: {
                display: false
              },
              ticks: {
                fontColor: "#fff"
              }
            }
          ],
          yAxes: [
            {
              display: true,
              fontColor: "#fff",
              gridLines: {
                display: false
              },
              ticks: {
                beginAtZero: false,
                fontColor: "#fff",
                callback: function (value) {
                  if (Number.isInteger(value)) {
                    return value;
                  }
                },
              }
            }
          ]
        }
      };
      var cityStatsChartData = {
        labels: [@forelse($cities_stat as $country)"{{ $country->name }}"@if(!$loop->last), @endif @empty "Пусто" @endforelse],
        datasets: [
          {
            label: "Users",
            data: [@forelse($cities_stat as $country)"{{ $country->count }}"@if(!$loop->last), @endif @empty "Пусто" @endforelse],
            fill: false,
            lineTension: 0,
            borderColor: "#fff",
            pointBorderColor: "#fff",
            pointBackgroundColor: "#009688",
            pointHighlightFill: "#fff",
            pointHoverBackgroundColor: "#fff",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          }
        ]
      };
      var cityStatsChartConfig = {
        type: "line",
        options: cityStatsChartOption,
        data: cityStatsChartData
      };
      
      window.onload = function () {
        
        var revenueLineChart = new Chart(revenueLineChartCTX, revenueLineChartConfigWeek);
        var monthlyRevenueChart = new Chart(monthlyRevenueChartCTX, monthlyRevenueChartConfigWeek);
        var totalRevenueChart = new Chart(totalRevenueChartCTX, totalRevenueChartConfigWeek);
        var countryStatsChart = new Chart(countryStatsChartCTX, countryStatsChartConfig);
        var cityStatsChart = new Chart(cityStatsChartCTX, cityStatsChartConfig);
        
        
        document.querySelector('.chart-revenue-switch-input').addEventListener('change', function (e) {
          
          if (typeof revenueLineChart != "undefined") {
            if (this.checked == true) {
              revenueLineChart.config = revenueLineChartConfigMonth;
              revenueLineChart.update();
            } else {
              revenueLineChart.config = revenueLineChartConfigWeek;
              revenueLineChart.update();
            }
          }
          if (typeof monthlyRevenueChart != "undefined") {
            if (this.checked == true) {
              monthlyRevenueChart.config = monthlyRevenueChartConfigMonth;
              monthlyRevenueChart.update();
            } else {
              monthlyRevenueChart.config = monthlyRevenueChartConfigWeek;
              monthlyRevenueChart.update();
            }
          }
          if (typeof totalRevenueChart != "undefined") {
            if (this.checked == true) {
              totalRevenueChart.config = totalRevenueChartConfigMonth;
              totalRevenueChart.update();
              document.querySelector('.doughnut-chart-status.month').classList.remove('display-none');
              document.querySelector('.doughnut-chart-status.week').classList.add('display-none');
              
              document.querySelector('.chart-revenue-total.month').classList.remove('display-none');
              document.querySelector('.chart-revenue-total.week').classList.add('display-none');
              document.querySelector('.chart-revenue-per.month').classList.remove('display-none');
              document.querySelector('.chart-revenue-per.week').classList.add('display-none');
            } else {
              totalRevenueChart.config = totalRevenueChartConfigWeek;
              totalRevenueChart.update();
              document.querySelector('.doughnut-chart-status.month').classList.add('display-none');
              document.querySelector('.doughnut-chart-status.week').classList.remove('display-none');
              
              document.querySelector('.chart-revenue-total.month').classList.add('display-none');
              document.querySelector('.chart-revenue-total.week').classList.remove('display-none');
              document.querySelector('.chart-revenue-per.month').classList.add('display-none');
              document.querySelector('.chart-revenue-per.week').classList.remove('display-none');
            }
          }
        });
      };
      
    })(window, document, jQuery);
  
  </script>
  <script>
    $(document).ready(function () {
      $(".dashboard-send-bonus-btn").on('click', function (e) {
        e.preventDefault();
        swal({
          title: "Вы уверены?",
          text: "Пользователю будет начислен бонус!",
          icon: 'warning',
          buttons: {
            cancel: true,
            delete: 'Выполнить операцию?'
          }
        }).then(function (willDelete) {
          if (willDelete) {
            $(".dashboard-send-bonus-form").submit();
          }
        });
      });
      
      $("#clients-bar").sparkline(@json($usersCountPeriod), {
        type: "bar",
        height: "25",
        barWidth: 7,
        barSpacing: 4,
        barColor: "#b2ebf2",
        negBarColor: "#81d4fa",
        zeroColor: "#81d4fa"
      });
      
      $("#sales-compositebar").sparkline(@json($enterTransactionsPeriod), {
        type: "bar",
        barColor: "#F6CAFD",
        height: "25",
        width: "100%",
        barWidth: "7",
        barSpacing: 4
      });
      //Total Sales - Line
      $("#sales-compositebar").sparkline(@json($enterTransactionsPeriod), {
        type: "line",
        width: "100%",
        lineWidth: 2,
        lineColor: "#fff3e0",
        fillColor: "rgba(255, 82, 82, 0.25)",
        highlightSpotColor: "#fff3e0",
        highlightLineColor: "#fff3e0",
        minSpotColor: "#00bcd4",
        maxSpotColor: "#00e676",
        spotColor: "#fff3e0",
        spotRadius: 4
      });
      
      $("#profit-tristate").sparkline(@json($withdrawalsPeriod), {
        type: "bar",
        height: "25",
        barWidth: 7,
        barSpacing: 4,
        barColor: "#f2e3b2",
        negBarColor: "#fae681",
        zeroColor: "#fade81"
      });
      
      $("#invoice-line").sparkline(@json($profitPeriod), {
        type: "line",
        width: "100%",
        height: "25",
        lineWidth: 2,
        lineColor: "#E1D0FF",
        fillColor: "rgba(255, 255, 255, 0.2)",
        highlightSpotColor: "#E1D0FF",
        highlightLineColor: "#E1D0FF",
        minSpotColor: "#00bcd4",
        maxSpotColor: "#fade81",
        spotColor: "#E1D0FF",
        spotRadius: 4
      });
    });
  </script>
  <script>
    //stats-block
    //last-operations-block
    $(".dashboard-operations-switch-input").on('change', function (e) {
      e.preventDefault();
      if ($(this).prop('checked')) {
        $("#stats-block").addClass('display-none');
        $("#last-operations-block").removeClass('display-none');
      } else {
        $("#stats-block").removeClass('display-none');
        $("#last-operations-block").addClass('display-none');
      }
    });
  </script>
  <script>
    $(document).ready(function (){
      $(".for-checkbox-tools").on('click', function () {
      
      });
    });
  </script>
@endsection
