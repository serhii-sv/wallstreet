{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Вопросы - ответы')

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
  <style>
      .card-content {
          width: 100%;
          display: flex;
          align-items: center;
          flex-wrap: wrap;
      }

      .card-content .head {
          width: 100%;
          display: flex;
          align-items: center;
      }

      .card-header {
          border-bottom: 1px solid #e0e0e0;
          font-weight: 600;
      }

      .card-content .body {
          width: 100%;
          display: flex;
          align-items: center;
          flex-wrap: wrap;
      }

      .card-content form {

          width: 100%;
          display: flex;
          align-items: center;
          flex-wrap: wrap;
      }

      .card-content .inputs {
          width: calc((100% - 20% - 120px - 30% - 20px - 60px));
          margin: 0 10px;
      }
      .card-content .checkbox {
          width: 15%;
          margin: 0 10px;
      }
      .card-content .select {
          width: 20%;
          margin-right: 10px;
      }

      .card-content .button-block {
          width: 120px;
      }
  </style>
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
              <i class="material-icons app-header-icon text-top">perm_identity</i> Группы тарифов
            </h5>
            <div class="mt-10 pt-2">
              {{--              <a href="">Добавить </a>--}}
              {{--              <p class="m-0 subtitle font-weight-700">Общее количество вопросов - ответов</p>--}}
              {{--              <p class="m-0 text-muted">{{ $faqs_count ?? 0 }}</p>--}}
            </div>
          </div>
        </div>
        <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only">
          <i class="material-icons">menu</i>
        </a>
      </div>
    </div>
  </div>
  <!-- Sidebar Area Ends -->
  
  <!-- Content Area Starts -->
  <div class="content-area content-right">
    <div class="app-wrapper">
      @include('panels.inform')
      <div class="card mt-0 mb-0">
        <div class="card-header">
          <div class="card-content">
            <div class="select">
              Название
            </div>
            <div class="inputs">
              Описание
            </div>
            <div class="checkbox">
              Возврат средств
            </div>
            <div class="checkbox">
              Реинвест
            </div>
          </div>
        </div>
        <div class="card-content pt-0">
          <div class="body">
            @forelse($rate_groups as $item)
              <form action="{{ route('rate.groups.update') }}" method="post">
                <input type="hidden" name="id" value="{{ $item->id }}">
                @csrf
                <div class="select">
                  <input type="text" name="name" placeholder="Вопрос" value="{{ $item->name }}">
                </div>
                <div class="inputs">
                  <input type="text" name="description" placeholder="Ответ" value="{{ $item->description }}">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="hidden" name="refund_deposit" value="0">
                    <input type="checkbox" name="refund_deposit" id="refund_deposit" value="1"  @if($item->refund_deposit) checked @endif/>
                    <span>Да/Нет</span>
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="hidden" name="reinvest" value="0">
                    <input type="checkbox" name="reinvest" id="reinvest" value="1" @if($item->reinvest) checked @endif/>
                    <span>Да/Нет</span>
                  </label>
                </div>
                <div class="button-block display-flex justify-content-between">
                  <button class="btn waves-effect waves-light " style="padding: 0 15px;">
                    <i class="material-icons">save</i>
                  </button>
                </div>
              </form>
            @empty
              <div class="card-content pl-0 pb-0 pr-0">
                Записей нет
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content Area Ends -->

@endsection

{{-- vendor scripts --}}
@section('vendor-script')
@endsection

{{-- page scripts --}}
@section('page-script')

@endsection
