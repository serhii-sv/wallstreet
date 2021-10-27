{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Верификация по смс')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/pricing.css')}}">
@endsection

{{-- page content --}}
@section('content')
  <div class="row">
    <div class="col s12 m12 l12">
      <div class="card card card-default scrollspy">
        <div class="card-content">
          <div class="display-flex justify-content-between">
            <h4 class="card-title">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Phone verification' contenteditable="true">{{ __('Phone verification') }}</editor_block>@else {{ __('Phone verification') }} @endif
            </h4>
          </div>
          <form action="{{ route('user.phone.verification') }}" method="post">
            @csrf
            <input type="hidden" name="verification_type" value="text">
            <input type="hidden" name="verification_enable" value="off">
            <div class="switch mb-3">
              <div class="mb-1">Верификация:</div>
              <label>
                Выключена
                <input type="checkbox" name="verification_enable" value="on" @if($verification_enable->s_value == 'on') checked @endif>
                <span class="lever"></span>
                Включена
              </label>
            </div>
            <div class="switch mb-3">
              <div class="mb-1">Способ отправки кода:</div>
              <label>
                Текстом
                <input type="checkbox" name="verification_type" value="voice" @if($verification_type->s_value == 'voice') checked @endif>
                <span class="lever"></span>
                Голосом
              </label>
            </div>
            <div class="switch mb-1">
              <label>
                Текст для смс:
                <input type="text" name="verification_text" value="{{ $verification_text->s_value }}">
              </label>
            </div>
            <div class="switch mb-1">
              <label>
                Текст для голосового:
                <input type="text" name="verification_voice_text" value="{{ $verification_voice_text->s_value }}">
              </label>
            </div>
            <button class="btn btn-success">Сохранить</button>
          </form>
        </div>
      </div>
      <div class="card card-default scrollspy">
        <div class="card-content">
          <div class="row">
            <div class="col s12">
              <div class="display-flex align-items-center" style="padding: 5px;margin-bottom: 10px;">
                <div style="width: 20%;font-weight: 900;">Login</div>
                <div style="width: 20%;font-weight: 900;">Код</div>
                <div style="width: 20%;font-weight: 900;">Тип</div>
                <div style="width: 20%;font-weight: 900;">Отправлено через</div>
                <div style="width: 20%;font-weight: 900;">Использован код</div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              @forelse($messages as $msg)
                <div class="display-flex align-items-center" style="padding: 5px;border: 1px solid #f8f8f8;">
                  <div style="width: 20%;">
                    <a href="{{ route('users.show', $msg->user->id) }}">{{ $msg->user->login }}</a>
                  </div>
                  <div style="width: 20%;">{{ $msg->code }}</div>
                  <div style="width: 20%;">{{ $msg->type }}</div>
                  <div style="width: 20%;">{{ $msg->dispatch_method }}</div>
                  <div style="width: 20%;">{{ $msg->used ? 'Да' : 'Нет' }}</div>
                </div>
              @empty
                <div>
                  Ничего нет
                </div>
              @endforelse
            </div>
          </div>
          <div class="row">
            <div class="col">
              {{ $messages->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

@section('page-script')
  <script>
  </script>
@endsection
