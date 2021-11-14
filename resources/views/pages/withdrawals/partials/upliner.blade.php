@php($partner = $transaction->user->firstPartner($transaction->partner))
@if(null !== $partner)
  <a href="{{ route('users.show', $partner->id) }}">{{ $partner->login }}</a>
@endif
