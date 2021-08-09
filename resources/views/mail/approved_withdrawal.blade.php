@extends('mail.layout')
@section('content')
{{ __('Your withdrawal for') }} {{ number_format($withdraw_amount, $currency->precision, '.', '') }}{{ $currency->symbol }} {{ __('have been approved') }}.
@endsection
