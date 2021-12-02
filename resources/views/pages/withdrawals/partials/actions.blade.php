<div class="invoice-action">
    <a href="#" data-position="bottom" data-tooltip="Показать"
       class="invoice-action-view mr-4 tooltipped showCard" data-external="{{ $transaction->wallet->external ?? '' }}">
        <i class="material-icons">remove_red_eye</i>
    </a>
    @if(request()->type == 0 || is_null(request()->type))
        <a href="{{ route('withdrawals.approve', $transaction->id) }}"
           data-action_type="approve" data-position="bottom" data-tooltip="Подтвердить через мерчант"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">check</i>
        </a>
        <a href="{{ route('withdrawals.approveManually', $transaction->id) }}"
           data-action_type="approveManually" data-position="bottom" data-tooltip="Подтвердить вручную"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">done_all</i>
        </a>
        <a href="{{ route('withdrawals.approveFake', $transaction->id) }}"
           data-action_type="approve_fake" data-position="bottom" data-tooltip="Подтвердить фейк"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">check</i>
        </a>
        <a href="{{ route('withdrawals.reject', $transaction->id) }}"
           data-action_type="reject" data-position="bottom" data-tooltip="Отменить с возвратом на баланс"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">clear</i>
        </a>
        <a href="{{ route('withdrawals.destroy', $transaction->id) }}"
           data-action_type="destroy" data-position="bottom" data-tooltip="Удалить бесследно"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">delete</i>
        </a>
    @endif
</div>
