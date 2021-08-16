@switch($transaction->approved)
@case(0)
<span class="chip lighten-5 orange orange-text">Не оплаченная заявка</span>
@break
@case(1)
<span class="chip lighten-5 green green-text">Оплаченная заявка</span>
@break
@case(2)
<span class="chip lighten-5 red red-text">Отклоненная заявка</span>
@break
@endswitch
