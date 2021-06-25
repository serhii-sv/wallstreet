<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create referral level')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.referral.index')); ?>"><?php echo e(__('Referral levels')); ?></a></li>
    <li> <?php echo e(__('Create referral level')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Create referral level')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" tabindex="0" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> <?php echo e(__('Fullscreen')); ?>

                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.referral.store')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"><?php echo e(__('Level')); ?></label>
                            <div class="col-md-6">
                                <input id="level" type="number" class="form-control" name="level" value="<?php echo e(old('level')); ?>" required
                                       autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="percent" class="col-md-4 control-label"><?php echo e(__('Percent')); ?></label>
                            <div class="col-md-6">
                                <input id="percent" type="number" step="any" class="form-control" name="percent" value="<?php echo e(old('percent')); ?>" required>
                            </div>
                        </div>

                        <!-- Multiple Checkboxes -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="checkboxes"><?php echo e(__('Recharge on')); ?></label>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label for="checkboxes-0">
                                        <input type="checkbox" name="on_load" id="checkboxes-0" checked>
                                        <?php echo e(__('balance recharge')); ?>

                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="checkboxes-1">
                                        <input type="checkbox" name="on_profit" id="checkboxes-1">
                                        <?php echo e(__('earnings')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Create level')); ?>

                                </button>
                            </div>
                        </div>
                    </form>

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