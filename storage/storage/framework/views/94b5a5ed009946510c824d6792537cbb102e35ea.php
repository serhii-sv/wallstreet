<?php $__env->startSection('title', __('Deposits')); ?>
<?php $__env->startSection('content'); ?>
    <div class="card card-outline-secondary">
        <div class="card-header">
            <strong><?php echo e(__('Hi')); ?>, <?php echo e(getUserName()); ?></strong>
            <strong style="float:right;"><?php echo e(__('Your balance')); ?>:
                <?php $__currentLoopData = getUserBalancesByCurrency(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symbol => $balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($symbol); ?> <?php echo e(number_format($balance, 2)); ?><?php echo e(!$loop->last ? ',' : ''); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </strong>
        </div>
        <div class="card-body">
            <?php echo $__env->make('partials.inform', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <h3><?php echo e(__('Open new deposit')); ?><label style="float:right;"><?php echo e(__('Choose your tariff plan')); ?></label></h3>
            <div class="row">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <ul class="list-group">
                            <?php $__currentLoopData = getTariffPlans(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item">
                                    <a href="<?php echo e(route('profile.deposits.create', ['rate_id' => $plan['id']])); ?>"><?php echo e($plan['name']); ?>

                                        - <?php echo e($plan['currency']['code']); ?></a><br>
                                    <?php echo e(__('Minimum investment')); ?>: <?php echo e($plan['min']); ?>, <?php echo e(__('Maximum investment')); ?>

                                    : <?php echo e($plan['max']); ?>, <?php echo e(__('Daily interest')); ?>: <?php echo e($plan['daily']); ?>

                                    %, <?php echo e(__('Plan duration')); ?>: <?php echo e($plan['duration']); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <hr style="margin-top:30px;">
            <h3><?php echo e(__('Active deposits list')); ?></h3>
            <table class="table table-striped" id="deposits-table-active" style="width:100%;">
                <thead>
                <tr>
                    <th><?php echo e(__('Currency')); ?></th>
                    <th><?php echo e(__('Rate')); ?></th>
                    <th><?php echo e(__('Earnings')); ?></th>
                    <th><?php echo e(__('Invested')); ?></th>
                    <th><?php echo e(__('Status')); ?></th>
                    <th><?php echo e(__('Closing')); ?></th>
                </tr>
                </thead>
            </table>
            <hr>
            <h3><?php echo e(__('Closed deposits list')); ?></h3>
            <table class="table table-striped" id="deposits-table-closed" style="width:100%;">
                <thead>
                <tr>
                    <th><?php echo e(__('Currency')); ?></th>
                    <th><?php echo e(__('Rate')); ?></th>
                    <th><?php echo e(__('Earnings')); ?></th>
                    <th><?php echo e(__('Invested')); ?></th>
                    <th><?php echo e(__('Status')); ?></th>
                    <th><?php echo e(__('Closing')); ?></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('load-scripts'); ?>
    <script>
        //initialize basic datatable
        jQuery('#deposits-table-active').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[5, "desc"]],
            "ajax": '<?php echo e(route('profile.deposits.dataTable', ['active' => 1])); ?>',
            "columns": [
                {"data": "currency.name"},
                {"data": "rate.name"},
                {
                    "data": 'daily',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['daily'] + '% <?php echo e(__('per day')); ?>';
                    }
                },
                {
                    "data": 'invested',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['invested'] + row['currency']['symbol'];
                    }
                },
                {
                    "data": 'active',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['active'] == 1 ? '<?php echo e(__('active')); ?>' : '<?php echo e(__('closed')); ?>';
                    }
                },
                {"data": "closing_at"},
            ],
        });
        //*initialize basic datatable
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('load-scripts'); ?>
    <script>
        //initialize basic datatable
        jQuery('#deposits-table-closed').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[5, "desc"]],
            "ajax": '<?php echo e(route('profile.deposits.dataTable', ['active' => 0])); ?>',
            "columns": [
                {"data": "currency.name"},
                {"data": "rate.name"},
                {
                    "data": 'daily',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['daily'] + '% <?php echo e(__('per day')); ?>';
                    }
                },
                {
                    "data": 'invested',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['invested'] + row['currency']['symbol'];
                    }
                },
                {
                    "data": 'active',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['active'] == 1 ? '<?php echo e(__('active')); ?>' : '<?php echo e(__('closed')); ?>';
                    }
                },
                {"data": "closing_at"},
            ],
        });
        //*initialize basic datatable
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>