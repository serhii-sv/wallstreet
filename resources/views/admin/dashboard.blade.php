@extends('admin/layouts.app-new')
@section('title', __('Dashboard'))
@section('body.class', 'vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns')

@section('content')
  <div class="section">
    <div id="chart-dashboard">

      <div id="card-stats" class="pt-0">
        <div class="row">
          <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
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
            <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeLeft">
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
            <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeRight">
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
            <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
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

      <div class="row">
        <div class="col s12 l4">
          <!-- Recent Buyers -->
          <div class="card recent-buyers-card animate fadeUp">
            <div class="card-content">
              <h4 class="card-title mb-0">Пользователи онлайн </h4>

              <ul class="collection mb-0">
                @foreach($users['online'] as $user)
                <li class="collection-item avatar">
                  <img src="{{ asset('admin/images/avatar/avatar-7.png') }}" alt="avatar" class="circle"/>
                  <p class="font-weight-600">{{$user->short_name}}</p>
                  <p class="medium-small">{{$user->login}}</p>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col s12 m8 l8">
          <div class="card animate fadeUp">
            <div class="card-move-up waves-effect waves-block waves-light">
              <div class="move-up cyan darken-1">
                <div>
                  <span class="chart-title white-text">Доход</span>
                  <div class="chart-revenue cyan darken-2 white-text">
                    <p class="chart-revenue-total">${{ number_format($deposit_diff,2) }}</p>
                    <!--                    <p class="chart-revenue-per"><i class="material-icons">arrow_drop_up</i> 21.80 %</p>-->
                  </div>
                  <!--                  <div class="switch chart-revenue-switch right">
                                      <label class="cyan-text text-lighten-5">
                                        Month <input type="checkbox" />
                                        <span class="lever"></span>
                                        Year
                                      </label>
                                    </div>-->
                </div>
                <div class="trending-line-chart-wrapper">
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
                  <div class="doughnut-chart-status">
                    <p class="center-align font-weight-600 mt-4">${{ number_format($deposit_total_sum,2) }}</p>
                    <p class="ultra-small center-align">Внесено</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m2 l2">
                <ul class="doughnut-chart-legend">
                  <li class="mobile ultra-small">
                    <span class="legend-color"></span>
                    Нарисовано
                  </li>
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
                    <th data-field="">Месяц</th>
                    <th data-field="">Нарисовано</th>
                    <th data-field="">Пополнено</th>
                    <th data-field="">Выведено</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($transactions_month as $i => $item)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item['month']->format('M Y') ?? '' }}</td>
                    <td>${{ number_format($item['drawn'], 2, ',', '.') ?? 0 }}</td>
                    <td>${{ number_format($item['enter'], 2, ',', '.') ?? 0 }}</td>
                    <td>${{ number_format($item['withdraw'], 2, ',', '.') ?? 0 }}</td>
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
      
      // Check first if any of the task is checked
      
      //Trending line chart
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
                fontColor: "#fff"
              }
            }
          ]
        }
      };
      
      var revenueLineChartData = {
        labels: [@foreach($weeks_main_graph as $week)
            "{{ $week->format('d M') }}",
          @endforeach],
        //labels: ["Apple", "Samsung", "Sony", "Motorola", "Nokia", "Microsoft", "Xiaomi"],
        datasets: [
          {
            label: "Deposit",
            data: [@foreach($transactions_deposit_sum as $item)
                "{{ $item }}",
              @endforeach],
            //data: [150, 50, 20, 40, 80, 50, 80],
            backgroundColor: "rgba(128, 222, 234, 0.5)",
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
            data: [@foreach($transactions_withdraw_sum as $item)
                "{{ $item }}",
              @endforeach],
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
      
      var revenueLineChart;
      /*setInterval(function () {
        // Get a random index point
        var indexToUpdate = Math.round(Math.random() * (revenueLineChartData.labels.length - 1));
        if (typeof revenueLineChart != "undefined") {
          // Update one of the points in the second dataset
          if (revenueLineChartData.datasets[0].data[indexToUpdate]) {
            revenueLineChartData.datasets[0].data[indexToUpdate] = Math.round(Math.random() * 100);
          }
          if (revenueLineChartData.datasets[1].data[indexToUpdate]) {
            revenueLineChartData.datasets[1].data[indexToUpdate] = Math.round(Math.random() * 100);
          }
          revenueLineChart.update();
        }
      }, 2000);*/
      
      var revenueLineChartConfig = {
        type: "line",
        options: revenueLineChartOptions,
        data: revenueLineChartData
      };
      
      /*
   Doughnut Chart Widget
   */
      
      var doughnutSalesChartCTX = $("#doughnut-chart");
      var browserStatsChartOptions = {
        cutoutPercentage: 70,
        legend: {
          display: false
        }
      };
      
      var doughnutSalesChartData = {
        labels: ["Нарисовано", "Пополнено", "Выведено"],
        datasets: [
          {
            label: "Sales",
            data: [{{ $deposit_total_drawn }}, {{ $deposit_total_sum }}, {{ $deposit_total_withdraw }}],
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"]
          }
        ]
      };
      
      var doughnutSalesChartConfig = {
        type: "doughnut",
        options: browserStatsChartOptions,
        data: doughnutSalesChartData
      };
      
      /*
   Monthly Revenue : Trending Bar Chart
   */
      
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
                beginAtZero: true
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
      var monthlyRevenueChartData = {
        labels: [@foreach($weeks_main_graph as $week)
            "{{ $week->format('d M') }}",
          @endforeach],
        //labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept"],
        datasets: [
          {
            label: "withdraws",
            //data: [6, 9, 8, 4, 6, 7, 9, 4, 8],
            data: [@foreach($transactions_withdraw_sum as $item)
                "{{ $item }}",
              @endforeach],
            backgroundColor: "#46BFBD",
            hoverBackgroundColor: "#009688"
          }
        ]
      };
      
      var nReloads1 = 0;
      var min1 = 1;
      var max1 = 10;
      var monthlyRevenueChart;
      
      function updateMonthlyRevenueChart() {
        if (typeof monthlyRevenueChart != "undefined") {
          nReloads1++;
          var x = Math.floor(Math.random() * (max1 - min1 + 1)) + min1;
          monthlyRevenueChartData.datasets[0].data.shift();
          monthlyRevenueChartData.datasets[0].data.push([x]);
          monthlyRevenueChart.update();
        }
      }
      
      // setInterval(updateMonthlyRevenueChart, 2000);
      updateMonthlyRevenueChart();
      var monthlyRevenueChartConfig = {
        type: "bar",
        options: monthlyRevenueChartOptions,
        data: monthlyRevenueChartData
      };
      
      /*
   Trending Bar Chart
   */
      
      var browserStatsChartCTX = $("#trending-radar-chart");
      
      var browserStatsChartOptions = {
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
      
      var browserStatsChartData = {
        labels: [@forelse($countries_stat as $country)"{{ $country->name }}"@if(!$loop->last),@endif @empty "Пусто" @endforelse],
        datasets: [
          {
            label: "Count",
            data: [@forelse($countries_stat as $country)"{{ intval($country->count) }}"@if(!$loop->last),@endif @empty "Пусто" @endforelse],
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
      
      var nReloads2 = 0;
      var min2 = 1;
      var max2 = 10;
      var browserStatsChart;
      
      function browserStatsChartUpdate() {
        if (typeof browserStatsChart != "undefined") {
          nReloads2++;
          var x = Math.floor(Math.random() * (max2 - min2 + 1)) + min2;
          browserStatsChartData.datasets[0].data.pop();
          browserStatsChartData.datasets[0].data.push([x]);
          browserStatsChart.update();
        }
      }
      
      browserStatsChartUpdate();
      //setInterval(browserStatsChartUpdate, 2000);
      
      var browserStatsChartConfig = {
        type: "radar",
        options: browserStatsChartOptions,
        data: browserStatsChartData
      };
      
      /*
      Revenue by country - Line Chart
   */
      
      var countryRevenueChartCTX = $("#line-chart");
      
      var countryRevenueChartOption = {
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
                fontColor: "#fff"
              }
            }
          ]
        }
      };
      
      var countryRevenueChartData = {
        labels: [@forelse($cities_stat as $country)"{{ $country->name }}"@if(!$loop->last),@endif @empty "Пусто" @endforelse],
        datasets: [
          {
            label: "Users",
            data: [@forelse($cities_stat as $country)"{{ $country->count }}"@if(!$loop->last),@endif @empty "Пусто" @endforelse],
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
      var countryRevenueChartConfig = {
        type: "line",
        options: countryRevenueChartOption,
        data: countryRevenueChartData
      };
      
      
      // Create the chart
      
      window.onload = function () {
        revenueLineChart = new Chart(revenueLineChartCTX, revenueLineChartConfig);
        monthlyRevenueChart = new Chart(monthlyRevenueChartCTX, monthlyRevenueChartConfig);
        var doughnutSalesChart = new Chart(doughnutSalesChartCTX, doughnutSalesChartConfig);
        browserStatsChart = new Chart(browserStatsChartCTX, browserStatsChartConfig);
        var countryRevenueChart = new Chart(countryRevenueChartCTX, countryRevenueChartConfig);
      };
      
      $(function () {
        /*
         * STATS CARDS
         */
        // Bar chart ( New Clients)
        $("#clients-bar").sparkline([70, 80, 65, 78, 58, 80, 78, 80, 70, 50, 75, 65, 80, 70, 65, 90, 65, 80, 70, 65, 90], {
          type: "bar",
          height: "25",
          barWidth: 7,
          barSpacing: 4,
          barColor: "#b2ebf2",
          negBarColor: "#81d4fa",
          zeroColor: "#81d4fa"
        });
        // Total Sales - Bar
        $("#sales-compositebar").sparkline([4, 6, 7, 7, 4, 3, 2, 3, 1, 4, 6, 5, 9, 4, 6, 7, 7, 4, 6, 5, 9], {
          type: "bar",
          barColor: "#F6CAFD",
          height: "25",
          width: "100%",
          barWidth: "7",
          barSpacing: 4
        });
        //Total Sales - Line
        $("#sales-compositebar").sparkline([4, 1, 5, 7, 9, 9, 8, 8, 4, 2, 5, 6, 7], {
          composite: true,
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
        // Tristate chart (Today Profit)
        $("#profit-tristate").sparkline([2, 3, 0, 4, -5, -6, 7, -2, 3, 0, 2, 3, -1, 0, 2, 3, 3, -1, 0, 2, 3], {
          type: "tristate",
          width: "100%",
          height: "25",
          posBarColor: "#ffecb3",
          negBarColor: "#fff8e1",
          barWidth: 7,
          barSpacing: 4,
          zeroAxis: false
        });
        // Line chart ( New Invoice)
        $("#invoice-line").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9, 5], {
          type: "line",
          width: "100%",
          height: "25",
          lineWidth: 2,
          lineColor: "#E1D0FF",
          fillColor: "rgba(255, 255, 255, 0.2)",
          highlightSpotColor: "#E1D0FF",
          highlightLineColor: "#E1D0FF",
          minSpotColor: "#00bcd4",
          maxSpotColor: "#4caf50",
          spotColor: "#E1D0FF",
          spotRadius: 4
        });
        
        /*
         * Project Line chart ( Project Box )
         */
        $("#project-line-1").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
          type: "line",
          width: "100%",
          height: "30",
          lineWidth: 2,
          lineColor: "#00bcd4",
          fillColor: "rgba(0, 188, 212, 0.2)"
        });
        $("#project-line-2").sparkline([6, 7, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4], {
          type: "line",
          width: "100%",
          height: "30",
          lineWidth: 2,
          lineColor: "#00bcd4",
          fillColor: "rgba(0, 188, 212, 0.2)"
        });
        $("#project-line-3").sparkline([2, 4, 6, 7, 5, 6, 7, 9, 5, 6, 7, 9, 9, 5, 3, 2, 9, 5, 3, 2, 2, 4, 6, 7], {
          type: "line",
          width: "100%",
          height: "30",
          lineWidth: 2,
          lineColor: "#00bcd4",
          fillColor: "rgba(0, 188, 212, 0.2)"
        });
        $("#project-line-4").sparkline([9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
          type: "line",
          width: "100%",
          height: "30",
          lineWidth: 2,
          lineColor: "#00bcd4",
          fillColor: "rgba(0, 188, 212, 0.2)"
        });
      });
    })(window, document, jQuery);
  
  </script>
@endpush