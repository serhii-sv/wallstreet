<span>{{ $transaction->paymentSystem->name }} {{ $transaction->currency->code }}</span>
<br>
<span class="chip green white-text external-block" style="cursor: pointer">
  {{ $transaction->wallet->external ?? '' }}
</span>
