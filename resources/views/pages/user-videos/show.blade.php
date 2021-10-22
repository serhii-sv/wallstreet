{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Вопросы - ответы')

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
          width: calc(100% - 250px - 30px - 220px - 30px - 220px);
          margin: 0 15px;
      }

      .status {
          width: 220px;
          margin: 0 15px;
      }

      .card-content .button-block {
          width: 220px;
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
      
        <div class="card-content pt-2">
          <div class="body">
            {!! htmlspecialchars_decode($video->link) !!}
          </div>
        </div>
      </div>
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
    $(document).ready(function (){
    
    });
  </script>
@endsection
