<?php $__env->startSection('title'); ?>
    <?php echo e(__('Bot settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Bot settings')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.telegram.bots.index')); ?>"><?php echo e(__('Bots list')); ?></a></li>
    <li> <?php echo e(__('Bot settings')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Bot settings')); ?></h1>
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

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.telegram.bots.update', ['id' => $bot->id])); ?>">
                        <?php echo e(csrf_field()); ?>


                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="id" value="<?php echo e($bot->id); ?>">

                        <div class="form-group">
                            <label for="token" class="col-md-4 control-label"><?php echo e(__('BOT token [provided by @BotFather]')); ?></label>
                            <div class="col-md-6">
                                <input id="token" type="text" class="form-control" name="token" value="<?php echo e($bot->token); ?>" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="keyword"><?php echo e(__('BOT functionality')); ?></label>
                            <div class="col-md-4">
                                <select id="keyword" name="keyword" class="form-control">
                                    <?php $__currentLoopData = \App\Models\Telegram\TelegramBots::getExistsKeywords(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($keyword); ?>"<?php echo e($bot->$keyword == $keyword ? ' selected' : ''); ?>><?php echo e(__($keyword)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <?php
                        $webhook        = $bot->webhooks()->first();
                        $certificate    = !empty($webhook) ? $webhook->certificate : '';
                        $maxConnections = !empty($webhook) ? $webhook->max_connections : 40;
                        ?>

                        <div class="form-group">
                            <label for="certificate" class="col-md-4 control-label"><?php echo e(__('Address of self-signed SSL certificate file [optional]')); ?></label>
                            <div class="col-md-6">
                                <input id="certificate" type="text" class="form-control" name="certificate" value="<?php echo e($certificate); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="max_connections" class="col-md-4 control-label"><?php echo e(__('Maximum connection at the same time')); ?></label>
                            <div class="col-md-6">
                                <input id="max_connections" type="number" class="form-control" name="max_connections" value="<?php echo e($maxConnections); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Update this bot')); ?>

                                </button>
                                <a href="<?php echo e(route('admin.telegram.bots.destroy', ['id' => $bot->id])); ?>" class="btn btn-danger sure"><?php echo e(__('Destroy BOT [remove all data]')); ?></a>
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