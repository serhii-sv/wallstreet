<!-- BEGIN: Footer-->
<footer
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">
      Поставь цель. Составь план. Не ленись. Совершенствуйся. Будь ответственным. Не смотри на других. Верь в свой Успех.
    </div>
  </div>
</footer>

<!-- END: Footer-->
