<?php $__env->startSection('title'); ?>
    <?php echo e(__('News list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('News list')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('News list')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="<?php echo e(route('admin.news.create')); ?>">[<?php echo e(__('create news')); ?>]
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
                    <ul class="list-group">
                        <table id="news" class="table hover form-inline dt-bootstrap no-footer">
                            <thead>
                            <tr>
                                <th><?php echo e(__('News title')); ?></th>
                                <th><?php echo e(__('Actions')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $allNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" readonly value="<?php echo e($news->title); ?>">
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-primary btn-xs"
                                           href="<?php echo e(route('admin.news.edit', ['id' => $news->parent->id])); ?>"><?php echo e(__('edit')); ?></a>
                                        <a type="button" class="btn btn-warning btn-xs" href="#" onclick="
                                                var result = confirm('<?php echo e(__('Please confirm deletion')); ?>');
                                                if(result) {
                                                event.preventDefault();
                                                document.getElementById('delete-<?php echo e($news->parent->id); ?>').submit()
                                                }"><?php echo e(__('delete')); ?></a>
                                        <form action="<?php echo e(route('admin.news.destroy', ['id' => $news->parent->id])); ?>"
                                              method="POST"
                                              id="delete-<?php echo e($news->parent->id); ?>" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo e(method_field('DELETE')); ?>

                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php $__env->startPush('load-scripts'); ?>
                            <script>
                                $('#news').DataTable();
                            </script>
                        <?php $__env->stopPush(); ?>
                    </ul>
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