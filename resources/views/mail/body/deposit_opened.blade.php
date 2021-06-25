@extends('mail.layout')
@section('content')
    {{ __('You have created new deposit for') }} {{ $deposit->balance }}{{ $deposit->currency->symbol }}
@endsection
