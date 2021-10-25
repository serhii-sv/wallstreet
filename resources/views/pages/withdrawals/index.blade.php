{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Invoice List')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/dataTables.checkboxes.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
  <style>
    .preloader-wrapper-div{
        padding: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
  </style>
@endsection

{{-- page content --}}
@section('content')
  <!-- Modal Structure -->
  <div id="modal" class="modal bottom-sheet">
    <div class="preloader-wrapper-div">
      <div class="preloader-wrapper active">
        <div class="spinner-layer spinner-red-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- invoice list -->
  <section class="invoice-list-wrapper section">
    
    <!-- create invoice button-->
    <div class="invoice-filter-action mr-2">
      <a href="/withdrawals?type=0" class="btn {{ request()->type == 0 || is_null(request()->type) ? 'active' : ''}} waves-effect waves-light invoice-export border-round z-depth-4" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
        <i class="material-icons">attach_money</i>
        <span class="hide-on-small-only">@if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name='Unpaid' contenteditable="true">{{ __('Unpaid') }}</editor_block>
          @else
            {{ __('Unpaid') }}
          @endif</span>
      </a>
    </div>
    <!-- create invoice button-->
    <div class="invoice-create-btn mr-2">
      <a href="/withdrawals?type=1" class="btn {{ request()->type == 1 ? 'active' : ''}} waves-effect waves-light invoice-create border-round z-depth-4" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
        <i class="material-icons">beenhere</i>
        <span class="hide-on-small-only">@if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name='Paid' contenteditable="true">{{ __('Paid') }}</editor_block>
          @else
            {{ __('Paid') }}
          @endif</span>
      </a>
    </div>
    
    <div class="invoice-create-btn">
      <a href="/withdrawals?type=2" class="btn {{ request()->type == 2 ? 'active' : ''}} waves-effect waves-light invoice-create border-round z-depth-4" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
        <i class="material-icons">block</i>
        <span class="hide-on-small-only">@if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name='Canceled' contenteditable="true">{{ __('Canceled') }}</editor_block>
          @else
            {{ __('Canceled') }}
          @endif</span>
      </a>
    </div>
    <!-- Options and filter dropdown button-->
    <div class="filter-btn">
      <!-- Dropdown Trigger -->
      <a class='dropdown-trigger btn waves-effect waves-light purple darken-1 border-round' href='#' data-target='btn-filter' @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
        <span class="hide-on-small-only">@if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name='Filtration' contenteditable="true">{{ __('Filtration') }}</editor_block>
          @else
            {{ __('Filtration') }}
          @endif</span>
        <i class="material-icons">keyboard_arrow_down</i>
      </a>
      <!-- Dropdown Structure -->
      <ul id='btn-filter' class='dropdown-content'>
        @forelse($filter_users as $user)
        <li>
          <a href="{{ request()->fullUrlWithQuery(['user'=> $user->id]) }}" class="{{ request()->user == $user->id ? 'active' : '' }}">
            {{ $user->name }}
          </a>
        </li>
        @empty
        @endforelse
      </ul>
    </div>
    @include('panels.inform')
    <div class="responsive-table">
      <form id="transactionsForm" action="/withdrawals/approve-many" method="post">
        @csrf
        <input type="hidden" name="type">
        <table class="table invoice-data-table white border-radius-4 pt-1">
          <thead>
            <tr>
              <!-- data table responsive icons -->
              <th></th>
              <!-- data table checkbox -->
              <th></th>
              <th>
                <span>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Email#' contenteditable="true">{{ __('Email#') }}</editor_block>
                  @else
                    {{ __('Email#') }}
                    @endif</span>
              </th>
              <th>
                <span>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Login#' contenteditable="true">{{ __('Login#') }}</editor_block>
                  @else
                    {{ __('Login#') }}
                    @endif</span>
              </th>
              <th>
                <span>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Upliner' contenteditable="true">{{ __('Upliner') }}</editor_block>
                  @else
                    {{ __('Upliner') }}
                    @endif</span>
              </th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Sum' contenteditable="true">{{ __('Sum') }}</editor_block>
                @else
                  {{ __('Sum') }}
                @endif</th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Date' contenteditable="true">{{ __('Date') }}</editor_block>
                @else
                  {{ __('Date') }}
                @endif</th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Requisites' contenteditable="true">{{ __('Requisites') }}</editor_block>
                @else
                  {{ __('Requisites') }}
                @endif</th>
              <th style="width: 120px !important;">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Actions' contenteditable="true">{{ __('Actions') }}</editor_block>
                @else
                  {{ __('Actions') }}
                @endif</th>
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </form>
    </div>
  </section>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
  <script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
  <script src="{{asset('js/scripts/app-invoice.js')}}"></script>
  <script src="{{asset('js/plugins.js')}}"></script>
  <script>
    $(function () {
      $(document).ready(function () {
        $(document).on('mouseenter', '.tooltipped', function () {
          $(this).tooltip();
        })
      });
    })
  </script>
  <script>
    $(document).ready(function () {
      $("body").on('click', '.external-block', function (e) {
        $('#modal').empty();
        $('#modal').append('<div class="preloader-wrapper-div">' +
            '<div class="preloader-wrapper active">' +
            '<div class="spinner-layer spinner-red-only">' +
            '<div class="circle-clipper left">' +
            '<div class="circle"></div>' +
            '</div>' +
            '<div class="gap-patch">' +
            '<div class="circle"></div>' +
            '</div>' +
            '<div class="circle-clipper right">' +
            '<div class="circle"></div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
        $('#modal').modal('open');
        var $external = $(this).attr('data-external');
        var $url = "{{ route('ajax.bin.check') }}";
        $.ajax({
          type: 'post',
          url: $url,
          data: 'card_number=' + $external,
          headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
            data = $.parseJSON(data);
            if (data.status === 'good') {
              $('#modal').empty();
              $('#modal').append(data.html);
            } else if (data.status === 'bad') {
              $('#modal').modal('close');
              M.toast({
                html: data.msg,
                classes: 'red'
              });
            }
            
          }
        });
        
      });
    });
  </script>
@endsection
