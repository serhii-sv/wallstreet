{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Invoice List')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/dataTables.checkboxes.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <!-- invoice list -->
    <section class="invoice-list-wrapper section">
        @include('panels.inform')
        <div class="responsive-table">
                <table class="table currency-rates white border-radius-4 pt-1">
                    <thead>
                    <tr>
                        <th></th>
                        <th>
                            <span>Валюты</span>
                        </th>
                        <th>Курс</th>
                        <th>Последнее обновление</th>
                        <th>Источник данных</th>
                        <th>Автообновление</th>
                        <th style="width: 120px !important;">Действия</th>
                        <th></th>
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
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
    <script src="{{asset('js/scripts/currency-rates.js')}}"></script>
    <script src="{{asset('js/plugins.js')}}"></script>
    <script>
        $(function () {
            $(document).ready(function() {
                $(document).on('mouseenter', '.tooltipped', function () {
                    $(this).tooltip();
                })
            });
        })
    </script>
@endsection
