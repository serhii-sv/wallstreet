{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Депозиты')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
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
                  <a href="{{ route('deposits.index', array_add(request()->except('page', 'status'),'status', $status ) ) }}" class="text-sub">
                    <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                    {{ $key }}
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
                <th style=" padding-left: 20px;">Пользователь</th>
                <th>Сумма инвестиций</th>
                <th>Начислено</th>
                <th>Осталось начислить</th>
                <th>Следующее начисление</th>
                <th>Дата открытия</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @if(isset($deposits) && !empty($deposits))
                @foreach($deposits as $item)
                  <tr>
                    <td style=" padding-left: 20px;">@if($item->user->email)
                        <a href="{{ route('users.show', $item->user->id) }}">
                          {{ $item->user->email }}
                        </a>
                      @else Не указано @endif
                    </td>
                    <td>{{ "$ " . number_format($item->invested, 2, '.', ',') ?? 0  ?? 'Не указано' }}</td>
                    <td>
                      <span class="badge  green-text  lighten-5 text-accent-4">$ {{ number_format($item->total_assessed(), 2, '.', ',') ?? 0 }}</span>
                    </td>
                    <td>{{  '?' }}</td>
                    <td>{{  '?' }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    <td class="center-align">
                      <a href="{{ route('deposits.show', $item->id) }}">Открыть</a>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <div>
                {{ $deposits->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </div>
  <!-- Content Area Ends -->

@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
  <script src="{{asset('js/scripts/app-contacts.js')}}"></script>
@endsection
