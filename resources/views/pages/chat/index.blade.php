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
                      {{--                        <div class="sidebar-header">--}}
                      {{--                          <div class="row valign-wrapper">--}}
                      {{--                            <div class="col s3 media-image pr-0">--}}
                      {{--                              <img src="{{ auth()->user()->avatar ? route('user.get.avatar', auth()->user()->id) :  asset('images/user.png') }}" alt="" class="circle z-depth-2 responsive-img" style=" width: 36px; height: 36px;">--}}
                      {{--                            </div>--}}
                      {{--                            <div class="col s9 pl-2">--}}
                      {{--                              <p class="m-0 blue-grey-text text-darken-4 font-weight-700">{{ auth()->user()->name }}</p>--}}
                      {{--                              <p class="m-0 info-text">{{ auth()->user()->login }}</p>--}}
                      {{--                            </div>--}}
                      {{--                          </div>--}}
                      {{--                        </div>--}}
                      <!--/ Sidebar Header -->
                        
                        <!-- Sidebar Content List -->
                        <div class="sidebar-content sidebar-chat ps ps--active-y">
                          <div class="chat-list chat-user-list">
                          
                          
                          </div>
                          <div class="no-data-found">
                            <h6 class="center">No Results Found</h6>
                          </div>
                          <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                          </div>
                          <div class="ps__rail-y" style="top: 0px; height: 605px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 576px;"></div>
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
              {{--                <!-- Chat header -->--}}
              {{--                <div class="chat-header">--}}
              {{--                  <div class="row valign-wrapper">--}}
              {{--                    <div class="col media-image online pr-0">--}}
              {{--                      <img src="{{ asset('images/user/7.jpg') }}" alt="" class="circle z-depth-2 responsive-img">--}}
              {{--                    </div>--}}
              {{--                    <div class="col">--}}
              {{--                      <p class="m-0 blue-grey-text text-darken-4 font-weight-700">Alice Hawker</p>--}}
              {{--                      <p class="m-0 chat-text truncate">Apple pie bonbon cheesecake tiramisu</p>--}}
              {{--                    </div>--}}
              {{--                  </div>--}}
              {{--                  <span class="option-icon">--}}
              {{--                  <i class="material-icons">delete</i>--}}
              {{--                  <i class="material-icons">more_vert</i>--}}
              {{--                </span>--}}
              {{--                </div>--}}
              {{--                <!--/ Chat header -->--}}
              
              <!-- Chat content area -->
                <div class="chat-area ps ps--active-y">
                  <div class="chats">
                    <div class="chats chat-wrapper">
                      @if(!empty($messages))
                        @foreach($messages as $message)
                          @if($message->user_id == auth()->user()->id)
                            <div class="chat chat-right">
                              <div class="chat-avatar">
                                <a class="avatar">
                                  <img src="{{ $myAvatar }}" class="circle" alt="avatar">
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
                      {{--    <div class="chat chat-right">
                            <div class="chat-avatar">
                              <a class="avatar">
                                <img src="{{ asset('images/user/12.jpg') }}" class="circle" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-text">
                                <p>How can we help? We're here for you!</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat">
                            <div class="chat-avatar">
                              <a class="avatar">
                                <img src="{{ asset('images/user/7.jpg') }}" class="circle" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-text">
                                <p>Hey John, I am looking for the best admin template. Could you please help me to find it
                                  out?</p>
                              </div>
                              <div class="chat-text">
                                <p>It should be material css compatible.</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat chat-right">
                            <div class="chat-avatar">
                              <a class="avatar">
                                <img src="{{ asset('images/user/12.jpg') }}" class="circle" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-text">
                                <p>Absolutely!</p>
                              </div>
                              <div class="chat-text">
                                <p>Materialize admin is the responsive material admin template.</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat">
                            <div class="chat-avatar">
                              <a class="avatar">
                                <img src="{{ asset('images/user/7.jpg') }}" class="circle" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-text">
                                <p>Looks clean and fresh UI.</p>
                              </div>
                              <div class="chat-text">
                                <p>It's perfect for my next project.</p>
                              </div>
                              <div class="chat-text">
                                <p>How can I purchase it?</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat chat-right">
                            <div class="chat-avatar">
                              <a class="avatar">
                                <img src="{{ asset('images/user/12.jpg') }}" class="circle" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-text">
                                <p>Thanks, from ThemeForest.</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat chat-right">
                            <div class="chat-avatar">
                              <a class="avatar">
                                <img src="{{ asset('images/user/12.jpg') }}" class="circle" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-text">
                                <p>Thanks, from ThemeForest.</p>
                              </div>
                            </div>
                          </div>
                          <div class="chat">
                            <div class="chat-avatar">
                              <a class="avatar">
                                <img src="{{ asset('images/user/7.jpg') }}" class="circle" alt="avatar">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-text">
                                <p>I will purchase it for sure.</p>
                              </div>
                              <div class="chat-text">
                                <p>Thanks.</p>
                              </div>
                            </div>
                          </div>--}}
                    </div>
                  </div>
                  <div class="ps__rail-x" style="left: 0px; bottom: -706px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                  </div>
                  <div class="ps__rail-y" style="top: 706px; height: 208px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 161px; height: 47px;"></div>
                  </div>
                </div>
                <!--/ Chat content area -->
                
                <!-- Chat footer <-->
                <div class="chat-footer">
                  <form onsubmit="enter_chat();" action="javascript:void(0);" class="chat-input">
                    <input id="message-to-send" type="text" placeholder="Type message here.." class="message mb-0">
                    <button class="btn waves-effect waves-light send chat-message-send-btn">Send</button>
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
      
      Pusher.logToConsole = true;

      Echo.join('chat')
      .here((users) => {
        build_user_list(users);
      })
      .joining((user) => {
        var $my_id = '{{ auth()->user()->id }}';
        var $me = '';
        if ($my_id == user.id) {
          $me = '<div class="info-section">' +
              '<span class="new badge gradient-45deg-purple-deep-orange gradient-shadow" data-badge-caption="gradient purple orange">Вы</span>' +
              '</div>';
        } else {
          $me = '<div class="info-section"></div>'
        }
        $(".chat-user-list").append('<div class="chat-user animate fadeUp delay-1" data-id="' + user.id + '">' +
            '<div class="user-section width-100">' +
            '<div class="row valign-wrapper">' +
            '<div class="col s3 media-image online pr-0">' +
            '<img src="' + user.avatar + '" alt="" class="circle z-depth-2 responsive-img" style="width: 40px;height: 40px;">' +
            ' </div>' +
            ' <div class="col s9 pl-0">' +
            '<p class="m-0 blue-grey-text text-darken-4 font-weight-700">' + user.name + '</p>' +
            '<p class="m-0 info-text">' + user.login + '</p>' +
            '</div>' +
            '</div>' +
            '</div>' +
            $me +
            '</div>');
      })
      .leaving((user) => {
        $(".chat-user-list").find('.chat-user[data-id="' + user.id + '"]').remove();
      })
      .listen('AdminChat', function ($data) {
        
        if ($data.user_id == "{{ auth()->user()->id }}") {
          $(".chat-wrapper").append('<div class="chat chat-right">' +
              '<div class="chat-avatar">' +
              ' <a class="avatar">' +
              '<img src="{{ $myAvatar }}" class="circle" alt="avatar">' +
              '</a>' +
              '</div>' +
              '<div class="chat-body">' +
              ' <div class="chat-text">' +
              ' <p> '+$data.message +'</p>' +
              '</div>' +
              ' </div>' +
              ' </div>');
        } else {
          $(".chat-wrapper").append('<div class="chat">' +
              '<div class="chat-avatar">' +
              ' <a class="avatar">' +
              '<img src="'+ $data.avatar +'" class="circle" alt="avatar">' +
              '</a>' +
              '</div>' +
              '<div class="chat-body">' +
              ' <div class="chat-text">' +
              ' <p>'+$data.message +'</p>' +
              '</div>' +
              ' </div>' +
              ' </div>');
        }
        scrollChat();
      });
      
      function build_user_list(users) {
        $(".chat-user-list").children().remove();
        var $my_id = '{{ auth()->user()->id }}';
        var $me = '';
        users.forEach(function (user) {
          if ($my_id == user.id) {
            $me = '<div class="info-section">' +
                '<span class="new badge gradient-45deg-purple-deep-orange gradient-shadow" data-badge-caption="gradient purple orange">Вы</span>' +
                '</div>';
          } else {
            $me = '<div class="info-section"></div>'
          }
          
          $(".chat-user-list").append('<div class="chat-user animate fadeUp delay-1" data-id="' + user.id + '">' +
              '<div class="user-section width-100">' +
              '<div class="row valign-wrapper">' +
              '<div class="col s3 media-image online pr-0">' +
              '<img src="' + user.avatar + '" alt="" class="circle z-depth-2 responsive-img" style="width: 40px;height: 40px;">' +
              ' </div>' +
              ' <div class="col s9 pl-0">' +
              '<p class="m-0 blue-grey-text text-darken-4 font-weight-700">' + user.name + '</p>' +
              '<p class="m-0 info-text">' + user.login + '</p>' +
              '</div>' +
              '</div>' +
              '</div>' +
              $me +
              '</div>');
        })
      }
      
      
      $(".chat-message-send-btn").on('click', function (e) {
            var $message = $("#message-to-send").val();
            if ($message.length > 0) {
              var $options = {
                method: "post",
                url: "{{ route('chat.send.message') }}",
                data: {
                  user_id: "{{ auth()->user()->id }}",
                  message: $message,
                  type: "message",
                }
              }
              window.axios($options);
            }
            $("#message-to-send").val('');
          }
      );
      $("#message-to-send").keyup(function (event) {
            if (event.keyCode == 13) {
              var $message = $(this).val();
              if ($message.length > 0) {
                var $options = {
                  method: "post",
                  url: "{{ route('chat.send.message') }}",
                  data: {
                    user_id: "{{ auth()->user()->id }}",
                    message: $message,
                    type: "message",
                  }
                }
                window.axios($options);
              }
              $(this).val('');
            }
          }
      );
    });
  </script>
@endsection
