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
@endsection

{{-- page content --}}
@section('content')
  <div class="section">
    
    <div id="chart-dashboard">
      
      <div id="card-stats" class="pt-0">
        <div class="row">
          <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft" style="height: 156.05px">
              <div class="padding-4">
                <div class="row">
                  <div class="col s7 m5">
                    <i class="material-icons background-round mt-5">perm_identity</i>
                    <p>Аккаунты</p>
                  </div>
                  <div class="col s5 m7 right-align">
                    <h5 class="mb-0 white-text">{{$users['today']}}</h5>
                    <p class="no-margin">За 24 часа</p>
                    <p>Итого: {{number_format($users['total'], 0, '.', ',')}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeLeft" style="height: 156.05px">
              <div class="padding-4">
                <div class="row">
                  <div class="col s7 m5">
                    <i class="material-icons background-round mt-5">attach_money</i>
                    <p>Пополнения</p>
                  </div>
                  <div class="col s5 m7 right-align">
                    <h5 class="mb-0 white-text">${{number_format($enter_transactions_for_24h_sum, 0, '.', ',')}}</h5>
                    <p class="no-margin">За 24 часа</p>
                    <p>Итого: ${{number_format($deposit_total_sum, 0, '.', ',')}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeRight" style="height: 156.05px">
              <div class="padding-4">
                <div class="row">
                  <div class="col s7 m5">
                    <i class="material-icons background-round mt-5">attach_money</i>
                    <p>Выводы</p>
                  </div>
                  <div class="col s5 m7 right-align">
                    <h5 class="mb-0 white-text">${{number_format($withdraw_transactions_for_24h_sum, 0, '.', ',')}}</h5>
                    <p class="no-margin">За 24 часа</p>
                    <p>Итого: ${{number_format($deposit_total_withdraw, 0, '.', ',')}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight" style="height: 156.05px">
              <div class="padding-4">
                <div class="row">
                  <div class="col s7 m5">
                    <i class="material-icons background-round mt-5">timeline</i>
                    <p>Прибыль</p>
                  </div>
                  <div class="col s5 m7 right-align">
                    <h5 class="mb-0 white-text">{{$profit_transactions_for_24h_sum < 0 ? '-' : ''}} ${{number_format(abs($profit_transactions_for_24h_sum), 0, '.', ',')}}</h5>
                    <p class="no-margin">За 24 часа</p>
                    <p>Сегодня: {{$profit_transactions_for_today_sum < 0 ? '-' : ''}} ${{number_format(abs($profit_transactions_for_today_sum), 0, '.', ',')}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row mt-2">
        <div class="col s12 m8 l8">
          <div class="card animate fadeUp">
            <div class="card-move-up waves-effect waves-block waves-light">
              <div class="move-up cyan darken-1">
                <div>
                  <span class="chart-title white-text">Статистика</span>
                  <div class="chart-revenue cyan darken-2 white-text">
                    <p class="chart-revenue-total week">${{ number_format($weeks_deposit_revenue,2)  }}</p>
                    <p class="chart-revenue-total month display-none">${{ number_format($month_deposit_revenue,2)  }}</p>
                    <!--                    <p class="chart-revenue-per"><i class="material-icons">arrow_drop_up</i> 21.80 %</p>-->
                  </div>
                  <div class="switch chart-revenue-switch right">
                    <label class="cyan-text text-lighten-5">
                      Неделя <input type="checkbox" class="chart-revenue-switch-input" />
                      <span class="lever"></span>
                      Месяц
                    </label>
                  </div>
                </div>
                <div class="trending-line-chart-wrapper mt-3">
                  <canvas id="revenue-line-chart" height="70"></canvas>
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
                    <p class="center-align font-weight-600 mt-4">${{ number_format($weeks_deposit_revenue) ?? 0 }}</p>
                    <p class="ultra-small center-align">Доход</p>
                  </div>
                  <div class="doughnut-chart-status month display-none">
                    <p class="center-align font-weight-600 mt-4">${{ number_format($month_deposit_revenue) ?? 0 }}</p>
                    <p class="ultra-small center-align">Доход</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m2 l2">
                <ul class="doughnut-chart-legend">
                  <li class="kitchen ultra-small">
                    <span class="legend-color"></span>
                    Пополнено
                  </li>
                  <li class="home ultra-small">
                    <span class="legend-color"></span>
                    Выведено
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
                  <span class="card-title grey-text text-darken-4">Доход по месяцам <i
                        class="material-icons right">close</i>
                  </span>
              <table class="responsive-table">
                <thead>
                  <tr>
                    <th data-field="">id</th>
                    <th data-field="">Дата</th>
                    <th data-field="">Пополнено</th>
                    <th data-field="">Выведено</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($month_period as $key => $item)
                    <tr>
                      {{--                    <td>{{ $i }}</td>--}}
                      {{--                    <td>{{ $item['month']->format('M Y') ?? '' }}</td>--}}
                      {{--                    <td>${{ number_format($item['enter'], 2, ',', '.') ?? 0 }}</td>--}}
                      {{--                    <td>${{ number_format($item['withdraw'], 2, ',', '.') ?? 0 }}</td>  --}}
                      <td>{{ $loop->index }}</td>
                      <td>{{ $item['start']->format('d M') . '-' . $item['end']->format('d M') }}</td>
                      <td>$ {{ number_format($month_period_enter_transactions[$item['start']->format('d M') . '-' . $item['end']->format('d M')], 2, ',', '.') ?? 0 }}</td>
                      <td>$ {{ number_format($month_period_withdraw_transactions[$item['start']->format('d M') . '-' . $item['end']->format('d M')], 2, ',', '.') ?? 0 }}</td>
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
                <p class="margin white-text">Популярность по странам</p>
                <canvas id="trending-radar-chart" height="114"></canvas>
              </div>
            </div>
            <div class="card-content  teal">
              <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                <i class="material-icons activator">done</i>
              </a>
              <div class="line-chart-wrapper">
                <p class="margin white-text">Популярность по городам</p>
                <canvas id="line-chart" height="114"></canvas>
              </div>
            </div>
            <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">Популярность по странам <i
                        class="material-icons right">close</i>
                  </span>
              <table class="responsive-table ">
                <thead>
                  <tr>
                    <th data-field="country-name">Страна</th>
                    <th data-field="item-sold">Количество юзеров</th>
                    <th data-field="total-profit">Инвестировано, $</th>
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
                      <td colspan="3" style="text-align: center">Пусто</td>
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
      <div class="col s12 m12 l6">
        <div class="card">
          @if(session()->has('success'))
            <div class="card-alert card green mb-0">
              <div class="card-content white-text">
                  <span class="card-title white-text darken-1 mb-0">
                    <i class="material-icons">notifications</i> @lang(session()->get('success'))</span>
                {{--<p>Пользователю начислен бонус </p>--}}
              </div>
              <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          @endif
          @if(session()->has('error'))
            <div class="card-alert card red mb-0">
              <div class="card-content white-text">
                  <span class="card-title white-text darken-1 mb-0">
                    <i class="material-icons">notifications</i> @lang(session()->get('error'))</span>
                {{--<p>Пользователю начислен бонус </p>--}}
              </div>
              <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
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
              <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          @endif
          <div class="card-content">
            <h4 class="card-title mb-4">Начислить бонус</h4>
            <form method="post" class="dashboard-send-bonus-form" action="{{ route('dashboard.add_bonus') }}">
              {{ csrf_field() }}
              
              <div class="row" style="margin-top:20px; text-align: center;">
                <div class="input-field col s12">
                  <input id="login" type="text" name="login" placeholder="Логин, айди, или почта" value="{{ old('login') }}" style="font-weight: bold; text-align: center;">
                </div>
              </div>
              
              <div style="border-top:1px dotted gray; margin-top:20px;"></div>
              
              <div class="row" style="text-align: center; margin-top:20px;">
                              <span class="badge blue" style="padding:8px 15px 8px 15px; border-radius: 10px;">
                                  <label>
                                    <input class="with-gap" name="type" value="enter" type="radio" {{ old('type', 'enter') == 'enter' ? 'checked' : '' }} />
                                    <span style="color:white; font-weight: bold;">Ввод средств в систему</span>
                                  </label>
                              </span>
                <span class="badge blue" style="padding:8px 15px 8px 15px; border-radius: 10px;">
                                  <label>
                                    <input class="with-gap" name="type" value="withdraw" type="radio" {{ old('type') == 'withdraw' ? 'checked' : '' }} />
                                    <span style="color:white; font-weight: bold;">Вывод средств</span>
                                  </label>
                              </span>
              </div>
              
              <div style="border-top:1px dotted gray; margin-top:20px;"></div>
              
              <div class="row" style="text-align: center; margin-top:20px;">
                @foreach($currencies as $currency)
                  @if($loop->index % 2 && $loop->index > 1)
                    <br><br>
                  @endif
                  <span class="badge blue" style="padding:8px 15px 8px 15px; border-radius: 10px;">
                                  <label>
                                    <input class="with-gap" name="currency" value="{{ $currency->id }}" type="radio" {{ old('currency', $currencies[0]->id ?? '') == $currency->id ? 'checked' : '' }} />
                                    <span style="color:white; font-weight: bold;">{{ $currency->code }}</span>
                                  </label>
                              </span>
                @endforeach
              </div>
              
              <div style="border-top:1px dotted gray; margin-top:20px;"></div>
              
              <div class="row" style="margin-top:20px; text-align: center;">
                @foreach($payment_system as $ps)
                  @if($loop->index % 2 && $loop->index > 1)
                    <br><br>
                  @endif
                  <span class="badge blue" style="padding:8px 15px 8px 15px; border-radius: 10px;">
                                  <label>
                                    <input class="with-gap" name="payment_system" value="{{ $ps->id }}" type="radio" {{ old('payment_system', $payment_system[0]->id ?? '') == $ps->id ? 'checked' : '' }} />
                                    <span style="color:white; font-weight: bold;">{{ $ps->name }}</span>
                                  </label>
                              </span>
                @endforeach
              </div>
              
              <div style="border-top:1px dotted gray; margin-top:20px;"></div>
              
              <div class="row" style="margin-top:20px; text-align: center;">
                              <span class="badge blue" style="padding:8px 15px 8px 15px; border-radius: 10px;">
                                  <label>
                                    <input class="with-gap" name="is_real" value="1" type="radio" {{ old('is_real', '1') == '1' ? 'checked' : '' }} />
                                    <span style="color:white; font-weight: bold;">Реал</span>
                                  </label>
                              </span>
                
                <span class="badge blue" style="padding:8px 15px 8px 15px; border-radius: 10px;">
                                  <label>
                                    <input class="with-gap" name="is_real" value="0" type="radio" {{ old('is_real') == '0' ? 'checked' : '' }} />
                                    <span style="color:white; font-weight: bold;">Фейк</span>
                                  </label>
                              </span>
              </div>
              
              <div style="border-top:1px dotted gray; margin-top:20px;"></div>
              
              <div class="row" style="margin-top:20px; text-align: center;">
                <div class="input-field col s12">
                  <input id="amount" type="text" name="amount" placeholder="Сумма" value="{{ old('amount') }}" style="font-weight: bold; text-align: center;">
                </div>
              </div>
              
              <div style="border-top:1px dotted gray; margin-top:20px;"></div>
              
              <div class="row" style="text-align: center;">
                <div class="input-field col s12" style="text-align:center;">
                  <button class="btn blue waves-effect waves-light dashboard-send-bonus-btn" type="submit" name="action">ОТПРАВИТЬ БОНУС<i class="material-icons right">attach_money</i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <div class="col s12 m12 l6">
        <div id="striped-table" class="card card card-default scrollspy">
          <div class="card-content">
            <h4 class="card-title">Статистика</h4>
            <p class="mb-2"></p>
            <div class="row">
              <div class="col s12">
              </div>
              <div class="col s12">
                <table class="striped">
                  <thead>
                    <tr>
                      <th data-field="name">Система</th>
                      <th data-field="plus">Пополнений</th>
                      <th data-field="minus">Выплат</th>
                      <th data-field="sum">Сумма</th>
                      <th data-field="percent">В процентах</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($payment_system as $item)
                      <tr>
                        <td>{{ $item->name }}</td>
                        <td class="green-text">
                          <span style="font-weight: 900;">$</span>{{ number_format(round($item->transaction_sum, 2), 2, '.',' ') ?? 0 }}
                        </td>
                        <td class="red-text">
                          <span style="font-weight: 900;">$</span>{{ number_format(round($item->transaction_minus, 2), 2, '.',' ') ?? 0 }}
                        </td>
                        <td class="blue-grey-text">
                          <span style="font-weight: 900;">$</span>{{ number_format(round($item->transaction_sum - $item->transaction_minus, 2), 2, '.',' ') ?? 0}}
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
                        <td colspan="3" style="text-align: center">Пусто</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col s12 m12 l6">
        <div id="striped-table" class="card card card-default scrollspy">
          <div class="card-content">
            <h4 class="card-title">История входов админов</h4>
            <p class="mb-2"></p>
            <div class="row">
              <div class="col s12">
              </div>
              <div class="col s12">
                <table class="striped">
                  <thead>
                    <tr>
                      <th data-field="id">Пользователь</th>
                      <th data-field="name">Ip</th>
                      <th data-field="price">Дата</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($user_auth_logs as $item)
                      <tr>
                        <td><b>Имя: </b>{{ $item->user->name ?? '' }} <br><b>Логин: </b>{{ $item->user->login }}</td>
                        <td>{{ $item->ip ?? '' }}</td>
                        <td>{{ $item->created_at->format('d.m.Y H:i:s') ?? '' }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="3" style="text-align: center">Пусто</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <style>
        .subscription-table thead th {
            font-weight: 600;
        }
    </style>
    <div class="row">
      <div class="col s12 m12 l8">
        <div class="card subscriber-list-card animate fadeRight">
          <div class="card-content pb-1">
            <h4 class="card-title mb-0">Последние операции</h4>
          </div>
          <table class="subscription-table responsive-table highlight">
            <thead>
              <tr>
                <th>Пользователь</th>
                <th>Тип</th>
                <th>Сумма</th>
                <th>Платёжная система</th>
                <th>Дата операции</th>
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
                      <span class="badge  green-text  lighten-5 text-accent-4">$ {{ number_format($operation->main_currency_amount, 2, '.', ',') ?? 0 }}</span>
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
    </div>
  
  </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/chartjs/chart.min.js')}}"></script>
  <script src="{{asset('vendors/chartist-js/chartist.min.js')}}"></script>
  <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
  {{--  <script src="{{asset('vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>--}}
  <script src="{{asset('vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
  {{--  <script src="{{asset('js/scripts/dashboard-modern.js')}}"></script>--}}
  {{--  <script src="{{asset('js/scripts/intro.js')}}"></script>--}}
  <script src="{{ asset('js/scripts/ui-alerts.js') }}"></script>
  {{--  <script src="{{ asset('admin/js/scripts/dashboard-analytics.js') }}"></script>--}}
  <script>
    (function (window, document, $) {
      
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
            backgroundColor: ["#46BFBD", "#FDB45C"]
          }
        ]
      };
      var totalRevenueChartDataMonth = {
        labels: ["Пополнено", "Выведено"],
        datasets: [
          {
            label: "Sales",
            data: [{{ $month_total_enter ?? 0 }}, {{ $month_total_withdraw ?? 0 }}],
            backgroundColor: ["#46BFBD", "#FDB45C"]
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
            } else {
              totalRevenueChart.config = totalRevenueChartConfigWeek;
              totalRevenueChart.update();
              document.querySelector('.doughnut-chart-status.month').classList.add('display-none');
              document.querySelector('.doughnut-chart-status.week').classList.remove('display-none');
              
              document.querySelector('.chart-revenue-total.month').classList.add('display-none');
              document.querySelector('.chart-revenue-total.week').classList.remove('display-none');
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
            delete: 'Удалить'
          }
        }).then(function (willDelete) {
          if (willDelete) {
            $(".dashboard-send-bonus-form").submit();
          }
        });
      });
     
    });
  </script>
@endsection
