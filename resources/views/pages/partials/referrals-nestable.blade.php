<ol class="dd-list">
    <li class="dd-item" data-id="{{ $referrals_data['self']->id }}">
        <div class="dd-handle">{{ $referrals_data['self']->email }}</div>
        @if(!empty($referrals_data['referrals']))
            @foreach($referrals_data['referrals'] as $referral)
                @include('pages.partials.referrals-nestable', ['referrals_data' => $referral, 'first' => false])
            @endforeach
        @endif
    </li>
</ol>
