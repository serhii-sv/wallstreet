
<a class="ml-3" href="{{ route('transactions.show', $transaction->id) }}">{{ $transaction->user->login ?? 'Не указано' }}</a>