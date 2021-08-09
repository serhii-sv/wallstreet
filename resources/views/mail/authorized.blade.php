@extends('mail.layout')
@section('content')
{{ __('Someone was authorized into your account, with IP:') }} {{ $ip }}
@endsection