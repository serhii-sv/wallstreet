<a href="{{ route('users.show', $transaction->user->id) }}">{{ $transaction->user->email }}</a>
<br>
(<a href="{{ route('users.show', $transaction->user->id) }}">{{ $transaction->user->login }}</a>)

