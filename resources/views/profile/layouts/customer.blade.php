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

</body>
</html>
