<span>{{ $transaction->paymentSystem->name }}</span>
<br>
<span class="chip green white-text external-block" style="cursor: pointer" data-external="{{ $transaction->external ?? '' }}">
  {{ $transaction->external ?? '' }}
</span>
