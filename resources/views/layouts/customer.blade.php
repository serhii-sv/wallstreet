<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    @include('partials.stylesheet')
</head>
<body class="body__index">
@include('partials.loader')
@include('layouts.logout')
<div class="wrapper">
    <div class="page-content">
        <section class="top top--decor top--mobile">
            <div class="container">
                <div class="nav-icon-wrap">
                    <div id="nav-icon"><span></span><span></span><span></span><span></span></div>
                </div><img class="logo-mobile" src="/img/logo/logo.png" alt="">
                @include('layouts.navigation')
                @include('partials.language')
            </div>
        </section>
        @include('layouts.header')
        @yield('content')
    </div>
    @include('layouts.footer')
</div>

{!! \App\Models\Setting::getValue('online_chat') !!}

@include('partials.jscripts')
@stack('scripts')

@include('modals.contact')
@include('modals.call')

</body>
</html>
