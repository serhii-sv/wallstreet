<li><?php echo e($user->name); ?>

<?php if($user->hasReferrals()): ?>
    <ul>
        <?php $__currentLoopData = $user->getReferrals(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('admin.users.referrals', ['user' => $referral], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>
</li>