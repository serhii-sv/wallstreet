@extends('mail.layout')
@section('content')
    {{ __('Your deposit for') }} {{ $deposit->balance }}{{ $deposit->currency->symbol }} {{ __('was closed.') }}
@endsection