<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestion Usuarios</title>

        <!-- Vendor CSS -->
        <link href="{{ asset('vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css') }}" rel="stylesheet">

       <!-- <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet">-->
        <link href="{{ asset('vendors/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">        
        <link href="{{ asset('vendors/bower_components/google-material-color/dist/palette.css') }}" rel="stylesheet">

        <link href="{{ asset('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/bower_components/chosen/chosen.min.css') }}" rel="stylesheet">

        <link href="{{ asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">


    
        
        <!-- CSS -->
        <link href="{{ asset('css/app.min.1.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.min.2.css') }}" rel="stylesheet"> 



         <!-- styles datatables-->
          <link href="{{ asset('css/tables/responsive.bootstrap.min.css') }}" rel="stylesheet">
          <link href="{{ asset('css/tables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
            <!--datatables
          <link rel="stylesheet" href="https://datatables.net/release-datatables/extensions/TableTools/css/dataTables.tableTools.css">-->
          <link href="{{ asset('css/tables/buttons.dataTables.min.css') }}" rel="stylesheet">


        @yield('header')
        
    </head>
    <body data-ma-header="teal">

	
        <header id="header" class="media">
            <div class="pull-left h-logo">
                <a href="/" class="hidden-xs">
                {{ Auth::user()->name }} - {{Auth::user()->last_name}}   
                    <small>admin extended</small>
                </a>
                
                <div class="menu-collapse" data-ma-action="sidebar-open" data-ma-target="main-menu">
                    <div class="mc-wrap">
                        <div class="mcw-line top palette-White bg"></div>
                        <div class="mcw-line center palette-White bg"></div>
                        <div class="mcw-line bottom palette-White bg"></div>
                    </div>
                </div>
            </div>

            <ul class="pull-right h-menu">
                <li class="hm-search-trigger">
                    <a href="" data-ma-action="search-open">
                        <i class="hm-icon zmdi zmdi-search"></i>
                    </a>
                </li>
                
                <li class="dropdown hidden-xs hidden-sm h-apps">
                    <a data-toggle="dropdown" href="">
                        <i class="hm-icon zmdi zmdi-apps"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="">
                                <i class="palette-Orange-400 bg zmdi zmdi-trending-up"></i>
                                <small>Estadisticas</small>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="palette-Purple-300 bg zmdi zmdi-view-headline"></i>
                                <small>Usuarios</small>
                            </a>
                        </li>
                      
                    </ul>
                </li>
         
                <li class="hm-alerts" data-user-alert="sua-messages" data-ma-action="sidebar-open" data-ma-target="user-alerts">
                    <a href=""><i class="hm-icon zmdi zmdi-notifications"></i></a>
                </li>
                <li class="dropdown hm-profile">
                    <a data-toggle="dropdown" href="">
                        <img src="/img/profile-pics/2.jpg" alt="">
                    </a>
                    
                    <ul class="dropdown-menu pull-right dm-icon">
                        <li>
                            <a href="/"><i class="zmdi zmdi-account"></i> Perfil</a>
                        </li>
                    @if (Auth::guest())
					@else
                        <li>
                            <a href="/auth/logout"><i class="zmdi zmdi-time-restore"></i> Salir</a>
                        </li>
					@endif

                    </ul>
                </li>
            </ul>
            
            <div class="media-body h-search">
                <form class="p-relative">
                    <input type="text" class="hs-input" placeholder="Search for people, files & reports">
                    <i class="zmdi zmdi-search hs-reset" data-ma-action="search-clear"></i>
                </form>
            </div>
            
        </header>

        <section id="main">
             @include('menu.menu')
             <section id="content">
                    <div class="container">
                           @yield('content')
                    </div>
            </section>
        </section>

            <footer id="footer">
                Copyright &copy; 2015 Material Admin

                <ul class="f-menu">
                    <li><a href="">Home</a></li>
                    <li><a href="">Dashboard</a></li>
                    <li><a href="">Reports</a></li>
                    <li><a href="">Support</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </footer>

        </section>

        <!-- Page Loader -->
        <div class="page-loader palette-Teal bg">
            <div class="preloader pl-xl pls-white">
                <svg class="pl-circular" viewBox="25 25 50 50">
                    <circle class="plc-path" cx="50" cy="50" r="20"/>
                </svg>
            </div>
        </div>
        
        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>   
        <![endif]-->

        <!-- Javascript Libraries -->
        <script src="{{ URL::asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bootstrap-growl/bootstrap-growl.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>
         <script src="{{ URL::asset('vendors/bootgrid/jquery.bootgrid.updated.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/salvattore/dist/salvattore.min.js') }}"></script>

        <script src="{{ URL::asset('vendors/bower_components/flot/jquery.flot.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/flot.curvedlines/curvedLines.js') }}"></script>
        <script src="{{ URL::asset('vendors/sparklines/jquery.sparkline.min.js') }}"></script>

        <script src="{{ URL::asset('vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ URL::asset('js/flot-charts/curved-line-chart.js') }}"></script>

        <script src="{{ URL::asset('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/chosen/chosen.jquery.min.js') }}"></script>

        <script src="{{ URL::asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

           

        <script src="{{ URL::asset('js/flot-charts/line-chart.js') }}"></script>
        <script src="{{ URL::asset('js/charts.js') }}"></script>
        <script src="{{ URL::asset('js/functions.js') }}"></script>
        <script src="{{ URL::asset('js/actions.js') }}"></script>
        <script src="{{ URL::asset('js/demo.js') }}"></script>

        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
        
     



<!--datatables-->
<script src="{{ URL::asset('js/tables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/responsive.bootstrap.min.js') }}"></script>
 <!--datatables export to pdf, excel, csv, print-->
<script src="{{ URL::asset('js/tables/export/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/buttons.flash.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/jszip.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/date-de.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/datetime.js') }}"></script>
<script src="{{ URL::asset('js/tables/export/moment-timezone-with-data.js') }}"></script>


       <!-- <script src="{{ URL::asset('vendors/select2/select2.full.min.js') }}"></script>-->

      
     

          @yield('footer')

    </body>
  </html>