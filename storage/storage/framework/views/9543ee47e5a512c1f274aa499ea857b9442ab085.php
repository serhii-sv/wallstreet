<?php $__env->startSection('title', __('Settings')); ?>
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
            <form class="form-horizontal" method="POST" action="<?php echo e(route('profile.settings')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group">
                    <label for="name" class="col-md-4 control-label"><?php echo e(__('Name')); ?></label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control"
                               name="name" value="<?php echo e(getUserName()); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-md-4 control-label"><?php echo e(__('Email')); ?></label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control"
                               name="email" value="<?php echo e(getUserEmail()); ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="login" class="col-md-4 control-label"><?php echo e(__('Login')); ?></label>
                    <div class="col-md-6">
                        <input id="login" type="text" class="form-control"
                               name="login" value="<?php echo e(getUserLogin() ? getUserLogin() : old('login')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="partner_id"
                           class="col-md-4 control-label"><?php echo e(__('Partner ID')); ?><?php echo e(!empty(getPartnerArray()) ? ' ('.getPartnerArray()['email'].')' : ''); ?></label>
                    <div class="col-md-6">
                        <input id="partner_id" type="text" class="form-control"
                               name="partner_id" value="<?php echo e(getPartnerId() ? getPartnerId() : old('partner_id')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-md-4 control-label"><?php echo e(__('Phone')); ?></label>
                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control"
                               name="phone" value="<?php echo e(getUserPhone() ? getUserPhone() : old('phone')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="skype" class="col-md-4 control-label"><?php echo e(__('Skype')); ?></label>
                    <div class="col-md-6">
                        <input id="skype" type="text" class="form-control"
                               name="skype" value="<?php echo e(getUserSkype() ? getUserSkype() : old('skype')); ?>">
                    </div>
                </div>

                <hr>

                <?php $__currentLoopData = getUserWallets(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <label style="font-weight: bold;" for="wallet_<?php echo e($wallet['id']); ?>" class="col-md-12 control-label"><?php echo e(__('Wallet address')); ?>, <?php echo e($wallet['payment_system']['name']); ?> <?php echo e($wallet['currency']['code']); ?>:</label>
                        <div class="col-md-6">
                            <input id="wallet_<?php echo e($wallet['id']); ?>" type="text" class="form-control"
                                   name="wallets[<?php echo e($wallet['id']); ?>]" value="<?php echo e($wallet['external']); ?>">
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <?php echo e(__('Save profile')); ?>

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>