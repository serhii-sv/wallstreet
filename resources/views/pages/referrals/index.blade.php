{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

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

@section('title')
    {{ __('Referral levels') }}
@endsection

@section('content')
    <section class="invoice-list-wrapper section">
        <a href="{{ route('referrals.create') }}" class="btn btn-small float-right">Добавить реферальный уровень</a>
        <div class="responsive-table">
            <table class="table referrals white border-radius-4 pt-1">
                <thead>
                <tr>
                    <th></th>
                    <th>
                        <span>Уровень</span>
                    </th>
                    <th>Процент</th>
                    <th>При пополнении баланса</th>
                    <th>При пополнении прибыли</th>
                    <th>При перезарядке задачи</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>

        <div class="responsive-table">
            <table id="users" class="table white border-radius-4 pt-1">
                <thead>
                <tr>
                    <th></th>
                    <th>Пользователь</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Страна</th>
                    <th>Количество рефералов</th>
                    <th>Ссылка</th>
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
    <script src="{{asset('js/scripts/referral.js')}}"></script>
@endsection
