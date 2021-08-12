<li class="collection-item">
    <div class="row">
        <div class="col s7">
            <p class="collections-title">@if($dateTo == 'Invalid date') Активность за {{ $dateFrom }} @else Активность за период с {{ $dateFrom }} по {{ $dateTo }} @endif</p>
        </div>
        <div class="col s2"><span class="task-cat deep-orange accent-2">{{ $userActivity['time'] }}</span></div>
        <div class="col s3">
            <div class="progress">
{{--                <div class="determinate" style="width: {{ $userActivityDay['percentage'] }}%"></div>--}}
            </div>
        </div>
    </div>
</li>
