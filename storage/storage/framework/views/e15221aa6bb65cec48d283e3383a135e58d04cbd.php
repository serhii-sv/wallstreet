<?php $__env->startSection('title'); ?>
    <?php echo e(__('Mail preview')); ?> <?php echo e($mail->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <a href="<?php echo e(route('admin.mail.index')); ?>"><?php echo e(__('Mail templates')); ?></a></li>
    <li> <?php echo app('translator')->getFromJson('Mail preview'); ?>: <?php echo e($mail->title); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Mail preview')); ?></h1>
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
                                <th scope="row"><?php echo e(__('Mail title')); ?></th>
                                <td><?php echo e($mail->title); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Mail body')); ?></th>
                                <td colspan="2"><?php echo $mail->body; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Recipients')); ?></th>
                                <td colspan="2"><?php echo e($mail->user_email); ?> <?php echo e(__($mail->users)); ?>

                                    <?php if($mail->emails): ?>
                                        <textarea style="width:100%;" rows="5" disabled><?php echo e($mail->emails); ?></textarea>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Notification code')); ?></th>
                                <td><?php echo e(__($mail->code)); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo e(__('Created date')); ?></th>
                                <td><?php echo e($mail->created_at); ?></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <?php if(!$mail->code): ?>
                            <a class="btn btn-primary btn-large" href="<?php echo e(route('admin.mail.send', ['id'=>$mail->id])); ?>"><?php echo e(__('Send')); ?></a>
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
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>