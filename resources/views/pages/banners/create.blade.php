@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Form Validation')
{{-- vendor style --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/dropify/css/dropify.min.css')}}">
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
                                    <h4 class="card-title">Добавить банер</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            @include('panels.inform')
                            <form class="formValidate" action="{{ route('banners.store') }}" id="formValidate" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="title">Заголовок*</label>
                                        <input id="title" name="title" type="text" data-error=".errorTxt1" value="{{ old('title') }}">
                                    </div>
                                    <div class="input-field col s12 width-100">
                                        <div class="font-weight-500 mb-2">Размер</div>
                                        <select class="icons m6" name="size">
                                            <option value="" disabled selected>Выберите размер</option>
                                            @foreach(\App\Models\Banner::BANNERS as $banner)
                                                <option value="{{ $banner['size'] }}" data-icon="{{ asset('/images/banners/' . $banner['image']) }}" class="circle">
                                                    {{ $banner['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="font-weight-500 mb-2">Картинка</div>
                                        <input type="file" id="input-file-events" class="dropify-event" name="image"/>
                                    </div>
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right submit" type="submit">
                                            Сохранить
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
    <script src="{{asset('vendors/dropify/js/dropify.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/form-file-uploads.js')}}"></script>
    <script src="{{asset('js/scripts/banners.js')}}"></script>
@endsection
