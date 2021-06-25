@extends('admin/layouts.app')
@section('title')
    {{ __('Edit review') }}
@endsection
@section('breadcrumbs')
    <li><a href="{{route('admin.reviews.index')}}">{{ __('Reviews') }}</a></li>
    <li> {{ __('Edit review') }}</li>
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
                    <h1 class="custom-font">{{ __('Edit review') }}</h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="{{ route('admin.reviews.index') }}">[{{ __('back to reviews list') }}
                                ]
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
                          action="{{ route('admin.reviews.update', ['id' => $review->id]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">

                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="lang_id">{{ __('Language') }}</label>
                                <div class="col-md-4">
                                    <select id="lang_id" name="lang_id" class="form-control">
                                        @foreach(getLanguagesArray() as $lang)
                                            <option value="{{$lang['id']}}"{{ $lang['id'] == $review->lang_id ? ' selected' : '' }}>{{ $lang['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">{{ __('Customer name') }}</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control"
                                           name="name" value="{{ $review->name }}" required>
                                </div>
                            </div>
                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textarea">{{ __('Review text') }}</label>
                                <div class="col-md-8">
                                            <textarea class="form-control" id="textarea" rows="10"
                                                      name="text">{{$review->text}} </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="video" class="col-md-2 control-label">{{ __('Video link') }}</label>
                                <div class="col-md-8">
                                    <input id="video" type="text" class="form-control"
                                           name="video" value="{{$review->video}}">
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