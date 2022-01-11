<div class="invoice-action">
    <a href="{{ route('verification-requests.show', $verificationRequest->id) }}" data-position="bottom" data-tooltip="Показать"
       class="invoice-action-view mr-4 tooltipped">
        <i class="material-icons">remove_red_eye</i>
    </a>
    <a href="{{ route('verification-requests.update', $verificationRequest) }}" data-position="bottom" data-tooltip="Подтвердить"
       class="invoice-action-view mr-4 tooltipped">
        <i class="material-icons">check</i>
    </a>
    <a href="{{ route('verification-requests.reject', $verificationRequest) }}" data-position="bottom" data-tooltip="Отменить"
       class="invoice-action-view mr-4 tooltipped">
        <i class="material-icons">clear</i>
    </a>
</div>
