<?php $__env->startSection('title'); ?>
    <?php echo e(__('Statistics')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Statistics')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-md-6">
            <!-- tile -->
            <section class="tile">
                <div class="tile-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <?php echo e(__('Active days')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getRunningDays()); ?><label style="float:right;">(<?php echo e(getDateOfLaunch()); ?>

                                        )</label></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e(__('Total accounts')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getTotalAccounts()); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e(__('Active accounts')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getActiveAccounts()); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e(__('Visitors online')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getVisitorsOnline()); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e(__('Member online')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getMembersOnline()); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e(__('Last update')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getLastUpdate()); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e(__('Summary deposits')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getDepositsCount()); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e(__('Active deposits')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getActiveDepositsCount()); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e(__('Closed deposits')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getClosedDepositsCount()); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e(__('Total transactions')); ?>

                            </td>
                            <td>
                                <strong><?php echo e(getAdminTransactionsCount()); ?></strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
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
                                <i class="fa fa-expand"></i> <?php echo e(__('Fullscreen')); ?>

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
                        <div id="line-<?php echo e($currency['code']); ?>" style="height: 250px;width:80%;"></div>
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
                    <div id="line-area-analytics" style="height: 250px;width:80%;"></div>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('load-scripts'); ?>
    <script>
        // Morris line chart
        <?php
        $faker = \Faker\Factory::create();
        ?>
        <?php $__currentLoopData = getCurrencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        Morris.Line({
            element: 'line-<?php echo e($currency['code']); ?>',
            data: [
                    <?php $__currentLoopData = getAdminMoneyTrafficStatistic(30, $currency['code']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $amounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    y: '<?php echo e($day); ?>', a: <?php echo e($amounts['enter'] ?? 0); ?>, b: <?php echo e($amounts['withdrew'] ?? 0); ?> },
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
            formatter: function (y, data) {
                return '<?php echo e(__('deposits')); ?>: ' + y
            }
        });
        //*Initialize morris chart

        // Morris line area chart
        Morris.Area({
            element: 'line-area-analytics',
            data: [
                    <?php $__currentLoopData = getAdminUsersActivityStatistic(30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    y: '<?php echo e($date); ?>', a: <?php echo e($day['visitors']); ?>, b: <?php echo e($day['pageViews']); ?>},
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
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>