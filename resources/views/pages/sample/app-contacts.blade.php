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
            <h5 class="m-0 sidebar-title">
              <i class="material-icons app-header-icon text-top">perm_identity</i> Пользователи
            </h5>
            <div class="mt-10 pt-2">
              <p class="m-0 subtitle font-weight-700">Общее количество пользователей</p>
              <p class="m-0 text-muted">{{ $users_count ?? 0 }}</p>
            </div>
          </div>
        </div>
        <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
          <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
            <ul class="contact-list display-grid">
              <li class="sidebar-title">Роли</li>
              <li @if(empty(request()->get('roles'))) class="active" @endif>
                <a href="{{ route('users.index') }}" class="text-sub">
                  <i class=" material-icons small-icons mr-2" style="color:{{ $role->color ?? '' }};">fiber_manual_record</i>
                  Все
                </a>
              </li>
              @if(auth()->user()->hasRole('root'))
                @forelse($roles as $role)
                  <li @if(request()->get('roles') === $role->name) class="active" @endif>
                    <a href="{{ route('users.index', array_add(request()->except('page', 'roles'),'roles', $role->name) ) }}" class="text-sub">
                      <i class=" material-icons small-icons mr-2" style="color:{{ $role->color ?? '#ff0058' }};">fiber_manual_record</i>
                      {{$role->name}}
                    </a>
                  </li>
                @empty
                @endforelse
              @endif
              {{--            <li><a href="" class="text-sub ">--}}
              {{--                <i class="blue-grey-text material-icons small-icons mr-2">fiber_manual_record</i>--}}
              {{--                Engineering</a>--}}
              {{--            </li>--}}
              {{--            <li>--}}
              {{--              <a href="javascript:void(0)" class="text-sub">--}}
              {{--                <i class="amber-text material-icons small-icons mr-2">fiber_manual_record</i>--}}
              {{--                Sales--}}
              {{--              </a>--}}
              {{--            </li>--}}
              {{--            <li>--}}
              {{--              <a href="javascript:void(0)" class="text-sub">--}}
              {{--                <i class="light-green-text material-icons small-icons mr-2">fiber_manual_record</i>--}}
              {{--                Support</a>--}}
              {{--            </li>--}}
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
          <table id="data-table-contact" class="display" style="width:100%;">
            <thead>
              <tr>
                <th style=" padding-left: 20px;">Пользователь</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Страна</th>
                <th>Ссылка</th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $user)
                <tr>
                  <td style=" padding-left: 20px;">
                  <span class="avatar-contact avatar-online">
                    <img src="{{asset('images/avatar/user.svg')}}" alt="avatar">
                  </span>
                  </td>
                  <td>{{ $user->name ?? "Не указано" }}</td>
                  <td>{{ $user->email ?? "Не указана" }}</td>
                  <td>{{ $user->country ?? "Не указана" }}</td>
                  <td>
                    <a href="{{ route('users.show', $user) }}">Перейти</a>
                  </td>
                </tr>
              @empty
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div>
        {{ $users->appends(request()->except('page'))->links() }}
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