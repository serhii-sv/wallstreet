@php($partner = $transaction->user->firstPartner($transaction->user))
@if(null !== $partner)
    <a href="{{ route('users.show', $partner->id) }}">{{ $partner->login }}</a>
@endif
