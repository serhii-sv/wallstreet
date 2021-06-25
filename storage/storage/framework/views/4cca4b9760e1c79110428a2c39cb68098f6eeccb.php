<?php $__env->startSection('title', __('Sign in')); ?>

<?php $__env->startSection('content'); ?>
    <div class="et_pb_section  et_pb_section_2 et_pb_with_background et_section_regular">
        <div class="container">
            <div class="card card-outline-secondary" style="padding:30px 0 30px 0;">
                <?php echo $__env->make('partials.inform', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                                    <?php echo e(csrf_field()); ?>


                                    <div class="form-group">
                                        <label for="login"
                                               class="col-md-4 control-label"><?php echo e(__('E-Mail Address or login')); ?></label>

                                        <div class="col-md-6">
                                            <input id="login" type="text" class="form-control" name="login"
                                                   value="<?php echo e(old('login')); ?>" required autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password"
                                               class="col-md-4 control-label"><?php echo e(__('Password')); ?></label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password"
                                                   required>
                                        </div>
                                    </div>

                                    <?php if(loginCaptchaCanBeShown()): ?>
                                        <div class="form-group">
                                            <div class="col-lg-4">
                                                <?= captcha_img() ?>
                                            </div>
                                            <label class="col-md-4 control-label"
                                                   for="captcha"><?php echo e(__('Enter captcha code')); ?></label>
                                            <div class="col-lg-6">
                                                <input type="text" name="captcha" id="captcha" class="form-control">
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"
                                                           name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> <?php echo e(__('Remember Me')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <?php echo e(__('Sign in')); ?>

                                            </button>

                                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                                <?php echo e(__('Forgot Your Password?')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>