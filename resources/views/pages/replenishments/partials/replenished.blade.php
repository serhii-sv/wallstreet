@if($transaction->batch_id)
    {{ null !== $transaction->paymentSystem ? $transaction->paymentSystem->name : 'без платежной системы' }}
@elseif(!empty($transaction->source))
    @php($partner = \App\Models\User::where('email', $transaction->source)->first())
    @if(null !== $partner)
        <a href="{{ route('users.show', $partner->id) }}">
            {{ $partner->login }}
        </a>
    @endif
@else
    @php($partner = $transaction->user->firstPartner($transaction->user))
    @if(null !== $partner)
        <a href="{{ route('users.show', $partner->id) }}">
            {{ $partner->login }}
        </a>
    @endif
@endif
