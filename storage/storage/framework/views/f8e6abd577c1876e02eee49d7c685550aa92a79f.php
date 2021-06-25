<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit FAQ')); ?> <?php echo e($faq->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <a href="<?php echo e(route('admin.faqs.index')); ?>"><?php echo e(__('FAQ list')); ?></a></li>
    <li> <?php echo e(__('Edit FAQ')); ?>: <?php echo e($faq->title); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Edit FAQ')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="<?php echo e(route('admin.faqs.index')); ?>">[<?php echo e(__('back to FAQ list')); ?>]
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
                          action="<?php echo e(route('admin.faqs.update', ['id' => $faq->id])); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="put">

                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="lang_id"><?php echo e(__('Language')); ?></label>
                                <div class="col-md-4">
                                    <select id="lang_id" name="lang_id" class="form-control">
                                        <?php $__currentLoopData = getLanguagesArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($lang['id']); ?>"<?php echo e($lang['id'] == $faq['lang_id'] ? ' selected' : ''); ?>><?php echo e($lang['name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-md-2 control-label"><?php echo e(__('Question')); ?></label>
                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control"
                                           name="title" value="<?php echo e($faq->title); ?>" required>
                                </div>
                            </div>
                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textarea"><?php echo e(__('Answer')); ?></label>
                                <div class="col-md-8">
                                            <textarea class="form-control" id="textarea" rows="10"
                                                      name="text"><?php echo e($faq->text); ?> </textarea>
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