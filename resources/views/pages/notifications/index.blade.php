{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Contact')

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
                        <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">receipt</i>
                          @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Notifications' contenteditable="true">{{ __('Notifications') }}</editor_block>
                          @else
                            {{ __('Notifications') }}
                          @endif
                        </h5>
                        <div class="mt-3 pt-2">
                            <p class="m-0 subtitle font-weight-700">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Total number of notifications' contenteditable="true">{{ __('Total number of notifications') }}</editor_block>
                              @else
                                {{ __('Total number of notifications') }}
                              @endif</p>
                            <p class="m-0 text-muted">{{ $notifications_count ?? 0 }}</p>
                            <a class="mt-2 btn waves-effect waves-light gradient-45deg-red-pink"
                               href="{{ route('notifications.create') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Create' contenteditable="true">{{ __('Create') }}</editor_block>
                              @else
                                {{ __('Create') }}
                              @endif</a>
                        </div>
                    </div>
                </div>
                <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
                    <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
                        <ul class="contact-list display-grid">
                            <li class="sidebar-title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Types' contenteditable="true">{{ __('Types') }}</editor_block>
                              @else
                                {{ __('Types') }}
                              @endif</li>
                            <li @if(empty(request()->get('type'))) class="active" @endif>
                                <a href="{{ route('notifications.index') }}" class="text-sub" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                                    <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                  @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='All' contenteditable="true">{{ __('All') }}</editor_block>
                                  @else
                                    {{ __('All') }}
                                  @endif
                                </a>
                            </li>

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
        <div class="app-wrapper">
            <div class="card-content p-0">
                <table id="notifications" class="display card card card-default border-radius-6">
                    <thead>
                    <tr>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Name' contenteditable="true">{{ __('Name') }}</editor_block>
                          @else
                            {{ __('Name') }}
                          @endif</th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Date' contenteditable="true">{{ __('Date') }}</editor_block>
                          @else
                            {{ __('Date') }}
                          @endif</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
    <script src="{{asset('js/scripts/notifications.js')}}"></script>
@endsection
