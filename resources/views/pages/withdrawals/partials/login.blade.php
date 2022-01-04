<a href="{{ route('users.show', $transaction->user->id) }}" style="color:{{ $user->getRoleColor() }};">{{ $transaction->user->login }}</a>
