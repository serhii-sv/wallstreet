@if($transaction->user->email)<a href="{{ route('users.show', $transaction->user->id) }}">{{ $transaction->user->email }}</a> @else Не указано @endif
