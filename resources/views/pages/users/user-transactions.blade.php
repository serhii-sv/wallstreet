{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Contact')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
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
                        <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">receipt</i> Транзакции
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
                                    <a href="{{ route('transactions.index', array_add(request()->except('page', 'type'),'type', $type->id) ) }}" class="text-sub">
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
            <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
                <div class="card-content p-0">
                    <table id="data-table-contact" class="display subscription-table responsive-table highlight" style="width:100%;">
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
                        @if(isset($transactions) && !empty($transactions))
                            @foreach($transactions as $operation)
                                <tr>
{{--                                    <td style=" padding-left: 20px;">@if($operation->user->email)<a href="{{ route('users.show', $operation->user->id) }}">{{ $operation->user->email }}</a> @else Не указано @endif</td>--}}
                                    <td style="padding-left: 20px;">{{ __('locale.' . $operation->type->name) ?? 'Не указано' }}</td>
                                    <td>
                                        <span class="badge  green-text  lighten-5 text-accent-4">$ {{ number_format($operation->main_currency_amount, 2, '.', ',') ?? 0 }}</span>
                                    </td>
                                    <td>{{ $operation->paymentSystem->name ?? 'Не указано' }}</td>
                                    <td>{{ $operation->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="">
                                        <a href="{{ route('transactions.show', $operation->id) }}">Показать</a>
                                        /
                                        <a href="{{ route('user-transactions.destroy', [$user->id, $operation->id]) }}" class="delete-transaction">Удалить</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                {{ $transactions->appends(request()->except('page'))->links() }}
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
