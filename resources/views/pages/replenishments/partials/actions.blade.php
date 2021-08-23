<div class="invoice-action">
    <a href="{{ route('replenishments.show', $transaction->id) }}" data-position="bottom" data-tooltip="Показать" class="invoice-action-view mr-4 tooltipped">
        <i class="material-icons">remove_red_eye</i>
    </a>
    @if(request()->type == 0 || is_null(request()->type))
        <a href="{{ route('replenishments.approveManually', $transaction->id) }}" data-action_type="approveManually" data-position="bottom" data-tooltip="Подтвердить вручную"
           class="invoice-action-view mr-4 tooltipped">
            <i class="material-icons">done_all</i>
        </a>
    @endif
    <a href="{{ route('replenishments.destroy', $transaction->id) }}"
       data-action_type="destroy" data-position="bottom" data-tooltip="Удалить бесследно"
       class="invoice-action-view mr-4 tooltipped">
        <i class="material-icons">delete</i>
    </a>
</div>
