{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Чат')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css"
      href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-chat.css') }}">
  <style>
      .status-circle {
          width: 12px;
          height: 12px;
          position: absolute;
          bottom: 4px;
          left: 44px;
          border: 2px solid #fff;
          -webkit-border-radius: 50%;
          -moz-border-radius: 50%;
          border-radius: 50%;
      }

      .status-circle.away {
          background-color: #f8d62b
      }

      .status-circle.online {
          background-color: #51bb25
      }

      .status-circle.offline {
          background-color: #dc3545
      }

      .message {
          color: #101010 !important;
      }

      .chat-del-link {

          margin-top: -10px;
      }

      .chat-del-link-btn {
          background: none;
          border: none !important;
          outline: none !important;
          font-size: 12px;
          color: #8c8c8c;
      }

      .chat-del-link-btn:focus {
          background: none !important;
          color: #8c8c8c !important;
      }

      .chat-del-link {
          margin-left: 1.5rem;
      }

      .chat-right .chat-del-link {
          margin-right: 1.5rem !important;
      }
  </style>
@endsection

{{-- page content --}}
@section('content')

  <div class="chat-application">
    <div class="chat-content-head">
      <div class="header-details">
        <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mail_outline</i> @if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name='Chat' contenteditable="true">{{ __('Chat') }}</editor_block>
          @else
            {{ __('Chat') }}
            @endif</h5>
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
              <!-- Sidebar Area -->
              <div class="sidebar-left sidebar-fixed animate fadeUp animation-fast">
                <div class="sidebar animate fadeUp">
                  <div class="sidebar-content">
                    <div id="sidebar-list" class="sidebar-menu chat-sidebar list-group position-relative">
                      <div class="sidebar-list-padding app-sidebar" id="chat-sidenav">
                        <!-- Sidebar Header -->
                        <div class="sidebar-header">
                          <div class="row valign-wrapper width-100">
                            <div class="col s2 media-image pr-0">
                              <img src="{{ auth()->user()->avatar ? route('user.get.avatar', auth()->user()->id) :  asset('images/user.png') }}" alt="" class="circle z-depth-2 responsive-img" style=" width: 36px; height: 36px;">
                            </div>
                            <div class="col s10 pl-2">
                              <p class="m-0 blue-grey-text text-darken-4 font-weight-700">{{ auth()->user()->name }}</p>
                              <p class="m-0 info-text">{{ auth()->user()->login }}</p>
                            </div>
                          </div>
                        </div>
                        <!--/ Sidebar Header -->

                        <!-- Sidebar Content List -->
                        <div class="sidebar-content sidebar-chat ps ps--active-y">
                          <div class="chat-list chat-user-list">
                            <a href="{{ route('chat') }}" class="chat-user animate fadeUp delay-1 @if(!$chat) active @endif">
                              <div class="user-section">
                                <div class="row valign-wrapper">
                                  <div class="col s3 media-image online pr-0">
                                    <img src="{{ asset('images/chat.jpg') }}" alt="" class="circle z-depth-2 responsive-img" style="height: 40px;width: 40px;">
                                  </div>
                                  <div class="col s9 pl-0">
                                    <p class="m-0 blue-grey-text text-darken-4 font-weight-700">@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='General chat' contenteditable="true">{{ __('General chat') }}</editor_block>
                                      @else
                                        {{ __('General chat') }}
                                      @endif</p>
                                    <p class="m-0 info-text">@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Users in chat' contenteditable="true">{{ __('Users in chat') }}</editor_block>
                                      @else
                                        {{ __('Users in chat') }}
                                      @endif:
                                      <span class="chat_total_user_count">1</span>
                                    </p>
                                  </div>
                                </div>
                              </div>
                              <div class="info-section">
                                <div class="star-timing">
                                </div>
                                <span class="badge badge  red @if(auth()->user()->getUnreadCommonChatMessagesCount() > 0) @else display-none @endif" style="border-radius: 25px">
                                  {{ auth()->user()->getUnreadCommonChatMessagesCount() > 0 ? '+' .  auth()->user()->getUnreadCommonChatMessagesCount() : '' }}
                                </span>
                              </div>
                            </a>
                            @if(!empty($users))
                              @foreach($users as $user)
                                <a href="{{ route('chat', $user->getChatId()) }}" class="chat-user animate fadeUp delay-1 @if($companion && $companion->id == $user->id) active @endif">
                                  <div class="user-section">
                                    <div class="row valign-wrapper">
                                      <div class="col s3 media-image online pr-0 " style="position:relative;">
                                        <img src="{{ $user->avatar ? route('user.get.avatar', $user->id) : asset('images/user.png') }}" alt="" class="circle z-depth-2 responsive-img" style="height: 40px;width: 40px;">
                                        <div class="status-circle {{ $user->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}"></div>
                                      </div>
                                      <div class="col s9 pl-0 pr-0">
                                        <p class="m-0 blue-grey-text text-darken-4 font-weight-700">{{ $user->login ?? '' }}</p>
                                        <p class="m-0 info-text">@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Last seen' contenteditable="true">{{ __('Last seen') }}</editor_block>
                                          @else
                                            {{ __('Last seen') }}
                                            @endif: {{ $user->getLastActivityAttribute()['last_seen'] }}</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="info-section" data-id="{{ $user->id }}">
                                    <div class="star-timing">
                                      <div class="time">
                                        <span class="user user-chat-status badge blue darken-1 display-none" data-id="{{ $user->id }}"></span>
                                      </div>
                                    </div>
                                    <span class="badge badge  red @if($user->getUnreadChatMessagesCount($user->getChatId()) > 0) @else display-none @endif" style="border-radius: 25px">
                                  {{ $user->getUnreadChatMessagesCount($user->getChatId()) > 0 ? '+' .  $user->getUnreadChatMessagesCount($user->getChatId()) : '' }}
                                </span>
                                  </div>
                                </a>
                              @endforeach
                            @endif

                          </div>
                          <div class="no-data-found">
                            <h6 class="center">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='No Results Found' contenteditable="true">{{ __('No Results Found') }}</editor_block>
                              @else
                                {{ __('No Results Found') }}
                                @endif</h6>
                          </div>
                        </div>
                        <!--/ Sidebar Content List -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Sidebar Area -->

              <!-- Content Area -->
              <div class="chat-content-area animate fadeUp">
                <!-- Chat header -->
                <div class="chat-header">
                  <div class="row valign-wrapper">
                    @if($chat)
                      <div class="col media-image online pr-0" style="position:relative;">
                        <img src="{{ $companion->avatar ? route('user.get.avatar', $companion->id) : asset('images/user.png') }}" alt="" class="circle z-depth-2 responsive-img" style="width:48px; height:48px">
                        <div class="status-circle {{ $user->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}"></div>
                      </div>
                      <div class="col">
                        <p class="m-0 blue-grey-text text-darken-4 font-weight-700">{{ $companion->name ?? '' }} ({{ $companion->login ?? '' }})</p>
                        <p class="m-0 chat-text truncate">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Last seen' contenteditable="true">{{ __('Last seen') }}</editor_block>
                          @else
                            {{ __('Last seen') }}
                            @endif: {{ $user->getLastActivityAttribute()['last_seen'] }}</p>
                      </div>
                    @else
                      <div class="col media-image online pr-0">
                        <img src="{{ asset('images/chat.jpg') }}" alt="" class="circle z-depth-2 responsive-img">
                      </div>
                      <div class="col">
                        <p class="m-0 blue-grey-text text-darken-4 font-weight-700">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='General chat' contenteditable="true">{{ __('General chat') }}</editor_block>
                          @else
                            {{ __('General chat') }}
                          @endif</p>
                        <p class="m-0 chat-text truncate">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Users in chat' contenteditable="true">{{ __('Users in chat') }}</editor_block>
                          @else
                            {{ __('Users in chat') }}
                          @endif:
                          <span class="chat_total_user_count">1</span>
                        </p>
                      </div>
                    @endif
                  </div>
                </div>
                <!--/ Chat header -->

                <!-- Chat content area -->
                <div class="chat-area ps ps--active-y">
                  <div class="chats">
                    <div class="chats chat-wrapper">
                      @if(!empty($messages))
                        @foreach($messages as $message)
                          @if($message->user_id == auth()->user()->id)
                            <div class="chat chat-right" data-id="{{ $message->id }}">
                              <div class="chat-avatar">
                                <a class="avatar">
                                  <img src="{{ $myAvatar }}" class="circle" alt="avatar">
                                </a>
                              </div>
                              <div class="chat-body">
                                <div class="chat-text">
                                  <p>{{ $message->message }}</p>
                                </div>
                                <div class="chat-del-link">
                                  <button class="chat-del-link-btn" data-id="{{ $message->id }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Delete' contenteditable="true">{{ __('Delete') }}</editor_block>
                                    @else
                                      {{ __('Delete') }}
                                    @endif</button>
                                </div>
                              </div>
                            </div>
                          @else
                            <div class="chat" data-id="{{ $message->id }}">
                              <div class="chat-avatar">
                                <a class="avatar">
                                  <img src="{{ $message->user->avatar ? route('user.get.avatar', $message->user->id) : asset('images/user.png') }}" class="circle" alt="avatar">
                                </a>
                              </div>
                              <div class="chat-body">
                                <div class="chat-text">
                                  <p>{{ $message->message }}</p>
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      @endif

                    </div>
                  </div>

                </div>
                <!--/ Chat content area -->

                <!-- Chat footer <-->
                <div class="chat-footer">
                  <form onsubmit="enter_chat();" action="javascript:void(0);" class="chat-input">
                    <input id="message-to-send" type="text" placeholder="Type message here.." class="message mb-0">
                    <button class="btn waves-effect waves-light send chat-message-send-btn disabled" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Send' contenteditable="true">{{ __('Send') }}</editor_block>
                      @else
                        {{ __('Send') }}
                        @endif</button>
                  </form>
                </div>
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

@endsection

{{-- page scripts --}}
@section('page-script')
  <script src="{{ asset('js/scripts/app-chat.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    $(document).ready(function () {
      function scrollChat() {
        var container = $('.chat-area'),
            scrollTo = $('.chat-area > .chats');
        container.scrollTop(scrollTo.prop('scrollHeight'));
      }

      scrollChat();

      var users_count;

      Pusher.logToConsole = true;
      @if($chat)
      Echo.join('chat.{{ $chat->id }}')
      .here((users) => {
        $(".chat-message-send-btn").removeClass('disabled');
      })
      .joining((user) => {

      })
      .leaving((user) => {

      })
      .listen('AdminChat', function ($data) {
        console.log($data);
        if ($data.type == 'delete') {
          console.log('delete');
          $(".chat[data-id='"+ $data.message_id+"']").remove();
        }
        if ($data.type == 'message') {
          var $message_id = $data.message_id;

          if (!($data.user_id == "{{ auth()->user()->id }}")) {
            var $options = {
              method: "post",
              url: "{{ route('chat.read.message') }}",
              data: {
                user_id: "{{ auth()->user()->id }}",
                message_id: $message_id,
              }
            }
            window.axios($options);
          }

          $(".chat-message-send-btn").removeClass('disabled');
          if ($data.chat_id == "{{ $chat->id }}" && $data.user == "{{ auth()->user()->id }}") {
            $(".chat-wrapper").append('<div class="chat chat-right" data-id="' + $data.message_id + '">' +
                '<div class="chat-avatar">' +
                ' <a class="avatar">' +
                '<img src="{{ $myAvatar }}" class="circle" alt="avatar">' +
                '</a>' +
                '</div>' +
                '<div class="chat-body">' +
                ' <div class="chat-text">' +
                ' <p> ' + $data.message + '</p>' +
                '</div>' +
                '  <div class="chat-del-link">' +
                '<button class="chat-del-link-btn" data-id="' + $data.message_id + '">Удалить</button>' +
                '  </div>' +
                ' </div>' +
                ' </div>');
          } else {
            $(".chat-wrapper").append('<div class="chat">' +
                '<div class="chat-avatar">' +
                ' <a class="avatar">' +
                '<img src="{{ $companion->avatar ? route('user.get.avatar',$companion->id) : asset('images/user.png') }} " class="circle" alt="avatar">' +
                '</a>' +
                '</div>' +
                '<div class="chat-body">' +
                ' <div class="chat-text">' +
                ' <p>' + $data.message + '</p>' +
                '</div>' +
                ' </div>' +
                ' </div>');
          }
          scrollChat();
        }
      });
      @endif

      Echo.join('chat')
      .here((users) => {
        $(".chat-message-send-btn").removeClass('disabled');
        users_count = users.length;
        $(".chat_total_user_count").text(users_count);
        users.forEach(function (user) {
          $(".user-chat-status[data-id='" + user.id + "']").removeClass('display-none').text('in chat');
        });
      })
      .joining((user) => {
        var $my_id = '{{ auth()->user()->id }}';
        users_count += 1;
        console.log(user);
        $(".chat_total_user_count").text(users_count);
        $(".user-chat-status[data-id='" + user.id + "']").removeClass('display-none').text('in chat');
      })
      .leaving((user) => {
        $(".chat-user-list").find('.chat-user[data-id="' + user.id + '"]').remove();
        users_count -= 1;
        $(".chat_total_user_count").text(users_count);
        $(".user-chat-status[data-id='" + user.id + "']").addClass('display-none').text('');
      })
      .listen('AdminCommonChat', function ($data) {
        @if(!$chat)
        if ($data.type == 'delete') {
          $(".chat[data-id='"+ $data.message_id+"']").remove();
        }
        if ($data.type == 'message') {
          var $message_id = $data.message_id;

          if (!($data.user_id == "{{ auth()->user()->id }}")) {
            var $options = {
              method: "post",
              url: "{{ route('chat.common.read.message') }}",
              data: {
                user_id: "{{ auth()->user()->id }}",
                message_id: $message_id,
              }
            }
            window.axios($options);
          }


          $(".chat-message-send-btn").removeClass('disabled');

          if ($data.user_id == "{{ auth()->user()->id }}") {
            $(".chat-wrapper").append('<div class="chat chat-right" data-id="' + $data.message_id + '">' +
                '<div class="chat-avatar">' +
                ' <a class="avatar">' +
                '<img src="{{ $myAvatar }}" class="circle" alt="avatar">' +
                '</a>' +
                '</div>' +
                '<div class="chat-body">' +
                ' <div class="chat-text">' +
                ' <p> ' + $data.message + '</p>' +
                '</div>' +
                '  <div class="chat-del-link">' +
                '<button class="chat-del-link-btn" data-id="' + $data.message_id + '">{{ __('Delete') }}</button>' +
                '  </div>' +
                ' </div>' +
                ' </div>');
          } else {
            $(".chat-wrapper").append('<div class="chat" data-id="' + $data.message_id + '">' +
                '<div class="chat-avatar">' +
                ' <a class="avatar">' +
                '<img src="' + $data.avatar + '" class="circle" alt="avatar">' +
                '</a>' +
                '</div>' +
                '<div class="chat-body">' +
                ' <div class="chat-text">' +
                ' <p>' + $data.message + '</p>' +
                '</div>' +
                ' </div>' +
                ' </div>');
          }
          scrollChat();
        }
        @endif
      });
      $("body").on('click', ".chat-del-link-btn", function (e) {
        e.preventDefault();
        var $id = $(this).attr('data-id');
        if ($id) {
          @if($chat)
          var $options = {
            method: "post",
            url: "{{ route('chat.delete.message') }}",
            data: {
              id: $id,
              user_id: "{{ auth()->user()->id }}",
              type: "delete",
            }
          }
          window.axios($options);
          @else
          var $options = {
            method: "post",
            url: "{{ route('chat.common.delete.message') }}",
            data: {
              id: $id,
              user_id: "{{ auth()->user()->id }}",
              type: "delete",
            }
          }
          window.axios($options);
          @endif
        }
      });
      $(".chat-message-send-btn").on('click', function (e) {
            e.preventDefault();
            if (!$(".chat-message-send-btn").hasClass('disabled')) {
              var $message = $("#message-to-send").val();
              if ($message.length > 0) {
                @if($chat)
                var $options = {
                  method: "post",
                  url: "{{ route('chat.send.message') }}",
                  data: {
                    user_id: "{{ auth()->user()->id }}",
                    message: $message,
                    chat_id: "{{ $chat->id }}",
                    type: "message",
                  }
                }
                @else
                var $options = {
                  method: "post",
                  url: "{{ route('chat.common.send.message') }}",
                  data: {
                    user_id: "{{ auth()->user()->id }}",
                    message: $message,
                    type: "message",
                  }
                }
                @endif
                $(this).addClass('disabled');
                window.axios($options);
              }
              $("#message-to-send").val('');
            }
          }
      );
    });
  </script>
@endsection
