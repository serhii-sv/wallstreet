{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Пользователи')

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
              {{--                            @if(auth()->user()->hasRole('root'))--}}
              @forelse($roles as $role)
                @if(!auth()->user()->hasRole('root') && $role->name == 'teamlead')
                
                @elseif((auth()->user()->hasRole('root') && $role->name == 'teamlead') || $role->name != 'teamlead')
                  <li @if(request()->get('roles') === $role->name) class="active" @endif>
                    <a href="{{ route('users.index', array_add(request()->except('page', 'roles'),'roles', $role->name) ) }}" data-role_id="{{ $role->id }}" class="text-sub">
                      <i class=" material-icons small-icons mr-2"
                          style="color:{{ $role->color ?? '#ff0058' }};">fiber_manual_record</i>
                      {{$role->name}}
                    </a>
                  </li>
                @endif
              @empty
              @endforelse
              <li @if(request()->get('roles') === 'multi_acc') class="active" @endif>
                <a href="{{ route('users.index', ['roles' => 'multi_acc'] ) }}" class="text-sub">
                  <i class=" material-icons small-icons mr-2"
                      style="color:{{ $role->color ?? '#ff0058' }};">fiber_manual_record</i>
                  Мультиаккаунты
                </a>
              </li>
              {{--                            @endif--}}
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
            <ul class="contact-list display-none new-role-selection">
              <li class="sidebar-title">Назначит роль всем выделенным пользователям</li>
              {{--                            @if(auth()->user()->hasRole('root'))--}}
              @forelse($roles as $role)
                @if(!auth()->user()->hasRole('root') && $role->name == 'teamlead')
                
                @elseif((auth()->user()->hasRole('root') && $role->name == 'teamlead') || $role->name != 'teamlead')
                  <li @if(request()->get('roles') === $role->name) class="active" @endif>
                    <a href="#" data-role_id="{{ $role->id }}" class="text-sub">
                      <i class=" material-icons small-icons mr-2"
                          style="color:{{ $role->color ?? '#ff0058' }};">fiber_manual_record</i>
                      {{$role->name}}
                    </a>
                  </li>
                @endif
              
              @empty
              @endforelse
              {{--                            @endif--}}
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
        <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only">
          <i class="material-icons">menu</i>
        </a>
      </div>
    </div>
  </div>
  <!-- Sidebar Area Ends -->
  
  <!-- Content Area Starts -->
  <div class="content-area content-right">
    <form id="usersForm" action="{{ route('users.mass-role-change') }}" method="post">
      @csrf
      <input type="hidden" name="role_id">
      <div class="app-wrapper">
        <div class="card-content p-0">
          <table id="users" class="display card card card-default scrollspy border-radius-6">
            <thead>
              <tr>
                <th>
                  <label>
                    <input type="checkbox" class="select-checkbox dt-checkboxes" />
                    <span></span>
                  </label>
                </th>
                <th>Id</th>
                <th>Имя</th>
                <th>Email</th>
                <th>@if(request()->get('roles') === 'multi_acc') Основной аккаунт @else Аплайнер @endif</th>
                <th class="tooltipped" data-position="top" data-tooltip="Всего рефералов">ВР*</th>
                <th class="tooltipped" data-position="top" data-tooltip="Переходы по реферальной ссылке">ПС*</th>
                {{--                <th>Страна</th>--}}
                <th>Город</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </form>
    <div class=" mb-5">
      <div class="mb-1">
      <span class="badge gradient-45deg-indigo-purple white-text" style="font-size: 16px;padding: 5px 15px;margin-left: 0;">
        ВР* - Всего рефералов
      </span>
      </div>
      <div>
        <span class="badge gradient-45deg-indigo-purple white-text" style="font-size: 16px;padding: 5px 15px;margin-left: 0;">
        ПС* - Переходы по реферальной ссылке
      </span>
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
  <script>
    $(document).ready(function () {
      $('.tooltipped').tooltip();
    });
  </script>
@endsection
