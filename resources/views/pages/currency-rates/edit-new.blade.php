@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Form Validation')
{{-- vendor style --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
  <style>

      :root {
          --white: #ffffff;
          --light: #f0eff3;
          --black: #000000;
          --dark-blue: #1f2029;
          --dark-light: #353746;
          --red: #da2c4d;
          --yellow: #f8ab37;
          --grey: #ecedf3;
      }

      .checkbox-tools:checked + label,
      .checkbox-tools:not(:checked) + label {
          position: relative;
          display: inline-block;
          padding: 10px 20px;
          /*width: 110px;*/
          font-size: 14px;
          line-height: 20px;
          letter-spacing: 1px;
          margin: 0 auto;
          text-align: center;
          border-radius: 4px;
          overflow: hidden;
          cursor: pointer;
          text-transform: uppercase;
          color: var(--white);
          /*-webkit-transition: all 300ms linear;*/
          /*transition: all 300ms linear;*/
      }

      .checkbox-tools:not(:checked) + label {
          background-color: var(--dark-light);
          box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
      }

      .checkbox-tools:checked + label {
          background-color: transparent;
          box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
          background-image: linear-gradient(45deg, #303f9f, #1976D2);
      }

      .checkbox-tools:not(:checked) + label:hover {
          box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
      }

      .checkbox-tools:checked + label::before,
      .checkbox-tools:not(:checked) + label::before {
          position: absolute;
          content: '';
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          border-radius: 4px;
          background-image: linear-gradient(45deg, #303f9f, #1976D2);
          z-index: -1;
      }

      .checkbox-tools:checked + label .uil,
      .checkbox-tools:not(:checked) + label .uil {
          font-size: 24px;
          line-height: 24px;
          display: block;
          padding-bottom: 10px;
      }

      .checkbox-tools[type="checkbox"]:checked,
      .checkbox-tools[type="checkbox"]:not(:checked),
      .checkbox-tools[type="radio"]:checked,
      .checkbox-tools[type="radio"]:not(:checked) {
          position: absolute;
          left: -9999px;
          width: 0;
          height: 0;
          visibility: hidden;
      }

      .checkbox:checked + label,
      .checkbox:not(:checked) + label {
          position: relative;
          /*width: 70px;*/
          display: inline-block;
          padding: 0;
          margin: 0 auto;
          text-align: center;
          height: 6px;
          border-radius: 4px;
          /* background-image: linear-gradient(298deg, var(--red), var(--yellow));*/
          z-index: 100 !important;
      }

      .checkbox:checked + label:before,
      .checkbox:not(:checked) + label:before {
          display: block;
          position: absolute;
          font-family: 'unicons';
          cursor: pointer;
          top: -17px;
          z-index: 2;
          font-size: 20px;
          line-height: 40px;
          text-align: center;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          -webkit-transition: all 300ms linear;
          transition: all 300ms linear;
      }

      .checkbox:not(:checked) + label:before {
          content: '\eac1';
          left: 0;
          color: var(--grey);
          background-color: var(--dark-light);
          box-shadow: 0 4px 4px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(26, 53, 71, 0.07);
      }

      .checkbox:checked + label:before {
          content: '\eb8f';
          left: 30px;
          color: var(--yellow);
          background-color: var(--dark-blue);
          box-shadow: 0 4px 4px rgba(26, 53, 71, 0.25), 0 0 0 1px rgba(26, 53, 71, 0.07);
      }

      .checkbox:checked ~ .section .container .row .col-12 p {
          color: var(--dark-blue);
      }

      .dashboard-send-bonus-btn {
          /* background-image: linear-gradient(45deg, #303f9f, #1976D2);*/
      }
  </style>
@endsection

{{-- page content --}}
@section('content')
  <div class="section">

    <div class="row">
      <div class="col s12">
        <div id="validations" class="card card-tabs">
          <div class="card-content">
            <div class="card-title">
              <div class="row">
                <div class="col s12 m6 l10">
                  <h4 class="card-title">Изменить курс валют {{ $rate->currency_name }}</h4>
                </div>
              </div>
            </div>
            <div id="view-validations">
              @include('panels.inform')
              <form class="formValidate" action="{{ route('currency-rates.update', $rate) }}" id="formValidate" method="post">
                @csrf
                <div class="row" style="margin-top:20px; text-align: center;">
                  <div class="col-12">
                    <input class="checkbox-tools" name="is_fixed" value="0" type="radio" id="is_not_fixed"
                        {{ (old() ? old('is_fixed',false) : !$rate->is_fixed ?? false) ? 'checked' : '' }}
                     {{--   {{ $rate->is_fixed == 0 ? 'checked' : '' }} --}} >
                    <label class="for-checkbox-tools" for="is_not_fixed">Курс валют по дате</label>
                    <input class="checkbox-tools" name="is_fixed" value="1" type="radio" id="is_fixed"{{-- {{  $rate->is_fixed == 1 ? 'checked' : '' }}--}}
                        {{ (old() ? old('is_fixed', 1) : $rate->is_fixed ?? false) ? 'checked' : '' }}>
                    <label class="for-checkbox-tools" for="is_fixed">Фиксированный курс валют</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <label for="rate">Курс*</label>
                    <input id="rate" name="rate" type="text" data-error=".errorTxt1" value="{{ $rate->s_value }}">
                    <small class="errorTxt1"></small>
                  </div>
                  <div class="col s12">
                    <label class="display-flex align-items-center" for="autoupdate">
                      Автообновление
                      <input type="hidden" name="autoupdate" value="0">
                      <input type="checkbox" name="autoupdate" id="autoupdate" {{ $rate->autoupdate ? 'checked' : '' }} value="1" />
                      <span class="ml-1"></span>
                    </label>
                  </div>

                </div>
                <div class="row not-fixed-block display-none mt-3">
                  <div class="col s12 mb-1">
                    <label class="display-flex align-items-center" for="is_random">
                      Рандомное значение
                      <input type="hidden" name="is_random" value="0">
                      <input type="checkbox" name="is_random" id="is_random" {{ (old() ? old('is_random', 1) : $exchange_rate->is_random ?? false) ? 'checked' : '' }} value="1" />
                      <span class="ml-1"></span>
                    </label>
                  </div>
                  <div class="input-field col s12">
                    <label for="min_rate">Минимальный курс</label>
                    <input id="min_rate" name="min_rate" type="text" data-error=".errorTxt1" value="{{ old('min_rate') ?? $exchange_rate->min_rate ?? '' }}">
                    <small class="errorTxt1"></small>
                  </div>
                  <div class="input-field col s12">
                    <label for="max_rate">Максимальный курс</label>
                    <input id="max_rate" name="max_rate" type="text" data-error=".errorTxt1" value="{{ old('max_rate') ?? $exchange_rate->max_rate ?? '' }}">
                    <small class="errorTxt1"></small>
                  </div>
                  <div class="input-field col s12">
                    <label for="date_start">Дата. Начало</label>
                    <input class="datepicker" id="date_start" name="date_start" type="text" value="{{ $exchange_rate && $exchange_rate->date_start ? $exchange_rate->date_start->format('d.m.Y') ?? '' : '' }}">
                  </div>
                  <div class="input-field col s12">
                    <label for="time_start">Время. Начало</label>
                    <input class="timepicker" id="time_start" name="time_start" type="text" value="{{ $exchange_rate && $exchange_rate->date_start ? $exchange_rate->date_start->format('H:i') ?? '': '' }}">
                  </div>
                  <div class="input-field col s12">
                    <label for="date_end">Дата. Конец</label>
                    <input class="datepicker" id="date_end" name="date_end" type="text" value="{{ $exchange_rate && $exchange_rate->date_end ? $exchange_rate->date_end->format('d.m.Y') ?? '' : '' }}">
                  </div>
                  <div class="input-field col s12">
                    <label for="time_end">Время. Конец</label>
                    <input class="timepicker" id="time_end" name="time_end" type="text" value="{{ $exchange_rate && $exchange_rate->date_end ? $exchange_rate->date_end->format('H:i') ?? '' : '' }}">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <button class="btn waves-effect waves-light right submit" type="submit" name="action">Сохранить</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('page-script')
  <script>
    $(document).ready(function () {
      check_fixed_input();
      $(".checkbox-tools[name='is_fixed']").on('change', function () {
        check_fixed_input();
      });
      function check_fixed_input(){
        var $val = $(".checkbox-tools[name='is_fixed']:checked").val();
        if ($val == '0'){
          $(".not-fixed-block").removeClass('display-none');
        }else{
          $(".not-fixed-block").addClass('display-none');
        }
      }

      $('.datepicker').datepicker({
        minDate: new Date(),
        format: 'dd.mm.yyyy',
      });
      $('.timepicker').timepicker({
        twelveHour: false,
      });
    });
  </script>
@endsection
