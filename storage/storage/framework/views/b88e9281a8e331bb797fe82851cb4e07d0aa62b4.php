<?php $__env->startSection('title'); ?>
    <?php echo e(__('Payment systems')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Payment systems')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Payment systems')); ?></h1>
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
                    <table id="paymentSystems" class="table hover form-inline dt-bootstrap no-footer">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Payment system name')); ?></th>
                            <th><?php echo e(__('Code')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('External balances')); ?></th>
                            <th><?php echo e(__('Actions')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = \App\Models\PaymentSystem::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($ps['name']); ?></td>
                                <td style="font-weight: bold;"><?php echo e($ps['code']); ?></td>
                                <td><?php echo $ps['connected'] ? '<strong class="label bg-greensea" data-toggle="tooltip" data-placement="right" title="'.__('Customers can use this payment system').'">'.__('connection established').'</strong>' : '<strong class="label bg-red" data-toggle="tooltip" data-placement="right" title="'.__('Please, check the accesses and wait approx. 10 minutes for updating status.').'">'.__('connection failed').'</strong>'; ?></td>
                                <td style="font-weight: bold;">
                                    <?php
                                    $externalBalancesArray = json_decode($ps['external_balances'], true);
                                    ?>
                                    <?php if(is_array($externalBalancesArray) && count($externalBalancesArray)): ?>
                                        <?php $__currentLoopData = $externalBalancesArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $limit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($limit); ?> <?php echo e($code); ?><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a type="button" class="btn btn-primary btn-xs"
                                       href="<?php echo e(route('admin.payment-systems.edit', ['id' => $ps['id']])); ?>"><?php echo e(__('edit')); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php $__env->startPush('load-scripts'); ?>
                        <script>
                            $('#paymentSystems').DataTable();
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

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>