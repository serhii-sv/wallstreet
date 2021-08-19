{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Blog List Page')

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-blog.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <div class="section mt-2" id="blog-list">
        <a href="{{ route('news.create') }}" class="btn float-right">Добавить новость</a>
        <div class="row mt-2">
            <!-- Blog Style One -->

            <!-- Fashion Card -->
            @foreach($news as $item)
                <a href="{{ route('news.show', $item->id) }}">
                    <div class="col s12 m6 l4">
                        <div class="card-panel border-radius-6 mt-10 card-animation-1">
                            @if($item->image)
                                <img class="responsive-img border-radius-8 z-depth-4 image-n-margin"
                                     src="{{ \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($item->image) }}"
                                     alt="">
                            @endif
                            <h6 class="deep-purple-text text-darken-3 mt-5">
                                <a href="{{ route('news.show', $item->id) }}">{{ $item->title[\App\Models\Language::getDefault()->code] ?? '' }}</a>
                            </h6>
                            <span>{!! $item->short_content[\App\Models\Language::getDefault()->code] ?? '' !!}</span>
                            <div class="display-flex justify-content-between flex-wrap mt-4">
                                <div class="display-flex mt-3 right-align social-icon">
                                    <a href="{{ route('news.edit', $item) }}">
                                        <span class="material-icons">create</span>
                                    </a>
                                    <a href="{{ route('news.destroy', $item) }}">
                                        <span class="material-icons">delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div>
            {{ $news->links() }}
        </div>
    </div>
@endsection
