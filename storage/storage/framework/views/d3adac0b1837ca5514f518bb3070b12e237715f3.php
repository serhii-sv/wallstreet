<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit review')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.reviews.index')); ?>"><?php echo e(__('Reviews')); ?></a></li>
    <li> <?php echo e(__('Edit review')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Edit review')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="<?php echo e(route('admin.reviews.index')); ?>">[<?php echo e(__('back to reviews list')); ?>

                                ]
                            </a>
                        </li>
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

                    <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                          action="<?php echo e(route('admin.reviews.update', ['id' => $review->id])); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="put">

                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="lang_id"><?php echo e(__('Language')); ?></label>
                                <div class="col-md-4">
                                    <select id="lang_id" name="lang_id" class="form-control">
                                        <?php $__currentLoopData = getLanguagesArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($lang['id']); ?>"<?php echo e($lang['id'] == $review->lang_id ? ' selected' : ''); ?>><?php echo e($lang['name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label"><?php echo e(__('Customer name')); ?></label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control"
                                           name="name" value="<?php echo e($review->name); ?>" required>
                                </div>
                            </div>
                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textarea"><?php echo e(__('Review text')); ?></label>
                                <div class="col-md-8">
                                            <textarea class="form-control" id="textarea" rows="10"
                                                      name="text"><?php echo e($review->text); ?> </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="video" class="col-md-2 control-label"><?php echo e(__('Video link')); ?></label>
                                <div class="col-md-8">
                                    <input id="video" type="text" class="form-control"
                                           name="video" value="<?php echo e($review->video); ?>">
                                </div>
                            </div>
                        </fieldset>

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