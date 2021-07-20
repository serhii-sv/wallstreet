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
                  <span class="card-title grey-text text-darken-4">Revenue by Month <i
                        class="material-icons right">close</i>
                  </span>
              <table class="responsive-table">
                <thead>
                  <tr>
                    <th data-field="id">ID</th>
                    <th data-field="month">Month</th>
                    <th data-field="item-sold">Item Sold</th>
                    <th data-field="item-price">Item Price</th>
                    <th data-field="total-profit">Total Profit</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>January</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>February</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>March</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>April</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>May</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>June</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>July</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>August</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>Septmber</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>Octomber</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>November</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td>December</td>
                    <td>122</td>
                    <td>100</td>
                    <td>$122,00.00</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l4">
          <div class="card animate fadeUp">
            <div class="card-move-up teal accent-4 waves-effect waves-block waves-light">
              <div class="move-up">
                <p class="margin white-text">Browser Stats</p>
                <canvas id="trending-radar-chart" height="114"></canvas>
              </div>
            </div>
            <div class="card-content  teal">
              <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                <i class="material-icons activator">done</i>
              </a>
              <div class="line-chart-wrapper">
                <p class="margin white-text">Revenue by country</p>
                <canvas id="line-chart" height="114"></canvas>
              </div>
            </div>
            <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">Revenue by country <i
                        class="material-icons right">close</i>
                  </span>
              <table class="responsive-table">
                <thead>
                  <tr>
                    <th data-field="country-name">Country Name</th>
                    <th data-field="item-sold">Item Sold</th>
                    <th data-field="total-profit">Total Profit</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>USA</td>
                    <td>65</td>
                    <td>$452.55</td>
                  </tr>
                  <tr>
                    <td>UK</td>
                    <td>76</td>
                    <td>$452.55</td>
                  </tr>
                  <tr>
                    <td>Canada</td>
                    <td>65</td>
                    <td>$452.55</td>
                  </tr>
                  <tr>
                    <td>Brazil</td>
                    <td>76</td>
                    <td>$452.55</td>
                  </tr>
                  <tr>
                    <td>India</td>
                    <td>65</td>
                    <td>$452.55</td>
                  </tr>
                  <tr>
                    <td>France</td>
                    <td>76</td>
                    <td>$452.55</td>
                  </tr>
                  <tr>
                    <td>Austrelia</td>
                    <td>65</td>
                    <td>$452.55</td>
                  </tr>
                  <tr>
                    <td>Russia</td>
                    <td>76</td>
                    <td>$452.55</td>
                  </tr>
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
            <h4 class="card-title mb-0">Last operations</h4>
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
    </div>
    
    <!-- Current balance & total transactions cards-->
    <div class="row vertical-modern-dashboard">
      <div class="col s12 m4 l4">
        <!-- Current Balance -->
        <div class="card animate fadeLeft">
          <div class="card-content">
            <h6 class="mb-0 mt-0 display-flex justify-content-between">Current Balance <i
                  class="material-icons float-right">more_vert</i>
            </h6>
            <p class="medium-small">This billing cycle</p>
            <div class="current-balance-container">
              <div id="current-balance-donut-chart" class="current-balance-shadow"></div>
            </div>
            <h5 class="center-align">$ 50,150.00</h5>
            <p class="medium-small center-align">Used balance this billing cycle</p>
          </div>
        </div>
      </div>
      <div class="col s12 m8 l8 animate fadeRight">
        <!-- Total Transaction -->
        <div class="card">
          <div class="card-content">
            <h4 class="card-title mb-0">Total Transaction <i class="material-icons float-right">more_vert</i>
            </h4>
            <p class="medium-small">This month transaction</p>
            <div class="total-transaction-container">
              <div id="total-transaction-line-chart" class="total-transaction-shadow"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Current balance & total transactions cards-->
    
    <!-- User statistics & appointment cards-->
    <div class="row">
      <div class="col s12 l5">
        <!-- User Statistics -->
        <div class="card user-statistics-card animate fadeLeft">
          <div class="card-content">
            <h4 class="card-title mb-0">User Statistics <i class="material-icons float-right">more_vert</i>
            </h4>
            <div class="row">
              <div class="col s12 m6">
                <ul class="collection border-none mb-0">
                  <li class="collection-item avatar">
                    <i class="material-icons circle pink accent-2">trending_up</i>
                    <p class="medium-small">This year</p>
                    <h5 class="mt-0 mb-0">60%</h5>
                  </li>
                </ul>
              </div>
              <div class="col s12 m6">
                <ul class="collection border-none mb-0">
                  <li class="collection-item avatar">
                    <i class="material-icons circle purple accent-4">trending_down</i>
                    <p class="medium-small">Last year</p>
                    <h5 class="mt-0 mb-0">40%</h5>
                  </li>
                </ul>
              </div>
            </div>
            <div class="user-statistics-container">
              <div id="user-statistics-bar-chart" class="user-statistics-shadow ct-golden-section"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col s12 l4">
        <!-- Recent Buyers -->
        <div class="card recent-buyers-card animate fadeUp">
          <div class="card-content">
            <h4 class="card-title mb-0">Recent Buyers <i class="material-icons float-right">more_vert</i></h4>
            <p class="medium-small pt-2">Today</p>
            <ul class="collection mb-0">
              <li class="collection-item avatar">
                <img src="{{ asset('admin/images/avatar/avatar-7.png') }}" alt="" class="circle" />
                <p class="font-weight-600">John Doe</p>
                <p class="medium-small">18, January 2019</p>
                <a href="#!" class="secondary-content"><i class="material-icons">star_border</i></a>
              </li>
              <li class="collection-item avatar">
                <img src="{{ asset('admin/images/avatar/avatar-3.png') }}" alt="" class="circle" />
                <p class="font-weight-600">Adam Garza</p>
                <p class="medium-small">20, January 2019</p>
                <a href="#!" class="secondary-content"><i class="material-icons">star_border</i></a>
              </li>
              <li class="collection-item avatar">
                <img src="{{ asset('admin/images/avatar/avatar-5.png') }}" alt="" class="circle" />
                <p class="font-weight-600">Jennifer Rice</p>
                <p class="medium-small">25, January 2019</p>
                <a href="#!" class="secondary-content"><i class="material-icons">star_border</i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col s12 l3">
        <div class="card animate fadeRight">
          <div class="card-content">
            <h4 class="card-title mb-0">Conversion Ratio</h4>
            <div class="conversion-ration-container mt-8">
              <div id="conversion-ration-bar-chart" class="conversion-ration-shadow"></div>
            </div>
            <p class="medium-small center-align">This month conversion ratio</p>
            <h5 class="center-align mb-0 mt-0">62%</h5>
          </div>
        </div>
      </div>
    </div>
    <!--/ Current balance & appointment cards-->
    
    <div class="row">
      <div class="col s12 m6 l4">
        <div class="card padding-4 animate fadeLeft">
          <div class="row">
            <div class="col s5 m5">
              <h5 class="mb-0">1885</h5>
              <p class="no-margin">New</p>
              <p class="mb-0 pt-8">1,12,900</p>
            </div>
            <div class="col s7 m7 right-align">
              <i
                  class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
              <p class="mb-0">Total Clients</p>
            </div>
          </div>
        </div>
        <div id="chartjs" class="card pt-0 pb-0 animate fadeLeft">
          <div class="dashboard-revenue-wrapper padding-2 ml-2">
            <span class="new badge gradient-45deg-indigo-purple gradient-shadow mt-2 mr-2">+ $900</span>
            <p class="mt-2 mb-0 font-weight-600">Today's revenue</p>
            <p class="no-margin grey-text lighten-3">$40,512 avg</p>
            <h5>$ 22,300</h5>
          </div>
          <div class="sample-chart-wrapper card-gradient-chart">
            <canvas id="custom-line-chart-sample-three" class="center"></canvas>
          </div>
        </div>
      </div>
      <div class="col s12 m6 l8">
        <div class="card subscriber-list-card animate fadeRight">
          <div class="card-content pb-1">
            <h4 class="card-title mb-0">Subscriber List <i class="material-icons float-right">more_vert</i>
            </h4>
          </div>
          <table class="subscription-table responsive-table highlight">
            <thead>
              <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Start Date</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Michael Austin</td>
                <td>ABC Fintech LTD.</td>
                <td>Jan 1,2019</td>
                <td>
                  <span class="badge pink lighten-5 pink-text text-accent-2">Close</span>
                </td>
                <td>$ 1000.00</td>
                <td class="center-align">
                  <a href="#"><i class="material-icons pink-text">clear</i></a>
                </td>
              </tr>
              <tr>
                <td>Aldin Rakić</td>
                <td>ACME Pvt LTD.</td>
                <td>Jan 10,2019</td>
                <td>
                  <span class="badge green lighten-5 green-text text-accent-4">Open</span>
                </td>
                <td>$ 3000.00</td>
                <td class="center-align">
                  <a href="#"><i class="material-icons pink-text">clear</i></a>
                </td>
              </tr>
              <tr>
                <td>İris Yılmaz</td>
                <td>Collboy Tech LTD.</td>
                <td>Jan 12,2019</td>
                <td>
                  <span class="badge green lighten-5 green-text text-accent-4">Open</span>
                </td>
                <td>$ 2000.00</td>
                <td class="center-align">
                  <a href="#"><i class="material-icons pink-text">clear</i></a>
                </td>
              </tr>
              <tr>
                <td>Lidia Livescu</td>
                <td>My Fintech LTD.</td>
                <td>Jan 14,2019</td>
                <td>
                  <span class="badge pink lighten-5 pink-text text-accent-2">Close</span>
                </td>
                <td>$ 1100.00</td>
                <td class="center-align">
                  <a href="#"><i class="material-icons pink-text">clear</i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  
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
            data: [{{ $deposit_diff }}, {{ $deposit_total_sum }}, {{ $deposit_total_withdraw }}],
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
            label: "Sales",
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
        labels: ["Chrome", "Mozilla", "Safari", "IE10", "Opera"],
        datasets: [
          {
            label: "Browser",
            data: [5, 6, 7, 8, 6],
            fillColor: "rgba(255,255,255,0.2)",
            borderColor: "#fff",
            pointBorderColor: "#fff",
            pointBackgroundColor: "#00bfa5",
            pointHighlightFill: "#fff",
            pointHoverBackgroundColor: "#fff",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4
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
        labels: ["USA", "UK", "UAE", "AUS", "IN", "SA"],
        datasets: [
          {
            label: "Sales",
            data: [65, 45, 50, 30, 63, 45],
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