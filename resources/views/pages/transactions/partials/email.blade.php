<a class="ml-3" href="{{ route('users.show', $transaction->user_id) }}">{{ $transaction->user->login ?? 'Не указано' }}</a>
