<a href="{{ route('transactions.show', $transaction->id) }}">Показать</a>
/
<a href="{{ route('user-transactions.destroy', [$user->id, $transaction->id]) }}" class="delete-transaction">Удалить</a>
