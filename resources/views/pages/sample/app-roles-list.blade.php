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
          <h6>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Add Role' contenteditable="true">{{ __('Add Role') }}</editor_block>@else {{ __('Add Role') }} @endif</h6>
          
          <div class="row">
            <div class="input-field col s6">
              <input id="first_name" type="text" name="name" placeholder="Admin">
              <label for="first_name">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Name' contenteditable="true">{{ __('Name') }}</editor_block>@else {{ __('Name') }} @endif</label>
            </div>
            <div class="input-field col s6 colorpicker-container">
              <input class="color_picker" id="color_picker" type="text" name="color" placeholder="#000000" autocomplete="off">
              <label for="color_picker">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Color' contenteditable="true">{{ __('Color') }}</editor_block>@else {{ __('Color') }} @endif</label>
            </div>
          </div>
          <button class="btn waves-effect gradient-45deg-green-teal" type="submit" name="action" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
            @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Add' contenteditable="true">{{ __('Add') }}</editor_block>@else {{ __('Add') }} @endif
            <i class="material-icons ">add</i>
          </button>
        </form>
        
        <!-- </div> -->
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-content">
      <h6>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='List of roles' contenteditable="true">{{ __('List of roles') }}</editor_block>@else {{ __('List of roles') }} @endif</h6>
      <div style="display: flex;align-items: center;margin-bottom: 10px;">
        <div style="width: 25%">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Name' contenteditable="true">{{ __('Name') }}</editor_block>@else {{ __('Name') }} @endif</div>
        <div style="width: 25%;margin-left: 25px;">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Color' contenteditable="true">{{ __('Color') }}</editor_block>@else {{ __('Color') }} @endif</div>
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
              @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Not available for changes' contenteditable="true">{{ __('Not available for changes') }}</editor_block>@else {{ __('Not available for changes') }} @endif
            @else
              <div style="width: 15%;margin-left: 25px;">
                <button class="width-100 btn waves-effect waves-light gradient-45deg-green-teal z-depth-3" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Save' contenteditable="true">{{ __('Save') }}</editor_block>@else {{ __('Save') }} @endif</button>
              </div>
              <div style="width: 15%;margin-left: 25px;">
                <a class="width-100 waves-effect waves-light btn gradient-45deg-red-pink z-depth-3 mr-1 mb-2"
                    href="{{ route('roles.delete', $role) }}"
                    onclick="return confirm('Точно удалить??')" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Delete' contenteditable="true">{{ __('Delete') }}</editor_block>@else {{ __('Delete') }} @endif
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