@php($partner = $transaction->user->partner)
@if(null !== $partner)
    <a href="{{ route('users.show', $partner->id) }}">
        {{ $partner->login }}
    </a>
@endif
