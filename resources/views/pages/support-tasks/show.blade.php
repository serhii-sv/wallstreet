{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Задача ' . $supportTask->title)
{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-chat.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <div class="chat-application">
        <div class="chat-content-head">
            <div class="header-details">
                <h5 class="m-0 sidebar-title"> {{ 'Задача ' . $supportTask->title }}</h5>
            </div>
        </div>
        <div class="app-chat">
            <div class="content-area content-right">
                <div class="app-wrapper">
                    <!-- Sidebar menu for small screen -->
                    <a href="#" data-target="chat-sidenav" class="sidenav-trigger hide-on-large-only">
                        <i class="material-icons">menu</i>
                    </a>
                    <!--/ Sidebar menu for small screen -->

                    <div class="card card card-default scrollspy border-radius-6 fixed-width">
                        <div class="card-content chat-content p-0">
                            <!-- Content Area -->
                            <div class="chat-content-area animate fadeUp">
                                <!-- Chat header -->
                                <div class="chat-header display-flex" style="justify-content: flex-end !important;">
                                    <div class="float-right">
                                        <a class="btn btn-small" href="{{ route('support-tasks.close', $supportTask->id) }}"> Закрыть задачу</a>
                                    </div>
                                </div>
                                <!--/ Chat header -->

                                <!-- Chat content area -->
                                <div class="chat-area">
                                    <div class="chats">
                                        <div class="chats">
                                            @forelse($supportTask->messages as $message)
                                                @if($message->user_id == auth()->user()->id)
                                            <div class="chat chat-right">
                                                <div class="chat-avatar">
                                                    <a class="avatar">
                                                        {{ $message->created_at->format('d-m-Y H:i') }}
{{--                                                        <img src="{{asset('images/user/12.jpg')}}" class="circle" alt="avatar" />--}}
                                                    </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-text">
                                                        <p>{{ $message->message }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                                @else
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <a class="avatar">
                                                                {{ $message->user->email }} ({{ $message->user->login }})
                                                                <br>
                                                                {{ $message->created_at->format('d-m-Y H:i') }}
{{--                                                                <img src="{{asset('images/user/7.jpg')}}" class="circle" alt="avatar" />--}}
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-text">
                                                                <p>{{ $message->message }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                                                    Ответьте пользователю на запрос
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <!--/ Chat content area -->

                                <!-- Chat footer <-->
                                @if($supportTask->status !== \App\Models\SupportTask::CLOSED_STATUS)
                                    <div class="chat-footer">
                                        <form action="{{ route('support-tasks.messages.store', $supportTask->id) }}" method="post" class="chat-input">
                                            @csrf
                                            <input type="text" name="message" value="{{ old('message') }}" placeholder="Type message here.." class="message mb-0">
                                            <button class="btn waves-effect waves-light send">Отправить</button>
                                        </form>
                                        <div class="mt-2">
                                            @include('panels.inform')
                                        </div>
                                    </div>
                                @endif
                                <!--/ Chat footer -->
                            </div>
                            <!--/ Content Area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
    <script src="{{asset('js/scripts/support-messages.js')}}"></script>
@endsection
