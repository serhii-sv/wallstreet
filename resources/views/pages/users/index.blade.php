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
  <style>
      blink {
          -webkit-animation: blink 1.5s ease-out infinite;
          animation: blink 1.5s ease-out infinite;
      }

      @-webkit-keyframes blink {
          100% {
              color: rgba(34, 34, 34, 0);
          }
      }

      @keyframes blink {
          100% {
              color: rgba(34, 34, 34, 0);
          }
      }

      .control {
          width: 30px;
      }

      .table.dataTable thead th {
          min-width: 30px;
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
              <i class="material-icons app-header-icon text-top">perm_identity</i> @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Users' contenteditable="true">{{ __('Users') }}</editor_block>
              @else
                {{ __('Users') }}
              @endif
            </h5>
            <div class="mt-10 pt-2">
              <p class="m-0 subtitle font-weight-700">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Total number of users' contenteditable="true">{{ __('Total number of users') }}</editor_block>
                @else
                  {{ __('Total number of users') }}
                @endif</p>
              <p class="m-0 text-muted">{{ $users_count ?? 0 }}</p>
            </div>
          </div>
        </div>
        <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
          <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
            <ul class="contact-list display-grid">
              <li class="sidebar-title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Roles' contenteditable="true">{{ __('Roles') }}</editor_block>
                @else
                  {{ __('Roles') }}
                @endif</li>
              <li @if(empty(request()->get('roles'))) class="active" @endif>
                <a href="{{ route('users.index') }}" class="text-sub">
                  <i class=" material-icons small-icons mr-2" style="color:{{ $role->color ?? '' }};">fiber_manual_record</i>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='All' contenteditable="true">{{ __('All') }}</editor_block>
                  @else
                    {{ __('All') }}
                  @endif
                </a>
              </li>
              {{--                            @if(auth()->user()->hasRole('root'))--}}
              @forelse($roles as $role)
                @if($role->name != "admin" && $role->name != "root")
                  <li @if(request()->get('roles') === $role->name) class="active" @endif>
                    <a href="{{ route('users.index', array_add(request()->except('page', 'roles'),'roles', $role->name) ) }}" data-role_id="{{ $role->id }}" class="text-sub">
                      <i class=" material-icons small-icons mr-2"
                          style="color:{{ $role->color ?? '#ff0058' }};">fiber_manual_record</i>
                      {{ $role->name == 'teamlead' ? 'Тимлидеры' : $role->name }}
                    </a>
                  </li>
                @endif
              @empty
              @endforelse
              <li @if(request()->get('roles') === 'multi_acc') class="active" @endif>
                <a href="{{ route('users.index', ['roles' => 'multi_acc'] ) }}" class="text-sub" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class=" material-icons small-icons mr-2"
                      style="color:{{ $role->color ?? '#ff0058' }};">fiber_manual_record</i>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Multi-accounts' contenteditable="true">{{ __('Multi-accounts') }}</editor_block>
                  @else
                    {{ __('Multi-accounts') }}
                  @endif
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
              <li class="sidebar-title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Assign a role to all dedicated users' contenteditable="true">{{ __('Assign a role to all dedicated users') }}</editor_block>
                @else
                  {{ __('Assign a role to all dedicated users') }}
                @endif</li>
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
                <th>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='id' contenteditable="true">{{ __('id') }}</editor_block>
                  @else
                    {{ __('id') }}
                  @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Login' contenteditable="true">{{ __('Login') }}</editor_block>
                  @else
                    {{ __('Login') }}
                  @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Email' contenteditable="true">{{ __('Email') }}</editor_block>
                  @else
                    {{ __('Email') }}
                  @endif
                </th>
                <th>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Name' contenteditable="true">{{ __('Name') }}</editor_block>
                  @else
                    {{ __('Name') }}
                  @endif
                </th>
                <th>@if(request()->get('roles') === 'multi_acc') @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Main Acc' contenteditable="true">{{ __('Main Acc') }}</editor_block>
                  @else
                    {{ __('Main Acc') }}
                    @endif @else @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Upliner' contenteditable="true">{{ __('Upliner') }}</editor_block>
                  @else
                    {{ __('Upliner') }}
                    @endif @endif</th>
                  @if(request()->get('roles') === 'multi_acc')
                <th>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='ip' contenteditable="true">{{ __('ip') }}</editor_block>
                  @else
                    {{ __('ip') }}
                  @endif
                </th>
                  @endif
                <th>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Country' contenteditable="true">{{ __('Country') }}</editor_block>
                  @else
                    {{ __('Country') }}
                  @endif
                </th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </form>
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

        var table = $("#users").DataTable({
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            order: [1, 'desc'],
            aoColumns: [
                {
                    data: 'empty',
                    searchable: false,
                    bSortable: false
                },
                {
                    data: 'user',
                    searchable: false,
                    bSortable: false
                },
                {
                    data: 'login',
                    searchable: true,
                    bSortable: true
                },
                {
                    data: 'email',
                    searchable: true,
                    bSortable: true
                },
                {
                    data: 'name',
                    searchable: true,
                    bSortable: true
                },
                {
                    data: 'partner',
                    searchable: true,
                    bSortable: true
                },
                    @if(request()->get('roles') === 'multi_acc')
                {
                    data: 'ip',
                    searchable: true,
                    bSortable: true
                },
                @endif

                // {
                //     data: 'country',
                //     searchable: true,
                //     bSortable: true
                // },
                {
                    data: 'country',
                    searchable: false,
                    bSortable: false
                },
            ],
            processing: true,
            serverSide: true,
            ajax: {},
            dom: '<"top display-flex  mb-2"<"action-filters"f><"actions action-btns display-flex align-items-center">><"clear">rt<"bottom"p>',
            language: {
                processing: "Загрузка",
                paginate: {
                    previous: "‹",
                    next: "›",
                },
                emptyTable: 'Нет записей'
            },
            columnDefs: [
                {
                    targets: 0,
                    className: "control"
                },
            ],
            createdRow: function (row, data, dataIndex) {
                $(row).css({'color': data.color})
            }
        });
    });
  </script>
@endsection
