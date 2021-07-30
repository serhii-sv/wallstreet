@extends('mail.layout')
@section('content')
    {{ __('You just got partner commission for') }} {{ $refill_amount }}{{ $currency->symbol }}
@endsection

