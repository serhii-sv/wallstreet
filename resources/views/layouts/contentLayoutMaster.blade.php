{{-- pageConfigs variable pass to Helper's updatePageConfig function to update page configuration  --}}
@isset($pageConfigs)
  {!! \App\Helpers\Helper::updatePageConfig($pageConfigs) !!}
@endisset

<!DOCTYPE html>
@php
// confiData variable layoutClasses array in Helper.php file.
  $configData = \App\Helpers\Helper::applClasses();
  $themeSettings = \App\Models\UserThemeSetting::getThemeSettings();
@endphp
<!--
Template Name: Materialize - Material Design Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
Renew Support: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading"
  lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{$configData['defaultLanguage']}}@endif"
  data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}">
<!-- BEGIN: Head-->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
  <link rel="apple-touch-icon" href="{{asset('images/favicon/apple-touch-icon-152x152.png')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon/favicon-32x32.png')}}">

  
    <!--Start of Tawk.to Script--> <script type="text/javascript"> var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date(); (function(){ var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0]; s1.async=true; s1.src='https://embed.tawk.to/612dc757649e0a0a5cd3c665/1fedd5c13'; s1.charset='UTF-8'; s1.setAttribute('crossorigin','*'); s0.parentNode.insertBefore(s1,s0); })(); </script> <!--End of Tawk.to Script-->

  {{-- Include core + vendor Styles --}}
  @include('panels.styles')

</head>
<!-- END: Head-->

{{-- @isset(config('custom.custom.mainLayoutType'))
@endisset --}}
@if(!empty($configData['mainLayoutType']) && isset($configData['mainLayoutType']))
  @include(($configData['mainLayoutType'] === 'horizontal-menu') ? 'layouts.horizontalLayoutMaster':'layouts.verticalLayoutMaster')
@else
{{-- if mainLaoutType is empty or not set then its print below line  --}}
<h1>{{'mainLayoutType Option is empty in config custom.php file.'}}</h1>
@endif

</html>
