{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Blog List Page')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css"
      href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection

{{-- page content --}}
@section('content')
  <div class="section mt-2 invoice-list-wrapper" id="blog-list">
    <div class="row">
        <a href="{{ route('referrals.create') }}" class="btn btn-small float-right" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Add referral level' contenteditable="true">{{ __('Add referral level') }}</editor_block>@else {{ __('Add referral level') }} @endif</a>
        <div class="responsive-table mt-5">
          <table class="table referrals white border-radius-4 pt-1">
            <thead>
              <tr>
                <th></th>
                <th>
                  <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Level' contenteditable="true">{{ __('Level') }}</editor_block>@else {{ __('Level') }} @endif</span>
                </th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Percent' contenteditable="true">{{ __('Percent') }}</editor_block>@else {{ __('Percent') }} @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='When replenishing the balance' contenteditable="true">{{ __('When replenishing the balance') }}</editor_block>@else {{ __('When replenishing the balance') }} @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='When calculating profit' contenteditable="true">{{ __('When calculating profit') }}</editor_block>@else {{ __('When calculating profit') }} @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Actions' contenteditable="true">{{ __('Actions') }}</editor_block>@else {{ __('Actions') }} @endif</th>
              </tr>
            </thead>
            
            <tbody>
            
            </tbody>
          </table>
        </div>
        
        <div class="responsive-table mt-5">
          <table id="users" class="table white border-radius-4 pt-1">
            <thead>
              <tr>
                <th></th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='User' contenteditable="true">{{ __('User') }}</editor_block>@else {{ __('User') }} @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Name' contenteditable="true">{{ __('Name') }}</editor_block>@else {{ __('Name') }} @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Email' contenteditable="true">{{ __('Email') }}</editor_block>@else {{ __('Email') }} @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Country' contenteditable="true">{{ __('Country') }}</editor_block>@else {{ __('Country') }} @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Number of referrals' contenteditable="true">{{ __('Number of referrals') }}</editor_block>@else {{ __('Number of referrals') }} @endif</th>
                <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Link' contenteditable="true">{{ __('Link') }}</editor_block>@else {{ __('Link') }} @endif</th>
              </tr>
            </thead>
            
            <tbody>
            
            </tbody>
          </table>
        </div>

    </div>
  </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
  <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
  <script src="{{asset('js/scripts/referral.js')}}"></script>
  <script>
    $(function () {
      $('.tabs li a').click(function () {
        location.hash = $(this).attr('href')
      })
    })
  </script>
@endsection
