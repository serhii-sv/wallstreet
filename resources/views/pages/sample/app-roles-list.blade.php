{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Роли')

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
        <form action="{{ route('roles.store') }}" method="post">
          @csrf
          <h6>Добавить роль</h6>
          
          <div class="row">
            <div class="input-field col s6">
              <input id="first_name" type="text" name="name" placeholder="Admin">
              <label for="first_name">Название</label>
            </div>
            <div class="input-field col s6 colorpicker-container">
              <input class="color_picker" id="color_picker" type="text" name="color" placeholder="#000000" autocomplete="off">
              <label for="color_picker">Цвет</label>
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
      <h6>Список ролей</h6>
      <div style="display: flex;align-items: center;margin-bottom: 10px;">
        <div style="width: 25%">Название</div>
        <div style="width: 25%;margin-left: 25px;">Цвет</div>
      </div>
      
      @forelse($roles as $role)
        
        
        <div style="padding: 10px 0;border-bottom: 1px solid #939393;">
          <form action="{{ route('roles.update', $role) }}" method="post" style="display: flex;align-items: center;">
            @csrf
            {{ method_field('PATCH') }}
            <div style="width: 25%">
              <span class="users-view-status ">
                <input
                    class="lighten-5 chip green green-text"
                    name="name"
                    type="text"
                    value="{{  $role->name ?? ''}}"
                    @if($role->is_fixed) readonly="readonly" @endif>
              </span>
            </div>
            <div style=" width: 25%;margin-left: 25px;" class="">
              <div style="display: flex;align-items: center;width: 100%;">
                <i class="material-icons material-icons-{{ $role->id }} small-icons mr-2" style="{{ 'color:'. $role->color ?? '' }};">
                  fiber_manual_record
                </i>
                
                <input class="@if(!$role->is_fixed) color_picker_each_{{ $role->id  }} @endif"
                    data-id="{{ $role->id }}"
                    type="text"
                    name="color"
                    value="{{ $role->color ?? '' }}"
                    placeholder="@if(!$role->color) Без цвета @endif"
                    autocomplete="off"
                    @if($role->is_fixed) readonly="readonly" @endif>
              
              </div>
              <div class="colorpicker-container-{{$role->id}}"></div>
            </div>
            @if($role->is_fixed)
              Недоступна для изменений
            @else
              <div style="width: 15%;margin-left: 25px;">
                <button class="width-100 btn waves-effect waves-light gradient-45deg-green-teal z-depth-3">Сохранить</button>
              </div>
              <div style="width: 15%;margin-left: 25px;">
                <a class="width-100 waves-effect waves-light btn gradient-45deg-red-pink z-depth-3 mr-1 mb-2"
                    href="{{ route('roles.delete', $role) }}"
                    onclick="return confirm('Точно удалить??')">
                  Удалить
                </a>
              </div>
            @endif
          </form>
        </div>
      @empty
      @endforelse
      
      {{--      @forelse($roles as $role)
              <span class="users-view-status chip green lighten-5 green-text">{{ $role->name ?? ''}}</span>
              <div>{{ $role->color }}</div>
            @empty
            @endforelse--}}
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
  
  <script>
    $(document).ready(function () {
      @forelse($roles as $role)
      $('.color_picker_each_{{ $role->id }}').colorpicker({
        container: '.colorpicker-container-{{$role->id}}',
      });
      $('.color_picker_each_{{ $role->id }}').colorpicker().on('changeColor.colorpicker', function (event) {
        $('.material-icons-{{ $role->id }}').css('color', event.color.toHex())
      });
      @empty
      @endforelse
    });
  </script>
@endsection