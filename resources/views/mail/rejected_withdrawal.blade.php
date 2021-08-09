@extends('mail.layout')
@section('content')
    {{ __('Your withdrawal for') }} {{ $withdraw_amount }}{{ $currency->symbol }} {{ __('was cancelled.') }}
@endsection
