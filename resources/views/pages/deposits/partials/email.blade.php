
<a class="ml-3" href="{{ route('transactions.show', $deposit->id) }}">{{ $deposit->user->login ?? 'Не указано' }}</a>