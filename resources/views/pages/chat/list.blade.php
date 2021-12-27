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
        <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mail_outline</i> Chat</h5>
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
                              <img src="{{ auth()->user()->avatar ? route('user.get.avatar', auth()->user()->id) :  asset('images/avatar/user.svg') }}" alt="" class="circle z-depth-2 responsive-img" style=" width: 36px; height: 36px;">
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

                            @if(!empty($chat_list))
                              @foreach($chat_list as $chat_el)
                                <a href="{{ route('chat', $chat_el->id) }}" class="chat-user animate fadeUp delay-1 @if($chat_id && $chat_id == $chat_el->id) active @endif">
                                  <div class="user-section">
                                    <div class="row valign-wrapper">
                                      <div class="col s3 media-image online pr-0 " style="position:relative;">
                                        <img src="{{ $chat_el->userPartner()->first()->avatar ? route('user.get.avatar', $chat_el->userPartner()->first()->id) : asset('images/avatar/user.svg') }}" alt="" class="circle z-depth-2 responsive-img" style="height: 40px;width: 40px;">
                                        <div class="status-circle {{ $chat_el->userPartner()->first()->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}"></div>
                                      </div>
                                      <div class="col s9 pl-0 pr-0">
                                        <p class="m-0 blue-grey-text text-darken-4 font-weight-700">{{ $chat_el->userPartner()->first()->login ?? '' }}</p>
                                        <p class="m-0 info-text">Last seen: {{ $chat_el->userPartner()->first()->getLastActivityAttribute()['last_seen'] }}</p>
                                      </div>
                                    </div>
                                    <div class="row valign-wrapper">
                                      <div class="col s3 media-image online pr-0 " style="position:relative;">
                                        <img src="{{ $chat_el->userReferral()->first()->avatar ? route('user.get.avatar', $chat_el->userReferral()->first()->id) : asset('images/avatar/user.svg') }}" alt="" class="circle z-depth-2 responsive-img" style="height: 40px;width: 40px;">
                                        <div class="status-circle {{ $chat_el->userReferral()->first()->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}"></div>
                                      </div>
                                      <div class="col s9 pl-0 pr-0">
                                        <p class="m-0 blue-grey-text text-darken-4 font-weight-700">{{ $chat_el->userReferral()->first()->login ?? '' }}</p>
                                        <p class="m-0 info-text">Last seen: {{ $chat_el->userReferral()->first()->getLastActivityAttribute()['last_seen'] }}</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="info-section justify-content-center" data-id="{{ $chat_el->userPartner()->first()->id }}">

                                    {{--                                   <span class="badge badge  red " style="border-radius: 25px">--}}
                                    {{--                                  {{ $user->getUnreadChatMessagesCount($user->getChatId()) > 0 ? '+' .  $user->getUnreadChatMessagesCount($user->getChatId()) : '' }}--}}
                                    {{--                                </span>--}}
                                  </div>
                                </a>
                              @endforeach
                            @endif

                          </div>
                          <div class="no-data-found">
                            <h6 class="center">No Results Found</h6>
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
                  <div class="row valign-wrapper justify-content-between" style="width: 100%;">
                    @if($chat)
                      <div class="col s6">
                        <div class="row">
                          <div class="col  media-image online pr-0" style="position:relative;">
                            <img src="{{ $chat->userPartner()->first()->avatar ? route('user.get.avatar', $chat->userPartner()->first()) : asset('images/avatar/user.svg') }}" alt="" class="circle z-depth-2 responsive-img" style="width:48px; height:48px">
                            <div class="status-circle {{ $chat->userPartner()->first()->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}"></div>
                          </div>
                          <div class="col ">
                            <p class="m-0 blue-grey-text text-darken-4 font-weight-700">{{ $chat->userPartner()->first()->name ?? '' }} ({{ $chat->userPartner()->first()->login ?? '' }})</p>
                            <p class="m-0 chat-text truncate">Last seen: {{ $chat->userPartner()->first()->getLastActivityAttribute()['last_seen'] }}</p>
                          </div>
                        </div>
                      </div>
                      <div class="col s6 ">
                        <div class="row display-flex justify-content-end">
                          <div class="col media-image online pr-0" style="position:relative;">
                            <img src="{{ $chat->userReferral()->first()->avatar ? route('user.get.avatar', $chat->userReferral()->first()) : asset('images/avatar/user.svg') }}" alt="" class="circle z-depth-2 responsive-img" style="width:48px; height:48px">
                            <div class="status-circle {{ $chat->userReferral()->first()->getLastActivityAttribute()['is_online'] ? 'online' : 'offline' }}"></div>
                          </div>
                          <div class="col">
                            <p class="m-0 blue-grey-text text-darken-4 font-weight-700">{{ $chat->userReferral()->first()->name ?? '' }} ({{ $chat->userReferral()->first()->login ?? '' }})</p>
                            <p class="m-0 chat-text truncate">Last seen: {{ $chat->userReferral()->first()->getLastActivityAttribute()['last_seen'] }}</p>
                          </div>
                        </div>
                      </div>
                    @else
                      <div class="col media-image online pr-0">
                        <img src="{{ asset('images/chat.jpg') }}" alt="" class="circle z-depth-2 responsive-img">
                      </div>
                      <div class="col">
                        <p class="m-0 blue-grey-text text-darken-4 font-weight-700">Выберите чат</p>
                      </div>
                    @endif
                  </div>
                </div>
                <!--/ Chat header -->

                <!-- Chat content area -->
                <div class="chat-area ps ps--active-y">
                  <div class="chats">
                    <div class="chats chat-wrapper">
                      @if(!empty($messages) && $chat)
                        @foreach($messages as $message)
                          @if($message->user_id == $chat->userPartner()->first()->id)
                            <div class="chat" data-id="{{ $message->id }}">
                              <div class="chat-avatar">
                                <a class="avatar">
                                  <img src="{{ $chat->userReferral()->first()->avatar ? route('user.get.avatar', $chat->userReferral()->first()->id) : asset('images/avatar/user.svg') }}" class="circle" alt="avatar">
                                </a>
                              </div>
                              <div class="chat-body">
                                <div class="chat-text">
                                  <p>{{ $message->message }}</p>
                                </div>
                              </div>
                            </div>
                          @else
                            <div class="chat chat-right" data-id="{{ $message->id }}">
                              <div class="chat-avatar">
                                <a class="avatar">
                                  <img src="{{ $chat->userPartner()->first()->avatar ? route('user.get.avatar', $chat->userPartner()->first()->id) : asset('images/avatar/user.svg') }}" class="circle" alt="avatar">
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
                    <input id="message-to-send" type="text" placeholder="Type message here.." class="message mb-0 disabled">
                    <button class="btn waves-effect waves-light send chat-message-send-btn disabled">Send</button>
                  </form>
                </div>
                <!--/ Chat footer -->
              </div>
              <!--/ Content Area -->
            </div>

          </div>
          <div class="pb-2">
            {{ $chat_list->links() }}
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
      window.Echo.private('chat.{{ $chat->id }}').listen('PrivateChat', (data) => {
        var $data = data;
        var $message_id = $data.message_id;


        if ($data.chat_id == "{{ $chat->id }}" && $data.user == "{{ $chat->userPartner()->first()->id }}") {
          $(".chat-wrapper").append('<div class="chat">' +
              '<div class="chat-avatar">' +
              ' <a class="avatar">' +
              '<img src="{{ $chat->userReferral()->first()->avatar ? route('user.get.avatar', $chat->userReferral()->first()->id) : asset('images/avatar/user.svg') }} " class="circle" alt="avatar">' +
              '</a>' +
              '</div>' +
              '<div class="chat-body">' +
              ' <div class="chat-text">' +
              ' <p>' + $data.message + '</p>' +
              '</div>' +
              ' </div>' +
              ' </div>');
        } else {
          $(".chat-wrapper").append('<div class="chat chat-right" data-id="' + $data.message_id + '">' +
              '<div class="chat-avatar">' +
              ' <a class="avatar">' +
              '<img src="{{ $chat->userPartner()->first()->avatar ? route('user.get.avatar', $chat->userPartner()->first()->id) : asset('images/avatar/user.svg') }}" class="circle" alt="avatar">' +
              '</a>' +
              '</div>' +
              '<div class="chat-body">' +
              ' <div class="chat-text">' +
              ' <p> ' + $data.message + '</p>' +
              '</div>' +
              ' </div>' +
              ' </div>');
        }

        {{--  $(".chat-msg-list").append('<li>' +--}}
        {{--      '<div class="message my-message mb-0">' +--}}
        {{--      '  <img class="rounded-circle float-start chat-user-img img-30" src="{{ $chat->user_partner()->first()->avatar ? route('user.get.avatar', $chat->user_partner()->first()->id) : asset('images/avatar/user.svg') }}" alt="">' +--}}
        {{--      '   <div class="message-data text-end">' +--}}
        {{--      '    <span class="message-data-time">' + $data.time + '</span>' +--}}
        {{--      '   </div>' +--}}
        {{--      $data.message +--}}
        {{--      '  </div>' +--}}
        {{--      '</li>');--}}
        {{--} else {--}}
        {{--  $(".chat-msg-list").append('<li class="clearfix">' +--}}
        {{--      '<div class="message other-message pull-right">' +--}}
        {{--      '<img class="rounded-circle float-end chat-user-img img-30" src="{{ $chat->user_referral()->first()->avatar ? route('user.get.avatar', $chat->user_referral()->first()->id) : asset('images/avatar/user.svg') }}" alt="">' +--}}
        {{--      '<div class="message-data">' +--}}
        {{--      '  <span class="message-data-time">' + $data.time + '</span>' +--}}
        {{--      ' </div>' +--}}
        {{--      $data.message +--}}
        {{--      ' </div>' +--}}
        {{--      '</li>');--}}
        {{--}--}}
        scrollChat();
      });
      @endif
    });
  </script>
@endsection
