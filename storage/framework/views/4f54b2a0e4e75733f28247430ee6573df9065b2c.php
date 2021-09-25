<div class="invoice-action">
    <a href="<?php echo e(route('withdrawals.show', $transaction->id)); ?>" data-position="bottom" data-tooltip="Показать"
       class="invoice-action-view mr-4 tooltipped">
        <i class="material-icons">remove_red_eye</i>
    </a>
    <?php if(request()->type == 0 || is_null(request()->type)): ?>
        <a href="<?php echo e(route('withdrawals.approve', $transaction->id)); ?>"
           data-action_type="approve" data-position="bottom" data-tooltip="Подтвердить через мерчант"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">check</i>
        </a>
        <a href="<?php echo e(route('withdrawals.approveManually', $transaction->id)); ?>"
           data-action_type="approveManually" data-position="bottom" data-tooltip="Подтвердить вручную"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">done_all</i>
        </a>
        <a href="<?php echo e(route('withdrawals.reject', $transaction->id)); ?>"
           data-action_type="reject" data-position="bottom" data-tooltip="Отменить с возвратом на баланс"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">clear</i>
        </a>
        <a href="<?php echo e(route('withdrawals.destroy', $transaction->id)); ?>"
           data-action_type="destroy" data-position="bottom" data-tooltip="Удалить бесследно"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">delete</i>
        </a>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/resources/views/pages/withdrawals/partials/actions.blade.php ENDPATH**/ ?>