@extends('admin/layouts.app')
@section('title', __('Dashboard'))

@section('breadcrumbs')
    <li> {{ __('Dashboard') }}</li>
@endsection
@section('content')
    <!-- cards row -->
    <div class="row">

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-greensea">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            {{ __('registered users') }} <strong>{{ getTotalAccounts() }}</strong> <br>
                            {{ __('active users') }} <strong>{{ getActiveAccounts() }}</strong>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back front bg-greensea">
                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            {{ __('registered today') }}
                            <strong>{{ getTotalAccounts(\Carbon\Carbon::today()) }}</strong> <br>
                            {{ __('active today') }} <strong>{{ getActiveAccounts(\Carbon\Carbon::today()) }}</strong>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->
                </div>
            </div>
        </div>
        <!-- /col -->
        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-blue">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-9">
                            {{ __('registered deposits') }} <strong>{{ getActiveDepositsCount() }}</strong> <br>
                            {{ __('closed deposits') }} <strong>{{ getClosedDepositsCount() }}</strong>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back front bg-blue">

                    <!-- row -->
                    <div class="row">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4">
                                <i class="fa fa-usd fa-4x"></i>
                            </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                {{ __('registered today') }}
                                <strong>{{ getActiveDepositsCount(\Carbon\Carbon::today()) }}</strong> <br>
                                {{ __('closed today') }}
                                <strong>{{ getClosedDepositsCount(\Carbon\Carbon::today()) }}</strong>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-lightred">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-9">
                            @if (!empty(getTopPartner()))
                                {{ __('Top partner') }} <strong>{{ getTopPartner()['login'] }}</strong><br>
                                {{ __('invited') }}
                                <strong>{{ getTopPartner()['referrals_amount'] }}</strong> {{ __('customers') }}
                            @endif
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back front bg-lightred">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-shopping-cart fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            @if (!empty(getTopPartner()))
                            <a href="{{ route('admin.users.show', ['id' => getTopPartner()['id']]) }}"
                               class="">{{ __('open profile') }}</a>
                            @endif
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->


        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-eye fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0">{{ getVisitorsOnline() }}</p>
                            <span>{{ __('Users online') }}</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>

                <div class="back front bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-eye fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0">{{ getMembersOnline() }}</p>
                            <span>{{ __('authorized') }}</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>

            </div>
        </div>
        <!-- /col -->

    </div>
    <!-- /row -->
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-md-6">
        @if(count(getLastCreatedDeposits()) > 0)
            <!-- tile -->
            <section class="tile tile-simple">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font">{{ __('Recent deposits') }}</h1>
                </div>
                <div class="tile-body">
                    <ul class="list-type caret-right">
                        @foreach(getLastCreatedDeposits() as $deposit)
                            <li>{{ \Carbon\Carbon::parse($deposit['created_at'])->diffForHumans() }} - <a
                                        href="{{ route('admin.deposits.show', ['id' => $deposit['id']]) }}"
                                        style="font-weight: bold;" target="_blank" data-toggle="tooltip"
                                        data-placement="top"
                                        title="{{ __('Rate').' '.$deposit['rate']['name'] }}">{{ $deposit['invested'] }}{{ $deposit['currency']['symbol'] }}</a>
                                {{ __('by') }} <a
                                        href="{{ route('admin.users.show', ['id' => $deposit['user']['id']]) }}"
                                        style="font-weight: bold;" target="_blank" data-toggle="tooltip"
                                        data-placement="top"
                                        title="{{ __('Registered').' '.$deposit['user']['created_at'] }}">{{ $deposit['user']['login'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
            <!-- /tile -->
            @else
                <div class="alert alert-warning alert-dismissable">{{ __('No new deposits ..') }}</div>
            @endif
            @if(count(getLastCreatedMembers()) > 0)
            <!-- tile -->
            <section class="tile tile-simple">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font">{{ __('Recent users') }}</h1>
                </div>
                <div class="tile-body">
                    <ul class="list-type caret-right">
                        @foreach(getLastCreatedMembers(9) as $member)
                            <li>{{ \Carbon\Carbon::parse($member['created_at'])->diffForHumans() }} - <a
                                        href="{{ route('admin.users.show', ['id' => $member['id']]) }}" target="_blank"
                                        style="font-weight: bold;" data-toggle="tooltip" data-placement="right"
                                        title="{{ __('Registered').' '.$member['created_at'] }}">{{ $member['login'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
            <!-- /tile -->
            @else
                <div class="alert alert-warning alert-dismissable">{{ __('No new users ..') }}</div>
            @endif
        <!-- tile for tests -->

            @if (count($closingAtDateDeposits = getAdminDepositsSumClosingAtDate(\Carbon\Carbon::today())['deposits']) > 0)
            <!-- tile -->
                <section class="tile tile-simple">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font">{{ __('Deposits closing today') }}</h1>
                    </div>
                    <div class="tile-body">
                        <ul class="list-type caret-right">
                            @foreach($closingAtDateDeposits as $deposit)
                                <li>
                                    {{ __('User') }}: <a
                                            href="{{ route('admin.users.show', ['id'=>$deposit->user_id]) }}"
                                            target="_blanks">{{ $deposit->user->login }}</a>,
                                    {{ __('amount') }}: <a
                                            href="{{ route('admin.deposits.show',['id'=>$deposit->id]) }}"
                                            style="font-weight: bold;">{{ $deposit->invested }}{{ $deposit->currency->symbol }}</a>,
                                    {{ __('rate') }}: <a
                                            href="{{ route('admin.rates.show', ['id'=> $deposit->rate_id]) }}"
                                            target="_blank">{{ $deposit->rate->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <hr>
                        <div class="list-group">
                            <strong>{{ __('summary') }}:</strong><br>
                            @foreach(getAdminDepositsSumClosingAtDate(\Carbon\Carbon::today())['total'] as $currency => $total)
                                <li class="list-group-item">{{ $currency }} <strong>{{ $total }}</strong></li>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- /tile -->
            @else
                <div class="alert alert-warning alert-dismissable">{{ __('No deposits closing today ..') }}</div>
            @endif
        </div>
        <!-- /col -->
        <div class="col-md-6">
            <!-- tile -->
            <section class="tile bg-greensea">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font">{{ __('Summary statistic') }}</h1>
                    <span class="help-block"
                          style="color:white;">{{ __('Calculated different between investments and withdrawals') }}</span>
                </div>
                <!-- /tile header -->
            @if (!empty($mergeDepositedAndWithdrew = getAdminMergeDepositedAndWithdrew()))
                <!-- tile body -->
                    <div class="tile-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('Currency') }}</th>
                                    <th>{{ __('Invested') }}</th>
                                    <th>{{ __('Withdrew') }}</th>
                                    <th>{{ __('Different') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(current($mergeDepositedAndWithdrew) as $currency => $data)
                                    <?php
                                    $d = $mergeDepositedAndWithdrew['deposited'][$currency];
                                    $w = $mergeDepositedAndWithdrew['withdrew'][$currency];
                                    ?>
                                    <tr>
                                        <td>{{ $currency }}</td>
                                        <td style="font-weight: bold;">{{ $d }}</td>
                                        <td style="font-weight: bold;">{{ $w }}</td>
                                        <td style="font-weight: bold;">{{ $d-$w }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /tile body -->
                @else
                    <div class="alert alert-warning alert-dismissable">{{ __('No summary statistic data exists ..') }}</div>
                @endif
            </section>
            <!-- /tile -->

            <!-- tile -->
            <section class="tile" fullscreen="isFullscreen02">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><strong>{{ __('Tariff plan popularity') }}</strong></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" tabindex="0" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> {{ __('Fullscreen') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile widget -->
                <div class="tile-widget">
                    <div id="plan-usage" style="width: 60%; margin-left:20%;"></div>
                </div>
                <!-- /tile widget -->

            </section>
            <!-- /tile -->

        </div>
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-md-12">
            <section class="tile tile-simple">
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font">
                        {{ __('Financial statistics by days') }}
                    </h1>
                    <strong style="float:right;">{{ __('Last') }} 30 {{ __('days') }}</strong>
                </div>
                <div class="tile-body">
                    @foreach(getCurrencies() as $currency)
                        <h4 class="custom-font"><strong>{{ $currency['name'] }}</strong></h4>
                        <div id="line-{{ $currency['code'] }}" style="height: 250px;width:80%;"></div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="tile tile-simple">
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font">{{ __('Users activity by days') }}</h1>
                    <strong style="float:right;">{{ __('Last') }} 30 {{ __('days') }}</strong>
                </div>
                <div class="tile-body">
                    <div id="line-area-analytics" style="height: 250px;width:80%;"></div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('load-scripts')
    <script>
        // Morris line chart
        <?php
        $faker = \Faker\Factory::create();
        ?>
        @foreach(getCurrencies() as $currency)
        Morris.Line({
            element: 'line-{{ $currency['code'] }}',
            data: [
                    @foreach(getAdminMoneyTrafficStatistic(30, $currency['code']) as $day => $amounts)
                {
                    y: '{{ $day }}', a: {{ $amounts['enter'] ?? 0 }}, b: {{ $amounts['withdrew'] ?? 0 }} },
                @endforeach
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['{{ __('Enter') }}', '{{ __('Withdraw') }}'],
            lineColors: ['#16a085', '#FF0066']
        });
        @endforeach
        // Morris line chart

        //Initialize morris chart
        Morris.Donut({
            element: 'plan-usage',
            data: [
                <?php
                $popularityList = [];
                $faker = \Faker\Factory::create();

                foreach (getAdminPlanPopularity() as $popularity) {
                    echo "{label: '" . stripslashes($popularity['name']) . "', value: " . $popularity['depositsSum'] . ", color: '" . $faker->hexColor . "'},";
                }
                ?>
            ],
            resize: true,
            formatter: function (y, data) {
                return '{{ __('deposits') }}: ' + y
            }
        });
        //*Initialize morris chart

        // Morris line area chart
        Morris.Area({
            element: 'line-area-analytics',
            data: [
                    @foreach(getAdminUsersActivityStatistic(30) as $date => $day)
                {
                    y: '{{ $date }}', a: {{ $day['visitors'] }}, b: {{ $day['pageViews'] }}},
                @endforeach
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Visitors', 'Page Views'],
            lineColors: ['#16a085', '#FF0066'],
            lineWidth: '1',
            grid: true,
            fillOpacity: '0.5',
            width:'100px',
        });
        // Morris line area chart
    </script>
@endpush