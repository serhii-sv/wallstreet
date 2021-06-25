<?php $__env->startSection('title', __('Account')); ?>
<?php $__env->startSection('content'); ?>
    <div class="card card-outline-secondary">
        <div class="card-header">
            <strong><?php echo e(getUserName()); ?></strong>
            <strong style="float:right;"><?php echo e(__('Your balance')); ?>:
                <?php $__currentLoopData = getUserBalancesByCurrency(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symbol => $balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($symbol); ?> <?php echo e(number_format($balance, 2)); ?><?php echo e(!$loop->last ? ',' : ''); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </strong>
        </div>
        <div class="card-body">
            <?php echo $__env->make('partials.inform', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-header"><?php echo e(__('Summary invested')); ?></div>
                        <div class="card-body">
                            <ul>
                                <?php $__currentLoopData = getUserTotalDeposited(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symbol => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($symbol); ?> <?php echo e($amount); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-header"><?php echo e(__('Summary withdrawn')); ?></div>
                        <div class="card-body">
                            <ul>
                                <?php $__currentLoopData = getUserTotalWithdrawn(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symbol => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($symbol); ?> <?php echo e($amount); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-header"><?php echo e(__('Total earned')); ?></div>
                        <div class="card-body">
                            <ul>
                                <?php $__currentLoopData = getUserTotalEarned(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symbol => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($symbol); ?> <?php echo e($amount); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h3><?php echo e(__('Deposits list')); ?></h3>
            <table class="table table-striped" id="deposits-table" style="width:100%;">
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
            <h3><?php echo e(__('Operations list')); ?></h3>
            <table class="table table-striped" id="operations-table" style="width:100%;">
                <thead>
                <tr>
                    <th><?php echo e(__('Amount')); ?></th>
                    <th><?php echo e(__('Currency')); ?></th>
                    <th><?php echo e(__('Type')); ?></th>
                    <th><?php echo e(__('Approved')); ?></th>
                    <th><?php echo e(__('Date')); ?></th>
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
        jQuery('#deposits-table').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[5, "desc"]],
            "ajax": '<?php echo e(route('profile.deposits.dataTable')); ?>',
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
        jQuery('#operations-table').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[4, "desc"]],
            "ajax": '<?php echo e(route('profile.operations.dataTable')); ?>',
            "columns": [
                {
                    "data": 'amount',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return row['amount'] + row['currency']['symbol'];
                    }
                },
                {"data": "currency.name"},
                {"data": "type_name"},
                {
                    "data": "approved", "render": function (data, type, row, meta) {
                        if (row['approved'] == 1) {
                            return '<?php echo e(__('yes')); ?>';
                        }
                        return '<?php echo e(__('no')); ?>';
                    }
                },
                {"data": "created_at"},
            ],
        });
        //*initialize basic datatable
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>