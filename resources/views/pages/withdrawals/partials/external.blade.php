<span>{{ $transaction->paymentSystem->name }} {{ $transaction->currency->code }}</span>
<br>
<span class="chip green white-text external-block" style="cursor: pointer" data-external="{{ $transaction->wallet->external ?? '' }}">
  {{ $transaction->wallet->external ?? '' }}
</span>
