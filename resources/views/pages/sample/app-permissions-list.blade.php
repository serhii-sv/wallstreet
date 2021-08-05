{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Права')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
  {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}
  <!-- users edit start -->
  <div class="section users-edit">
    <div class="card">
      <div class="card-content">
      @include('panels.inform')
      <!-- <div class="card-body"> -->
        <form action="{{ route('permissions.store') }}" method="post">
          @csrf
          <h6>Добавить права</h6>
          
          <div class="row">
            <div class="input-field col s6">
              <input id="first_name" type="text" name="name" placeholder="">
              <label for="first_name">Название</label>
            </div>
          </div>
          <button class="btn waves-effect gradient-45deg-green-teal" type="submit" name="action">
            Добавить
            <i class="material-icons ">add</i>
          </button>
        </form>
        
        <!-- </div> -->
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-content">
      <h6>Список прав</h6>
      <div style="display: flex;align-items: center;margin-bottom: 10px;">
        <div style="width: 50%">Название</div>
      </div>
      
      @forelse($permissions as $permission)
        <div style="padding: 10px 0;border-bottom: 1px solid #939393;">
          <form action="{{ route('permissions.update', $permission) }}" method="post" style="display: flex;align-items: center;">
            @csrf
            {{ method_field('PATCH') }}
            <div style="width: 50%">
              <span class="users-view-status ">
                <input
                    class="lighten-5 chip green green-text"
                    name="edit_name"
                    type="text"
                    value="{{ $permission->name ?? ''}}">
              </span>
            </div>
            <div style="width: 15%;margin-left: 25px;">
              <button class="width-100 btn waves-effect waves-light gradient-45deg-green-teal z-depth-3">Сохранить</button>
            </div>
            <div style="width: 15%;margin-left: 25px;">
              <a class="width-100 waves-effect waves-light btn gradient-45deg-red-pink z-depth-3 mr-1 mb-2"
                  href="{{ route('permissions.delete', $permission) }}"
                  onclick="return confirm('Точно удалить??')">
                Удалить
              </a>
            </div>
          </form>
        </div>
      @empty
      @endforelse

    </div>
  </div>
  <!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')

@endsection