<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
  
  
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Admin: @yield('title') :: {{ config('app.name', '') }}</title>
    <link rel="icon" type="image/ico" href="/admin_assets/images/favicon.ico"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <!-- ============================================
    ================= Stylesheets ===================
    ============================================= -->
    <!-- vendor css files -->
    <link rel="stylesheet" href="/admin_assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="/admin_assets/css/vendor/animate.css">
    <link rel="stylesheet" href="/admin_assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/morris/morris.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/rickshaw/rickshaw.min.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/datatables/datatables.bootstrap.min.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/chosen/chosen.css">
    <link rel="stylesheet" href="/admin_assets/js/vendor/summernote/summernote.css">
    
    <!-- project main css files -->
    <link rel="stylesheet" href="/admin_assets/css/main.css">
    <!--/ stylesheets -->
    
    
    <!-- ==========================================
    ================= Modernizr ===================
    =========================================== -->
    <script src="/admin_assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <!--/ modernizr -->
    @stack('scripts')
  
  </head>
  
  
  <body id="minovate" class="appWrapper">
    
    
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
      your browser</a> to improve your experience.</p>
    <![endif]-->
    
    
    <!-- ====================================================
    ================= Application Content ===================
    ===================================================== -->
    <div id="wrap" class="animsition">
      
      
      <!-- ===============================================
      ================= HEADER Content ===================
      ================================================ -->
      <section id="header">
        <header class="clearfix">
          
          <!-- Branding -->
          <div class="branding">
            <a class="brand" href="{{ route('admin') }}">
              <img src="/admin_assets/images/logo_no_title.png" align="center">
              <span>{{ config('app.name', 'NewGen') }}</span>
            </a>
            <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
          </div>
          <!-- Branding end -->
          
          <!-- Left-side navigation -->
          <ul class="nav-left pull-left list-unstyled list-inline">
            <li class="sidebar-collapse divided-right">
              <a role="button" tabindex="0" class="collapse-sidebar">
                <i class="fa fa-outdent"></i>
              </a>
            </li>
            <li class="dropdown divided-right settings">
              <a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cog"></i>
              </a>
              <ul class="dropdown-menu with-arrow animated littleFadeInUp" role="menu">
                <li>
                  
                  <ul class="color-schemes list-inline">
                    <li class="title">{{ __('Header Color') }}:</li>
                    <li><a role="button" tabindex="0" class="scheme-drank header-scheme"
                          data-scheme="scheme-default"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-black header-scheme"
                          data-scheme="scheme-black"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-greensea header-scheme"
                          data-scheme="scheme-greensea"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-cyan header-scheme"
                          data-scheme="scheme-cyan"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-lightred header-scheme"
                          data-scheme="scheme-lightred"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-light header-scheme"
                          data-scheme="scheme-light"></a></li>
                    <li class="title">{{ __('Branding Color') }}:</li>
                    <li><a role="button" tabindex="0" class="scheme-drank branding-scheme"
                          data-scheme="scheme-default"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-black branding-scheme"
                          data-scheme="scheme-black"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-greensea branding-scheme"
                          data-scheme="scheme-greensea"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-cyan branding-scheme"
                          data-scheme="scheme-cyan"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-lightred branding-scheme"
                          data-scheme="scheme-lightred"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-light branding-scheme"
                          data-scheme="scheme-light"></a></li>
                    <li class="title">{{ __('Sidebar Color') }}:</li>
                    <li><a role="button" tabindex="0" class="scheme-drank sidebar-scheme"
                          data-scheme="scheme-default"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-black sidebar-scheme"
                          data-scheme="scheme-black"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-greensea sidebar-scheme"
                          data-scheme="scheme-greensea"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-cyan sidebar-scheme"
                          data-scheme="scheme-cyan"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-lightred sidebar-scheme"
                          data-scheme="scheme-lightred"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-light sidebar-scheme"
                          data-scheme="scheme-light"></a></li>
                    <li class="title">{{ __('Active Color') }}:</li>
                    <li><a role="button" tabindex="0" class="scheme-drank color-scheme"
                          data-scheme="drank-scheme-color"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-black color-scheme"
                          data-scheme="black-scheme-color"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-greensea color-scheme"
                          data-scheme="greensea-scheme-color"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-cyan color-scheme"
                          data-scheme="cyan-scheme-color"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-lightred color-scheme"
                          data-scheme="lightred-scheme-color"></a></li>
                    <li><a role="button" tabindex="0" class="scheme-light color-scheme"
                          data-scheme="light-scheme-color"></a></li>
                  </ul>
                
                </li>
                
                <li>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-xs-8 control-label">{{ __('Fixed header') }}</label>
                      <div class="col-xs-4 control-label">
                        <div class="onoffswitch lightred small">
                          <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                              id="fixed-header">
                          <label class="onoffswitch-label" for="fixed-header">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-xs-8 control-label">{{ __('Fixed aside') }}</label>
                      <div class="col-xs-4 control-label">
                        <div class="onoffswitch lightred small">
                          <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                              id="fixed-aside">
                          <label class="onoffswitch-label" for="fixed-aside">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="dropdown divided-right settings">
              <a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-language"></i>
              </a>
              <ul class="dropdown-menu with-arrow animated littleFadeInUp list-group" role="menu">
                @foreach(getLanguagesArray() as $item)
                  <li>
                    <a href="{{ route('set.lang',['locale'=>$item['code']]) }}"
                        class="list-group-item list-group-item-action">{{$item['name']}}</a>
                  </li>
                @endforeach
              </ul>
            </li>
          </ul>
          <!-- Left-side navigation end -->
          
          <!-- Right-side navigation -->
          <ul class="nav-right pull-right list-inline">
            
            <li class="dropdown nav-profile">
              
              <a href class="dropdown-toggle" data-toggle="dropdown">
                {{--<img src="/admin_assets/images/profile-photo.jpg" alt="" class="img-circle size-30x30">--}}
                <span>{{ getUserLogin() }} <i class="fa fa-angle-down"></i></span>
              </a>
              
              <ul class="dropdown-menu animated littleFadeInRight" role="menu" style="margin-left: -100px;">
                <li>
                  <a href="{{route('admin.users.show', ['id' => getUserId()])}}"> <i
                        class="fa fa-user"></i>{{ __('Profile') }}</a>
                </li>
                <li>
                  <a href="{{ route('logout') }}" class="fa fa-sign-out"
                      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              
              </ul>
            
            </li>
          
          </ul>
          <!-- Right-side navigation end -->
        
        </header>
      
      </section>
      <!--/ HEADER Content  -->
      
      
      <!-- =================================================
      ================= CONTROLS Content ===================
      ================================================== -->
      <div id="controls">
        
        
        <!-- ================================================
        ================= SIDEBAR Content ===================
        ================================================= -->
        <aside id="sidebar">
          
          
          <div id="sidebar-wrap">
            
            <div class="panel-group slim-scroll" role="tablist">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" href="#sidebarNav">
                      {{ __('Menu') }} <i class="fa fa-angle-up"></i>
                    </a>
                  </h4>
                </div>
                <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                  <div class="panel-body">
                    
                    
                    <!-- ===================================================
                    ================= NAVIGATION Content ===================
                    ==================================================== -->
                    <ul id="navigation">
                      <li class="{{ (Route::is('admin') ? 'active' : '') }}"><a
                            href="{{ route('admin') }}"><i
                              class="fa fa-dashboard"></i>
                          <span>{{ __('Dashboard') }}</span></a>
                      </li>
                      <li class="{{ (Route::is('admin.users.*') ? 'active' : '') }}"><a
                            href="{{ route('admin.users.index') }}"><i
                              class="fa fa-users"></i>
                          <span>{{ __('Members') }}</span>
                          @if(getTotalAccounts() > 0)
                            <span class="label label-success">{{ getTotalAccounts() }}</span>
                          @endif
                        </a>
                      </li>
                      <li class="{{ (Route::is('admin.deposits.*') ? 'active' : '') }}"><a
                            href="{{ route('admin.deposits.index') }}"><i
                              class="fa fa-suitcase"></i>
                          <span>{{ __('Deposits') }}</span>
                          @if(getActiveDepositsCount() > 0)
                            <span class="label label-success">{{ getActiveDepositsCount() }}</span>
                          @endif
                          @if(getClosedDepositsCount() > 0 && strlen(getClosedDepositsCount() <= 4 && strlen(getActiveDepositsCount()) <= 4))
                            <span class="label label-warning"
                                style="right:50px;">{{ getClosedDepositsCount() }}</span>
                          @endif
                        </a>
                      </li>
                      <li class="{{ (Route::is('admin.requests.*') ? 'active' : '') }}"><a
                            href="{{ route('admin.requests.index') }}"><i
                              class="fa fa-mail-forward"></i>{{ __('Withdrawal requests') }}
                          @if(getAdminWithdrawRequestsCount() > 0)
                            <span class="badge bg-lightred"
                                style="margin-top:-5px;">{{ getAdminWithdrawRequestsCount() }}</span>
                          @endif
                        </a>
                      </li>
                      <li class="{{ (Route::is('admin.transactions.*') ? 'active' : '') }}"><a
                            href="{{ route('admin.transactions.index') }}"><i
                              class="fa fa-cubes"></i>
                          <span>{{ __('Transactions') }}</span>
                          @if(getAdminTransactionsCount() > 0)
                            <span class="label label-success">{{ getAdminTransactionsCount() }}</span>
                          @endif
                        </a>
                      </li>
                      <li>
                        <a role="button"><i class="fa fa-bullhorn"></i> <span>{{ __('Content') }}</span>
                        </a>
                        <ul>
                          <li class="{{ (Route::is('admin.news.*') ? 'active' : '') }}">
                            <a href="{{ route('admin.news.index') }}"><i
                                  class="fa fa-caret-right"></i>{{ __('News') }}</a>
                          </li>
                          <li class="{{ (Route::is('admin.reviews.*') ? 'active' : '') }}"><a href="{{ route('admin.reviews.index') }}"><i
                                  class="fa fa-caret-right"></i>{{ __('Client reviews') }}</a>
                          </li>
                          <li class="{{ (Route::is('admin.faqs.*') ? 'active' : '') }}"><a href="{{ route('admin.faqs.index') }}"><i
                                  class="fa fa-caret-right"></i>{{ __('FAQs') }}</a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a role="button"><i class="fa fa-wrench"></i> <span>{{ __('Settings') }}</span>
                        </a>
                        <ul>
                          <li class="{{ (Route::is('admin.settings.*') ? 'active' : '') }}"><a
                                href="{{ route('admin.settings.index') }}"><i
                                  class="fa fa-caret-right"></i>{{ __('Base settings') }}</a>
                          </li>
                          <li class="{{ (Route::is('admin.langs.*') ? 'active' : '') }}"><a href="{{ route('admin.langs.index') }}"><i
                                  class="fa fa-caret-right"></i>{{ __('Languages') }}</a>
                          </li>
                          {{-- <li><a href=""><i class="fa fa-caret-right"></i>Настройки шаблона</a>
                           </li>--}}
                          <li class="{{ (Route::is('admin.tpl_texts.*') ? 'active' : '') }}"><a
                                href="{{ route('admin.tpl_texts.index') }}"
                            ><i
                                  class="fa fa-caret-right"></i>{{ __('Template translations') }}
                            </a>
                          </li>
                          <li class="{{ (Route::is('admin.currencies.*') ? 'active' : '') }}"><a href="{{ route('admin.currencies.index') }}"><i
                                  class="fa fa-caret-right"></i>{{ __('Currencies') }}</a>
                          </li>
                          <li class="{{ (Route::is('admin.payment-systems.*') ? 'active' : '') }}"><a href="{{ route('admin.payment-systems.index') }}"><i
                                  class="fa fa-caret-right"></i>{{ __('Payment systems') }}
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="{{ (Route::is('admin.rates.*') ? 'active' : '') }}"><a
                            href="{{ route('admin.rates.index') }}"><i
                              class="fa fa-book"></i>{{ __('Tariff plans') }}</a>
                      </li>
                      <li class="{{ (Route::is('admin.referral.*') ? 'active' : '') }}"><a
                            href="{{ route('admin.referral.index') }}"><i
                              class="fa fa-sitemap"></i>
                          <span>{{ __('Affiliate plans') }}</span>
                        </a>
                      </li>
                      <li class="{{ (Route::is('admin.backup.*') ? 'active' : '') }}"><a
                            href="{{ route('admin.backup.index') }}"><i
                              class="fa fa-hdd-o"></i>
                          <span>{{ __('Backups') }}</span></a>
                      </li>
                    </ul>
                    <!--/ NAVIGATION Content -->
                  </div>
                </div>
              </div>
              <div class="panel settings panel-default">
                <div class="panel-heading" role="tab">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" href="#sidebarControls">
                      {{ __('Quick settings') }} <i class="fa fa-angle-up"></i>
                    </a>
                  </h4>
                </div>
                <div id="sidebarControls" class="panel-collapse collapse in" role="tabpanel">
                  <div class="panel-body">
                    
                    <div class="form-group">
                      <div class="row">
                        <label class="col-xs-8 control-label">{{ __('Site status') }}</label>
                        <div class="col-xs-4 control-label">
                          <div class="onoffswitch greensea">
                            <input type="checkbox" name="site-on" class="onoffswitch-checkbox"
                                id="switch-on" {{ \App\Models\Setting::getValue('site-on') == 'on' ? 'checked' : '' }}>
                            
                            <label class="onoffswitch-label" for="switch-on"
                                onclick="location.href='{{route('admin.settings.switchSiteStatus')}}';">
                              <span class="onoffswitch-inner"></span>
                              <span class="onoffswitch-switch"></span>
                            </label>
                          
                          </div>
                        
                        </div>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
              <div class="panel charts panel-default">
                <div class="panel-heading" role="tab">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" href="#sidebarCharts">
                      {{ __('Short information') }} <i class="fa fa-angle-up"></i>
                    </a>
                  </h4>
                </div>
                <div id="sidebarCharts" class="panel-collapse collapse in" role="tabpanel">
                  <div class="panel-body">
                    <div style="color:white; font-weight:bold; padding: 5px;">
                      {{ __('Server time') }}
                      <br>{{ now()->format('H:i, d-m-Y') }}
                      <br>
                      
                      <hr>{{ __('Project launched') }}
                      <br>{{ \Carbon\Carbon::parse(getDateOfLaunch())->format('Y-m-d') }}
                      <br>({{ \Carbon\Carbon::parse(getDateOfLaunch())->diffForHumans() }})
                    </div>
                  
                  </div>
                </div>
              </div>
            
            </div>
          
          </div>
        
        
        </aside>
        <!--/ SIDEBAR Content -->
      </div>
      <!--/ CONTROLS Content -->
      
      
      <!-- ====================================================
      ================= CONTENT ===============================
      ===================================================== -->
      <section id="content">
        
        <div class="page page-dashboard">
          <div class="pageheader">
            {{--<h2>Dashboard <span>// You can place subtitle here</span></h2>--}}
            
            <div class="page-bar">
              
              <ul class="page-breadcrumb">
                <li>
                  <a href="{{ route('admin') }}"><i class="fa fa-home"></i> {{ __('Home') }}</a>
                </li>
                
                @yield('breadcrumbs')
              
              </ul>
            
            </div>
          
          </div>
          
          @include('admin.partials.inform')
          @yield('content')
        </div>
      
      
      </section>
      <!--/ CONTENT -->
    
    
    </div>
    <!--/ Application Content -->
    
    
    <!-- ============================================
    ============== Vendor JavaScripts ===============
    ============================================= -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/admin_assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>
    
    <script src="/admin_assets/js/vendor/bootstrap/bootstrap.min.js"></script>
    
    <script src="/admin_assets/js/vendor/jRespond/jRespond.min.js"></script>
    
    <script src="/admin_assets/js/vendor/d3/d3.min.js"></script>
    <script src="/admin_assets/js/vendor/d3/d3.layout.min.js"></script>
    
    <script src="/admin_assets/js/vendor/rickshaw/rickshaw.min.js"></script>
    
    <script src="/admin_assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
    
    <script src="/admin_assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
    
    <script src="/admin_assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
    
    <script src="/admin_assets/js/vendor/daterangepicker/moment.min.js"></script>
    <script src="/admin_assets/js/vendor/daterangepicker/daterangepicker.js"></script>
    
    <script src="/admin_assets/js/vendor/screenfull/screenfull.min.js"></script>
    
    <script src="/admin_assets/js/vendor/flot/jquery.flot.min.js"></script>
    <script src="/admin_assets/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <script src="/admin_assets/js/vendor/flot-spline/jquery.flot.spline.min.js"></script>
    
    <script src="/admin_assets/js/vendor/easypiechart/jquery.easypiechart.min.js"></script>
    
    <script src="/admin_assets/js/vendor/raphael/raphael-min.js"></script>
    <script src="/admin_assets/js/vendor/morris/morris.min.js"></script>
    
    <script src="/admin_assets/js/vendor/owl-carousel/owl.carousel.min.js"></script>
    
    <script src="/admin_assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    
    <script src="/admin_assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/admin_assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
    
    <script src="/admin_assets/js/vendor/chosen/chosen.jquery.min.js"></script>
    
    <script src="/admin_assets/js/vendor/summernote/summernote.min.js"></script>
    
    <script src="/admin_assets/js/vendor/coolclock/coolclock.js"></script>
    <script src="/admin_assets/js/vendor/coolclock/excanvas.js"></script>
    <!--/ vendor javascripts -->
    
    
    <!-- ============================================
    ============== Custom JavaScripts ===============
    ============================================= -->
    <script src="/admin_assets/js/main.js"></script>
    <!--/ custom javascripts -->
    
    
    <!-- ===============================================
    ============== Page Specific Scripts ===============
    ================================================ -->
    @stack('load-scripts')
    
    <script>
      $(window).load(function () {
        //Initialize mini calendar datepicker
        // $('#mini-calendar').datetimepicker({
        //     inline: true
        // });
        //*Initialize mini calendar datepicker
        
        //load wysiwyg editor
        // $('#summernote').summernote({
        //     toolbar: [
        //         //['style', ['style']], // no style button
        //         ['style', ['bold', 'italic', 'underline', 'clear']],
        //         ['fontsize', ['fontsize']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['height', ['height']],
        //         //['insert', ['picture', 'link']], // no insert buttons
        //         //['table', ['table']], // no table button
        //         //['help', ['help']] //no help button
        //     ],
        //     height: 143   //set editable area's height
        // });
        //*load wysiwyg editor
      });
    </script>
    <!--/ Page Specific Scripts -->
  
  </body>
</html>

