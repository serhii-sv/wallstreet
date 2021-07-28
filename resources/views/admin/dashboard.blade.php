@extends('admin/layouts.app-new')
@section('title', __('Dashboard'))
@section('body.class', 'vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns')

@section('content')
  <div class="section">
  
    <div id="chart-dashboard">
      <div class="row">
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
                  <canvas id="revenue-line-chart2" height="70"></canvas>
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
                    <p class="center-align font-weight-600 mt-4">${{ number_format($weeks_deposit_revenue,2) ?? 0 }}</p>
                    <p class="ultra-small center-align">Доход</p>
                  </div>
                  <div class="doughnut-chart-status month display-none">
                    <p class="center-align font-weight-600 mt-4">${{ number_format($month_deposit_revenue,2) ?? 0 }}</p>
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
              <table class="responsive-table">
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
        <div class="card subscriber-list-card animate fadeRight">
          <div class="card-content pb-1">
            <h4 class="card-title mb-0">Последние операции</h4>
          </div>
          <table class="subscription-table responsive-table highlight">
            <thead>
              <tr>
                <th>User</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Payment system</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($last_operations) && !empty($last_operations))
                @foreach($last_operations as $operation)
                  <tr>
                    <td>{{ $operation->user->name ?? 'Не указано' }}</td>
                    <td>{{ $operation->type->name ?? 'Не указано' }}</td>
                    <td>
                      <span class="badge  green-text  lighten-5 text-accent-4">$ {{ $operation->main_currency_amount }}</span>
                    </td>
                    <td>{{ $operation->paymentSystem->name ?? 'Не указано' }}</td>
                    <td>{{ $operation->created_at->format('m d, Y') }}</td>
                    <td class="center-align">
                      <a href="{{ route('admin.transactions.show', $operation->id) }}">Open</a>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
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
            <h4 class="card-title mb-4">Give bonus</h4>
            <form method="post" action="{{ route('admin.dashboard.add.bonus') }}">
              {{ csrf_field() }}
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Id or Login or email" id="name2" name="user" type="text" value="{{ old('user') ?? '' }}">
                  <label for="name2" class="active">{{ __('User') }}</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="23" type="text" name="amount" value="{{ old('amount') ?? '' }}">
                  <label class="active">{{ __('Amount') }}</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <div class="select-wrapper">
                    <select tabindex="-1" name="currency_id">
                      <option value="" disabled="" selected="">Choose currency</option>
                      @forelse($currencies as $item)
                        <option value="{{ $item->id }}" @if($item->id == old('currency_id')) selected="selected" @endif>{{ $item->name ?? '' }}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <div class="select-wrapper">
                    <select tabindex="-1" name="payment_system_id">
                      <option value="" disabled="" selected="">Choose payment system</option>
                      @forelse($payment_system as $item)
                        <option value="{{ $item->id }}" @if($item->id == old('payment_system_id')) selected="selected" @endif>{{ $item->name ?? '' }}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="row">
                  <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __("send bonus") }}
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
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
                      <th data-field="id">User</th>
                      <th data-field="name">Ip</th>
                      <th data-field="price">Date</th>
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
    </div>
  
  </div>
@endsection
@push('scripts')
  <script src="{{ asset('admin/js/scripts/ui-alerts.js') }}"></script>
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
                callback: function(value) {if (value % 1 === 0 && value >= 0) {return value;}}
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
                callback: function(value) {if (value % 1 === 0 && value >= 0) {return value;}}
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
                callback: function (value) { if (Number.isInteger(value)) { return value; } },
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
@endpush