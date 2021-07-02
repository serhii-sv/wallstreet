<?php $__env->startSection('title', __('Dashboard')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Dashboard')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                            <?php echo e(__('registered users')); ?> <strong><?php echo e(getTotalAccounts()); ?></strong> <br>
                            <?php echo e(__('active users')); ?> <strong><?php echo e(getActiveAccounts()); ?></strong>
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
                            <?php echo e(__('registered today')); ?>

                            <strong><?php echo e(getTotalAccounts(\Carbon\Carbon::today())); ?></strong> <br>
                            <?php echo e(__('active today')); ?> <strong><?php echo e(getActiveAccounts(\Carbon\Carbon::today())); ?></strong>
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
                            <?php echo e(__('registered deposits')); ?> <strong><?php echo e(getActiveDepositsCount()); ?></strong> <br>
                            <?php echo e(__('closed deposits')); ?> <strong><?php echo e(getClosedDepositsCount()); ?></strong>
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
                                <?php echo e(__('registered today')); ?>

                                <strong><?php echo e(getActiveDepositsCount(\Carbon\Carbon::today())); ?></strong> <br>
                                <?php echo e(__('closed today')); ?>

                                <strong><?php echo e(getClosedDepositsCount(\Carbon\Carbon::today())); ?></strong>
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
                            <?php if(!empty(getTopPartner())): ?>
                                <?php echo e(__('Top partner')); ?> <strong><?php echo e(getTopPartner()['login']); ?></strong><br>
                                <?php echo e(__('have')); ?>

                                <strong><?php echo e(getTopPartner()['referrals_amount']); ?></strong> <?php echo e(__('referrals')); ?>

                            <?php endif; ?>
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
                            <a href="<?php echo e(route('admin.users.show', ['id' => getTopPartner()['id']])); ?>"
                               class=""><?php echo e(__('open profile')); ?></a>
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
                            <p class="text-elg text-strong mb-0"><?php echo e(getAdminTicketsCount()); ?></p>
                            <span><?php echo e(__('Tickets')); ?></span>
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
                            <p class="text-elg text-strong mb-0"><?php echo e(getAdminTicketsCount(\Carbon\Carbon::now())); ?></p>
                            <span><?php echo e(__('requests today')); ?></span>
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
        <?php if(count(getLastCreatedDeposits()) > 0): ?>
            <!-- tile -->
            <section class="tile tile-simple">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Recent deposits')); ?></h1>
                </div>
                <div class="tile-body">
                    <ul class="list-type caret-right">
                        <?php $__currentLoopData = getLastCreatedDeposits(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e(\Carbon\Carbon::parse($deposit['created_at'])->diffForHumans()); ?> - <a
                                        href="<?php echo e(route('admin.deposits.show', ['id' => $deposit['id']])); ?>"
                                        style="font-weight: bold;" target="_blank" data-toggle="tooltip"
                                        data-placement="top"
                                        title="<?php echo e(__('Rate').' '.$deposit['rate']['name']); ?>"><?php echo e($deposit['invested']); ?><?php echo e($deposit['currency']['symbol']); ?></a>
                                <?php echo e(__('by')); ?> <a
                                        href="<?php echo e(route('admin.users.show', ['id' => $deposit['user']['id']])); ?>"
                                        style="font-weight: bold;" target="_blank" data-toggle="tooltip"
                                        data-placement="top"
                                        title="<?php echo e(__('Registered').' '.$deposit['user']['created_at']); ?>"><?php echo e($deposit['user']['login']); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </section>
            <!-- /tile -->
            <?php else: ?>
                <div class="alert alert-warning alert-dismissable"><?php echo e(__('No new deposits ..')); ?></div>
            <?php endif; ?>
            <?php if(count(getLastCreatedMembers()) > 0): ?>
            <!-- tile -->
            <section class="tile tile-simple">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Recent users')); ?></h1>
                </div>
                <div class="tile-body">
                    <ul class="list-type caret-right">
                        <?php $__currentLoopData = getLastCreatedMembers(9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e(\Carbon\Carbon::parse($member['created_at'])->diffForHumans()); ?> - <a
                                        href="<?php echo e(route('admin.users.show', ['id' => $member['id']])); ?>" target="_blank"
                                        style="font-weight: bold;" data-toggle="tooltip" data-placement="right"
                                        title="<?php echo e(__('Registered').' '.$member['created_at']); ?>"><?php echo e($member['login']); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </section>
            <!-- /tile -->
            <?php else: ?>
                <div class="alert alert-warning alert-dismissable"><?php echo e(__('No new users ..')); ?></div>
            <?php endif; ?>
        <!-- tile for tests -->

            <?php if(count($closingAtDateDeposits = getAdminDepositsSumClosingAtDate(\Carbon\Carbon::today())['deposits']) > 0): ?>
            <!-- tile -->
                <section class="tile tile-simple">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><?php echo e(__('Deposits closing today')); ?></h1>
                    </div>
                    <div class="tile-body">
                        <ul class="list-type caret-right">
                            <?php $__currentLoopData = $closingAtDateDeposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <?php echo e(__('User')); ?>: <a
                                            href="<?php echo e(route('admin.users.show', ['id'=>$deposit->user_id])); ?>"
                                            target="_blanks"><?php echo e($deposit->user->login); ?></a>,
                                    <?php echo e(__('amount')); ?>: <a
                                            href="<?php echo e(route('admin.deposits.show',['id'=>$deposit->id])); ?>"
                                            style="font-weight: bold;"><?php echo e($deposit->invested); ?><?php echo e($deposit->currency->symbol); ?></a>,
                                    <?php echo e(__('rate')); ?>: <a
                                            href="<?php echo e(route('admin.rates.show', ['id'=> $deposit->rate_id])); ?>"
                                            target="_blank"><?php echo e($deposit->rate->name); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <hr>
                        <div class="list-group">
                            <strong><?php echo e(__('summary')); ?>:</strong><br>
                            <?php $__currentLoopData = getAdminDepositsSumClosingAtDate(\Carbon\Carbon::today())['total']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency => $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item"><?php echo e($currency); ?> <strong><?php echo e($total); ?></strong></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </section>
                <!-- /tile -->
            <?php else: ?>
                <div class="alert alert-warning alert-dismissable"><?php echo e(__('No deposits closing today ..')); ?></div>
            <?php endif; ?>
        </div>
        <!-- /col -->
        <div class="col-md-6">
            <!-- tile -->
            <section class="tile bg-greensea">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Summary statistic')); ?></h1>
                    <span class="help-block"
                          style="color:white;"><?php echo e(__('Calculated different between investments and withdrawals')); ?></span>
                </div>
                <!-- /tile header -->
            <?php if(!empty($mergeDepositedAndWithdrew = getAdminMergeDepositedAndWithdrew())): ?>
                <!-- tile body -->
                    <div class="tile-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Currency')); ?></th>
                                    <th><?php echo e(__('Invested')); ?></th>
                                    <th><?php echo e(__('Withdrew')); ?></th>
                                    <th><?php echo e(__('Different')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = current($mergeDepositedAndWithdrew); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $d = $mergeDepositedAndWithdrew['deposited'][$currency];
                                    $w = $mergeDepositedAndWithdrew['withdrew'][$currency];
                                    ?>
                                    <tr>
                                        <td><?php echo e($currency); ?></td>
                                        <td style="font-weight: bold;"><?php echo e($d); ?></td>
                                        <td style="font-weight: bold;"><?php echo e($w); ?></td>
                                        <td style="font-weight: bold;"><?php echo e($d-$w); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /tile body -->
                <?php else: ?>
                    <div class="alert alert-warning alert-dismissable"><?php echo e(__('No summary statistic data exists ..')); ?></div>
                <?php endif; ?>
            </section>
            <!-- /tile -->

            <!-- tile -->
            <section class="tile" fullscreen="isFullscreen02">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><strong><?php echo e(__('Tariff plan popularity')); ?></strong></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" tabindex="0" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
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
                        <?php echo e(__('Financial statistics by days')); ?>

                    </h1>
                    <strong style="float:right;"><?php echo e(__('Last')); ?> 30 <?php echo e(__('days')); ?></strong>
                </div>
                <div class="tile-body">
                    <?php $__currentLoopData = getCurrencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h4 class="custom-font"><strong><?php echo e($currency['name']); ?></strong></h4>
                        <div id="line-<?php echo e($currency['code']); ?>" style="height: 250px;"></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="tile tile-simple">
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Users activity by days')); ?></h1>
                    <strong style="float:right;"><?php echo e(__('Last')); ?> 30 <?php echo e(__('days')); ?></strong>
                </div>
                <div class="tile-body">
                    <div id="line-area-analytics" style="height: 250px;"></div>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('load-scripts'); ?>
    // Morris line chart
    <?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

$faker = \Faker\Factory::create();
    ?>
    <?php $__currentLoopData = getCurrencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        Morris.Line({
        element: 'line-<?php echo e($currency['code']); ?>',
        data: [
        <?php $__currentLoopData = getAdminMoneyTrafficStatistic(30, $currency['code']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $amounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            {y: '<?php echo e($day); ?>', a: <?php echo e($amounts['enter'] ?? 0); ?>, b: <?php echo e($amounts['withdrew'] ?? 0); ?> },
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['<?php echo e(__('Enter')); ?>', '<?php echo e(__('Withdraw')); ?>'],
        lineColors: ['#16a085', '#FF0066']
        });
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    formatter:function (y, data) { return '<?php echo e(__('deposits')); ?>: '+y }
    });
    //*Initialize morris chart

    // Morris line area chart
    Morris.Area({
    element: 'line-area-analytics',
    data: [
    <?php $__currentLoopData = getAdminUsersActivityStatistic(30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        {y: '<?php echo e($date); ?>', a: <?php echo e($day['visitors']); ?>, b: <?php echo e($day['pageViews']); ?>},
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ],
    xkey: 'y',
    ykeys: ['a', 'b'],
    labels: ['Visitors', 'Page Views'],
    lineColors: ['#16a085', '#FF0066'],
    lineWidth: '0',
    grid: false,
    fillOpacity: '0.5'
    });
    // Morris line area chart
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>