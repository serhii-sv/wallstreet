@if($transaction->type->name == 'exchange_in' || $transaction->type->name == 'transfer_in' || $transaction->type->name == 'enter' || $transaction->type->name == 'bonus' || $transaction->type->name == 'partner' || $transaction->type->name == 'dividend' || $transaction->type->name == 'reinvest' || $transaction->type->name == 'close_dep')
  <span class="badge green lighten-5 green-text text-accent-4">
    $ {{ number_format($transaction->main_currency_amount, 0, '.', ',') ?? 0 }}
  </span>
@else
  <span class="badge pink lighten-5 pink-text text-accent-2">
    $ {{ number_format($transaction->main_currency_amount, 0, '.', ',') ?? 0 }}
  </span>
@endif
