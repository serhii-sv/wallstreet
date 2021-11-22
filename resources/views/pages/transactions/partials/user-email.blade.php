<a href="{{ route('users.show', $transaction->user_id) }}">{{ $transaction->user->login ?? 'Не указано' }}</a>
