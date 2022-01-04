<a href="{{ route('users.show', $transaction->user->id) }}" style="color:{{ $transaction->user->getRoleColor() }};">{{ $transaction->user->login }}</a>
