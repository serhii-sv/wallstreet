{{--<img height="100" src="{{ asset('/images/banners/' . \App\Models\Banner::getBannerImage($banner->size)) }}">--}}
@if($banner->image)
  <img style="max-width: 100%" src="{{ route('get.banner', $banner->id) }}" width="150" >
@endif