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
          width: calc((100% - 120px - 15% - 10px - 60px) / 2);
          margin: 0 10px;
      }

      .card-content .select {
          width: 15%;
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
              <i class="material-icons app-header-icon text-top">perm_identity</i> Вопросы - ответы
            </h5>
            <div class="mt-10 pt-2">
              {{--              <a href="">Добавить </a>--}}
              {{--              <p class="m-0 subtitle font-weight-700">Общее количество вопросов - ответов</p>--}}
              {{--              <p class="m-0 text-muted">{{ $faqs_count ?? 0 }}</p>--}}
            </div>
          </div>
        </div>
        <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
          <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
            <ul class="contact-list display-grid">
              <li class="sidebar-title">Языки</li>
              <li @if(empty(request()->get('language_id'))) class="active" @endif>
                <a href="{{ route('faq.index') }}" class="text-sub">
                  Все
                </a>
              </li>
              @forelse($languages as $language)
                <li @if(request()->get('language_id') === $language->id) class="active" @endif>
                  <a href="{{ route('faq.index', array_add(request()->except('page', 'language_id'),'language_id', $language->id) ) }}" data-role_id="{{ $language->id }}" class="text-sub">
                    {{ $language->name }}
                  </a>
                </li>
              @empty
              @endforelse
            </ul>
          
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
      <div class="card mt-0">
        <form action="{{ route('faq.add') }}" method="post">
          @csrf
          <div class="card-content">
            <div class="select">
              <select name="language_id">
                @forelse($languages as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="inputs">
              <input type="text" name="question" placeholder="Вопрос">
            </div>
            <div class="inputs">
              <input type="text" name="answer" placeholder="Ответ">
            </div>
            <div class="button-block">
              <button class="btn">Добавить</button>
            </div>
          </div>
        </form>
        @include('panels.inform')
      </div>
      <div class="card mt-0 mb-0">
        <div class="card-header">
          <div class="card-content">
            <div class="select">
              Язык
            </div>
            <div class="inputs">
              Вопрос
            </div>
            <div class="inputs">
              Ответ
            </div>
          </div>
        </div>
        <div class="card-content pt-0">
          <div class="body">
            @forelse($faqs as $faq)
              <form action="{{ route('faq.update') }}" method="post">
                <input type="hidden" name="id" value="{{ $faq->id }}">
                @csrf
                <div class="select">
                  <select name="language_id">
                    <option value="">Не выбрано</option>
                    @forelse($languages as $item)
                      <option value="{{ $item->id }}" @if($faq->language_id === $item->id) selected="selected" @endif>{{ $item->name }}</option>
                    @empty
                    @endforelse
                  </select>
                </div>
                <div class="inputs">
                  <input type="text" name="question" placeholder="Вопрос" value="{{ $faq->question }}">
                </div>
                <div class="inputs">
                  <input type="text" name="answer" placeholder="Ответ" value="{{ $faq->answer }}">
                </div>
                <div class="button-block display-flex justify-content-between">
                  <button class="btn waves-effect waves-light " style="padding: 0 15px;">
                    <i class="material-icons">save</i>
                  </button>
                  <a class="btn  waves-effect waves-light" href="{{ route('faq.delete', $faq->id) }}" onclick="confirm('Уверены?')" style="padding: 0 15px;">
                    <i class="material-icons">clear</i>
                  </a>
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
      {{ $faqs->appends(request()->except(['page']))->links() }}
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
