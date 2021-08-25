<div class="invoice-action">
    <a href="{{ route('referrals.edit', $referral->id) }}" data-position="bottom" data-tooltip="Изменить"
       class="invoice-action-view mr-4 tooltipped">
        <i class="material-icons">create</i>
    </a>
    <a href="{{ route('referrals.destroy', $referral) }}" data-position="bottom" data-tooltip="Удалить"
       class="invoice-action-view mr-4 tooltipped delete">
        <i class="material-icons">delete</i>
    </a>
</div>
