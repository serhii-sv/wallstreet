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
                                    <h4 class="card-title">Добавть тариф</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            <form class="formValidate" action="{{ route('rates.store') }}" id="formValidate" method="post">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="name">Имя Тарифа*</label>
                                        <input id="name" name="name" type="text" data-error=".errorTxt1">
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="min">Минимальный депозит *</label>
                                        <input id="min" type="number" name="min" data-error=".errorTxt2">
                                        <small class="errorTxt2"></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="password">Максимальный депозит *</label>
                                        <input id="max" type="number" name="max" data-error=".errorTxt3">
                                        <small class="errorTxt3"></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="duration">Срок действия депозита *</label>
                                        <input id="duration" type="number" name="duration" data-error=".errorTxt4">
                                        <small class="errorTxt4"></small>
                                    </div>
                                    <div class="col s12">
                                        <label for="reinvest">Возможность реинвестировать</label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="reinvest" value="0">
                                                <input type="checkbox" name="reinvest" id="reinvest" value="1"/>
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
                                                <input type="checkbox" name="upgradable" id="upgradable" value="1"/>
                                                <span>Да/Нет</span>
                                            </label>
                                        </p>
                                        <div class="input-field">
                                            <small class="errorTxt6"></small>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <label for="refund_deposit">Возврат депозита в конце срока</label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="refund_deposit" value="0">
                                                <input type="checkbox" name="refund_deposit" id="refund_deposit" value="1"/>
                                                <span>Да/Нет</span>
                                            </label>
                                        </p>
                                        <div class="input-field">
                                            <small class="errorTxt7"></small>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <label for="autoclose">Закрытие депозита</label>
                                        <p>
                                            <label>
                                                <input type="hidden" name="autoclose" value="0">
                                                <input type="checkbox" name="autoclose" id="autoclose" value="1"/>
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
                                                <input type="checkbox" name="active" id="active" value="1"/>
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
