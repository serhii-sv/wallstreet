<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit payment system')); ?> <?php echo e($ps->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.payment-systems.index')); ?>"><?php echo e(__('Payment systems')); ?></a></li>
    <li> <?php echo e(__('Edit payment system')); ?>: <?php echo e($ps->name); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-md-12">

            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Edit payment system')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> <?php echo e(__('Fullscreen')); ?>

                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">

                    <form class="form-horizontal" method="POST"
                          action="<?php echo e(route('admin.payment-systems.update', ['id' => $ps->id])); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"><?php echo e(__('Payment system name')); ?></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                       value="<?php echo e($ps->name); ?>" required
                                       autofocus>
                            </div>
                        </div>


                        <div class="form-group">
                            <hr>
                            <strong style="margin-left:1%;"><?php echo e(__('Instant withdrawal limit')); ?></strong>
                            <hr>
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="col-md-4 control-label"><?php echo e($currency->code); ?></label>
                                <div class="col-md-6">
                                    <input id="instant_limit" type="text" class="form-control"
                                           name="instant_limit[<?php echo e($currency->code); ?>]"
                                           value="<?php echo e($ps->instant_limit[$currency->code]); ?>" required>
                                    <span class="help-block"><?php echo e(__('0 - turn off')); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="form-group">
                            <hr>
                            <strong style="margin-left:1%;"><?php echo e(__('Minimum balance recharge amount')); ?></strong>
                            <hr>
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="col-md-4 control-label"><?php echo e($currency->code); ?></label>
                                <div class="col-md-6">
                                    <input id="minimum_topup" type="text" class="form-control"
                                           name="minimum_topup[<?php echo e($currency->code); ?>]"
                                           value="<?php echo e($ps->minimum_topup[$currency->code]); ?>" required>
                                    <span class="help-block"><?php echo e(__('0 - any recharges')); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="form-group">
                            <hr>
                            <strong style="margin-left:1%;"><?php echo e(__('Minimum withdraw amount')); ?></strong>
                            <hr>
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="col-md-4 control-label"><?php echo e($currency->code); ?></label>
                                <div class="col-md-6">
                                    <input id="minimum_withdraw" type="text" class="form-control"
                                           name="minimum_withdraw[<?php echo e($currency->code); ?>]"
                                           value="<?php echo e($ps->minimum_withdraw[$currency->code]); ?>" required>
                                    <span class="help-block"><?php echo e(__('0 - any withdraws')); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <hr>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Update')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <strong style="margin-left:1%;"><?php echo e(__('Connection links')); ?></strong>
                    <hr>
                    <table class="table table-hover" style="margin-top:50px;">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Link type')); ?></th>
                            <th><?php echo e(__('URL')); ?></th>
                            <th><?php echo e(__('Request method')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(\Route::has($ps->code.'.status')): ?>
                        <tr>
                            <td><?php echo e(__('Status')); ?></td>
                            <td>
                                <input type="text" value="<?php echo e(route($ps->code.'.status')); ?>" class="form-control" readonly>
                            </td>
                            <td>
                                <span class="label bg-info">POST</span>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td><?php echo e(__('Success payment')); ?></td>
                            <td>
                                <input type="text" value="<?php echo e(route('profile.topup.payment_message', ['result' => 'ok'])); ?>" class="form-control" readonly>
                            </td>
                            <td>
                                <span class="label bg-info">GET</span>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo e(__('Failed payment')); ?></td>
                            <td>
                                <input type="text" value="<?php echo e(route('profile.topup.payment_message', ['result' => 'error'])); ?>" class="form-control" readonly>
                            </td>
                            <td>
                                <span class="label bg-info">GET</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <!-- /tile body -->
            </section>
            <!-- /tile -->
        </div>
        <!-- /col -->
    </div>
    <!-- /row -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>