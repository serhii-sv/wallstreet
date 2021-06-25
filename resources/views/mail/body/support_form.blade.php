@extends('mail.layout')
@section('content')
    Sender: {{ $sender_email }}
    <p>
        Text: {{ $sender_text }}
    </p>
@endsection