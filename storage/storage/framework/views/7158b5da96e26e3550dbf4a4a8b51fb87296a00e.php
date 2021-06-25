<?php $__env->startSection('title'); ?>
    <?php echo e(__('Deposit details')); ?> <?php echo e($deposit->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.deposits.index')); ?>"><?php echo e(__('Deposits')); ?></a></li>
    <li> <?php echo e(__('Deposit details')); ?>: <?php echo e($deposit->name); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Deposit details')); ?> </h1>
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
                                <th scope="row">ID</th>
                                <td></td>
                                <td><a href="<?php echo e(route('admin.deposits.show', ['id' => $deposit->id])); ?>"
                                       target="_top"><?php echo e($deposit->id); ?></a></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('User')); ?></th>
                                <td>
                                    <a href="<?php echo e(route('admin.users.show',['id'=>$deposit->user->id])); ?>"><?php echo e($deposit->user->login); ?>

                                        - <?php echo e($deposit->user->email); ?></a></td>
                                <td><a href="mailto:<?php echo e($deposit->user->email); ?>"
                                       target="_blank"><?php echo e($deposit->user->email); ?></a></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Invested')); ?></th>
                                <td><?php echo e($deposit->invested); ?><?php echo e($deposit->currency->symbol); ?></td>
                                <td><a href="<?php echo e(route('admin.currencies.edit', ['id' => $deposit->currency->id])); ?>"
                                       target="_blank"><?php echo e($deposit->currency->code); ?></a></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Current balance')); ?></th>
                                <td><?php echo e($deposit->balance); ?><?php echo e($deposit->currency->symbol); ?></td>
                                <td><a href="<?php echo e(route('admin.currencies.edit', ['id' => $deposit->currency->id])); ?>"
                                       target="_blank"><?php echo e($deposit->currency->code); ?></a></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Tariff plan')); ?></th>
                                <td><a href="<?php echo e(route('admin.rates.show',['id'=>$deposit->rate_id])); ?>">
                                        <?php echo e($deposit->rate->name); ?></a></td>
                                <td><?php echo e(__('minimum investment')); ?>

                                    : <?php echo e($deposit->rate->min); ?><?php echo e($deposit->currency->symbol); ?>, <?php echo e(__('maximum')); ?>

                                    : <?php echo e($deposit->rate->max); ?><?php echo e($deposit->currency->symbol); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Duration')); ?></th>
                                <td><?php echo e($deposit->duration); ?> <?php echo e(__('days')); ?></td>
                                <td><?php echo e(__('Closing')); ?>

                                    : <?php echo e(\Carbon\Carbon::parse($deposit->created_at)->addDays($deposit->duration)); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Daily earnings')); ?></th>
                                <td><?php echo e($deposit->daily); ?>%</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Overall')); ?></th>
                                <td><?php echo e($deposit->overall); ?>%</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Payout')); ?></th>
                                <td><?php echo e($deposit->payout); ?>%</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Created')); ?></th>
                                <td><?php echo e($deposit->created_at); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Last update')); ?></th>
                                <td><?php echo e($deposit->updated_at); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Status')); ?></th>
                                <td><?php echo e($deposit->active ? __('Active') : __('Closed')); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Compounding')); ?></th>
                                <td><?php echo e($deposit->reinvest ? $deposit->reinvest.'%' : __('no')); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Auto closing')); ?></th>
                                <td><?php echo e($deposit->autoclose ? __('yes') : __('no')); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Last action')); ?></th>
                                <td><?php echo e(__($deposit->condition)); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Deposit logs')); ?></th>
                                <td colspan="2"><textarea readonly
                                                          style="width:100%;" rows="10"><?php echo e($deposit->log); ?></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <a type="button" class="btn btn-warning sure"
                               href="<?php echo e(route('admin.deposits.block',['id'=>$deposit->id])); ?>"><?php echo e(__('Block deposit')); ?></a>
                            <a type="button" class="btn btn-success sure"
                               href="<?php echo e(route('admin.deposits.unblock',['id'=>$deposit->id])); ?>"><?php echo e(__('Unblock deposit')); ?></a>
                        </div>
                        <?php if($deposit->transactions()->count() > 0): ?>
                            <h3><?php echo e(__('Transactions')); ?> (<?php echo e($deposit->transactions->count()); ?>):</h3>
                            <ul class="list-group">
                                <?php $__currentLoopData = $deposit->transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item">
                                        <a href="<?php echo e(route('admin.transactions.show', ['id'=>$transaction->id])); ?>"
                                           target="_blank">
                                            <?php echo e(__('Type')); ?>:&nbsp;<?php echo e(__($transaction->type->name)); ?>

                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php echo e(__('Amount')); ?>

                                            :&nbsp;<?php echo e($transaction->amount); ?><?php echo e($transaction->currency->symbol); ?></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php echo e(__('Result')); ?>

                                        :&nbsp;<?php echo e(!empty($transaction->result) ? $transaction->result : __('empty')); ?>

                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php echo e(__('Status')); ?>

                                        :&nbsp;<?php echo e($transaction->approved ? __('approved') : __('pending')); ?>

                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php echo e(__('Created')); ?>:&nbsp;<?php echo e($transaction->created_at); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                        <?php if(count($deposit->failedJobs()) > 0): ?>
                            <h3><?php echo app('translator')->getFromJson('Failed earning jobs'); ?>:</h3>
                        <ul class="list-group">
                            <?php $__currentLoopData = $deposit->failedJobs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item">
                                    <?php echo e($element->id); ?>

                                    <?php echo e(explode("in", $element->exception)[0]); ?>

                                    <?php echo e($element->failed_at); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div>
                            <form action="<?php echo e(route('admin.failedjobs.retry')); ?>" method="post">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="deposit_id" value=<?php echo e($deposit->id); ?>>
                                <input type="submit" class="btn-danger"
                                       value="<?php echo e(__('Restart failed jobs for this deposit')); ?>">
                            </form>
                        </div>
                        <?php endif; ?>
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