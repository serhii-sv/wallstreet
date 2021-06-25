<?php $__env->startSection('title', __('Create deposit')); ?>
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
            <form action="<?php echo e(route('profile.deposits.store')); ?>" method="POST" target="_top">
                <?php echo e(csrf_field()); ?>


                <div class="form-group">
                    <label class="col-md-4 control-label" for="rate"><?php echo e(__('Rate')); ?></label>
                    <div class="col-md-4">
                        <select id="rate" name="rate_id" class="form-control">
                            <?php $__currentLoopData = getTariffPlans(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($plan['id']); ?>"<?php echo e(isset($rate) && $rate['id'] == $plan['id'] ? ' selected' : ''); ?>><?php echo e($plan['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <p class="help-block" style="margin-left:20px;">
                    <strong><?php echo e(__('Selected rate')); ?></strong>: <?php echo e($rate['name']); ?>. <?php echo e(__('Minimum investment')); ?>

                    : <?php echo e(number_format($rate['min'], $rate['currency']['precision'])); ?><?php echo e($rate['currency']['symbol']); ?>

                    , <?php echo e(__('Maximum investment')); ?>

                    : <?php echo e(number_format($rate['max'], $rate['currency']['precision'])); ?><?php echo e($rate['currency']['symbol']); ?>

                    , <?php echo e(__('Daily interest')); ?>: <?php echo e($rate['daily']); ?>%</p>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="wallet"><?php echo e(__('Wallet')); ?></label>
                    <div class="col-md-4">
                        <select id="wallet" name="wallet_id" class="form-control">
                            <?php $__currentLoopData = getUserWallets($rate['currency']['id']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($wallet['id']); ?>"><?php echo e($wallet['payment_system']['name']); ?>

                                    - <?php echo e(number_format($wallet['balance'], $wallet['currency']['precision'])); ?><?php echo e($wallet['currency']['symbol']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount" class="col-md-4 control-label"><?php echo e(__('Amount')); ?></label>
                    <div class="col-md-6">
                        <input id="amount" type="number" step="any" class="form-control" name="amount"
                               value="<?php echo e(old('amount')); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <?php echo e(__('Create deposit')); ?>

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('load-scripts'); ?>
    <script>
        jQuery(document).ready(function(){
            jQuery('#rate').change(function(){
                var val = jQuery(this).val();
                location.assign('/deposits/create?rate_id='+val);
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>