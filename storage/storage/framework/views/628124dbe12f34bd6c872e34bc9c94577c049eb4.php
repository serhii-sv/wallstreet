<form id="payment" method="POST" action="https://perfectmoney.is/api/step1.asp"
      style="display:none;">
    <input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo e($payeeAccount); ?>">
    <input type="hidden" name="PAYEE_NAME" value="<?php echo e($payeeName); ?>">
    <input type="hidden" name="PAYMENT_ID" value="<?php echo e(strtoupper($paymentId)); ?>">
    <input type="hidden" name="PAYMENT_AMOUNT" value="<?php echo e($amount); ?>">
    <input type="hidden" name="PAYMENT_UNITS" value="<?php echo e($currency); ?>">
    <input type="hidden" name="STATUS_URL" value="<?php echo e($statusUrl); ?>">
    <input type="hidden" name="PAYMENT_URL"
           value="<?php echo e(route('profile.topup.payment_message', ['result' => 'ok'])); ?>">
    <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
    <input type="hidden" name="NOPAYMENT_URL"
           value="<?php echo e(route('profile.topup.payment_message', ['result' => 'error'])); ?>">
    <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
    <input type="hidden" name="SUGGESTED_MEMO" value="<?php echo e($comment); ?>">

    <!-- Merchant custom fields -->
    <input type="hidden" name="userid" value="<?php echo e($user->id); ?>">
    <input type="hidden" name="walletid" value="<?php echo e($wallet->id); ?>">
    <input type="hidden" name="BAGGAGE_FIELDS" value="userid walletid">
    <input type="submit" name="PAYMENT_METHOD" value="Pay Now!">
</form>

<script>
    document.forms.payment.submit()
</script>