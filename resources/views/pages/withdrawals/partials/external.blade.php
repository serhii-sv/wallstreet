<span>{{ $transaction->paymentSystem->name }} {{ $transaction->currency->code }}</span>
<br>
<span class="chip green white-text external-block" style="cursor: pointer">
  @if($transaction->paymentSystem->code == 'payeer')
        {{ $transaction->wallet->external_payeer ?? '' }}
  @else
  {{ $transaction->wallet->external ?? '' }}
  @endif
</span>
