<!-- BEGIN: Footer-->
<footer style="position: absolute; width:100%;"
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">

        <!-- TradingView Widget BEGIN -->
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
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
                        "proName": "BITSTAMP:ETHUSD",
                        "title": "ETH/USD"
                    },
                    {
                        "description": "BTC/USDT",
                        "proName": "BINANCE:BTCUSDT"
                    },
                    {
                        "description": "ETH/USDT",
                        "proName": "BINANCE:ETHUSDT"
                    },
                    {
                        "description": "SHIB/USDT",
                        "proName": "BINANCE:SHIBUSDT"
                    },
                    {
                        "description": "DOT/USDT",
                        "proName": "BINANCE:DOTUSDT"
                    },
                    {
                        "description": "SOL/USDT",
                        "proName": "BINANCE:SOLUSDT"
                    },
                    {
                        "description": "XRP/USDT",
                        "proName": "BINANCE:XRPUSDT"
                    },
                    {
                        "description": "BNB/USDT",
                        "proName": "BINANCE:BNBUSDT"
                    },
                    {
                        "description": "DOGE/USDT",
                        "proName": "BINANCE:DOGEUSDT"
                    },
                    {
                        "description": "FTM/USDT",
                        "proName": "BINANCE:FTMUSDT"
                    },
                    {
                        "description": "ADA/USDT",
                        "proName": "BINANCE:ADAUSDT"
                    },
                    {
                        "description": "MATIC/USDT",
                        "proName": "BINANCE:MATICUSDT"
                    }
                ],
                    "showSymbolLogo": false,
                    "colorTheme": "dark",
                    "isTransparent": true,
                    "displayMode": "adaptive",
                    "locale": "ru"
                }
            </script>
        </div>
        <!-- TradingView Widget END -->

    </div>
  </div>
</footer>

<!-- END: Footer-->
