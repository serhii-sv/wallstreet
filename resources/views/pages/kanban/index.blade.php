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
                        <h6 class="mb-0 mt-0 display-flex justify-content-between">Время активности
                            <i class="material-icons float-right">more_vert</i>
                        </h6>
                        {{--                    <p class="medium-small">Активность за сегодня</p>--}}
                        <div class="current-balance-container">
                            <div id="current-balance-donut-chart" class="current-balance-shadow"></div>
                        </div>
                        <h5 class="center-align">{{ $userActivity['time'] }}</h5>
                        <p class="medium-small center-align">Активность за сегодня</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4" style="padding: 8px">
                <ul id="task-card" class="collection with-header animate fadeLeft">
                    <li class="collection-header cyan">
                        <h5 class="task-card-title mb-3">Задачи</h5>
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
                                <button class="btn btn-small">
                                    <span class="ultra-small">Сохранить</span>
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
                    <i class='material-icons left'>add</i> Добавить новую доску
                </button>
                <!-- kanban container -->
                <div id="kanban-app"></div>
            </div>
        </div>

        <!-- User new mail right area -->
{{--        <div class="kanban-sidebar">--}}
{{--            <div class="card quill-wrapper">--}}
{{--                <div class="card-content pt-0">--}}
{{--                    <div class="card-header display-flex pb-2">--}}
{{--                        <h3 class="card-title">UI Design</h3>--}}
{{--                        <div class="close close-icon">--}}
{{--                            <i class="material-icons">close</i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="divider"></div>--}}
{{--                    <!-- form start -->--}}
{{--                    <form class="edit-kanban-item mt-10 mb-10">--}}
{{--                        <div class="input-field">--}}
{{--                            <input type="text" class="edit-kanban-item-title validate" id="edit-item-title" placeholder="kanban Title">--}}
{{--                            <label for="edit-item-title">Card Title</label>--}}
{{--                        </div>--}}
{{--                        <div class="input-field">--}}
{{--                            <input type="text" class="edit-kanban-item-date datepicker" id="edit-item-date" value="21/08/2019">--}}
{{--                            <label for="edit-item-date">Due Date</label>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col s6">--}}
{{--                                <div class="input-field mt-0">--}}
{{--                                    <small>Label</small>--}}
{{--                                    <select class="browser-default">--}}
{{--                                        <option class="blue-text">Blue</option>--}}
{{--                                        <option class="red-text">Red</option>--}}
{{--                                        <option class="green-text">Green</option>--}}
{{--                                        <option class="cyan-text">Cyan</option>--}}
{{--                                        <option class="orange-text">Orange </option>--}}
{{--                                        <option class="blue-grey-text">Blue-grey</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col s6">--}}
{{--                                <div class="input-field mt-0">--}}
{{--                                    <small>Member</small>--}}
{{--                                    <div class="display-flex">--}}
{{--                                        <div class="avatar ">--}}
{{--                                            <img src="{{asset('images/avatar/avatar-11.png')}}" class="circle" height="36" width="36"--}}
{{--                                                 alt="avtar img holder">--}}
{{--                                        </div>--}}
{{--                                        <a class="btn-floating btn-small pulse ml-10">--}}
{{--                                            <i class="material-icons">add</i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="file-field input-field">--}}
{{--                            <div class="btn btn-file">--}}
{{--                                <span>File</span>--}}
{{--                                <input type="file">--}}
{{--                            </div>--}}
{{--                            <div class="file-path-wrapper">--}}
{{--                                <input class="file-path validate" type="text">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Compose mail Quill editor -->--}}
{{--                        <div class="input-field">--}}
{{--                            <span>Comment</span>--}}
{{--                            <div class="snow-container mt-2">--}}
{{--                                <div class="compose-editor"></div>--}}
{{--                                <div class="compose-quill-toolbar">--}}
{{--                <span class="ql-formats mr-0">--}}
{{--                  <button class="ql-bold"></button>--}}
{{--                  <button class="ql-italic"></button>--}}
{{--                  <button class="ql-underline"></button>--}}
{{--                  <button class="ql-link"></button>--}}
{{--                  <button class="ql-image"></button>--}}
{{--                  <button class="btn btn-small cyan btn-comment waves-effect waves-light ml-25">Comment</button>--}}
{{--                </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                    <div class="card-action pl-0 pr-0">--}}
{{--                        <button type="reset" class="btn-small waves-effect waves-light delete-kanban-item mr-1">--}}
{{--                            <span>Delete</span>--}}
{{--                        </button>--}}
{{--                        <button class="btn-small blue waves-effect waves-light update-kanban-item">--}}
{{--                            <span>Save</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <!-- form start end-->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
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
