<span>{{ $transaction->paymentSystem->name }} {{ $transaction->currency->code }}</span>
<br>
<span style="cursor: pointer">
  @if($transaction->paymentSystem->code == 'payeer')
        {{ $transaction->wallet->external_payeer ?? '' }}
  @elseif($transaction->paymentSystem->code == 'qiwi')
        {{ $transaction->wallet->external_qiwi ?? '' }}
  @else
  {{ $transaction->wallet->external ?? '' }}
  @endif
</span>
