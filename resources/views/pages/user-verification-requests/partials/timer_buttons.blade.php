@if(App\Models\Setting::getValue('autoaccept_documents_timer_enablde', 'off', true) == 'on')
    @if($verificationRequest->autoaccept)
        <a href="{{ route('verification-requests.updateAutoAccept', ['id' => $verificationRequest->id, 'timer' => 'off']) }}"
           class="btn waves-effect waves-light">Выключить</a>
    @else
        <a href="{{ route('verification-requests.updateAutoAccept', ['id' => $verificationRequest->id, 'timer' => 'on']) }}"
           class="btn waves-effect waves-light">Включить</a>
    @endif
@else
    @if(canEditLang() && checkRequestOnEdit())
    <editor_block data-name='Авто подтверждение не включено'
                  contenteditable="true">{{ __('Авто подтверждение не включено') }}</editor_block>
    @else {{ __('Авто подтверждение не включено') }} @endif
@endif
