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
                                    <h4 class="card-title">Изменить курс валют {{ $rate->currency_name }}</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            @include('panels.inform')
                            <form class="formValidate" action="{{ route('currency-rates.update', $rate) }}" id="formValidate" method="post">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="rate">Курс*</label>
                                        <input id="rate" name="rate" type="number" step="0.1" data-error=".errorTxt1" value="{{ $rate->s_value }}">
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="date">Дата*</label>
                                        <input id="date" type="text" name="date" class="datepicker">
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="col s12">
                                        <label for="autoupdate">Автообновление</label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="autoupdate" value="0">
                                                <input type="checkbox" name="autoupdate" id="autoupdate" {{ $rate->autoupdate ? 'checked' : '' }} value="1"/>
                                                <span>Да/Нет</span>
                                            </label>
                                        </p>
                                    </div>
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
