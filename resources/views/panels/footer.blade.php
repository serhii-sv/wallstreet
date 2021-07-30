<!-- BEGIN: Footer-->
<footer
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">
      <span>&copy; {{ date('Y') }} <a href="https://factorcrm.co"
          target="_blank">FactorCRM</a> All rights reserved.
      </span>
      <span class="right hide-on-small-only">
        With Developed by <a href="https://factorcrm.co/">FactorCRM</a>
      </span>
    </div>
  </div>
</footer>

<!-- END: Footer-->
