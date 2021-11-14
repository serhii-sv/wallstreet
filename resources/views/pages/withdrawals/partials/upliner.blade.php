@php($partner = $transaction->user->partners()->wherePivot('line', 1)->first())
@if(null !== $partner)
  <a href="{{ route('users.show', $partner->id) }}">{{ $partner->login }}</a>
@endif
