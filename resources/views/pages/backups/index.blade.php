{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Резервные копии')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-file-manager.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/widget-timeline.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <div class="section app-file-manager-wrapper" style="min-height: 800px;">
        <!-- File Manager app overlay -->
        <div class="app-file-overlay"></div>
        <!-- /File Manager app overlay -->
        <!--/ sidebar left end -->
        <!-- content-right start -->
        <div class="content-right float-left" style="width: 100%">
            <!-- file manager main content start -->
            <div class="app-file-area">

                <!-- App File Content Starts -->
                <div class="app-file-content">
                    <div class="mb-3" style="display: flex; justify-content: space-between; align-items: center; width: 100%">
                            <div>
                                <h6 class="font-weight-700 mb-3">Резервные копии</h6>
                            </div>
                            <div>
                                <a href="{{ route('backup.backupDB') }}" class="btn btn-small">Создать резервную копию</a>
                            </div>
                    </div>

                    <!-- App File - Recent Accessed Files Section Starts -->
                    <span class="app-file-label">Все резервные копии</span>
                    <div class="row app-file-recent-access mb-3">
                        @foreach($backups as $backup)
                            <div class="col xl3 l6 m3 s12">
                                <div class="card box-shadow-none mb-1 app-file-info" file-id="{{ $backup->id }}">
                                    <div class="card-content">
                                        <a href="{{ route('backup.download', ['id' => $backup->id]) }}" target="_blank">
                                            <div class="app-file-content-logo grey lighten-4">
                                                {{--                                            <div class="fonticon">--}}
                                                {{--                                                <i class="material-icons">more_vert</i>--}}
                                                {{--                                            </div>--}}
                                                <img class="recent-file" src="{{asset('images/icon/backup.png')}}" height="38"
                                                     alt="{{ last(explode('/', $backup->path)) }}">
                                            </div>
                                        </a>
                                        <div class="app-file-recent-details">
                                            <div class="app-file-name font-weight-700">{{ last(explode('/', $backup->path)) }}</div>
                                            <div class="app-file-size">Размер: {{ \App\Models\Backup::formatBytes($backup->size) }} </div>
                                            <div class="app-file-last-access">Дата создания : {{ \Carbon\Carbon::parse($backup->created_at)->format('d-m-Y H:i') }}</div>
                                            <div class="display-flex justify-content-center align-items-center">
                                                <a href="{{ route('backup.destroy', $backup) }}" class="btn btn-small mt-5 delete">Удалить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- App File - Recent Accessed Files Section Ends -->
                </div>
            </div>

            <!-- file manager main content end  -->
        </div>
        <!-- content-right end -->
        <!-- App File sidebar - Right section Ends -->
    </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')

    <script>
        $(document).ready(function(){
            $('.delete').click(function () {
                swal({
                    title: "Вы уверены?",
                    text: "Резервная копия будет безвозвратно удалена!",
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: "Отменить",
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Подтвердить",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: true
                        }
                    }
                }).then((result) => {
                    if (result) {
                        location.href = $(this).attr('href')
                    }
                })
                return false;
            })
        });
    </script>
@endsection
