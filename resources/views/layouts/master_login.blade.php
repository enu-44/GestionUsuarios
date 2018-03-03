<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Material Admin</title>


            
        <!-- Vendor CSS -->
        <link href="{{ asset('vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
          <link href="{{ asset('vendors/bower_components/google-material-color/dist/palette.css') }}" rel="stylesheet">

        <link href="{{ asset('vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css') }}" rel="stylesheet">
          <link href="{{ asset('vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
        <!-- CSS -->
          <link href="{{ asset('css/app.min.1.css') }}" rel="stylesheet">
          <link href="{{ asset('css/app.min.2.css') }}" rel="stylesheet">
          
    </head>
    
    <body>
        <div class="login" data-lbg="teal">
                @yield('content')
            <!-- Forgot Password 
            <div class="l-block" id="l-forget-password">
                <div class="lb-header palette-Purple bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    Forgot Password?
                </div>

                <div class="lb-body">
                    <p class="m-b-30">Lorem ipsum dolor fringilla enim feugiat commodo sed ac lacus.</p>

                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="text" class="input-sm form-control fg-input">
                            <label class="fg-label">Email Address</label>
                        </div>
                    </div>

                    <button class="btn palette-Purple bg">Create Account</button>

                    <div class="m-t-30">
                        <a data-block="#l-login" data-bg="teal" class="palette-Purple text d-block m-b-5" href="">Already have an account?</a>
                        <a data-block="#l-register" data-bg="blue" href="" class="palette-Purple text">Create an account</a>
                    </div>
                </div>
            </div>-->
        </div>
     


        <!-- Javascript Libraries -->
        <script type="text/javascript" src="{{ URL::asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
           <script src="{{ URL::asset('vendors/bootstrap-growl/bootstrap-growl.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>

        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->


        <script src="{{ URL::asset('js/functions.js') }}"></script>
        <script src="{{ URL::asset('js/actions.js') }}"></script>
        <script src="{{ URL::asset('js/demo.js') }}"></script>
       
       
        @yield('footer')
        
    </body>
</html>