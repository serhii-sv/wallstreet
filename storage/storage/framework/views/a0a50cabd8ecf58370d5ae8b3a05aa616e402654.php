<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit news')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <a href="<?php echo e(route('admin.news.index')); ?>"><?php echo e(__('News list')); ?></a></li>
    <li> <?php echo e(__('Edit news')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Edit news')); ?></h1>
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

                    <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                          action="<?php echo e(route('admin.news.update', ['id' => $news->id])); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="put">

                        <?php $__currentLoopData = $newsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <fieldset>
                                <legend><?php echo e(__($item['lang_name'])); ?></legend>
                                <div class="form-group">
                                    <label for="text" class="col-md-4 control-label"><?php echo e(__('News title')); ?></label>
                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control"
                                               name="title_<?php echo e($item['lang_code']); ?>"
                                               value="<?php echo e($item['title']); ?>">
                                        <input type="hidden" name="lang_id_<?php echo e($item['lang_code']); ?>"
                                               value="<?php echo e($item['lang_id']); ?>">
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea"><?php echo e(__('Teaser')); ?></label>
                                    <div class="col-md-6">
                                            <textarea class="form-control" id="textarea"
                                                      name="teaser_<?php echo e($item['lang_code']); ?>"><?php echo e($item['teaser']); ?></textarea>
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea"><?php echo e(__('News content')); ?></label>
                                    <div class="col-md-6">
                                            <textarea class="form-control" id="summernote"
                                                      name="text_<?php echo e($item['lang_code']); ?>"><?php echo e($item['text']); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="col-md-4 control-label"><?php echo e(__('Publish date')); ?></label>
                                    <div class="col-md-6">
                                        <input id="date" type="text" class="form-control"
                                               name="date_<?php echo e($item['lang_code']); ?>"
                                               value="<?php echo e($item['created_at']); ?>">
                                    </div>
                                </div>
                            </fieldset>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <hr>
                        <!-- Add preview image -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton"><?php echo e(__('News image')); ?></label>
                            <div class="col-md-4">
                                <img src="<?php echo e(File::exists($img) ? $img : ''); ?>" alt="<?php echo e(__('no image')); ?>" class="img-thumbnail" width="50%"><br>
                                <input id="img" name="img" class="input-file" type="file" accept="image/*">
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
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>