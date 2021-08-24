<a href="{{ route('deposits.show', $deposit->id) }}">
    {{ $deposit->user->login ?? 'Не указано' }}
</a>
