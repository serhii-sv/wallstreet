{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Blog List Page')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/noUiSlider/nouislider.min.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-blog.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/eCommerce-products-page.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <div class="section mt-2" id="blog-list">
        <div class="row">
            <div class="col s12">
                <a href="{{ route('products.create') }}" class="btn float-right mt-2">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Add product' contenteditable="true">{{ __('Add product') }}</editor_block>@else {{ __('Add product') }} @endif</a>
                <div class="row mt-5" id="ecommerce-products" style="display: flex; flex-wrap: wrap; width: 100%">
                    <div class="col s12 m12 l12 pr-0">
                        @foreach($products->chunk(3) as $chunked)
                            <div class="row item-row">
                                @foreach($chunked as $product)
                                    <div class="col s12 m4 l4" style="flex-basis: calc(33.333% - 20px); margin-left: 0">
                                        <div class="card animate fadeLeft" style="height: 95%">
                                            <div class="card-content">
                                                <span class="card-title text-ellipsis">{{ $product->title }}</span>
                                                <div class="display-flex flex-wrap justify-content-center">
                                                    <img
                                                        src="{{ $product->image ? \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($product->image) : asset('images/product-default.png') }}"
                                                        class="responsive-img" alt="">
                                                </div>
                                                <div class="display-flex flex-wrap justify-content-center">
                                                    <h5 class="mt-3">${{ $product->price }}</h5>
                                                    <a href="{{ route('products.edit', $product) }}"
                                                       class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block z-depth-4">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Show' contenteditable="true">{{ __('Show') }}</editor_block>@else {{ __('Show') }} @endif</a>
                                                    <a href="{{ route('products.destroy', $product) }}"
                                                       class="mt-2 waves-effect waves-light gradient-45deg-deep-red-pink btn btn-block z-depth-4 delete">@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Delete' contenteditable="true">{{ __('Delete') }}</editor_block>@else {{ __('Delete') }} @endif</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    @endforeach
                    <!-- Pagination -->
                        <div class="col s12 center">
                            {{ $products->fragment('products')->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- vendor script --}}
@section('vendor-script')
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('vendors/noUiSlider/nouislider.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/products.js')}}"></script>
    <script>
        $(function () {
            setTimeout(() => {
                $(".item-row").each(function () {
                    var maxHeight = 0;
                    $(this).find('.col').each(function () {
                        if ($(this).height() > maxHeight) {
                            maxHeight = $(this).height();
                        }
                    })

                    $(this).find('.col').height(maxHeight);
                });
            }, 200)
        })
    </script>
@endsection
