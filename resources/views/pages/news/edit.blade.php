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
                                    <h4 class="card-title">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Edit news' contenteditable="true">{{ __('Edit news') }}</editor_block>@else {{ __('Edit news') }} @endif</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            @include('panels.inform')
                            <div class="card">
                                <div class="card-content">
                                    <form class="formValidate" action="{{ route('news.update', $item) }}" id="formValidate" method="post" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="row" id="main-view">
                                            <div class="col s12">
                                                <ul class="tabs tab-demo z-depth-1 tabs-fixed-width">
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
                                                                <label for="{{ $language->code }}.title">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Title *' contenteditable="true">{{ __('Title *') }}</editor_block>@else {{ __('Title *') }} @endif</label>
                                                                <input id="{{ $language->code }}.title" name="title[{{ $language->code }}]" type="text" data-error=".errorTxt1" value="{{ $item->title[$language->code] ?? '' }}">
                                                            </div>
                                                            <div class="input-field col s12 width-100">
                                                                <div class="font-weight-500 mb-2">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Preview content' contenteditable="true">{{ __('Preview content') }}</editor_block>@else {{ __('Preview content') }} @endif</div>
                                                                <textarea id="editor_preview_{{ $language->code }}" name="short_content[{{ $language->code }}]" class="materialize-textarea">{{ $item->short_content[$language->code] ?? '' }}</textarea>
                                                            </div>
                                                            <div class="input-field col s12 width-100">
                                                                <div class="font-weight-500 mb-2">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Content' contenteditable="true">{{ __('Content') }}</editor_block>@else {{ __('Content') }} @endif</div>
                                                                <textarea id="editor_content_{{ $language->code }}" name="content[{{ $language->code }}]" class="materialize-textarea">{{ $item->content[$language->code] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="input-field col s12">
                                                <label for="views">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Views *' contenteditable="true">{{ __('Views *') }}</editor_block>@else {{ __('Views *') }} @endif</label>
                                                <input id="views" name="views" type="number" data-error=".errorTxt1" value="{{ $item->views ?? 0 }}">
                                            </div>
                                            <div class="input-field col s12">
                                                <label for="likes">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Likes *' contenteditable="true">{{ __('Likes *') }}</editor_block>@else {{ __('Likes *') }} @endif</label>
                                                <input id="likes" name="likes" type="number" data-error=".errorTxt1" value="{{ $item->likes ?? 0 }}">
                                            </div>
                                            <div class="input-field col s12">
                                                <div class="font-weight-500 mb-2">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Image' contenteditable="true">{{ __('Image') }}</editor_block>@else {{ __('Image') }} @endif</div>
                                                @if($item->image)
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($item->image) }}" width="300">
                                                @endif
                                                <input type="file" id="input-file-events" class="dropify-event" name="image" />
                                            </div>
                                            <div class="input-field col s12">
                                                <button class="btn waves-effect waves-light right submit" type="submit">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Save' contenteditable="true">{{ __('Save') }}</editor_block>@else {{ __('Save') }} @endif</button>
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
