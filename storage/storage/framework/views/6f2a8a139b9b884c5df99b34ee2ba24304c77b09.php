<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,400italic,700,500italic' rel='stylesheet' type='text/css'>
<link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel='styesheet'>
<div class="col-lg-3"></div>
<div class="col-md-6" style="margin-top:100px;">
    <!-- START PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading ui-draggable-handle">
            <h3 class="panel-title"><?php echo e(__('Recharge balance with').' '.$paymentSystem->name.' '.$currency->code); ?></h3>
        </div>
        <div class="panel-body">
            <strong><?php echo e(__('You should send:')); ?> <input type="text" style="background:rgb(200,200,200); border:1px solid rgb(150,150,150);" value="<?php echo e($transaction->amount); ?>" readonly> <?php echo e($currency->code); ?></strong>
            <hr>
            <strong><?php echo e(__('To')); ?> <?php echo e($paymentSystem->name); ?> <?php echo e(__('address:')); ?> <input type="text" style="background:rgb(200,200,200); border:1px solid rgb(150,150,150);" value="<?php echo e($receiveAddress); ?>" readonly></strong>
            <br><br>
            <?php echo e($confirmsNeeded); ?> <?php echo e(__('confirms needed.')); ?><br>
            <?php echo e(intval($timeout/60)); ?> <?php echo e(__('minutes timeout.')); ?>

            <hr>
            <div style="text-align: center;">
                <a rel='nofollow' href='<?php echo e($paymentSystem->code.':'.$receiveAddress.'?amount='.$transaction->amount); ?>' border='0'><img src='https://chart.googleapis.com/chart?cht=qr&chl=<?php echo e(urlencode($paymentSystem->code.':'.$receiveAddress.'?amount='.$transaction->amount)); ?>&chs=180x180&choe=UTF-8&chld=L|2' alt=''></a>
            </div>
            <hr>
            <?php echo e(__('Your status URL is:')); ?> <a href="<?php echo e($buyerStatusUrl); ?>" target="_blank"><?php echo e($buyerStatusUrl); ?></a>
        </div>
    </div>
</div>