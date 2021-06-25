@extends('profile.layouts.customer')
@section('title', __('Settings'))
@section('content')

<section class="lk-section">
    <h3 class="title">{{ __('Personal information') }}
    </h3>
    <div class="form-lk">
        <div class="form-lk__col">
            <form method="POST" action="{{ route('profile.settings') }}">
                <p style="font-weight: bold;">@include('partials.inform')</p>
                {{ csrf_field() }}

                <div class="input-row white-shadow-select">
                    <label for="name" class="input-row__name">{{ __('Name') }}
                    </label><input id="name" name="name" type="text" value="{{ getUserName() }}" class="input-row__input input input--white-shadow"/>
                </div>
                <div class="input-row">
                    <label for="email" class="input-row__name">{{ __('Email') }}
                    </label><input id="email" name="email" type="text" value="{{ getUserEmail() }}" class="input-row__input input input--white-shadow" disabled/>
                </div>
                <div class="input-row">
                    <label for="login" class="input-row__name">{{ __('Login') }}
                    </label><input id="login" name="login" type="text" value="{{ getUserLogin() ? getUserLogin() : old('login') }}" class="input-row__input input input--white-shadow"/>
                </div>
                <div class="input-row">
                    <label for="partner_id" class="input-row__name">{{ __('Partner ID') }}
                    </label><input id="partner_id" name="partner_id" type="text" value="{{ getPartnerId() ? getPartnerId() : old('partner_id') }}" class="input-row__input input input--white-shadow"/>
                </div>
                <div class="input-row">
                    <label for="phone" class="input-row__name">{{ __('Phone') }}
                    </label><input id="phone" name="phone" type="text" value="{{ getUserPhone() ? getUserPhone() : old('phone') }}" class="input-row__input input input--white-shadow"/>
                </div>
                <div class="input-row">
                    <label for="skype" class="input-row__name">{{ __('Skype') }}
                    </label><input id="skype" name="skype" type="text" value="{{ getUserSkype() ? getUserSkype() : old('skype') }}" class="input-row__input input input--white-shadow"/>
                </div>
                <h3 class="title">{{ __('Your wallets') }}
                </h3>
                @foreach(getUserWallets() as $wallet)
                    <div class="input-row">
                        <label for="wallet_{{ $wallet['id'] }}" class="input-row__name input-row__name--accent-strong">{{ $wallet['payment_system']['name'] }} {{ $wallet['currency']['code'] }}</label>

                        <input id="wallet_{{ $wallet['id'] }}" type="text" class="input-row__input input input--white-shadow"
                                   name="wallets[{{ $wallet['id'] }}]" value="{{ $wallet['external'] }}">
                    </div>
                @endforeach
                <div class="form-lk__bottom"><button type="submit" class="btn btn--accent2">{{ __('Save profile') }}</button>
                </div>
            </form>
        </div>
        <div class="form-lk__col"><img src="/img/settings.png" alt="">
        </div>
    </div>
</section>

<script>document.getElementById("settingsProfilePageMenuItem").className = "navigation-icons__link navigation-icons__link--active";</script>

@push('script')
@endpush

@endsection
