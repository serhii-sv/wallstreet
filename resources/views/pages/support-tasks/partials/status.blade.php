@switch($supportTask->status)
@case(\App\Models\SupportTask::PENDING_STATUS)
<span class="chip lighten-5 orange orange-text">Ожидание</span>
@break
@case(\App\Models\SupportTask::ANSWERED_STATUS)
<span class="chip lighten-5 green green-text">Отвечено</span>
@break
@case(\App\Models\SupportTask::CLOSED_STATUS)
<span class="chip lighten-5 red red-text">Закрыта</span>
@break
@endswitch
