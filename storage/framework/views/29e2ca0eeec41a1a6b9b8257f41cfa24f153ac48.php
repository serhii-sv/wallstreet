<?php if($transaction->user->partner): ?>
  <a href="<?php echo e(route('users.show', $transaction->user->partner->id)); ?>"><?php echo e($transaction->user->partner->login); ?></a>
<?php endif; ?><?php /**PATH /var/www/resources/views/pages/withdrawals/partials/upliner.blade.php ENDPATH**/ ?>