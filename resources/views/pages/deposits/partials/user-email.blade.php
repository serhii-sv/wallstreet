@if($deposit->user->email)
    <a href="{{ route('users.show', $deposit->user->id) }}">
        {{ $deposit->user->email }}
    </a>
@else Не указано @endif
