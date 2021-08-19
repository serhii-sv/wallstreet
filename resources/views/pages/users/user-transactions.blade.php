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
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
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
                            Транзакции
                        </h5>
                        <div class="mt-10 pt-2">
                            <p class="m-0 subtitle font-weight-700">Общее количество транзакций</p>
                            <p class="m-0 text-muted">{{ $transactions_count ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
                    <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
                        <ul class="contact-list display-grid">
                            <li class="sidebar-title">Типы</li>
                            <li @if(empty(request()->get('type'))) class="active" @endif>
                                <a href="{{ route('transactions.index') }}" class="text-sub">
                                    <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                    Все
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

    <!-- Content Area Starts -->
    <div class="content-area content-right">
        <div class="app-wrapper">
            <div class="card-content p-0">
                <table id="transactions"
                       class="display subscription-table card card card-default responsive-table highlight"
                       style="width:100%;">
                    <thead>
                    <tr>
                        {{--                           <th style=" padding-left: 20px;">Пользователь</th>--}}
                        <th style="padding-left: 20px;">Тип</th>
                        <th>Сумма</th>
                        <th>Платёжная система</th>
                        <th>Дата операции</th>
                        <th>Действия</th>
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
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
    <script src="{{asset('js/scripts/app-contacts.js')}}"></script>
    <script>
        $("#transactions").DataTable({
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            order: [3, 'asc'],
            aoColumns: [
                {
                    data: 'type_name',
                    searchable: true,
                    bSortable: false
                },
                {
                    data: 'amount',
                    searchable: true,
                    bSortable: false
                },
                {
                    data: 'paymentSystem_name',
                    searchable: true,
                    bSortable: false
                },
                {
                    data: 'created_at',
                    searchable: true,
                    bSortable: true
                },
                {
                    data: 'actions',
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
            }
        });

        $(document).on('click', '.delete-transaction', function () {
            swal({
                title: "Вы уверены что хотите удалить этоту транзакцию?",
                // text: "You will not be able to recover this imaginary file!",
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: "Отменить",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Подтвердить",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                }
            }).then((result) => {
                if (result) {
                    location.href = $(this).attr('href')
                }
            })
            return false;
        })
    </script>
@endsection
