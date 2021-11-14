@php($partner = $user->firstPartner($user))
@if(null !== $partner)
    <a href="{{ route('users.show', $partner->id) }}">{{ $partner->login }}</a>
@endif
