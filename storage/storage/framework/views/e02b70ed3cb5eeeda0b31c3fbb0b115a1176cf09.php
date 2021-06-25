<?php $__env->startSection('title'); ?>
    <?php echo e(__('Withdrawal request details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.requests.index')); ?>"><?php echo e(__('Withdrawal requests')); ?></a></li>
    <li> <?php echo e(__('Withdrawal request details')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Withdrawal request details')); ?></h1>
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
                                <th scope="row"><?php echo e(__('Amount')); ?></th>
                                <td><?php echo e($withdrawalRequest->amount); ?><?php echo e($withdrawalRequest->wallet->currency->symbol); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.currencies.edit', ['id' => $withdrawalRequest->wallet->currency->id])); ?>"
                                       target="_blank"><?php echo e($withdrawalRequest->wallet->currency->code); ?></a></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Wallet')); ?></th>
                                <td style="font-weight: bold;"><?php echo e($withdrawalRequest->wallet->external); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Payment system')); ?></th>
                                <td>
                                    <a href="<?php echo e(route('admin.payment-systems.edit', ['id' => $withdrawalRequest->wallet->paymentSystem->id])); ?>"
                                       target="_blank"><?php echo e($withdrawalRequest->wallet->paymentSystem->name); ?></a></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('User')); ?></th>
                                <td>
                                    <a href="<?php echo e(route('admin.users.show',['id'=>$withdrawalRequest->wallet->user->id])); ?>"
                                       target="_blank"><?php echo e($withdrawalRequest->wallet->user->login); ?></a></td>
                                <td><a href="mailto:<?php echo e($withdrawalRequest->wallet->user->email); ?>"
                                       target="_blank"><?php echo e($withdrawalRequest->wallet->user->email); ?></a></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('User wallet balance')); ?></th>
                                <td><?php echo e($withdrawalRequest->wallet->balance); ?><?php echo e($withdrawalRequest->wallet->currency->symbol); ?>

                                    <br>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Order status')); ?></th>
                                <td><?php echo e(__($withdrawalRequest->status)); ?></td>
                                <td> </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Order created')); ?></th>
                                <td><?php echo e($withdrawalRequest->created_at); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Order last update')); ?></th>
                                <td><?php echo e($withdrawalRequest->updated_at); ?></td>
                                <td></td>
                            </tr>

                            <tr>
                                <th scope="row"><?php echo e(__('Order logs')); ?></th>
                                <td colspan="2"><textarea readonly style="width:100%;"
                                                          rows="10"><?php echo e($withdrawalRequest->log); ?></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <a type="button" class="btn btn-success sure"
                               href="<?php echo e(route('admin.requests.approve',['id'=>$withdrawalRequest->id])); ?>"><?php echo e(__('Approve')); ?></a>
                            <a type="button" class="btn btn-danger sure"
                               href="<?php echo e(route('admin.requests.reject',['id'=>$withdrawalRequest->id])); ?>"><?php echo e(__('reject')); ?></a>
                        </div>
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

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>