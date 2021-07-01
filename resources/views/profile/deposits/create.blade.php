@extends('profile.layouts.customer')
@section('title', __('Create deposit'))
@section('content')
    <section class="lk-section">
        <div class="form-lk">
            <div class="form-lk__col">
                <form action="{{ route('profile.deposits.store') }}" method="POST" target="_top">
                    <p style="font-weight: bold;">@include('partials.inform')</p>
                    {{ csrf_field() }}

                    <div style="margin-bottom: 50px; text-align: center; color: grey; font-style: italic;">
                    <p class="help-block" style="margin-left:20px;">
                        <strong>{{ __('Selected rate') }}</strong>: {{ $rate['name'] }}. {{ __('Minimum investment') }}
                        : {{ number_format($rate['min'], $rate['currency']['precision']) }} {{ $rate['currency']['code'] }}
                        , {{ __('Maximum investment') }}
                        : {{ number_format($rate['max'], $rate['currency']['precision']) }} {{ $rate['currency']['code'] }}
                        , {{ __('Daily interest') }}: {{ $rate['daily'] }}%</p>
                    </div>

{{--                    <div class="input-row white-shadow-select">--}}
{{--                        <label for="wallet" class="input-row__name">{{ __('Wallet') }}--}}
{{--                        </label>--}}
{{--                        <select class="select" id="wallet" name="wallet_id" autofocus>--}}
{{--                            @foreach(getUserWallets($rate['currency']['id']) as $wallet)--}}
{{--                                <option value="{{ $wallet['id'] }}">{{ $wallet['payment_system']['name'] }} - {{ number_format($wallet['balance'], $wallet['currency']['precision']) }} {{ $wallet['currency']['code'] }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

                    <div class="input-row white-shadow-select">
                        <label for="rate" class="input-row__name">{{ __('Wallet') }}
                        </label>
                        <select id="rate" name="rate_id" style="width:60%;" autofocus>
                            @foreach(getTariffPlans() as $plan)
                                <option value="{{ $plan['id'] }}"{{ isset($rate) && $rate['id'] == $plan['id'] ? ' selected' : '' }}>{{ $plan['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-row">
                        <label for="amount" class="input-row__name">{{ __('Amount') }}
                        </label><input id="amount" name="amount" type="number" step="any" class="input-row__input input input--white-shadow"
                                       value="{{ old('amount') }}" required/>
                    </div>

                    <div class="form-lk__bottom"><button type="submit" class="btn btn--accent2">{{ __('Create deposit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('load-scripts')
    <script>
        $(document).ready(function(){
            $('#rate').change(function(){
                var val = jQuery(this).val();
                location.assign('/deposits/create?rate_id='+val);
            });
        });
    </script>
@endpush
