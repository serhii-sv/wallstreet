{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Invoice List')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <!-- invoice list -->
    <section class="invoice-list-wrapper section">
{{--        <div class="row">--}}
{{--            <div class="col s12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col s6 l12">--}}

{{--                            </div>--}}
{{--                            <div class="col s6 l12">--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="responsive-table">
            <table class="table verification-requests white border-radius-4 pt-1">
                <thead>
                <tr>
                    <th></th>
                    <th>
                        <span>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Email#' contenteditable="true">{{ __('Email#') }}</editor_block>
                          @else
                            {{ __('Email#') }}
                            @endif</span>
                    </th>
                    <th>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Date' contenteditable="true">{{ __('Date') }}</editor_block>
                      @else
                        {{ __('Date') }}
                      @endif</th>
                    <th>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Actions' contenteditable="true">{{ __('Actions') }}</editor_block>
                      @else
                        {{ __('Actions') }}
                      @endif</th>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
    </section>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
    <script src="{{asset('js/scripts/user-verification-requests.js')}}"></script>
@endsection
