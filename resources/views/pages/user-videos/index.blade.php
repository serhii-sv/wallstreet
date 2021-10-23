{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Videos')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css"
      href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">
  <style>
      .card-content {
          width: 100%;
          display: flex;
          align-items: center;
          flex-wrap: wrap;
      }

      .card-content .head {
          width: 100%;
          display: flex;
          align-items: center;
      }

      .card-header {
          border-bottom: 1px solid #e0e0e0;
          font-weight: 600;
      }

      .card-content .body {
          width: 100%;
          display: flex;
          align-items: center;
          flex-wrap: wrap;
      }

      .card-content form {

          width: 100%;
          display: flex;
          align-items: center;
          flex-wrap: wrap;
      }

      .user {
          width: 250px;
      }

      .card-content .input {
          width: calc(100% - 250px - 30px - 220px - 30px - 270px);
          margin: 0 15px;
      }

      .status {
          width: 220px;
          margin: 0 15px;
      }

      .card-content .button-block {
          width: 270px;
      }

      .frame-block iframe {
          max-width: 200px;
          max-height: 120px;
      }
  </style>
@endsection

{{-- page content --}}
@section('content')
  <!-- Sidebar Area Starts -->
  <div class="sidebar-left sidebar-fixed">
    <div class="sidebar">
      <div class="sidebar-content">
        <div class="sidebar-header">
          <div class="sidebar-details">
            <h5 class="m-0 sidebar-title">
              <i class="material-icons app-header-icon text-top">perm_identity</i> @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='User videos' contenteditable="true">{{ __('User videos') }}</editor_block>@else {{ __('User videos') }} @endif
            </h5>
            <div class="mt-10 pt-2">
              {{--              <a href="">Добавить </a>--}}
              {{--              <p class="m-0 subtitle font-weight-700">Общее количество вопросов - ответов</p>--}}
              {{--              <p class="m-0 text-muted">{{ $faqs_count ?? 0 }}</p>--}}
            </div>
          </div>
        </div>
        <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
          <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
          
          </div>
        </div>
        <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only">
          <i class="material-icons">menu</i>
        </a>
      </div>
    </div>
  </div>
  <!-- Sidebar Area Ends -->
  
  <!-- Content Area Starts -->
  <div class="content-area content-right">
    <div class="app-wrapper">
      <div class="card mt-0">
        @include('panels.inform')
      </div>
      <div class="card mt-0 mb-0">
        <div class="card-header">
          <div class="card-content">
            <div class="user">
              @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Login' contenteditable="true">{{ __('Login') }}</editor_block>@else {{ __('Login') }} @endif
            </div>
            <div class="input">
              @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Link' contenteditable="true">{{ __('Link') }}</editor_block>@else {{ __('Link') }} @endif
            </div>
            <div class="status">
              @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Status' contenteditable="true">{{ __('Status') }}</editor_block>@else {{ __('Status') }} @endif
            </div>
          </div>
        </div>
        <div class="card-content pt-2">
          <div class="body">
            @forelse($videos as $video)
              <form action="{{ route('video.save', $video->id) }}" method="post" class="mb-1">
                @csrf
                <div class="user">
                  <a href="{{ route('users.show', $video->user->id) }}">{{ $video->user->login }}</a>
                  <div>
                    <div class="frame-block mt-3">{!! htmlspecialchars_decode($video->link) !!}</div>
                  </div>
                </div>
                <div class="input">
                  <textarea name="link" style="padding: 10px;height: auto;" name="link" rows="4">{!! $video->link !!}</textarea>
                  {{-- <input type="text" name="answer" placeholder="Ответ" value="{{ $video->link }}">--}}
                </div>
                <div class="status">
                  @if($video->approved)
                    <span class="badge green darken-3 display-block" style="height: auto;padding: 10px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Confirmed' contenteditable="true">{{ __('Confirmed') }}</editor_block>@else {{ __('Confirmed') }} @endif</span>
                  @else
                    <span class="badge red darken-2 display-block" style="height: auto;padding: 10px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Not confirmed' contenteditable="true">{{ __('Not confirmed') }}</editor_block>@else {{ __('Not confirmed') }} @endif</span>
                  @endif
                </div>
                <div class="button-block display-flex justify-content-between">
                  <a class="btn waves-effect waves-light cyan " href="{{ route('video.index', $video->id) }}" target="_blank" style="padding: 0 15px;">
                    <i class="material-icons dp48">remove_red_eye</i>
                  </a>
                  <button class="btn waves-effect waves-light purple lighten-1 " style="padding: 0 15px;">
                    <i class="material-icons">save</i>
                  </button>
                  <a class="btn waves-effect waves-light green darken-1 @if($video->approved) disabled @endif" href="{{ route('video.confirm', $video->id) }}" onclick="return confirm('Are you sure?')" style="padding: 0 15px;">
                    <i class="material-icons dp48">check</i>
                  </a>
                  <a class="btn waves-effect waves-light amber darken-4 @if(!$video->approved) disabled @endif" href="{{ route('video.cancel', $video->id) }}" onclick="return confirm('Are you sure?')" style="padding: 0 15px;">
                    <i class="material-icons dp48">do_not_disturb_alt</i>
                  </a>
                  <a class="btn waves-effect waves-light red accent-2" href="{{ route('video.delete', $video->id) }}" onclick="return confirm('Are you sure?')" style="padding: 0 15px;">
                    <i class="material-icons">delete</i>
                  </a>
                </div>
              </form>
            @empty
              <div class="card-content pl-0 pb-0 pr-0">
                @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='No entries' contenteditable="true">{{ __('No entries') }}</editor_block>@else {{ __('No entries') }} @endif
              </div>
            @endforelse
          </div>
        </div>
      </div>
      {{ $videos->appends(request()->except(['page']))->links() }}
    </div>
  </div>
  <!-- Content Area Ends -->

@endsection

{{-- vendor scripts --}}
@section('vendor-script')
@endsection

{{-- page scripts --}}
@section('page-script')
  <script>
    $(document).ready(function () {
    
    });
  </script>
@endsection
