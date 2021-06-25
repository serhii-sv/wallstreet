<div class="balance">
    <ul class="balance__list">
    @foreach(getUserBalancesByCurrency() as $code => $balance)
        <li class="balance__item js-tilt">
            <?php
            switch ($code){
                case "USD":
                    $img = 'dollar';
                    break;

                case "BTC":
                    $img = 'btc';
                    break;

                case "ETH":
                    $img = 'etherium';
                    break;
            }
            ?>
            <div class="balance__icon"><img src="{{ asset('img/'.$img.'.png') }}" alt="{{ $code }}">
            </div><span class="balance__count">{{ number_format($balance, 8) }}</span>
        </li>
    @endforeach
    </ul>
</div>