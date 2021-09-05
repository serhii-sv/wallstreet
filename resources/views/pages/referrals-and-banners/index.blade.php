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
            <div class="col s12">
                <ul class="tabs text-center">
                    <li class="tab col m3" style="width: 50%"><a class="active" href="#referrals">Реферальные уровни</a></li>
                    <li class="tab col m3" style="width: 50%"><a href="#banners">Промо</a></li>
                </ul>
            </div>
            <div id="referrals" class="col s12 mt-2">
                <a href="{{ route('referrals.create') }}" class="btn btn-small float-right">Добавить реферальный уровень</a>
                <div class="responsive-table mt-5">
                    <table class="table referrals white border-radius-4 pt-1">
                        <thead>
                        <tr>
                            <th></th>
                            <th>
                                <span>Уровень</span>
                            </th>
                            <th>Процент</th>
                            <th>При пополнении баланса</th>
                            <th>При начислении прибыли</th>
                            <th>Действия</th>
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
            </div>
            <div id="banners" class="col s12 mt-2">
                <a href="{{ route('banners.create') }}" class="btn btn-small float-right">Добавить банер</a>
                <div class="responsive-table mt-5">
                    <table class="table banners white border-radius-4 pt-1">
                        <thead>
                        <tr>
                            <th></th>
                            <th>
                                <span>Заголовок</span>
                            </th>
                            <th>Размер</th>
                            <th>Пример</th>
                            <th>Действия</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
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
    <script src="{{asset('js/scripts/banners.js')}}"></script>
    <script>
        $(function () {
            $('.tabs li a').click(function () {
                location.hash = $(this).attr('href')
            })
        })
    </script>
@endsection
