<?php $__env->startSection('title'); ?>
    <?php echo e(__('Tariff plans')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Tariff plans')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Tariff plans')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button"
                               href="<?php echo e(route('admin.rates.create')); ?>">[<strong><?php echo e(__('create new tariff plan')); ?></strong>]</a>
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
                    <table id="plans" class="table hover form-inline dt-bootstrap no-footer">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Plan name')); ?></th>
                            <th><?php echo e(__('Min. investment')); ?></th>
                            <th><?php echo e(__('Max. investment')); ?></th>
                            <th><?php echo e(__('Daily')); ?></th>
                            <th><?php echo e(__('Active')); ?></th>
                            <th><?php echo e(__('Actions')); ?></th>
                        </tr>
                        </thead>
                        <?php $__currentLoopData = getTariffPlans(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                            <td><?php echo e($plan['name']); ?></td>
                            <td style="font-weight: bold;"><?php echo e($plan['min']); ?><?php echo e($plan['currency']['symbol']); ?></td>
                            <td style="font-weight: bold;"><?php echo e($plan['max']); ?><?php echo e($plan['currency']['symbol']); ?></td>
                            <td><?php echo e($plan['daily']); ?>%</td>
                            <td>
                                <?php echo $plan['active'] == 1
                                    ? '<strong style="color:green;">'.__('yes').'</strong>'
                                    : '<strong style="color:red;">'.__('no').'</strong>'; ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.rates.show', ['id' => $plan['id']])); ?>" target="_blank"
                                   class="btn btn-primary"><?php echo e(__('show')); ?></a>
                            </td>
                            </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                    <?php $__env->startPush('load-scripts'); ?>
                        <script>
                            $('#plans').DataTable();
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