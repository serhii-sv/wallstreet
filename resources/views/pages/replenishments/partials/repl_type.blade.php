<span class="invoice-amount">
  @if($transaction->approved)
    {{ $transaction->is_real ? 'реал' : 'фейк' }}
    @elseif($transaction->approved == 0)
    ожидание
    @elseif($transaction->approved == 2)
    отменен
    @endif
</span>
