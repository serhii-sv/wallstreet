<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit task')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.user-tasks.tasks.index')); ?>"><?php echo e(__('Tasks list')); ?></a></li>
    <li> <?php echo e(__('Edit task')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Edit task')); ?></h1>
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

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.user-tasks.tasks.update', ['id' => $task->id])); ?>">
                        <?php echo e(csrf_field()); ?>


                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="id" value="<?php echo e($task->id); ?>">

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"><?php echo e(__('Title')); ?></label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="<?php echo e($task->title); ?>" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label"><?php echo e(__('Description')); ?></label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description" id="description" required><?php echo e($task->description); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reward_amount" class="col-md-4 control-label"><?php echo e(__('Reward amount')); ?></label>
                            <div class="col-md-6">
                                <input id="reward_amount" type="number" step="any" class="form-control" name="reward_amount" value="<?php echo e($task->reward_amount); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="reward_payment_system"><?php echo e(__('Reward payment system')); ?></label>
                            <div class="col-md-4">
                                <select id="reward_payment_system" name="reward_payment_system" class="form-control">
                                    <option value=""><?php echo e(__('no selected')); ?></option>
                                    <?php $__currentLoopData = getPaymentSystems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentSystem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $paymentSystem['currencies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($paymentSystem['id']); ?>:<?php echo e($currency['id']); ?>"<?php echo e($task->reward_payment_system_id == $paymentSystem['id'] && $task->reward_currency_id == $currency['id'] ? ' selected' : ''); ?>><?php echo e($paymentSystem['name']); ?> [<?php echo e($currency['code']); ?>]</option>
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
                                    <option value="youtube"<?php echo e($task->social_category == 'youtube' ? ' selected' : ''); ?>>Youtube</option>
                                    <option value="telegram"<?php echo e($task->social_category == 'telegram' ? ' selected' : ''); ?>>Telegram</option>
                                    <option value="facebook"<?php echo e($task->social_category == 'facebook' ? ' selected' : ''); ?>>Facebook</option>
                                    <option value="facebook"<?php echo e($task->social_category == 'facebook' ? ' selected' : ''); ?>>Instagram</option>
                                    <option value="vilavi"<?php echo e($task->social_category == 'vilavi' ? ' selected' : ''); ?>>Vilavi</option>
                                    <option value="blog"<?php echo e($task->social_category == 'blog' ? ' selected' : ''); ?>>Blog</option>
                                    <option value="vk"<?php echo e($task->social_category == 'vk' ? ' selected' : ''); ?>>Vkontakte</option>
                                    <option value="odnoklassniki"<?php echo e($task->social_category == 'odnoklassniki' ? ' selected' : ''); ?>>Odnoklassniki</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="category"><?php echo e(__('Category')); ?></label>
                            <div class="col-md-4">
                                <select id="category" name="category" class="form-control">
                                    <option value=""><?php echo e(__('not selected')); ?></option>
                                    <option value="animation"<?php echo e($task->category == 'animation' ? ' selected' : ''); ?>><?php echo e(__('Animation')); ?></option>
                                    <option value="business"<?php echo e($task->category == 'business' ? ' selected' : ''); ?>><?php echo e(__('Business')); ?></option>
                                    <option value="gadgets"<?php echo e($task->category == 'gadgets' ? ' selected' : ''); ?>><?php echo e(__('Gadgets')); ?></option>
                                    <option value="18plus"<?php echo e($task->category == '18plus' ? ' selected' : ''); ?>><?php echo e(__('18 plus')); ?></option>
                                    <option value="games"<?php echo e($task->category == 'games' ? ' selected' : ''); ?>><?php echo e(__('Games')); ?></option>
                                    <option value="beauty"<?php echo e($task->category == 'beauty' ? ' selected' : ''); ?>><?php echo e(__('Beauty')); ?></option>
                                    <option value="lifehack"<?php echo e($task->category == 'lifehack' ? ' selected' : ''); ?>><?php echo e(__('Lifehack')); ?></option>
                                    <option value="cartoons"<?php echo e($task->category == 'cartoons' ? ' selected' : ''); ?>><?php echo e(__('Cartoons')); ?></option>
                                    <option value="news"<?php echo e($task->category == 'news' ? ' selected' : ''); ?>><?php echo e(__('News')); ?></option>
                                    <option value="education"<?php echo e($task->category == 'education' ? ' selected' : ''); ?>><?php echo e(__('Education')); ?></option>
                                    <option value="entertainment"<?php echo e($task->category == 'entertainment' ? ' selected' : ''); ?>><?php echo e(__('Entertainment')); ?></option>
                                    <option value="sport"<?php echo e($task->category == 'sport' ? ' selected' : ''); ?>><?php echo e(__('Sport')); ?></option>
                                    <option value="quotes"<?php echo e($task->category == 'quotes' ? ' selected' : ''); ?>><?php echo e(__('Quotes')); ?></option>
                                    <option value="art"<?php echo e($task->category == 'art' ? ' selected' : ''); ?>><?php echo e(__('Art')); ?></option>
                                    <option value="fashion"<?php echo e($task->category == 'fashion' ? ' selected' : ''); ?>><?php echo e(__('Fashion')); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deadline" class="col-md-4 control-label"><?php echo e(__('Task deadline')); ?></label>
                            <div class="col-md-6">
                                <input id="deadline" type="text" class="form-control" name="deadline" value="<?php echo e(\Carbon\Carbon::parse($task->deadline)->format('m/d/Y h:i A')); ?>">
                            </div>
                        </div>

                        <hr>

                        <h3><?php echo e(__('Reward coefficients')); ?></h3>

                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                        <?php
                        /** @var TaskCoefficients $coefficients */
                        $coefficients = $task->coefficients()->orderBy('min_minutes');

                        if (0 === $coefficients->count()) {
                            echo '<strong>'.__('No registered coefficients').'</strong>';
                        } else {
                            $count = 1;

                            foreach ($coefficients->get() as $coefficient) {
                                if ($count > 1) {
                                    echo '<hr>';
                                }
                                ?>
                                <?php echo e(__('Minimum time of completing task (in minutes)')); ?>: <strong><?php echo e($coefficient->min_minutes); ?></strong><br>
                                <?php echo e(__('Maximum time of completing task (in minutes)')); ?>: <strong><?php echo e($coefficient->max_minutes); ?></strong><br>
                                <?php echo e(__('Reward coefficient')); ?>: <strong><?php echo e($coefficient->reward_coefficient); ?></strong>
                                <?php
                                $count++;
                            }
                        }
                        ?>
                            </div>
                        </div>

                        <hr>

                        <h3><?php echo e(__('Enter resources links')); ?></h3>

                        <?php echo $__env->make('admin.user-tasks.tasks.scopes', [
                            'task' => $task,
                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Update task')); ?>

                                </button>
                            </div>
                            <a href="<?php echo e(route('admin.user-tasks.tasks.destroy', ['id' => $task->id])); ?>" class="btn btn-danger sure"><?php echo e(__('Delete task')); ?></a>
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