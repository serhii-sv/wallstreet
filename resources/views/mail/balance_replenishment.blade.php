@extends('mail.layout')
@section('content')
  Баланс пополнен {{ $deposit->balance ?? '' }}{{ $deposit->currency->symbol ?? '' }}
@endsection
