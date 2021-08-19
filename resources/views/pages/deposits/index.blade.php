{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Депозиты')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
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
                        <h5 class="m-0 sidebar-title">
                            <i class="material-icons app-header-icon text-top">receipt</i>
                            Депозиты
                        </h5>
                        <div class="mt-10 pt-2">
                            <p class="m-0 subtitle font-weight-700">Общее количество депозитов</p>
                            <p class="m-0 text-muted">{{ $deposits_count ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
                    <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
                        <ul class="contact-list display-grid">
                            <li class="sidebar-title">Статус</li>
                            <li @if(empty(request()->get('status'))) class="active" @endif>
                                <a href="{{ route('deposits.index') }}" class="text-sub">
                                    <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                    Все
                                </a>
                            </li>
                            @forelse($deposits_status as $key => $status)
                                <li @if(request()->get('status') === $status) class="active" @endif>
                                    <a href="{{ route('deposits.index', array_add(request()->except('page', 'status'),'status', $status ) ) }}"
                                       class="text-sub">
                                        <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                        {{ $key }}
                                    </a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div id="sidebar-list" class=" sidebar-menu list-group position-relative animate fadeLeft delay-1"
                     style="position:relative !important;">
                    <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
                        <ul class="contact-list display-grid">
                            <li class="sidebar-title">Тарифные планы</li>
                            <li @if(empty(request()->get('rate'))) class="active" @endif>
                                <a href="{{ route('deposits.index') }}" class="text-sub">
                                    <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                    Все
                                </a>
                            </li>
                            @forelse($deposits_rates as $key => $rate)
                                <li @if(request()->get('rate') === $rate->id) class="active" @endif>
                                    <a href="{{ route('deposits.index', array_add(request()->except('page', 'rate'),'rate', $rate->id ) ) }}"
                                       class="text-sub">
                                        <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                        {{ $rate->name }}
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
                <table id="deposits" class="display card card card-default scrollspy border-radius-6">
                    <thead>
                    <tr>
                        <th>Пользователь</th>
                        <th>Сумма инвестиций</th>
                        <th>Начислено</th>
                        <th>Осталось начислить</th>
                        <th>Следующее начисление</th>
                        <th>Дата открытия</th>
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
    #deposits th {
        white-space: break-spaces;
    }
</style>
