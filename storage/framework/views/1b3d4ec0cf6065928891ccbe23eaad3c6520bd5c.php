




<?php if(session()->has('success')): ?>
  <div class="card-alert card gradient-45deg-green-teal mt-0">
    <div class="card-content white-text">
      <p>
        <i class="material-icons">check</i>
        <?php echo e(session()->get('success')); ?>

      </p>
    </div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
<?php endif; ?>

<?php if(session()->has('error')): ?>
  <div class="card-alert card gradient-45deg-red-pink mt-0">
    <div class="card-content white-text">
      <p>
        <i class="material-icons">error</i>
        <?php echo e(session()->get('error')); ?>

      </p>
    </div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
<?php endif; ?>

<?php if(session()->has('info')): ?>
    <div class="card-alert card gradient-45deg-light-blue-cyan mt-0">
        <div class="card-content white-text">
            <p>

                <?php echo e(session()->get('info')); ?>

            </p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card-alert card gradient-45deg-red-pink mt-0">
      <div class="card-content white-text">
        <p>
          <i class="material-icons">error</i>
          <?php echo e($error); ?>

        </p>
      </div>
      <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /var/www/resources/views/panels/inform.blade.php ENDPATH**/ ?>