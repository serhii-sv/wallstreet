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
          <!-- Sidebar Area Starts -->
          <div class="sidebar-left sidebar-fixed">
            <div class="sidebar">
              <div class="sidebar-content">
                <div class="sidebar-menu list-group position-relative">
                  <div class="sidebar-list-padding app-sidebar contact-app-sidebar" id="contact-sidenav">
                    <ul class="contact-list display-grid">
                      <li>
                        <h5 class="m-0">What will be next step?</h5>
                      </li>
                      <li>
                        <h6 class="mt-5 line-height">You are one step closer to build your perfect product</h6>
                      </li>
                      <li>
                        <hr class="mt-5">
                      </li>
                    </ul>
                  </div>
                </div>
                
                <a href="#" data-target="contact-sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
              
              </div>
            </div>
          </div>
          <!-- Sidebar Area Ends -->
        </div>
        <div class="col s12 m12 l8 contact-form margin-top-contact">
          <div class="row">
            <form action="{{ route('notifications.store') }}" method="post" class="col s12">
              @csrf
              <div class="row">
                <div class="input-field col m6 s12">
                  <input id="name" type="text" class="validate">
                  <label for="name">Тема</label>
                </div>
                <div class="input-field col m6 s12">
                  <input id="email" type="text" class="validate">
                  <label for="email">С какого email</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col m6 s12">
                  <select class="select2 browser-default ">
                    @forelse($notification_templates as $item)
                      <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                    @empty
                      <option value="" disabled>Шаблонов нет</option>
                    @endforelse
                  </select>
                </div>
                <div class="input-field col m6 s12">
                  <label class="">Кому отправить</label>
                  <select class="select2-data-ajax browser-default" id="select2-ajax" multiple></select>
                </div>
              </div>
              <div class="row" style="margin-top: 10px;">
                <div class="col">Канал связи</div>
              </div>
              <div class="row ">
                <div class="input-field col m6 s12" style="margin-bottom: 5px;margin-top: 5px;">
                  <p style="margin-bottom: 5px;">
                    <label>
                      <input type="checkbox" name="type" checked="checked" />
                      <span>Email</span>
                    </label>
                  </p>
                </div>
                <div class="input-field col m6 s12" style="margin-bottom: 5px;margin-top: 5px;">
                  <p style="margin-bottom: 5px;">
                    <label>
                      <input type="checkbox" name="type" />
                      <span>Браузер</span>
                    </label>
                  </p>
                </div>
                <div class="input-field col m6 s12" style="margin-bottom: 5px;margin-top: 5px;">
                  <p style="margin-bottom: 5px;">
                    <label>
                      <input type="checkbox" name="type" disabled />
                      <span>Смс (Пока не доступно)</span>
                    </label>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 width-100">
                  <textarea id="editor" name="email_text" class="materialize-textarea" placeholder="Текст для шаблона"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 width-100">
                  <textarea id="textarea1" class="materialize-textarea"></textarea>
                  <label for="textarea1">Текст уведомления</label>
                  <button class="waves-effect waves-light btn">Отправить</button>
                </div>
              </div>
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
    CKEDITOR.replace( 'email_text' );
  </script>
@endsection