<a href="{{ route('deposits.show', $deposit->id) }}">
    {{ $deposit->user->email ?? 'Не указано' }}
</a>
