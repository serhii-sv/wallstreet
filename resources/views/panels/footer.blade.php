<!-- BEGIN: Footer-->
<footer
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">
      @if(canEditLang() && checkRequestOnEdit())
        <editor_block data-name="Set a goal. Make a plan. Do not be lazy. Improve yourself. Be responsible. Don't look at others. Believe in your Success." contenteditable="true">{{ __("Set a goal. Make a plan. Do not be lazy. Improve yourself. Be responsible. Don't look at others. Believe in your Success.") }}</editor_block>
      @else
        {{ __("Set a goal. Make a plan. Do not be lazy. Improve yourself. Be responsible. Don't look at others. Believe in your Success.") }}
      @endif
    </div>
  </div>
</footer>

<!-- END: Footer-->
