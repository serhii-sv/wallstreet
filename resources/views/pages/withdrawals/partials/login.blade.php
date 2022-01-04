<a href="{{ route('users.show', $transaction->user->id) }}" style="color:{{ $transaction->use->getRoleColor() }};">{{ $transaction->user->login }}</a>
