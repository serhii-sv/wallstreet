<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit tariff plan')); ?> <?php echo e($rate->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <a href="<?php echo e(route('admin.rates.index')); ?>"><?php echo e(__('Tariff plans')); ?></a></li>
    <li> <?php echo e(__('Edit tariff plan')); ?>: <?php echo e($rate->name); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Edit tariff plan')); ?></h1>
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
                          action="<?php echo e(route('admin.rates.update', ['id' => $rate->id])); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"><?php echo e(__('Tariff plan name')); ?></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                       value="<?php echo e($rate->name); ?>" required
                                       autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="currency"><?php echo e(__('Currency')); ?></label>
                            <div class="col-md-4">
                                <select id="currency" name="currency_id" class="form-control">
                                    <?php $__currentLoopData = getCurrencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($currency['id']); ?>"<?php echo e($rate->currency_id == $currency['id'] ? ' selected' : ''); ?>><?php echo e($currency['code']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?php echo e(__('Min. investment')); ?></label>
                            <div class="col-md-4">
                                <input id="textinput" name="min" type="number" step="any" value="<?php echo e($rate->min); ?>"
                                       class="form-control input-md">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?php echo e(__('Max. investment')); ?></label>
                            <div class="col-md-4">
                                <input id="textinput" name="max" type="number" step="any" value="<?php echo e($rate->max); ?>"
                                       class="form-control input-md">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?php echo e(__('Daily')); ?></label>
                            <div class="col-md-4">
                                <input id="textinput" name="daily" type="number" step="any" value="<?php echo e($rate->daily); ?>"
                                       class="form-control input-md">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?php echo e(__('Overall')); ?></label>
                            <div class="col-md-4">
                                <input id="textinput" name="overall" type="number" step="any" value="<?php echo e($rate->overall); ?>"
                                       class="form-control input-md">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?php echo e(__('Duration')); ?></label>
                            <div class="col-md-4">
                                <input id="textinput" name="duration" type="number"
                                       value="<?php echo e($rate->duration); ?>" class="form-control input-md">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"><?php echo e(__('Payout')); ?></label>
                            <div class="col-md-4">
                                <input id="textinput" name="payout" type="number" step="any" value="<?php echo e($rate->payout); ?>"
                                       class="form-control input-md">
                            </div>
                        </div>

                        <!-- Multiple Checkboxes -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="checkboxes"> </label>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label for="checkboxes-0">
                                        <input type="checkbox" name="reinvest" value="1" id="checkboxes-0"<?php echo e($rate->reinvest ? ' checked' : ''); ?>>
                                        <?php echo e(__('Compounding')); ?>

                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="checkboxes-1">
                                        <input type="checkbox" name="autoclose" value="1" id="checkboxes-1"<?php echo e($rate->autoclose ? ' checked' : ''); ?>>
                                        <?php echo e(__('Auto close')); ?>

                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="checkboxes-2">
                                        <input type="checkbox" name="active" value="1" id="checkboxes-2"<?php echo e($rate->active ? ' checked' : ''); ?>>
                                        <?php echo e(__('Active')); ?>

                                    </label>
                                </div>
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
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>