<!-- BEGIN: Footer-->
<footer
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">
        <style>
            .string{
                width:600px;
                height:30px;
                margin:60px auto;
                line-height:28px;
                padding: 0 10px;
                border-radius:4px;
                box-shadow:0 1px 2px #777;
                -moz-border-radius:4px;
                -webkit-border-radius:4px;
                background: rgb(238,238,238);
                background: -moz-linear-gradient(top,  rgba(238,238,238,1) 0%, rgba(204,204,204,1) 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(238,238,238,1)), color-stop(100%,rgba(204,204,204,1)));
                background: -webkit-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%);
                background: -o-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%);
                background: -ms-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%);
                background: linear-gradient(to bottom,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 );
            }
        </style>
        <div id="marquee">
            <?php
            $rates = \App\Models\Setting::where('s_key', 'like', '%_to_usd')
                ->orderBy('s_value', 'desc')
                ->get()
                ->each(function(\App\Models\Setting $rate) {
                    echo $rate->s_key.': '.$rate->s_value.' | ';
                });
            ?>
        </div>
    </div>
  </div>
</footer>

<!-- END: Footer-->
