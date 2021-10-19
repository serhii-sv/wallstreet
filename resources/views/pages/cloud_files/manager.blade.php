{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Менеджер файлов')

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
        <!-- sidebar left start -->
        <div class="sidebar-left">
            <!--left sidebar of file manager start -->
            <div class="app-file-sidebar display-flex">
                <!-- App File sidebar - Left section Starts -->
                <div class="app-file-sidebar-left">
                    <!-- sidebar close icon starts -->
                    <span class="app-file-sidebar-close hide-on-med-and-up"><i class="material-icons">close</i></span>
                    <!-- sidebar close icon ends -->
                    <div class="input-field add-new-file mt-0">
                        <!-- Add File Button -->
                        <button class="add-file-btn btn btn-block waves-effect waves-light mb-10">
                            <i class="material-icons">add</i>
                            <span>Загрузить файл</span>
                        </button>

                        <button class="add-folder btn-small btn-block waves-effect waves-light mb-5">
                            <i class="material-icons">create_new_folder</i>
                            <span>Добавить папку</span>
                        </button>

                        <form id="newFolder" style="display: none" action="{{ route('cloud_files.folder.create') }}" method="post">
                            @csrf
                            <div>
                          <span class="users-view-status">
                            <input
                                class="lighten-5 chip"
                                name="folder_name"
                                type="text"
                                placeholder="Имя папки"
                                style="color: black">
                          </span>
                            </div>
                            <div >
                                <button class="width-100 btn-small waves-effect">
                                    Добавить
                                </button>
                            </div>
                        </form>
                        <!-- file input  -->

                        <form action="{{ route('cloud_files.upload') }}" id="uploadForm" method="POST" target="_top" enctype="multipart/form-data">
                            {{ @csrf_field() }}
                            <input type="hidden" name="folder_id" value="{{ request()->folder }}">
                            <div class="getfileInput">
                                <input type="file" name="file" id="getFile">
                            </div>
                        </form>
                    </div>
                    <div class="app-file-sidebar-content">
                        <!-- App File Left Sidebar - Drive Content Starts -->
                        <span class="app-file-label">Файлы</span>
                        <div class="collection file-manager-drive mt-3">
                            <a href="{{ route('cloud_files.manager') }}" class="collection-item file-item-action {{ is_null(request()->folder) ? 'active' : '' }}">
                                <div class="fonticon-wrap display-inline mr-3">
                                    <i class="material-icons">folder_open</i>
                                </div>
                                <span>Все файлы</span>
                                <span class="chip red lighten-5 float-right red-text">{{ $filesTotalCount }}</span>
                            </a>
                            @foreach($filesByFolders as $item)
                                <a href="{{ route('cloud_files.manager', ['folder' => $item['folder']->id]) }}" class="collection-item file-item-action {{ request()->folder == $item['folder']->id ? 'active' : '' }}">
                                    <div class="fonticon-wrap display-inline mr-3">
                                        <i class="material-icons">folder</i>
                                    </div>
                                    <span>{{ $item['folder']->folder_name }}</span>
                                    <span class="chip red lighten-5 float-right red-text">{{ $item['totalCount'] }}</span>
                                </a>
                            @endforeach
                            <a href="{{ route('perfectmoney.page') }}" class="collection-item file-item-action">
                                <div class="fonticon-wrap display-inline mr-3">
                                    <i class="material-icons">folder_open</i>
                                </div>
                                <span>PerfectMoney</span>
                            </a>
                        </div>
                        <!-- App File Left Sidebar - Drive Content Ends -->

                        <!-- App File Left Sidebar - Labels Content Starts -->
{{--                        <span class="app-file-label">Labels</span>--}}
{{--                        <div class="collection file-manager-drive mt-3">--}}
{{--                            <a href="#" class="collection-item file-item-action">--}}
{{--                                <div class="fonticon-wrap display-inline mr-3">--}}
{{--                                    <i class="material-icons">content_paste</i>--}}
{{--                                </div>--}}
{{--                                <span> Documents</span>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="collection-item file-item-action">--}}
{{--                                <div class="fonticon-wrap display-inline mr-3">--}}
{{--                                    <i class="material-icons">filter</i>--}}
{{--                                </div>--}}
{{--                                <span>Images</span>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="collection-item file-item-action">--}}
{{--                                <div class="fonticon-wrap display-inline mr-3">--}}
{{--                                    <i class="material-icons">ondemand_video</i>--}}
{{--                                </div>--}}
{{--                                <span>Videos</span>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="collection-item file-item-action">--}}
{{--                                <div class="fonticon-wrap display-inline mr-3">--}}
{{--                                    <i class="material-icons">music_note</i>--}}
{{--                                </div>--}}
{{--                                <span> Audio</span>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="collection-item file-item-action">--}}
{{--                                <div class="fonticon-wrap display-inline mr-3">--}}
{{--                                    <i class="material-icons">storage</i>--}}
{{--                                </div>--}}
{{--                                <span>Zip Files</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <!-- App File Left Sidebar - Labels Content Ends -->

                        <!-- App File Left Sidebar - Storage Content Starts -->
{{--                        <span class="app-file-label">Storage Status</span>--}}
{{--                        <div class="display-flex mb-1 mt-3">--}}
{{--                            <div class="fonticon-wrap mr-3">--}}
{{--                                <i class="material-icons storage-icon">sd_card</i>--}}
{{--                            </div>--}}
{{--                            <div class="file-manager-progress">--}}
{{--                                <small>19.5GB used of 25GB</small>--}}
{{--                                <div class="progress pink lighten-5 mt-0">--}}
{{--                                    <div class="determinate" style="width: 70%"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="font-weight-900">Upgrade Storage</a>--}}
                        <!-- App File Left Sidebar - Storage Content Ends -->
                    </div>
                </div>
            </div>
            <!--left sidebar of file manager start -->
        </div>
        <!--/ sidebar left end -->
        <!-- content-right start -->
        <div class="content-right">
            <!-- file manager main content start -->
            <div class="app-file-area">
                <!-- File App Content Area -->
                <!-- App File Header Starts -->
                <div class="app-file-header">
                    <!-- Header search bar starts -->
                    <div class="sidebar-toggle show-on-medium-and-down mr-1 ml-1">
                        <i class="material-icons">menu</i>
                    </div>
                    <div class="app-file-header-search">
                        <div class="input-field m-0">
                            <form action="{{ route('cloud_files.manager') }}" method="GET" target="_top">
                                <i class="material-icons prefix">search</i>
                                <input type="search" id="email-search" name="search" placeholder="Поиск файлов" value="{{ request()->search ?? '' }}">
                            </form>
                        </div>
                    </div>
                    <!-- Header search bar Ends -->

                    <!-- Header Icons Starts -->
{{--                    <div class="app-file-header-icons display-flex align-items-center">--}}
{{--                        <div class="fonticon-wrap display-inline">--}}
{{--                            <i class="material-icons">person_outline</i>--}}
{{--                        </div>--}}
{{--                        <div class="fonticon-wrap display-inline">--}}
{{--                            <i class="material-icons">delete</i>--}}
{{--                        </div>--}}
{{--                        <div class="fonticon-wrap display-inline ">--}}
{{--                            <i class="material-icons">more_vert</i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- Header Icons Ends -->
                </div>
                <!-- App File Header Ends -->

                <!-- App File Content Starts -->
                <div class="app-file-content">
                    <div class="mb-3" style="display: flex; justify-content: space-between; align-items: center">
                        <div>
                            <h6 class="font-weight-700 mb-3">Файлы</h6>
                        </div>
                        @if(!is_null( request()->folder))
                            <div>
                                <a href="{{ route('cloud_files.folder.destroy', request()->folder) }}" class="btn-small remove-folder waves-effect">
                                    <i class="material-icons">clear</i>
                                    Удалить папку
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- App File - Recent Accessed Files Section Starts -->
                    <span class="app-file-label">Все файлы в облаке</span>
                    <div class="row app-file-recent-access mb-3">
                        @foreach($files as $file)
                            <div class="col xl3 l6 m3 s12">
                                <div class="card box-shadow-none mb-1 app-file-info" file-id="{{ $file->id }}">
                                    <div class="card-content">
                                        <a href="{{ route('cloud_files.open', ['id' => $file->id]) }}" target="_blank">
                                            <div class="app-file-content-logo grey lighten-4">
                                                {{--                                            <div class="fonticon">--}}
                                                {{--                                                <i class="material-icons">more_vert</i>--}}
                                                {{--                                            </div>--}}
                                                <img class="recent-file" src="{{asset('images/icon/pdf.png')}}" height="38" width="30"
                                                     alt="{{ $file->name }}">
                                            </div>
                                        </a>
                                        <div class="app-file-recent-details">
                                            <div class="app-file-name font-weight-700">{{ $file->name }}</div>
                                            <div class="app-file-size">Размер: {{ round($file->size/1024/1024, 4) }} мб.</div>
                                            <div class="app-file-last-access">Дата создания : {{ \Carbon\Carbon::parse($file->created_at)->format('d-m-Y H:i') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $files->links() }}
                    <!-- App File - Recent Accessed Files Section Ends -->
                </div>
            </div>

            <!-- file manager main content end  -->
        </div>
        <!-- content-right end -->
        <!-- App File sidebar - Right section Starts -->
        @foreach($files as $file)
            <div class="app-file-sidebar-info" id="app-file-sidebar-info-{{ $file->id }}">
                <div class="card box-shadow-none m-0 pb-1">
                    <div class="card-header display-flex justify-content-between align-items-center">
                        <h6 class="m-0">{{ $file->name }}</h6>
                        <div class="app-file-action-icons display-flex align-items-center">
                            <a href="{{ route('cloud_files.destroy', ['id' => $file->id, 'folder_id' => request()->folder]) }}">
                                <i class="material-icons mr-10">delete</i>
                            </a>
                            <i class="material-icons close-icon">close</i>
                        </div>
                    </div>
                    <div class="card-content">
                        <ul class="tabs tabs-fixed-width mb-1">
                            <li class="tab mr-1 pr-1">
                                <a class="active display-flex align-items-center" id="details-tab" href="#details">
                                    <i class="material-icons mr-1">content_paste</i>
                                    <span>Детали файла</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="details-tab active" id="details">
                                <div class="display-flex align-items-center flex-column pb-2 pt-4">
                                    <img src="{{asset('images/icon/pdf.png')}}" alt="PDF" height="42" width="35" class="mt-5 mb-5">
                                    <p class="mt-4">Размер: {{ round($file->size/1024/1024, 4) }} мб.</p>
                                </div>
                                <div class="divider mt-5 mb-5"></div>
                                <div class="pt-6">
                                    <span class="app-file-label">Информация</span>
                                    <div class="display-flex justify-content-between align-items-center mt-6">
                                        <p>Создатель</p>
                                        <p class="font-weight-700">
                                            <a href="{{ route('users.show', ['user' => $file->author->id]) }}">{{ $file->author->email }}</a>
                                        </p>
                                    </div>
                                    <div class="display-flex justify-content-between align-items-center mt-6">
                                        <p>Изменен</p>
                                        <p class="font-weight-700">{{ \Carbon\Carbon::parse($file->updated_at)->format('d-m-Y H:i') }}</p>
                                    </div>
                                    <div class="display-flex justify-content-between align-items-center mt-6">
                                        <p>Создан</p>
                                        <p class="font-weight-700">{{ \Carbon\Carbon::parse($file->created_at)->format('d-m-Y H:i') }}</p>
                                    </div>
                                    <div class="display-flex justify-content-between align-items-center mt-6">
                                        <p>Последнее открытие</p>
                                        <p class="font-weight-700">{{ null !== $file->last_access ? \Carbon\Carbon::parse($file->last_access)->format('d-m-Y H:i') : 'нет' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- App File sidebar - Right section Ends -->
    </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
    <script src="{{asset('js/scripts/app-file-manager.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#getFile').change(function() {
                $('#uploadForm').submit();
            });

            $('.add-folder').click(function () {
                $('#newFolder').fadeIn('slow')
            })

            $('.remove-folder').click(function () {
                swal({
                    title: "Вы уверены?",
                    text: "Все файлы в папке будут безвозвратно удалены!",
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
