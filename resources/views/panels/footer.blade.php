<!-- BEGIN: Footer-->
<footer style="position: absolute; width:100%; margin-top:50px;"
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">

        <!-- TradingView Widget BEGIN -->
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <div class="tradingview-widget-copyright"><a href="https://ru.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Котировки</span></a> предоставлены TradingView</div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
                {
                    "symbols": [
                    {
                        "proName": "FOREXCOM:SPXUSD",
                        "title": "S&P 500"
                    },
                    {
                        "proName": "FOREXCOM:NSXUSD",
                        "title": "US 100"
                    },
                    {
                        "proName": "FX_IDC:EURUSD",
                        "title": "EUR/USD"
                    },
                    {
                        "proName": "BITSTAMP:BTCUSD",
                        "title": "Биткоин"
                    },
                    {
                        "proName": "BITSTAMP:ETHUSD",
                        "title": "Эфириум"
                    },
                    {
                        "description": "Матик",
                        "proName": "BINANCE:MATICUSDT"
                    },
                    {
                        "description": "Луна",
                        "proName": "BINANCE:LUNAUSDT"
                    },
                    {
                        "description": "Шиб",
                        "proName": "BINANCE:SHIBUSDT"
                    },
                    {
                        "description": "Ада",
                        "proName": "BINANCE:ADAUSDT"
                    },
                    {
                        "description": "Солана",
                        "proName": "BINANCE:SOLUSDT"
                    },
                    {
                        "description": "Сс",
                        "proName": "BINANCE:SANDUSDT"
                    },
                    {
                        "description": "хрп",
                        "proName": "BINANCE:XRPUSDT"
                    },
                    {
                        "description": "ава",
                        "proName": "BINANCE:AAVEUSDT"
                    },
                    {
                        "description": "ф",
                        "proName": "BINANCE:FTMUSDT"
                    },
                    {
                        "description": "дот",
                        "proName": "BINANCE:DOTUSDT"
                    }
                ],
                    "colorTheme": "dark",
                    "isTransparent": false,
                    "showSymbolLogo": false,
                    "locale": "ru"
                }
            </script>
        </div>

    </div>
  </div>
</footer>

<!-- END: Footer-->
