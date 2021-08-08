@if($first)
    <ol class="dd-list">
@endif
        <li class="dd-item" data-id="{{ $referrals_data['self']->id }}">
            <div class="dd-handle">{{ $referrals_data['self']->email }}</div>
            @if(!empty($referrals_data['referrals']))
                @foreach($referrals_data['referrals'] as $key => $referral)
                    @include('pages.partials.referrals-nestable', [
                                        'referrals_data' => $referral,
                                        'first' => $key == 0,
                                        'last' => last(array_keys($referrals_data['referrals'])) == $key
                                ])
                @endforeach
            @endif
        </li>
@if($last)
    </ol>
@endif
