{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Kanban')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/jkanban/jkanban.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/quill/quill.snow.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/chartist-js/chartist.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/chartist-js/chartist-plugin-tooltip.css')}}">
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
  <div class="sidebar-left sidebar-fixed">
    <div class="sidebar">
      <div class="sidebar-content">
        <div class="sidebar-header">
          <div class="sidebar-details">
            <h5 class="m-0 sidebar-title">
              <i class="material-icons app-header-icon text-top">receipt</i>
              Обмен валют
            </h5>
            <div class="mt-10 pt-2">
              <p class="m-0 subtitle font-weight-700">Общее количество обменов</p>
              <p class="m-0 text-muted">{{ $exchanges_count ?? 0 }}</p>
            </div>
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
        <table class="display card card card-default scrollspy border-radius-6">
          <thead>
            <tr>
              <th class="pl-2">Пользователь</th>
              <th>Сколько внёс</th>
              <th>Сколько получил</th>
              <th>Комиссия</th>
              <th>Дата открытия</th>
            </tr>
          </thead>
          <tbody>
            @foreach($currency_exchange as $item)
              <tr>
                <td class="pl-2">{{ $item->user->login }}</td>
                <td>
                  <span class="display-block">{{ $item->amount_out }}{{ $item->currency_out()->first()->symbol }}</span>
                  <span class="badge border-round gradient-45deg-purple-deep-orange gradient-shadow">{{ $item->main_currency_amount_out }}$</span>
                </td>
                <td>
                  <span class="display-block">{{ $item->amount_in }}{{ $item->currency_in()->first()->symbol }}</span>
                  <span class="badge border-round gradient-45deg-purple-deep-orange gradient-shadow">{{ $item->main_currency_amount_in }}$</span>
                </td>
                <td>
                  {{ $item->commission }}$
                </td>
                <td>{{ $item->created_at->format("d.m.Y H:i:s") }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $currency_exchange->links() }}
      </div>
    </div>
  </div>

@endsection

{{-- vendor scripts --}}
@section('vendor-script')

@endsection

{{-- page scripts --}}
@section('page-script')
  <script>
  
  </script>
@endsection
