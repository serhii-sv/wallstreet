<!-- BEGIN: Footer-->
<footer style="position: absolute; width:100%; margin-top:50px;"
        class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
    <div class="footer-copyright">
        <div class="container">

            <!-- TradingView Widget BEGIN -->
            {{--        <div class="tradingview-widget-container">--}}
            {{--            <div class="tradingview-widget-container__widget"></div>--}}
            {{--            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>--}}
            {{--                {--}}
            {{--                    "symbols": [--}}
            {{--                    {--}}
            {{--                        "proName": "FOREXCOM:SPXUSD",--}}
            {{--                        "title": "S&P 500"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "proName": "FOREXCOM:NSXUSD",--}}
            {{--                        "title": "US 100"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "proName": "FX_IDC:EURUSD",--}}
            {{--                        "title": "EUR/USD"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "proName": "BITSTAMP:BTCUSD",--}}
            {{--                        "title": "Биткоин"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "proName": "BITSTAMP:ETHUSD",--}}
            {{--                        "title": "Эфириум"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "Матик",--}}
            {{--                        "proName": "BINANCE:MATICUSDT"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "Луна",--}}
            {{--                        "proName": "BINANCE:LUNAUSDT"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "Шиб",--}}
            {{--                        "proName": "BINANCE:SHIBUSDT"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "Ада",--}}
            {{--                        "proName": "BINANCE:ADAUSDT"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "Солана",--}}
            {{--                        "proName": "BINANCE:SOLUSDT"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "Сс",--}}
            {{--                        "proName": "BINANCE:SANDUSDT"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "хрп",--}}
            {{--                        "proName": "BINANCE:XRPUSDT"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "ава",--}}
            {{--                        "proName": "BINANCE:AAVEUSDT"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "ф",--}}
            {{--                        "proName": "BINANCE:FTMUSDT"--}}
            {{--                    },--}}
            {{--                    {--}}
            {{--                        "description": "дот",--}}
            {{--                        "proName": "BINANCE:DOTUSDT"--}}
            {{--                    }--}}
            {{--                ],--}}
            {{--                    "colorTheme": "dark",--}}
            {{--                    "isTransparent": false,--}}
            {{--                    "showSymbolLogo": false,--}}
            {{--                    "locale": "ru"--}}
            {{--                }--}}
            {{--            </script>--}}
            {{--        </div>--}}
            <div style="height:62px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 0px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; block-size:42px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:40px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=light&pref_coin_id=1505&invert_hover=" width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div></div>
        </div>
    </div>
</footer>

<!-- END: Footer-->
