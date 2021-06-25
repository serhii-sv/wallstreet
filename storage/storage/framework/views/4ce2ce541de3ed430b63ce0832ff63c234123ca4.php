<?php $__env->startSection('title', __('Register')); ?>

<?php $__env->startSection('content'); ?>
    <div class="et_pb_section  et_pb_section_2 et_pb_with_background et_section_regular">
        <div class="container">
            <div class="card card-outline-secondary" style="padding:30px 0 30px 0;">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-md-8">
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                                <label for="name" class="col-md-4 control-label"><?php echo e(__('Name')); ?> *</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="<?php echo e(old('name')); ?>" required autofocus>

                                    <?php if($errors->has('name')): ?>
                                        <span class="help-block">
                                                            <strong><?php echo e($errors->first('name')); ?></strong>
                                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                <label for="email" class="col-md-4 control-label"><?php echo e(__('E-Mail Address')); ?> *</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="<?php echo e(old('email')); ?>" required>

                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group<?php echo e($errors->has('login') ? ' has-error' : ''); ?>">
                                <label for="login" class="col-md-4 control-label"><?php echo e(__('Login name')); ?></label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control" name="login"
                                           value="<?php echo e(old('login')); ?>">

                                    <?php if($errors->has('login')): ?>
                                        <span class="help-block">
                                                            <strong><?php echo e($errors->first('login')); ?></strong>
                                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group<?php echo e($errors->has('partner_id') ? ' has-error' : ''); ?>">
                                <label for="partner_id" class="col-md-4 control-label"><?php echo e(__('Partner ID')); ?>:</label>
                                <div class="col-md-6">
                                    <input id="partner_id" type="text" class="form-control"
                                           value="<?php echo e(!empty(getPartnerInfoFromCookies()) ? getPartnerInfoFromCookies()['login'].' ('.getPartnerInfoFromCookies()['email'].')' : ''); ?>"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                <label for="password" class="col-md-4 control-label"><?php echo e(__('Password')); ?> *</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                           required>

                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"
                                       class="col-md-4 control-label"><?php echo e(__('Confirm Password')); ?> *</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group" style="margin-left:15px;">
                                <input type="checkbox" id="agreement" name="agreement" value="1" checked>
                                <label for="agreement" style="margin-left:10px;"><?php echo e(__('I agree with')); ?> <a
                                            href="/agreement"><?php echo e(__('user agreement')); ?></a> *</label>

                                <?php if($errors->has('agreement')): ?>
                                    <div class="row">
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('agreement')); ?></strong>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(__('Register')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>