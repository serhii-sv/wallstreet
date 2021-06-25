<?php $__env->startSection('title', __('Top up balance')); ?>
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
            <form class="form-horizontal" method="POST" action="<?php echo e(route('profile.topup')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group">
                    <label class="col-md-4 control-label" for="currency"><?php echo e(__('Currency')); ?></label>
                    <div class="col-md-4">
                        <select id="currency" name="currency" class="form-control" autofocus>
                            <?php $__currentLoopData = getPaymentSystems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentSystem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $paymentSystem['currencies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($paymentSystem['id'].':'.$currency['id']); ?>"><?php echo e($paymentSystem['name']); ?> <?php echo e($currency['code']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount" class="col-md-4 control-label"><?php echo e(__('Amount')); ?></label>
                    <div class="col-md-6">
                        <input id="amount" type="number" step="any" class="form-control"
                               name="amount" required>
                        <?php if(getEnterCommission() > 0): ?>
                            <span class="help-block"><?php echo e(__('System commission')); ?> <?php echo e(getEnterCommission()); ?> %</span>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-4">
                        <?= captcha_img() ?>
                    </div>
                    <label class="col-md-4 control-label" for="captcha"><?php echo e(__('Enter captcha code')); ?></label>
                    <div class="col-lg-6">
                        <input type="text" name="captcha" id="captcha" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <?php echo e(__('Process')); ?>

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>