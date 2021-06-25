<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit template translation')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.tpl_texts.index')); ?>"><?php echo e(__('Template translations')); ?></a></li>
    <li> <?php echo e(__('Edit template translation')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Edit template translation')); ?></h1>
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
                          action="<?php echo e(route('admin.tpl_texts.update', ['id' => $id])); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="put">

                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label for="text" class="col-md-4 control-label"><?php echo e($item['lang_name']); ?></label>
                                <div class="col-md-6">
                                    <input id="text" type="text" class="form-control"
                                           name="text_<?php echo e($item['lang_code']); ?>"
                                           value="<?php echo e($item['text']); ?>">
                                    <input type="hidden" name="lang_id_<?php echo e($item['lang_code']); ?>"
                                           value="<?php echo e($item['lang_id']); ?>">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="category"><?php echo e(__('Category')); ?></label>
                            <div class="col-md-6">
                                <select id="category" name="category" class="form-control">
                                    <option value="admin"<?php echo e($category == 'admin' ? ' selected' : ''); ?>><?php echo e(__('Admin translation')); ?></option>
                                    <option value="customer"<?php echo e($category == 'customer' ? ' selected' : ''); ?>><?php echo e(__('Customer translation')); ?></option>
                                    <option value="demo"<?php echo e($category == 'demo' ? ' selected' : ''); ?>><?php echo e(__('Demo translation')); ?></option>
                                </select>
                                <span class="help-block"></span>
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