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
                <div class="card card-tabs">
                    <div class="card-content">
                        <div class="card-title">
                            <div class="row">
                                <div class="col s12 m6 l10">
                                    <h4 class="card-title">{{ $item->title[\App\Models\Language::getDefault()->code] ?? '' }}</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            @include('panels.inform')
                            <div class="card">
                                <div class="card-content">
                                    @if($item->image)
                                        <div class="image center">
                                            <img class="border-radius-8"
                                                 src="{{ \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($item->image) }}"
                                                 alt="">
                                        </div>
                                    @endif
                                    <div class="content mt-3">
                                        {!! $item->content[\App\Models\Language::getDefault()->code] ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
