<a href="{{ route('users.show', $transaction->user->id) }}" style="color:{{ $transaction->user->getRoleColor() }};">{{ $transaction->user->email }}</a>
<br>
(<a href="{{ route('users.show', $transaction->user->id) }}" style="color:{{ $transaction->user->getRoleColor() }};">{{ $transaction->user->login }}</a>)
@if(!empty($transaction->withdraw_reason))
<br>
<strong style="color:red;">Заявка была возвращена из очереди на обработку. Причина: {{ $transaction->withdraw_reason }}</strong>
@endif
