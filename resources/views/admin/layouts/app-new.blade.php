<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin: @yield('title') :: {{ config('app.name', '') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('admin/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/layouts/font-awesome.min.css') }}">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/chartist-js/chartist.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/chartist-js/chartist-plugin-tooltip.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/pages/dashboard-modern.css') }}">
  {{--    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/pages/intro.css') }}">--}}
  <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->
  </head>
  <!-- END: Head-->
  <body class="@yield('body.class')" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
    
    <!-- BEGIN: Header-->
  @include('admin.layouts.app-header')
  <!-- END: Header-->
    <ul class="display-none" id="default-search-main">
      <li class="auto-suggestion-title">
        <a class="collection-item" href="#">
          <h6 class="search-title">FILES</h6></a>
      </li>
      <li class="auto-suggestion">
        <a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar">
                <img src="{{ asset('admin/images/icon/pdf-image.png') }}" width="24" height="30" alt="sample image">
              </div>
              <div class="member-info display-flex flex-column">
                <span class="black-text">Two new item submitted</span>
                <small class="grey-text">Marketing Manager</small></div>
            </div>
            <div class="status"><small class="grey-text">17kb</small></div>
          </div>
        </a>
      </li>
      <li class="auto-suggestion">
        <a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar">
                <img src="{{ asset('admin/images/icon/doc-image.png') }}" width="24" height="30" alt="sample image">
              </div>
              <div class="member-info display-flex flex-column">
                <span class="black-text">52 Doc file Generator</span>
                <small class="grey-text">FontEnd Developer</small></div>
            </div>
            <div class="status"><small class="grey-text">550kb</small></div>
          </div>
        </a>
      </li>
      <li class="auto-suggestion">
        <a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar">
                <img src="{{ asset('admin/images/icon/xls-image.png') }}" width="24" height="30" alt="sample image">
              </div>
              <div class="member-info display-flex flex-column">
                <span class="black-text">25 Xls File Uploaded</span>
                <small class="grey-text">Digital Marketing Manager</small></div>
            </div>
            <div class="status"><small class="grey-text">20kb</small></div>
          </div>
        </a>
      </li>
      <li class="auto-suggestion">
        <a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar">
                <img src="{{ asset('admin/images/icon/jpg-image.png') }}" width="24" height="30" alt="sample image">
              </div>
              <div class="member-info display-flex flex-column">
                <span class="black-text">Anna Strong</span>
                <small class="grey-text">Web Designer</small></div>
            </div>
            <div class="status"><small class="grey-text">37kb</small></div>
          </div>
        </a>
      </li>
      <li class="auto-suggestion-title">
        <a class="collection-item" href="#">
          <h6 class="search-title">MEMBERS</h6></a>
      </li>
      <li class="auto-suggestion">
        <a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar">
                <img class="circle" src="{{ asset('admin/images/avatar/avatar-7.png') }}" width="30" alt="sample image">
              </div>
              <div class="member-info display-flex flex-column">
                <span class="black-text">John Doe</span>
                <small class="grey-text">UI designer</small></div>
            </div>
          </div>
        </a>
      </li>
      <li class="auto-suggestion">
        <a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar">
                <img class="circle" src="{{ asset('admin/images/avatar/avatar-8.png') }}" width="30" alt="sample image">
              </div>
              <div class="member-info display-flex flex-column">
                <span class="black-text">Michal Clark</span>
                <small class="grey-text">FontEnd Developer</small></div>
            </div>
          </div>
        </a>
      </li>
      <li class="auto-suggestion">
        <a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar">
                <img class="circle" src="{{ asset('admin/images/avatar/avatar-10.png') }}" width="30" alt="sample image">
              </div>
              <div class="member-info display-flex flex-column">
                <span class="black-text">Milena Gibson</span>
                <small class="grey-text">Digital Marketing</small></div>
            </div>
          </div>
        </a>
      </li>
      <li class="auto-suggestion">
        <a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar">
                <img class="circle" src="{{ asset('admin/images/avatar/avatar-12.png') }}" width="30" alt="sample image">
              </div>
              <div class="member-info display-flex flex-column">
                <span class="black-text">Anna Strong</span>
                <small class="grey-text">Web Designer</small></div>
            </div>
          </div>
        </a>
      </li>
    </ul>
    <ul class="display-none" id="page-search-title">
      <li class="auto-suggestion-title">
        <a class="collection-item" href="#">
          <h6 class="search-title">PAGES</h6></a>
      </li>
    </ul>
    <ul class="display-none" id="search-not-found">
      <li class="auto-suggestion">
        <a class="collection-item display-flex align-items-center" href="#">
          <span class="material-icons">error_outline</span>
          <span class="member-info">No results found.</span>
        </a>
      </li>
    </ul>
    
    <!-- BEGIN: SideNav-->
  @include('admin.layouts.app-menu')
  <!-- END: SideNav-->
    
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="col s12">
          <div class="container">
            
            @yield('content')
            
            <!-- START RIGHT SIDEBAR NAV -->
            @include('admin.layouts.app-right-sidebar')
            <!-- END RIGHT SIDEBAR NAV -->
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
    
    <!-- Theme Customizer -->
  @include('admin.layouts.app-customize-btn')
  @include('admin.layouts.app-customize')
  <!--/ Theme Customizer -->
    
    <!-- BEGIN: Footer-->
  @include('admin.layouts.app-footer')
  
  <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('admin/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('admin/vendors/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/chartist-js/chartist.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/chartist-js/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('admin/vendors/chartist-js/chartist-plugin-fill-donut.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('admin/js/plugins.js') }}"></script>
    <script src="{{ asset('admin/js/search.js') }}"></script>
    <script src="{{ asset('admin/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('admin/js/scripts/customizer.js') }}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('admin/js/scripts/dashboard-modern.js') }}"></script>
  {{--    <script src="{{ asset('admin/js/scripts/intro.js') }}"></script>--}}
  <!-- END PAGE LEVEL JS-->
    @stack('scripts')
  </body>
</html>