{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Contact')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">
@endsection

{{-- page content --}}
@section('content')
  <!-- Sidebar Area Starts -->
  <div class="sidebar-left sidebar-fixed">
    <div class="sidebar">
      <div class="sidebar-content">
        <div class="sidebar-header">
          <div class="sidebar-details">
            <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">receipt</i> Уведомления
            </h5>
            <div class="mt-3 pt-2">
              <p class="m-0 subtitle font-weight-700">Общее количество уведомлений</p>
              <p class="m-0 text-muted">{{ $notifications_count ?? 0 }}</p>
              <a class="mt-2 btn waves-effect waves-light gradient-45deg-red-pink" href="{{ route('notifications.create') }}">Создать</a>
            </div>
          </div>
        </div>
        <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
          <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
            <ul class="contact-list display-grid">
              <li class="sidebar-title">Типы</li>
              <li @if(empty(request()->get('type'))) class="active" @endif>
                <a href="{{ route('notifications.index') }}" class="text-sub">
                  <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                  Все
                </a>
              </li>
       
            </ul>
          </div>
        </div>
        <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only"><i
              class="material-icons">menu</i></a>
      </div>
    </div>
  </div>
  <!-- Sidebar Area Ends -->
  
  <!-- Content Area Starts -->
  <div class="content-area content-right">
    <div class="app-wrapper">
      <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
        <div class="card-content p-0">
          <table id="data-table-contact" class="display subscription-table responsive-table highlight" style="width:100%;">
            <thead>
              <tr>
                <th style=" padding-left: 20px;">Название</th>
                <th>Дата</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @forelse($notifications as $notification)
                <tr>
                  <td style=" padding-left: 20px;">@if($notification->name){{ $notification->name }} @else Не указано @endif</td>
                  
                  <td>{{ $notification->created_at->format('d-m-Y H:i') }}</td>
{{--                  <td class="center-align">--}}
{{--                    <a href="{{ route('notifications.show', $notification->id) }}">Open</a>--}}
{{--                  </td>--}}
                </tr>
              @empty
                <tr>
                  <td colspan="3">
                    Уведомлений пока нет
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div>
        {{ $notifications->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </div>
  <!-- Content Area Ends -->

@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
  <script src="{{asset('js/scripts/app-contacts.js')}}"></script>
@endsection
