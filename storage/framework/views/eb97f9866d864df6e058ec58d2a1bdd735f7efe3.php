



<?php $__env->startSection('title','User Lock Screen'); ?>


<?php $__env->startSection('page-style'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/lock.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <div id="lock-screen" class="row">
    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 forgot-card bg-opacity-8">
      <div class="mt-3">
        <?php echo $__env->make('panels.inform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <form class="login-form" method="post" action="<?php echo e(route('user.unlock')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id ?? ''); ?>">
        <div class="row">
          <div class="input-field col s12 center-align mt-10">
            <img class="z-depth-4 circle responsive-img" width="100" src="<?php echo e(asset('images/avatar/user.svg')); ?>" alt="">
            <h5><?php echo e(Auth::user()->login ?? "Пользователь"); ?></h5>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix pt-2">lock_outline</i>
            <input id="password" type="password" name="password">
            <label for="password">Password</label>
            
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Войти</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.fullLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/pages/sample/user-lock-screen.blade.php ENDPATH**/ ?>