{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Операции с балансом')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/pricing.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <div class="row">
        @include('pages.notifications')

        <div class="col s12 m12 l12">

            <div class="section users-edit">
                <div class="card">

                    <div class="card-content">
                        <h4 class="card-title mt-2 mb-1" style="text-align: center">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Accrue bonus' contenteditable="true">{{ __('Accrue bonus') }}</editor_block>
                            @else
                                {{ __('Accrue bonus') }}
                            @endif</h4>
                        <form method="post" class="dashboard-send-bonus-form" action="{{ route('bonuses.add_bonus') }}">
                            {{ csrf_field() }}

                            <div class="row" style="text-align: center; margin-top:20px;">
                                <div class="col-12">
                                    <input class="checkbox-tools" name="type" value="enter" type="radio" {{ old('type', 'enter') == 'enter' ? 'checked' : '' }} id="enter">
                                    <label class="for-checkbox-tools" for="enter">@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Depositing funds into the system' contenteditable="true">{{ __('Depositing funds into the system') }}</editor_block>
                                        @else
                                            {{ __('Depositing funds into the system') }}
                                        @endif</label>
                                    <input class="checkbox-tools" name="type" value="withdraw" type="radio"  id="withdraw" {{ old('type') == 'withdraw' ? 'checked' : '' }}>
                                    <label class="for-checkbox-tools" for="withdraw">@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Withdraw funds' contenteditable="true">{{ __('Withdraw funds') }}</editor_block>
                                        @else
                                            {{ __('Withdraw funds') }}
                                        @endif</label>
                                </div>
                            </div>

                            <div class="row" style="text-align: center; margin-top:20px;">
                                <h4 class="card-title mt-2 mb-1" style="text-align: center;">
                                    @if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Choose currency for bonus' contenteditable="true">{{ __('Choose currency for bonus') }}</editor_block>
                                    @else
                                        {{ __('Choose currency for bonus') }}
                                    @endif
                                </h4>

                                <div class="col-12 ">
                                    @foreach($currencies as $currency)
                                        @if($loop->index % 7 == 0 && $loop->index > 1)
                                            <br>
                                        @endif
                                        <input class="checkbox-tools" value="{{ $currency->id }}" type="radio" {{ old('currency', $currencies[0]->id ?? '') == $currency->id ? 'checked' : '' }}  name="currency" id="currency-{{ $currency->id }}">
                                        <label class="for-checkbox-tools" for="currency-{{ $currency->id }}">
                                            {{ $currency->code }}
                                        </label>
                                    @endforeach

                                </div>
                            </div>


                            <div class="row" style="margin-top:20px; text-align: center;">
                                <h4 class="card-title mt-2 mb-1" style="text-align: center;">
                                    @if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Choose payment system for bonus' contenteditable="true">{{ __('Choose payment system for bonus') }}</editor_block>
                                    @else
                                        {{ __('Choose payment system for bonus') }}
                                    @endif
                                </h4>

                                @foreach($payment_systems as $ps)
                                    <input class="checkbox-tools" name="payment_system" value="{{ $ps->id }}" type="radio" id="payment_system-{{ $ps->id }}" {{ old('payment_system', $payment_system[0]->id ?? '') == $ps->id ? 'checked' : '' }}>
                                    <label class="for-checkbox-tools" for="payment_system-{{ $ps->id }}">
                                        {{ $ps->name }}
                                    </label>
                                @endforeach
                            </div>


                            <div class="row" style="margin-top:20px; text-align: center;">
                                <h4 class="card-title mt-2 mb-1" style="text-align: center;">
                                    @if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Choose type for bonus' contenteditable="true">{{ __('Choose type for bonus') }}</editor_block>
                                    @else
                                        {{ __('Choose type for bonus') }}
                                    @endif
                                </h4>

                                <div class="col-12">
                                    <input class="checkbox-tools" name="is_real" value="1" type="radio" id="is_real1" {{ old('is_real', '1') == '1' ? 'checked' : '' }}>
                                    <label class="for-checkbox-tools" for="is_real1">@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Real' contenteditable="true">{{ __('Real') }}</editor_block>
                                        @else
                                            {{ __('Real') }}
                                        @endif</label>
                                    <input class="checkbox-tools" name="is_real" value="0" type="radio" id="is_real0" {{ old('is_real') == '0' ? 'checked' : '' }} >
                                    <label class="for-checkbox-tools" for="is_real0">@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Fake' contenteditable="true">{{ __('Fake') }}</editor_block>
                                        @else
                                            {{ __('Fake') }}
                                        @endif</label>
                                </div>
                            </div>

                            <div class="row" style=" text-align: center;">
                                <div class="input-field col s12 text-center">
                                    <div >
                                        <input id="login" type="text" name="login"
                                               placeholder="{{ __('Login, email or id') }}" value="{{ old('login') }}"
                                               style="font-weight: bold; text-align: center;width: 320px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style=" text-align: center;">
                                <div class="input-field col s12">
                                    <div class="text-center">
                                        <input id="amount" type="text" name="amount" placeholder="{{ __('Amount') }}" value="{{ old('amount') }}"
                                               style="font-weight: 500; text-align: center; width: 320px;">
                                    </div>
                                </div>
                            </div>


                            <div class="row" style="text-align: center;">
                                <div class="input-field col s12" style="text-align:center;">
                                    <button class="btn red accent-2 shadow waves-effect waves-light dashboard-send-bonus-btn" type="submit" name="action" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Send bonus' contenteditable="true">{{ __('Send bonus') }}</editor_block>
                                        @else
                                            {{ __('Send bonus') }}
                                        @endif<i class="material-icons right">attach_money</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('vendors/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('vendors/chartjs/chart.min.js')}}"></script>
    <script src="{{asset('vendors/chartist-js/chartist.min.js')}}"></script>
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>
    <script src="{{asset('vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script>
@endsection

@section('page-script')
    <script>
        $(document).ready(function () {
            $(".dashboard-send-bonus-btn").on('click', function (e) {
                e.preventDefault();
                swal({
                    title: "Вы уверены?",
                    text: "Пользователю будет начислен бонус!",
                    icon: 'warning',
                    buttons: {
                        cancel: true,
                        delete: 'Выполнить операцию?'
                    }
                }).then(function (willDelete) {
                    if (willDelete) {
                        $(".dashboard-send-bonus-form").submit();
                    }
                });
            });
        });
    </script>
@endsection
