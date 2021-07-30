@extends('mail.layout')
@section('content')
    {{ __('Your deposit for') }} {{ $deposit->invested }}{{ $deposit->currency->symbol }} was accrued for {{ $dividend->amount }}{{ $deposit->currency->symbol }}
@endsection

