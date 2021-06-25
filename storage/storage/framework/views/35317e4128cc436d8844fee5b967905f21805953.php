<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit language')); ?> <?php echo e($lang->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.langs.index')); ?>"><?php echo e(__('Languages')); ?></a></li>
    <li> <?php echo e(__('Edit language')); ?>: <?php echo e($lang->name); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Edit language')); ?></h1>
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

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.langs.update', ['id' => $lang->id])); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"><?php echo e(__('Language name')); ?></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e($lang->name); ?>" required
                                       autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label"><?php echo e(__('Code')); ?></label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="code"
                                       value="<?php echo e($lang->code); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label"><?php echo e(__('Original name')); ?></label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="original_name"
                                       value="<?php echo e($lang->original_name); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label"><?php echo e(__('default language')); ?></label>
                            <div class="col-md-6">
                                <input type="checkbox" name="default" value="1" <?php echo e($lang->default ? 'checked' : ''); ?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Update')); ?>

                                </button>
                                <a href="<?php echo e(route('admin.langs.destroy', ['id' => $lang->id])); ?>"
                                   class="btn btn-danger sure"><?php echo e(__('Destroy language')); ?></a>
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