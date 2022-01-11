@if(App\Models\Setting::getValue('autoaccept_documents_timer_enablde', 'off', true) == 'on')
    @if($verificationRequest->autoaccept)
    @php
        $timestamp = $verificationRequest->created_at->format('U');
            $distance = $timestamp - Carbon\Carbon::now()->timestamp;
            $days = floor($distance / ( 60 * 60 * 24)) < 0 ? 0 : floor($distance / (60 * 60 * 24));
            $hours = floor(($distance % (60 * 60 * 24)) / (60 * 60)) < 0 ? 0 : floor(($distance % (60 * 60 * 24)) / (60 * 60));
            $minutes = floor(($distance % (60 * 60)) / 60) < 0 ? 0 : floor(($distance % (60 * 60)) / 60);
            $seconds = floor($distance % 60) < 0 ? 0 : floor($distance % 60);
    @endphp
    {{ $days > 0 ? $days . ' дней' : '' }} {{ str_pad($hours,2,'0',STR_PAD_LEFT) . ':'. str_pad($minutes,2,'0',STR_PAD_LEFT) . ':' . str_pad($seconds,2,'0',STR_PAD_LEFT) }}
    @else
        @if(canEditLang() && checkRequestOnEdit())
        <editor_block data-name='Авто подтверждение не включено'
                      contenteditable="true">{{ __('Авто подтверждение не включено') }}</editor_block>
        @else {{ __('Авто подтверждение не включено') }} @endif
    @endif
@else
    @if(canEditLang() && checkRequestOnEdit())
        <editor_block data-name='Авто подтверждение не включено'
                      contenteditable="true">{{ __('Авто подтверждение не включено') }}</editor_block>
    @else {{ __('Авто подтверждение не включено') }} @endif
@endif

