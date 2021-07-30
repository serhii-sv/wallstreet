@extends('mail.layout')
@section('content')
    {{ __('New withdrawal was created for your account.') }}
    <b>{{ __('Amount') }} {{ $withdraw_amount }}{{ $currency->symbol }}.</b>
    <b>{{ __('Wallet to accept transfer') }} {{ $wallet->external }}</b>
@endsection

