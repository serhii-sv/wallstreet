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
                                    <h4 class="card-title">Изменить продукт</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            @include('panels.inform')
                            <div class="card">
                                <div class="card-content">
                                    <form class="formValidate" action="{{ route('products.update', $product) }}" id="formValidate" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row" id="main-view">
                                            <div class="row mt-2">
                                                <div class="input-field col s12">
                                                    <label for="slug">Slug*</label>
                                                    <input id="slug" name="slug" type="text" data-error=".errorTxt1" value="{{ $product->slug }}">
                                                </div>
                                                <div class="input-field col s12">
                                                    <label for="title">Заголовок*</label>
                                                    <input id="title" name="title" type="text" data-error=".errorTxt1" value="{{ $product->title }}" >
                                                </div>
                                                <div class="input-field col s12">
                                                    <label for="in_stock">Количество*</label>
                                                    <input id="in_stock" name="in_stock" type="number" data-error=".errorTxt1" value="{{ $product->in_stock }}">
                                                </div>
                                                <div class="input-field col s12">
                                                    <label for="price">Цена*</label>
                                                    <input id="price" name="price" type="number" step="0.1" data-error=".errorTxt1" value="{{ $product->price }}">
                                                </div>
                                                <div class="col s12">
                                                    <label for="active">Активный</label>
                                                    <p>
                                                        <label>
                                                            <input type="hidden" name="active" value="0">
                                                            <input type="checkbox" name="active" {{ $product->active ? 'checked' : '' }} id="active" value="1"/>
                                                            <span>Да/Нет</span>
                                                        </label>
                                                    </p>
                                                    <div class="input-field">
                                                        <small class="errorTxt5"></small>
                                                    </div>
                                                </div>
                                                <div class="input-field col s12 width-100">
                                                    <div class="font-weight-500 mb-2"></div>
                                                    <textarea id="editor_short_description" name="short_description" class="materialize-textarea">{{ $product->short_description }}</textarea>
                                                </div>
                                                <div class="input-field col s12 width-100">
                                                    <div class="font-weight-500 mb-2">Контент</div>
                                                    <textarea id="editor_description" name="description" class="materialize-textarea">{{ $product->description }}</textarea>
                                                </div>
                                                <div class="input-field col s12">
                                                    <div class="font-weight-500 mb-2">Картинка</div>
                                                    @if($product->image)
                                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($product->image) }}" width="300">
                                                    @endif
                                                    <input type="file" id="input-file-events" class="dropify-event" name="image" />
                                                </div>
                                                <div class="input-field col s12">
                                                    <button class="btn waves-effect waves-light right submit" type="submit">Сохранить</button>
                                                </div>
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
    <script src="{{asset('js/scripts/products.js')}}"></script>
@endsection
