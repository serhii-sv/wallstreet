<?php $__env->startSection('title'); ?>
    <?php echo e(__('Register new task')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.user-tasks.tasks.index')); ?>"><?php echo e(__('Tasks list')); ?></a></li>
    <li> <?php echo e(__('Register new task')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Register new task')); ?></h1>
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

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.user-tasks.tasks.store')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"><?php echo e(__('Title')); ?></label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="<?php echo e(old('title')); ?>" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label"><?php echo e(__('Description')); ?></label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description" id="description" required><?php echo e(old('description')); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reward_amount" class="col-md-4 control-label"><?php echo e(__('Reward amount')); ?></label>
                            <div class="col-md-6">
                                <input id="reward_amount" type="number" class="form-control" name="reward_amount" value="0">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="reward_payment_system"><?php echo e(__('Reward payment system')); ?></label>
                            <div class="col-md-4">
                                <select id="reward_payment_system" name="reward_payment_system" class="form-control">
                                    <option value=""><?php echo e(__('no selected')); ?></option>
                                    <?php $__currentLoopData = getPaymentSystems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentSystem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $paymentSystem['currencies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($paymentSystem['id']); ?>:<?php echo e($currency['id']); ?>"><?php echo e($paymentSystem['name']); ?> [<?php echo e($currency['code']); ?>]</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duration" class="col-md-4 control-label"><?php echo e(__('Task duration [in minutes]')); ?></label>
                            <div class="col-md-6">
                                <input id="duration" type="number" class="form-control" name="duration" value="120">
                            </div>
                        </div>

                        <hr>

                        <h3><?php echo e(__('Enter resources links')); ?></h3>

                        <?php $__currentLoopData = \App\Models\UserTasks\TaskScopes::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scope): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group">
                            <label for="scope_<?php echo e($scope->id); ?>" class="col-md-4 control-label"><?php echo e($scope->getScopeDescription()); ?></label>
                            <div class="col-md-6">
                                <input id="scope_<?php echo e($scope->id); ?>" type="text" class="form-control" name="scope[<?php echo e($scope->id); ?>]" value="" placeholder="https://example.com/page">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Register new task')); ?>

                                </button>
                            </div>
                        </div>
                    </form>

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