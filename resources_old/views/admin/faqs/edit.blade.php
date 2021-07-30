@extends('admin/layouts.app')
@section('title')
    {{ __('Edit FAQ') }} {{ $faq->title }}
@endsection
@section('breadcrumbs')
    <li><a href="{{route('admin.faqs.index')}}">{{ __('FAQ list') }}</a></li>
    <li> {{ __('Edit FAQ') }}: {{ $faq->title }}</li>
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-md-12">

            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font">{{ __('Edit FAQ') }}</h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="{{ route('admin.faqs.index') }}">[{{ __('back to FAQ list') }}]
                            </a>
                        </li>
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> {{ __('Fullscreen') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">

                    <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                          action="{{ route('admin.faqs.update', ['id' => $faq->id]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">

                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="lang_id">{{ __('Language') }}</label>
                                <div class="col-md-4">
                                    <select id="lang_id" name="lang_id" class="form-control">
                                        @foreach(getLanguagesArray() as $lang)
                                            <option value="{{$lang['id']}}"{{ $lang['id'] == $faq['lang_id'] ? ' selected' : '' }}>{{ $lang['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-md-2 control-label">{{ __('Question') }}</label>
                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control"
                                           name="title" value="{{$faq->title}}" required>
                                </div>
                            </div>
                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textarea">{{ __('Answer') }}</label>
                                <div class="col-md-8">
                                            <textarea class="form-control" id="textarea" rows="10"
                                                      name="text">{{$faq->text}} </textarea>
                                </div>
                            </div>

                        </fieldset>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /tile body -->

            </section>
            <!-- /tile -->

        </div>
        <!-- /col -->
    </div>
    <!-- /row -->

@endsection