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
                                    <h4 class="card-title">Изменить реферальный уровень</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            @include('panels.inform')
                            <form class="formValidate" action="{{ route('referrals.update', $referral) }}" id="formValidate" method="post">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="level">Уровень*</label>
                                        <input id="level" name="level" type="number" step="any" data-error=".errorTxt1" value="{{ $referral->level }}">
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="percent">Процент *</label>
                                        <input id="percent" type="number" step="any" name="percent" data-error=".errorTxt2" value="{{ $referral->percent }}">
                                        <small class="errorTxt2"></small>
                                    </div>
                                    <div class="col s12">
                                        <label for="on_load">При пополнении баланса</label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="on_load" value="0">
                                                <input type="checkbox" name="on_load" id="on_load" {{ $referral->on_load ? 'checked' : '' }} value="1"/>
                                                <span>Да/Нет</span>
                                            </label>
                                        </p>
                                        <div class="input-field">
                                            <small class="errorTxt5"></small>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <label for="on_profit">При пополнении прибыли</label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="on_profit" value="0">
                                                <input type="checkbox" name="on_profit" id="on_profit" {{ $referral->on_profit ? 'checked' : '' }} value="1"/>
                                                <span>Да/Нет</span>
                                            </label>
                                        </p>
                                        <div class="input-field">
                                            <small class="errorTxt6"></small>
                                        </div>
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

{{-- vendor script --}}
@section('vendor-script')
    <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script>

    </script>
@endsection
