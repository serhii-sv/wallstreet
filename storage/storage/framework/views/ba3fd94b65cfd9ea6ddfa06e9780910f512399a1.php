<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit currency')); ?> <?php echo e($currency->code); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.currencies.index')); ?>"><?php echo e(__('Currencies')); ?></a></li>
    <li> <?php echo e(__('Edit currency')); ?>: <?php echo e($currency->code); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Edit currency')); ?></h1>
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
                          action="<?php echo e(route('admin.currencies.update', ['id' => $currency->id])); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label for="name"
                                   class="col-md-4 control-label"><?php echo e(__('Name for')); ?> <?php echo e($currency->code); ?></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                       value="<?php echo e($currency->name); ?>" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="precision" class="col-md-4 control-label"><?php echo e(__('Precision')); ?></label>
                            <div class="col-md-6">
                                <input id="precision" type="number" class="form-control" name="precision"
                                       value="<?php echo e($currency->precision); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Update')); ?>

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
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>