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
                                    <h4 class="card-title">Добавить новость</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            @include('panels.inform')
                            <div class="card">
                                <div class="card-content">
                                    <form class="formValidate" action="{{ route('news.store') }}" id="formValidate" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row" id="main-view">
                                            <div class="col s12">
                                                <ul class="tabs tab-demo z-depth-1">
                                                    @foreach($languages as $language)
                                                        <li class="tab col m3"><a class="{{ !$loop->index ? 'active' : '' }}" href="#lang_{{ $language->code }}">{{ $language->original_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col s12">
                                                @foreach($languages as $language)
                                                    <div id="lang_{{ $language->code }}" class="col s12">
                                                        <div class="row mt-2">
                                                            <div class="input-field col s12">
                                                                <label for="{{ $language->code }}.title">Заголовок*</label>
                                                                <input id="{{ $language->code }}.title" name="title[{{ $language->code }}]" type="text" data-error=".errorTxt1">
                                                            </div>
                                                            <div class="input-field col s12 width-100">
                                                                <div class="font-weight-500 mb-2">Превью контент</div>
                                                                <textarea id="editor_preview_{{ $language->code }}" name="short_content[{{ $language->code }}]" class="materialize-textarea">{{ old('short_content.' . $language->code) ?? '' }}</textarea>
                                                            </div>
                                                            <div class="input-field col s12 width-100">
                                                                <div class="font-weight-500 mb-2">Контент</div>
                                                                <textarea id="editor_content_{{ $language->code }}" name="content[{{ $language->code }}]" class="materialize-textarea">{{ old('content.' . $language->code) ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="input-field col s12">
                                                <label for="likes">Лайки*</label>
                                                <input id="likes" name="likes" type="number" data-error=".errorTxt1" value="0">
                                            </div>
                                            <div class="input-field col s12">
                                                <label for="views">Просмотры*</label>
                                                <input id="views" name="views" type="number" data-error=".errorTxt1" value="0">
                                            </div>
                                            <div class="input-field col s12">
                                                <div class="font-weight-500 mb-2">Картинка</div>
                                                <input type="file" id="input-file-events" class="dropify-event" name="image" />
                                            </div>
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light right submit" type="submit">Сохранить</button>
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

{{-- vendor script --}}
@section('vendor-script')
    <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('vendors/dropify/js/dropify.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <script src="{{asset('js/scripts/form-file-uploads.js')}}"></script>
    <script src="{{asset('js/scripts/news.js')}}"></script>
@endsection
