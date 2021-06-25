<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->getFromJson('Template translations'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo app('translator')->getFromJson('Template translations'); ?></li>
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
                    <h1 class="custom-font"><?php echo app('translator')->getFromJson('Translations'); ?></h1>
                    <ul class="controls">
                        <?php if(auth()->check() && auth()->user()->hasRole('root')): ?>
                        <li>
                            <a role="button" href="<?php echo e(route('admin.tpl_texts.index',['category'=>'customer'])); ?>">customers's
                                texts
                            </a>
                        </li>
                        <li>
                            <a role="button" href="<?php echo e(route('admin.tpl_texts.index',['category'=>'admin'])); ?>">admin's texts
                            </a>
                        </li>
                        <li>
                            <a role="button" href="<?php echo e(route('admin.tpl_texts.index',['category'=>'demo'])); ?>">demo texts
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a role="button" href="<?php echo e(route('admin.tpl_texts.create')); ?>">[ <?php echo app('translator')->getFromJson('add new text'); ?> ]
                            </a>
                        </li>
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">

                    <ul class="list-group">
                        <?php $__currentLoopData = $texts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item">
                                <div class="pull-right">
                                    <a type="button" class="btn btn-success btn-xs"
                                       href="<?php echo e(route('admin.tpl_texts.edit', ['id' => $text->id])); ?>"><?php echo app('translator')->getFromJson('edit'); ?></a>
                                    <a type="button" class="btn btn-danger btn-xs" href="#" onclick="
                                            var result = confirm('Please confirm deletion');
                                            if(result) {
                                            event.preventDefault();
                                            document.getElementById('delete-<?php echo e($text->id); ?>').submit()
                                            }">x</a>
                                    <form action="<?php echo e(route('admin.tpl_texts.destroy', ['id' => $text->id])); ?>"
                                          method="POST"
                                          id="delete-<?php echo e($text->id); ?>" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                    </form>
                                </div>
                                <?php echo e($text->text); ?> - <?php echo e($text->lang->code); ?>

                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php echo e($texts->appends(['category' => $category])->links()); ?>

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