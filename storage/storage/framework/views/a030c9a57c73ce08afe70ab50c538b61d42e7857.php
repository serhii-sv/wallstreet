<?php $__env->startSection('title', __('Operations')); ?>
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