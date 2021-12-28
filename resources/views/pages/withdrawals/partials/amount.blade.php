<span class="invoice-amount copy-to-clipboard tooltip" data-text="{{ number_format($transaction->amount, $transaction->currency->precision, ',', ' ') }}">
        <span class="tooltiptext">Кликните чтоб скопировать</span>
    {{ $transaction->currency->symbol }}{{ number_format($transaction->amount, $transaction->currency->precision, ',', ' ') }}
    (<span style="color: green">${{ number_format($transaction->main_currency_amount, 2, '.', ',') }}</span>)
</span>
