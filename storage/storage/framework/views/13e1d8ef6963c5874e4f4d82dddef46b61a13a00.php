<?php $__env->startSection('title'); ?>
    <?php echo e(__('Reviews')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Reviews')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Reviews')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="<?php echo e(route('admin.reviews.create')); ?>">[<?php echo e(__('create new review')); ?>]
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
                    <table id="reviews" class="table hover form-inline dt-bootstrap no-footer">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Client name')); ?></th>
                            <th><?php echo e(__('Review text')); ?></th>
                            <th><?php echo e(__('Video link')); ?></th>
                            <th><?php echo e(__('Actions')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = getCustomerReviews(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($review['name']); ?></td>
                                <td>
                                    <textarea class="form-control"
                                              readonly><?php echo e($review['text'] ?? 'no text'); ?></textarea>
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="<?php echo e($review['video'] ?? 'no video'); ?>"
                                           readonly>
                                </td>
                                <td>
                                    <a type="button" class="btn btn-primary btn-xs"
                                       href="<?php echo e(route('admin.reviews.edit', ['id' => $review['id']])); ?>"><?php echo e(__('edit')); ?></a>
                                    <a type="button" class="btn btn-warning btn-xs" href="#" onclick="
                                            var result = confirm('<?php echo e(__('Please confirm deletion')); ?>');
                                            if(result) {
                                            event.preventDefault();
                                            document.getElementById('delete-<?php echo e($review['id']); ?>').submit()
                                            }"><?php echo e(__('delete')); ?></a>
                                    <form action="<?php echo e(route('admin.reviews.destroy', ['id' => $review['id']])); ?>"
                                          method="POST"
                                          id="delete-<?php echo e($review['id']); ?>" style="display: none;">
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
                            $('#reviews').DataTable();
                        </script>
                    <?php $__env->stopPush(); ?>
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