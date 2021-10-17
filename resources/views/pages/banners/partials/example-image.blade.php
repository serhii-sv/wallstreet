{{--<img height="100" src="{{ asset('/images/banners/' . \App\Models\Banner::getBannerImage($banner->size)) }}">--}}
@if($banner->image)
  <img src="{{ \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($banner->image) }}" width="150">
@endif