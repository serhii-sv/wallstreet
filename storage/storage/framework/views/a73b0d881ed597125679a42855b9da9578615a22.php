<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->getFromJson('Create user'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <a href="<?php echo e(route('admin.users.index')); ?>"><?php echo app('translator')->getFromJson('Users'); ?></a></li>
    <li> <?php echo app('translator')->getFromJson('Create user'); ?></li>
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
                    <h1 class="custom-font"><?php echo app('translator')->getFromJson('Create user'); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('admin.users.store')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"><?php echo app('translator')->getFromJson('Name'); ?></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required
                                       autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label"><?php echo app('translator')->getFromJson('E-Mail Address'); ?></label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="<?php echo e(old('email')); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label"><?php echo app('translator')->getFromJson('Password'); ?></label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="selectmultiple"><?php echo app('translator')->getFromJson('Roles'); ?></label>
                            <div class="col-md-4">
                                <select id="selectmultiple" name="roles[]" class="form-control" multiple="multiple">
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role['name']); ?>"><?php echo e($role['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo app('translator')->getFromJson('Create'); ?>
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