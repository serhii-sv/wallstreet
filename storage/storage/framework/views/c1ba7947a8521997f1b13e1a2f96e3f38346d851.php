<?php $__env->startSection('title'); ?>
    <?php echo e(__('Tariff plan details')); ?> <?php echo e($rate->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.rates.index')); ?>"><?php echo e(__('Tariff plans')); ?></a></li>
    <li> <?php echo e(__('Tariff plan details')); ?>: <?php echo e($rate->name); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Tariff plan details')); ?></h1>
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
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row"><?php echo e(__('Tariff plan name')); ?></th>
                                <td><?php echo e($rate->name); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Currency')); ?></th>
                                <td><a href="<?php echo e(route('admin.currencies.edit', ['id' => $rate->currency_id])); ?>"
                                       target="_blank"><?php echo e($rate->currency->code); ?></a></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Min. investment')); ?></th>
                                <td style="font-weight: bold;"><?php echo e($rate->min); ?><?php echo e($rate->currency->symbol); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Max. investment')); ?></th>
                                <td style="font-weight: bold;"><?php echo e($rate->max); ?><?php echo e($rate->currency->symbol); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Duration')); ?></th>
                                <td><?php echo e($rate->duration); ?> <?php echo e(__('days')); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Daily earnings')); ?></th>
                                <td><?php echo e($rate->daily); ?>%</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Overall')); ?></th>
                                <td><?php echo e($rate->overall); ?>%</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Payout')); ?></th>
                                <td><?php echo e($rate->payout); ?>%</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Created')); ?></th>
                                <td><?php echo e($rate->created_at); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Last update')); ?></th>
                                <td><?php echo e($rate->updated_at); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Active')); ?></th>
                                <td><?php echo e($rate->active ? __('yes') : __('no')); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Compounding')); ?></th>
                                <td><?php echo e($rate->reinvest ? __('yes') : __('no')); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Auto closing')); ?></th>
                                <td><?php echo e($rate->autoclose ? __('yes') : __('no')); ?></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <a href="<?php echo e(route('admin.rates.edit', ['id' => $rate->id])); ?>"
                       class="btn btn-primary"><?php echo e(__('edit plan')); ?></a>
                    <a href="<?php echo e(route('admin.rates.destroy', ['id' => $rate->id])); ?>"
                       class="btn btn-danger sure"><?php echo e(__('destroy plan')); ?></a>
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