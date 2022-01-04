<a href="{{ route('users.show', $user) }}" style="color:{{ $user->getRoleColor() }};">{{ $user->login ?? 'Не указано' }}</a>
