@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Form Validation')
{{-- vendor style --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
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
                  <h4 class="card-title">
                    @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Edit tariff' contenteditable="true">{{ __('Edit tariff') }}</editor_block>@else {{ __('Edit tariff') }} @endif</h4>
                </div>
              </div>
            </div>
            <div id="view-validations">
              <form class="formValidate" action="{{ route('rates.update', $rate->id) }}" id="formValidate" method="post">
                @csrf
                <div class="row">
                  <div class="input-field col s12">
                    <label for="name" class="active">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Tariff group *' contenteditable="true">{{ __('Tariff group *') }}</editor_block>@else {{ __('Tariff group *') }} @endif</label>
                    <select id="name" name="rate_group_id" data-error=".errorTxt1">
                      <option value="">{{ __('Not chosen') }}</option>
                      @forelse($rate_groups as $item)
                        <option value="{{ $item->id }}" @if($item->id == $rate->rate_group_id) selected @endif>{{ $item->name }}</option>
                      @empty
                      @endforelse
                    </select>
                    <small class="errorTxt1"></small>
                  </div>
                  <div class="input-field col s12">
                    <label for="name">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Tariff Name *' contenteditable="true">{{ __('Tariff Name *') }}</editor_block>@else {{ __('Tariff Name *') }} @endif</label>
                    <input id="name" name="name" type="text" data-error=".errorTxt1" value="{{ $rate->name }}">
                    <small class="errorTxt1"></small>
                  </div>
                  <div class="input-field col s12">
                    <label for="min">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Tariff Name *' contenteditable="true">{{ __('Tariff Name *') }}</editor_block>@else {{ __('Tariff Name *') }} @endif</label>
                    <input id="min" type="number" name="min" data-error=".errorTxt2" value="{{ number_format($rate->min, 2, '.', '') }}">
                    <small class="errorTxt2"></small>
                  </div>
                  <div class="input-field col s12">
                    <label for="max">Максимальный депозит *</label>
                    <input id="max" type="number" name="max" data-error=".errorTxt3" value="{{ number_format($rate->max, 2, '.', '') }}">
                    <small class="errorTxt3"></small>
                  </div>
                  <div class="input-field col s12">
                    <label for="daily">Суточный процент *</label>
                    <input id="daily" type="text" name="daily" data-error=".errorTxt55" value="{{ number_format($rate->daily, 2, '.', '') }}">
                    <small class="errorTxt55"></small>
                  </div>
                  <div class="input-field col s12">
                    <label for="duration">Срок действия депозита *</label>
                    <input id="duration" type="number" name="duration" data-error=".errorTxt4" value="{{ $rate->duration }}">
                    <small class="errorTxt4"></small>
                  </div>
                  <div class="input-field col s12">
                    <label for="tes">% Возврата депозита в конце срока (% или оставить пустым)</label>
                    <input id="tes" type="text" name="overall" data-error=".errorTxt4" value="{{ $rate->overall ?? '' }}">
                    <small class="errorTxt4"></small>
                  </div>
                  <div class="col s12">
                    <label for="reinvest">Возможность реинвестировать</label>
                    <p>
                      <label>
                        <input type="hidden" name="reinvest" value="0">
                        <input type="checkbox" name="reinvest" id="reinvest" value="1" {{ $rate->reinvest ? 'checked' : ''}}/>
                        <span>Да/Нет</span>
                      </label>
                    </p>
                    <div class="input-field">
                      <small class="errorTxt5"></small>
                    </div>
                  </div>
                  <div class="col s12">
                    <label for="upgradable">Возможность апгрейда</label>
                    <p>
                      <label>
                        <input type="hidden" name="upgradable" value="0">
                        <input type="checkbox" name="upgradable" id="upgradable" value="1" {{ $rate->upgradable ? 'checked' : ''}}/>
                        <span>Да/Нет</span>
                      </label>
                    </p>
                    <div class="input-field">
                      <small class="errorTxt6"></small>
                    </div>
                  </div>
                  <div class="col s12">
                    <label for="autoclose">Авто закрытие депозита</label>
                    <p>
                      <label>
                        <input type="hidden" name="autoclose" value="0">
                        <input type="checkbox" name="autoclose" id="autoclose" value="1" {{ $rate->autoclose ? 'checked' : ''}}/>
                        <span>Да/Нет</span>
                      </label>
                    </p>
                    <div class="input-field">
                      <small class="errorTxt8"></small>
                    </div>
                  </div>
                  <div class="col s12">
                    <label for="active">Активный </label>
                    <p>
                      <label>
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1" {{ $rate->active ? 'checked' : ''}}/>
                        <span>Да/Нет</span>
                      </label>
                    </p>
                    <div class="input-field">
                      <small class="errorTxt9"></small>
                    </div>
                  </div>
                  <div class="input-field col s12">
                    <button class="btn waves-effect waves-light right submit" type="submit" name="action">Сохранить
                      <i class="material-icons right">send</i>
                    </button>
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

{{-- vendor script --}}
@section('vendor-script')
  <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
  <script>
    /*
* Form Validation
*/
    $(function () {
      $("#formValidate").validate({
        rules: {
          name: {
            required: true,
            minlength: 1
          },
          min: {
            required: true,
          },
          max: {
            required: true,
          },
          duration: {
            required: true,
          },
        },
        messages: {
          name: {
            required: "Введите название тарифа",
            minlength: "Имя тарифа должно стостоять минимум из 1 символа"
          },
          min: {
            required: "Поле обязательно"
          },
          max: {
            required: "Поле обязательно"
          },
          duration: {
            required: "Поле обязательно"
          }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
      });
    });
  </script>
@endsection
