{{-- extend Layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'eCommerce Products Page')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/noUiSlider/nouislider.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/eCommerce-products-page.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <div class="section">
        <a href="{{ route('products.create') }}" class="btn float-right">Добавить продукт</a>
        <div class="row" id="ecommerce-products">
            <div class="col s12 m12 l12 pr-0">
                @foreach($products as $product)
                    <div class="col s12 m4 l4">
                        <div class="card animate fadeLeft">
                            <div class="card-content">
                                <span class="card-title text-ellipsis">{{ $product->title }}</span>
                                <img src="{{ $product->image ? \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($product->image) : asset('images/product-default.png') }}" class="responsive-img" alt="">
                                <div class="display-flex flex-wrap justify-content-center">
                                    <h5 class="mt-3">${{ $product->price }}</h5>
                                    <a href="{{ route('products.edit', $product) }}" class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block z-depth-4">Показать</a>
                                    <a href="{{ route('products.destroy', $product) }}" class="mt-2 waves-effect waves-light gradient-45deg-deep-red-pink btn btn-block z-depth-4 delete">Удалить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Pagination -->
                <div class="col s12 center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/noUiSlider/nouislider.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/products.js')}}"></script>
@endsection
