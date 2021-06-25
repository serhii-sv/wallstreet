<?php $__env->startSection('title'); ?>
    <?php echo e(__('Add news')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <a href="<?php echo e(route('admin.news.index')); ?>"><?php echo e(__('News list')); ?></a></li>
    <li> <?php echo e(__('Add news')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Add news')); ?></h1>
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

                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.news.store')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <?php $__currentLoopData = getLanguagesArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <fieldset>
                                <legend><?php echo e(__($lang['name'])); ?></legend>
                                <div class="form-group">
                                    <label for="title" class="col-md-4 control-label"><?php echo e(__('Title')); ?></label>
                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control"
                                               name="title_<?php echo e($lang['code']); ?>"
                                               value="">
                                        <input type="hidden" name="lang_id_<?php echo e($lang['code']); ?>"
                                               value="<?php echo e($lang['id']); ?>">
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea"><?php echo e(__('Teaser')); ?></label>
                                    <div class="col-md-6">
                                            <textarea class="form-control" id="textarea"
                                                      name="teaser_<?php echo e($lang['code']); ?>"> </textarea>
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea"><?php echo e(__('Content')); ?></label>
                                    <div class="col-md-6">
                                            <textarea class="form-control" id="textarea"
                                                      name="text_<?php echo e($lang['code']); ?>"> </textarea>
                                    </div>
                                </div>
                            </fieldset>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <hr>
                        <!-- Add preview image -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton"><?php echo e(__('News image')); ?></label>
                            <div class="col-md-4">
                                <input id="img" name="img" class="input-file" type="file" accept="image/*">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Add news')); ?>

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