<?php if(session()->has('success')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo app('translator')->getFromJson(session()->get('success')); ?>
    </div>
<?php endif; ?>

<?php if(session('errors')): ?>
    <div class="alert alert-danger" role="alert">

        <?php echo app('translator')->getFromJson((htmlspecialchars(session('errors')))); ?>
    </div>
<?php endif; ?>


