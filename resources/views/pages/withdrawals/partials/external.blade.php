<span>{{ $transaction->paymentSystem->name }} {{ $transaction->currency->code }}</span>
<br>
{{--<span style="cursor: pointer">--}}
{{--  @if($transaction->paymentSystem->code == 'payeer')--}}
{{--        {{ $transaction->wallet->external_payeer ?? '' }}--}}
{{--  @elseif($transaction->paymentSystem->code == 'qiwi')--}}
{{--        {{ $transaction->wallet->external_qiwi ?? '' }}--}}
{{--  @else--}}
{{--  {{ $transaction->wallet->external ?? '' }}--}}
{{--  @endif--}}
{{--</span>--}}

@php
    if($transaction->paymentSystem->code == 'payeer') {
        $external = $transaction->wallet->external_payeer ?? '';
    } elseif ($transaction->paymentSystem->code == 'qiwi') {
        $external = $transaction->wallet->external_qiwi ?? '';
    } else {
        $external = $transaction->wallet->external ?? '';
    }
@endphp

<span class="invoice-amount copy-to-clipboard tooltip" data-text="{{ $external }}">
     <span class="tooltiptext">Кликните чтоб скопировать</span>
   {{ $external }}
</span>
