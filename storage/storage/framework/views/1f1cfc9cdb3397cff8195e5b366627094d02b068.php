<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit mail template')); ?> <?php echo e($mail->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.mail.index')); ?>"><?php echo e(__('Mail templates')); ?></a></li>
    <li> <?php echo e(__('Edit mail template')); ?>: <?php echo e($mail->title); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Edit mail template')); ?></h1>
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

                    <form class="form-horizontal" method="POST"
                          action="<?php echo e(route('admin.mail.update', ['id' => $mail->id])); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label"><?php echo e(__('Mail title')); ?></label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"
                                       value="<?php echo e($mail->title); ?>" required
                                       autofocus>
                            </div>
                        </div>

                        <!-- Textarea -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="body"><?php echo e(__('Mail body')); ?></label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="body" name="body"><?php echo e($mail->body); ?> </textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>


                        <legend><?php echo e(__('Send to')); ?></legend>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="users"><?php echo e(__('Clients')); ?></label>
                            <div class="col-md-4">
                                <select id="users" name="users" class="form-control">
                                    <option value="<?php echo e($mail->users); ?>" selected><?php echo e(__($mail->users)); ?></option>
                                    <option value="">---</option>
                                    <option value="all"><?php echo e(__('All')); ?></option>
                                    <option value="with_deposits"><?php echo e(__('With deposits')); ?></option>
                                    <option value="without_deposits"><?php echo e(__('Without deposits')); ?></option>
                                    <option value="with_closed_deposits"><?php echo e(__('With closed deposits')); ?></option>
                                </select>
                                <span class="help-block"><?php echo e(__('Or choose next option')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="user_email"><?php echo e(__('Exists client')); ?></label>
                            <div class="col-md-4">
                                <input id="user_email" name="user_email" type="text"
                                       placeholder="<?php echo e(__('User email')); ?>"
                                       class="form-control input-md" value="<?php echo e($mail->user_email); ?>">
                                <span class="help-block"><?php echo e(__('Or choose next option')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="emails"><?php echo e(__('Emails')); ?></label>
                            <div class="col-md-8">
                                    <textarea class="form-control" id="emails"
                                              name="emails"><?php echo e($mail->emails); ?></textarea>
                                <span class="help-block"><?php echo e(__('Format: email@mail.com, User Name - one per line')); ?></span>
                                <span class="help-block"><?php echo e(__('Or choose system notification type')); ?></span>
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="template"><?php echo e(__('Select template')); ?></label>
                            <div class="col-md-4">
                                <select id="template" name="template" class="form-control">
                                    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($mail->$template); ?>" selected><?php echo e($mail->template); ?></option>
                                        <option value="<?php echo e($template); ?>"><?php echo e($template); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <legend><?php echo e(__('Or system notification type')); ?></legend>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="code"><?php echo e(__('Event')); ?></label>
                            <div class="col-md-4">
                                <select id="code" name="code" class="form-control" disabled="">
                                    <option value="<?php echo e($mail->code); ?>" selected><?php echo e($mail->code); ?></option>
                                    <option value="">---</option>
                                    <option value="registered"><?php echo e(__('New user registered')); ?></option>
                                    <option value="password_changed"><?php echo e(__('Password changed')); ?></option>
                                    <option value="password_reset"><?php echo e(__('Password reset')); ?></option>
                                    <option value="wallet_refiled"><?php echo e(__('Wallet refiled')); ?></option>
                                    <option value="new_withdrawal"><?php echo e(__('New withdrawal request')); ?></option>
                                    <option value="rejected_withdrawal"><?php echo e(__('Rejected withdrawal request')); ?></option>
                                    <option value="approved_withdrawal"><?php echo e(__('Approved withdrawal request')); ?></option>
                                    <option value="bonus_accrued"><?php echo e(__('Bonus accrued')); ?></option>
                                    <option value="deposit_opened"><?php echo e(__('Deposit opened')); ?></option>
                                    <option value="deposit_accrued"><?php echo e(__('Deposit accrued')); ?></option>
                                    <option value="deposit_closed"><?php echo e(__('Deposit closed')); ?></option>
                                    <option value="partner_accrue"><?php echo e(__('Partner accrue')); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Update')); ?>

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