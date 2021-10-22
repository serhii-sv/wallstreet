{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Kanban')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/jkanban/jkanban.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/chartist-js/chartist.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/chartist-js/chartist-plugin-tooltip.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-kanban.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-modern.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <!-- Basic Kanban App -->
    <section id="kanban-wrapper" class="section">
        <div class="kanban-overlay"></div>
        <div class="row">
            <div class="col s12 m6 l4">
                <!-- Current Balance -->
                <div class="card animate fadeLeft">
                    <div class="card-content">
                        <h6 class="mb-0 mt-0 display-flex justify-content-between">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Activity time' contenteditable="true">{{ __('Activity time') }}</editor_block>@else {{ __('Activity time') }} @endif
                            <i class="material-icons float-right">more_vert</i>
                        </h6>
                        {{--                    <p class="medium-small">Активность за сегодня</p>--}}
                        <div class="current-balance-container">
                            <div id="current-balance-donut-chart" class="current-balance-shadow"></div>
                        </div>
                        <h5 class="center-align">{{ $userActivity['time'] }}</h5>
                        <p class="medium-small center-align">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Activity today' contenteditable="true">{{ __('Activity today') }}</editor_block>@else {{ __('Activity today') }} @endif</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4" style="padding: 8px">
                <ul id="task-card" class="collection with-header animate fadeLeft">
                    <li class="collection-header cyan">
                        <h5 class="task-card-title mb-3">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Tasks' contenteditable="true">{{ __('Tasks') }}</editor_block>@else {{ __('Tasks') }} @endif</h5>
                    </li>
                    @foreach(auth()->user()->tasks as $task)
                        <li class="collection-item dismissable">
                            <label for="{{ $task->id }}">
                                <input type="checkbox" id="{{ $task->id }}" {{ $task->done ? 'checked' : '' }} />
                                <span class="width-100">{{ $task->content }}</span>
                                <div class="display-flex justify-content-end">
                                    <a href="{{ route('tasks.destroy', $task) }}" class="secondary-content">
                                    <span class="ultra-small">
                                        <i class="material-icons dp48">delete</i>
                                    </span>
                                    </a>
                                </div>
                            </label>
                        </li>
                    @endforeach
                    <li class="collection-item dismissable">
                        <form action="{{ route('tasks.store') }}" method="post">
                            @csrf
                            <label for="task_content">
                                <input type="text" id="task_content" name="task_content" placeholder="Новая задача" value="{{ old('task_content') }}" />
                                <span class="width-100">
                                <button class="btn btn-small" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                                    <span class="ultra-small">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Save' contenteditable="true">{{ __('Save') }}</editor_block>@else {{ __('Save') }} @endif</span>
                                </button>
                            </span>
                            </label>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="col s12">
                <!-- New kanban board add button -->
                <button type="button" class="btn waves-effect waves-light mb-1 add-kanban-btn" id="add-kanban">
                    <i class='material-icons left'>add</i> @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Add new board' contenteditable="true">{{ __('Add new board') }}</editor_block>@else {{ __('Add new board') }} @endif
                </button>
                <!-- kanban container -->
                <div id="kanban-app"></div>
            </div>
        </div>
      
    </section>
    <!--/ Sample Project kanban -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/jkanban/jkanban.min.js')}}"></script>
    <script src="{{asset('vendors/quill/quill.min.js')}}"></script>
    <script src="{{asset('vendors/chartjs/chart.min.js')}}"></script>
    <script src="{{asset('vendors/chartist-js/chartist.min.js')}}"></script>
    <script src="{{asset('vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>
    <script src="{{asset('vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
    <script>
        var boards = @json($boards)
    </script>
    <script src="{{asset('js/scripts/app-kanban.js')}}"></script>
    <script>
        $(function () {
            $("#task-card input:checkbox").change(function () {
                let checkbox = this;
                $.ajax({
                    url: '/tasks/update/' + $(checkbox).attr('id'),
                    method: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        status: $(checkbox).prop("checked")
                    },
                    success: (response) => {
                        M.toast({
                            html: response.message,
                            classes: response.success ? 'green' : 'red'
                        })
                        if (response.success) {
                            checkbox_check(checkbox);
                        }
                    }
                })
            });

            // Check Uncheck function
            function checkbox_check(el) {
                console.log($(el).prop("checked"), el)
                if (!$(el).prop("checked")) {
                    $(el)
                        .next()
                        .css("text-decoration", "none"); // or addClass
                } else {
                    $(el)
                        .next()
                        .css("text-decoration", "line-through"); //or addClass
                }
            }

            $("#task-card input:checkbox").each(function () {
                checkbox_check(this);
            });

            var CurrentBalanceDonutChart = new Chartist.Pie(
                "#current-balance-donut-chart",
                {
                    labels: [1, 2],
                    series: [
                        {meta: "Completed", value: {{ $userActivity['percentage'] }}},
                        {meta: "Remaining", value: 100 - {{ $userActivity['percentage'] }}}
                    ]
                },

                {
                    donut: true,
                    donutWidth: 8,
                    showLabel: false,
                    plugins: [
                        Chartist.plugins.tooltip({
                            class: "current-balance-tooltip",
                            appendToBody: true
                        }),
                        Chartist.plugins.fillDonut({
                            items: [
                                {
                                    content: '<h5 class="mt-0 mb-0">{{ $userActivity['time'] }}</h5>'
                                }
                            ]
                        })
                    ]
                }
            )

            CurrentBalanceDonutChart.update();
        })
    </script>
@endsection
