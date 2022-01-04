<a href="{{ route('users.show', $transaction->user->id) }}" style="color:{{ $transaction->user->getRoleColor() }};">{{ $transaction->user->email }}</a><br>
<a href="{{ route('users.show', $transaction->user->id) }}" style="color:{{ $transaction->use->getRoleColor() }};">{{ $transaction->user->login }}</a>
