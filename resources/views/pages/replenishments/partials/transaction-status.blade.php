@switch($transaction->approved)
    @case(0)
    <span class="chip lighten-5 orange orange-text">Ожидание</span>
    @break
    @case(1)
    <span class="chip lighten-5 green green-text">Закрыта</span>
    @break
    @case(2)
    <span class="chip lighten-5 red red-text">Отменена</span>
    @break
@endswitch
