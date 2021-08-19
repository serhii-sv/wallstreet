<a href="{{ route('transactions.show', $transaction->id) }}">{{ $transaction->user->email ?? 'Не указано' }}</a>
