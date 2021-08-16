<span class="invoice-amount">{{ $transaction->currency->symbol }}{{ number_format($transaction->amount, 2, ',', ' ') }} (${{ number_format($transaction->main_currency_amount, 2, '.', ',') }})</span>
