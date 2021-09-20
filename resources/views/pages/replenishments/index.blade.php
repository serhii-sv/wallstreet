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
    
    <!-- create invoice button-->
    <!-- Options and filter dropdown button-->
    <div class="invoice-filter-action mr-3">
      <a href="/replenishments?type=0" class="btn {{ request()->type == 0 || is_null(request()->type) ? 'active' : ''}} waves-effect waves-light invoice-export border-round z-depth-4">
        <i class="material-icons">attach_money</i>
        <span class="hide-on-small-only">Неоплаченные</span>
      </a>
    </div>
    <!-- create invoice button-->
    <div class="invoice-create-btn">
      <a href="/replenishments?type=1" class="btn {{ request()->type == 1 ? 'active' : ''}} waves-effect waves-light invoice-create border-round z-depth-4">
        <i class="material-icons">beenhere</i>
        <span class="hide-on-small-only">Оплаченные</span>
      </a>
    </div>
    <div class="filter-btn">
      <!-- Dropdown Trigger -->
      <a class='dropdown-trigger btn waves-effect waves-light purple darken-1 border-round' href='#' data-target='btn-filter'>
        <span class="hide-on-small-only">Фильтрация</span>
        <i class="material-icons">keyboard_arrow_down</i>
      </a>
      <!-- Dropdown Structure -->
      <ul id='btn-filter' class='dropdown-content'>
        <li>
          <a href="{{ request()->fullUrlWithQuery(['field' => 'created_at', 'order' => 'desc']) }}" class="{{ request()->field == 'created_at' && request()->order == 'desc' ? 'active' : '' }}">Дата по убыванию</a>
        </li>
        <li>
          <a href="{{ request()->fullUrlWithQuery(['field' => 'created_at', 'order' => 'asc']) }}" class="{{ request()->field == 'created_at' && request()->order == 'asc' ? 'active' : '' }}">Дата по возростанию</a>
        </li>
        <li>
          <a href="{{ request()->fullUrlWithQuery(['field' => 'amount', 'order' => 'desc']) }}" class="{{ request()->field == 'amount' && request()->order == 'desc' ? 'active' : '' }}">Сумма по убыванию</a>
        </li>
        <li>
          <a href="{{ request()->fullUrlWithQuery(['field' => 'amount', 'order' => 'asc']) }}" class="{{ request()->field == 'amount' && request()->order == 'asc' ? 'active' : '' }}">Сумма по возростанию</a>
        </li>
        @forelse($filter_users as $user)
          <li>
            <a href="{{ request()->fullUrlWithQuery(['user'=> $user->id]) }}" class="{{ request()->user == $user->id ? 'active' : '' }}">
              {{ $user->name }}
            </a>
          </li>
        @empty
        @endforelse
      </ul>
    </div>
    @include('panels.inform')
    <div class="responsive-table">
      <form id="transactionsForm" action="/replenishments/approve-many" method="post">
        @csrf
        <input type="hidden" name="type">
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
              <th>
                <span>Login#</span>
              </th>
              <th>Сумма</th>
              <th>Дата</th>
              <th>Действия</th>
              <th></th>
            </tr>
          </thead>
          
          <tbody>
          
          </tbody>
        </table>
      </form>
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
  <script src="{{asset('js/scripts/app-replenishment.js')}}"></script>
  <script src="{{asset('js/plugins.js')}}"></script>
  <script>
    $(function () {
      $(document).ready(function () {
        $(document).on('mouseenter', '.tooltipped', function () {
          $(this).tooltip();
        })
      });
    })
  </script>
@endsection
