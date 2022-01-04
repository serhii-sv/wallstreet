<a href="{{ route('users.show', $user) }}" style="color:{{ $user->getRoleColor() }};">{{ $user->email ?? 'Не указано' }}</a>
