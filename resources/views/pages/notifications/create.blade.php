{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Page Contact')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('fonts/fontawesome/css/all.min.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
  <link href="https://cdn.quilljs.com/1.0.5/quill.snow.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-contact.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/select2/select2-materialize.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendors/quill/katex.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendors/quill/monokai-sublime.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendors/quill/quill.snow.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendors/quill/quill.bubble.css') }}">
@endsection

{{-- page content --}}
@section('content')
  <!-- Contact Us -->
  <div id="contact-us" class="section">
    <div class="app-wrapper">
      <div class="contact-header">
        <div class="row contact-us ml-0 mr-0">
          <div class="col s12 m12 l4 sidebar-title">
            <h5 class="m-0">
              <i class="material-icons contact-icon vertical-text-top">mail_outline</i> Создать уведомление</h5>
          </div>
        </div>
      </div>

      <!-- Contact Sidenav -->
      <div id="sidebar-list" class="row contact-sidenav ml-0 mr-0">
        <div class="col s12 m12 l4">
        </div>
        <div class="col s12 m12 l8 contact-form margin-top-contact">
          <div class="row">
            <form action="{{ route('notifications.store') }}" method="post" class="col s12">
              @csrf
              @include('panels.inform')
              @if(session()->has('mail_sent'))
                <div class="card-alert card gradient-45deg-green-teal mt-0">
                  <div class="card-content white-text">
                    @forelse(session()->get('mail_sent') as $msg)
                    <p>
                      <i class="material-icons">email</i>
                      {{ $msg }}
                    </p>
                    @empty
                    @endforelse
                  </div>
                  <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              @endif
              <div class="row">
                <div class="input-field col m6 s12">
                  <input id="name" type="text" class="validate" name="name" value="{{ old('name') ?? '' }}">
                  <label for="name">Название</label>
                </div>
                <div class="input-field col m6 s12">
                  <input id="name" type="text" class="validate" name="subject" value="{{ old('subject') ?? '' }}">
                  <label for="name">Тема</label>
                </div>
              </div>
              <style>
                  .select2-search__field {
                      min-width: 100px;
                  }
              </style>
              <div class="row">
                <div class="input-field col m6 s12">
                  <input id="email" type="text" class="validate" name="from_email" value="{{ old('from_email') ?? '' }}">
                  <label for="email">С какого email</label>
                </div>
                <div class="input-field col m6 s12">
                  <label class="">Кому отправить</label>
                  <select class="select2-get-user-ajax browser-default" id="select2-ajax" name="users[]" multiple></select>
                </div>
              </div>
              <div class="row" style="margin-top: 10px;">
                <div class="col">Канал связи</div>
              </div>
              <div class="row ">
                @forelse($notification_types as $key => $item)
                  @if($item['active'])
                    <div class="input-field col m6 s12" style="margin-bottom: 5px;margin-top: 5px;">
                      <p style="margin-bottom: 5px;">
                        <label>
                          <input type="checkbox" name="type[]" value="{{ $key }}" @if($loop->first) checked @endif @if(!$item['active']) disabled @endif/>
                          <span>{{ $item['name'] }}</span>
                        </label>
                      </p>
                    </div>
                  @endif
                @empty
                @endforelse
              </div>
              <div class="divider"></div>
              <div class="row ">
                <div class="input-field col s12 width-100">
                  <div class="font-weight-500 mb-2">Текст уведомления</div>
                  <textarea id="editor" name="text" class="materialize-textarea " placeholder="Текст уведомления">{{ old('text') ?? '' }}</textarea>
                  <button class="waves-effect waves-light btn gradient-shadow mt-2 ml-3">Отправить</button>
                  <button class="notification-preview-btn btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow mt-2">Предпросмотр</button>
                </div>
              </div>

            </form>
            <form action="{{ route('notifications.preview') }}" class="notification-preview-form" method="post">
              @csrf
              <input type="hidden" name="preview" class="notification-preview-input">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- page script --}}
@section('page-script')
  <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
  <script src="{{asset('js/scripts/page-contact.js')}}"></script>
  <script src="{{asset('js/scripts/form-select2.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor');
  </script>
  <script>
    $(document).ready(function (e) {
      $(".notification-preview-btn").on('click', function (e) {
        e.preventDefault();
        var $text = CKEDITOR.instances['editor'].getData();
        $(".notification-preview-input").val($text);
        $(".notification-preview-form").submit();
      });
    });
  </script>
@endsection
