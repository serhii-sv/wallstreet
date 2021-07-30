@extends('admin/layouts.app')
@section('title')
    {{ __('Edit template translation') }}
@endsection
@section('breadcrumbs')
    <li><a href="{{route('admin.tpl_texts.index')}}">{{ __('Template translations') }}</a></li>
    <li> {{ __('Edit template translation') }}</li>
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
                    <h1 class="custom-font">{{ __('Edit template translation') }}</h1>
                    <ul class="controls">
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

                    <form class="form-horizontal" method="POST"
                          action="{{ route('admin.tpl_texts.update', ['key' => $key]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                      
                      <div class="form-group">
                        <label for="text" class="col-md-4 control-label">{{ __("Key") }}</label>
                        <div class="col-md-6">
                          <input id="text" type="text" class="form-control"
                              value="{{ $key }}" readonly>
                        </div>
                      </div>
                        @foreach($languages as $item)
                            <div class="form-group">
                                <label for="text" class="col-md-4 control-label">{{ $item->code }}</label>
                                <div class="col-md-6">
                                    <input id="text" type="text" class="form-control"
                                           name="text_{{ $item->code }}"
                                           value="{{ $data[$item->code] }}">
                                </div>
                            </div>
                        @endforeach
                      
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