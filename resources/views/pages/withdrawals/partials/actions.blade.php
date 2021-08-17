<div class="invoice-action">
    <a href="{{ route('withdrawals.show', $transaction->id) }}" data-position="bottom" data-tooltip="Показать"
       class="invoice-action-view mr-4 tooltipped">
        <i class="material-icons">remove_red_eye</i>
    </a>
    @if(request()->type == 0 || is_null(request()->type))
        <a href="{{ route('withdrawals.approve', $transaction->id) }}"
           data-action_type="approve" data-position="bottom" data-tooltip="Подтвердить"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">check</i>
        </a>
        <a href="{{ route('withdrawals.approveManually', $transaction->id) }}"
           data-action_type="approveManually" data-position="bottom" data-tooltip="Подтвердить вручную"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">done_all</i>
        </a>
        <a href="{{ route('withdrawals.reject', $transaction->id) }}"
           data-action_type="reject" data-position="bottom" data-tooltip="Отклонить"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">clear</i>
        </a>
    @endif
</div>
