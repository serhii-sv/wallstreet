<?php $__env->startSection('title'); ?>
    <?php echo e(__('Add template translation')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.tpl_texts.index')); ?>"><?php echo e(__('Template translations')); ?></a></li>
    <li> <?php echo e(__('Add template translation')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Add template translation')); ?></h1>
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

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.tpl_texts.store')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <?php $__currentLoopData = getLanguagesArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label for="text" class="col-md-4 control-label"><?php echo e(__($lang['name'])); ?></label>
                                <div class="col-md-6">
                                    <input id="text" type="text" class="form-control" name="text_<?php echo e($lang['code']); ?>"
                                           value="">
                                    <input type="hidden" name="lang_id_<?php echo e($lang['code']); ?>" value="<?php echo e($lang['id']); ?>">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="category"><?php echo e(__('Category')); ?></label>
                            <div class="col-md-6">
                                <select id="category" name="category" class="form-control">
                                    <option value="customer"><?php echo e(__('Customer')); ?></option>
                                    <option value="admin"><?php echo e(__('Admin')); ?></option>
                                    <option value="demo"><?php echo e(__('Demo')); ?></option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Create')); ?>

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