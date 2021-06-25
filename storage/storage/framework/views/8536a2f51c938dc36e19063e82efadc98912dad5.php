<?php $__env->startSection('title'); ?>
    <?php echo e(__('Referral levels')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Referral levels')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Referral levels')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="<?php echo e(route('admin.referral.create')); ?>">
                                [<strong><?php echo e(__('create new level')); ?></strong>]
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
                    <table id="levels" class="table hover form-inline dt-bootstrap no-footer">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Level')); ?></th>
                            <th><?php echo e(__('Percent')); ?></th>
                            <th><?php echo e(__('On balance recharge')); ?></th>
                            <th><?php echo e(__('On profit recharge')); ?></th>
                            <th><?php echo e(__('On task recharge')); ?></th>
                            <th><?php echo e(__('Actions')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = getAffiliateLevels(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($level['level']); ?></td>
                                <td>
                                    <strong><?php echo e($level['percent']); ?></strong>
                                </td>
                                <td><?php echo e($level['on_load'] ? __('yes') : __('no')); ?></td>
                                <td><?php echo e($level['on_profit'] ? __('yes') : __('no')); ?></td>
                                <td><?php echo e($level['on_task'] ? __('yes') : __('no')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.referral.edit', ['id' => $level['id']])); ?>" target="_blank"
                                       class="btn btn-primary"><?php echo e(__('edit')); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php $__env->startPush('load-scripts'); ?>
                        <script>
                            $('#levels').DataTable();
                        </script>
                    <?php $__env->stopPush(); ?>
                </div>
                <!-- /tile body -->

            </section>
            <!-- /tile -->
            <!-- Debug Info -->
            <div class="row">
                <div class="col-md-12">
                    <section class="tile tile-simple">
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><?php echo e(__('Users on same IP')); ?>:</h1>
                        </div>
                        <div class="tile-body">
                            <table id="duplicates" class="table hover form-inline dt-bootstrap no-footer">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('IP')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = \App\Models\UserIp::manyOnIp(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->ip); ?></td>
                                        <td><?php echo e($item->user->email); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php $__env->startPush('load-scripts'); ?>
                                <script>
                                    $('#duplicates').DataTable();
                                </script>
                            <?php $__env->stopPush(); ?>
                        </div>
                    </section>
                </div>
            </div>
            <!-- /Debug Info -->

        </div>
        <!-- /col -->
    </div>
    <!-- /row -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>