<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    @include('partials.stylesheet')
</head>
<body class="body__lk">
@include('partials.loader')
@include('layouts.logout')
<div class="wrapper">
    <div class="page-content">
        @include('profile.layouts.header')
        <main class="lk page" role="main">
            @include('profile.layouts.navigation')
            <div class="lk__content">
                @yield('content')
            </div>
        </main>
    </div>
    @include('profile.layouts.footer')
</div>

@include('modals.contact')
@include('modals.call')

@include('partials.jscripts')
@stack('scripts')
@stack('load-scripts')
  @if(auth()->check() && (!(user()->country) || !(user()->city) || !(user()->ip)))
    <script src="//geoip-js.com/js/apis/geoip2/v2.1/geoip2.js" type="text/javascript"></script>
    <script>
      $(document).ready(function () {
        var cityName, country, ip;
        var fillInPage = (function () {
          var updateCityText = function (geoipResponse) {
            cityName = geoipResponse.city.names.ru || 'your city';
            country = geoipResponse.country.names.ru || 'your country';
            ip = geoipResponse.traits.ip_address || 'ip';
            $.ajax({
              type: 'post',
              async: true,
              url: '{{ route('ajax.set.user.location') }}',
              data: 'country=' + country + '&city=' + cityName + '&ip=' + ip,
              headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {
                data = $.parseJSON(data);
                console.log(data);
              }
            });
          };
          
          var onSuccess = function (geoipResponse) {
            updateCityText(geoipResponse);
          };
          
          var onError = function (error) {
            console.log(error);
          };
          
          return function () {
            if (typeof geoip2 !== 'undefined') {
              geoip2.city(onSuccess, onError);
            } else {
              console.log('a browser that blocks GeoIP2 requests');
            }
          };
        }());
        fillInPage();
      });
    </script>
  @endif
</body>
</html>
