@extends('mail.layout')
@section('content')
    <?php
    $currency = null;

    if (null !== $payment_system) {
        $currency = $payment_system->currencies()->first();
    }
    ?>
    {{ __('Your wallet was refilled for') }} {{ isset($refill_amount) ? $refill_amount : 0 }}{{ null !== $currency ? $currency->code : '' }}
@endsection
