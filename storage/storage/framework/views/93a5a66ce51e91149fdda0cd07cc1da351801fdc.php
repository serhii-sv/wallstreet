<form id="payment" method="POST" action="https://payeer.com/merchant/"  style="display:none;">
    <input type="hidden" name="m_shop" value="<?php echo e($merchantId); ?>">
    <input type="hidden" name="m_orderid" value="<?php echo e($paymentId); ?>">
    <input type="hidden" name="m_amount" value="<?php echo e($amount); ?>">
    <input type="hidden" name="m_curr" value="<?php echo e($currency); ?>">
    <input type="hidden" name="m_desc" value="<?php echo e($comment); ?>">

    <input type="hidden" name="m_sign" value="<?php echo e($signature); ?>">
    <input type="submit" name="m_process" value="send"/>
</form>

<script>
    document.forms.payment.submit()
</script>