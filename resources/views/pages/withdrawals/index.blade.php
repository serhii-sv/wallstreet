{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Invoice List')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
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
        @if(Session::has('message'))
            <div class="alert-wrap">
                <div class="card-alert card green">
                    <div class="card-content white-text">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                    <div>
                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <!-- create invoice button-->
        <!-- Options and filter dropdown button-->
        {{--        <div class="invoice-filter-action mr-3">--}}
        {{--            <a href="javascript:void(0)" class="btn waves-effect waves-light invoice-export border-round z-depth-4">--}}
        {{--                <i class="material-icons">picture_as_pdf</i>--}}
        {{--                <span class="hide-on-small-only">Export to PDF</span>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        {{--        <!-- create invoice button-->--}}
        {{--        <div class="invoice-create-btn">--}}
        {{--            <a href="{{asset('app-invoice-add')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">--}}
        {{--                <i class="material-icons">add</i>--}}
        {{--                <span class="hide-on-small-only">Create Invoice</span>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        <div class="filter-btn mr-1">
            <!-- Dropdown Trigger -->
{{--            <button class="search btn btn-block waves-effect waves-light mb-10">--}}
{{--                <i class="material-icons">search</i>--}}
{{--                <span>Поиск</span>--}}
{{--            </button>--}}
            {{--            <a class='dropdown-trigger btn waves-effect waves-light purple darken-1 border-round' href='#' data-target='btn-filter'>--}}
            {{--                <span class="hide-on-small-only">Filter Invoice</span>--}}
            {{--                <i class="material-icons">keyboard_arrow_down</i>--}}
            {{--            </a>--}}
            {{--            <!-- Dropdown Structure -->--}}
            {{--            <ul id='btn-filter' class='dropdown-content'>--}}
            {{--                <li><a href="#!">Paid</a></li>--}}
            {{--                <li><a href="#!">Unpaid</a></li>--}}
            {{--                <li><a href="#!">Partial Payment</a></li>--}}
            {{--            </ul>--}}
        </div>
        <div class="responsive-table">
            <table class="table invoice-data-table white border-radius-4 pt-1">
                <thead>
                <tr>
                    <!-- data table responsive icons -->
                    <th></th>
                    <!-- data table checkbox -->
                    <th></th>
                    <th>
                        <span>Email#</span>
                    </th>
                    <th>Сумма</th>
                    <th>Дата</th>
                    <th>Аплайнер</th>
                    <th>Статус</th>
                    <th>Действия</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($transactions as $transaction)
                    <tr style="color: {{ implode(',', ($transaction->user->roles->pluck('color')->toArray() ?? [])) }}">
                        <td></td>
                        <td data-transaction_id="{{ $transaction->id }}"></td>
                        <td>
                            {{ $transaction->user->email }}
                        </td>
                        <td><span class="invoice-amount">{{ $transaction->currency->symbol }}{{ number_format($transaction->amount, 2, ',', ' ') }} (${{ number_format($transaction->main_currency_amount, 2, ',', ' ') }})</span>
                        </td>
                        <td>{{ $transaction->created_at }}</td>
                        <td><span class="invoice-customer">{{ isset($transaction->user->partner) ? $transaction->user->partner->email : null }}</span></td>
                        <td>
                            @switch($transaction->approved)
                                @case(0)
                                <span class="chip lighten-5 orange orange-text">Не оплаченная заявка</span>
                                @break
                                @case(1)
                                <span class="chip lighten-5 green green-text">Оплаченная заявка</span>
                                @break
                                @case(2)
                                <span class="chip lighten-5 red red-text">Отклоненная заявка</span>
                                @break
                            @endswitch
                        </td>
                        <td>
                            <div class="invoice-action">
                                <a href="{{asset('app-invoice-view')}}" class="invoice-action-view mr-4">
                                    <i class="material-icons">remove_red_eye</i>
                                </a>
                                <a href="{{asset('app-invoice-edit')}}" class="invoice-action-edit">
                                    <i class="material-icons">edit</i>
                                </a>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
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
@endsection

{{-- page scripts --}}
@section('page-script')
    <script src="{{asset('js/scripts/app-invoice.js')}}"></script>
@endsection
