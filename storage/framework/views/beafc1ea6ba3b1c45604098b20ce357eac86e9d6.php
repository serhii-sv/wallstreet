



<?php $__env->startSection('title','User Login'); ?>


<?php $__env->startSection('page-style'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/login.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="login-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">

    <form class="login-form" method="POST" action="<?php echo e(route('login')); ?>">
      <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <small class="red-text ml-7" >
        <?php echo e($message); ?>

      </small>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      <?php echo csrf_field(); ?>
      <input type="hidden" name="g-recaptcha-response" id="recaptcha">
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Авторизация</h5>
        </div>
      </div>
      <div class="row margin">
        <div class="mb-3"><?php echo $__env->make('panels.inform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="email" type="text" class=" <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
            value="<?php echo e(old('email')); ?>"  autocomplete="email" autofocus>
          <label for="email" class="center-align">Email</label>
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <small class="red-text ml-7" >
            <?php echo e($message); ?>

          </small>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            name="password"  autocomplete="current-password">
          <label for="password">Пароль</label>
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <small class="red-text ml-7" >
            <?php echo e($message); ?>

          </small>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12 ml-2 mt-1">
          <p>
            <label>
              <input type="checkbox" name="remember" id="remember" checked="checked">
              <span>Запомнить меня</span>
            </label>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
            Войти
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-script'); ?>
  <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(config('recaptchav3.sitekey')); ?>"></script>
  <script>
    grecaptcha.ready(function() {
      grecaptcha.execute('<?php echo e(config('recaptchav3.sitekey')); ?>', {action: 'login'}).then(function(token) {
        if (token) {
          document.getElementById('recaptcha').value = token;
        }
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.fullLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/auth/login.blade.php ENDPATH**/ ?>