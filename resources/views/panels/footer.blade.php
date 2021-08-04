<!-- BEGIN: Footer-->
<footer
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">
      <span>&copy; {{ date('Y') }} <a href="https://{{ $_SERVER['HTTP_HOST'] }}"
          target="_blank">{{ $_SERVER['HTTP_HOST'] }}</a> All rights reserved.
      </span>
      <span class="right hide-on-small-only">
          Разработано с душой :)
      </span>
    </div>
  </div>
</footer>

<!-- END: Footer-->
