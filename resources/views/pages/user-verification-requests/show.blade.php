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
                                    <h4 class="card-title">Заявка {{ $verificationRequest->id }}</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            @include('panels.inform')
                            <div class="card">
                                <div class="card-content">
                                    <form class="formValidate" action="{{ route('verification-requests.update', $verificationRequest) }}" id="formValidate" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Полное имя пользователя" id="first_name" disabled type="text" value="{{ $verificationRequest->first_name }}">
                                                    <label for="first_name">Имя пользователя</label>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Фамилия пользователя" id="last_name" disabled type="text" value="{{ $verificationRequest->last_name }}">
                                                    <label for="last_name">Фамилия пользователя</label>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Дата рождения" id="date_of_birth" disabled type="text" value="{{ $verificationRequest->date_of_birth }}">
                                                    <label for="date_of_birth">Дата рождения</label>
                                                </div>
                                            </div>
                                            <div class="col s12 mt-5">
                                                <div class="input-field">
                                                    <input placeholder="Страна" id="country" disabled type="text" value="{{ $verificationRequest->country }}">
                                                    <label for="country">Страна</label>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Город" id="city" disabled type="text" value="{{ $verificationRequest->city }}">
                                                    <label for="city">Город</label>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Штат (область)" id="state" disabled type="text" value="{{ $verificationRequest->state }}">
                                                    <label for="state">Город</label>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Национальность" id="nationality" disabled type="text" value="{{ $verificationRequest->nationality }}">
                                                    <label for="nationality">Национальность</label>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Национальность" id="nationality" disabled type="text" value="{{ $verificationRequest->nationality }}">
                                                    <label for="nationality">Национальность</label>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Почтовый индекс" id="zip_code" disabled type="text" value="{{ $verificationRequest->zip_code }}">
                                                    <label for="zip_code">Почтовый индекс</label>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Фактический адрес" id="address" disabled type="text" value="{{ $verificationRequest->address }}">
                                                    <label for="address">Фактический адрес</label>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input placeholder="Пользователь подтвердил правильность всех предоставленных данных" id="address" disabled type="text" value="{{ $verificationRequest->confirmation_of_correctness ? 'Да' : 'Нет' }}">
                                                    <label for="address">Пользователь подтвердил правильность всех предоставленных данных</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @switch($verificationRequest->document_type)
                                                @case('passport')
                                                <div class="col s6">
                                                    <div class="card">
                                                        <div class="card-header" style="padding: 5px 25px;">
                                                            <h5>Фото паспорта</h5>
                                                        </div>
                                                        <div class="card-content">
                                                            <img class="preview mt-3" style="width: 100%" src="{{ Storage::disk('do_spaces')->url($verificationRequest->passport_image) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                @break
                                                @case('driver-licence')
                                                <div class="col s6">
                                                    <div class="card">
                                                        <div class="card-header" style="padding: 5px 25px;">
                                                            <h5>Фото водительского удостоверения</h5>
                                                        </div>
                                                        <div class="card-content">
                                                            <img class="preview mt-3" style="width: 100%" src="{{ Storage::disk('do_spaces')->url($verificationRequest->driver_license_image) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                @break
                                                @case('national-card')
                                                <div class="col s6">
                                                    <div class="card">
                                                        <div class="card-header" style="padding: 5px 25px;">
                                                            <h5>Фото ID карты (передняя часть)</h5>
                                                        </div>
                                                        <div class="card-content">
                                                            <img class="preview mt-3" style="width: 100%" src="{{ Storage::disk('do_spaces')->url($verificationRequest->id_card_front_image) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s6">
                                                    <div class="card">
                                                        <div class="card-header" style="padding: 5px 25px;">
                                                            <h5>Фото ID карты (задняя часть)</h5>
                                                        </div>
                                                        <div class="card-content">
                                                            <img class="preview mt-3" style="width: 100%" src="{{ Storage::disk('do_spaces')->url($verificationRequest->id_card_back_image) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                @break
                                            @endswitch
                                            <div class="col s6">
                                                <div class="card">
                                                    <div class="card-header" style="padding: 5px 25px;">
                                                        <h5>Фото адресса</h5>
                                                    </div>
                                                    <div class="card-content">
                                                        <img class="preview mt-3"  style="width: 100%" src="{{ Storage::disk('do_spaces')->url($verificationRequest->address_image) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="card">
                                                    <div class="card-header" style="padding: 5px 25px;">
                                                        <h5>Селфи</h5>
                                                    </div>
                                                    <div class="card-content">
                                                        <img class="preview mt-3"  style="width: 100%" src="{{ Storage::disk('do_spaces')->url($verificationRequest->selfie_image) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <button class="btn waves-effect waves-light right submit" type="submit">Подтвердить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/user-verification-requests.js')}}"></script>
@endsection

