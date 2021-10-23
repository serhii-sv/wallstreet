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
                        <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">receipt</i>
                          @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Transactions' contenteditable="true">{{ __('Transactions') }}</editor_block>
                          @else
                            {{ __('Transactions') }}
                          @endif
                        </h5>
                        <div class="mt-10 pt-2">
                            <p class="m-0 subtitle font-weight-700">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Total number of transactions' contenteditable="true">{{ __('Total number of transactions') }}</editor_block>
                              @else
                                {{ __('Total number of transactions') }}
                              @endif</p>
                            <p class="m-0 text-muted">{{ $transactions_count ?? 0 }}</p>
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
                                <a href="{{ route('transactions.index') }}" class="text-sub" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                                    <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                  @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='All' contenteditable="true">{{ __('All') }}</editor_block>
                                  @else
                                    {{ __('All') }}
                                  @endif
                                </a>
                            </li>
                            @forelse($transaction_types as $type)
                                <li @if(request()->get('type') === $type->id) class="active" @endif>
                                    <a href="{{ route('transactions.index', array_add(request()->except('page', 'type'),'type', $type->id) ) }}"
                                       class="text-sub">
                                        <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                        {{  __('locale.' . $type->name)}}
                                    </a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only"><i
                        class="material-icons">menu</i></a>
            </div>
        </div>
    </div>
    <!-- Sidebar Area Ends -->
    <style>
      #transactions_wrapper{
          overflow: auto;
      }
    </style>
    <!-- Content Area Starts -->
    <div class="content-area content-right">
        <div class="app-wrapper">
            <div class="card-content p-0">
                <table id="transactions" class="display card card card-default scrollspy border-radius-6">
                    <thead>
                    <tr>
                        <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='id' contenteditable="true">{{ __('id') }}</editor_block> @else {{ __('id') }} @endif</th>
                        <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='User' contenteditable="true">{{ __('User') }}</editor_block> @else {{ __('User') }} @endif</th>
                        <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Type of' contenteditable="true">{{ __('Type of') }}</editor_block> @else{{ __('Type of') }} @endif</th>
                        <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Sum' contenteditable="true">{{ __('Sum') }}</editor_block>@else {{ __('Sum') }} @endif</th>
                        <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block> @else {{ __('Payment system') }} @endif</th>
                        <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Date of operation' contenteditable="true">{{ __('Date of operation') }}</editor_block> @else {{ __('Date of operation') }} @endif</th>
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
    <script src="{{asset('js/scripts/app-invoice.js')}}"></script>
@endsection

<style>
    #transactions th {
        white-space: break-spaces;
    }
</style>

