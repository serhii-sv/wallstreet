<?php $__env->startSection('title', __('Account')); ?>
<?php $__env->startSection('content'); ?>
    <div class="card card-outline-secondary">
        <div class="card-header">
            <strong><?php echo e(__('Nice to see you again')); ?>, <?php echo e(getUserName()); ?>!</strong>
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
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
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
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
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
            <?php if(count(getUserTotalDeposited(true)) > 0): ?>
                <h3><?php echo e(__('Deposits list')); ?></h3>
                <div class="row">
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo e(__('Currency')); ?></th>
                            <th scope="col"><?php echo e(__('Rate')); ?></th>
                            <th scope="col"><?php echo e(__('Earnings')); ?></th>
                            <th scope="col"><?php echo e(__('Invested')); ?></th>
                            <th scope="col"><?php echo e(__('Status')); ?></th>
                            <th scope="col"><?php echo e(__('Closing')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = getUserAllDeposits(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($deposit['currency']['name']); ?></td>
                                <td><?php echo e($deposit['rate']['name']); ?></td>
                                <td><?php echo e($deposit['rate']['daily']); ?>% <?php echo e(__('per day')); ?></td>
                                <td><?php echo e($deposit['invested']); ?></td>
                                <td><?php echo e($deposit['active'] == 1 ? __('active') : __('closed')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($deposit['created_at'])->addDays($deposit['rate']['duration'])->format('d-m-Y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-dark"
                     role="alert"><?php echo e(__('You don\'t have any deposits to see the list of them')); ?></div>
            <?php endif; ?>
            <hr>
            <?php if(count(getUserAllOperations()) > 0): ?>
                <h3><?php echo e(__('Operations list')); ?></h3>
                <div class="row">
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo e(__('Amount')); ?></th>
                            <th scope="col"><?php echo e(__('Currency')); ?></th>
                            <th scope="col"><?php echo e(__('Type')); ?></th>
                            <th scope="col"><?php echo e(__('Status')); ?></th>
                            <th scope="col"><?php echo e(__('Date')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = getUserAllOperations(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($operation['amount']); ?></td>
                                <td><?php echo e($operation['payment_system']['name']); ?> <?php echo e($operation['currency']['code']); ?></td>
                                <td><?php echo e(trans('main.transaction_types.'.$operation['type']['name'])); ?></td>
                                <td><?php echo e($operation['approved'] == 1 ? __('approved') : __('processing')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($operation['created_at'])->format('d-m-Y H:i')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-dark"
                     role="alert"><?php echo e(__('You don\'t have any operations to see the list of them')); ?></div>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>