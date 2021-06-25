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
                                <input id="reward_amount" type="number" step="any" class="form-control" name="reward_amount" value="0">
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
                            <label class="col-md-4 control-label" for="social_category"><?php echo e(__('Social category')); ?></label>
                            <div class="col-md-4">
                                <select id="social_category" name="social_category" class="form-control">
                                    <option value=""><?php echo e(__('no selected')); ?></option>
                                    <option value="youtube">Youtube</option>
                                    <option value="telegram">Telegram</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="facebook">Instagram</option>
                                    <option value="vilavi"}>Vilavi</option>
                                    <option value="blog">Blog</option>
                                    <option value="vk"{>Vkontakte</option>
                                    <option value="odnoklassniki">Odnoklassniki</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="category"><?php echo e(__('Category')); ?></label>
                            <div class="col-md-4">
                                <select id="category" name="category" class="form-control">
                                    <option value=""><?php echo e(__('not selected')); ?></option>
                                    <option value="animation"><?php echo e(__('Animation')); ?></option>
                                    <option value="business"><?php echo e(__('Business')); ?></option>
                                    <option value="gadgets"><?php echo e(__('Gadgets')); ?></option>
                                    <option value="18plus"><?php echo e(__('18 plus')); ?></option>
                                    <option value="games"><?php echo e(__('Games')); ?></option>
                                    <option value="beauty"><?php echo e(__('Beauty')); ?></option>
                                    <option value="lifehack"><?php echo e(__('Lifehack')); ?></option>
                                    <option value="cartoons"><?php echo e(__('Cartoons')); ?></option>
                                    <option value="news"><?php echo e(__('News')); ?></option>
                                    <option value="education"><?php echo e(__('Education')); ?></option>
                                    <option value="entertainment"><?php echo e(__('Entertainment')); ?></option>
                                    <option value="sport"><?php echo e(__('Sport')); ?></option>
                                    <option value="quotes"><?php echo e(__('Quotes')); ?></option>
                                    <option value="art"><?php echo e(__('Art')); ?></option>
                                    <option value="fashion"><?php echo e(__('Fashion')); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deadline" class="col-md-4 control-label"><?php echo e(__('Task deadline')); ?></label>
                            <div class="col-md-6">
                                <input id="deadline" type="text" class="form-control" name="deadline" value="">
                            </div>
                        </div>

                        <hr>

                        <h3><?php echo e(__('Reward coefficients')); ?></h3>

                            <div class="task_coefficients">
                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo e(__('Minimum time of completing task (in minutes)')); ?></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="coefficients[min_minutes][]" value="" placeholder="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deadline" class="col-md-4 control-label"><?php echo e(__('Maximum time of completing task (in minutes)')); ?></label>
                                    <div class="col-md-6">
                                        <input id="deadline" type="text" class="form-control" name="coefficients[max_minutes][]" value="" placeholder="10">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deadline" class="col-md-4 control-label"><?php echo e(__('Reward coefficient')); ?></label>
                                    <div class="col-md-6">
                                        <input id="deadline" type="text" class="form-control" name="coefficients[reward_coefficient][]" value="" placeholder="1.2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <input type="button" class="btn btn-default" id="one_more_coefficient" value="<?php echo e(__('One more coefficient')); ?>">
                                </div>
                            </div>

                        <hr>

                        <h3><?php echo e(__('Enter resources links')); ?></h3>

                        <?php echo $__env->make('admin.user-tasks.tasks.scopes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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

<?php $__env->startPush('load-scripts'); ?>
    <script>
        $(document).ready(function(){
            $('#deadline').datetimepicker();
        });

        $('#one_more_coefficient').click(function(){
            let block = $('.task_coefficients').last();
            let clone = block.clone();

            block.after(clone).after('<hr>');
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>