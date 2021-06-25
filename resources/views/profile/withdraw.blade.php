@extends('profile.layouts.customer')
@section('title', __('Withdraw'))
@section('content')

<section class="lk-section">
    <div class="form-lk">
        <div class="form-lk__col">
            <form method="POST" action="{{ route('profile.withdraw') }}">
                <p style="font-weight: bold;">@include('partials.inform')</p>
                <div class="input-row white-shadow-select">
                    {{ csrf_field() }}
                    <label for="wallet" class="input-row__name">{{ __('Wallet') }}
                    </label>
                    <select id="wallet" name="wallet_id" class="select">
                        @foreach(getUserWallets() as $wallet)
                            <option value="{{ $wallet['id'] }}">{{ $wallet['payment_system']['name'] }}
                                - {{ number_format($wallet['balance'], $wallet['currency']['precision']) }}{{ $wallet['currency']['symbol'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-row">
                    <label for="amount" class="input-row__name">{{ __('Amount') }}
                    </label><input id="amount" name="amount" class="input-row__input input input--white-shadow" type="number" step="any" required/>
                </div>
                <div class="input-row">
                    <label class="input-row__name">{{ __('Enter captcha code') }}:
                    </label><input class="input-row__input input input--white-shadow" type="text" name="captcha" id="captcha"/>
                    <div class="input-row__captcha"><?= captcha_img() ?>
                    </div>
                </div>
                <div class="form-lk__bottom"><button class="btn btn--accent2">{{ __('Process withdraw') }}</button>
                </div>
            </form>
        </div>
        <div class="form-lk__col"><img src="/img/deposit.png" alt="">
        </div>
    </div>
</section>

<script>document.getElementById("withdrawProfilePageMenuItem").className = "navigation-icons__link navigation-icons__link--active";</script>

@push('script')
@endpush

@endsection
