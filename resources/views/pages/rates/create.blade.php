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
                                    <h4 class="card-title">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Add tariff' contenteditable="true">{{ __('Add tariff') }}</editor_block>@else {{ __('Add tariff') }} @endif</h4>
                                </div>
                            </div>
                        </div>

                        @include('panels.inform')

                        <div id="view-validations">
                            <form class="formValidate" action="{{ route('rates.store') }}" id="formValidate" method="post">
                                @csrf
                                <div class="row">
                                  <div class="input-field col s12">
                                    <label for="name" class="active">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Tariff group *' contenteditable="true">{{ __('Tariff group *') }}</editor_block>@else {{ __('Tariff group *') }} @endif</label>
                                    <select id="name" name="rate_group_id" data-error=".errorTxt1">
                                      <option value="">{{ __('Not chosen') }}</option>
                                      @forelse($rate_groups as $item)
                                        <option value="{{ $item->id }}" @if($item->id == old('rate_group_id')) selected @endif>{{ $item->name }}</option>
                                      @empty
                                      @endforelse
                                    </select>
                                    <small class="errorTxt1"></small>
                                  </div>
                                    <div class="input-field col s12">
                                        <label for="name">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Tariff Name *' contenteditable="true">{{ __('Tariff Name *') }}</editor_block>@else {{ __('Tariff Name *') }} @endif</label>
                                        <input id="name" name="name" type="text" data-error=".errorTxt1">
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="min">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Minimum deposit *' contenteditable="true">{{ __('Minimum deposit *') }}</editor_block>@else {{ __('Minimum deposit *') }} @endif</label>
                                        <input id="min" type="number" name="min" data-error=".errorTxt2">
                                        <small class="errorTxt2"></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="max">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Maximum deposit *' contenteditable="true">{{ __('Maximum deposit *') }}</editor_block>@else {{ __('Maximum deposit *') }} @endif</label>
                                        <input id="max" type="number" name="max" data-error=".errorTxt3">
                                        <small class="errorTxt3"></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="daily">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Daily percentage *' contenteditable="true">{{ __('Daily percentage *') }}</editor_block>@else {{ __('Daily percentage *') }} @endif</label>
                                        <input id="daily" type="text" name="daily" data-error=".errorTxt55">
                                        <small class="errorTxt55"></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="duration">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Deposit validity *' contenteditable="true">{{ __('Deposit validity *') }}</editor_block>@else {{ __('Deposit validity *') }} @endif</label>
                                        <input id="duration" type="number" name="duration" data-error=".errorTxt4">
                                        <small class="errorTxt4"></small>
                                    </div>
                                  <div class="input-field col s12">
                                    <label for="tes">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='% Return of the deposit at the end of the term (% or leave blank)' contenteditable="true">{{ __('% Return of the deposit at the end of the term (% or leave blank)') }}</editor_block>@else {{ __('% Return of the deposit at the end of the term (% or leave blank)') }} @endif</label>
                                    <input id="tes" type="text" name="overall" data-error=".errorTxt4" value="{{ $rate->overall ?? 0 }}">
                                    <small class="errorTxt4"></small>
                                  </div>
                                    <div class="col s12">
                                        <label for="reinvest">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='The ability to reinvest' contenteditable="true">{{ __('The ability to reinvest') }}</editor_block>@else {{ __('The ability to reinvest') }} @endif</label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="reinvest" value="0">
                                                <input type="checkbox" name="reinvest" id="reinvest" value="1"/>
                                                <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Yes/No' contenteditable="true">{{ __('Yes/No') }}</editor_block>@else {{ __('Yes/No') }} @endif</span>
                                            </label>
                                        </p>
                                        <div class="input-field">
                                            <small class="errorTxt5"></small>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <label for="upgradable">
                                          @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Upgradeability' contenteditable="true">{{ __('Upgradeability') }}</editor_block>@else {{ __('Upgradeability') }} @endif</label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="upgradable" value="0">
                                                <input type="checkbox" name="upgradable" id="upgradable" value="1"/>
                                                <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Yes/No' contenteditable="true">{{ __('Yes/No') }}</editor_block>@else {{ __('Yes/No') }} @endif</span>
                                            </label>
                                        </p>
                                        <div class="input-field">
                                            <small class="errorTxt6"></small>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <label for="autoclose">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Auto closing of the deposit' contenteditable="true">{{ __('Auto closing of the deposit') }}</editor_block>@else {{ __('Auto closing of the deposit') }} @endif</label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="autoclose" value="0">
                                                <input type="checkbox" name="autoclose" id="autoclose" value="1"/>
                                                <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Yes/No' contenteditable="true">{{ __('Yes/No') }}</editor_block>@else {{ __('Yes/No') }} @endif</span>
                                            </label>
                                        </p>
                                        <div class="input-field">
                                            <small class="errorTxt8"></small>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <label for="active">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Active' contenteditable="true">{{ __('Active') }}</editor_block>@else {{ __('Active') }} @endif </label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="active" value="0">
                                                <input type="checkbox" name="active" id="active" value="1"/>
                                                <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Yes/No' contenteditable="true">{{ __('Yes/No') }}</editor_block>@else {{ __('Yes/No') }} @endif</span>
                                            </label>
                                        </p>
                                        <div class="input-field">
                                            <small class="errorTxt9"></small>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right submit" type="submit" name="action">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Save' contenteditable="true">{{ __('Save') }}</editor_block>@else {{ __('Save') }} @endif
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
