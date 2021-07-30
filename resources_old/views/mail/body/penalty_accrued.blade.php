@extends('mail.layout')
@section('content')
    {{ __('You just got penalty for') }} {{ $bonus_amount }}{{ $currency->symbol }}
@endsection


