@extends('mail.layout')
@section('content')
    {{ __('You got new bonus for') }} {{ $bonus_amount }}{{ $currency->symbol }}
@endsection

