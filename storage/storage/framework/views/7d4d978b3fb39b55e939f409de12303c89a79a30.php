<?php $__env->startSection('title'); ?>
    <?php echo e(__('Currencies')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><?php echo e(__('Currencies')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Currencies')); ?></h1>
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
                    <div class="tile-body">
                        <table id="currencies" class="table hover form-inline dt-bootstrap no-footer">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Currency name')); ?></th>
                                <th><?php echo e(__('Code')); ?></th>
                                <th><?php echo e(__('Precision')); ?></th>
                                <th><?php echo e(__('Actions')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = getCurrencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($currency['name']); ?></td>
                                    <td style="font-weight: bold;"><?php echo e($currency['code']); ?></td>
                                    <td style="font-weight: bold;"><?php echo e($currency['precision']); ?></td>
                                    <td>
                                        <a type="button" class="btn btn-success btn-xs"
                                           href="<?php echo e(route('admin.currencies.edit', ['id' => $currency['id']])); ?>"><?php echo e(__('edit')); ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php $__env->startPush('load-scripts'); ?>
                            <script>
                                $('#currencies').DataTable();
                            </script>
                        <?php $__env->stopPush(); ?>
                    </div>
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