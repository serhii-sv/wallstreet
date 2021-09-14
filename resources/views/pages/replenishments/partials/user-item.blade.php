<a href="{{ route('users.show', $transaction->user->id) }}">{{ $transaction->user->email }}</a>
@if($transaction->user->partner)
    (<a href="{{ route('users.show', $transaction->user->partner->id) }}">{{ $transaction->user->partner->login }}</a>)
@endif
