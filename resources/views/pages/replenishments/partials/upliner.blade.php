@php($partner = $transaction->user->firstPartner($transaction->user))
@if(null !== $partner)
    <span class="chip orange lighten-5">
            <a href="{{ route('users.show', $partner->id) }}">
                <span class="orange-text">{{ $partner->login }}</span>
            </a>
    </span>
@endif
