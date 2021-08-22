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
                                                <input placeholder="Полное имя пользователя" id="full_name" disabled type="text" value="{{ $verificationRequest->full_name }}">
                                                <label for="full_name">Полное имя пользователя</label>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="row">
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

