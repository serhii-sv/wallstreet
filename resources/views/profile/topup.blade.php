@extends('profile.layouts.customer')
@section('title', __('Balance'))
@section('content')
<section class="lk-section">
    <div class="form-lk">
        <div class="form-lk__col">
            <form method="POST" action="{{ route('profile.topup') }}">
                {{ csrf_field() }}
                <p style="font-weight: bold;">@include('partials.inform')</p>

                <div class="input-row white-shadow-select">
                    <label for="currency" class="input-row__name">{{ __('Currency') }}
                    </label>
                    <select class="select" id="currency_id" name="currency" autofocus>
                    @foreach(getPaymentSystems() as $paymentSystem)
                        @foreach($paymentSystem['currencies'] as $currency)
                            <option value="{{ $paymentSystem['id'].':'.$currency['id'] }}">{{ $paymentSystem['name'] }} {{ $currency['name'] }}</option>
                        @endforeach
                    @endforeach
                    </select>
                </div>
                <div class="input-row">
                    <label for="amount" class="input-row__name">{{ __('Amount') }}
                    </label><input id="amount" name="amount" type="number" step="any" class="input-row__input input input--white-shadow" required/>
                    @if(getEnterCommission() > 0)
                        <span class="help-block">{{ __('System commission') }} {{ getEnterCommission() }} %</span>
                    @endif
                </div>
                <div class="input-row">
                    <label for="captcha" class="input-row__name">{{ __('Enter captcha code') }}
                    </label><input id="captcha" name="captcha" class="input-row__input input input--white-shadow" type="text"/>
                    <div class="input-row__captcha"><?= captcha_img() ?>
                    </div>
                </div>
                <div class="form-lk__bottom"><button class="btn btn--accent2">{{ __('Process') }}</button>
                </div>
            </form>
        </div>
        <div class="form-lk__col"><img src="/img/profit.png" alt="">
        </div>
    </div>
</section>

<script>document.getElementById("balanceProfilePageMenuItem").className = "navigation-icons__link navigation-icons__link--active";</script>

@push('script')
@endpush

@endsection
