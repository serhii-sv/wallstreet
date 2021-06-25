<?php $__env->startSection('title'); ?>
    <?php echo e(__('Transaction details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.transactions.index')); ?>"><?php echo e(__('Transactions')); ?></a></li>
    <li> <?php echo e(__('Transaction details')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Transaction details')); ?></h1>
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
                                <th scope="row"><?php echo e(__('Type')); ?></th>
                                <td><?php echo e(__($transaction->type->name)); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('User')); ?></th>
                                <td>
                                    <a href="<?php echo e(route('admin.users.show',['id'=>$transaction->user->id])); ?>"><?php echo e($transaction->user->login); ?></a>
                                </td>
                                <td><a href="mailto:<?php echo e($transaction->user->email); ?>"><?php echo e($transaction->user->email); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Amount')); ?></th>
                                <td><?php echo e($transaction->amount); ?><?php echo e($transaction->currency->symbol); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.currencies.edit', ['id' => $transaction->currency_id])); ?>"><?php echo e($transaction->currency->code); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Payment system')); ?></th>
                                <td>
                                    <a href="<?php echo e(route('admin.payment-systems.edit', ['id' => $transaction->payment_system_id])); ?>"><?php echo e($transaction->paymentSystem->name); ?></a>
                                </td>
                                <td></td>
                            </tr>
                            <?php if($transaction->deposit_id): ?>
                                <tr>
                                    <th scope="row"><?php echo e(__('Deposit ID')); ?></th>
                                    <td></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.deposits.show',['id'=>$transaction->deposit_id])); ?>"><?php echo e($transaction->deposit_id); ?></a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php if(null !== $transaction->rate): ?>
                                <tr>
                                    <th scope="row"><?php echo e(__('Tariff plan')); ?></th>
                                    <td>
                                        <a href="<?php echo e(route('admin.rates.show',['id'=>$transaction->rate_id])); ?>"><?php echo e($transaction->rate->name); ?></a>
                                    </td>
                                    <td></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($transaction->batch_id ): ?>
                            <tr>
                                <th scope="row"><?php echo e(__('Batch ID')); ?></th>
                                <td></td>
                                <td><?php echo e($transaction->batch_id); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($transaction->result)): ?>
                            <tr>
                                <th scope="row"><?php echo e(__('Payment system response')); ?></th>
                                <td><?php echo e($transaction->result); ?></td>
                                <td></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th scope="row"><?php echo e(__('Created')); ?></th>
                                <td><?php echo e($transaction->created_at); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Last update')); ?></th>
                                <td><?php echo e($transaction->updated_at); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Approved')); ?></th>
                                <td><?php echo e($transaction->approved ? __('yes') : __('no')); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Transaction logs')); ?></th>
                                <td colspan="2"><textarea readonly
                                                          style="width:100%; height: 100px;"><?php echo e($transaction->log); ?></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>

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